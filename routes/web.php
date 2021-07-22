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
// use App\Http\Controllers\Admin\SliderController;
// use App\Http\Controllers\Admin\UploadController;
// use App\Http\Controllers\Admin\ProductController;
// use App\Http\Controllers\Admin\PageController;
// use App\Http\Controllers\Admin\AuthController;

// $prefixAdmin = Config::get('gbayvn.url.prefix_admin', 'gbay');
// $prefixNews  = Config::get('gbayvn.url.prefix_fontend', 'store');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::any('{slug}', function () {
    return view('welcome');
});