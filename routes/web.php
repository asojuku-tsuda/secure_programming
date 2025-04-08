<?php

use Illuminate\Support\Facades\Route;

// ホームページ
Route::get('/', function () {
    return view('home');
})->name('home');

// ページ1
Route::get('/page1', function () {
    return view('page1');
})->name('page1');

// ページ2
Route::get('/page2', function () {
    return view('page2');
})->name('page2');

// パラメータありルート
Route::get('/user/{id}', function ($id) {
    return view('user', ['id' => $id]);
})->name('user.show');
