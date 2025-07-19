<?php

namespace Arealtime\Messenger\App\Http\Requests\Conversation;

use Arealtime\Messenger\App\Enums\ConversationTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConversationUpdateRequest extends FormRequest
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
        return [
            'type' => ['required', 'string', Rule::in(ConversationTypeEnum::CHANNEL, ConversationTypeEnum::GROUP)],
            'title' => ['required', 'string', 'max:255'],
            'is_public' => ['somtimes', 'boolean'],
            'can_join_via_link' => ['somtimes', 'boolean'],
            'requires_approval' => ['somtimes', 'boolean'],
            'max_numbers' => ['nullable', 'integer', 'max:1000'],
            'user_ids' => ['required', 'array'],
            'user_ids.*' => [Rule::exists(config('arealtime-messenger.user_model'), 'id')]
        ];
    }
}
