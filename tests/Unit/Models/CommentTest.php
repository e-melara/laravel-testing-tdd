<?php

namespace Tests\Unit\Models;

use App\Models\Like;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
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
}
