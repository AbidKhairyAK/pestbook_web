<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
    	'original', 'thumbnail', 'library_id'
    ];

    public function library()
    {
    	return $this->belongsTo(Library::class);
    }
}
