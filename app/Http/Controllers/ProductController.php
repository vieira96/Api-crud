<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class ProductController extends Controller
{

    public function getProducts()
    {
        $products = Product::all();
        foreach($products as $product) {
            $product->price = number_format($product->price, 2, '.', '');
        }
        return response()->json(['results' => $products], 200);
    }

    public function getProduct(Product $product)
    {
        return response()->json(['result' => $product], 200);
    }

    public function store(Request $request) 
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'quantity' => 'required|min:1|integer',
            'price' => 'required|numeric',
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }
        

        $new_product = new Product();
        $new_product->name = $request->name;
        $new_product->quantity = $request->quantity;
        $new_product->price = number_format($request->price, 2, '.', '');
        $new_product->save();
        
        return response()->json(['result' => $new_product], 200);   
    }

    public function delete(Product $product)
    {
        $product->delete();
        return response()->json(['result' => 'Deletado com sucesso'], 200);
    }

    public function edit(Product $product, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            return response()->json(['errors' => $errors]);
        }

        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = number_format($request->price, 2, '.', '');
        $product->save();

        return response()->json(['result' => "Dados atualizados com sucesso"]);
    }
}
