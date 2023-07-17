<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;

class CommentTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function un_usuario_pertence_a_un_comentario(): void
  {
    $this->withoutExceptionHandling();
    $comment = Comment::factory()->create();
    $this->assertInstanceOf('App\Models\User', $comment->user);
  }

  /** @test */
  public function un_comentario_tiene_muchos_me_gustas(): void
  {
    $comment = Comment::factory()->create();

    Like::factory()->create([
      'likeable_id' => $comment->id,
      'likeable_type' => get_class($comment)
    ]);

    $this->assertInstanceOf(Like::class, $comment->likes->first());
  }

  /** @test */
  public function un_comentario_solo_puede_tener_un_me_gusta_de_un_usuario(): void
  {
    $comment = Comment::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user);

    $comment->like();
    $comment->like();
    $this->assertEquals(1, $comment->likes()->count());
  }

  /** @test */
  public function saber_si_un_usuario_ya_le_dio_me_gusta_a_un_comentario(): void
  {
    $comment = Comment::factory()->create();
    $this->assertFalse($comment->isLiked());
    $user = User::factory()->create();
    $this->actingAs($user);
    $comment->like();
    $this->assertTrue($comment->isLiked());
  }
}
