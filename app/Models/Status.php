<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Traits\HasLike;

class Status extends Model
{
  use HasFactory, HasLike;

  protected $guarded = [];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
