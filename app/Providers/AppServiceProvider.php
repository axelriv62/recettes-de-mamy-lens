<?php

namespace App\Providers;

use App\Models\Ingredient;
use App\Models\Recette;
use App\Models\User;
use App\Policies\IngredientPolicy;
use App\Policies\RecettePolicy;
use App\Repositories\IIngredientRepository;
use App\Repositories\IngredientRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Recette::class => RecettePolicy::class,
        Ingredient::class => IngredientPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IIngredientRepository::class, IngredientRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('delete-recette', function (User $user, Recette $recette) {
            return $user->id === $recette->user_id;
        });

        Gate::define('delete-ingredient', function (User $user, Ingredient $ingredient) {
            return $user->id === $ingredient->user_id;
        });

    }
}
