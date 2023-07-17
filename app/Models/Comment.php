<?php

namespace App\Models;

use App\Traits\HasLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
  use HasFactory, HasLike;

  protected $guarded = [];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
