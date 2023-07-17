<?php

namespace App\Traits;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLike {

  public function likes() : MorphMany
  {
    return $this->morphMany(Like::class, 'likeable');
  }

  public function like(): void
  {
    $this->likes()->firstOrCreate([
      'user_id' => auth()->id()
    ]);
  }

  public function isLiked(): bool
  {
    return $this->likes()->where('user_id', auth()->id())->exists();
  }

  public function unlike(): void
  {
    $this->likes()->where('user_id', auth()->id())->delete();
  }

  public function likedCount()
  {
    return $this->likes()->count();
  }

  public function comments(): HasMany
  {
    return $this->hasMany(Comment::class);
  }
}
