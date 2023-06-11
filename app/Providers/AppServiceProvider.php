<?php

namespace App\Providers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->app->bind();
        app()->bind(Newsletter::class, function () {

            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => config('services.mailchimp.server')
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // in case I want to use different things like bootstrap or semantic ui
        // Paginator::useBootstrap();

        Model::unguard(); // allow mass assignment for all, default is guarded

        // Gate Facade
        Gate::define('admin', function ($user) {
            return $user->username === 'afif';
        });

        // Custom Blade Directive
        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
