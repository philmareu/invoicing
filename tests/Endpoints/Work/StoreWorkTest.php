<?php

namespace Tests\Endpoints\Work;

use App\Models\Invoice;
use Tests\Endpoints\HasValidations;
use Tests\Endpoints\ResourceTestCase;

class StoreWorkTest extends ResourceTestCase
{
    use HasValidations;

    public function getValidations(): array
    {
        return [
            [
                'payload' => [],
                'errors' => ['invoice_id']
            ]
        ];
    }

    public function testStoresResource()
    {
        $invoice = Invoice::factory()
            ->create();

        $this
            ->callAuthenticated()
            ->postJson(
                $this->getUri(),
                [
                    'invoice_id' => $invoice->id
                ]
            )
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'invoice_id' => $invoice->id
                ]
            ]);

        $this->assertDatabaseHas(
            'work',
            [
                'invoice_id' => $invoice->id
            ]
        );
    }
}
