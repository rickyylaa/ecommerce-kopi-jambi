<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::orderBy('id', 'ASC')->paginate(10);
        $notifications = NotificationService::getNotifications();
        return view('admin.pages.customer.index', compact('customer', 'notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $customer->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => 1
            ]);

            $auth = $request->only('first_name', 'last_name', 'email', 'password', 'phone', 'address');
            $auth['status'] = 1;

            DB::commit();

            Alert::toast('Pelanggan Berhasil Ditambah', 'Success');
            return redirect(route('customer.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Pelanggan', 'Error');
            return redirect(route('customer.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        $notifications = NotificationService::getNotifications();
        return view('admin.pages.customer.edit', compact('customer', 'notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'nullable|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $customer = Customer::findOrFail($id);
            $customer->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => 1
            ]);

            $auth = $request->only('first_name', 'last_name', 'email', 'password', 'phone', 'address');
            $auth['status'] = 1;

            DB::commit();

            Alert::toast('Pelanggan Berhasil Diupdate', 'Success');
            return redirect(route('customer.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Pelanggan', 'Error');
            return redirect(route('customer.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $customer = Customer::find($id);
            $customer->delete();

            Alert::toast('Customer Berhasil Dihapus', 'Success');
            return redirect(route('customer.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menghapus Customer', 'Error');
            return redirect(route('customer.index'));
        }
    }
}
