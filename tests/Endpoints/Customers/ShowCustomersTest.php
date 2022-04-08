<?php

namespace Tests\Endpoints\Customers;

use Illuminate\Database\Eloquent\Model;
use Tests\Endpoints\ResourceTestCase;
use Tests\Endpoints\ShowsResource;

class ShowCustomersTest extends ResourceTestCase
{
    use ShowsResource;

    public function getStandardResponse(Model $resource): array
    {
        return [
            'data' => [
                'id' => $resource->id,
                'name' => $resource->name
            ]
        ];
    }
}
