<?php

namespace Tests\Endpoints\Customers;

use Tests\Endpoints\HasValidations;
use Tests\Endpoints\ResourceTestCase;

class StoreCustomersTest extends ResourceTestCase
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

    public function testStoresResource()
    {
        $this
            ->callAuthenticated()
            ->postJson(
                $this->getUri(),
                [
                    'name' => 'Acme, Co.'
                ]
            )
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Acme, Co.'
                ]
            ]);

        // check using endpoint
        // $this->getJson('')->assertJsonFragment();
    }
}
