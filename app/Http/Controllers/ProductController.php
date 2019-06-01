<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class ProductController extends Controller
{
<<<<<<< HEAD
    
=======
    public function __construct()   
    {
        $this->middleware('auth:api')->except('index','show');
    }
>>>>>>> b48126e5d78ffd145c15c667151755287b473845

    public function index()
    {
        return ProductCollection::collection(Product::paginate(20));
    }


    public function create()
    {
        //
    }

 
    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->discount = $request->discount;

        $product->save();

        return response([
            'data' => new ProductResource($product)
        ],201);

    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

 
    public function edit(Product $product)
    {
        //
    }

   
    public function update(Request $request, Product $product)
    {
        $request['detail'] = $request->description;
        unset($request['description']);
        $product->update($request->all());

        return response([
            'data' => new ProductResource($product)
        ],Response::HTTP_CREATED);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response(null,Response::HTTP_NO_CONTENT);
    }
}
