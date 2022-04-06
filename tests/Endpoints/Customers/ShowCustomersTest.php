<?php

namespace Tests\Feature\Endpoints\Customers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCustomersTest extends TestCase
{
    public function testGuestsNotAllowed()
    {
        $this->getJson(
            route('api.customers.show', 1)
        )
            ->assertStatus(401);
    }

    public function testReturnsCustomerResource()
    {
        $user = User::factory()
            ->forRole()
            ->create();

        $customer = Customer::factory()
            ->create();

        $this->actingAs($user)
            ->getJson(route('api.customers.show', $customer->id))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $customer->name
                ]
            ]);
    }
}
