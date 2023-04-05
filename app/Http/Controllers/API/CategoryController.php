<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(['data'=>$categories], 200); 
    }

    public function catProduct($id)
    {

        $products = Category::find($id);
        $data = $products->products;
        return response()->json(['data'=>$data], 200); 
    }

    public function search($search)
    {

        $data = Product::query()
        ->where('title', 'LIKE', "%{$search}%")
        ->get();
        return response()->json(['data'=>$data], 200); 
    }
    public function show($id)
    {

        $data = Product::find($id);
        return response()->json(['data'=>$data], 200); 
    }

 

}
