<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IngredientPolicy {
    use HandlesAuthorization;

    public function before(User $user, string $ability): bool|null {
        if ($user->role === Role::ADMIN) {
            return true;
        }

        return null;
    }

    public function update(User $user, Ingredient $ingredient) {
        return $user->id === $ingredient->user_id;
    }

    public function delete(User $user, Ingredient $ingredient) {
        return $user->id === Role::ADMIN ;
    }

    public function create(User $user) {
        return true;
    }
}
