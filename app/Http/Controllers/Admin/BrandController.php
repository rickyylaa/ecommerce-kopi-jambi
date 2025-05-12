<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Services\NotificationService;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::orderBy('id', 'ASC')->paginate(10);
        $notifications = NotificationService::getNotifications();
        return view('admin.pages.brand.index', compact('brand', 'notifications'));
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
    public function store(Request $request, Brand $brand)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:png,jpeg,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::slug($request->title) . '-' . rand(0,99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/brands', $filename);
            }

            $brand->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'image' => $filename,
                'description' => $request->description,
                'status' => $request->status
            ]);

            DB::commit();

            Alert::toast('Brand Berhasil Ditambah', 'Success');
            return redirect(route('brand.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Brand', 'Error');
            return redirect(route('brand.index'));
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
        $brand = Brand::findOrFail($id);
        $notifications = NotificationService::getNotifications();
        return view('admin.pages.brand.edit', compact('brand', 'notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpeg,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $brand = Brand::findOrFail($id);
            $filename = $brand->image;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::slug($request->title) . '-' . rand(0,99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/brands', $filename);

                if ($brand->image) {
                    File::delete(storage_path('app/public/brands/' . $brand->image));
                }
            }

            $brand->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'image' => $filename,
                'description' => $request->description,
                'status' => $request->status
            ]);

            DB::commit();

            Alert::toast('Brand Berhasil Diupdate', 'Success');
            return redirect(route('brand.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Brand', 'Error');
            return redirect(route('brand.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $brand = Brand::find($id);
            File::delete(storage_path('app/public/brands/' . $brand->image));
            $brand->delete();

            Alert::toast('Brand Berhasil Dihapus', 'Success');
            return redirect(route('brand.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menghapus Brand', 'Error');
            return redirect(route('brand.index'));
        }
    }
}
