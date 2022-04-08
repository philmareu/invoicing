<?php

namespace Tests\Endpoints\Invoices;

use App\Models\Invoice;
use Tests\Endpoints\ResourceTestCase;

class IndexInvoicesTest extends ResourceTestCase
{
    public function testReturnsListOfResources()
    {
        $invoice = Invoice::factory()
            ->create();

        $this
            ->callAuthenticated()
            ->getJson(
                $this->getUri()
            )
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $invoice->id,
                        'customer_id' => $invoice->customer_id
                    ]
                ]
            ]);
    }
}
