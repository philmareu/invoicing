<?php

namespace Tests\Endpoints\Customers;

use App\Models\Customer;
use Tests\Endpoints\ResourceTestCase;

class DestroyCustomersTest extends ResourceTestCase
{
    public function testDestroysCustomerResource()
    {
        $customer = Customer::factory()
            ->create();

        $this->callAuthenticated()
            ->deleteJson($this->getUri($customer))
            ->assertStatus(200)
            ->assertJson([
                'Customer deleted.'
            ]);

        $this->assertDatabaseMissing(
            'customers',
            [
                'id' => $customer->id
            ]
        );
    }
}
