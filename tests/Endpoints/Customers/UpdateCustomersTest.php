<?php

namespace Tests\Feature\Endpoints\Customers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCustomersTest extends TestCase
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

        $customer = Customer::factory()
            ->create();

        collect($this->validations)
            ->each(function ($validation) use ($user, $customer) {

                $this
                    ->actingAs($user)
                    ->putJson(
                        route('api.customers.update', $customer->id),
                        $validation['payload']
                    )
                    ->assertStatus(422)
                    ->assertJsonValidationErrors($validation['errors']);
            });
    }

    public function testGuestsNotAllowed()
    {
        $this->putJson(
            route('api.customers.update', 1)
        )
            ->assertStatus(401);
    }

    public function testUpdatesCustomer()
    {
        $user = User::factory()
            ->forRole()
            ->create();

        $customer = Customer::factory()
            ->create([
                'name' => 'Harvest Co.'
            ]);

        $this
            ->actingAs($user)
            ->putJson(
                route('api.customers.update', $customer->id),
                [
                    'name' => 'Acme, Co.'
                ]
            )
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Acme, Co.'
            ]);

        $this->assertDatabaseHas(
            'customers',
            [
                'id' => $customer->id,
                'name' => 'Acme, Co.'
            ]
        );
    }
}
