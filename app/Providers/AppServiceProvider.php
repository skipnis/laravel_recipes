<?php

namespace App\Providers;

use App\Repositories\CategoryRepositoryImpl;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CousineRepositoryImpl;
use App\Repositories\CousineRepositoryInterface;
use App\Repositories\FavoriteRepositoryImpl;
use App\Repositories\FavoriteRepositoryInterface;
use App\Repositories\IngredientRecipeRepositoryImpl;
use App\Repositories\IngredientRecipeRepositoryInterface;
use App\Repositories\IngredientRepositoryImpl;
use App\Repositories\IngredientRepositoryInterface;
use App\Repositories\InstructionRepositoryImpl;
use App\Repositories\InstructionRepositoryInterface;
use App\Repositories\RecipeRepositoryImpl;
use App\Repositories\RecipeRepositoryInterface;
use App\Repositories\ReviewRepositoryImpl;
use App\Repositories\ReviewRepositoryInterface;
use App\Repositories\UserRepositoryImpl;
use App\Repositories\UserRepositoryInterface;
use App\Services\CategoryServiceImpl;
use App\Services\CategoryServiceInterface;
use App\Services\CousineServiceImpl;
use App\Services\CousineServiceInterface;
use App\Services\FavoriteServiceImpl;
use App\Services\FavoriteServiceInterface;
use App\Services\IngredientRecipeServiceImpl;
use App\Services\IngredientRecipeServiceInterface;
use App\Services\IngredientServiceImpl;
use App\Services\IngredientServiceInterface;
use App\Services\InstructionServiceImpl;
use App\Services\InstructionServiceInterface;
use App\Services\RecipeServiceImpl;
use App\Services\RecipeServiceInterface;
use App\Services\ReviewServiceImpl;
use App\Services\ReviewServiceInterface;
use App\Services\UserServiceImpl;
use App\Services\UserServiceInterface;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryImpl::class);
        $this->app->bind(UserServiceInterface::class, UserServiceImpl::class);
        $this->app->bind(IngredientRecipeRepositoryInterface::class, IngredientRecipeRepositoryImpl::class);
        $this->app->bind(IngredientRecipeServiceInterface::class, IngredientRecipeServiceImpl::class);
        $this->app->bind(FavoriteRepositoryInterface::class, FavoriteRepositoryImpl::class);
        $this->app->bind(FavoriteServiceInterface::class, FavoriteServiceImpl::class);
        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepositoryImpl::class);
        $this->app->bind(ReviewServiceInterface::class, ReviewServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
