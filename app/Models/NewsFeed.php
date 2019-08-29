<?php

namespace App\Models;

use App\Models\NewsFeedComment;
use Illuminate\Database\Eloquent\Model;

class NewsFeed extends Model
{
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(NewsFeedComment::class, 'feed_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(AdminUser::class, 'support_id', 'id');
    }
}
