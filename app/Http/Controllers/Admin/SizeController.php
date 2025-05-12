<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use RealRashid\SweetAlert\Facades\Alert;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $size = Size::orderBy('id', 'ASC')->paginate(10);

        $notifications = NotificationService::getNotifications();
        return view('admin.pages.size.index', compact('size', 'notifications'));
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
    public function store(Request $request, Size $size)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $size->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'status' => $request->status
            ]);

            DB::commit();

            Alert::toast('Size Berhasil Ditambah', 'Success');
            return redirect(route('size.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Size', 'Error');
            return redirect(route('size.index'));
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
        $size = Size::findOrFail($id);

        $notifications = NotificationService::getNotifications();
        return view('admin.pages.size.edit', compact('size', 'notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();

            $size = Size::findOrFail($id);
            $size->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'status' => $request->status
            ]);

            DB::commit();

            Alert::toast('Size Berhasil Diupdate', 'Success');
            return redirect(route('size.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Size', 'Error');
            return redirect(route('size.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $size = Size::find($id);
            $size->delete();

            Alert::toast('Size Berhasil Dihapus', 'Success');
            return redirect(route('size.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menghapus Size', 'Error');
            return redirect(route('size.index'));
        }
    }
}
