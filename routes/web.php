<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin/cycles', [HomeController::class, 'cycles'])->name('admin.cycles.index');
Route::get('/admin/cycles/order', [HomeController::class, 'orderCycles'])->name('admin.cycles.order');

Route::get('/admin/levels', [HomeController::class, 'levels'])->name('admin.levels.index');
Route::get('/admin/levels/order', [HomeController::class, 'orderLevels'])->name('admin.levels.order');

Route::get('/admin/grades', [HomeController::class, 'grades'])->name('admin.grades.index');
Route::get('/admin/grades/order', [HomeController::class, 'orderGrades'])->name('admin.grades.order');

Route::get('/admin/sections', [HomeController::class, 'sections'])->name('admin.sections.index');
Route::get('/admin/sections/order', [HomeController::class, 'orderSections'])->name('admin.sections.order');

Route::get('/admin/classroom', [HomeController::class, 'classroom'])->name('admin.classroom.index');

Route::get('/admin/students', [HomeController::class, 'students'])->name('admin.students.index');
Route::get('/admin/students/show', [HomeController::class, 'showStudents'])->name('admin.students.show');

Route::get('/admin/users', [HomeController::class, 'users'])->name('admin.users.index');

Route::get('/admin/activities', [HomeController::class, 'activities'])->name('admin.activities.index');
Route::get('/admin/activities/show/{activity}', [HomeController::class, 'show'])->name('admin.activities.show');
Route::get('/admin/activities/work', [HomeController::class, 'work'])->name('admin.activities.work');
Route::get('/admin/activities/register/{activity}', [HomeController::class, 'register'])->name('admin.activities.register');
Route::get('/admin/activities/students/{activity}', [HomeController::class, 'studentsList'])->name('admin.activities.students');
Route::get('/admin/activities/attendance/{activity}', [HomeController::class, 'attendance'])->name('admin.activities.attendance');

Route::post('/admin/activities/enrollment', [HomeController::class, 'enrollment'])->name('admin.activities.enrollment');
Route::post('/admin/activities/registerAttendance', [HomeController::class, 'registerAttendance'])->name('admin.activities.registerAttendance');




Route::get('/admin/qr/index', [HomeController::class, 'qrgenerator'])->name('admin.qr.index');
Route::get('/admin/qr/scan-qr', [HomeController::class, 'scanQr'])->name('admin.qr.scan-qr');
