<?php

namespace Tests\Endpoints\Invoices;

use App\Models\Customer;
use Tests\Endpoints\HasValidations;
use Tests\Endpoints\ResourceTestCase;

class UpdateInvoicesTest extends ResourceTestCase
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

    public function testUpdatesResource()
    {
        $customer = Customer::factory()
            ->create();

        $invoice = $this->createResource();

        $this
            ->callAuthenticated()
            ->putJson(
                $this->getUri($invoice),
                [
                    'customer_id' => $customer->id
                ]
            )
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'customer_id' => $customer->id
                ]
            ]);

        $this->assertDatabaseHas(
            'invoices',
            [
                'id' => $invoice->id,
                'customer_id' => $customer->id
            ]
        );
    }
}
