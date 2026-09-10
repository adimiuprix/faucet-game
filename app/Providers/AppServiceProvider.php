<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Helpers/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Detect admin routes and configure session table BEFORE session starts
        if ($this->app->runningInConsole() === false) {
            $request = request();
            $adminPrefix = config('admin.admin_prefix');

            if ($request && str_starts_with($request->path(), $adminPrefix)) {
                config(['session.table' => 'admin_sessions']);
                config(['session.cookie' => config('app.name').'_admin_session']);
            }
        }

        $sitename = Setting::sitename();
        $description = Setting::description();
        $keywords = Setting::keywords();

        if (Schema::hasTable('settings')) {
            View::share('sitename', $sitename);
            View::share('description', $description);
            View::share('keywords', $keywords);
        }
    }
}
