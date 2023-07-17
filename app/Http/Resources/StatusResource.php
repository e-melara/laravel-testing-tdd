<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
          'id'  => $this->id,
          'body' => $this->body,
          'user_avatar' => '/images/avatar.jpg',
          'user_name'   => $this->user->name,
          'ago' => $this->created_at->diffForHumans(),
          'is_liked' => $this->isLiked(),
          'likes_count' => $this->likedCount(),
          'comments' => CommentResource::collection($this->comments),
        ];
    }
}
