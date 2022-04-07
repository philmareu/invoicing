<?php

namespace Tests\Feature\Endpoints\Customers;

use App\Models\Customer;
use Tests\Endpoints\ResourceTestCase;

class IndexCustomersTest extends ResourceTestCase
{
    public function testReturnsListOfResources()
    {
        Customer::factory()
            ->create([
                'name' => 'Acme, Co.'
            ]);

        $this
            ->callAuthenticated()
            ->getJson(
            $this->getUri()
        )
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'name' => 'Acme, Co.'
                    ]
                ]
            ]);
    }
}
