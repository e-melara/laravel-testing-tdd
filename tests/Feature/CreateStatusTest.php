<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_usuario_auteticado_puede_crear_estado(): void
    {
        // 1. Given => Teniendo un usuario autenticado
        $user = User::factory()->create();
        $this->actingAs($user);
        // 2. When => Cuando hace un post request a status
        $response = $this->postJson(route('statuses.store'), ['body' => 'Mi primer estado']);

        $response->assertJson([
          "data" => [ "body" => "Mi primer estado" ],
        ]);
        // 3. Then => Entonces veo un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer estado'
        ]);
    }

    /** @test */
    public function un_usuario_no_auteticado_no_puede_crear_estados(): void
    {
        $response = $this->post(route('statuses.store'), ['body' => 'Mi primer estado']);
        $response->assertRedirect('login');
    }

    /** @test */
    public function un_estado_requiere_un_body()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson(route('statuses.store'), ['body' => '']);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }

    /** @test */
    public function un_estado_debe_tener_cantidad_minima()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson(route('statuses.store'), ['body' => 'aaa']);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }
}
