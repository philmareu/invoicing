<?php

namespace Tests\Endpoints;

trait DestroysResource
{
    public function testDestroysResource()
    {
        $resource = $this->createResource();

        $this->callAuthenticated()
            ->deleteJson($this->getUri($resource))
            ->assertStatus(200)
            ->assertJson([
                'Deleted.'
            ]);

        $this->assertDatabaseMissing(
            $this->getResource(),
            [
                'id' => $resource->id
            ]
        );
    }
}
