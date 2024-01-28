<?php

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

use App\Http\Controllers\SalesController;
use App\Models\Sale;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::redirect('/dashboard', '/sales');

Route::get('/sales', function () {
    $salesController = new SalesController();
    $sales = $salesController->showSalesView();
    return view('coffee_sales', ['sales' => $sales]);
})->middleware(['auth'])->name('coffee.sales');


Route::get('/shipping-partners', function () {
    return view('shipping_partners');
})->middleware(['auth'])->name('shipping.partners');

Route::post('/save-sales', [SalesController::class, 'saveSales'])->middleware(['auth'])->name('save.sales');

Route::get('/jquery', function () {
    return response()->file(public_path('js/jquery.min.js'));
})->name('jquery');


require __DIR__.'/auth.php';
