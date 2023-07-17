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
  public function un_comentario_debe_usar_trait_has_like(): void
  {
    $this->assertClassUsersTrait('App\Traits\HasLike', Comment::class);
  }
}
