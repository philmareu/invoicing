<?php

namespace Tests\Endpoints\Invoices;

use Illuminate\Database\Eloquent\Model;
use Tests\Endpoints\ResourceTestCase;
use Tests\Endpoints\ShowsResource;

class ShowInvoicesTest extends ResourceTestCase
{
    use ShowsResource;

    public function getStandardResponse(Model $resource): array
    {
        return [
            'data' => [
                'id' => $resource->id,
                'customer_id' => $resource->customer_id
            ]
        ];
    }
}
