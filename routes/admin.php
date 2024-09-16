<?php

use App\Http\Livewire\Admin\CompanyManagement\StudentCompanyRegistration;
use App\Livewire\Admin\ApplicationManagement;
use App\Livewire\Admin\CompanyManagement;
use App\Livewire\Admin\CompanyRegistrationManagement;
use App\Livewire\Admin\CompanyReviewManagement;
use App\Livewire\Admin\CompetitorManagement;
use App\Livewire\Admin\ConvocatoriaManagement;
use App\Livewire\Admin\CriteriaManagement;
use App\Livewire\Admin\EvaluationManagement;
use App\Livewire\Admin\HoursRecordManagement;
use App\Livewire\Admin\InductionManagement;
use App\Livewire\Admin\RoleManagement;


use App\Livewire\Admin\UserInductionManagement;

use App\Livewire\Admin\CoordiManagement;

use App\Livewire\Admin\StudentCompanyManagement;
use App\Livewire\Admin\StudentManagement;
use App\Livewire\Admin\UserManagement;
use App\Livewire\Admin\WorkHoursManagement;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Route;


Route::get('/users', UserManagement::class)->name('users');

Route::get('/roles', RoleManagement::class)->name('roles');
Route::get('/coordis',CoordiManagement::class)->name('coordis');
Route::get('/voting-result',[CoordiManagement::class,'generateReport'])->name('voting-result');

Route::get('/inductions',InductionManagement::class)->middleware('can:Ver dashboard')->name('inductions');
Route::get('/competitors',CompetitorManagement::class)->middleware('can:Ver dashboard')->name('competitors');
Route::get('/evaluation',EvaluationManagement::class)->middleware('can:Ver dashboard')->name('evaluation');
Route::get('/userinduction',UserInductionManagement::class)->middleware('can:Listar empresas')->name('userinduction');
//Route::get('/voting-result',[ResulMain::class,'generateReport'])->name('voting-result');
//Route::get('/voting-result',[ResulMain::class,'generateReport'])->name('voting-result');
Route::get('/criterias',CriteriaManagement::class)->middleware('can:Ver dashboard')->name('criterias');
Route::get('/voting-result2',[CoordiManagement::class,'generateReport2'])->name('voting-result2');


//otras rutas
Route::get('/companies', CompanyManagement::class)->name('companies');
Route::get('/applications', ApplicationManagement::class)->name('applications');
Route::get('/students', StudentManagement::class)->name('students');
Route::get('/convocatorias', ConvocatoriaManagement::class)->name('convocatorias');

Route::get('/company-registrations', CompanyRegistrationManagement::class)->name('company-registrations');

//ruta
Route::get('/student-company', StudentCompanyManagement::class)->name('student-company');
Route::get('/company-review', CompanyReviewManagement::class)->name('company-review');
//Route::get('/hours-record', HoursRecordManagement::class)->name('hours-record');
Route::get('/work-hours', WorkHoursManagement::class)->name('work-hours');
