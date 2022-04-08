<?php

namespace Tests\Endpoints\Invoices;

use Tests\Endpoints\ResourceTestCase;

class IndexInvoicesTest extends ResourceTestCase
{
    public function testReturnsListOfResources()
    {
        $invoice = $this->createResource();

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
