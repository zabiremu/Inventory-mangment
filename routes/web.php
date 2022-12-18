<?php

use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\InvoiceController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\PurchaseController;
use App\Http\Controllers\backend\StockController;
use App\Http\Controllers\backend\SupplierController;
use App\Http\Controllers\backend\UnitController;
use App\Http\Controllers\ProfileController;
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
    return view('admin.auth.login');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
})
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// FOR ADMIN

Route::middleware(['auth'])->group(function () {
    // DASHBOARD CONTORLLER
    Route::controller(DashboardController::class)
        ->group(function () {
            Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
        })
        ->middleware(['auth', 'verified'])
        ->name('admin/dashboard');

    // PROFILE CONTROLLER
    Route::controller(AdminProfileController::class)
        ->group(function () {
            Route::get('/admin/profile', 'index')->name('admin.profile');
            Route::post('/admin/profile/store/{id}', 'store')->name('profile.store');
            Route::get('/admin/password', 'password')->name('profile.password');
            Route::post('/admin/password/update/{id}', 'updatePassword')->name('update.admin.password');
        })
        ->middleware(['auth', 'verified']);

    // SUPPLIER CONTROLLER
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/all/suppliers', 'index')->name('all.suppliers');
        Route::get('add/supplier', 'create')->name('create-supplier');
        Route::post('store/supplier', 'store')->name('store-supplier');
        Route::get('edit/supplier/{id}', 'edit')->name('edit-supplier');
        Route::post('update/supplier/{id}', 'update')->name('update-supplier');
        Route::delete('delete/supplier/{id}', 'destroy')->name('delete-supplier');
    });

    // Coustomer CONTROLLER
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/all/customers', 'index')->name('all.customers');
        Route::get('add/customer', 'create')->name('create-customers');
        Route::post('store/customer', 'store')->name('store-customer');
        Route::get('edit/customer/{id}', 'edit')->name('edit-customer');
        Route::post('update/cusotmer/{id}', 'update')->name('update-customer');
        Route::delete('delete/cusotmer/{id}', 'destroy')->name('delete-customer');
    });

    // Unit CONTROLLER
    Route::controller(UnitController::class)->group(function () {
        Route::get('/all/units', 'index')->name('all.units');
        Route::get('add/units', 'create')->name('create-uints');
        Route::post('store/units', 'store')->name('store-units');
        Route::get('edit/unit/{id}', 'edit')->name('edit-unit');
        Route::post('update/unit/{id}', 'update')->name('update-units');
        Route::delete('delete/unit/{id}', 'destroy')->name('delete-unit');
    });

    // Category CONTROLLER
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/categories', 'index')->name('all.category');
        Route::get('add/category', 'create')->name('create-category');
        Route::post('store/category', 'store')->name('store-category');
        Route::get('edit/category/{id}', 'edit')->name('edit-category');
        Route::post('update/category/{id}', 'update')->name('update-category');
        Route::delete('delete/category/{id}', 'destroy')->name('delete-category');
    });

    // Product CONTROLLER
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/products', 'index')->name('all.products');
        Route::get('add/products', 'create')->name('create-products');
        Route::post('store/products', 'store')->name('store-products');
        Route::get('edit/products/{id}', 'edit')->name('edit-product');
        Route::post('update/products/{id}', 'update')->name('update-products');
        Route::delete('delete/products/{id}', 'destroy')->name('delete-products');
    });

    // Product CONTROLLER
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/all/purchase', 'allPurchase')->name('all.purchase');
        Route::get('add/purchase', 'addPurchase')->name('add.Purchase');
        Route::get('select/supplier/{id}', 'addSupplier');
        Route::get('select/products/{id}', 'addProduct');
        Route::post('add/products', 'pruchaseProduct')->name('add.product');
        Route::delete('delete/purchase/{id}', 'deletePruchase')->name('delete.purchase');
        Route::get('approve/purchase/', 'approvePurchase')->name('approve.purchase');
        Route::post('approve/{id}', 'approve')->name('approve');
    });

    // Invoice CONTROLLER
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/all/invoice', 'allInvoice')->name('all.invoice');
        Route::get('add/invoice', 'addInvoice')->name('add.invoice');
        Route::get('select/invoice/{id}', 'Invoice');
        Route::get('select/product/stock/{id}', 'stock');
        Route::post('store/invoice', 'stoteInvoice')->name('store.invoice');
        Route::get('approve/invoice', 'approveInvoice')->name('approve.invoice');
        Route::delete('delete/invoice/{id}', 'deleteInvoice')->name('delete.invoice');
        Route::get('accpect/Invoice/{id}', 'accpectInvoice')->name('accpect.Invoice');
        Route::post('done/{id}', 'done')->name('done');
        Route::get('print/invoice/', 'print')->name('print.invoice');
        Route::get('print/invoice/detail/{id}', 'printdata')->name('print_invoice_deatils');
        Route::get('daily/invoice/report','dailyReport')->name('invoice-report');
        Route::post('daily/invoice/report.store','report')->name('report');
    });

    // Invoice CONTROLLER
    Route::controller(StockController::class)->group(function () {
        Route::get('/all/stock', 'allStock')->name('all.stock');
        Route::get('print/stock', 'printStock')->name('print-stock');
        Route::get('supplier/stock/', 'Supplier')->name('supplier');
        Route::get('supplier/stock/print', 'suppilerStockProint')->name('print-supplier-data');
        Route::get('product/wise/report', 'productWise')->name('product.wise');
        Route::get('print/product/stock', 'productWisePrint')->name('print.product');
        Route::get('purchase/stock/', 'purchaseStock')->name('purchase.stock');
        Route::get('purchase/stock/print', 'purchaseStockPrint')->name('purchase.print');
        Route::post('done/{id}', 'done')->name('done');
        Route::get('customer/stock/', 'customer')->name('customer.stock');
        Route::get('customer/stock/report', 'printdata')->name('customer.stock.report');
        // Route::get('daily/invoice/report','dailyReport')->name('invoice-report');
        // Route::post('daily/invoice/report.store','report')->name('report');
    });
});
require __DIR__ . '/auth.php';
