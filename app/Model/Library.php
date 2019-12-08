<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $fillable = [
    	'type_id', 'name', 'description', 'indication', 'control', 'name_en', 'description_en', 'indication_en', 'control_en'
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
