<?php

use Arealtime\Messenger\App\Enums\ConversationJoinRequestStatusEnum;
use Arealtime\Messenger\App\Enums\ConversationTypeEnum;
use Arealtime\Messenger\App\Enums\ConversationUserRoleEnum;
use Arealtime\Messenger\App\Enums\MessageTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessengerTables extends Migration
{
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->enum('type', array_column(ConversationTypeEnum::cases(), 'value'))
                ->default(ConversationTypeEnum::CHAT->value);
            $table->string('title')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('last_message_id')->nullable();
            $table->unsignedBigInteger('pinned_message_id')->nullable();

            $table->boolean('is_public')->default(true);
            $table->boolean('can_join_via_link')->default(false);
            $table->boolean('requires_approval')->default(false);

            $table->unsignedInteger('max_members')->default(2);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained();
            $table->unsignedInteger('user_id');
            $table->foreignId('reply_to_message_id')->nullable()->constrained('messages');

            $table->text('body');
            $table->text('edited_body')->nullable();
            $table->string('type', array_column(MessageTypeEnum::cases(), 'value'))->default(MessageTypeEnum::TEXT->value);

            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('edited_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('conversation_join_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained();
            $table->unsignedInteger('user_id');

            $table->enum('status', array_column(ConversationJoinRequestStatusEnum::cases(), 'value'))
                ->default(ConversationJoinRequestStatusEnum::PENDING->value);

            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['conversation_id', 'user_id']);
        });

        Schema::create('conversation_invites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained();
            $table->unsignedInteger('creator_id');

            $table->string('code')->unique();

            $table->integer('max_uses')->default(100);
            $table->integer('uses')->default(0);

            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('conversation_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained();
            $table->foreignId('last_read_message_id')->nullable()->constrained('messages');
            $table->unsignedInteger('user_id');

            $table->enum('role', array_column(ConversationUserRoleEnum::cases(), 'value'))->default(ConversationUserRoleEnum::MEMBER->value);
            $table->smallInteger('unread_message_count')->default(0);

            $table->timestamp('muted_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->foreignId('pinned_message_id')->nullable()->constrained('messages');
            $table->timestamp('pinned_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('message_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained();
            $table->string('path', 100);
            $table->string('original_name', 100);
            $table->string('mime_type', 100);
            $table->integer('size');
            $table->string('extension', 10);
            $table->timestamps();
        });

        Schema::create('message_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained();
            $table->unsignedInteger('user_id');

            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('seen_at')->nullable();

            $table->timestamps();

            $table->unique(['message_id', 'user_id']);
        });

        Schema::create('message_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained();
            $table->unsignedInteger('user_id');

            $table->string('reaction'); // 'like', 'love', '😂'

            $table->timestamps();

            $table->unique(['message_id', 'user_id', 'reaction']);
        });

        Schema::table('conversations', function (Blueprint $table) {
            $table->foreign('last_message_id')->references('id')->on('messages');
            $table->foreign('pinned_message_id')->references('id')->on('messages');
        });
    }

    public function down()
    {
        Schema::table('conversations');



        Schema::dropIfExists('message_reactions');
        Schema::dropIfExists('message_statuses');
        Schema::dropIfExists('message_attachments');
        Schema::dropIfExists('conversation_user');
        Schema::dropIfExists('conversation_invites');
        Schema::dropIfExists('conversation_join_requests');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('conversations');
    }
}
