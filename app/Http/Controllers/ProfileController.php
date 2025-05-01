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


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'nik' => 'required|digits:16',
            'no_kk' => 'required|digits:16',
            'phone' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
            'jumlah_LK' => 'required|numeric',
            'jumlah_PR' => 'required|numeric',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo'] = $path; // tambahkan ke array validated
        }

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

}