<?php

namespace Wtolk\AdfmNews\Providers;

use Illuminate\Support\ServiceProvider;
use Wtolk\Crud\Form\ItemMenu;


class AdfmNewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../Controllers' => app_path('Http/Controllers'),
            __DIR__.'/../Models' => app_path('Models/Adfm'),
            __DIR__.'/../views' => resource_path('views/adfm'),
            __DIR__.'/../routes' => base_path('/routes/adfm/news'),
            __DIR__.'/../database/migrations' => app_path('../database/migrations'),
        ]);

        $this->loadRoutesFrom(base_path('/routes/adfm/news') . '/admin-routes.php');
        $this->loadRoutesFrom(base_path('/routes/adfm/news') . '/public-routes.php');
    }

    public static function registerMainMenuLinks()
    {
        config(['adfm.main-menu.Новости' =>
            ItemMenu::make('Новости')->route('adfm.news.index')->icon("rss_feed"),
        ]);
    }

}
