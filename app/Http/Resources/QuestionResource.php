<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'replies' => ReplyResource::collection($this->replies),
            'reply_count' => $this->replies->count(),
            'path' => $this->path,
            'slug' => Str::slug($this->title),
            'body' => $this->body,
            'user' => $this->user->name,
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
