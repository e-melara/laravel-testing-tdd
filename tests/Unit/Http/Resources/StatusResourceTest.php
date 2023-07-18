<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\CommentResource;
use App\Http\Resources\StatusResource;
use App\Models\Comment;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusResourceTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function un_resource_tiene_los_datos_necesarios(): void
  {
    $status = Status::factory()->create();
    Comment::factory()->create([
      'status_id' => $status->id,
    ]);
    $response = StatusResource::make($status)->resolve();
    $this->assertEquals($status->user->link(), $response['user_link']);
    $this->assertEquals($status->body, $response['body']);
    $this->assertEquals($status->user->name, $response['user_name']);
    $this->assertEquals($status->user->avatar(), $response['user_avatar']);
    $this->assertEquals($status->created_at->diffForHumans(), $response['ago']);
    $this->assertFalse($status->isLiked());
    $this->assertEquals(0, $response['likes_count']);
    $this->assertEquals(
      CommentResource::class, $response['comments']->collects
    );
    $this->assertInstanceOf(Comment::class, $response['comments']->first()->resource);
  }
}
