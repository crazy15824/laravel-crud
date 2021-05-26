<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Traits\ActivationTrait;
use App\Traits\CaptchaTrait;
use App\Traits\CaptureIpTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Models\Template;
use App\Models\Campaign;
use App\Models\Field;
use App\Models\Lnk_Camp_Templ;
use App\Models\Lnk_Templ_Field;
use App\Models\Swipe;
use App\Models\User;


class AuthController extends Controller
{

    public function index()
    {
        $numberofswipes = Swipe::latest()
                ->select('id', Swipe::raw('count(*) as total'))
                ->groupBy('id')
                ->get();
        $numberoftemplates = Template::latest()
                ->select('id', Template::raw('count(*) as total'))
                ->groupBy('id')
                ->get();   
        $numberoffields = Swipe::latest()
                ->select('id', Swipe::raw('count(*) as total'))
                ->groupBy('id')
                ->get();  
        return view('dashboard.dashboard', compact('numberofswipes','numberoftemplates','numberoffields'));
    }  
    public function login()
    {
        $templates = Template::latest();
        $groupprojects = Template::latest()
                ->select('fields', Template::raw('count(*) as total'))
                ->groupBy('fields')
                ->get();
        return view('auth.login', compact('templates','groupprojects'));
    }  
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        $templates = Template::latest();
        $groupprojects = Template::latest()
                ->select('fields', Template::raw('count(*) as total'))
                ->groupBy('fields')
                ->get();
        return view('auth.registration', compact('templates', 'groupprojects'));
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
      
    }    
    

    public function dashboard()
    {
        $numberofswipes = Swipe::latest()
                ->select('id', Swipe::raw('count(*) as total'))
                ->groupBy('id')
                ->get();
        $numberoftemplates = Template::latest()
                ->select('id', Template::raw('count(*) as total'))
                ->groupBy('id')
                ->get();   
        $numberoffields = Swipe::latest()
                ->select('id', Swipe::raw('count(*) as total'))
                ->groupBy('id')
                ->get();
        if(Auth::check()){
            
            return view('dashboard.dashboard', compact('numberofswipes', 'numberoftemplates', 'numberoffields'));
           
        }
  
        return redirect("login", compact('numberofswipes', 'numberoftemplates', 'numberoffields'))->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
