<?php

namespace Tests\Unit\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function un_usuario_pertence_a_un_comentario() : void
    {
        $this->withoutExceptionHandling();
        $comment = Comment::factory()->create();
        $this->assertInstanceOf('App\Models\User', $comment->user);
    }
}
