<?php

class ProductController extends BaseController {

        var $data = array();
        var $checkSession;
        public function __construct(){
           $this->data["session"] = $this->getSession(); 
           $this->checkSession = $this->checkSession(); 
           
	}
        
        
    public function search()
	{
            if(isset($_GET["sort"]) && $_GET["sort"] != ""){
                $col = $_GET["sort"];
            }
            else{
                $col = '_id';
            }
            
            if((isset($_GET["search"]) && $_GET["search"] != "") && (isset($_GET["category"]) && $_GET["category"] != "")){
                $keyword = $_GET["search"];
                $productlist = DB::collection('products')->orderBy($col, 'asc')->where('category', $_GET["category"])->where('productname', 'like', "%$keyword%")->get();
            }
            else if((isset($_GET["search"]) && $_GET["search"] != "") && (isset($_GET["category"]) && $_GET["category"] == "")){
                $keyword = $_GET["search"];
                $productlist = DB::collection('products')->orderBy($col, 'asc')->where('productname', 'like', "%$keyword%")->get();
            }
            else if((isset($_GET["search"]) && $_GET["search"] == "") && (isset($_GET["category"]) && $_GET["category"] != "")){
                $productlist = DB::collection('products')->orderBy($col, 'asc')->where('category', $_GET["category"])->get();
            }
            $products = array();
            foreach($productlist as $prods){
                 $temp = $prods;
                 $catname = DB::collection('category')->where('_id', $prods["category"])->first();
                 $temp["categoryname"] = $catname["category"];
                 
                 $user = DB::collection('users')->where('_id', $prods["userid"])->first();
                 $temp["owner"] = $user["_id"];
                 $products[] = $temp;
             }
             
            $this->data['products'] =$products; 
             
             
            $categories = DB::collection('category')->get();
            $this->data['categories'] =$categories;
            
            $this->data["pageclass"]= "dashboard productlist";
            $this->data["pagename"]= "Search Products";
            return View::make('productlist',$this->data);
	}
        
	public function allproducts()
	{
            if(isset($_GET["sort"]) && $_GET["sort"] != ""){
                $col = $_GET["sort"];
            }
            else{
                $col = '_id';
            }
            
            if(isset($_GET["search"]) && $_GET["search"] != ""){
                $keyword = $_GET["search"];
                $productlist = DB::collection('products')->orderBy($col, 'asc')->where('productname', 'like', "%$keyword%")->get();
            }
            else{
                $productlist = DB::collection('products')->orderBy($col, 'asc')->get();
            }
            $products = array();
            foreach($productlist as $prods){
                 $temp = $prods;
                 $catname = DB::collection('category')->where('_id', $prods["category"])->first();
                 $temp["categoryname"] = $catname["category"];
                 
                 $user = DB::collection('users')->where('_id', $prods["userid"])->first();
                 $temp["owner"] = $user["_id"];
                 $products[] = $temp;
             }
             
            $this->data['products'] =$products; 
             
             
            $categories = DB::collection('category')->get();
            $this->data['categories'] =$categories;
            
            $this->data["pageclass"]= "dashboard productlist";
            $this->data["pagename"]= "All Products";
            return View::make('productlist',$this->data);
	}
        
	public function categoryproduct($category = NULL)
	{
            if($category == NULL)
                return Redirect::to('/products/allproducts');
            
            
            $catname = DB::collection('category')->where('slug', $category)->first();
            $catid = $catname["_id"];
            
            if(isset($_GET["sort"]) && $_GET["sort"] != ""){
                $col = $_GET["sort"];
            }
            else{
                $col = '_id';
            }
            
            $productlist = DB::collection('products')->where('category',"$catid")->orderBy($col, 'asc')->get();
            $products = array();
            foreach($productlist as $prods){
                 $temp = $prods;
                 $catname = DB::collection('category')->where('_id', $prods["category"])->first();
                 $temp["categoryname"] = $catname["category"];
                 
                 $user = DB::collection('users')->where('_id', $prods["userid"])->first();
                 $temp["owner"] = $user["_id"];
                 
                 $products[] = $temp;
             }
            $this->data['products'] =$products;
            
            $categories = DB::collection('category')->get();
            $this->data['categories'] =$categories;
            
            $this->data["categoryname"] = $category;
            $this->data["pageclass"]= "dashboard productlist";
            $this->data["pagename"]= "$category Products";
            return View::make('productlist',$this->data);
	}
        
        
	public function productdetail($owner = NULL,$product = NULL)
	{
            if($owner == NULL && $product == NULL){
                return Redirect::to('/products/allproducts');
            }
            
            
            $productlist = DB::collection('products')->where('slug',"$product")->where('userid',"$owner")->first();
            $temp =$productlist;  
            
            $catname = DB::collection('category')->where('_id', $productlist["category"])->first();
            $temp["categoryname"] = $catname["category"];
            $product= $temp;
            
            $categories = DB::collection('category')->get();
            $this->data['categories'] =$categories;
            
            
            /* Owner Details of products */
            
            $ownerdetails = DB::collection('users')->where('_id', $owner)->first();
            $this->data["ownerdetails"] = $ownerdetails;
            $this->data["product"] = $product;
            $this->data["pageclass"]= "dashboard productdetail";
            $this->data["pagename"]= $productlist['productname'];
            
            $catid = $catname['_id'];
            
            
            
            /* Recommended Products */
            
            
            $recommendlist = DB::table('products')
                           ->where("category","$catid")
                           ->orderBy('_id', 'desc')->get();
             $products = array();
             foreach($recommendlist as $prods){
                 $temp = $prods;
                 $catname = DB::collection('category')->where('_id', $prods["category"])->first();
                 $temp["categoryname"] = $catname["category"];
                 $products[] = $temp;
             }

             $this->data['recommended'] =$products;
             
            return View::make('productdetails',$this->data);   
        }
        
	public function ownerproducts($owner =  NULL, $category = NULL)
	{
            if($owner == NULL && $category == NULL)
                return Redirect::to('/');
            
            $ownerdetail = DB::collection('users')->where('_id', $owner)->first();
            if(isset($_GET["sort"]) && $_GET["sort"] != ""){
                $col = $_GET["sort"];
            }
            else{
                $col = '_id';
            }
            $productlist = DB::collection('products')->where('userid',"$owner")->orderBy($col, 'asc')->get();
            $products = array();
            foreach($productlist as $prods){
                 $temp = $prods;
                 $catname = DB::collection('category')->where('_id', $prods["category"])->first();
                 $temp["categoryname"] = $catname["category"];
                 
                 $user = DB::collection('users')->where('_id', $prods["userid"])->first();
                 $temp["owner"] = $user["_id"];
                 
                 $products[] = $temp;
             }
            $this->data['products'] =$products;
            
            $categories = DB::collection('category')->get();
            $this->data['categories'] =$categories;
            
            $ownername = $ownerdetail['firstname']." ".$ownerdetail['lastname']; 
            $this->data["categoryname"] = $category;
            $this->data["pageclass"]= "dashboard productlist";
            $this->data["pagename"]= "$ownername Products";
            return View::make('productlist',$this->data);
	}
}
