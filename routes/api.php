<?php

use Illuminate\Support\Facades\Route;
use Qtvhao\LearningModule\Controllers\LearningController;

Route::prefix('api/learning')
    ->middleware([
        'web',
        'device.access'
    ])
    ->group(function () {
        Route::get('/articles', [LearningController::class, 'listArticles']);
        Route::get('/videos', [LearningController::class, 'listVideos']);
    });
