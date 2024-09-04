<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleFeatureTest extends TestCase
{

  use RefreshDatabase;

    public function test_home_page_loads_correctly()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Welcome');
    }
}
