<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Accounts\AccountInterfaceRepository;
use App\Repositories\Accounts\AccountEloquentRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Repositories\Contact\ContactEloquentRepository;
use App\Repositories\Contact\ContactRepositoryInterface;
use App\Services\ContactService;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Book\BookEloquentRepository;
use App\Services\BookService;
use App\Services\AccountService;
use App\Repositories\InformationAccount\InformationAccountEloquentRepository;
use App\Repositories\InformationAccount\InformationAccountInterfaceRepository;
use App\Http\ViewComposers\CategoryComposer;
use App\Repositories\SocialAccount\SocialAccountEloquentRepository;
use App\Repositories\SocialAccount\SocialAccountInterfaceRepository;
use App\Services\SocialAccountService;
use App\Http\ViewComposers\FooterComposer;
use Illuminate\Pagination\Paginator;
use App\Repositories\Bookmart\BookmartRepositoryInterface;
use App\Repositories\Bookmart\BookmartEloquentRepository;
use App\Services\BookmartService;
use App\Services\DashboardService;
use App\Repositories\Comments\CommentEloquentRepository;
use App\Repositories\Comments\CommentRepositoryInterface;
use App\Repositories\Rates\RateRepositoryInterface;
use App\Repositories\Rates\RateEloquentRepository;
use App\Models\Comment;
use App\Observers\CommentObserver;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Paginator::defaultView('vendor.pagination.default');

        view()->composer(
            'client.layout.sidebar',
            CategoryComposer::class
        );

        view()->composer(
            'client.layout.footer',
            FooterComposer::class
        );

        Comment::observe(CommentObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryEloquentRepository::class
        );

        $this->app->singleton(
            ContactRepositoryInterface::class,
            ContactEloquentRepository::class
        );

        $this->app->singleton(
            ContactService::class
        );

        $this->app->singleton(
            BookService::class
        );

        $this->app->singleton(
            BookRepositoryInterface::class,
            BookEloquentRepository::class
        );

        $this->app->singleton(
            AccountInterfaceRepository::class,
            AccountEloquentRepository::class
        );

        $this->app->singleton(
            InformationAccountInterfaceRepository::class,
            InformationAccountEloquentRepository::class
        );

        $this->app->singleton(
            AccountService::class
        );

        $this->app->singleton(
            SocialAccountInterfaceRepository::class,
            SocialAccountEloquentRepository::class
        );

        $this->app->singleton(
            SocialAccountService::class
        );

        $this->app->singleton(
            BookmartRepositoryInterface::class,
            BookmartEloquentRepository::class
        );

        $this->app->singleton(
            BookmartService::class
        );

        $this->app->singleton(
            CommentRepositoryInterface::class,
            CommentEloquentRepository::class
        );

        $this->app->singleton(
            DashboardService::class
        );

        $this->app->singleton(
            RateRepositoryInterface::class,
            RateEloquentRepository::class
        );
    }
}
