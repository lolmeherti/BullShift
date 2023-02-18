<?php

use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobDesignationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //ROUTES FOR PROFILE SETTINGS
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //ROUTES FOR CONTRACT TYPES
    Route::get('/contracts', [ContractTypeController::class, 'index'])->name('preparation.contracts.index');
    Route::get('/contract/create', [ContractTypeController::class, 'create'])->name('preparation.contracts.create');
    Route::post('/contract/store', [ContractTypeController::class, 'store'])->name('preparation.contracts.store');
    Route::get('/contract/{contract}/edit', [ContractTypeController::class, 'edit']);
    Route::post('/contract/{contract}/update', [ContractTypeController::class, 'update']);
    Route::post('/contract/delete', [ContractTypeController::class, 'destroy']);
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //ROUTES FOR JOB DESIGNATIONS
    Route::get('/designations', [JobDesignationController::class, 'index'])->name('preparation.designations.index');
    Route::get('/designation/create', [JobDesignationController::class, 'create'])->name('preparation.designations.create');
    Route::post('/designation/store', [JobDesignationController::class, 'store'])->name('preparation.designations.store');
    Route::get('/designation/{jobDesignation}/edit', [JobDesignationController::class, 'edit']);
    Route::post('/designation/{jobDesignation}/update', [JobDesignationController::class, 'update']);
    Route::post('/designation/delete', [JobDesignationController::class, 'destroy']);
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //ROUTES FOR DEPARTMENTS
    Route::get('/departments', [DepartmentController::class, 'index'])->name('preparation.departments.index');
    Route::get('/department/create', [DepartmentController::class, 'create'])->name('preparation.departments.create');
    Route::post('/department/store', [DepartmentController::class, 'store'])->name('preparation.departments.store');
    Route::get('/department/{department}/edit', [DepartmentController::class, 'edit']);
    Route::post('/department/{department}/update', [DepartmentController::class, 'update']);
    Route::post('/department/delete', [DepartmentController::class, 'destroy']);
    Route::post('/department/search/manager', [DepartmentController::class, 'searchManager'])->name('department.search.manager');
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //example route for img upload
    Route::post('/upload-image', [DepartmentController::class, 'uploadImage'])->name('upload-image');
});



// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
