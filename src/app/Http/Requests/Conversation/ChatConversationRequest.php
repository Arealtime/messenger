<?php

namespace Arealtime\Messenger\App\Http\Requests\Conversation;

use Illuminate\Foundation\Http\FormRequest;

class ChatConversationRequest extends FormRequest
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
        /*
             $table->id();
            $table->enum('type', array_column(ConversationTypeEnum::cases(), 'value'))
                ->default(ConversationTypeEnum::CHAT->value);
            $table->string('title')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('last_message_id')->nullable();
            $table->unsignedBigInteger('pinned_message_id')->nullable();

            $table->boolean('is_public')->default(true);
            $table->boolean('can_join_via_link')->default(true);
            $table->boolean('requires_approval')->default(true);

            $table->unsignedInteger('max_members')->default(2);

            $table->timestamps();
            $table->softDeletes();
        */

        return [];
    }
}
