<?php

namespace Arealtime\Messenger\App\Traits\Conversation;


use Arealtime\Messenger\App\Enums\ConversationTypeEnum;
use Illuminate\Database\Eloquent\Builder;

trait ConversationScope
{
    public function scopeOfType(Builder $builder, ConversationTypeEnum $conversationType): Builder
    {
        return $builder->where('type', $conversationType);
    }

    public function scopePublic(Builder $builder): Builder
    {
        return $builder->where('is_public', true);
    }

    public function scopeCanJoinViaLink(Builder $builder): Builder
    {
        return $builder->where('can_join_via_link', true);
    }

    public function scopeRequiresApproval(Builder $builder): Builder
    {
        return $builder->where('requires_approval', true);
    }

    public function scopeCurrentUser(Builder $builder): Builder
    {
        return $builder->where('user_id', auth()->id());
    }
}
