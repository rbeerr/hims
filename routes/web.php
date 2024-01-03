<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ManageAccount;
use App\Http\Controllers\EmployeeReportController;
use App\Http\Controllers\ClientDashboardController;

use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\EmployeeDashboardController2;
use App\Http\Controllers\EmployeeDashboardController3;
use App\Http\Controllers\EmployeeDashboardController4;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

// to restrict any user accessing the register
Route::get('/register', function () {
    abort(403, 'Unauthorized action.');
})->name('register');

// for client dashboard
Route::get('/client-dashboard', function () {
    return view('client.client-dashboard');
})->name('client.dashboard');

Route::get('/logout-manual', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout.manual');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/redirects', 'App\Http\Controllers\HomeController@index');

    Route::middleware(['auth', 'admin'])->get('/manage-account', ManageAccount::class)->name('manage-account');
    Route::middleware(['auth', 'employee'])->get('/employee-table', function () {
        return view('employee.employee-table');
    })->name('employee.table-selection');

    // Queue 1
    Route::middleware(['auth', 'employee'])->get('/employee-dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.employee-dashboard');
    Route::post('/get-number', [EmployeeDashboardController::class, 'getNumber'])->name('get-number');
    Route::post('/reset-number', [EmployeeDashboardController::class, 'resetNumber'])->name('reset-number');
    Route::post('/recall-number', [EmployeeDashboardController::class, 'recallNumber'])->name('recall-number');
    Route::post('/reset-recall-number', [EmployeeDashboardController::class, 'resetRecallNumber'])->name('reset-recall-number');

    // Queue 2
    Route::middleware(['auth', 'employee'])->get('/employee-dashboard-2', [EmployeeDashboardController2::class, 'index'])->name('employee.employee-dashboard-2');
    Route::post('/get-number-2', [EmployeeDashboardController2::class, 'getNumber2'])->name('get-number-2');
    Route::post('/reset-number-2', [EmployeeDashboardController2::class, 'resetNumber2'])->name('reset-number-2');
    Route::post('/recall-number-2', [EmployeeDashboardController2::class, 'recallNumber2'])->name('recall-number-2');
    Route::post('/reset-recall-number-2', [EmployeeDashboardController2::class, 'resetRecallNumber2'])->name('reset-recall-number-2');

    // Queue 3
    Route::middleware(['auth', 'employee'])->get('/employee-dashboard-3', [EmployeeDashboardController3::class, 'index'])->name('employee.employee-dashboard-3');
    Route::post('/get-number-3', [EmployeeDashboardController3::class, 'getNumber3'])->name('get-number-3');
    Route::post('/reset-number-3', [EmployeeDashboardController3::class, 'resetNumber3'])->name('reset-number-3');
    Route::post('/recall-number-3', [EmployeeDashboardController3::class, 'recallNumber3'])->name('recall-number-3');
    Route::post('/reset-recall-number-3', [EmployeeDashboardController3::class, 'resetRecallNumber3'])->name('reset-recall-number-3');

    // Queue 4
    Route::middleware(['auth', 'employee'])->get('/employee-dashboard-4', [EmployeeDashboardController4::class, 'index'])->name('employee.employee-dashboard-4');
    Route::post('/get-number-4', [EmployeeDashboardController4::class, 'getNumber4'])->name('get-number-4');
    Route::post('/reset-number-4', [EmployeeDashboardController4::class, 'resetNumber4'])->name('reset-number-4');
    Route::post('/recall-number-4', [EmployeeDashboardController4::class, 'recallNumber4'])->name('recall-number-4');
    Route::post('/reset-recall-number-4', [EmployeeDashboardController4::class, 'resetRecallNumber4'])->name('reset-recall-number-4');

    // Employee Report
    Route::middleware(['auth', 'employee'])->get('/employee-report', [EmployeeReportController::class, 'index'])->name('employee.report');

    // Employee Dashboard - Table 1
    Route::post('/store-service-type', [EmployeeDashboardController::class, 'storeServiceType'])->name('store.service.type');

    // Employee Dashboard - Table 2
    Route::post('/store-service-type-2', [EmployeeDashboardController2::class, 'storeServiceType2'])->name('store.service.type.2');

    // Employee Dashboard - Table 3
    Route::post('/store-service-type-3', [EmployeeDashboardController3::class, 'storeServiceType3'])->name('store.service.type.3');

    // Employee Dashboard - Table 3
    Route::post('/store-service-type-4', [EmployeeDashboardController4::class, 'storeServiceType4'])->name('store.service.type.4');

    Route::get('/employee-reports', [EmployeeReportController::class, 'index'])->name('employee.report.index');
    Route::post('/generate-report', [EmployeeReportController::class, 'generateReport'])->name('generate-report');
    Route::match(['get', 'post'], '/generate-report', [EmployeeReportController::class, 'generateReport'])->name('generate-report');

    // Route::post('/employee-reports/fetch', 'EmployeeReportController@fetchReports')->name('employee-reports.fetch');

    // Client Side
    Route::get('/client-dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
});
