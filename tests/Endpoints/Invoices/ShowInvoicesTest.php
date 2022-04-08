<?php

namespace Tests\Endpoints\Invoices;

use App\Models\Invoice;
use Tests\Endpoints\ResourceTestCase;

class ShowInvoicesTest extends ResourceTestCase
{
    public function testReturnsInvoiceResource()
    {
        $invoice = Invoice::factory()
            ->create();

        $this->callAuthenticated()
            ->getJson($this->getUri($invoice))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $invoice->id,
                    'customer_id' => $invoice->customer_id
                ]
            ]);
    }
}
