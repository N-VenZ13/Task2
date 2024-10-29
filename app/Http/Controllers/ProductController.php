<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $dataAll = Product::all();
            $dataArr = [];
            foreach ($dataAll as $key => $data) {
                $dataArr[] = [
                    'id' => Crypt::encrypt((string)$data['id']),
                    'nama_minuman' => $data['nama_minuman'],
                    'harga_minuman' => $data['harga_minuman'],
                    'jumlah' => $data['jumlah'],
                    
                ];
            }
            return ApiResponseHelper::success($dataArr, "fetch success");

        } catch (\Exception $e){
            return ApiResponseHelper::error('internal server error', 500,$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try{
            $validator = Validator::make($request-> all(),[
                'nama_minuman' => 'required',
                'harga_minuman' => 'required',
                'jumlah' => 'required',
                
                
            ]);

            if ($validator->fails()){
                return ApiResponseHelper::error('invalidated', 400,$validator->errors());
            }

            $data = $request->all();
            Product::create([
                'nama_minuman' => $data['nama_minuman'],
                'harga_minuman' => $data['harga_minuman'],
                'jumlah' => $data['jumlah'],
                
            ]);
            return ApiResponseHelper::success(null, 'success create produk', 201);
            
        } catch(\Exception  $e){
            return ApiResponseHelper::error('internal server error', 500, $e->getMessage());

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
