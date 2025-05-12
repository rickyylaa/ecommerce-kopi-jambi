<?php

namespace App\Http\Controllers\Ecommerce;

use Pusher\Pusher;
use App\Models\City;
use App\Models\Order;
use App\Models\Message;
use App\Models\Product;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\CustomerRegisterMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    private function getCarts()
    {
        $carts = json_decode(request()->cookie('kopi-jambi'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }

    public function listCart()
    {
        $carts = $this->getCarts();

        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['product_price'];
        });
        return view('ecommerce.pages.cart', compact('carts', 'subtotal'));
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        try {
            $product = Product::find($request->product_id);

            if (!$product) {
                Alert::toast('Produk Tidak Ditemukan', 'Error');
                return redirect()->back();
            }

            $availableQty = $product->qty;

            $carts = json_decode(request()->cookie('kopi-jambi'), true);

            if ($carts && array_key_exists($request->product_id, $carts)) {
                $newQty = $carts[$request->product_id]['qty'] + $request->qty;
                if ($newQty > $availableQty) {
                    Alert::toast('Stok tidak mencukupi', 'Error');
                    return redirect()->back();
                }
                $carts[$request->product_id]['qty'] = $newQty;
            } else {
                if ($request->qty > $availableQty) {
                    Alert::toast('Stok tidak mencukupi', 'Error');
                    return redirect()->back();
                }
                $carts[$request->product_id] = [
                    'qty' => $request->qty,
                    'product_id' => $product->id,
                    'product_title' => $product->title,
                    'product_slug' => $product->slug,
                    'product_category' => $product->category->title,
                    'product_image' => $product->image,
                    'product_price' => $product->price,
                    'weight' => $product->weight
                ];
            }

            $cookie = cookie('kopi-jambi', json_encode($carts), 2880);
            Alert::toast('Produk Berhasil Ditambah', 'Success');
            return redirect()->back()->cookie($cookie);
        } catch (\Exception $e) {
            Alert::toast('Error Saat Menambah Produk', 'Error');
            return redirect()->back()->cookie($cookie);
        }
    }

    public function updateCart(Request $request)
    {
        try {
            $carts = $this->getCarts();

            foreach ($request->product_id as $key => $row) {
                $product = Product::find($row);

                if (!$product) {
                    continue;
                }

                if ($request->qty[$key] < 0) {
                    continue;
                }

                if ($request->qty[$key] > $product->qty) {
                    Alert::toast('Stok tidak mencukupi', 'Error');
                    return redirect()->back();
                }

                if ($request->qty[$key] == 0) {
                    unset($carts[$row]);
                } else {
                    $carts[$row]['qty'] = $request->qty[$key];
                }
            }

            $cookie = cookie('kopi-jambi', json_encode($carts), 2880);
            Alert::toast('Keranjang Berhasil Diupdate', 'Success');
            return redirect()->back()->cookie($cookie);
        } catch (\Exception $e) {
            Alert::toast('Error Saat Mengupdate Keranjang', 'error');
            return redirect()->back()->cookie($cookie);
        }
    }

    public function checkout()
    {
        $customers = auth()->guard('customer')->user();
        if ($customers) {
            $customer = auth()->guard('customer')->user()->load('district');
            $provinces = Province::orderBy('created_at', 'DESC')->get();
            $carts = $this->getCarts();

            $subtotal = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['product_price'];
            });

            $weight = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['weight'];
            });
            return view('ecommerce.pages.checkout', compact('provinces', 'carts', 'subtotal', 'customer', 'weight'));
        } else {
            $provinces = Province::orderBy('created_at', 'DESC')->get();
            $carts = $this->getCarts();

            $subtotal = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['product_price'];
            });

            $weight = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['weight'];
            });
            return view('ecommerce.pages.checkout', compact('provinces', 'carts', 'subtotal', 'weight'));
        }
    }

    public function processCheckout(Request $request)
    {
        $this->validate($request, [
            'customer_first_name' => 'required|string|max:100',
            'customer_last_name' => 'nullable|string|max:100',
            'email' => 'required|email',
            'customer_country' => 'required|string',
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
            'customer_postal_code' => 'nullable|numeric',
            'customer_address' => 'nullable|string',
            'customer_address2' => 'nullable|string',
            'customer_phone' => 'required|numeric',
            'condition' => 'nullable',
            'courier' => 'nullable',
            'shipping' => 'nullable',
        ]);

        DB::beginTransaction();

        try {
            $customer = Customer::where('email', $request->email)->first();

            if (!auth()->guard('customer')->check() && $customer) {
                return redirect()->back()->with(['error' => 'Please log in first']);
            }

            $carts = $this->getCarts();
            $subtotal = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['product_price'];
            });

            if (!auth()->guard('customer')->check()) {
                $password = Str::random(8);
                $customer = Customer::create([
                    'first_name' => $request->customer_first_name,
                    'last_name' => $request->customer_last_name,
                    'email' => $request->email,
                    'password' => $password,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'address2' => $request->customer_address2,
                    'country' => $request->customer_country,
                    'postal_code' => $request->customer_postal_code,
                    'district_id' => $request->district_id,
                    'activate_token' => Str::random(30),
                    'status' => false
                ]);
            }

            $order = Order::create([
                'invoice' => 'INV' . '-' . rand(0,99999),
                'customer_id' => $customer->id,
                'customer_name' => $customer->first_name . ' ' . $customer->last_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'customer_address2' => $request->customer_address2,
                'customer_country' => $request->customer_country,
                'customer_postal_code' => $request->customer_postal_code,
                'district_id' => $request->district_id,
                'subtotal' => $subtotal,
                'condition' => $request->condition,
                'cost' => $request->shipping,
                'courier' => $request->courier,
            ]);

            foreach ($carts as $row) {
                $product = Product::find($row['product_id']);

                $product->update([
                    'qty' => $product->qty - $row['qty']
                ]);

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $row['product_id'],
                    'price' => $row['product_price'],
                    'qty' => $row['qty'],
                    'weight' => $product->weight
                ]);

                Message::create([
                    'customer_id' => $customer->id,
                    'product_id' => $row['product_id'],
                    'order_id' => $order->id,
                ]);

                $options = array(
                    'cluster' => 'ap1',
                    'useTLS' => true
                );

                $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $options
                );

                $data = ['customer_id' => $order->customer->id];
                $pusher->trigger('my-channel', 'my-event', $data);
            }

            DB::commit();

            $carts = [];
            $cookie = cookie('kopi-jambi', json_encode($carts), 2880);

            if (!auth()->guard('customer')->check()) {
                Mail::to($request->email)->send(new CustomerRegisterMail($customer, $password));
            }

            Alert::toast('Produk Berhasil Dicheckout', 'Success');
            return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
            Alert::toast('Error Saat Produk Dicheckout', 'Error');
        }
    }

    public function checkoutFinish($invoice)
    {
        $order = Order::with(['district.city'])->where('invoice', $invoice)->first();
        return view('ecommerce.pages.checkout_finish', compact('order'))->with(['success' => 'Successfully']);
    }

    public function getCity()
    {
        $cities = City::where('province_id', request()->province_id)->get();
        return response()->json(['status' => 'success', 'data' => $cities]);
    }

    public function getDistrict()
    {
        $districts = District::where('city_id', request()->city_id)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }

    public function getCost()
    {
        $destination = request()->destination;
        $weight = request()->weight;
        $origin = 156;
        $courier = request()->courier;

        $destinations =  "origin=$origin&destination=$destination&weight=$weight&courier=$courier";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $destinations,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: a997b23f080c2603d7c03e78015c9283"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        echo $err;
        curl_close($curl);


        if ($err) {
                dd($err);
        } else {
            return json_decode($response);
        }
    }
}
