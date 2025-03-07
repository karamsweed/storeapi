<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('api/docs');
});

require __DIR__.'/auth.php';