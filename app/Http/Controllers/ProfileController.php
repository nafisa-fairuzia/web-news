<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user(); // ✅ ini Eloquent Model
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
         /** @var \App\Models\User $user */
        $user = Auth::user(); 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save(); // ✅ sekarang bisa
        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateAvatar(Request $request)
    {
         /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        
        $user->save(); // ✅ juga bisa
        return back()->with('success', 'Foto profil berhasil diubah.');
    }

    public function updatePassword(Request $request)
    {
         /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $user->password = $request->password; // otomatis di-hash via mutator
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
