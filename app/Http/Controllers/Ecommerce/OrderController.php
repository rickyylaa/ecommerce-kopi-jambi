<?php

namespace App\Http\Controllers\Ecommerce;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\OrderReturn;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', auth()->guard('customer')->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        $orderDetails = OrderDetail::whereIn('order_id', $orders->pluck('id')->toArray())->get();
        $customer = auth()->guard('customer')->user();
        return view('ecommerce.pages.order.index', compact('orders', 'orderDetails', 'customer'));
    }

    public function view($invoice)
    {
        $order = Order::with(['district.city.province', 'details', 'details.product', 'payment'])->where('invoice', $invoice)->first();
        $customer = auth()->guard('customer')->user();
        if (Order::where('invoice', $invoice)->exists()){
            if(Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)){
                return view('ecommerce.pages.order.view', compact('order', 'customer'));
            }
        } else {
            return redirect()->back();
        }

        Alert::toast('Anda Tidak Diizinkan Untuk Mengakses Pesanan Orang Lain', 'error');
        return redirect(route('customer.orders'));
    }

    public function orderPDF($invoice)
    {
        $order = Order::with(['district.city.province', 'details', 'details.product', 'payment'])->where('invoice', $invoice)->first();
        $customer = auth()->guard('customer')->user();
        if(Order::where('invoice', $invoice)->exists()) {
            if(Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)) {
                $pdf = PDF::loadView('ecommerce.pages.account.order.pdf', compact('order', 'customer'));
                $filename = $order->invoice;
                return $pdf->download($filename.'-invoice.pdf');
            }else {
                Alert::toast('Anda Tidak Diizinkan Untuk Mengakses Invoice Orang Lain', 'error');
                return redirect(route('customer.orders'));
            }
        } else {
            Alert::toast('Tagihan Tidak Termasuk Dalam Pesanan Anda.', 'error');
            return redirect(route('customer.orders'));
        }
    }

    public function acceptOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)) {
            return redirect()->back()->with(['error' => 'Bukan Pesanan Kamu']);
        }
        $order->update(['status' => 4]);
        Alert::toast('Pesanan Dikonfirmasi', 'success');
        return redirect()->back();
    }

    public function returnForm($invoice)
    {
        $order = Order::where('invoice', $invoice)->first();
        $customer = auth()->guard('customer')->user();
        if (Order::where('invoice', $invoice)->exists()){
            if(Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)){
                return view('ecommerce.pages.order.return', compact('order', 'customer'));
            }
        }else {
            return redirect()->back();
        }

        Alert::toast('Anda Tidak Diizinkan Untuk Mengakses Pesanan Orang Lain', 'error');
        return redirect()->back();
    }

    public function processReturn(Request $request, $id)
    {
        $this->validate($request, [
            'reason' => 'required|string',
            'refund_transfer' => 'required|string',
            'photo' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $return = OrderReturn::where('order_id', $id)->first();
        if ($return)
        return redirect()->back()->with(['error' => 'Permintaan Pengembalian Dana Dalam Proses']);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/returns', $filename);

            OrderReturn::create([
                'order_id' => $id,
                'photo' => $filename,
                'reason' => $request->reason,
                'refund_transfer' => $request->refund_transfer,
                'status' => 0
            ]);

            Alert::toast('Permintaan Pengembalian Dana Telah Dikirim', 'success');
            return redirect()->route('customer.orders');
        }
    }

    public function pdf($invoice)
    {
        $order = Order::with(['district.city.province', 'details', 'details.product', 'payment'])
                ->where('invoice', $invoice)->first();
        if(Order::where('invoice', $invoice)->exists()) {
            if(Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)) {
                $pdf = PDF::loadView('ecommerce.pages.order.pdf', compact('order'));
                $filename = $order->invoice;
                return $pdf->download($filename.'-invoice.pdf');
            }else {
                return redirect(route('customer.orders'))->with(['error' => 'Anda Tidak Diizinkan Untuk Mengakses Invoice Orang Lain']);
            }
        } else {
            return redirect(route('customer.orders'))->with(['error' => 'Invoice Tidak Ada Dalam Pesanan Anda']);
        }
    }

    public function paymentForm($invoice)
    {
        $order = Order::with([ 'payment'])->where('invoice', $invoice)->first();
        if (Order::where('invoice', $invoice)->exists()){
            if(Gate::forUser(auth()->guard('customer')->user())->allows('order-view', $order)){
                return view('ecommerce.pages.order.payment', compact('order'));
            }
        }else {
            return redirect()->back();
        }

        return redirect()->back()->with(['error' => 'Anda Tidak Diizinkan Untuk Mengakses Pembayaran Orang Lain']);
    }

    public function storePayment(Request $request)
    {
        $this->validate($request, [
            'invoice' => 'required|exists:orders,invoice',
            'name' => 'required|string',
            'transfer_to' => 'required|string',
            'transfer_date' => 'required',
            'amount' => 'required|integer',
            'proof' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        DB::beginTransaction();
        try {
            $order = Order::where('invoice', $request->invoice)->first();
            if ($order->total != $request->amount)
                return redirect()->back()->with(['error' => 'Kesalahan, Pembayaran Harus Sama Dengan Invoice']);
            if ($order->status == 0 && $request->hasFile('proof')) {
                $file = $request->file('proof');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/payments', $filename);

                Payment::create([
                    'order_id' => $order->id,
                    'name' => $request->name,
                    'transfer_to' => $request->transfer_to,
                    'transfer_date' => Carbon::parse($request->transfer_date)->format('Y-m-d'),
                    'amount' => $request->amount,
                    'proof' => $filename,
                    'status' => false
                ]);

                $order->update(['status' => 1]);
                DB::commit();
                return redirect()->back()->with(['success' => 'Pesanan Telah Diterima']);
            }
            return redirect()->back()->with(['error' => 'Kesalahan, Unggah Bukti Transfer']);
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
