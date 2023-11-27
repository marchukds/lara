<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/hello/{name}', function () {
    return "<h1>Hello World!</h1>";
})->where('name', '[A-Za-z]+');

Route::get('/hello/{id?}', function () {
    return "<h1>Hello World!</h1>";
})->where('id', '[0-9]+');

Route::get('/hello/{string}/{id?}', function () {
    return "<h1>Hello World!</h1>";
})->where(['id' => '[0-9]+'], ['string' => '[A-Za-z]+']);

