<?php

namespace Tests\Http;

use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function testLoginPageLoads()
    {
        $this
            ->get(route('login'))
            ->assertStatus(200);
    }
}
