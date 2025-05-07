<?php

namespace Domain\Users\Actions;

use App\Notifications\test;
use Domain\Users\Models\User;

class UserDestroyAction
{
    public function __invoke(User $user): void
    {
        $user->delete();
    }
}
