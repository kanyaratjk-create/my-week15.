<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\HomeController;
//นักอ่าน
Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('detail/{id}', [BlogController::class, 'detail'])->name('blog.detail');

Route::get('/about', function () {
    return view('about', [
        'name' => 'นางสาวกัญญารัตน์ จุ้ยกลาง',
        'date' => '26 พฤษภาคม 2547',
    ]);
})->name('about');
//นักเขียน
Route::get('/blog', [BlogController::class, 'index'])->name('author.blog');

Route::get('/blog2', [AdminController::class, 'blogs'])->name('blog2');

Route::prefix('author')->name('author.')->group(function () {
    Route::get('/blog/manage', [BlogController::class, 'manage'])->name('blog.manage');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/{id}/update', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/blog/{id}/delete', [BlogController::class, 'delete'])->name('blog.delete');
    Route::get('/blog/{id}/status', [BlogController::class, 'changeStatus'])->name('blog.changeStatus');

    Route::get('/about2', [AdminController::class, 'abouts'])->name('about2');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/insert', [AdminController::class, 'insert'])->name('insert');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('delete');
    Route::get('/change/{id}', [AdminController::class, 'change'])->name('change');
});

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "เชื่อมต่อฐานข้อมูลสำเร็จ : " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "เชื่อมต่อฐานข้อมูลไม่สำเร็จ : " . $e->getMessage();
    }
});

Route::get('/student/{id}', function ($id) {
    return view('student', ['id' => $id]);
})->name('student.profile');

Route::get('/claim', [ClaimController::class, 'create'])->name('claim.create');
Route::post('/claim', [ClaimController::class, 'store'])->name('claim.store');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home.dashboard');

Route::fallback(function () {
    return 'ไม่พบหน้าเว็บ';
});