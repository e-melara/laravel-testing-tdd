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
    public function un_usuario_autenticado_puede_dar_me_gusta_a_un_estado() : void
    {
        $user = User::factory()->create();
        $status = Status::factory()->create();

        $this->actingAs($user)->postJson(route('statuses.likes.store', $status));
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'status_id' => $status->id
        ]);
    }

    /** @test */
    public function un_usuario_autenticado_puede_dar_no_me_gusta_a_un_estado() : void
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $status = Status::factory()->create();

        $this->actingAs($user);
        $status->like();
        $this->deleteJson(route('statuses.likes.destroy', $status));
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'status_id' => $status->id
        ]);
    }
}
