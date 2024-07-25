<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagmentController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdmin\UserManagementController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MapingController;






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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth.manual'])->group(function () {
    Route::get('/back-home', function () {
        return view('back.home');
    })->name('admin.home');

});


// routes/web.php or routes/web.php

Route::middleware(['auth.manual', 'prevent.back'])->group(function () {
    Route::get('/customer', [ClientController::class, 'customer'])->name('customer')->middleware('force.payment');
    Route::post('/appointments', [ClientController::class, 'store'])->name('appointments.store')->middleware('force.payment');
});



//super admin routes
Route::middleware(['auth', 'prevent.back'])->group(function () {
    Route::get('/super-admin-dashboard', function () {
        return view('superadmin.dashboard');
    })->name('super_admin.dashboard');
});

Route::post('/super-admin-logout', [SuperAdminController::class, 'logout'])->name('super_admin.logout');

Route::middleware(['auth', 'prevent.back'])->group(function () {
//super admin visual
Route::get('/visualization', [SuperAdminController::class, 'visualization'])->name('visualization');
// Separate route without the auth.manual middleware for the customer route
Route::get('/customer', [ClientController::class, 'customer'])->name('customer')->middleware('auth');
});



Route::middleware(['auth', 'prevent.back'])->group(function () {
    // Branch routes
    Route::get('/branches/view', [BranchController::class, 'viewBranches'])->name('branches.view');
    Route::get('/branches/create', [BranchController::class, 'createForm'])->name('branch.create.form');
    Route::post('/branches/create', [BranchController::class, 'create'])->name('branch.create');
    Route::get('/edit-branch/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/update-branch/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::get('/view-branches', [BranchController::class, 'viewBranches'])->name('branch.view');
    Route::get('/branches', [BranchController::class, 'viewBranches'])->name('branch.view');
    Route::delete('/branches/{id}/archive', [BranchController::class, 'archive'])->name('branch.archive');
});



//CLIENT side//
Route::middleware(['auth', 'prevent.back'])->group(function () {
    Route::get('/home1', [ClientController::class, 'home1'])->name('home1');
    Route::get('/about2', [ClientController::class, 'about2'])->name('about2');
    Route::get('/dentalClinic2', [ClientController::class, 'dentalClinic2'])->name('dentalClinic2');
});

// routes/web.php

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Staff  routes
Route::middleware(['prevent.back'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
});


Route::middleware(['prevent.back', 'force.payment'])->group(function () {
    Route::get('/homeStaff', [StaffController::class, 'homeStaff'])->name('homeStaff');
    Route::get('/staff/acceptedappoint', [StaffController::class, 'acceptedAppointments'])->name('staff.acceptedappoint');
    Route::post('/accept-appointment/{appointment}', [StaffController::class, 'pendingAppointment'])->name('accept.appointment');
    Route::put('/complete-appointment/{appointment}', [StaffController::class, 'completeAppointment'])->name('complete.appointment');
    Route::put('/staff/cancel/{appointment}', [StaffController::class, 'cancelAppointment'])->name('staff.cancel');
    Route::get('/staff/fee', [StaffController::class, 'deliveringFee'])->name('staff.fee');
    Route::post('/save-fee', [StaffController::class, 'saveDeliveringFee'])->name('save_fee');
    Route::put('/update-fee', [StaffController::class, 'updateDeliveringFee'])->name('update_fee');
});


Route::middleware(['prevent.back'])->group(function () {
    // Staff order product routes
    Route::get('/staff/product-order', [StaffController::class, 'productOrder'])->name('staff.productorder');
    Route::put('/sales/{sale}', [StaffController::class, 'deliverSale'])->name('deliver.sale');

    // Delivered product routes
    Route::get('/staff/delivering-status', [StaffController::class, 'deliveringStatus'])->name('staff.deliveringStatus');
    Route::put('/sales/{id}/mark-as-delivered', [StaffController::class, 'markAsDelivered'])->name('mark-as-delivered');
    Route::get('/staff/daily-sales', [StaffController::class, 'dailySales'])->name('staff.dailySales');

    // Store purchase routes for staff
    Route::get('/store/purchase', [StaffController::class, 'showInventory'])->name('store.purchase');
    Route::post('/store/purchase', [StaffController::class, 'storePurchase'])->name('staff.storePurchase');
    Route::get('/staff/store-purchase', [StaffController::class, 'storePurchase'])->name('staff.storePurchase.get');
    

});

//Landing_Page
Route::get('/', [LandingPageController::class, 'Home'])->name('home');
Route::get('/ContactUs', [LandingPageController::class, 'ContactUs'])->name('contactUs');
Route::get('/Services', [LandingPageController::class, 'Services'])->name('services');
Route::get('/OurClinic', [LandingPageController::class, 'OurClinic'])->name('ourClinic');
Route::get('/OurShop', [LandingPageController::class, 'OurShop'])->name('ourShop');
Route::get('/ourGallery', [LandingPageController::class, 'ourGallery'])->name('ourGallery');
Route::get('/search', [LandingPageController::class, 'search'])->name('search');


//Page Controller
Route::get('/showDashboard', [PageController::class, 'showDashboard'])->name('showDashboard')->middleware('force.payment');
Route::get('/profileSetting', [PageController::class, 'profileSetting'])->name('profileSetting')->middleware('force.payment');
Route::get('/changePassword', [PageController::class, 'changePassword'])->name('changePassword')->middleware('force.payment');
Route::get('/message', [PageController::class, 'message'])->name('message')->middleware('force.payment');



Route::prefix('superadmin')->middleware(['auth', 'prevent.back'])->group(function () {
    Route::get('users', [UserManagementController::class, 'index'])->name('superadmin.user.index');
    Route::get('users/create', [UserManagementController::class, 'create'])->name('superadmin.user.create');
    Route::post('users', [UserManagementController::class, 'store'])->name('superadmin.user.store');
    Route::get('users/{id}', [UserManagementController::class, 'show'])->name('superadmin.user.show');
    Route::get('users/{id}/edit', [UserManagementController::class, 'edit'])->name('superadmin.user.edit');
    Route::put('users/{id}', [UserManagementController::class, 'update'])->name('superadmin.user.update');
    Route::delete('user/{id}/archive', [UserManagementController::class, 'archive'])->name('superadmin.user.archive');
});

Route::get('/superadmin/user/{id}/show', [UserManagementController::class, 'show'])->name('superadmin.user.show')->middleware('force.payment');


// Regular user inventory routes
Route::middleware(['force.payment', 'prevent.back'])->group(function () {
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
    Route::get('/inventory/{id}/audit', 'App\Http\Controllers\InventoryController@showAudit')->name('inventory.audit.show');
    Route::post('/inventory/addquantity/{id}', [InventoryController::class, 'addQuantity'])->name('inventory.addquantity');
    Route::get('/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
});

// Admin inventory routes
Route::prefix('admin')->middleware(['force.payment', 'prevent.back'])->group(function () {
    Route::get('/admin/inventory', [InventoryController::class, 'indexadmin'])->name('admin.inventory.indexadmin');
    Route::delete('/admin/inventory/{id}', [InventoryController::class, 'destroy'])->name('admin.inventory.delete');
    Route::get('/admin/inventory/audit/{productId}', [AdminController::class, 'audit'])->name('admin.inventory.audit');
    Route::get('/admin/inventory/add', [AdminController::class, 'addinven'])->name('admin.inventory.add');
    Route::post('/admin/inventory/addQuantity/{productId}', [AdminController::class, 'addQuantity'])->name('admin.inventory.addQuantity');
    Route::post('/admin/inventory/store', [AdminController::class, 'storeinven'])->name('admin.inventory.store');
});

//admin visualization
Route::get('/visualize-sales', [AdminController::class, 'visualizeSales'])->name('visualize.sales')->middleware('force.payment');
//addmin usermanagement

Route::prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [AdminController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('admin.users.update'); // Add this line for the update functionality
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/reports/daily', [AdminController::class, 'dailyReports'])->name('admin.reports.daily');
    Route::get('/reports/weekly', [AdminController::class, 'weeklyReports'])->name('admin.reports.weekly');
    Route::get('/reports/monthly', [AdminController::class, 'monthlyReports'])->name('admin.reports.monthly');
    Route::get('/reports/yearly', [AdminController::class, 'yearlyReports'])->name('admin.reports.yearly');
});


Route::middleware(['force.payment'])->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::post('/shop/order', [ShopController::class, 'orderProduct'])->name('shop.order');

     // Cart routes
     Route::get('/cart', [ShopController::class, 'showCart'])->name('cart.show');
     Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('cart.add');
     Route::post('/cart/remove', [ShopController::class, 'removeFromCart'])->name('cart.remove');
});



