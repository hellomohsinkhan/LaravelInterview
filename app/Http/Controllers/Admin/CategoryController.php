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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
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
      $totalData = DB::table('categories')->count();            
      $totalFiltered = $totalData;
      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $columns[$request->input('order.0.column')];
      $dir = $request->input('order.0.dir');
     // DB::enableQueryLog();
      if(empty($request->input('search.value')))
      {            
          $category = DB::table('categories')->offset($start)
                       ->limit($limit)
                       ->orderBy($order,$dir)
                       ->get();
      }else {
          $search = $request->input('search.value'); 
          $category =   DB::table('categories')                          
                          ->where(function($query) use ($search)
                          {
                            $query->where('title', 'LIKE',"%{$search}%");
                          })
                          ->offset($start)
                          ->limit($limit)
                          ->orderBy($order,$dir)
                          ->get();
        $totalFiltered = DB::table('categories')
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
              $nestedData['created_at'] = $categoryvalue->created_at;
              $nestedData['status'] = ($categoryvalue->status==1?'Active':'Inactive');
              $nestedData['action'] = '<a href="'.route("admin.category.edit",$categoryvalue->id).'"><span><i class="far fa-edit" data-toggle="tooltip" title="Edit"></i></span></a> <a href="JavaScript:void(0);" class="deletedata" data-value="'.$categoryvalue->id.'"><span><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></span></a>';
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
    return view('admin/category/index');

    }   

    /**
     * Add category
    */
    public function add(){
		//abort_unless(\Gate::allows('zone_add'), 403);
		  return view('admin/category/add');
    }

    /**
     * Store zone
     *  @return \Illuminate\Http\Response
    */

    public function store(Request $request): RedirectResponse
    {
      try{

         $validated = $request->validate([
            'category' => 'required|max:255',
          ]);
        				
       Category::create(['title' => $request->category]);  
      
        return redirect()->route('admin.category')->with('success','Created successfully.'); 

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
		  $category= DB::table('categories')->find($id);
		  return view('admin/category/edit',compact('category'));
    }

    /**
     * Store zone
     *  @param  int  $id
     *  @return \Illuminate\Http\Response
    */

    public function update(Request $request,$id): RedirectResponse {   

    try{
        $validated = $request->validate([
            'category' => 'required|max:255',
        ]);
			
        Category::where('id', $id)->update([
          'title' => $request->category,
        ]);           
        return redirect()->route('admin.category')->with('success','Updated successfully.');
    }catch(Exception $e){       
        \Log::error($e->getMessage());
        abort(404);
    } 

    }

    public function destroy(Request $request){
      try{  
        Category::where('id',$request->id)->delete();        
          return 1;
      }catch(Exception $e){     
        \Log::error($e->getMessage());
        abort(404);
      }
    }
	
}