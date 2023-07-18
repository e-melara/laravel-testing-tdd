<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'body' => $this->body,
      'user_link' => $this->user->link(),
      'user_name' => $this->user->name,
      'user_avatar' => $this->user->avatar(),
      'likes_count' => $this->likes->count(),
      'is_liked' => $this->isLiked(),
    ];
  }
}
