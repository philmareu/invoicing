<?php

namespace Tests\Endpoints;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

abstract class ResourceTestCase extends TestCase
{
    use RefreshDatabase;

    protected $prefix = 'api';

    protected $resource;

    protected $action;

    protected $methodMap = [
        'index' => 'GET',
        'show' => 'GET',
        'create' => 'POST',
        'update' => 'PUT',
        'delete' => 'DELETE'
    ];

    protected $validations;

    public function testGuestsNotAllowed()
    {
        $this->json(
            $this->getMethod(),
            $this->getUri(
                in_array($this->getAction(), ['destroy', 'update', 'show'])
                    ? 1
                    : null
            )
        )
            ->assertStatus(401);
    }

    public function getMethod()
    {
        return $this->methodMap[
            $this->getAction()
        ];
    }

    public function getAction()
    {
        if ($this->action) {
            return $this->action;
        }

        return $this->action = $this->parsedClassName()['action'];
    }

    public function getResource()
    {
        if ($this->resource) {
            return $this->resource;
        }

        return $this->resource = $this->parsedClassName()['resource'];
    }

    public function createResource(): Model
    {
        return $this->getResourceModel()::factory()
            ->create();
    }

    public function getGenericUri()
    {
        return $this->getUri(
            in_array($this->getAction(), ['destroy', 'update', 'show'])
                ? $this->createResource()->id
                : null
        );
    }

    public function getUri($routeParameters = null)
    {
        return route(
            sprintf(
                '%s.%s.%s',
                $this->prefix,
                $this->getResource(),
                $this->getAction()
            ),
            $routeParameters
        );
    }

    protected function callAuthenticated()
    {
        return $this->actingAs(User::factory()
            ->forRole()
            ->create()
        );
    }

    private function getResourceModel()
    {
        return ('App\\Models\\' . Str::ucfirst(
                Str::singular(
                    $this->getResource()
                )
            ));
    }

    private function parsedClassName()
    {
        list($action, $resource) = explode(
            '_',
            Str::snake($this->getClassName())
        );

        return [
            'action' => $action,
            'resource' => $resource
        ];
    }

    private function getClassName()
    {
        return class_basename(
            get_called_class()
        );
    }
}
