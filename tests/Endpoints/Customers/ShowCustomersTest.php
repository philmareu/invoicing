<?php

namespace Tests\Endpoints\Customers;

use App\Models\Customer;
use Tests\Endpoints\ResourceTestCase;

class ShowCustomersTest extends ResourceTestCase
{
    public function testReturnsCustomerResource()
    {
        $customer = Customer::factory()
            ->create();

        $this->callAuthenticated()
            ->getJson($this->getUri($customer))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $customer->name
                ]
            ]);
    }
}
