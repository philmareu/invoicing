<?php

namespace Tests\Feature\Endpoints\Customers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Endpoints\ResourceTestCase;
use Tests\TestCase;

class IndexCustomersTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestsNotAllowed()
    {
        $this->getJson(
            route('api.customers.index')
        )
            ->assertStatus(401);
    }

    public function testReturnsListOfResources()
    {
        $user = User::factory()
            ->forRole()
            ->create();

        Customer::factory()
            ->create([
                'name' => 'Acme, Co.'
            ]);

        $this
            ->actingAs($user)
            ->getJson(
            route('api.customers.index')
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
