<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        try {
            $users = User::all();
            if(count($users) == 0){

                return response()->json([
                    'error' => 'No users found',
                ],404);
            }
            return response()->json($users, 200);

        } catch (\Exception $e) {
            return response()->json([
                'error'=>$e->getMessage()
            ], 400);
        }
    }

    public function show($id){
        try{
            $user = User::find($id);
            return response()->json($user,200);

        }catch(\Exception $e){
            return response()->json([
                'Error' =>$e->getMessage()
            ]);
        }
    }
    public function store(Request $request){
        try {
            $request->validate([
                'name'=>'required | string',
                'lastname'=>'required | string',
                'email'=>'required | string',
                'password'=>'required | string',
            ]);
            $product = User::create($request->all());
            return response()->json([
                "message"=>"user created succesfully",
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
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    "message"=>"No user found"
                ]);
            }
            $user = User::find($id)->update($request);
            return response()->json([
                "message"=>"user updated succesfully",
                "product"=>$user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "Error" => $e->getMessage()
            ],400);
        }
    }

    public function destroy($id){
        try{
            $user = User::find($id);
            if(!$user){
                return response()->json([
                    'error'=>'User not found'
                ],400);
            }
            $user = User::find($id)->destroy($id);
            return response()->json([
                "message"=>"user deleted succesfully",
                "user"=>$user
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' =>$e->getMessage()
            ],400);
        }
    }
}
