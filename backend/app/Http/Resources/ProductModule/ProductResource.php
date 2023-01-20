<?php

namespace App\Http\Resources\ProductModule;

use Illuminate\Http\Resources\Json\JsonResource;
USE Illuminate\Support\Str;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'title' => Str::limit($this->title,15),
            'slug' => $this->slug,
            'price' => $this->price,
            'cover_photo' => asset('images/product/'.$this->cover_photo),
            'year' => $this->year ? $this->year->year : 'N/A',
            'mileage' => $this->mileage,
            'is_feature' => $this->is_feature,
            'product_type' => $this->product_type->name,
            'condition' => $this->condition ? $this->condition->name : null,
            'url' => route('product.details',[
                'slug' => $this->slug,
                'id' => encrypt($this->id)
            ]),
        ];
    }
}
