<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Services\NotificationService;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $notifications = NotificationService::getNotifications();
        return view('admin.pages.profile.index', compact('user', 'notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'username' => 'required|string|min:2|max:100',
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|unique:users,email, ' . $id . ',id',
            'image' => 'nullable|image|mimes:png,jpeg,jpg,webp,gif',
        ]);

        try {
            DB::beginTransaction();

            $user = User::find($id);
            $filename = $user->image;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::slug($request->username) . '-' . rand(0,99999) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/profiles', $filename);

                if ($user->image) {
                    File::delete(storage_path('app/public/profiles/' . $user->image));
                }
            }

            $user->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'image' => $filename
            ]);

            DB::commit();

            Alert::toast('Profil Berhasil Diupdate', 'Success');
            return redirect(route('profile.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Error Saat Menambah Profil', 'Error');
            return redirect(route('profile.index'));
        }
    }
}
