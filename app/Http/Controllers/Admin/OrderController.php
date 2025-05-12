<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Mail\OrderMail;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Services\NotificationService;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::with(['customer.district.city.province'])->withCount('return')->orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $order = $order->where(function($q) {
                $q->where('customer_name', 'LIKE', '%' . request()->q . '%')
                ->orWhere('invoice', 'LIKE', '%' . request()->q . '%')
                ->orWhere('customer_address', 'LIKE', '%' . request()->q . '%');
            });
        }

        if (request()->status != '') {
            $order = $order->where('status', request()->status);
        }
        $order = $order->paginate(10);
        $notifications = NotificationService::getNotifications();
        return view('admin.pages.order.index', compact('order', 'notifications'));
    }

    public function view($invoice)
    {
        if (Order::where('invoice', $invoice)->exists()){
            $order = Order::with(['customer.district.city.province', 'payment', 'details.product'])->withCount('return')->where('invoice', $invoice)->first();

            $notifications = NotificationService::getNotifications();
            return view('admin.pages.order.view', compact('order', 'notifications'));
        }else {
            return redirect()->back();
        }
    }

    public function acceptPayment($invoice)
    {
        $order = Order::with(['payment'])->where('invoice', $invoice)->first();
        $order->payment()->update(['status' => 1]);
        $order->update(['status' => 2]);

        Alert::toast('Pembayaran berhasil diterima', 'success');
        return redirect(route('order.view', $order->invoice));
    }

    public function shippingOrder(Request $request)
    {
        // Validasi nomor pelacakan unik
        $request->validate([
            'tracking_number' => [
                'required',
                Rule::unique('orders')->ignore($request->order_id),
            ],
        ], [
            'tracking_number.unique' => 'Nomor pelacakan tidak boleh sama.',
        ]);

        $order = Order::with(['customer'])->find($request->order_id);

        // Perbarui nomor pelacakan dan status
        $order->update(['tracking_number' => $request->tracking_number, 'status' => 3]);

        // Kirim email konfirmasi
        Mail::to($order->customer->email)->send(new OrderMail($order));

        return redirect()->back();
    }

    public function return($invoice)
    {
        if (Order::where('invoice', $invoice)->exists()){
            $order = Order::with(['return', 'customer'])->where('invoice', $invoice)->first();

            $notifications = NotificationService::getNotifications();
            return view('admin.pages.order.return', compact('order', 'notifications'));
        }else {
            return redirect()->back();
        }
    }

    public function acceptReturn(Request $request)
    {
        $this->validate($request, ['status' => 'required']);
        $order = Order::find($request->order_id);
        $order->return()->update(['status' => $request->status]);
        $order->update(['status' => 5]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->details()->delete();
        $order->payment()->delete();
        $order->delete();

        Alert::toast('Pesanan berhasil dihapus', 'success');
        return redirect(route('order.index'));
    }
}
