<?php

use Illuminate\Support\Facades\Route;

// use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

// Home Page
Route::get('/', function () {
    return view('pages/auth/login');
})->name('/')->middleware('guest');

// Auth Page (Uncomment This if you want to use Laravel Fortify Login & Register)
// Route::post('login-account', 'App\Http\Controllers\Auth\LoginController@loginAccount')->name('login.account');
// Route::post('register-account', 'App\Http\Controllers\Auth\RegisterController@registerAccount')->name('register.account');
// Route::post('update-password', 'App\Http\Controllers\Auth\ForgotPasswordController@updatePassword')->name('update.password');

Route::group(['middleware' => ['auth']], function () {
    // Roles, Users, Permissions Page 
    Route::get('/permissions', \App\Http\Controllers\Account\PermissionController::class)->name('permissions.index')->middleware('permission:permissions.index');
    Route::resource('/roles', \App\Http\Controllers\Account\RoleController::class)->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');
    Route::resource('/users', \App\Http\Controllers\Account\UserController::class)->middleware('permission:users.index|users.create|users.edit|users.delete');
    Route::patch('/users/{id}/updateStatus', [\App\Http\Controllers\Account\UserController::class, 'updateStatus'])->name('users.updateStatus');
    Route::post('/users/{id}/updateRoles', [\App\Http\Controllers\Account\UserController::class, 'updateRoles'])->name('users.updateRoles');
    Route::post('/users/{id}/updateCompanies', [\App\Http\Controllers\Account\UserController::class, 'updateCompanies'])->name('users.updateCompanies');

    // Profiles Page 
    Route::get('/profiles', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profiles.index');
    Route::put('/profiles/{user}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profiles.update');

    // Dashboard & Help Page
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/help', [\App\Http\Controllers\HelpController::class, 'index'])->name('help.index');

    // Operations : Clients Page 
    Route::resource('/clients', \App\Http\Controllers\Operation\ClientController::class)->middleware('permission:clients.index|clients.create|clients.edit|clients.delete');

    // Operations : Companies & CompanyHasLocations Page 
    Route::resource('/companies', \App\Http\Controllers\Operation\CompanyController::class)->middleware('permission:companies.index|companies.create|companies.edit|companies.delete');
    Route::get('/companies/{company}/locations', [\App\Http\Controllers\Operation\CompanyController::class, 'locations'])->name('companies.locations.index')->middleware('permission:companies.index|companies.create|companies.edit|companies.delete');
    Route::get('/companies/{company}/locations/create', [\App\Http\Controllers\Operation\CompanyHasLocationController::class, 'create'])->name('companies.locations.create')->middleware('permission:companies.index|companies.create|companies.edit|companies.delete');
    Route::post('/companies/{company}/locations', [\App\Http\Controllers\Operation\CompanyHasLocationController::class, 'store'])->name('companies.locations.store')->middleware('permission:companies.index|companies.create|companies.edit|companies.delete');
    Route::get('/companies/{company}/locations/{location}/edit', [\App\Http\Controllers\Operation\CompanyHasLocationController::class, 'edit'])->name('companies.locations.edit')->middleware('permission:companies.index|companies.create|companies.edit|companies.delete');
    Route::put('/companies/{company}/locations/{location}', [\App\Http\Controllers\Operation\CompanyHasLocationController::class, 'update'])->name('companies.locations.update')->middleware('permission:companies.index|companies.create|companies.edit|companies.delete');
    Route::delete('/companies/{company}/locations/{location}', [\App\Http\Controllers\Operation\CompanyHasLocationController::class, 'destroy'])->name('companies.locations.destroy')->middleware('permission:companies.index|companies.create|companies.edit|companies.delete');

    // Error Page
    Route::any('/{any}', function () {
        // abort(404);
        return response()->view('pages/error/404', [], 404);
    })->where('any', '.*');
});

// Example Code

// Welcome Page
// Route::get('/', function () {
//     return view('welcome');
// });

// // Email Send (Langsung buka url : http://127.0.0.1:8000/send-email)
Route::get('/send-email', [\App\Http\Controllers\Email\ExampleEmailController::class, 'sendEmail']);
