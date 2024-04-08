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

Route::middleware(['auth.manual'])->group(function () {
    Route::get('/customer', [ClientController::class, 'customer'])->name('customer');
    Route::post('/appointments', [ClientController::class, 'store'])->name('appointments.store');
});



//super admin routes
Route::get('/super-admin-dashboard', function () {
    return view('superadmin.dashboard');
})->name('super_admin.dashboard'); // Define a unique name for the route

Route::post('/super-admin-logout', [SuperAdminController::class, 'logout'])->name('super_admin.logout');

//super admin visual
Route::get('/visualization', [SuperAdminController::class, 'visualization'])->name('visualization');
// Separate route without the auth.manual middleware for the customer route
Route::get('/customer', [ClientController::class, 'customer'])->name('customer')->middleware('auth');



//User Management rout//

Route::group(['prefix' => 'user'], function () {
    Route::get('table', [UserManagmentController::class, 'index'])->name('userTable')->middleware('auth');
    Route::get('edit/{id}', [UserManagmentController::class, 'editUser'])->name('editUser')->middleware('auth');
    Route::post('update/{id}', [UserManagmentController::class, 'updateUser'])->name('updateUser')->middleware('auth');
    Route::get('archive/{id}', [UserManagmentController::class, 'archiveUser'])->name('archiveUser')->middleware('auth');
    Route::get('add-user-form', [UserManagmentController::class, 'showAddUserForm'])->name('addUserForm')->middleware('auth'); // Add this line
    Route::post('store-user', [UserManagmentController::class, 'storeUser'])->name('storeUser')->middleware('auth');
    Route::get('/user/details/{id}', [UserManagmentController::class, 'getUserDetails'])->name('getUserDetails')->middleware('auth');
});




// Branch routes
Route::get('/branches/view', [BranchController::class, 'viewBranches'])->name('branches.view')->middleware('auth');
Route::get('/branches/create', [BranchController::class, 'createForm'])->name('branch.create.form')->middleware('auth');
Route::post('/branches/create', [BranchController::class, 'create'])->name('branch.create')->middleware('auth');
Route::get('/edit-branch/{id}', [BranchController::class, 'edit'])->name('branch.edit')->middleware('auth');
Route::put('/update-branch/{id}', [BranchController::class, 'update'])->name('branch.update')->middleware('auth');
Route::get('/view-branches', [BranchController::class, 'viewBranches'])->name('branch.view')->middleware('auth');
Route::get('/branches', [BranchController::class, 'viewBranches'])->name('branch.view')->middleware('auth');
Route::delete('/branches/{id}/archive', [BranchController::class, 'archive'])->name('branch.archive')->middleware('auth');






//CLIENT side//

Route::get('/home1', [ClientController::class, 'home1'])->name('home1')->middleware('auth');
Route::get('/about2', [ClientController::class, 'about2'])->name('about2')->middleware('auth');
Route::get('/dentalClinic2', [ClientController::class, 'dentalClinic2'])->name('dentalClinic2')->middleware('auth');



// routes/web.php



Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');


//Staff  routes
Route::get('/staff', [StaffController::class, 'index'])->name('staff');
Route::get('/homeStaff', [StaffController::class, 'homeStaff'])->name('homeStaff');
Route::get('/staff/acceptedappoint', [StaffController::class, 'acceptedAppointments'])->name('staff.acceptedappoint');
Route::post('/accept-appointment/{appointment}', [StaffController::class, 'pendingAppointment'])->name('accept.appointment');
Route::get('/logout', [AuthController::class, 'logout'])->name('manual.logout');
Route::put('/complete-appointment/{appointment}', [StaffController::class, 'completeAppointment'])->name('complete.appointment');
Route::put('/staff/cancel/{appointment}', [StaffController::class, 'cancelAppointment'])->name('staff.cancel');
//staff order product
Route::get('/staff/product-order', [StaffController::class, 'productOrder'])->name('staff.productorder');
Route::put('/sales/{sale}', [StaffController::class, 'deliverSale'])->name('deliver.sale');
//delivered product
Route::get('/staff/delivering-status', [StaffController::class, 'deliveringStatus'])->name('staff.deliveringStatus');
Route::post('/sales/{id}/mark-as-delivered', [StaffController::class, 'markAsDelivered'])->name('mark-as-delivered');
Route::get('/staff/daily-sales', [StaffController::class, 'dailySales'])->name('staff.dailySales');

//Landing_Page
Route::get('/', [LandingPageController::class, 'Home'])->name('home');
Route::get('/ContactUs', [LandingPageController::class, 'ContactUs'])->name('contactUs');
Route::get('/Services', [LandingPageController::class, 'Services'])->name('services');
Route::get('/OurClinic', [LandingPageController::class, 'OurClinic'])->name('ourClinic');
Route::get('/OurShop', [LandingPageController::class, 'OurShop'])->name('ourShop');
Route::get('/ourGallery', [LandingPageController::class, 'ourGallery'])->name('ourGallery');

//Page Controller
Route::get('/showDashboard', [PageController::class, 'showDashboard'])->name('showDashboard');
Route::get('/profileSetting', [PageController::class, 'profileSetting'])->name('profileSetting');
Route::get('/changePassword', [PageController::class, 'changePassword'])->name('changePassword');
Route::get('/message', [PageController::class, 'message'])->name('message');


//User Dashboard
Route::get('/UserDashboard', [PageController::class, 'showDashboard']);
Route::prefix('superadmin')->group(function () {
    Route::get('users', [UserManagementController::class, 'index'])->name('superadmin.user.index')->middleware('auth');
    Route::get('users/create', [UserManagementController::class, 'create'])->name('superadmin.user.create')->middleware('auth');
    Route::post('users', [UserManagementController::class, 'store'])->name('superadmin.user.store')->middleware('auth');
    Route::get('users/{id}', [UserManagementController::class, 'show'])->name('superadmin.user.show')->middleware('auth');
    Route::get('users/{id}/edit', [UserManagementController::class, 'edit'])->name('superadmin.user.edit')->middleware('auth');
    Route::put('users/{id}', [UserManagementController::class, 'update'])->name('superadmin.user.update')->middleware('auth');
    Route::delete('/superadmin/user/{id}/archive', [UserManagementController::class, 'archive'])->name('superadmin.user.archive')->middleware('auth');

});


//inventory routes
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{id}/audit', 'App\Http\Controllers\InventoryController@showAudit')->name('inventory.audit.show');
Route::post('/inventory/addquantity/{id}', [InventoryController::class, 'addQuantity'])->name('inventory.addquantity');


//admin in ventory
Route::get('/admin/inventory', [InventoryController::class, 'indexadmin'])->name('admin.inventory.indexadmin');
Route::delete('/admin/inventory/{id}', [InventoryController::class, 'destroy'])->name('admin.inventory.delete');
//addmin usermanagement

Route::prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [AdminController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

// ecom routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::post('/shop/order', [ShopController::class, 'orderProduct'])->name('shop.order');
// Cart routes
Route::get('/cart', [ShopController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [ShopController::class, 'removeFromCart'])->name('cart.remove'); // Add this line

//sales routes
Route::post('/cart/order', [ShopController::class, 'order'])->name('cart.order');
//visual routes
Route::get('/fetch-addresses', [SuperAdminController::class, 'fetchAddresses'])->name('fetch.addresses');
Route::get('/fetch-sales', [SuperAdminController::class, 'fetchSales'])->name('fetch.sales');
