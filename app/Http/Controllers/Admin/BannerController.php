<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Services\NotificationService;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::orderBy('id', 'ASC')->paginate(10);
        $notifications = NotificationService::getNotifications();
        return view('admin.pages.banner.index', compact('banner', 'notifications'));
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
    public function store(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string',
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
                $file->storeAs('public/banners', $filename);
            }

            $banner->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'image' => $filename,
                'summary' => $request->summary,
                'description' => $request->description,
                'status' => $request->status
            ]);

            DB::commit();

            Alert::toast('Banner Berhasil Ditambah', 'Success');
            return redirect(route('banner.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Banner', 'Error');
            return redirect(route('banner.index'));
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
        $banner = Banner::findOrFail($id);
        $notifications = NotificationService::getNotifications();
        return view('admin.pages.banner.edit', compact('banner', 'notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpeg,jpg,webp|max:2048',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $banner = Banner::findOrFail($id);
            $filename = $banner->image;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::slug($request->title) . '-' . rand(0,99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/banners', $filename);

                if ($banner->image) {
                    File::delete(storage_path('app/public/banners/' . $banner->image));
                }
            }

            $banner->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'image' => $filename,
                'summary' => $request->summary,
                'description' => $request->description,
                'status' => $request->status
            ]);

            DB::commit();

            Alert::toast('Banner Berhasil Diupdate', 'Success');
            return redirect(route('banner.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Mengupdate Banner', 'Error');
            return redirect(route('banner.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $banner = Banner::find($id);
            File::delete(storage_path('app/public/banners/' . $banner->image));
            $banner->delete();

            Alert::toast('Banner Berhasil Dihapus', 'Success');
            return redirect(route('banner.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menghapus Banner', 'Error');
            return redirect(route('banner.index'));
        }
    }
}
