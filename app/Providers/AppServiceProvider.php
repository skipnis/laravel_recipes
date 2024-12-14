<?php

namespace App\Providers;

use App\Http\Controllers\RecipeController;
use App\Repositories\CategoryRepositoryImpl;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CousineRepositoryImpl;
use App\Repositories\CousineRepositoryInterface;
use App\Repositories\IngredientRepositoryImpl;
use App\Repositories\IngredientRepositoryInterface;
use App\Repositories\InstructionRepositoryImpl;
use App\Repositories\InstructionRepositoryInterface;
use App\Repositories\RecipeRepositoryImpl;
use App\Repositories\RecipeRepositoryInterface;
use App\Services\CategoryServiceImpl;
use App\Services\CategoryServiceInterface;
use App\Services\CousineServiceImpl;
use App\Services\CousineServiceInterface;
use App\Services\IngredientServiceImpl;
use App\Services\IngredientServiceInterface;
use App\Services\InstructionServiceImpl;
use App\Services\InstructionServiceInterface;
use App\Services\RecipeServiceImpl;
use App\Services\RecipeServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RecipeRepositoryInterface::class, RecipeRepositoryImpl::class);
        $this->app->bind(RecipeServiceInterface::class, RecipeServiceImpl::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepositoryImpl::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryServiceImpl::class);
        $this->app->bind(CousineRepositoryInterface::class, CousineRepositoryImpl::class);
        $this->app->bind(CousineServiceInterface::class, CousineServiceImpl::class);
        $this->app->bind(IngredientRepositoryInterface::class, IngredientRepositoryImpl::class);
        $this->app->bind(IngredientServiceInterface::class, IngredientServiceImpl::class);
        $this->app->bind(InstructionRepositoryInterface::class, InstructionRepositoryImpl::class);
        $this->app->bind(InstructionServiceInterface::class, InstructionServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
