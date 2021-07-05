<?php

namespace App\Http\Resources;

use App\Models\Feature;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $features = Feature::where('package_id',$this->id)->pluck('feature');
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'currency'=>$this->currency,
            'image'=> filter_var($this->image, FILTER_VALIDATE_URL) ? $this->image : asset($this->image),
            'features'=>$features,
        ];
        
    }
}
