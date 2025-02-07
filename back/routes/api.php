<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FibonacciController;

Route::get('/fib', [FibonacciController::class, 'index']);