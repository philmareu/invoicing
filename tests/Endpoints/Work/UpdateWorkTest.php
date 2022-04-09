<?php

namespace Tests\Endpoints\Work;

use App\Models\Invoice;
use Tests\Endpoints\HasValidations;
use Tests\Endpoints\ResourceTestCase;

class UpdateWorkTest extends ResourceTestCase
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

    public function testUpdatesResource()
    {
        $invoice = Invoice::factory()
            ->create();

        $work = $this->createResource();

        $this
            ->callAuthenticated()
            ->putJson(
                $this->getUri($work),
                [
                    'invoice_id' => $invoice->id
                ]
            )
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $work->id,
                    'invoice_id' => $invoice->id
                ]
            ]);

        $this->assertDatabaseHas(
            'work',
            [
                'id' => $work->id,
                'invoice_id' => $invoice->id
            ]
        );
    }
}
