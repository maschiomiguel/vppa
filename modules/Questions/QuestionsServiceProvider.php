<?php

namespace Modules\Questions;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Questions\Services\QuestionsService;
use Illuminate\Support\Facades\Blade;

class QuestionsServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        QuestionsService::class => QuestionsService::class,
    ];

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        Blade::componentNamespace('Modules\\Questions\\View\\Components', 'modules-questions');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'modules-questions');

        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'modules-questions');
    }
}
