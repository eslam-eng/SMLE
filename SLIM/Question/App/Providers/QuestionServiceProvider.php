<?php

namespace SLIM\Question\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use SLIM\Abbreviation\Interfaces\AbbreviationRepositoryInterface;
use SLIM\Abbreviation\Interfaces\AbbreviationServiceInterface;
use SLIM\Abbreviation\Repository\AbbreviationRepository;
use SLIM\Abbreviation\Service\AbbreviationService;
use SLIM\Question\interfaces\QuestionNoteRepositoryInterface;
use SLIM\Question\interfaces\QuestionNoteServiceInterface;
use SLIM\Question\interfaces\QuestionRepositoryInterface;
use SLIM\Question\interfaces\QuestionServiceInterface;
use SLIM\Question\interfaces\QuestionSuggestRepositoryInterface;
use SLIM\Question\interfaces\QuestionSuggestServiceInterface;
use SLIM\Question\Repository\QuestionNoteRepository;
use SLIM\Question\Repository\QuestionRepository;
use SLIM\Question\Repository\QuestionSuggestRepository;
use SLIM\Question\services\QuestionNoteService;
use SLIM\Question\services\QuestionService;
use SLIM\Question\services\QuestionSuggestService;
use SLIM\Subspecialties\Interfaces\SubSpecializationRepositoryInterface;
use SLIM\Subspecialties\Interfaces\SubSpecializationServiceInterface;
use SLIM\Subspecialties\Repository\SubSpecializationRepository;
use SLIM\Subspecialties\Service\SubSpecializationService;

class QuestionServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Question';

    protected string $moduleNameLower = 'question';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(QuestionServiceInterface::class, QuestionService::class);

        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(QuestionNoteServiceInterface::class, QuestionNoteService::class);
        $this->app->bind(QuestionNoteRepositoryInterface::class, QuestionNoteRepository::class);
        $this->app->bind(QuestionSuggestServiceInterface::class, QuestionSuggestService::class);
        $this->app->bind(QuestionSuggestRepositoryInterface::class, QuestionSuggestRepository::class);
        $this->app->singleton(SubSpecializationServiceInterface::class, SubSpecializationService::class);
        $this->app->singleton(SubSpecializationRepositoryInterface::class, SubSpecializationRepository::class);
        $this->app->singleton(AbbreviationRepositoryInterface::class, AbbreviationRepository::class);
        $this->app->bind(AbbreviationServiceInterface::class, AbbreviationService::class);
        $this->app->bind(AbbreviationRepositoryInterface::class, AbbreviationRepository::class);

    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        // $this->commands([]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {

// $this->app->booted(function () {

//     $schedule = $this->app->make(Schedule::class);

//     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath))
        {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        }
        else
        {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }

    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower . '.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath   = resource_path('views/modules/' . $this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace') . '\\' . $this->moduleName . '\\' . config('modules.paths.generator.component-class.path'));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array {
        return [];
    }

    private function getPublishableViewPaths(): array {
        $paths = [];

        foreach (config('view.paths') as $path)
        {

            if (is_dir($path . '/modules/' . $this->moduleNameLower))
            {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }

        }

        return $paths;
    }

}
