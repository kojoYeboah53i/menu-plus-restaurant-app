<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProductsPricingController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('login', [PagesController::class, 'login'])
    ->name('login')
    ->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [
        App\Http\Controllers\HomeController::class,
        'index',
    ])->name('home');

    // ===
    //Dashboard Routes
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('', [DashboardController::class, 'home'])->name('home');
        Route::group(
            ['prefix' => 'cities-and-territories', 'as' => 'cities.'],
            function () {
                Route::get('', [
                    DashboardController::class,
                    'cities',
                ])->name('home');
            }
        );
        Route::group(['prefix' => 'emails', 'as' => 'emails.'], function () {
            Route::get('/', [DashboardController::class, 'manageEmails'])->name('home');
        });

        // Route::group(
        //     ['prefix' => 'customers', 'as' => 'customers.'],
        //     function () {
        //         Route::get('/', [
        //             PagesController::class,
        //             'manageCustomers',
        //         ])->name('list');
        //         Route::get('{id}', [
        //             PagesController::class,
        //             'viewCustomer',
        //         ])->name('view');
        //         Route::get('{id}/edit', [
        //             PagesController::class,
        //             'editCustomer',
        //         ])->name('edit');
        //     }
        // );
    });
    //Management Routes
    Route::group(['prefix' => 'manage', 'as' => 'manage.'], function () {
        Route::get('', [ManagementController::class, 'home'])->name('home');
        Route::group(
            ['prefix' => 'accounts', 'as' => 'accounts.'],
            function () {
                Route::get('', [ManagementController::class, 'account'])->name(
                    'home'
                );
                Route::get('create', [
                    ManagementController::class,
                    'createAccount',
                ])->name('create');
                Route::post('create', [
                    ManagementController::class,
                    'storeAccount',
                ])->name('store');
                Route::get('{id}', [
                    ManagementController::class,
                    'editAccount',
                ])->name('edit');
                Route::put('{id}', [
                    ManagementController::class,
                    'updateAccount',
                ])->name('update');
                Route::delete('{id}', [
                    ManagementController::class,
                    'deleteAccount',
                ])->name('delete');
            }
        );
        Route::group(
            ['prefix' => 'restaurants', 'as' => 'restaurants.'],
            function () {
                Route::get('/', [
                    ManagementController::class,
                    'restaurants',
                ])->name('home');
                Route::get('create', [
                    ManagementController::class,
                    'createRestaurants',
                ])->name('create');
                Route::put('{id}/edit', [
                    ManagementController::class,
                    'updateRestaurant',
                ])->name('update');
                Route::put('user/{id}/edit', [
                    ManagementController::class,
                    'updateRestaurantUser',
                ])->name('update-user');
                Route::get('user/{id}/reset-password', [
                    ManagementController::class,
                    'resetRestaurantUserPassword',
                ])->name('reset-user-password');
                Route::post('create', [
                    ManagementController::class,
                    'addRestaurant',
                ])->name('add');
                Route::delete('{id}', [
                    ManagementController::class,
                    'deleteRestaurant',
                ])->name('delete');
                Route::get('{id}', [
                    ManagementController::class,
                    'viewRestaurant',
                ])->name('view');
                // Route::post('activation/{id}', [
                //     ManagementController::class,
                //     'activation',
                // ])->name('activation');
                Route::get('subscribe/{id}', [
                    ManagementController::class,
                    'subscribe',
                ])->name('subscribe');
                Route::post('subscribe/{id}', [
                    ManagementController::class,
                    'setSubscribe',
                ])->name('set-subscribe');
                Route::get('subscribe/edit/{id}', [
                    ManagementController::class,
                    'editSubscribe',
                ])->name('edit-subscribe');
                Route::post('subscribe/edit/{id}', [
                    ManagementController::class,
                    'updateSubscribe',
                ])->name('update-subscribe');
            }
        );
        Route::group(
            ['prefix' => 'statistics', 'as' => 'statistics.'],
            function () {
                Route::get('', [
                    ManagementController::class,
                    'statistics',
                ])->name('home');
            }
        );
    });

    Route::group(
        ['prefix' => 'products-and-services', 'as' => 'products.'],
        function () {
            Route::get('', [PagesController::class, 'products'])->name('home');
            Route::get('customers', [
                PagesController::class,
                'manageCustomers',
            ])->name('customers');
            Route::get('customers/{id}', [
                PagesController::class,
                'viewCustomer',
            ])->name('customers.view');
            Route::get('customers/{id}/edit', [
                PagesController::class,
                'editCustomer',
            ])->name('customers.edit');
        }
    );
    //Products & Pricing Routes
    Route::group(['prefix' => 'products-pricing', 'as' => 'products.'], function () {
        Route::get('', [ProductsPricingController::class, 'home'])->name('home');
        Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
            Route::get('', [ProductsPricingController::class, 'products'])->name('home');
            Route::get('create', [ProductsPricingController::class, 'createProduct'])->name('create');
            Route::post('store', [ProductsPricingController::class, 'addProduct'])->name('store');
            
            Route::get('edit/{id}', [ProductsPricingController::class, 'editProduct'])->name('edit');
            Route::put('update/{id}', [ProductsPricingController::class, 'updateProduct'])->name('update');
            Route::get('delete/{id}', [ProductsPricingController::class, 'deleteProduct'])->name('delete');
        });
        Route::group(['prefix' => 'pricing', 'as' => 'pricing.'], function () {
            Route::get('', [ProductsPricingController::class, 'pricing'])->name('home');
            Route::get('create', [ProductsPricingController::class, 'createPricing'])->name('create');
            Route::post('store', [ProductsPricingController::class, 'addPricing'])->name('store');
            
            Route::get('edit/{id}', [ProductsPricingController::class, 'editPricing'])->name('edit');
            Route::put('update/{id}', [ProductsPricingController::class, 'updatePricing'])->name('update');
            Route::get('delete/{id}', [ProductsPricingController::class, 'deletePricing'])->name('delete');
        });
    });

    //Sales Routes
    Route::group(['prefix' => 'sales', 'as' => 'sales.'], function () {
        Route::get('', [SalesController::class, 'home'])->name('home');
    });

    //Password Change
    Route::post('change-password', [PagesController::class, 'changePassword'])->name('change-password');

    //Upload Routes
    Route::post('upload-image', [
        PagesController::class,
        'selfUploadImage',
    ])->name('upload-image');
});
