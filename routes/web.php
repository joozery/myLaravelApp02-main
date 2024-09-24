<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\WithdrawController; // เพิ่ม Controller สำหรับการเบิกของ

// หน้าเริ่มต้นไปที่หน้าลงทะเบียน
Route::get('/', function () {
    return view('login');
});

// กลุ่มเส้นทางที่ไม่ต้องเข้าสู่ระบบ (สำหรับผู้ใช้ guest)
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
});

// กลุ่มเส้นทางที่ต้องเข้าสู่ระบบ (สำหรับผู้ใช้ที่เข้าสู่ระบบแล้ว)
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // การจัดการอะไหล่
    Route::get('/spare-parts/create', [SparePartController::class, 'create'])->name('spare_parts.create');
    Route::post('/spare-parts', [SparePartController::class, 'store'])->name('spare_parts.store');
    Route::get('/spare-parts', [SparePartController::class, 'index'])->name('spare_parts.index');
    Route::get('/spare-parts/{id}/edit', [SparePartController::class, 'edit'])->name('spare_parts.edit'); // แก้ไขจาก /spare_parts/{id}/edit เป็น /spare-parts/{id}/edit
    Route::put('/spare-parts/{id}', [SparePartController::class, 'update'])->name('spare_parts.update'); // แก้ไขจาก /spare_parts/{id} เป็น /spare-parts/{id}
    Route::delete('/spare-parts/{id}', [SparePartController::class, 'destroy'])->name('spare_parts.destroy');

    // เส้นทาง homep
    Route::get('/homep', [SparePartController::class, 'homep'])->name('homep');

    // ฟอร์มการเบิกของจากคลังอู่
    Route::get('/withdraw-form', [WithdrawController::class, 'create'])->name('withdraw_form');

    // ประวัติการเบิกของและการดู PDF
    Route::get('/withdraw-history', [WithdrawController::class, 'index'])->name('withdraw_history');

    // เส้นทางสำหรับเก็บข้อมูลการเบิก
    Route::post('/withdraw', [WithdrawController::class, 'store'])->name('withdraw.store');

    //สำหรับการดาวน์โหลด PDF 
    Route::get('/withdraw-pdf/{id}', [WithdrawController::class, 'downloadPDF'])->name('withdraw.pdf');
});
