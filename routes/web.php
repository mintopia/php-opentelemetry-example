<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $filename = dirname(__FILE__) . '/../resources/docs/v' . config('app.version') . '.html';
    return response()->file($filename);
});
