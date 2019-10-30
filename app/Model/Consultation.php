<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
    	'user_id', 'type_id', 'title', 'indication', 'original', 'thumbnail', 'status', 'answer'
    ];

    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

    // public function user()
    // {
    // 	return $this->belongsTo(User::class);
    // }
}
