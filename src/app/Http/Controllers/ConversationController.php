<?php

namespace Arealtime\Messenger\App\Http\Controllers;

use Arealtime\Messenger\App\Http\Requests\Conversation\ConversationRequest;
use Arealtime\Messenger\App\Http\Resources\ConversationResource;
use Arealtime\Messenger\App\Models\Conversation;
use Arealtime\Messenger\App\Services\ConversationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class ConversationController extends Controller
{
    public function __construct(private readonly ConversationService $conversationService) {}

    /**
     * @return AnonymousResourceCollection<ConversationResource>
     */
    public function index(): AnonymousResourceCollection
    {
        return ConversationResource::collection($this->conversationService->all());
    }

    /**
     * @param Conversation $conversation
     * @return ConversationResource
     */
    public function get(Conversation $conversation): ConversationResource
    {
        return new ConversationResource($conversation);
    }

    /**
     * @param ConversationRequest $request
     * @return JsonResponse
     */
    public function store(ConversationRequest $request): JsonResponse
    {
        $this->conversationService->setData([
            $request->input('type'),
            $request->input('title'),
            $request->input('is_public'),
            $request->input('can_join_via_link'),
            $request->input('requires_approval'),
            $request->input('max_numbers')
        ])->create();

        return response()->json([
            'message' => __('conversation::messages.operation.success.create')
        ]);
    }
}
