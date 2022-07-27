<?php

namespace Tests\Endpoints\Customers;

use App\Models\Customer;
use Tests\Endpoints\HasValidations;
use Tests\Endpoints\ResourceTestCase;

class UpdateCustomersTest extends ResourceTestCase
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

    public function testUpdatesResource()
    {
        // create with endpoint
        // e.x $customer = $this->postJson('', []);

        $this
            ->callAuthenticated()
            ->putJson(
                $this->getUri($customer),
                [
                    'name' => 'Acme, Co.'
                ]
            )
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Acme, Co.'
                ]
            ]);

        // check using endpoint
        // $this->getJson('')->assertJsonFragment();
    }
}
