<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Posts;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/posts');
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = factory(Posts::class)->make();
        $response->assertStatus(200);
    }
}
