<?php

namespace Tests\Http;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstallsPageTest extends TestCase
{
    use RefreshDatabase;

    public function testPageLoadsWhenInstallRequired()
    {
        $this->get(route('install'))
            ->assertStatus(200);
    }

    public function testRedirectsHomeIfInstalled()
    {
        User::factory()
            ->for(Role::factory()->state([
                'slug' => 'owner',
                'role' => 'Owner'
            ]))
            ->create();

        $this->get(route('install'))
            ->assertRedirect(route('home'));
    }
}
