<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);


// Auth Routes (Login, Register, Logout)
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk halaman dashboard yang hanya bisa diakses setelah login
Route::get('dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

    // Routes UploadController
    Route::get('/user','UserController@index')->name('user'); 
    Route::get('upload', [UploadController::class, 'index'])->name('upload.index');
    Route::get('upload/create', [UploadController::class, 'create'])->name('upload.create');
    Route::post('upload', [UploadController::class, 'store'])->name('upload.store');
    Route::get('upload/{upload}', [UploadController::class, 'edit'])->name('upload.edit');
    Route::put('upload/{upload}', [UploadController::class, 'update'])->name('upload.update');
    Route::delete('upload/{upload}', [UploadController::class, 'destroy'])->name('upload.destroy');
    Route::get('upload/{upload}/show', [UploadController::class, 'show'])->name('upload.show');
    use App\Http\Controllers\ProfilController;

    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/user', function () {
        return view('user');
    })->name('user.profile');
    

    // Routes SiswaController
    Route::get('siswas', [SiswaController::class, 'index'])->name('siswas.index');
    Route::get('siswas/create', [SiswaController::class, 'create'])->name('siswas.create');
    Route::post('siswas', [SiswaController::class, 'store'])->name('siswas.store');
    Route::get('siswas/{siswa}', [SiswaController::class, 'show'])->name('siswas.show');
    Route::get('siswas/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswas.edit');
    Route::put('siswas/{siswa}', [SiswaController::class, 'update'])->name('siswas.update');
    Route::delete('siswas/{siswa}', [SiswaController::class, 'destroy'])->name('siswas.destroy');
    Route::patch('siswas/{siswa}/update-photo', [SiswaController::class, 'updatePhoto'])->name('siswas.updatePhoto');

Route::get('/api/user', function () {
    // Closure logic here

});
Route::get('/api/user', 'UserController@index');

// Routes untuk **Admin**
    Route::get('/home', 'HomeController@index')->name('home');
      // Routes PenilaianController (hanya admin yang bisa mengakses)
 
    Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('penilaian/{penilaian}', [PenilaianController::class, 'show'])->name('penilaian.show');
    Route::get('penilaian/{penilaian}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('penilaian/{penilaian}', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::delete('penilaian/{penilaian}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');
    Route::get('/cetakpenilaian', 'penilaianController@cetakpenilaian')->name('cetakpenilaian');
Route::get('/cetak-data-penilaian-form', 'penilaianController@cetakform')->name('cetak-data-penilaian-form');
Route::get('/cetak-penilaian-pertanggal', 'penilaianController@cetakpenilaianPertanggal')->name('cetak-data-penilaian-pertanggal');




    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');



// Routes untuk halaman welcome
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');





// Route untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route untuk register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/user', function () {
        return view('user');
    })->name('user');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin');

    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard');
    })->middleware('role:petugas');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/user', function () {
    return view('user'); // Halaman untuk user
})->middleware('auth');


use App\Http\Controllers\PetugasController;

Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
Route::get('/petugas/{petugas}/edit', [PetugasController::class, 'edit'])->name('petugas.edit');
Route::put('/petugas/{petugas}', [PetugasController::class, 'update'])->name('petugas.update');
Route::delete('/petugas/{petugas}', [PetugasController::class, 'destroy'])->name('petugas.destroy');



use App\Http\Controllers\LaporanController;

Route::get('/Laporan', [LaporanController::class, 'index']);
Route::get('/Laporan/pdf', [LaporanController::class, 'PDF']);
Route::get('/laporan/cetak', [LaporanController::class, 'PDF'])->name('laporan.cetak');


Route::get('/dashboard/admin', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard.admin');

Route::get('/dashboard/user', function () {
    return view('user');
})->middleware(['auth'])->name('dashboard.user');

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->role == 'admin' || $user->role == 'petugas') {
        return redirect()->route('dashboard.admin');
    } else {
        return redirect()->route('dashboard.user');
    }
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/data', function () {
    return response()->json([
        'totalPengajuan' => \App\Models\Pengajuan::count(),
        'totalPenilaian' => \App\Models\Penilaian::count(),
    ]);
});

Route::get('/visitor-count', function () {
    return response()->json(['count' => \App\Models\Visitor::count()]);
});




Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
