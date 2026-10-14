<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumKomentar extends Model
{
    use HasFactory;

    protected $table = 'forum_komentars';

    protected $fillable = [
        'topic_id',
        'users_id',
        'isi_komentar',
    ];

    public function topic()
    {
        return $this->belongsTo(ForumTopic::class, 'topic_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }
}
