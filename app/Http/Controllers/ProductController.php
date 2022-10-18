<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        try{
            $product = Product::all();
            if(count($product) == 0){

                return response()->json([
                    'error' => 'No products found',
                ],404);
            }
            return response()->json($product, 200);
            
        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ], 400);
        }
      
        
    }

    public function show($id){
        try{
            $product = Product::find($id);
            return response()->json($product,200);

        }catch(\Exception $e){
            return response()->json([
                'error' =>$e->getMessage()
            ]);
        }
    }

    


    public function create(Request $request){

        try {
            $request->validate([
                'name'=>'required | string',
                'serial'=>'required | string',
                'price'=>'required | numeric',
                'description'=>'required | string',
                'quantity'=>'required | integer',
                'featured'=>'boolean'
            ]);
            $product = Product::create($request->all());
            return response()->json([
                "message"=>"product created succesfully",
                "product"=>$product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "Error" => $e->getMessage()
            ],400);
        }
    }

    public function update(Request $request, $id){

        $request = $request->all();

        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    "message"=>"No product found"
                ]);
            }
            $product = Product::find($id)->update($request);
            return response()->json([
                "message"=>"product updated succesfully",
                "product"=>$product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "Error" => $e->getMessage()
            ],400);
        }

    }

    public function destroy($id){
        try{
            $product = Product::find($id);
            if(!$product){
                return response()->json([
                    'error'=>'Product deleted suceessfully'
                ],200);
            }
        }catch(\Exception $e){
            return response()->json([
                'error' =>$e->getMessage()
            ],400);
        }
    }


}
