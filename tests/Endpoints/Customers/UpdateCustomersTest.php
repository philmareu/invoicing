<?php

namespace Tests\Feature\Endpoints\Customers;

use App\Models\Customer;
use App\Models\User;
use Tests\Endpoints\ResourceTestCase;

class UpdateCustomersTest extends ResourceTestCase
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

    public function testUpdatesCustomer()
    {
        $customer = Customer::factory()
            ->create([
                'name' => 'Harvest Co.'
            ]);

        $this
            ->callAuthenticated()
            ->putJson(
                $this->getUri($customer),
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
