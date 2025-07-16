<?php

namespace Arealtime\Messenger\App\Models;

use Arealtime\Conversation\App\Traits\Conversation\ConversationRelation;
use Arealtime\Conversation\App\Traits\Conversation\ConversationScope;
use Arealtime\Conversation\App\Traits\Conversation\ConversationVirtualAttribute;
use Arealtime\Messenger\App\Enums\ConversationTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes, ConversationScope, ConversationRelation, ConversationVirtualAttribute;

    protected $fillable = ['type', 'is_public', 'can_join_via_link', 'requires_approval', 'max_number'];

    protected function casts(): array
    {
        return [
            'type' => ConversationTypeEnum::class,
            'user_id' => 'integer',
            'last_message_id' => 'integer',
            'pinned_message_id' => 'integer',
            'is_public' => 'boolean',
            'can_join_via_link' => 'boolean',
            'requires_approval' => 'boolean',
            'max_members' => 'integer'
        ];
    }
}
