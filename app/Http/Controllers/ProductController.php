<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect; 
use App\Models\product;

class ProductController extends Controller
{
    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
        'product_name' => 'required|max:50',
        'product_type' => 'required|in:snak,drink,fruit,groceries,make-up,cigarette',
        'product_price' => 'required|numeric',
        'expired_at' => 'required|date'
        ]);

        if($validator->fails()){
            return response()->json($validator->messages())->setStatusCode(422);
        }
        $payload = $validator->validated();
        product::create([
            'product_name' => $payload['product_name'],
            'product_type' => $payload['product_type'],
            'product_price' => $payload['product_price'],
            'expired_at' => $payload['expired_at']
        ]);
        return response()->json([
            'msg' => 'Data Produk Berhasil Disimpan'
        ],201);
    }

    function showAll(){

        $products = product::all();

        return response()->json([
            'msg' => 'DATA PRODUK KESELURUHAN',
            'data' => $products
        ],200);
    }

    function showById($id){

        $products = product::where('id',$id)->first();

        if($products) {

            return response()->json([
                'msg' => 'DATA PRODUK DENGAN ID: '.$id,
                'data' => $products
            ],200);
        }

        return response()->json([
            'msg' => 'DATA PRODUK DENGAN ID: '.$id.' TIDAK DITEMUKAN!',
        ],404);

    }

    function showByName($product_name){

        $products = product::where('product_name','LIKE','%'.$product_name.'%')->get();

        if ($products->count() > 0) {

            return response()->json([
                'msg' => 'DATA PRODUK DENGAN NAMA YANG MIRIP: '.$product_name,
                'data' => $products
            ],200);
        }

        return response()->json([
            'msg' => 'DATA PRODUK DENGAN NAMA YANG MIRIP: '.$product_name.' TIDAK DITEMUKAN',
        ],404);
    }


public function update (Request $request,$id) {

        $validator = Validator::make($request->all(),[
        'product_name' => 'required|max:50',
        'product_type' => 'required|in:snack,drink,fruit,groceries,medicine',
        'product_price' => 'required|numeric',
        'expired_at' => 'required|date'
        ]);

        if($validator->fails()){
            return response()->json($validator->messages())->setStatusCode(422);
        }
        $payload = $validator->validated();
        product::where('id',$id)->update([
            'product_name' => $payload['product_name'],
            'product_type' => $payload['product_type'],
            'product_price' => $payload['product_price'],
            'expired_at' => $payload['expired_at']
        ]);
        return response()->json([
            'msg' => 'Data Produk Berhasil Diubah'
        ],201);
    }

    public function delete($id) {
        $products = product::where('id',$id)->get();

        if($products) {
            product::where('id',$id)->delete();

            return response()->json([
                'msg' => 'DATA PRODUK DENGAN ID: '.$id.' BERHASIL DI HAPUS'
            ],200);
        }
        return response()->json([
            'msg' => 'DATA PRODUK DENGAN ID: '.$id.' TIDAK DITEMUKAN!'
        ],404);
    }

}