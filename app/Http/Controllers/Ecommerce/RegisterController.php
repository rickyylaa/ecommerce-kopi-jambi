<?php

namespace App\Http\Controllers\Ecommerce;

use App\Models\Customer;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\CustomerRegisterMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function registerForm()
    {
        if (auth()->guard('customer')->check()) return redirect(route('front.index'));

        $provinces = Province::orderBy('created_at', 'DESC')->get();
        return view('ecommerce.pages.register', compact('provinces'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'customer_first_name' => 'required|string|max:100',
            'customer_last_name' => 'nullable|string|max:100',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            if (!auth()->guard('customer')->check()) {
                Customer::create([
                    'first_name' => $request->customer_first_name,
                    'last_name' => $request->customer_last_name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'status' => 1
                ]);
            }

            $auth = $request->only('first_name', 'last_name', 'email', 'password');
            $auth['status'] = 1;

            if (auth()->guard('customer')->attempt($auth)) {
                return redirect()->intended(route('front.index'));
            }
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
