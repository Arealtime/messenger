<?php

namespace Arealtime\Messenger\App\Services;

use Arealtime\Messenger\App\Events\ConversationCreated;
use Arealtime\Messenger\App\Http\Controllers\ConversationController;
use Arealtime\Messenger\App\Models\Conversation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Throwable;

class ConversationService
{

    private Conversation $conversation;
    private array $data;

    /**
     * Set the current conversation instance by conversation ID.
     *
     * @param int $id The ID of the conversation to set
     * @return self Returns the current instance for method chaining
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the conversation with the given ID is not found
     */
    public function setConversation(Conversation $conversation): self
    {
        $this->conversation = $conversation;
        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get all conversations.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Conversation::with(['lastMessage', 'pinnedMessage'])->currentUser()->latest()->get();
    }

    /**
     * Create a new conversation.
     *
     * @param array $data
     * @return Conversation
     */
    public function create(): Conversation
    {
        DB::beginTransaction();
        try {
            $conversation = Conversation::create($this->data);

            $this->setConversation($conversation);

            ConversationCreated::dispatch($conversation, $this->data['user_ids']);

            DB::commit();
            return $this->conversation;
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw  $throwable;
        }
    }

    /**
     * Find a conversation by ID.
     *
     * @param int $id
     * @return Conversation
     *
     * @throws ModelNotFoundException
     */
    public function find(int $id): Conversation
    {
        return Conversation::findOrFail($id);
    }


    /**
     * Update a conversation by ID.
     *
     * @param Post $conversation
     * @param array $data
     * @return Post
     *
     * @throws ModelNotFoundException
     */
    public function update(): Conversation
    {

        DB::beginTransaction();
        try {

            $this->conversation->update($this->data);

            $this->attachUsers();

            DB::commit();
            return $this->conversation;
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }

    /**
     * Delete a conversation by ID.
     *
     * @param int $id
     * @return bool
     *
     * @throws ModelNotFoundException
     */
    public function delete(): bool
    {
        return $this->conversation->delete();
    }
}
