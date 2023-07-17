<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use App\Models\Status;
use App\Models\User;

class CanLikeStatusesTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function un_usuario_autenticado_puede_dar_me_gusta_a_un_estado_y_quitar_me_gusta(): void
  {
    $user = User::factory()->create();
    $status = Status::factory()->create();

    $this->assertCount(0, $status->likes);
    $this->actingAs($user)->postJson(route('statuses.likes.store', $status));
    $this->assertCount(1, $status->fresh()->likes);
    $this->assertDatabaseHas('likes', [
      'user_id' => $user->id,
    ]);
    $this->actingAs($user)->deleteJson(route('statuses.likes.destroy', $status));
    $this->assertCount(0, $status->fresh()->likes);
    $this->assertDatabaseMissing('likes', [
      'user_id' => $user->id,
    ]);
  }
}
