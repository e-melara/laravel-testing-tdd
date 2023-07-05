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
        $response = $this->post(route('statuses.store'), ['body' => 'Mi primer estado']);
        $response->assertJson([
            'body' => 'Mi primer estado'
        ]);
        $response->assertJson([
            "body" => "Mi primer estado",
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
}
