<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan formulir edit profil.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Perbarui gambar profil pengguna.
     */
    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $file = $request->file('profile_picture');

        // Hapus file lama
        $this->deleteProfilePictureFile($user);

        // Generate nama file aman
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . uniqid() . '.' . $extension;

        // Simpan file
        $path = $file->storeAs('profile_pictures', $fileName, 'public');

        // Update DB
        $user->profile_picture = $path;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile picture updated successfully!');
    }

    /**
     * Tampilkan profil pengguna (ganti nama agar tidak bentrok dengan controller lain).
     */
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile.show', compact('user'));
    }

    /**
     * Hapus gambar profil.
     */
    public function destroy()
    {
        $user = Auth::user();

        $this->deleteProfilePictureFile($user);

        $user->profile_picture = null;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile picture deleted successfully!');
    }

    /**
     * Helper untuk menghapus file.
     */
    protected function deleteProfilePictureFile(User $user)
    {
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }
    }
}
