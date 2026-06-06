<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashBookController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\KhatibScheduleController;
use App\Http\Controllers\PengajianScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

// ─── Public Routes ───

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/laporan', [ReportController::class, 'public'])->name('reports.public');
Route::get('/laporan/bulanan', [ReportController::class, 'monthlyReport'])->name('reports.monthly');
Route::get('/laporan/kategori', [ReportController::class, 'categoryReport'])->name('reports.category');
Route::get('/jadwal-khatib', [KhatibScheduleController::class, 'public'])->name('schedules.khatib');
Route::get('/jadwal-pengajian', [PengajianScheduleController::class, 'public'])->name('schedules.pengajian');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

// ─── Auth Routes ───

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Admin Routes (protected by admin middleware) ───

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Cash Books
    Route::get('/buku-kas', [CashBookController::class, 'index'])->name('admin.cashbooks.index');
    Route::get('/buku-kas/create', [CashBookController::class, 'create'])->name('admin.cashbooks.create');
    Route::post('/buku-kas', [CashBookController::class, 'store'])->name('admin.cashbooks.store');
    Route::get('/buku-kas/{id}/edit', [CashBookController::class, 'edit'])->name('admin.cashbooks.edit');
    Route::put('/buku-kas/{id}', [CashBookController::class, 'update'])->name('admin.cashbooks.update');
    Route::delete('/buku-kas/{id}', [CashBookController::class, 'destroy'])->name('admin.cashbooks.destroy');

    // Transactions
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('admin.transactions.index');
    Route::get('/transaksi/create', [TransactionController::class, 'create'])->name('admin.transactions.create');
    Route::post('/transaksi', [TransactionController::class, 'store'])->name('admin.transactions.store');
    Route::get('/transaksi/{id}/edit', [TransactionController::class, 'edit'])->name('admin.transactions.edit');
    Route::put('/transaksi/{id}', [TransactionController::class, 'update'])->name('admin.transactions.update');
    Route::delete('/transaksi/{id}', [TransactionController::class, 'destroy'])->name('admin.transactions.destroy');

    // Categories
    Route::get('/kategori', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/kategori', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Khatib Schedules (admin)
    Route::get('/jadwal-khatib', [KhatibScheduleController::class, 'index'])->name('admin.schedules.khatib.index');
    Route::post('/jadwal-khatib', [KhatibScheduleController::class, 'store'])->name('admin.schedules.khatib.store');
    Route::put('/jadwal-khatib/{id}', [KhatibScheduleController::class, 'update'])->name('admin.schedules.khatib.update');
    Route::delete('/jadwal-khatib/{id}', [KhatibScheduleController::class, 'destroy'])->name('admin.schedules.khatib.destroy');

    // Pengajian Schedules (admin)
    Route::get('/jadwal-pengajian', [PengajianScheduleController::class, 'index'])->name('admin.schedules.pengajian.index');
    Route::post('/jadwal-pengajian', [PengajianScheduleController::class, 'store'])->name('admin.schedules.pengajian.store');
    Route::put('/jadwal-pengajian/{id}', [PengajianScheduleController::class, 'update'])->name('admin.schedules.pengajian.update');
    Route::delete('/jadwal-pengajian/{id}', [PengajianScheduleController::class, 'destroy'])->name('admin.schedules.pengajian.destroy');

    // SuperAdmin only
    Route::middleware('superadmin')->group(function () {
        Route::get('/pengguna', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/pengguna/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/pengguna', [UserController::class, 'store'])->name('admin.users.store');
        Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Profile
    Route::get('/profil', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::put('/profil', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.password');

    // Settings
    Route::get('/pengaturan', [\App\Http\Controllers\SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/pengaturan', [\App\Http\Controllers\SettingController::class, 'update'])->name('admin.settings.update');
});

