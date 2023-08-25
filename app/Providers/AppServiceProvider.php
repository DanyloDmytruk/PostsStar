<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Http\Controllers\EloquentRepository;
use App\Http\Controllers\ElasticsearchRepository;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use App\Http\Controllers\PostsRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostsRepository::class, function () {
            // Это полезно, если мы хотим выключить наш кластер
            // или при развертывании поиска на продакшене
            if (! config('services.search.enabled')) {
                return new EloquentRepository();
            }
            return new ElasticsearchRepository(
                $this->app->make(Client::class)
            );
        });
        
        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
