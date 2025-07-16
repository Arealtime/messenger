<?php

namespace Arealtime\Messenger\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
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
            'type' => $this->type,

            $this->mergeWhen(!$this->is_chat, [
                'title' => $this->title,
                'is_public' => $this->is_public,
                'can_join_via_link' => $this->can_join_via_link,
                'requires_approval' => $this->requires_approval,
                'max_members' => $this->max_members
            ]),
            'created_at' => $this->created_at
        ];
    }
}
