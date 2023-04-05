<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class AuthController extends Controller
{

	protected $redirectTo = '/admin';

    protected $guard = 'admin';
	
	public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function AdminLoginForm()
    {		
        return view('admin/login');
    }	
 
    public function login(Request $request)
    {
    	$this->validate($request, 
			[
				'username' => 'required',
				'password' => 'required'
			]
		);

        try 
        {	
			
			//////// check password for security purpose ///////////
			$user = User::where('email',$request->input('username'))
			->where('is_admin', '=' , 1)
			->first();						
			if($user){				
				if(Hash::check($request->password, $user->password)) {
					Auth::guard('admin')->loginUsingId($user->id);
				    return redirect()->route('admin.dashboard');						
				}else{
					return redirect()->back()->with('error', 'Invalid Credentials.');
				}
			}else{
				return redirect()->back()->with('error', 'Invalid Credentials.');	
			} 
			return redirect()->back()->with('error', 'Invalid Credentials.');
				
        } 
        catch (Exception $e) 
        {            
			return redirect()->back()->with('error', 'Invalid Credentials.');	
        }
    }	
	
	public function logout(Request $request){
		Auth::guard('admin')->logout();
		$request->session()->flush();
		return redirect('/');
	}	
	
	
  
}
