<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Services\NotificationService;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with(['category', 'brand', 'size'])->orderBy('id', 'ASC')->paginate(10);
        if (request()->q != '') {
            $product = $product->where('title', 'LIKE', '%' . request()->q . '%');
        }

        $category = Category::get();
        $brand = Brand::get();
        $size = Size::get();

        $notifications = NotificationService::getNotifications();
        return view('admin.pages.product.index', compact('product', 'category', 'brand', 'size', 'notifications'));
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
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'size_id' => 'required|exists:sizes,id',
            'price'=> 'required|numeric',
            'weight' => 'required|numeric',
            'qty' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpeg,jpg,webp|max:2048',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::slug($request->title) . '-' . rand(0,99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/products', $filename);
            }

            $product->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'size_id' => $request->size_id,
                'price' => $request->price,
                'weight' => $request->weight,
                'qty' => $request->qty,
                'image' => $filename,
                'summary' => $request->summary,
                'description' => $request->description,
                'status' => $request->status
            ]);

            DB::commit();

            Alert::toast('Produk Berhasil Ditambah', 'Success');
            return redirect(route('product.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Produk', 'Error');
            return redirect(route('product.index'));
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
        $product = Product::findOrFail($id);

        $category = Category::get();
        $brand = Brand::get();
        $size = Size::get();
        $items = Product::where('id', $id)->get();

        $notifications = NotificationService::getNotifications();
        return view('admin.pages.product.edit', compact('product', 'category', 'brand', 'size', 'items', 'notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'size_id' => 'required|exists:sizes,id',
            'price'=> 'required|numeric',
            'weight' => 'required|numeric',
            'qty' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpeg,jpg,webp|max:2048',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $filename = $product->image;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::slug($request->title) . '-' . rand(0,99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/products', $filename);

                if ($product->image) {
                    File::delete(storage_path('app/public/products/' . $product->image));
                }
            }

            $product->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'size_id' => $request->size_id,
                'price' => $request->price,
                'weight' => $request->weight,
                'qty' => $request->qty,
                'image' => $filename,
                'summary' => $request->summary,
                'description' => $request->description,
                'status' => $request->status
            ]);

            DB::commit();

            Alert::toast('Produk Berhasil Diupdate', 'Success');
            return redirect(route('product.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Mengupdate Produk', 'Error');
            return redirect(route('product.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);
            File::delete(storage_path('app/public/products/' . $product->image));
            $product->delete();

            Alert::toast('Produk Berhasil Dihapus', 'Success');
            return redirect(route('product.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menghapus Produk', 'Error');
            return redirect(route('product.index'));
        }
    }
}
