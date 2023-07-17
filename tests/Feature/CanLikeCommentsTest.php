<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;


use App\Models\Comment;
use App\Models\User;
use Tests\TestCase;



class CanLikeCommentsTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function un_usuario_no_autenticado_no_puede_dar_me_gusta_a_un_comentario(): void
  {
    $comment = Comment::factory()->create();
    $this->postJson(route('comments.likes.store', $comment))
      ->assertStatus(401);
  }


  /** @test */
  public function un_usuario_autenticado_puede_dar_me_gusta_a_un_comentario_y_quitar_me_gusta(): void
  {
    $user = User::factory()->create();
    $comment = Comment::factory()->create();

    $this->assertCount(0, $comment->likes);
    $this->actingAs($user);
    $this->postJson(route('comments.likes.store', $comment));
    $this->assertCount(1, $comment->fresh()->likes);
    $this->assertDatabaseHas('likes', [
      'user_id' => $user->id,
    ]);
    $this->actingAs($user)->deleteJson(route('comments.likes.destroy', $comment));
    $this->assertCount(0, $comment->fresh()->likes);
    $this->assertDatabaseMissing('likes', [
      'user_id' => $user->id,
    ]);
  }
}
