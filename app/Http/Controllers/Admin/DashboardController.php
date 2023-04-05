<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;

class DashboardController extends Controller
{
    
    public function index(Request $request){      
    
        if ($request->ajax()) {
            $columns = array( 
            0 =>'id', 
            1 =>'category',
        );  
        $totalData = DB::table('users')->count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {            
            $event = DB::table('users')->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
        }else {
            $search = $request->input('search.value'); 
            $event =   DB::table('users')                          
                          ->where(function($query) use ($search)
                          {
                            $query->where('firstname', 'LIKE',"%{$search}%");
                          })
                          ->offset($start)
                          ->limit($limit)
                          ->orderBy($order,$dir)
                          ->get();
            $totalFiltered = DB::table('users')
                          ->where(function($query) use ($search)
                          {
                            $query->where('users', 'LIKE',"%{$search}%");
                          })
                          ->count();
          
      }
      $data = array();
      if(!empty($event))
      {
        $count=0;
          foreach ($event as $key=>$eventvalue)
          { 
              
             $nestedData['id'] = $count+$start+1;
              $nestedData['firstname'] = $eventvalue->firstname;
              $nestedData['lastname'] = $eventvalue->lastname;
              $nestedData['email'] = $eventvalue->email;
              $nestedData['phone_number'] = $eventvalue->phone_number;
              $nestedData['created_at'] = $eventvalue->created_at;
              $nestedData['action'] = '<a href="JavaScript:void(0);" class="deletedata" data-value="'.$eventvalue->id.'"><span><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></span></a>';
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
    return view('admin/dashboard');

    }

    public function destroy(Request $request){
    //abort_unless(\Gate::allows('user_delete'), 403);  
      try{  
        DB::table('users')->where('id','=',$request->id)->delete();        
          return 1;
      }catch(Exception $e){
        Alert::error('Error', $e->getMessage());
        \Log::error($e->getMessage());
     abort(404);
    }catch (\Illuminate\Database\QueryException $exception) {
      Alert::error('Error', $exception->getMessage());
        \Log::error($exception->getMessage());
      Alert::error('error', "Query Exception");
      return redirect()->back();               
     }
    }


}

?>