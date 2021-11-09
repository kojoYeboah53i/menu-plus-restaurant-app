<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountInfoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\SandboxController;
use Illuminate\Support\Facades\Auth;
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

Route::get('login', [PagesController::class, 'login'])->name('login')->middleware('guest');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //sanbox routes
    Route::get('sandbox-dashboard', [SandboxController::class, 'index'])->name('sandbox-dashboard');
    Route::post('sandbox-dashboard', [SandboxController::class, 'sandboxUploadImage'])->name('sandbox-route');

    

    //Dashboard Routes
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('', [DashboardController::class, 'dashboard'])->name('home');
        //Tables Routes.
        Route::group(['prefix' => 'tables', 'as' => 'tables.'], function () {
            Route::get('', [DashboardController::class, 'tables'])->name('home');
            Route::get('manage-dinning-areas', [DashboardController::class, 'manageDinningAreas'])->name('managedinningareas');
            Route::get('manage-tables', [DashboardController::class, 'manageTables'])->name('managetables');
            Route::post('store',[DashboardController::class, 'storeTable'])->name('store');
            Route::get('delete/{id}',[DashboardController::class, 'deleteTable'])->name('delete');
        });
      
      
      
        //Menu and Dishes Routes.
        Route::group(['prefix' => 'menus', 'as' => 'menus.'], function () {
            Route::get('', [DashboardController::class, 'menus'])->name('home');
            Route::get('{id}', [DashboardController::class, 'showMenu'])->name('show');
            Route::group(['prefix' => 'create', 'as' => 'create.'], function (){
                Route::get('menu', [DashboardController::class, 'createMenu'])->name('menu');
                Route::post('menu', [DashboardController::class, 'addMenu'])->name('menu');
                Route::get('dish', [DashboardController::class, 'createDish'])->name('dish');
                Route::post('dish', [DashboardController::class, 'addDish'])->name('dish');
            });
        });
        //Dinning Area Routes.
        Route::group(['prefix' => 'dinning-area', 'as' => 'dinning-area.'], function () {
            Route::get('', [DashboardController::class, 'dinningArea'])->name('list');
            Route::post('store',[DashboardController::class, 'storeDinningArea'])->name('store');
            Route::get('delete/{id}',[DashboardController::class, 'deleteDinningArea'])->name('delete');
            Route::get('assign/{id}',[DashboardController::class, 'showAssignTables'])->name('showAssign');
            Route::post('assign/{id}',[DashboardController::class, 'assignTableToDinningArea'])->name('assignedTables');
            Route::get('staff/{id}',[DashboardController::class, 'dinningAreaStaffList'])->name('assignedStaff');
            Route::post('sync-staff/{type}/{waiter_ID}/{dining_area_ID}',[DashboardController::class, 'syncDinningAreUser'])->name('syncDinningAreaStaff');
            Route::get('clear/{id}',[DashboardController::class, 'clearAssigned'])->name('clearAssigned');

        });
        //Bookings Routes.
        Route::group(['prefix' => 'bookings', 'as' => 'bookings.'], function () {
            Route::get('', [DashboardController::class, 'bookings'])->name('home');
            Route::get('selectedBookings', [DashboardController::class, 'getSelectedBooking'])->name('selectedBooking');
        });
        Route::group(['prefix' => 'staff', 'as' => 'staff.'], function () {
            Route::get('/', [DashboardController::class, 'staffList'])->name('list');
            Route::get('create', [DashboardController::class, 'createStaff'])->name('create');
            Route::post('create', [DashboardController::class, 'storeStaff'])->name('store');
            Route::put('{id}', [DashboardController::class, 'updateStaff'])->name('update');
            Route::delete('{id}', [DashboardController::class, 'deleteStaff'])->name('delete');
        });
        Route::get('customers', [DashboardController::class, 'customers'])->name('customers');
        Route::get('reports', [DashboardController::class, 'reports'])->name('reports');
    });

    //Payment Routes
    Route::group(['prefix' => 'payments', 'as' => 'payments.'], function () {
        Route::get('', [PaymentController::class, 'payments'])->name('home');
        Route::get('methods', [PaymentController::class, 'methods'])->name('methods');
        Route::get('gateway', [PaymentController::class, 'gateway'])->name('gateway');
        Route::get('billing-history', [PaymentController::class, 'billingHistory'])->name('billinghistory');
        Route::get('unsubscribe', [PaymentController::class, 'unsusbcribe'])->name('unsubscription');
    });

    //Account Info Routes
    Route::group(['prefix' => 'account-info', 'as' => 'accountinfo.'], function () {
        Route::get('', [AccountInfoController::class, 'accountInfo'])->name('home');
        Route::get('contact', [AccountInfoController::class, 'contact'])->name('contact');
        Route::get('location-address', [AccountInfoController::class, 'locationAddress'])->name('locationaddress');
        Route::get('susbcription-plan', [AccountInfoController::class, 'susbcriptionPlan'])->name('susbcriptionplan');
        Route::get('manage-support-contact', [AccountInfoController::class, 'manageSupportContact'])->name('managesupportcontact');
    });

    Route::get('subscribe', [PagesController::class, 'susbcribe'])->name('subscription.susbcribe');
    Route::get('unsubscribe', [PagesController::class, 'unsusbcribe'])->name('subscription.unsusbcribe');
    Route::post('upload-image', [PagesController::class, 'selfUploadImage'])->name('upload-image');
    
    //Password Change
    Route::post('change-password', [PagesController::class, 'changePassword'])->name('change-password');

    //QR Code Generation Routes
    Route::group(['prefix' => 'qr-code-generate', 'as' => 'qrcode.'], function () {
        Route::get('', [QRCodeController::class, 'qrCode'])->name('home');
        Route::get('generate-for-staff', [QRCodeController::class, 'generateForStaff'])->name('generate-staff');
        Route::get('generate-for-customer', [QRCodeController::class, 'generateForCustomer'])->name('generate-customer');
    });
});
