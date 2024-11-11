<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user;
    protected $headers;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->setJwtAuthHeaders();
    }

    protected function setJwtAuthHeaders()
    {
        $token = auth()->guard('api')->login($this->user);
        $this->headers = [
            'Authorization' => "Bearer $token"
        ];
    }

    protected function actingAsApiUser()
    {
        return $this->withHeaders($this->headers);
    }
}
