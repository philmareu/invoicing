<?php

namespace Tests\Endpoints\Invoices;

use Tests\Endpoints\ResourceTestCase;

class DestroyInvoicesTest extends ResourceTestCase
{
    public function testDestroysInvoiceResource()
    {
        $invoice = $this->createResource();

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
