<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function editProfile()
{
    $user = Auth::user();
    return view('edit', compact('user'));
}

public function showEditForm()
{
    $user = Auth::user();
    return view('edit-profile', compact('user')); // Ini diarahkan ke file edit-profile.blade.php
}


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'nik' => 'required|digits:16',
            'no_kk' => 'required|digits:16',
            'phone' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = User::find(Auth::id());

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->no_kk = $request->no_kk;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');

    }
}
