<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AboutUs;
use App\Livewire\AddCategory;
use App\Livewire\AllProducts;
use App\Livewire\Contacts;
use App\Livewire\EditProduct;
use App\Livewire\ManageOrders;
use App\Livewire\ManageProduct;
use App\Livewire\AddProductForm;
use App\Livewire\AdminDashboard;
use App\Livewire\ProductDetails;
use App\Livewire\ManageCategories;
use App\Livewire\KurirDashboard;
use App\Livewire\Admin\TambahKurir;
use App\Livewire\UpdateStatusPengiriman;
use App\Livewire\PembayaranForm;
use App\Livewire\ShoppingCartComponent;
use App\Livewire\EditCategoryNew;

Route::view('/', 'welcome')->name('/');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/check-algolia', function () {
    dd(config('scout.algolia.id'));
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/product/{product_id}/details', ProductDetails::class);
Route::get('/all/products', AllProducts::class);
Route::get('/about', AboutUs::class);
Route::get('/contacts', Contacts::class);
Route::get('/shopping-cart', ShoppingCartComponent::class)->name('shopping-cart');

// untuk halaman profile
// Route::middleware(['auth'])->get('/profile', function () {
//     return view('profile');
// })->name('profile.show');


// Group middleware untuk admin (role = 1)
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/tambah-kurir', TambahKurir::class)->name('admin.tambah-kurir');
    Route::get('/products', ManageProduct::class)->name('products');
    Route::get('/orders', ManageOrders::class)->name('orders');
    Route::get('/add/product', AddProductForm::class);
    Route::get('/manage/categories', ManageCategories::class);
    Route::get('/add/category', AddCategory::class);
    Route::get('/edit/{id}/product', EditProduct::class);
    Route::get('/manage/categories/edit/{id}', EditCategoryNew::class)->name('edit.category');
});

// Group middleware untuk kurir (role = 2)
Route::middleware(['auth', 'kurir'])->group(function () {
    Route::get('/kurir/dashboard', KurirDashboard::class)->name('kurir.dashboard');
    Route::get('/kurir/update-pengiriman/{id}', UpdateStatusPengiriman::class);
});

// Group middleware untuk user/customer (role = 0)
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/pembayaran/{id}', PembayaranForm::class)->name('pembayaran.form');
});

require __DIR__ . '/auth.php';
