<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PostsTest extends TestCase
{
    /**
     * User posts endpoints
     */
    public function test_user_post_endpoints(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/api/posts');
        $response->assertStatus(200);

        $response = $this->get('/api/post/2');
        $response->assertStatus(200);

        $response = $this->get('/api/post/asdf');
        $response->assertStatus(500);
    }
}
