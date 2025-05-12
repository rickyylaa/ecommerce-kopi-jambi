<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\PDF as PDF;

class DashboardController extends Controller
{
    public function index()
    {
        $order = Order::selectRaw('COALESCE(sum(CASE WHEN status = 4 THEN (subtotal + COALESCE(cost, 0)) END), 0) as turnover,
        COALESCE(count(CASE WHEN status = 0 THEN subtotal END), 0) as newOrder,
        COALESCE(count(CASE WHEN status = 2 THEN subtotal END), 0) as processOrder,
        COALESCE(count(CASE WHEN status = 3 THEN subtotal END), 0) as shipping,
        COALESCE(count(CASE WHEN status = 4 THEN subtotal END), 0) as completeOrder')->get();

        $orders = Order::get();
        $products = Product::get();
        $customers = Customer::get();
        $categories = Category::get();
        $order_details = OrderDetail::get();
        $notifications = NotificationService::getNotifications();
        return view('admin.pages.dashboard.index', compact('categories', 'products', 'customers', 'orders', 'order_details', 'order', 'notifications'));
    }

    public function orderReport()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $orders = Order::with(['customer.district'])->whereDoesntHave('return')->whereBetween('created_at', [$start, $end])->get();

        $notifications = NotificationService::getNotifications();
        return view('admin.pages.report.order', compact('orders', 'notifications'));
    }

    public function orderReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $orders = Order::with(['customer.district'])->whereDoesntHave('return')->whereBetween('created_at', [$start, $end])->get();
        $pdf = PDF::loadView('admin.pages.report.order_pdf', compact('orders', 'date'));
        return $pdf->stream();
    }

    public function returnReport()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $orders = Order::with(['customer.district'])->has('return')->whereBetween('created_at', [$start, $end])->get();

        $notifications = NotificationService::getNotifications();
        return view('admin.pages.report.return', compact('orders', 'notifications'));
    }

    public function returnReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $orders = Order::with(['customer.district'])->has('return')->whereBetween('created_at', [$start, $end])->get();
        $pdf = PDF::loadView('admin.pages.report.return_pdf', compact('orders', 'date'));
        return $pdf->stream();
    }

    public function productReport()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $orders = OrderDetail::with(['product'])->has('product')->whereBetween('created_at', [$start, $end])->get();

        $notifications = NotificationService::getNotifications();
        return view('admin.pages.report.product', compact('orders', 'notifications'));
    }

    public function productReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $orders = OrderDetail::with(['product'])->has('product')->whereBetween('created_at', [$start, $end])->get();
        $pdf = PDF::loadView('admin.pages.report.product_pdf', compact('orders', 'date'));
        return $pdf->stream();
    }
}
