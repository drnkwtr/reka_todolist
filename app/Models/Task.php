<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'text',
        'order'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_task');
    }
}
