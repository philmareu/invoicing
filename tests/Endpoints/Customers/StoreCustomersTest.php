<?php

namespace Tests\Feature\Endpoints\Customers;

use App\Models\User;
use Tests\Endpoints\ResourceTestCase;

class StoreCustomersTest extends ResourceTestCase
{
    protected $validations = [
        [
            'payload' => [],
            'errors' => ['name']
        ]
    ];

    public function testValidation()
    {
        $user = User::factory()
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

    public function testCreatesCustomer()
    {
        $this
            ->callAuthenticated()
            ->postJson(
                $this->getUri(),
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
