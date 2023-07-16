<?php

namespace Tests\Unit\Models;

use App\Models\Like;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_modelo_estado_tiene_una_relacion_con_usuario(): void
    {
        $status = Status::factory()->create();
        $this->assertInstanceOf(User::class, $status->user);
    }

    /** @test */
    public function un_modelo_tiene_muchos_me_gustas() : void
    {
        $status = Status::factory()->create();
        Like::factory()->create(['status_id' => $status->id]);
        $this->assertInstanceOf(Like::class, $status->likes()->first());
    }

    /** @test */
    public function un_estado_solo_puede_tener_un_me_gusta_de_un_usuario() : void
    {
        $status = Status::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $status->like();
        $status->like();
        $this->assertEquals(1, $status->likes()->count());
    }

    /** @test */
    public function saber_si_un_usuario_ya_le_dio_me_gusta_a_un_estado() : void
    {
        $status = Status::factory()->create();
        $this->assertFalse($status->isLiked());
        $user = User::factory()->create();
        $this->actingAs($user);
        $status->like();
        $this->assertTrue($status->isLiked());
    }

    /** @test */
    public function saber_si_un_usuario_ya_le_dio_no_me_gusta_a_un_estado() : void
    {
        $status = Status::factory()->create();
        $this->assertFalse($status->isLiked());
        $user = User::factory()->create();
        $this->actingAs($user);
        $status->like();
        $this->assertTrue($status->isLiked());
        $status->unlike();
        $this->assertFalse($status->isLiked());
    }

    /** @test */
    public function un_status_sabe_cuantos_likes_tiene() : void
    {
        $status = Status::factory()->create();
        $this->assertEquals(0, $status->likedCount());

        $like = Like::factory()->create(['status_id' => $status->id]);
        $this->assertEquals(1, $status->likedCount());
     }
}
