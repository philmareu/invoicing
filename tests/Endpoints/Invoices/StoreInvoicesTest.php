<?php

namespace Tests\Endpoints\Invoices;

use App\Models\Customer;
use Tests\Endpoints\HasValidations;
use Tests\Endpoints\ResourceTestCase;

class StoreInvoicesTest extends ResourceTestCase
{
    use HasValidations;

    public function getValidations(): array
    {
        return [
            [
                'payload' => [],
                'errors' => ['customer_id']
            ]
        ];
    }

    public function testStoresResource()
    {
        $customer = Customer::factory()
            ->create();

        $this
            ->callAuthenticated()
            ->postJson(
                $this->getUri(),
                [
                    'customer_id' => $customer->id
                ]
            )
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'customer_id' => $customer->id
                ]
            ]);

        $this->assertDatabaseHas(
            'invoices',
            [
                'customer_id' => $customer->id
            ]
        );
    }
}
