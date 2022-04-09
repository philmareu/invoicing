<?php

namespace Tests\Endpoints\Work;

use Illuminate\Database\Eloquent\Model;
use Tests\Endpoints\ListsResources;
use Tests\Endpoints\ResourceTestCase;

class IndexWorkTest extends ResourceTestCase
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
                    'invoice_id' => $resource->invoice_id
                ]
            ]
        ];
    }
}
