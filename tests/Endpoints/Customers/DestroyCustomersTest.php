<?php

namespace Tests\Feature\Endpoints\Customers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyCustomersTest extends TestCase
{
    public function testGuestsNotAllowed()
    {
        $this->putJson(
            route('api.customers.destroy', 1)
        )
            ->assertStatus(401);
    }

    public function testDestroysCustomerResource()
    {
        $user = User::factory()
            ->forRole()
            ->create();

        $customer = Customer::factory()
            ->create();

        $this->actingAs($user)
            ->deleteJson(route('api.customers.destroy', $customer->id))
            ->assertStatus(200)
            ->assertJson([
                'Customer deleted.'
            ]);
    }
}
