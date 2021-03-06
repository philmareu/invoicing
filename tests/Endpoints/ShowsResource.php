<?php

namespace Tests\Endpoints;

use Illuminate\Database\Eloquent\Model;

trait ShowsResource
{
    abstract public function getStandardAttributes(): array;

    abstract public function getStandardResponse(Model $resource): array;

    public function testReturnsInvoiceResource()
    {
        $resource = $this->createResource(
            $this->getStandardAttributes()
        );

        $this->callAuthenticated()
            ->getJson($this->getUri($resource))
            ->assertStatus(200)
            ->assertJson(
                $this->getStandardResponse(
                    $resource
                )
            );
    }
}
