<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    //
    public function index()
    {
        try{
            $category_product=CategoryProduct::all();
            return response()->json([
                'message'=>'succes',
                'data'=>$category_product,
            ],200);

        } catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),
                'data'=>null,
            ],401);
        }    
    }

    // simpan
    public function store(Request $request){
        try{
            $validateData = $request->validate([
                'name'=>'required|max:255',
                'description'=>'nullable|string',
            ]);
            $product = CategoryProduct::create($validateData);
            return response()->json([
                'status'=>'Succes',
                'data'=>$product,
                'message'=>'Tampilkan',
            ],201);

        } catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),
                'data'=>null
            ],401);
        }
    }

    // cari
    public function show($id){
        $category=CategoryProduct::find($id);
        return response()->json($category);
        if(!$category){
            return response()->json([
                'message'=>'Tidak ada data',
                'data'=>null
            ],401);
        }
    }

    // edit
    public function update(Request $request, $id){
        $category=CategoryProduct::find($id);
        $validateData = $request->validate([
            'name'=>'required|max:255',
            'description'=>'nullable|string'
        ]);
        if(!$category){
            return response()->json([
                'status'=>'Gagal',
                'data'=>null,    
                'message'=>'Gagal Ubah',
            ],401);
        }

        $category->update([
            'name'=>$validateData['name'],
            'description'=>$validateData['description'],
        ]);      
        return response()->json([
            'status'=>'Succes',
            'data'=>$category,
            'message'=>'Berhasil Diubah'
        ],201);      
    }

    public function destroy($id){
        $category=CategoryProduct::find($id);
        if(!$category){
            return response()->json([
                'status'=>'hapus',
                'data'=>null,
                'message'=>'Data tidak ada, Tidak bisa dihapus!!'
            ],401);
        }

        $category->delete();

        return response([
            'status'=>'Berhasil',
            'data'=>$category,
            'message'=>'Data berhasil dihapus!!!',
        ],201);
    }

}
