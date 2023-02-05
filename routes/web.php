<?php

use App\Http\Controllers\ContractTypeController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //routes for contract type
    Route::get('/contracts', [ContractTypeController::class, 'index'])->name('preparation.contracts.index');
    Route::get('/contract/create', [ContractTypeController::class, 'create'])->name('preparation.contracts.create');
    Route::post('/contract/store', [ContractTypeController::class, 'store'])->name('preparation.contracts.store');
    Route::get('/contract/{contract}/edit', [ContractTypeController::class, 'edit']);
    Route::post('/contract/{contract}/update', [ContractTypeController::class, 'update']);
    Route::post('/contract/delete', [ContractTypeController::class, 'destroy']);
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
