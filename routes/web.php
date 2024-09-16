<?php

use App\Http\Controllers\DropdownController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ConvocatoriaController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\NotificationController;
use App\Http\Livewire\StudentCompanyRegistration;


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

Route::view('/', 'welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/voting-result',[ResulMain::class,'generateReport'])->name('voting-result');
Route::get('/results',[ResulMain::class])->name('results');
Route::view('/pppwelcome', 'pppwelcome')->name('pppwelcome');

// Route::view('/student-company', 'student-company')->name('student-company');


// Ruta de Livewire para el registro de la empresa
// Route::get('/companies/register', StudentCompanyRegistration::class)->name('companies.register');
// web.php
Route::post('/notifications/{id}/markAsRead', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
