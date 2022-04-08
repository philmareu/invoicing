<?php

namespace Tests\Endpoints\Customers;

use Illuminate\Database\Eloquent\Model;
use Tests\Endpoints\ListsResources;
use Tests\Endpoints\ResourceTestCase;

class IndexCustomersTest extends ResourceTestCase
{
    use ListsResources;

    public function getStandardAttributes(): array
    {
        return [
            'name' => 'Acme, Co.'
        ];
    }

    public function getStandardResponse(Model $resource): array
    {
        return [
            'data' => [
                [
                    'id' => $resource->id,
                    'name' => 'Acme, Co.'
                ]
            ]
        ];
    }
}
