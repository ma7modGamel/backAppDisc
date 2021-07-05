<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
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
            'id'=>$this->id,
            'name'=> $this->name, 
            'email'=> $this->email, 
            'country'=> CountryResource::make($this->country),
            'gender'=> GenderResource::make($this->gender),
            'bio'=> $this->bio,
            'image'=> is_null($this->image) ? $this->image : url($this->image),
            'like_count'=> $this->like_count,
            'call_count'=> $this->call_count,
            'is_vip'=> $this->is_vip,
            'is_admin'=> $this->is_admin
        ];
    }
}
