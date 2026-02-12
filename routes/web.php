<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\AboutUs;
use App\Livewire\AddCategory;
use App\Livewire\AllProducts;
use App\Livewire\Contacts;
use App\Livewire\EditProduct;
use App\Livewire\ManageOrders;
use App\Livewire\ShowOrderDetail;
use App\Livewire\ManageProduct;
use App\Livewire\AddProductForm;
use App\Livewire\AdminDashboard;
use App\Livewire\ProductDetails;
use App\Livewire\ManageCategories;
use App\Livewire\KurirDashboard;
use App\Livewire\ManageKurir;
use App\Livewire\AddKurir;
use App\Livewire\EditKurir;
use App\Livewire\EditKurirProfile;
use App\Livewire\KurirOrders;
use App\Livewire\UpdateStatusPengiriman;
use App\Livewire\PembayaranForm;
use App\Livewire\ShoppingCartComponent;
use App\Livewire\EditCategoryNew;
use App\Livewire\Auth\Register;
use App\Livewire\UserDashboard;
use App\Livewire\EditProfile;
use App\Livewire\EditAdminProfile;
use App\Livewire\UserOrders;
use App\Http\Livewire\Checkout;



Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

Route::get('/check-algolia', function () {
    dd(config('scout.algolia.id'));
});

Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');
});

Route::get('/product/{product_id}/details', ProductDetails::class);
Route::get('/all/products', AllProducts::class);
Route::get('/about', AboutUs::class);
Route::get('/contacts', Contacts::class);
Route::get('/shopping-cart', ShoppingCartComponent::class)->name('shopping-cart');

// Admin routes (role = 1)
Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/admin/dashboard', \App\Livewire\AdminDashboard::class)->name('admin.dashboard');

    // Product management
    Route::get('/products', ManageProduct::class)->name('products');
    Route::get('/add/product', AddProductForm::class);
    Route::get('/edit/{id}/product', EditProduct::class);

    // Orders
    Route::get('/manage/orders', ManageOrders::class)->name('manage.orders');
    Route::get('/manage/orders/{id}', ShowOrderDetail::class)->name('manage.orders-detail');

    // Categories
    Route::get('/manage/categories', ManageCategories::class);
    Route::get('/add/category', AddCategory::class);
    Route::get('/manage/categories/edit/{id}', EditCategoryNew::class)->name('edit.category');

    // Admin profile
    Route::get('/admin/edit-profile', EditAdminProfile::class)->name('admin.edit-profile');

    // Kurir management
    Route::get('/manage/kurir', ManageKurir::class)->name('manage.kurir');
    Route::get('/add/kurir', AddKurir::class)->name('add.kurir');
    Route::get('/edit/kurir/{id}', EditKurir::class)->name('edit.kurir');
});

// Kurir routes (role = 2)
Route::middleware(['auth', 'kurir'])->group(function () {
    Route::get('/kurir/dashboard', KurirDashboard::class)->name('kurir.dashboard');
    Route::get('/kurir/update-pengiriman/{id}', UpdateStatusPengiriman::class);
    Route::get('/kurir/edit-profile', EditKurirProfile::class)->name('kurir.edit-profile');
    Route::get('/kurir/orders', KurirOrders::class)->name('kurir.orders');
});

// User/customer routes (role = 0)
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', UserDashboard::class)->name('user.dashboard');

    // Checkout & pembayaran
    Route::get('/pembayaran', PembayaranForm::class)->name('pembayaran.form');

    // Daftar pesanan user
    Route::get('/user/orders', UserOrders::class)->name('user.orders');

    // Profil pengguna
    Route::get('/user/profil', EditProfile::class)->name('customer.profile');

    
    
});

require __DIR__ . '/auth.php';
