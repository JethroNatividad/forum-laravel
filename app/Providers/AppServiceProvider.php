<?php

namespace App\Providers;

use ViewContract;
use App\Models\User;
use App\Models\View;
use App\Models\Reply;
use App\Models\Views;
use App\Models\Thread;
use App\Models\Category;
use App\Contracts\ViewsContract;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\View as FacadesView;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ViewsContract::class, Views::class);

        $this->app->bind(ViewContract::class, View::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootEloquentMorphsRelations();
        $categories = Category::all();
        FacadesView::share('categories', $categories);
    }

    public function bootEloquentMorphsRelations()
    {
        Relation::morphMap([
            Thread::TABLE => Thread::class,
            Reply::TABLE => Reply::class,
            User::TABLE => User::class,
        ]);
    }
}
