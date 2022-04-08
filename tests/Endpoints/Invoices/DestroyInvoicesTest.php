<?php

namespace Tests\Endpoints\Invoices;

use App\Models\Invoice;
use Tests\Endpoints\ResourceTestCase;

class DestroyInvoicesTest extends ResourceTestCase
{
    public function testDestroysInvoiceResource()
    {
        $invoice = Invoice::factory()
            ->create();

        $this->callAuthenticated()
            ->deleteJson($this->getUri($invoice))
            ->assertStatus(200)
            ->assertJson([
                'Invoice deleted.'
            ]);

        $this->assertDatabaseMissing(
            'invoices',
            [
                'id' => $invoice->id
            ]
        );
    }
}
