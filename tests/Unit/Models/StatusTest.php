<?php

namespace Tests\Unit\Models;

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
}
