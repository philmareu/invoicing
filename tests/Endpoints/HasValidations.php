<?php

namespace Tests\Endpoints;

trait HasValidations
{
    abstract public function getValidations(): array;

    public function testValidation()
    {
        collect($this->getValidations())
            ->each(function ($validation) {

                $this
                    ->callAuthenticated()
                    ->json(
                        $this->getMethod(),
                        $this->getGenericUri(),
                        $validation['payload']
                    )
                    ->assertStatus(422)
                    ->assertJsonValidationErrors($validation['errors']);
            });
    }
}
