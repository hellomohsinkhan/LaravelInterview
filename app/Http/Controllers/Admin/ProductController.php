<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * list category
    */
    public function index(Request $request){
      if ($request->ajax()) {
        $columns = array( 
          0 =>'id', 
          1 =>'title',
      );  
      $totalData = DB::table('products')->count();            
      $totalFiltered = $totalData;
      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $columns[$request->input('order.0.column')];
      $dir = $request->input('order.0.dir');
     // DB::enableQueryLog();
      if(empty($request->input('search.value')))
      {            
          $category = DB::table('products')->offset($start)
                       ->limit($limit)
                       ->orderBy($order,$dir)
                       ->get();
      }else {
          $search = $request->input('search.value'); 
          $category =   DB::table('products')                          
                          ->where(function($query) use ($search)
                          {
                            $query->where('title', 'LIKE',"%{$search}%");
                          })
                          ->offset($start)
                          ->limit($limit)
                          ->orderBy($order,$dir)
                          ->get();
        $totalFiltered = DB::table('products')
                          ->where(function($query) use ($search)
                          {
                            $query->where('title', 'LIKE',"%{$search}%");
                          })
                          ->count();
          
      }
      $data = array();
      if(!empty($category))
      {
        $count=0;
          foreach ($category as $key=>$categoryvalue)
          { 
            
             $nestedData['id'] = $count+$start+1;
              $nestedData['title'] = $categoryvalue->title;
              $nestedData['slug'] = $categoryvalue->slug;
              $nestedData['description'] = $categoryvalue->description;
              $nestedData['created_at'] = $categoryvalue->created_at;
              $nestedData['status'] = ($categoryvalue->status==1?'Active':'Inactive');
              $nestedData['action'] = '<a href="'.route("admin.product.edit",$categoryvalue->id).'"><span><i class="far fa-edit" data-toggle="tooltip" title="Edit"></i></span></a> <a href="JavaScript:void(0);" class="deletedata" data-value="'.$categoryvalue->id.'"><span><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></span></a>';
              $data[] = $nestedData;
              $count++;
          }
      }
      $json_data = array(
      "draw"            => intval($request->input('draw')),  
      "recordsTotal"    => intval($totalData),  
      "recordsFiltered" => intval($totalFiltered), 
      "data"            => $data   
      );            
      echo json_encode($json_data); 
      exit;
   }          
    return view('admin/product/index');

    }   

    /**
     * Add category
    */
    public function add(){

      $data['category'] = Category::where('status',1)->get();       
		  return view('admin/product/add',$data);

    }

    /**
     * Store zone
     *  @return \Illuminate\Http\Response
    */

    public function store(Request $request): RedirectResponse {
      try{
       
        $validated = $request->validate([
            'product_category' => 'required',
            'title' => 'required|max:255',
            'featured_image' => 'required|mimes:jpg,jpeg,png',
            'description' => 'required',
        ],
        [
          'mimes' => 'Please insert jpg and png image only',
        ]);
        if ($image = $request->file('featured_image')) {
            $destinationPath = 'featured_image/';
            $featured_image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $featured_image);
        }	
        $gallery_images = [];  
       
        if ($gallery = $request->file('gallery')) {            
            foreach ($request->file('gallery') as $key=>$img) {  

              $destinationPath = 'gallery/';
              $gallery_image = date('YmdHis').'_'.$key . "." . $img->getClientOriginalExtension();
              $img->move($destinationPath, $gallery_image);
              array_push($gallery_images, $gallery_image);

            }
            
            
        }           
          $product = new Product([
              'title' => $request->get('title'),
              'description' => $request->get('description'),
              'featured_image' => $featured_image,
              'gallery' => json_encode($gallery_images)
          ]);
        
        $product->save();
        $product->category()->attach($request->product_category);
        return redirect()->route('admin.product'); 

      }catch(Exception $e){        
        \Log::error($e->getMessage());
        abort(404);
      }

    }

    /**
     * Edit zone
     * @param  int  $id
    */
    public function edit($id){
		  $product= Product::find($id);
      $category = Category::where('status',1)->get();
      $product_category = Product::find($id)->category->toArray();
      $pcat = array_column($product_category,'id');
		  return view('admin/product/edit',compact('product','category','pcat'));
    }

    /**
     * Store zone
     *  @param  int  $id
     *  @return \Illuminate\Http\Response
    */

    public function update(Request $request,$id){   

    try{
      $validator = Validator::make($request->all(), [
        'title' => ['required'],
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all(':message') as $message)
            {
                
                return back();
            }
          } 		
          if ($image = $request->file('featured_image')) {
            $destinationPath = 'featured_image/';
            $featured_image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $featured_image);
        } 
        $gallery_images = [];  
       
        if ($gallery = $request->file('gallery')) {            
            foreach ($request->file('gallery') as $key=>$img) {  

              $destinationPath = 'gallery/';
              $gallery_image = date('YmdHis').'_'.$key . "." . $img->getClientOriginalExtension();
              $img->move($destinationPath, $gallery_image);
              array_push($gallery_images, $gallery_image);

            }
            
            
        }           
          $product = Product::find($id);	       
          Product::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'featured_image' => $featured_image,
            'gallery' => json_encode($gallery_images)
          ]);          
          $product->category()->sync($request->product_category); 
          return redirect()->route('admin.product');
    }catch(Exception $e){       
        \Log::error($e->getMessage());
        abort(404);
    } 

    }

    public function destroy(Request $request){
      try{          
        $product = Product::find($request->id);	       
        $product->category()->detach();
        $product->delete();
        return 1;
      }catch(Exception $e){     
        \Log::error($e->getMessage());
        abort(404);
      }
    }
	
}