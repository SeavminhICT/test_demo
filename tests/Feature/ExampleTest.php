<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_public_pages_return_successful_responses(): void
    {
        foreach (['/', '/blog', '/blog/1', '/experiments', '/about', '/contact'] as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_unknown_blog_post_returns_not_found(): void
    {
        $this->get('/blog/999')->assertNotFound();
    }
}
