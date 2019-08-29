<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportChatConversation extends Model
{
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatMessages()
    {
        return $this->hasMany(SupportChat::class, 'conversation_id', 'id');
    }

    public function chatMessageLast()
    {
        return $this->hasMany(SupportChat::class, 'conversation_id', 'id')->latest();
    }
}
