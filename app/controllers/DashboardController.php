<?php

class DashboardController extends BaseController {

        var $data = array();
        var $checkSession;
        public function __construct(){
           $this->data["session"] = $this->getSession(); 
           $this->checkSession = $this->checkSession(); 
           $categories = DB::collection('category')->get();
           $this->data["categorylist"] = $categories; 
	}
        
        /* =========================== dashboard ==================================== */
        public function index()
	{
            if($this->checkSession != true)
                return Redirect::to('/login');
           
            $this->data["pageclass"]= "dashboard";
            $this->data["pagename"]= "Dashboard";
            
            $userdata = User::where('_id', '=', $this->data["session"]["userdata"]["_id"])->first();
            $this->data["userdata"] = $userdata;
            
            return View::make('dashboard/dashboard',$this->data);
	}
        
        public function products()
	{
            if($this->checkSession != true)
                return Redirect::to('/login');
            
            $products = DB::collection('products')->where("userid",$this->data["session"]["userdata"]["_id"])->get();
            $this->data['products'] =$products;
            
            $this->data["pageclass"]= "dashboard productlist";
            $this->data["pagename"]= "Product List";
            return View::make('dashboard/products',$this->data);
	}
        
	public function addproduct()
	{
            if($this->checkSession != true)
                return Redirect::to('/login');
            
            $categories = DB::collection('category')->get();
            $this->data['categories'] =$categories;
            
            $this->data["pageclass"]= "Add Product";
            $this->data["pagename"]= "Add Product";
            return View::make('dashboard/addproduct',$this->data);
	}
        
        public function insertproduct()
        {
            if($this->checkSession != true)
                return Redirect::to('/login'); 
            
            $connection = DB::connection('mongodb');           
            
            
            if (Input::hasFile('image')) {
                $fileInstance = Input::file('image');
                $image = "product_".time().".jpg";
                $file = $fileInstance->move('assets/images/products/',$image);
            }
            
            $array = array(
                "userid" => $this->data["session"]["userdata"]["_id"],
                "productname" =>Input::get('productname'),
                "slug" => str_replace(" ","-", Input::get('productname')),
                "price" =>Input::get('price'),
                "image" =>"",
                "category" =>Input::get('category'),
                "description" =>Input::get('description'),
                "isfeatured" =>Input::get('isfeatured'),
            );
           $insertData = DB::collection('products')->insert($array);
           if($insertData){
                $data["response"] = "success";
                $data["redirectTo"] = url('/dashboard/products');
           }
           else{
            $data["response"] = "Problem in insert";   
           }
           
           echo json_encode($data);
            
        }
        
        public function editproduct($id)
	{
            if($this->checkSession != true)
                return Redirect::to('/login');
            
            $categories = DB::collection('category')->get();
            $this->data['categories'] =$categories;
            
            $productdata = Product::where('_id', '=', $id)->where('userid', '=', $this->data["session"]["userdata"]["_id"])->first();
            
            if(count($productdata) <= 0){
               return Redirect::to('/');
            }
            
            $this->data["productdata"] = $productdata;
            
            $this->data["pageclass"]= "dashboard editproduct";
            $this->data["pagename"]= "Edit Product";
            return View::make('dashboard/addproduct',$this->data);
	}
        
        public function updateproduct($id)
        {
            if($this->checkSession != true)
                return Redirect::to('/login'); 
            
            $connection = DB::connection('mongodb');           
            
            
            if (Input::hasFile('image')) {
                $fileInstance = Input::file('image');
                $image = "product_".time().".jpg";
                $file = $fileInstance->move('assets/images/products/',$image);
            }
            
            $array = array(
                "userid" => $this->data["session"]["userdata"]["_id"],
                "productname" =>Input::get('productname'),
                "slug" => str_replace(" ","-", Input::get('productname')),
                "price" =>Input::get('price'),
                "image" =>"",
                "category" =>Input::get('category'),
                "description" =>Input::get('description'),
                "isfeatured" =>Input::get('isfeatured'),
            );
           $updateData = DB::collection('products')->where('_id', $id)->update($array);
           if($updateData){
               //return Redirect::to('/');
                $data["response"] = "success";
                $data["redirectTo"] = url('/dashboard/products');
           }
           else{
            $data["response"] = "Problem in update";   
           }
           
           echo json_encode($data);
            
        }
        
        public function deleteproduct($id)
        {
            if($this->checkSession != true)
                return Redirect::to('/login'); 
            
           $connection = DB::connection('mongodb');
            
           $productdata = Product::where('_id', '=', $id)->where('userid', '=', $this->data["session"]["userdata"]["_id"])->first();
           if(count($productdata) <= 0){
               return Redirect::to('/dashboard/products');
           }
           
           $res = Product::destroy($id); 
            if($res){
               return Redirect::to('/dashboard/products');
           }
        }
              
        public function productimage($id = NULL)
	{
            if($id == NULL)
                return Redirect::to('/dashboard/products');
            
            if($this->checkSession != true)
                return Redirect::to('/login');
           
            $this->data["pageclass"]= "dashboard";
            $this->data["pagename"]= "Product Image";
            
            $product = Product::where('_id', '=', $id)->first();
            $this->data["product"] = $product;
            
            return View::make('dashboard/productimage',$this->data);
	}
        
