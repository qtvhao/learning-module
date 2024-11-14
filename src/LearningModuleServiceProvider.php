<?php

namespace Qtvhao\LearningModule;

use Illuminate\Support\ServiceProvider;

class LearningModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes cho module
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        
        // Load migrations nếu cần
        // $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {
        // Đăng ký các dependency cần thiết
    }
}
