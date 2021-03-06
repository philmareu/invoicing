<?php

namespace Tests\Endpoints;

use Illuminate\Database\Eloquent\Model;

trait ListsResources
{
    abstract public function getStandardAttributes(): array;

    abstract public function getStandardResponse(Model $resource): array;

    public function testReturnsListOfResources()
    {
        $resource = $this->createResource(
            $this->getStandardAttributes()
        );

        $this
            ->callAuthenticated()
            ->getJson(
                $this->getUri()
            )
            ->assertStatus(200)
            ->assertJson(
                $this->getStandardResponse(
                    $resource
                )
            );
    }
}
