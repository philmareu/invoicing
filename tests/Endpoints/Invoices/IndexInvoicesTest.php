<?php

namespace Tests\Endpoints\Invoices;

use Illuminate\Database\Eloquent\Model;
use Tests\Endpoints\ListsResources;
use Tests\Endpoints\ResourceTestCase;

class IndexInvoicesTest extends ResourceTestCase
{
    use ListsResources;

    public function getStandardAttributes(): array
    {
        return [];
    }

    public function getStandardResponse(Model $resource): array
    {
        return [
            'data' => [
                [
                    'id' => $resource->id,
                    'customer_id' => $resource->customer_id
                ]
            ]
        ];
    }
}
