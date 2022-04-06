<?php

namespace Tests\Feature\Endpoints\Customers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCustomersTest extends TestCase
{
    use RefreshDatabase;

    protected $validations = [
        [
            'payload' => [],
            'errors' => ['name']
        ]
    ];

    public function testValidation()
    {
        $user = User::factory()
            ->forRole()
            ->create();

        collect($this->validations)
            ->each(function ($validation) use ($user) {

                $this
                    ->actingAs($user)
                    ->postJson(
                    route('api.customers.store'),
                    $validation['payload']
                )
                    ->assertJsonValidationErrors($validation['errors']);
            });
    }

    public function testGuestsNotAllowed()
    {
        $this->postJson(
            route('api.customers.store')
        )
            ->assertStatus(401);
    }

    public function testCreatesCustomer()
    {
        $user = User::factory()
            ->forRole()
            ->create();

        $this
            ->actingAs($user)
            ->postJson(
            route('api.customers.store'),
            [
                'name' => 'Acme, Co.'
            ]
        )
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Acme, Co.'
                ]
            ]);

        $this->assertDatabaseHas(
            'customers',
            [
                'name' => 'Acme, Co.'
            ]
        );
    }
}
