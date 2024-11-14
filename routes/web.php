<?php
// File: backend/vendor/qtvhao/learning-module/routes/web.php

use Illuminate\Support\Facades\Route;

Route::get('/learning', function () {
    return view('learning-module::learning');
});
