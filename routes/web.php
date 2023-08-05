<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\MasterCityController;
use App\Http\Controllers\Admin\OfficialTravelController;
use App\Http\Controllers\Employee\OfficialTravelController as EmployeOfficialTravel;

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


Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::middleware(['auth'])->group(function () {

            Route::group(['prefix' => 'dashboard', 'controller' => DashboardController::class], function () {
                Route::name('dashboard.')->group(function () {
                    Route::get('', 'index')->name('index');
                });
            });

            // Profile User
            Route::group(['prefix' => 'profile', 'controller' => ProfileController::class], function () {
                Route::name('profile.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::post('edit', 'edit')->name('edit');
                    Route::post('password', 'update')->name('password');
                });
            });

            // contact
            Route::group(['prefix' => 'contact', 'controller' => ContactController::class], function () {
                Route::name('contact.')->group(function () {
                    Route::get('', 'edit')->name('index');
                    Route::put('', 'update')->name('update');
                });
            });
            
            Route::group(['prefix' => 'users', 'controller' => UserController::class], function () {
                Route::name('users.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{user}', 'edit')->name('edit');
                    Route::put('/edit/{user}', 'update')->name('update');
                    Route::delete('/{user}', 'destroy')->name('delete');
                    Route::post('/switch', 'switch')->name('switch');
                });
            });

            Route::group(['prefix' => 'perdin', 'controller' => OfficialTravelController::class], function () {
                Route::name('perdin.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/approval/{officialTravel}', 'show')->name('show');
                    Route::post('/approval/{officialTravel}/approve', 'approve')->name('approve');
                    Route::post('/approval/{officialTravel}/reject', 'reject')->name('reject');
                    
                    
                    Route::get('/history', 'history')->name('history.index');
                    Route::post('/history/data', 'history_data')->name('history.data');
                    Route::get('/history/{officialTravel}', 'show')->name('history.detail');
                });
            });



            //Kota
            Route::group(['prefix' => 'kota', 'controller' => MasterCityController::class], function () {
                Route::name('kota.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{masterCity}', 'edit')->name('edit');
                    Route::put('/edit/{masterCity}', 'update')->name('update');
                    Route::delete('/{masterCity}', 'destroy')->name('delete');


                    Route::get('/provinsi', 'provinsi')->name('provinsi');
                    Route::get('/kota/{id}', 'kota')->name('kota');
                    Route::get('/search/{masterCity}', 'show')->name('show');
                });
            });
        
            // add //

        });
    });
});

Route::prefix('pegawai')->group(function () {
    Route::name('pegawai.')->group(function () {
        Route::group(['middleware' => ['auth', 'verified']], function () {

            Route::group(['prefix' => 'dashboard', 'controller' => DashboardController::class], function () {
                Route::name('dashboard.')->group(function () {
                    Route::get('', 'index')->name('index');
                });
            });

            Route::group(['prefix' => 'perdin', 'controller' => EmployeOfficialTravel::class], function () {
                Route::name('perdin.')->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                });
            });
            

        });
    });
});