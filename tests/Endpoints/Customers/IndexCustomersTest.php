<?php

namespace Tests\Endpoints\Customers;

use App\Models\Customer;
use Tests\Endpoints\ResourceTestCase;

class IndexCustomersTest extends ResourceTestCase
{
    public function testReturnsListOfResources()
    {
        $customer = Customer::factory()
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
                        'id' => $customer->id,
                        'name' => 'Acme, Co.'
                    ]
                ]
            ]);
    }
}
