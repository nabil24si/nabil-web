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
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Perbarui gambar profil pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $file = $request->file('profile_picture');

        // 1. Panggil fungsi pembantu untuk menghapus file lama
        $this->deleteProfilePictureFile($user);

        // 2. Tentukan nama file yang unik dan aman
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . uniqid() . '.' . $extension;

        // 3. Simpan file baru menggunakan storeAs()
        $path = $file->storeAs('profile_pictures', $fileName, 'public');

        // 4. Perbarui Model
        $user->profile_picture = $path;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile picture updated successfully!');
    }

    /**
     * Tampilkan profil pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        // Memastikan $user diteruskan, yang sudah Anda lakukan sebelumnya
        return view('admin.profile.show', compact('user'));
    }

    /**
     * Hapus gambar profil pengguna.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $user = Auth::user();

        // 1. Panggil fungsi pembantu untuk menghapus file
        $this->deleteProfilePictureFile($user);

        // 2. Reset kolom database
        $user->profile_picture = null;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile picture deleted successfully!');
    }

    /**
     * Fungsi pembantu untuk menghapus file gambar profil lama.
     * Menggunakan pengecekan eksistensi file sebelum menghapus.
     *
     * @param \App\Models\User $user
     * @return void
     */
    protected function deleteProfilePictureFile(User $user)
    {
        if ($user->profile_picture) {
            // Pengecekan keamanan: Pastikan file benar-benar ada sebelum mencoba menghapus
            if (Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
        }
    }
}
