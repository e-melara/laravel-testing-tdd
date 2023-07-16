<?php

namespace Tests\Feature;

use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCommentTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function un_usuario_autenticado_puede_crear_comentario() : void
    {
        $comment = ['body' => 'Mi primer comentario'];
        $user = User::factory()->create();
        $status = Status::factory()->create();

        $this->actingAs($user);
        $response = $this->postJson(route('statuses.comments.store', $status), $comment);

        $response->assertJson([
            'data' => ['body' => $comment['body']]
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'status_id' => $status->id,
            'body' => $comment['body']
        ]);
    }
}
