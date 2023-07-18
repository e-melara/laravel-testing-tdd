<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentResourceTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function un_resource_comment_tiene_los_datos_necesarios(): void
  {
    $comment = Comment::factory()->create();
    $response = CommentResource::make($comment)->resolve();
    $this->assertEquals($comment->user->link(), $response['user_link']);
    $this->assertEquals($comment->body, $response['body']);
    $this->assertEquals($comment->user->name, $response['user_name']);
    $this->assertEquals($comment->user->avatar(), $response['user_avatar']);
    $this->assertEquals($comment->id, $response['id']);
    $this->assertFalse($comment->isLiked());
    $this->assertEquals(0, $response['likes_count']);
  }
}
