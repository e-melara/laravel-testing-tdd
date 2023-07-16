<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Status;
use App\Http\Resources\StatusResource;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_resource_tiene_los_datos_necesarios(): void
    {
        $status = Status::factory()->create();
        $response = StatusResource::make($status)->resolve();

        $this->assertEquals($status->body, $response['body']);
        $this->assertEquals($status->user->name, $response['user_name']);
        $this->assertEquals('/images/avatar.jpg', $response['user_avatar']);
        $this->assertEquals($status->created_at->diffForHumans(), $response['ago']);
    }
}
