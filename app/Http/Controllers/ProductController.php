<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Exceptions\ProductNotBelongsToUser;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use Auth;

class ProductController extends Controller
{
    public function __construct()   
    {
        $this->middleware('auth:api')->except('index','show');
    }

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
        // user check for product
        $this->ProductUserCheck($product);

        $request['detail'] = $request->description;
        unset($request['description']);
        $product->update($request->all());

        return response([
            'data' => new ProductResource($product)
        ],Response::HTTP_CREATED);
    }

    public function destroy(Product $product)
    {
        // user check for product
        $this->ProductUserCheck($product);

        $product->delete();

        return response(null,Response::HTTP_NO_CONTENT);
    }

    public function ProductUserCheck($product)
    {
        if(Auth::id() !== $product->user_id ){
            throw new ProductNotBelongsToUser;
        }
    }
}
