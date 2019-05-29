<?php

namespace App\Http\Controllers;

use App\Model\Review;

use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use App\Model\Product;

class ReviewController extends Controller
{

    public function index($id)
    { 
        return ReviewResource::collection(Product::find($id)->reviews);
    }

   
    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
    }


    public function show(Review $review)
    {
        //
    }

    
    public function edit(Review $review)
    {
        //
    }

   
    public function update(Request $request, Review $review)
    {
        //
    }

   
    public function destroy(Review $review)
    {
        //
    }
}
