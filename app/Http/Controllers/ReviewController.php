<?php

namespace App\Http\Controllers;

use App\Model\Review;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{

    public function index($id)
    { 
        return ReviewResource::collection(Product::find($id)->reviews);
    }

   
    public function create()
    {
        
    }

 
    public function store(ReviewRequest $request,$id)
    {
        $request['product_id'] = $id;
        $review = new Review($request->all());
        
        $product = new Product;

        $product->find($id)->reviews()->save($review);

        return response([
            'data' => new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }


    public function show(Product $product,Review $review)
    {
        // return $review;
    }

    
    public function edit(Review $review)
    {
        //
    }

   
    public function update(Request $request,$p_id,$r_id)
    {
        $product = new Product;
        $review = new Review;

        $request->product_id = $p_id;
        $review->findOrFail($r_id)->update($request->all());
        $review = $review->findOrFail($r_id);
        return response([
            'data' => new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }

   
    public function destroy($p_id,$r_id)
    {
        $review = new Review;

        $review->findOrFail($r_id)->delete();

        return response(null,Response::HTTP_NO_CONTENT);
    }
}
