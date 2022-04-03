<?php

namespace Tests\Endpoints\Installations;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PostInstallationsTest extends TestCase
{
    use DatabaseMigrations;

    protected $validations = [
        [
            'payload' => [],
            'errors' => ['name', 'email', 'password']
        ],
        [
            'payload' => [
                'email' => 'not an email'
            ],
            'errors' => ['email']
        ],
        [
            'payload' => [
                'password' => 'not6'
            ],
            'errors' => ['password']
        ]
    ];

    public function testReturnsUnauthorizedIfInstalled()
    {
        User::factory()
            ->for(Role::factory()->state([
                'slug' => 'owner',
                'role' => 'Owner'
            ]))
            ->create();

        $this->postJson(
            route('api.installations.store'),
            [
                'name' => 'Bob',
                'email' => 'bob@bob.com',
                'password' => 'spacesuit'
            ]
        )
            ->assertStatus(403);
    }

    public function testValidation()
    {
        collect($this->validations)
            ->each(function ($validation) {

                $this->postJson(
                    route('api.installations.store'),
                    $validation['payload']
                )
                    ->assertJsonValidationErrors($validation['errors']);
            });
    }

    public function testCreatesOwner()
    {
        Role::factory()
            ->owner()
            ->create();

        $this->postJson(
            route('api.installations.store'),
            [
                'name' => 'Bob',
                'email' => 'bob@bob.com',
                'password' => 'suitcases'
            ]
        )->assertStatus(200);

        $this->assertTrue(
            Auth::attempt([
                'email' => 'bob@bob.com',
                'password' => 'suitcases'
            ])
        );
    }
}
