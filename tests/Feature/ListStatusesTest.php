<?php

namespace Tests\Feature;

use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListStatusesTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function usuario_logueando_puede_ver_estados(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Status::factory()->create(["created_at" => now()->subDay('3')]);
        Status::factory()->create(["created_at" => now()->subDay('2')]);
        Status::factory()->create(["created_at" => now()->subDay('1')]);
        $status4 = Status::factory()->create();

        $response = $this->getJson(route('statuses.index'));
        $response->assertSuccessful();
        $response->assertJson([
            'total' => 4
        ]);

        $response->assertJsonStructure([
            'data', 'total', 'first_page_url', 'last_page_url'
        ]);

        $this->assertEquals(
            $status4->id,
            $response->json('data.0.id')
        );
    }
}
