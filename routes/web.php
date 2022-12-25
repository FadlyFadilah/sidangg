<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\NilaiController as AdminNilaiController;
use App\Http\Controllers\Admin\OrangtuaController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SkpiController;
use App\Http\Controllers\Admin\SyaratController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\MahasiswaController as UserMahasiswaController;
use App\Http\Controllers\User\OrangtuaController as UserOrangtuaController;
use App\Http\Controllers\User\SyaratController as UserSyaratController;
use App\Http\Controllers\User\PembimbingController as UserPembimbingController;
use App\Http\Controllers\Dosen\PembimbingController as DosenPembimbingController;
use App\Http\Controllers\Dosen\NilaiController;
use App\Http\Controllers\User\PengujiController as UserPengujiController;
use App\Http\Controllers\Dosen\PengujiController as DosenPengujiController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SkpiController as UserSkpiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

    // Mahasiswa
    Route::delete('mahasiswas/destroy', [MahasiswaController::class, 'massDestroy'])->name('mahasiswas.massDestroy');
    Route::resource('mahasiswas', MahasiswaController::class);

    // Orangtua
    Route::delete('orangtuas/destroy', [OrangtuaController::class, 'massDestroy'])->name('orangtuas.massDestroy');
    Route::resource('orangtuas', OrangtuaController::class);

    // Syarat
    Route::delete('syarats/destroy', [SyaratController::class, 'massDestroy'])->name('syarats.massDestroy');
    Route::resource('syarats', SyaratController::class)->except('update');
    Route::post('syarats', [SyaratController::class, 'index'])->name('syarats.indexx');
    Route::patch('syarats/update/{syarat}', [SyaratController::class, 'update'])->name('syarats.update');
    
    // Skpi
    Route::delete('skpis/destroy', [SkpiController::class, 'massDestroy'])->name('skpis.massDestroy');
    Route::post('skpis/media', [SkpiController::class ,'storeMedia'])->name('skpis.storeMedia');
    Route::post('skpis/ckmedia', [SkpiController::class ,'storeCKEditorImages'])->name('skpis.storeCKEditorImages');
    Route::resource('skpis', SkpiController::class);

    Route::resource('nilais', AdminNilaiController::class);

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
    }
});
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth']], function () {
    Route::get('/', [UserHomeController::class, 'index'])->name('home');
    // Mahasiswa
    Route::delete('mahasiswas/destroy', [UserMahasiswaController::class, 'massDestroy'])->name('mahasiswas.massDestroy');
    Route::resource('mahasiswas', UserMahasiswaController::class);

    // Orangtua
    Route::delete('orangtuas/destroy', [UserOrangtuaController::class, 'massDestroy'])->name('orangtuas.massDestroy');
    Route::resource('orangtuas', UserOrangtuaController::class);

    // Syarat
    Route::delete('syarats/destroy', [UserSyaratController::class, 'massDestroy'])->name('syarats.massDestroy');
    Route::resource('syarats', UserSyaratController::class)->except('update');
    
    Route::resource('pembimbings', UserPembimbingController::class);
    Route::resource('pengujis', UserPengujiController::class);

    // Skpi
    Route::delete('skpis/destroy', [UserSkpiController::class ,'massDestroy'])->name('skpis.massDestroy');
    Route::post('skpis/media', [UserSkpiController::class ,'storeMedia'])->name('skpis.storeMedia');
    Route::post('skpis/ckmedia', [UserSkpiController::class ,'storeCKEditorImages'])->name('skpis.storeCKEditorImages');
    Route::resource('skpis', UserSkpiController::class);
    
    Route::get('user/profile', [ProfileController::class ,'index'])->name('profile.index');
    Route::post('user/profile', [ProfileController::class ,'update'])->name('profile.update');
    Route::post('user/profile/destroy', [ProfileController::class ,'destroy'])->name('profile.destroy');
    Route::post('user/profile/password', [ProfileController::class ,'password'])->name('profile.password');
});

Route::group(['prefix' => 'dosen', 'as' => 'dosen.', 'middleware' => ['auth']], function () {
    Route::get('/', [UserHomeController::class, 'index'])->name('home');
    // Mahasiswa
    Route::delete('mahasiswas/destroy', [UserMahasiswaController::class, 'massDestroy'])->name('mahasiswas.massDestroy');
    Route::resource('mahasiswas', UserMahasiswaController::class);

    // Orangtua
    Route::delete('orangtuas/destroy', [UserOrangtuaController::class, 'massDestroy'])->name('orangtuas.massDestroy');
    Route::resource('orangtuas', UserOrangtuaController::class);

    // Syarat
    Route::delete('syarats/destroy', [UserSyaratController::class, 'massDestroy'])->name('syarats.massDestroy');
    Route::resource('syarats', UserSyaratController::class)->except('update');
    
    Route::resource('pembimbings', DosenPembimbingController::class);
    Route::resource('pengujis', DosenPengujiController::class);

    // Nilai
    Route::resource('nilais', NilaiController::class);
    
    Route::get('user/profile', [ProfileController::class ,'index'])->name('profile.index');
    Route::post('user/profile', [ProfileController::class ,'update'])->name('profile.update');
    Route::post('user/profile/destroy', [ProfileController::class ,'destroy'])->name('profile.destroy');
    Route::post('user/profile/password', [ProfileController::class ,'password'])->name('profile.password');
});