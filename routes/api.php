<?php

use App\Http\Controllers\ImageFetchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/images', [ImageFetchController::class, 'getImages']);
Route::get('/image/rand', [ImageFetchController::class, 'getRandImage']);
