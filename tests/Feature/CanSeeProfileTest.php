<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CanSeeProfileTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  function can_see_profiles_test()
  {
    $this->withoutExceptionHandling();
    $user = User::factory()->create(['name' => 'Duilio']);
    $this->actingAs($user);
    $this->get('@Duilio')->assertSee('Duilio');
  }
}
