<?php

namespace Tests\Endpoints\Work;

use Illuminate\Database\Eloquent\Model;
use Tests\Endpoints\ResourceTestCase;
use Tests\Endpoints\ShowsResource;

class ShowWorkTest extends ResourceTestCase
{
    use ShowsResource;

    public function getStandardAttributes(): array
    {
        return [];
    }

    public function getStandardResponse(Model $resource): array
    {
        return [
            'data' => [
                'id' => $resource->id,
                'invoice_id' => $resource->invoice_id
            ]
        ];
    }
}
