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

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/picture', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('auth', [AuthController::class, 'index'])->name('auth');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');



