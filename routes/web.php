<?php


use Illuminate\Http\Request;
use App\Models\DataKaryawan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataKaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataDivisiController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\PembagianShiftController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\DataKehadiranController;
use App\Http\Controllers\data\DataJabatanController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\RekapAbsensiController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Autentikasi
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);




// Route untuk menampilkan form absensi
Route::get('/kehadiran', function () {
    return view('absen.kehadiran');
})->name('kehadiran.form');

// Route untuk mencatat absensi masuk/keluar
Route::post('/absen/store', [AbsenController::class, 'store'])->name('absen.store');

Route::get('/absen/kehadiran', [AbsenController::class, 'showKehadiran'])->name('absen.kehadiran');
Route::get('/absen/konfirmasi-keluar', [AbsenController::class, 'showKonfirmasiKeluarForm'])->name('absen.konfirmasi-keluar');
Route::post('/absen/konfirmasi_keluar', [AbsenController::class, 'konfirmasiKeluar'])->name('absen.konfirmasi_keluar');

// Menampilkan form konfirmasi izin
Route::get('/absen/konformasi-izin', [AbsenController::class, 'inputIzin'])->name('absen.konfirmasi_izin');
Route::post('/absen/proses-izin', [AbsenController::class, 'prosesIzin'])->name('absen.proses_izin');

Route::get('',function () {
    return view('/dashboard');
})->middleware('auth');

// Hanya Admin (gunakan middleware role dan auth)
Route::get('/admin', function () {
    return view('/dashboard');
})->middleware(['auth', 'role:admin']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// // Dashboard menggunakan controller (untuk pengguna yang sudah login)
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.controller')->middleware('auth');


// Pencarian Karyawan (gunakan middleware auth)
Route::get('/search-karyawan', function (Request $request) {
    $query = $request->input('query');
    $karyawans = DataKaryawan::where('nama', 'LIKE', '%' . $query . '%')->get(['id_karyawan', 'nama']);
    return response()->json($karyawans);
})->middleware('auth');

// Data Karyawan (gunakan middleware auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/datakaryawan/{id_karyawan}/edit', [DataKaryawanController::class, 'edit'])->name('datakaryawan.edit');
    Route::put('/datakaryawan/{id_karyawan}', [DataKaryawanController::class, 'update'])->name('datakaryawan.update');
    Route::get('/datakaryawan/{id_karyawan}', [DataKaryawanController::class, 'show'])->name('datakaryawan.show');
});

// Absen Karyawan (gunakan middleware auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/absen_karyawan/izin', [AbsensiIzinController::class, 'create'])->name('absen_karyawan.create');
    Route::post('/absen_karyawan/izin', [AbsensiIzinController::class, 'store'])->name('absen_karyawan.store_izin');
    Route::post('/absen_karyawan/handle_action', [AbsensiController::class, 'handleAction'])->name('absen_karyawan.handle_action');
    Route::get('/absen_karyawan/form', [AbsensiController::class, 'create'])->name('absen_karyawan.form');
    Route::post('/absen_karyawan/store', [AbsensiController::class, 'store'])->name('absen_karyawan.store');
});

// Pembagian Shift (gunakan middleware auth)
Route::middleware(['auth'])->group(function () {
    Route::post('/pembagian-shift/update-all', [PembagianShiftController::class, 'updateAll'])->name('pembagian_shift.update_all');
});

// Resources (gunakan middleware auth)

Route::middleware(['auth'])->group(function () {

    Route::resource('rekap_absensi', RekapAbsensiController::class);
    Route::resource('data_jabatan', DataJabatanController::class);
    Route::resource('data_kehadiran', DataKehadiranController::class);
    Route::resource('users', UserController::class);
    Route::resource('pembagian_shift', PembagianShiftController::class);
    Route::resource('karyawan', DataKaryawanController::class);
    Route::resource('absensi', AbsensiController::class);
    Route::resource('shifts', ShiftController::class);
    Route::resource('divisi', DataDivisiController::class);
    Route::resource('history_absensi', HistoryAbsensiController::class);
});
