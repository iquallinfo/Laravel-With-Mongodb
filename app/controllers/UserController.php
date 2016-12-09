<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
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
               //return Redirect::to('/');
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
            
           // echo $userdata["_id"];
            if(count($userdata) > 0){
                Session::put("userdata",$userdata);
                Session::put("is_login","true");
                //return Redirect::to('/');
                $data["response"] = "success";
                $data["redirectTo"] = url('/dashboard');
            }
            else{
                //return Redirect::to('/login?error=1');
               $data["response"] = "Invail username Password";
               ///$data["redirectTo"] = url('/');
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
            //$password = md5(Input::get('password'));
            $array = array(
                "firstname" =>Input::get('firstname'),
                "lastname" =>Input::get('lastname'),
                //"email" =>Input::get('email'),
                //"password" =>$password,
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
               //return Redirect::to('/');
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
               //return Redirect::to('/');
                return Redirect::to('/dashboard')->with('success', 'Profile Picture set successfully');
           }
           else{
            return Redirect::to('/dashboard/')->with('error', 'Problem in image upload');
           }
           echo json_encode($data);   
        }
        
        public function countries(){
//            $country = array();
//            $country[] = array("country" => "Afghanistan");
//            $country[] = array("country" => "Albania");
//            $country[] = array("country" => "Algeria");
//            $country[] = array("country" => "American Samoa");
//            $country[] = array("country" => "Andorra");
//            $country[] = array("country" => "Angola");
//            $country[] = array("country" => "Anguilla");
//            $country[] = array("country" => "Antarctica");
//            $country[] = array("country" => "Antigua and Barbuda");
//            $country[] = array("country" => "Argentina");
//            $country[] = array("country" => "Armenia");
//            $country[] = array("country" => "Aruba");
//            $country[] = array("country" => "Australia");
//            $country[] = array("country" => "Austria");
//            $country[] = array("country" => "Azerbaijan");
//            $country[] = array("country" => "Bahamas");
//            $country[] = array("country" => "Bahrain");
//            $country[] = array("country" => "Bangladesh");
//            $country[] = array("country" => "Barbados");
//            $country[] = array("country" => "Belarus");
//            $country[] = array("country" => "Belgium");
//            $country[] = array("country" => "Belize");
//            $country[] = array("country" => "Benin");
//            $country[] = array("country" => "Bermuda");
//            $country[] = array("country" => "Bhutan");
//            $country[] = array("country" => "Bolivia");
//            $country[] = array("country" => "Bosnia and Herzegovina");
//            $country[] = array("country" => "Botswana");
//            $country[] = array("country" => "Bouvet Island");
//            $country[] = array("country" => "Brazil");
//            $country[] = array("country" => "British Indian Ocean Territory");
//            $country[] = array("country" => "Brunei Darussalam");
//            $country[] = array("country" => "Bulgaria");
//            $country[] = array("country" => "Burkina Faso");
//            $country[] = array("country" => "Burundi");
//            $country[] = array("country" => "Cambodia");
//            $country[] = array("country" => "Cameroon");
//            $country[] = array("country" => "Canada");
//            $country[] = array("country" => "Cape Verde");
//            $country[] = array("country" => "Cayman Islands");
//            $country[] = array("country" => "Central African Republic");
//            $country[] = array("country" => "Chad");
//            $country[] = array("country" => "Chile");
//            $country[] = array("country" => "China");
//            $country[] = array("country" => "Christmas Island");
//            $country[] = array("country" => "Cocos (Keeling) Islands");
//            $country[] = array("country" => "Colombia");
//            $country[] = array("country" => "Comoros");
//            $country[] = array("country" => "Congo");
//            $country[] = array("country" => "Cook Islands");
//            $country[] = array("country" => "Costa Rica");
//            $country[] = array("country" => "Cote D'Ivoire");
//            $country[] = array("country" => "Croatia");
//            $country[] = array("country" => "Cuba");
//            $country[] = array("country" => "Cyprus");
//            $country[] = array("country" => "Czech Republic");
//            $country[] = array("country" => "Denmark");
//            $country[] = array("country" => "Djibouti");
//            $country[] = array("country" => "Dominica");
//            $country[] = array("country" => "Dominican Republic");
//            $country[] = array("country" => "East Timor");
//            $country[] = array("country" => "Ecuador");
//            $country[] = array("country" => "Egypt");
//            $country[] = array("country" => "El Salvador");
//            $country[] = array("country" => "Equatorial Guinea");
//            $country[] = array("country" => "Eritrea");
//            $country[] = array("country" => "Estonia");
//            $country[] = array("country" => "Ethiopia");
//            $country[] = array("country" => "Falkland Islands (Malvinas)");
//            $country[] = array("country" => "Faroe Islands");
//            $country[] = array("country" => "Fiji");
//            $country[] = array("country" => "Finland");
//            $country[] = array("country" => "France, Metropolitan");
//            $country[] = array("country" => "French Guiana");
//            $country[] = array("country" => "French Polynesia");
//            $country[] = array("country" => "French Southern Territories");
//            $country[] = array("country" => "Gabon");
//            $country[] = array("country" => "Gambia");
//            $country[] = array("country" => "Georgia");
//            $country[] = array("country" => "Germany");
//            $country[] = array("country" => "Ghana");
//            $country[] = array("country" => "Gibraltar");
//            $country[] = array("country" => "Greece");
//            $country[] = array("country" => "Greenland");
//            $country[] = array("country" => "Grenada");
//            $country[] = array("country" => "Guadeloupe");
//            $country[] = array("country" => "Guam");
//            $country[] = array("country" => "Guatemala");
//            $country[] = array("country" => "Guinea");
//            $country[] = array("country" => "Guinea-Bissau");
//            $country[] = array("country" => "Guyana");
//            $country[] = array("country" => "Haiti");
//            $country[] = array("country" => "Heard and Mc Donald Islands");
//            $country[] = array("country" => "Honduras");
//            $country[] = array("country" => "Hong Kong");
//            $country[] = array("country" => "Hungary");
//            $country[] = array("country" => "Iceland");
//            $country[] = array("country" => "India");
//            $country[] = array("country" => "Indonesia");
//            $country[] = array("country" => "Iran (Islamic Republic of)");
//            $country[] = array("country" => "Iraq");
//            $country[] = array("country" => "Ireland");
//            $country[] = array("country" => "Israel");
//            $country[] = array("country" => "Italy");
//            $country[] = array("country" => "Jamaica");
//            $country[] = array("country" => "Japan");
//            $country[] = array("country" => "Jordan");
//            $country[] = array("country" => "Kazakhstan");
//            $country[] = array("country" => "Kenya");
//            $country[] = array("country" => "Kiribati");
//            $country[] = array("country" => "North Korea");
//            $country[] = array("country" => "Korea, Republic of");
//            $country[] = array("country" => "Kuwait");
//            $country[] = array("country" => "Kyrgyzstan");
//            $country[] = array("country" => "Lao People's Democratic Republic");
//            $country[] = array("country" => "Latvia");
//            $country[] = array("country" => "Lebanon");
//            $country[] = array("country" => "Lesotho");
//            $country[] = array("country" => "Liberia");
//            $country[] = array("country" => "Libyan Arab Jamahiriya");
//            $country[] = array("country" => "Liechtenstein");
//            $country[] = array("country" => "Lithuania");
//            $country[] = array("country" => "Luxembourg");
//            $country[] = array("country" => "Macau");
//            $country[] = array("country" => "FYROM");
//            $country[] = array("country" => "Madagascar");
//            $country[] = array("country" => "Malawi");
//            $country[] = array("country" => "Malaysia");
//            $country[] = array("country" => "Maldives");
//            $country[] = array("country" => "Mali");
//            $country[] = array("country" => "Malta");
//            $country[] = array("country" => "Marshall Islands");
//            $country[] = array("country" => "Martinique");
//            $country[] = array("country" => "Mauritania");
//            $country[] = array("country" => "Mauritius");
//            $country[] = array("country" => "Mayotte");
//            $country[] = array("country" => "Mexico");
//            $country[] = array("country" => "Micronesia, Federated States of");
//            $country[] = array("country" => "Moldova, Republic of");
//            $country[] = array("country" => "Monaco");
//            $country[] = array("country" => "Mongolia");
//            $country[] = array("country" => "Montserrat");
//            $country[] = array("country" => "Morocco");
//            $country[] = array("country" => "Mozambique");
//            $country[] = array("country" => "Myanmar");
//            $country[] = array("country" => "Namibia");
//            $country[] = array("country" => "Nauru");
//            $country[] = array("country" => "Nepal");
//            $country[] = array("country" => "Netherlands");
//            $country[] = array("country" => "Netherlands Antilles");
//            $country[] = array("country" => "New Caledonia");
//            $country[] = array("country" => "New Zealand");
//            $country[] = array("country" => "Nicaragua");
//            $country[] = array("country" => "Niger");
//            $country[] = array("country" => "Nigeria");
//            $country[] = array("country" => "Niue");
//            $country[] = array("country" => "Norfolk Island");
//            $country[] = array("country" => "Northern Mariana Islands");
//            $country[] = array("country" => "Norway");
//            $country[] = array("country" => "Oman");
//            $country[] = array("country" => "Pakistan");
//            $country[] = array("country" => "Palau");
//            $country[] = array("country" => "Panama");
//            $country[] = array("country" => "Papua New Guinea");
//            $country[] = array("country" => "Paraguay");
//            $country[] = array("country" => "Peru");
//            $country[] = array("country" => "Philippines");
//            $country[] = array("country" => "Pitcairn");
//            $country[] = array("country" => "Poland");
//            $country[] = array("country" => "Portugal");
//            $country[] = array("country" => "Puerto Rico");
//            $country[] = array("country" => "Qatar");
//            $country[] = array("country" => "Reunion");
//            $country[] = array("country" => "Romania");
//            $country[] = array("country" => "Russian Federation");
//            $country[] = array("country" => "Rwanda");
//            $country[] = array("country" => "Saint Kitts and Nevis");
//            $country[] = array("country" => "Saint Lucia");
//            $country[] = array("country" => "Saint Vincent and the Grenadines");
//            $country[] = array("country" => "Samoa");
//            $country[] = array("country" => "San Marino");
//            $country[] = array("country" => "Sao Tome and Principe");
//            $country[] = array("country" => "Saudi Arabia");
//            $country[] = array("country" => "Senegal");
//            $country[] = array("country" => "Seychelles");
//            $country[] = array("country" => "Sierra Leone");
//            $country[] = array("country" => "Singapore");
//            $country[] = array("country" => "Slovak Republic");
//            $country[] = array("country" => "Slovenia");
//            $country[] = array("country" => "Solomon Islands");
//            $country[] = array("country" => "Somalia");
//            $country[] = array("country" => "South Africa");
//            $country[] = array("country" => "South Georgia & South Sandwich Islands");
//            $country[] = array("country" => "Spain");
//            $country[] = array("country" => "Sri Lanka");
//            $country[] = array("country" => "St. Helena");
//            $country[] = array("country" => "St. Pierre and Miquelon");
//            $country[] = array("country" => "Sudan");
//            $country[] = array("country" => "Suriname");
//            $country[] = array("country" => "Svalbard and Jan Mayen Islands");
//            $country[] = array("country" => "Swaziland");
//            $country[] = array("country" => "Sweden");
//            $country[] = array("country" => "Switzerland");
//            $country[] = array("country" => "Syrian Arab Republic");
//            $country[] = array("country" => "Taiwan");
//            $country[] = array("country" => "Tajikistan");
//            $country[] = array("country" => "Tanzania, United Republic of");
//            $country[] = array("country" => "Thailand");
//            $country[] = array("country" => "Togo");
//            $country[] = array("country" => "Tokelau");
//            $country[] = array("country" => "Tonga");
//            $country[] = array("country" => "Trinidad and Tobago");
//            $country[] = array("country" => "Tunisia");
//            $country[] = array("country" => "Turkey");
//            $country[] = array("country" => "Turkmenistan");
//            $country[] = array("country" => "Turks and Caicos Islands");
//            $country[] = array("country" => "Tuvalu");
//            $country[] = array("country" => "Uganda");
//            $country[] = array("country" => "Ukraine");
//            $country[] = array("country" => "United Arab Emirates");
//            $country[] = array("country" => "United Kingdom");
//            $country[] = array("country" => "United States");
//            $country[] = array("country" => "United States Minor Outlying Islands");
//            $country[] = array("country" => "Uruguay");
//            $country[] = array("country" => "Uzbekistan");
//            $country[] = array("country" => "Vanuatu");
//            $country[] = array("country" => "Vatican City State (Holy See)");
//            $country[] = array("country" => "Venezuela");
//            $country[] = array("country" => "Viet Nam");
//            $country[] = array("country" => "Virgin Islands (British)");
//            $country[] = array("country" => "Virgin Islands (U.S.)");
//            $country[] = array("country" => "Wallis and Futuna Islands");
//            $country[] = array("country" => "Western Sahara");
//            $country[] = array("country" => "Yemen");
//            $country[] = array("country" => "Democratic Republic of Congo");
//            $country[] = array("country" => "Zambia");
//            $country[] = array("country" => "Zimbabwe");
//            $country[] = array("country" => "Jersey");
//            $country[] = array("country" => "Guernsey");
//            $country[] = array("country" => "Montenegro");
//            $country[] = array("country" => "Serbia");
//            $country[] = array("country" => "Aaland Islands");
//            $country[] = array("country" => "Bonaire, Sint Eustatius and Saba");
//            $country[] = array("country" => "Curacao");
//            $country[] = array("country" => "Palestinian Territory, Occupied");
//            $country[] = array("country" => "South Sudan");
//            $country[] = array("country" => "St. Barthelemy");
//            $country[] = array("country" => "St. Martin (French part)");
//            $country[] = array("country" => "Canary Islands");
                 
            
            $category =array();
//            $category[] = array("category" => "Bed and Bath Lines");
//            $category[] = array("category" => "Guest Room Amenities");
//            $category[] = array("category" => "Electronics");
//            $category[] = array("category" => "Housekeeping");
//            $category[] = array("category" => "Office Supplies");
//            $category[] = array("category" => "Hotel Equipment");
//            $category[] = array("category" => "Signs and Print Solutions");
//            $category[] = array("category" => "Staples");
//            $category[] = array("category" => "Food Service and Equipment");
//            $category[] = array("category" => "Furniture and Equipment");
            
            $category[] = array("category" => "Bed and Bath Lines","slug" => "Bed-and-Bath-Lines");
            $category[] = array("category" => "Guest Room Amenities","slug" => "Guest-Room-Amenities");
            $category[] = array("category" => "Electronics","slug" => "Electronics");
            $category[] = array("category" => "Housekeeping","slug" => "Housekeeping");
            $category[] = array("category" => "Office Supplies","slug" => "Office-Supplies");
            $category[] = array("category" => "Hotel Equipment","slug" => "Hotel-Equipment");
            $category[] = array("category" => "Signs and Print Solutions","slug" => "Signs-and-Print-Solutions");
            $category[] = array("category" => "Staples","slug" => "Staples");
            $category[] = array("category" => "Food Service and Equipment","slug" => "Food-Service-and-Equipment");
            $category[] = array("category" => "Furniture and Equipment","slug" => "Furniture-and-Equipment");

           // $this->data["session"]["userdata"]["_id"];
//                foreach($category as $cont){
//                    $data =array(
//                        "category" => $cont["category"],
//                        "slug" => $cont["slug"],
//                    );
//                    $insertData = DB::collection('category')->insert($data);
//                }
        }
        
        
        
        
}
