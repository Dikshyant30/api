<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name'=>$this->name,
            'description'=>$this->detail,
            'price'=>$this->price,
            'stock'=>$this->stock==0 ? 'Out Of Stock ':stock,
            'discount'=>$this->discount,
            //'totatPrice'=> round((1 - ($this->discount/100)) *  $this->discount,2),
            'ratings'=> $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2)
            : 'No Ratings Yet',
            'href'=>[
               'reviews'=>route('reviews.index',$this->id)
            ]
        ];
    }
}
