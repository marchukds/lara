<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    public function test_example(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_example_name(): void
    {
        $response = $this->get('/hello/world');
        $response->assertStatus(200);
    }

    public function test_valid_number(): void
    {
        $response = $this->get('/hello/15');
        $response->assertStatus(200);
    }

    public function test_valid_string_number(): void
    {
        $response = $this->get('/hello/test/15');
        $response->assertStatus(200);
    }
}
