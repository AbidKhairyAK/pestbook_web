<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Consultation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => substr($this->title, 0, 30).(strlen($this->title) > 20 ? '...' : ''),
            'status' => $this->status ? 'Terjawab' : 'Belum',
        ];
    }
}
