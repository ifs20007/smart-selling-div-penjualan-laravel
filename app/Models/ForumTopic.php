<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    use HasFactory;

    protected $table = 'forum_topics';

    protected $fillable = [
        'users_id',
        'judul_topic',
        'isi_konten',
        'is_locked',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }

    public function comments()
    {
        return $this->hasMany(ForumKomentar::class, 'topic_id', 'id');
    }
}
