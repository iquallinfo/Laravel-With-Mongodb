<?php

class UserController extends BaseController {

        var $data = array();
        var $checkSession;
        public function __construct(){
           $this->data["session"] = $this->getSession();
           
           $this->checkSession = $this->checkSession(); 
           
           $categories = DB::collection('category')->get();
            $this->data["categorylist"] = $categories; 
	}
        public function register()
	{
            if($this->checkSession == true)
                return Redirect::to('/dashboard');
            
            $countries = DB::collection('country')->get();
            $this->data['countries'] =$countries;
            
            $this->data["pageclass"]= "account";
            $this->data["pagename"]= "New Account";
            return View::make('register',$this->data);
	}
        public function checkemail()
	{
            if($this->checkSession == true)
                return Redirect::to('/dashboard');
            
            $email = Input::get('email');
            $userdata = DB::collection('users')->where('email', $email)->first();
            echo count($userdata);
	}
	public function getregister()
        {
            if($this->checkSession == true)
                return Redirect::to('/dashboard'); 
            
            $connection = DB::connection('mongodb');           
            $password = md5(Input::get('password'));
            $array = array(
                "firstname" =>Input::get('firstname'),
                "lastname" =>Input::get('lastname'),
                "email" =>Input::get('email'),
                "password" =>$password,
                "contact_no" =>Input::get('contact_no'),
                "address_1" =>Input::get('address_1'),
                "address_2" =>Input::get('address_2'),
                "city" =>Input::get('city'),
                "postcode" =>Input::get('postcode'),
                "state" =>Input::get('state'),
                "country" =>Input::get('country'),
                "companyname" =>Input::get('companyname'),
                "companylocality" =>Input::get('companyloca'),
                "companydesc" =>Input::get('companydesc'),
                
           );

           $insertData = DB::collection('users')->insert($array);
           if($insertData){
                $data["response"] = "success";
                $data["redirectTo"] = url('/login');
           }
           else{
            $data["response"] = "Problem in insert";   
           }
           
           echo json_encode($data);
            
        }

        public function login($id = NULL)
	{
           
            if($this->checkSession == true)
                return Redirect::to('/dashboard');
           
            
            $this->data["pageclass"]= "login";
            $this->data["pagename"]= "Login";
            return View::make('login',$this->data);
	}
        public function getlogin()
	{
            if($this->checkSession == true)
                return Redirect::to('/dashboard');
            
            $password = md5(Input::get('password'));
            $condition = array(
                "email" => Input::get('email'),
                "password" => $password,
            );
            
            $userdata = User::where('email', '=', Input::get('email'))->where('password', '=', $password)->first();
            
    
            if(count($userdata) > 0){
                Session::put("userdata",$userdata);
                Session::put("is_login","true");
    
                $data["response"] = "success";
                $data["redirectTo"] = url('/dashboard');
            }
            else{
    
               $data["response"] = "Invail username Password";
    
            }
            echo json_encode($data);
        }
        
        public function logout($id = NULL)
	{
             Session::flush();
              return Redirect::to('/login');
	}
       
        
        
        /* After Login */
        
        public function users()
	{
            if($this->checkSession != true)
                return Redirect::to('/login');
           
            $this->data["pageclass"]= "dashboard";
            $this->data["pagename"]= "Users List";
            
            $users = DB::collection('users')->get();
            $this->data['users'] =$users;
            
            return View::make('users',$this->data);
	}
        
        public function account()
	{
            if($this->checkSession != true)
                return Redirect::to('/login');
           
            $this->data["pageclass"]= "dashboard";
            $this->data["pagename"]= "Edit Account";
            
            $userdata = User::where('_id', '=', $this->data["session"]["userdata"]["_id"])->first();
            $this->data["userdata"] = $userdata;
            
            $countries = DB::collection('country')->get();
            $this->data['countries'] =$countries;
            
            return View::make('dashboard/editaccount',$this->data);
	}
        
        
        public function editaccount($id)
        {
            if($this->checkSession != true)
                return Redirect::to('/login'); 
            
            $connection = DB::connection('mongodb');           
    
            $array = array(
                "firstname" =>Input::get('firstname'),
                "lastname" =>Input::get('lastname'),
                "contact_no" =>Input::get('contact_no'),
                "address_1" =>Input::get('address_1'),
                "address_2" =>Input::get('address_2'),
                "city" =>Input::get('city'),
                "postcode" =>Input::get('postcode'),
                "state" =>Input::get('state'),
                "country" =>Input::get('country'),
                "companyname" =>Input::get('companyname'),
                "companylocality" =>Input::get('companyloca'),
                "companydesc" =>Input::get('companydesc'),
                
           );
            
           $updateData = DB::collection('users')->where('_id', $id)->update($array);
           if($updateData){
    
                $data["response"] = "success";
                $data["redirectTo"] = url('/editaccount');
           }
           else{
            $data["response"] = "Problem in update";   
           }
           echo json_encode($data);   
        }
        
        
        public function profileimage()
	{
            if($this->checkSession != true)
                return Redirect::to('/login');
           
            $this->data["pageclass"]= "dashboard";
            $this->data["pagename"]= "Profile Image";
            
            $userdata = User::where('_id', '=', $this->data["session"]["userdata"]["_id"])->first();
            $this->data["userdata"] = $userdata;
            
            return View::make('dashboard/profileimage',$this->data);
	}
        
        public function setprofileimage()
        {
            if($this->checkSession != true)
                return Redirect::to('/login'); 
            
            $connection = DB::connection('mongodb');           
            
            $userdata = User::where('_id', '=', $this->data["session"]["userdata"]["_id"])->first();
            
            if($userdata["image"] == ""){
                if (Input::hasFile('image')) {
                    $fileInstance = Input::file('image');
                    $image = "profile_".time().".jpg";
                    $file = $fileInstance->move('assets/images/profile/',$image);
                }
            }
            else{
                $fileInstance = Input::file('image');
                $image = $userdata["image"];
                $file = $fileInstance->move('assets/images/profile/',$image);
            }
            $array = array(
                "image" =>$image,
           );
           $updateData = DB::collection('users')->where('_id', $this->data["session"]["userdata"]["_id"])->update($array);
           if($updateData){
    
                return Redirect::to('/dashboard')->with('success', 'Profile Picture set successfully');
           }
           else{
            return Redirect::to('/dashboard/')->with('error', 'Problem in image upload');
           }
           echo json_encode($data);   
        }
}
