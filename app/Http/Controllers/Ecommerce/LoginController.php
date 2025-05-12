<?php

namespace App\Http\Controllers\Ecommerce;

use App\Models\Order;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function loginForm()
    {
        if (auth()->guard('customer')->check()) return redirect(route('front.index'));
        return view('ecommerce.pages.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|string'
        ]);

        $auth = $request->only('email', 'password');
        $auth['status'] = 1;
        if (auth()->guard('customer')->attempt($auth)) {
            return redirect()->intended(route('front.index'));
        }
        return redirect()->back()->with(['error' => 'wrong E-mail or Password']);
    }

    public function account()
    {
        $orders = Order::selectRaw('
            COALESCE(SUM(CASE WHEN status = 0 THEN subtotal + IFNULL(cost, 0) END), 0) as pending,
            COALESCE(COUNT(CASE WHEN status = 0 THEN subtotal + IFNULL(cost, 0) END), 0) as newOrder,
            COALESCE(COUNT(CASE WHEN status = 2 THEN subtotal + IFNULL(cost, 0) END), 0) as processOrder,
            COALESCE(COUNT(CASE WHEN status = 3 THEN subtotal + IFNULL(cost, 0) END), 0) as shipping,
            COALESCE(COUNT(CASE WHEN status = 4 THEN subtotal + IFNULL(cost, 0) END), 0) as completeOrder,
            COALESCE(COUNT(CASE WHEN status = 5 THEN subtotal + IFNULL(cost, 0) END), 0) as returnOrder'
        )->where('customer_id', auth()->guard('customer')->user()->id)->get();
        $customer = auth()->guard('customer')->user();
        return view('ecommerce.pages.account', compact('orders', 'customer'));
    }

    public function logout()
    {
        auth()->guard('customer')->logout();
        return redirect(route('front.index'));
    }
}
