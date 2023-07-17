<?php

namespace Tests\Unit\Traits;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

use App\Models\Like;
use App\Traits\HasLike;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HasLikeTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function un_modelo_tiene_muchos_me_gustas(): void
  {
    $model = new ModelWithLikes([
      'id' => 1
    ]);

    Like::factory()->create([
      'likeable_id' => $model->id,
      'likeable_type' => get_class($model)
    ]);

    $this->assertInstanceOf(Like::class, $model->likes->first());
  }

  /** @test */
  public function un_modelo_solo_puede_tener_un_me_gusta_de_un_usuario(): void
  {
    $model = new ModelWithLikes([
      'id' => 1
    ]);
    $user = User::factory()->create();
    $this->actingAs($user);

    $model->like();
    $model->like();
    $this->assertEquals(1, $model->likes()->count());
  }

  /** @test */
  public function saber_si_un_usuario_ya_le_dio_me_gusta_a_un_model(): void
  {
    $model = new ModelWithLikes([
      'id' => 1
    ]);
    $this->assertFalse($model->isLiked());
    $user = User::factory()->create();
    $this->actingAs($user);
    $model->like();
    $this->assertTrue($model->isLiked());
  }

  /** @test */
  public function saber_si_un_model_ya_le_dio_no_me_gusta_a_un_estado(): void
  {
    $model = new ModelWithLikes([
      'id' => 1
    ]);
    $this->assertFalse($model->isLiked());
    $user = User::factory()->create();
    $this->actingAs($user);
    $model->like();
    $this->assertTrue($model->isLiked());
    $model->unlike();
    $this->assertFalse($model->isLiked());
  }


  /** @test */
  public function un_model_sabe_cuantos_likes_tiene(): void
  {
    $model = new ModelWithLikes([
      'id' => 1
    ]);
    $this->assertEquals(0, $model->likedCount());

    Like::factory()->create([
      'likeable_id' => $model->id,
      'likeable_type' => get_class($model),
    ]);
    $this->assertEquals(1, $model->likedCount());
  }
}


class ModelWithLikes extends Model
{
  use HasLike;

  protected $fillable = ['id'];
}