        public function setproductimage($id)
        {
            if($this->checkSession != true)
                return Redirect::to('/login'); 
            
            $connection = DB::connection('mongodb');           
            
            $product = Product::where('_id', '=', $id)->first();
            
            if($product["image"] == ""){
                if (Input::hasFile('image')) {
                    $fileInstance = Input::file('image');
                    $image = "product_".time().".jpg";
                    $file = $fileInstance->move('assets/images/products/',$image);
                }
            }
            else{
                $fileInstance = Input::file('image');
                $image = $product["image"];
                $file = $fileInstance->move('assets/images/products/',$image);
            }
            $array = array(
                "image" =>$image,
            );
           $updateData = DB::collection('products')->where('_id', $id)->update($array);
           if($updateData){
               //return Redirect::to('/');
                return Redirect::to('/dashboard/products')->with('success', 'Product Image set successfully');
           }
           else{
            return Redirect::to('/dashboard/products')->with('error', 'Problem in image upload');
           }
        }
        
        
        public function blogs()
	{
            if($this->checkSession != true)
                return Redirect::to('/login');
            
            $blogs = DB::collection('blogs')->where("userid",$this->data["session"]["userdata"]["_id"])->get();
            $this->data['blogs'] =$blogs;
            
            $this->data["pageclass"]= "dashboard productlist";
            $this->data["pagename"]= "Blog List";
            return View::make('dashboard/blogs',$this->data);
	}
        
	public function addblog()
	{
            if($this->checkSession != true)
                return Redirect::to('/login');
            $this->data["pageclass"]= "dashboard Add Blog";
            $this->data["pagename"]= "Add Blog";
            return View::make('dashboard/addblog',$this->data);
	}
        
        public function insertblog()
        {
            if($this->checkSession != true)
                return Redirect::to('/login'); 
            
            $connection = DB::connection('mongodb');           
            $array = array(
                "userid" => $this->data["session"]["userdata"]["_id"],
                "blogtitle" =>Input::get('blogtitle'),
                "slug" => str_replace(" ","-", Input::get('blogtitle')),
                "description" =>Input::get('description'),
                "image" =>"",
                "posted_date" =>date('d-m-Y'),
            );
           $insertData = DB::collection('blogs')->insert($array);
           if($insertData){
               //return Redirect::to('/');
                $data["response"] = "success";
                $data["redirectTo"] = url('/dashboard/blogs');
           }
           else{
            $data["response"] = "Problem in insert";   
           }
           
           echo json_encode($data);
            
        }
        
        public function editblog($id)
	{
            if($this->checkSession != true)
                return Redirect::to('/login');
            
            $categories = DB::collection('category')->get();
            $this->data['categories'] =$categories;
            
            $blogdata = Blog::where('_id', '=', $id)->where('userid', '=', $this->data["session"]["userdata"]["_id"])->first();
            
            if(count($blogdata) <= 0){
               return Redirect::to('/');
            }
            
            $this->data["blogdata"] = $blogdata;
            
            $this->data["pageclass"]= "dashboard editblog";
            $this->data["pagename"]= "Edit Blog";
            return View::make('dashboard/addblog',$this->data);
	}
        
        public function updateblog($id)
        {
            if($this->checkSession != true)
                return Redirect::to('/login'); 
            
            $connection = DB::connection('mongodb');           

            $array = array(
                "blogtitle" =>Input::get('blogtitle'),
                "slug" => str_replace(" ","-", Input::get('blogtitle')),
                "image" =>"",
                "description" =>Input::get('description'),
            );
           $updateData = DB::collection('blogs')->where('_id', $id)->update($array);
           if($updateData){
               //return Redirect::to('/');
                $data["response"] = "success";
                $data["redirectTo"] = url('/dashboard/products');
           }
           else{
            $data["response"] = "Problem in update";   
           }
           
           echo json_encode($data);
            
        }
        
        public function deleteblog($id)
        {
            if($this->checkSession != true)
                return Redirect::to('/login'); 
            
           $connection = DB::connection('mongodb');
            
           $blog = Blog::where('_id', '=', $id)->where('userid', '=', $this->data["session"]["userdata"]["_id"])->first();
           if(count($blog) <= 0){
               return Redirect::to('/dashboard/blogs');
           }
           
           $res = Blog::destroy($id); 
            if($res){
               return Redirect::to('/dashboard/blogs');
           }
        }
              
        public function blogimage($id = NULL)
	{
            if($id == NULL)
                return Redirect::to('/dashboard/blogs');
            
            if($this->checkSession != true)
                return Redirect::to('/login');
           
            $this->data["pageclass"]= "dashboard";
            $this->data["pagename"]= "Blog Image";
            
            $blog = Blog::where('_id', '=', $id)->first();
            $this->data["blog"] = $blog;
            
            return View::make('dashboard/blogimage',$this->data);
	}
        
        public function setblogimage($id)
        {
            if($this->checkSession != true)
                return Redirect::to('/login'); 
            
            $connection = DB::connection('mongodb');           
            
            $blog = Blog::where('_id', '=', $id)->first();
            
            if($blog["image"] == ""){
                if (Input::hasFile('image')) {
                    $fileInstance = Input::file('image');
                    $image = "blog_".time().".jpg";
                    $file = $fileInstance->move('assets/images/blogs/',$image);
                }
            }
            else{
                $fileInstance = Input::file('image');
                $image = $blog["image"];
                $file = $fileInstance->move('assets/images/blogs/',$image);
            }
            $array = array(
                "image" =>$image,
            );
           $updateData = DB::collection('blogs')->where('_id', $id)->update($array);
           if($updateData){
                return Redirect::to('/dashboard/blogs')->with('success', 'Blog Image set successfully');
           }
           else{
            return Redirect::to('/dashboard/blogs')->with('error', 'Problem in image upload');
           }
        }
        /* =========================== dashboard end ==================================== */
        
}

