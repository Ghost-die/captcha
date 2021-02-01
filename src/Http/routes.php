<?php

use Ghost\Captcha\Http\Controllers;
use Illuminate\Support\Facades\Route;

//Route::get('captcha', Controllers\CaptchaController::class.'@index');

Route::get('auth/login', Controllers\CaptchaController::class.'@getLogin');
Route::post('auth/login', Controllers\CaptchaController::class.'@postLogin');