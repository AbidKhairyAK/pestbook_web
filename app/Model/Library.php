<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $fillable = [
    	'name', 'type_id', 'description', 'indication', 'control'
    ];

    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

    public function images()
    {
    	return $this->hasMany(Image::class);
    }
}
