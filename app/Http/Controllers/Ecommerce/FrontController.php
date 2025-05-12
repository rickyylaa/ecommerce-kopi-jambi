<?php

namespace App\Http\Controllers\Ecommerce;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class FrontController extends Controller
{
    public function front()
    {
        $product = Product::where('status', 1)->where('qty', '>', 0)->orderBy('created_at', 'DESC')->limit(8)->get();
        $category = Category::where('status', 1)->orderBy('title', 'ASC')->get();
        $brand = Brand::where('status', 1)->orderBy('title', 'ASC')->get();
        $size = Size::where('status', 1)->orderBy('title', 'ASC')->get();
        $banner = Banner::where('status', 1)->orderBy('title', 'ASC')->limit(1)->get();

        return view('ecommerce.pages.front', compact('product', 'category', 'brand', 'size', 'banner'));
    }

    public function product()
    {
        $product = Product::orderBy('created_at', 'DESC')->paginate(100);
        return view('ecommerce.pages.product', compact('product'));
    }

    public function search(Request $request)
    {
        $recent_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $searchTerm = $request->query('q');
        $product = Product::where('status', 1)->with(['category', 'brand', 'size'])
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('slug', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('summary', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('price', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orderBy('id', 'DESC')
            ->paginate(9);

        return view('ecommerce.pages.product', compact('product'));
    }

    public function categoryProduct($slug)
    {
        $product = Category::where('slug', $slug)->first()->product()->orderBy('created_at', 'DESC')->paginate(12);
        return view('ecommerce.pages.product', compact('product'));
    }

    public function brandProduct($slug)
    {
        $product = Brand::where('slug', $slug)->first()->product()->orderBy('created_at', 'DESC')->paginate(12);
        return view('ecommerce.pages.product', compact('product'));
    }

    public function sizeProduct($slug)
    {
        $product = Size::where('slug', $slug)->first()->product()->orderBy('created_at', 'DESC')->paginate(12);
        return view('ecommerce.pages.product', compact('product'));
    }

    public function show($slug)
    {
        $product = Product::with(['category'])->where('slug', $slug)->first();
        return view('ecommerce.pages.show', compact('product'));
    }

    public function customerSettingForm()
    {
        $customer = auth()->guard('customer')->user()->load('district');
        $province = Province::orderBy('name', 'ASC')->get();
        return view('ecommerce.pages.setting', compact('customer', 'province'));
    }

    public function customerUpdateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'email' => 'nullable|string',
            'password' => 'nullable|string',
            'country' => 'nullable|string',
            'district_id' => 'nullable|exists:districts,id',
            'postal_code' => 'nullable|numeric',
            'address' => 'nullable|string',
            'address2' => 'nullable|string',
            'phone' => 'nullable|numeric'
        ]);

        $customer = auth()->guard('customer')->user();
        $data = $request->only('first_name', 'last_name', 'email', 'password', 'country', 'district_id', 'postal_code', 'address', 'address2', 'phone');

        if ($request->password != '') {
            $data['password'] = $request->password;
        }

        $customer->update($data);
        return redirect()->back();
    }

    public function verifyCustomerRegistration($token)
    {
        $customer = Customer::where('activate_token', $token)->first();
        if ($customer) {
            $customer->update([
                'activate_token' => null,
                'status' => 1
            ]);
            return redirect(route('customer.login'))->with(['success' => 'Verifikasi Berhasil, Silahkan Login']);
        }
        return redirect(route('customer.login'))->with(['error' => 'Invalid Verifikasi Token']);
    }
}
