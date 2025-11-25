<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MultipleuploadsController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

 Route::get('/', function () {
     return view('admin.dashboard');
 });

Route::get('/home', [HomeController::class, 'index'])
            ->name('home');

Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('pelanggan', PelangganController::class);
Route::resource('user', UserController::class);
Route::resource('auth', AuthController::class);
Route::resource('dashboard', DashboardController::class);

Route::resource('multipleuploads', MultipleuploadsController::class)
    ->names([
        'index' => 'uploads', // Opsional: Tambahkan penamaan agar sesuai dengan yang Anda inginkan
        'store' => 'uploads.store',
        // Tambahkan nama-nama lain jika Anda ingin menyesuaikan
    ]);
// routes/web.php

// 1. Tampilkan detail profil (GET /profile)
// Mengganti /profile/show menjadi /profile
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

// 2. Tampilkan formulir edit (GET /profile/edit)
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// 3. Proses pembaruan profil (PUT /profile/edit)
// Disarankan menggunakan /profile/edit untuk update jika show berada di /profile
Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

// 4. Hapus gambar profil (DELETE /profile/picture)
Route::delete('/profile/picture', [ProfileController::class, 'destroy'])->name('profile.destroy');


