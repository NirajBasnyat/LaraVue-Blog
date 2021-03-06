<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'reply_by' => $this->data['reply_by'],
            'question' => $this->data['question'],
            'path' => $this->data['path'],
        ];
    }
}
