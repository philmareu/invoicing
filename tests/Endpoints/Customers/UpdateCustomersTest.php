<?php

namespace Tests\Endpoints\Customers;

use App\Models\Customer;
use Tests\Endpoints\HasValidations;
use Tests\Endpoints\ResourceTestCase;

class UpdateCustomersTest extends ResourceTestCase
{
    use HasValidations;

    public function getValidations(): array
    {
        return [
            [
                'payload' => [],
                'errors' => ['name']
            ]
        ];
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
                'data' => [
                    'name' => 'Acme, Co.'
                ]
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
