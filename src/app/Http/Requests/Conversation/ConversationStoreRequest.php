<?php

namespace Arealtime\Messenger\App\Http\Requests\Conversation;

use Arealtime\Messenger\App\Enums\ConversationTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class ConversationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $type = $this->input('type', ConversationTypeEnum::CHAT->value);

        $request = match ($type) {
            ConversationTypeEnum::GROUP->value => app(GroupConversationRequest::class),
            ConversationTypeEnum::CHANNEL->value => app(ChannelConversationRequest::class),
            default => app(ChatConversationRequest::class)
        };

        return $request->rules();
    }
}
