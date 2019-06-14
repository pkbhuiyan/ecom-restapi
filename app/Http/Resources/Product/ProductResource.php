<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReviewResource;

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
            'name' => $this->name,
            'user_id' => $this->user_id,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $this->stock == 0 ? 'Out of stock' : $this->stock,
            'discount' => $this->discount,
            'totalPrice' => round((1-($this->discount/100)) * $this->price,2),
            'rating' => $this->reviews->count('star') > 0 ? round($this->reviews->sum('star')/$this->reviews->count('star'),2) : 'Not rated yet',
            'href' => [
                'reviews' => route('reviews.index',$this->id)
            ],
            'reviews' => ReviewResource::collection($this->reviews), 
        ];
    }
}
