<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function likes() : HasMany {
        return $this->hasMany(Like::class);
    }

    public function like() : void {
        $this->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
    }

    public function isLiked() : bool {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function unlike() : void {
        $this->likes()->where('user_id', auth()->id())->delete();
    }

    public function likedCount() {
        return $this->likes()->count();
    }

    public function comments() : HasMany {
        return $this->hasMany(Comment::class);
    }
}
