<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
    	'user_id', 'title', 'body', 'title_en', 'body_en', 'type', 'target', 'is_read'
    ];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }
}
