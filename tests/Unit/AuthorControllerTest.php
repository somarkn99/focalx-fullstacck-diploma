<?php

namespace Tests\Unit;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    // public function test_example(): void
    // {
    //     $this->assertTrue(true);
    // }

    public function test_it_can_list()
    {
        Author::factory()->count(3)->create();

        $response = $this->getJson('/api/authors');

        $response->assertStatus(200);
    }

    public function test_it_can_create()
    {
        $response = $this->postJson('/api/authors', [
            'name' => 'Test Author',
        ]);

        $response->assertStatus(201)
        ->assertJsonFragment(['name' => 'John Doe']);
        $this->assertDatabaseHas('authors', ['name' => 'John Doe']);
    }
}
