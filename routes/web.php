<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Fairs\Index as FairsIndex;
use App\Livewire\Fairs\Create as FairsCreate;
use App\Livewire\Fairs\Manage as FairsManage;
use App\Livewire\Cashier\PointOfSale;
use App\Livewire\Products\Index as ProductsIndex;
use App\Livewire\Customers\Index as CustomersIndex;
use App\Livewire\Cashier\Closing as CashierClosing;
use App\Livewire\Public\Menu as PublicMenu;
use App\Livewire\Users\Index as UsersIndex;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Página pública do cardápio da feirinha atual
Route::get('/feirinha', PublicMenu::class)->name('public.menu');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Fairs
    Route::get('fairs', FairsIndex::class)->name('fairs.index');
    Route::get('fairs/create', FairsCreate::class)->name('fairs.create');
    Route::get('fairs/{fair}', FairsManage::class)->name('fairs.manage');
    Route::post('fairs/{fair}/set-current', function(App\Models\Fair $fair){
        App\Models\Fair::query()->update(['is_current' => false]);
        $fair->is_current = true; $fair->save();
        return back();
    })->name('fairs.set-current');

    // Products
    Route::get('products', ProductsIndex::class)->name('products.index');

    // Customers
    Route::get('customers', CustomersIndex::class)->name('customers.index');

    // Users (Sistema)
    Route::get('users', UsersIndex::class)->name('users.index');

    // Caixa / Ponto de venda
    Route::get('pos', PointOfSale::class)->name('pos');
    Route::get('closing', CashierClosing::class)->name('cashier.closing');
});

require __DIR__.'/auth.php';
