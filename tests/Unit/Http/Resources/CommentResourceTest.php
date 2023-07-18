<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_resource_comment_tiene_los_datos_necesarios(): void
    {
        $comment = Comment::factory()->create();
        $response = CommentResource::make($comment)->resolve();
        $this->assertEquals($comment->body, $response['body']);
        $this->assertEquals($comment->user->name, $response['user_name']);
        $this->assertEquals('/images/avatar.jpg', $response['user_avatar']);
        $this->assertEquals($comment->id, $response['id']);
        $this->assertEquals(0, $response['count_likes']);
        $this->assertFalse($comment->isLiked());
    }
}
