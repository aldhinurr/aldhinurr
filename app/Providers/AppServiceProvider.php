<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Core\Adapters\Theme;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $theme = theme();

        // Share theme adapter class
        View::share('theme', $theme);

        // Set demo globally
        // $theme->setDemo(request()->input('demo', 'demo1'));
        $theme->setDemo('demo1');

        $theme->initConfig();

        bootstrap()->run();

        if (isRTL()) {
            // RTL html attributes
            Theme::addHtmlAttribute('html', 'dir', 'rtl');
            Theme::addHtmlAttribute('html', 'direction', 'rtl');
            Theme::addHtmlAttribute('html', 'style', 'direction:rtl;');
        }

        View::composer('*', function ($view) {
            $user = Auth::user();
            if ($user) {
                $activityCount = DB::table('notifikasi')
                    ->where('notifikasi.created_by', $user->email)
                    ->whereNull('notifikasi.read_content')
                    ->count();

                $activity = DB::table('notifikasi')
                ->where('notifikasi.created_by', $user->email)
                ->whereNull('notifikasi.read_content')
                ->orderBy('timestamp', 'desc')
                ->get();
        
                $view->with('activityCount', $activityCount);
                $view->with('activity', $activity);
            }
        });
    }
}
