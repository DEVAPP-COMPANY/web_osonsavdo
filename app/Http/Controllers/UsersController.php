<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\AppUser;
use App\Models\Orders;
use App\Models\Categories;
use App\Models\OrderProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    public function login(Request $request)
    {
        $user=User::where(['email'=>$request->email])->first();
        if(!$user || !Hash::check($request->password, $user->password))
        {
            return "Email yoki parol xato";
        }
        else
        {
            $request->session()->put('user', $user);
            return redirect('/');
        }
        
    }

    public function register(Request $request)
    {
        $user=New User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect('/login');
    }

        public function header(Request $request) 
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
         
         return view('header');
      
    }

    public function appUser(Request $request)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $users=AppUser::paginate(20);
        return view('appUser', compact('users'));
    }

  public function stream(Request $request,$id,$type) {
    if ($request->session()->get('user'))  {
         $file= public_path()."/images/".$id.'.'.$type;

        return response()->download($file);
    } else {
        return "NOT AUTHORIZED";    
    }
}
}
