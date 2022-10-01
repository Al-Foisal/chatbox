<?php

namespace App\Providers;

use App\Models\CompanyInfo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $company = CompanyInfo::find(1);
        view()->share('company', $company);
    }
}
