<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\User;
use App\Models\Like;
use App\Models\Status;
use App\Models\Comment;

class StatusTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function un_modelo_estado_tiene_una_relacion_con_usuario(): void
  {
    $status = Status::factory()->create();
    $this->assertInstanceOf(User::class, $status->user);
  }
}
