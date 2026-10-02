<?php

use App\Http\Controllers\ConcertController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('concerts.index');
});

Route::resource('concerts', ConcertController::class)->except(['destroy']);
