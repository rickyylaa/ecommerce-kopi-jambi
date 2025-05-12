<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::with(['parent'])->orderBy('id', 'ASC')->paginate(10);
        $parent = Category::getParent()->orderBy('title', 'ASC')->get();

        $notifications = NotificationService::getNotifications();
        return view('admin.pages.category.index', compact('category', 'parent', 'notifications'));
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50|unique:categories',
            'description' => 'required|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $request->request->add(['slug' => $request->title]);
            Category::create($request->except('_token'));

            DB::commit();

            Alert::toast('Kategori Berhasil Ditambah', 'Success');
            return redirect(route('category.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Kategori', 'Error');
            return redirect(route('category.index'));
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
        $category = Category::findOrFail($id);
        $parent = Category::getParent()->orderBy('title', 'ASC')->get();

        $notifications = NotificationService::getNotifications();
        return view('admin.pages.category.edit', compact('category', 'parent', 'notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50|unique:categories,title,' . $id,
            'description' => 'required|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'parent_id' => $request->parent_id,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            DB::commit();

            Alert::toast('Kategori Berhasil Diupdate', 'Success');
            return redirect(route('category.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Mengupdate Kategori', 'Error');
            return redirect(route('category.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::withCount(['child', 'product'])->find($id);
        if ($category->child_count == 0 && $category->product_count == 0) {
            $category->delete();

            Alert::toast('Kategori Berhasil Dihapus', 'Success');
            return redirect(route('category.index'));
        }

        Alert::toast('Error Saat Menghapus Kategori', 'Error');
        return redirect(route('category.index'));
    }
}
