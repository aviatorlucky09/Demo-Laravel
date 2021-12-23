<?php


namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use App\Models\User\User;
use App\Models\Boat\Boat;
use Auth;

class DashboardController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
      $userCount = User::where('status',1)->count();
      $rentalOperatorCount = User::where('status',1)->where('user_type','1')->count(); 
      $boatCount = Boat::where('status','approved')->count();

      return view('admin.dashboard',compact('userCount','rentalOperatorCount','boatCount'));
    }
    public function admin(Request $request)
    {
      
      return view('admin');
    }
    public function login_as_user(Request $request , $user_id = 0)
    {
     
      $user = User::where("id",$user_id)->first();
     
      if(!$user){
        echo "User not found";
        return;
      }
      
      Auth::guard('web')->login($user);
      return redirect()->route('user.home');

    }
    
}