Route::middleware(['force.payment'])->group(function () {
    //sales routes
    Route::post('/cart/order', [ShopController::class, 'order'])->name('cart.order');
    //visual routes
    Route::get('/fetch-addresses', [SuperAdminController::class, 'fetchAddresses'])->name('fetch.addresses');
    Route::get('/fetch-sales', [SuperAdminController::class, 'fetchSales'])->name('fetch.sales');
});


Route::middleware(['force.payment'])->group(function () {
//super admin report
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/superadmin/report', [SuperAdminController::class, 'report'])->name('superadmin.report');
    Route::get('/generate_report', [SuperAdminController::class, 'report'])->name('generate_report');
    Route::get('/report', [SuperAdminController::class, 'report'])->name('report');
    Route::get('/monthly-report-pdf', [SuperAdminController::class, 'generatePDF'])->name('monthly.report.pdf');
    Route::get('/daily-sales-pdf', [SuperAdminController::class, 'generateDailySalesPDF'])->name('daily.sales.pdf');
    Route::get('/weekly-report-pdf', [SuperAdminController::class, 'generateWeeklyReportPDF'])->name('weekly.report.pdf');
    Route::get('/yearly-report-pdf', [SuperAdminController::class, 'generateYearlyReportPDF'])->name('yearly.report.pdf');
});

Route::middleware(['force.payment'])->group(function () {
    // Weekly sales report
    Route::get('/weekly-report', [SuperAdminController::class, 'weeklyReport'])->name('weekly.report');
    Route::get('/monthly-report', [SuperAdminController::class, 'monthlyReport'])->name('monthly.report');
    Route::get('/yearly-report', [SuperAdminController::class, 'yearlyReport'])->name('yearly.report');
});

Route::middleware(['force.payment'])->group(function () {
//history 
    Route::get('/purchase-history', [ShopController::class, 'history'])->name('purchase.history');

    //mapping
    Route::get('/mapping', [MapingController::class, 'index'])->name('mapping.index');

    Route::post('sales/{sale}/failed-delivery', [StaffController::class, 'failedDelivery'])->name('failed-delivery');
});
Route::middleware(['force.payment'])->group(function () {
    // Route for  a rating
    Route::get('sales/{sale}/ratings/create', [ShopController::class, 'create'])->name('ratings.create');
    // Route for storing ratings
    Route::post('ratings', [ShopController::class, 'store'])->name('ratings.store');
    // Route for viewing ratings
    Route::get('/shop/viewratings/{item}', [ShopController::class, 'viewRatings'])->name('shop.viewratings');
    //verify
    Route::get('verify/{id}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
});