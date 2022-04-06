<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;

trait InstallsApp
{
    public function install()
    {
        User::factory()
            ->for(
                Role::factory()
                    ->owner()
            )
            ->create();
    }
}
