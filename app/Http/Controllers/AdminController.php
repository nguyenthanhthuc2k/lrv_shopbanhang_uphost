<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Rules\Captcha; 
use Validator;  
use Session;
use App\Models\Social;
use Socialite;
use App\Models\Login; // link sang model login
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{   
    public function login_google(){
        return Socialite::driver('google')->redirect();
   }
    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        if($authUser){
            $account_name = Login::where('admin_id',$authUser->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
        }
        elseif ($info) {
            $account_name = Login::where('admin_id',$authUser->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
        }
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }
        else{     
            $info = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);

            $orang = Login::where('admin_email',$users->email)->first();

                if(!$orang){
                    $orang = Login::create([
                        'admin_name' => $users->name,
                        'admin_email' => $users->email,
                        'admin_password' => '',
                        'admin_phone' => '',
                        'admin_status' => 1
                    ]);
                }
            $info->login()->associate($orang);
            $info->save();
            return $info;
        }
        $account_name = Login::where('admin_id',$info->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');


    }
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $info = new Social([
                'provider_user_id' => $provider->getId(),   
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',
                ]);
            }
            $info->login()->associate($orang);
            $info->save();
            $check_user = $info->user;
            $account_name = Login::where('admin_id',$check_user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return Redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } 
    }



    //kiem tra dang nhap hay chua
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
             return Redirect::to('admin')->send();
        }
    } 
    public function index(){
        //kiem tra da login roi thi vao admin luon
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
    	return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
		return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        //code moi
        // $data = $request->all();
        $data = $request->validate([
            'admin_email' => 'required',
            'admin_password' => 'required',
           'g-recaptcha-response' => new Captcha(),         //dòng kiểm tra Captcha
        ]);



        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($login){
            Session::put('admin_name',$login->admin_name);
            Session::put('admin_id',$login->admin_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Sai tài khoản hoặc mật khẩu');
            return Redirect::to('/admin');
        }

        //code cu
		// $admin_email = $request->admin_email;
		// $admin_password = md5($request->admin_password);

		// $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
  //       if($result){
  //           Session::put('admin_name',$result->admin_name);
  //           Session::put('admin_id',$result->admin_id);
  //           return Redirect::to('/dashboard');
  //       }else{
  //           Session::put('message','Sai tài khoản hoặc mật khẩu');
  //           return Redirect::to('/admin');
  //       }
    }
    public function logout(){
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        Session_destroy();
        return Redirect::to('/admin');
    }
}