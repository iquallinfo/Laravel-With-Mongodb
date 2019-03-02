@extends('layouts.master')
@section('content')

<!-- Add Product Section -->
<!-- ============================= Content Area ========================================== -->        

<div class="content dashboard_page">
      <div id="postadd_div" class="col-md-12 col-sm-12">
         <div class="homeTitleBar">
          @include('layouts/dashboard_menu') 
         </div>
         
          @if(Session::has('success'))
           <div class="alert alert-success alert-dismissable">
               {{Session::get('success')}}
            </div>  
          @endif
        
         <div class="tab_contents">
            <div id="myaccount">
                <div class="addproducts">
                    <div id="success_reg" class="alert alert-success fade in hide">
                       <a href="#" class="close" data-dismiss="alert">&times;</a>
                       Product added Successfully. <a href="{{ url('/dashboard/products') }}">Click here</a> to get all Products
                    </div>
                     <div class="tab_contents">
                         <div id="myaccount">
                           <div class="content register_page">
                                <div id="postadd_div">
                                   <div class="homeTitleBar">
                                       <h1>Product Details </h1>
                                       <a href="{{ url('dashboard/products/') }}" class="pull-right btn btn-default">
                                           View Products
                                       </a>
                                   </div>
                                    <?php 
                                        if(!isset($productdata)){
                                    ?>
                                   <form id="addproduct" action="{{ url('/dashboard/addproduct/') }}" enctype="multipart/form-data" method="post" class="form-horizontal" >
                                   <?php }else{ ?>
                                   <form id="editproduct" action="{{ url('/dashboard/editproduct/'.$productdata["_id"]) }}" enctype="multipart/form-data" method="post" class="form-horizontal" >    
                                   <?php } ?>
                                  <div class="col-lg-6 col-md-6">
                                      <div class="form-group">
                                          <label for="productname" class="col-lg-4">Product Name</label>
                                          <div class="col-lg-6">
                                              <input type="text" class="form-control" value="<?= (isset($productdata))?$productdata['productname']:"" ?>" id="productname" name="productname" />
                                              <span class="help-block hidden"></span>
                                          </div>
                                      </div>
                                  </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                              <label for="price" class="col-lg-4">Price</label>
                                              <div class="col-lg-6">
                                                  <input type="text" class="form-control" value="<?= (isset($productdata))?$productdata['price']:"" ?>" id="price" name="price" />
                                                  <span class="help-block hidden"></span>
                                              </div>
                                          </div>
                                    </div>  

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                              <label for="category" class="col-lg-4">Category</label>
                                              <div class="col-lg-6">
                                                  <!--<input type="text" class="form-control" value="" id="category" name="category" />-->
                                                  <select class="form-control" id="category" name="category">
                                                      <option value="">Select Category</option>
                                                    <?php foreach($categories as $category){ ?>
                                                    <option <?= (isset($productdata) && $productdata['category'] == $category['_id'])?"selected":"" ?> value="<?= $category['_id'] ?>"><?= $category['category'] ?></option>
                                                    <?php } ?>
                                                  </select>
                                                  <span class="help-block hidden"></span>
                                              </div>
                                          </div>
                                    </div> 

                                   <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                              <label for="imagename" class="col-lg-4">Image</label>

                                              <div class="col-lg-6">
                                                      <span class="btn btn-default btn-file">
                                                         <i class="fa fa-link"></i> Browse <input name="image" id="imgupload" onchange="setvalue(this.value)" type="file">
                                                      </span>
                                                      <input type="text" id="imagename" class="form-control uploadtxt" value="<?= (isset($productdata))?$productdata['image']:"" ?>" name="imagename" />
            <!--                                      <input onchange="setvalue(this.value)" type="file" class="form-control" value="" id="image" name="image" />-->
                                                  <span class="help-block hidden"></span>
                                              </div>
                                          </div>
                                    </div> 

                                   <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                              <label for="description" class="col-lg-12">Description</label>
                                              <div class="col-lg-12">
                                                  <textarea name="description" id="description" class="txtarea ckeditor" rows="15"><?= (isset($productdata))?$productdata['description']:"" ?></textarea>
                                                  <span class="help-block hidden"></span>
                                              </div>
                                          </div>
                                    </div> 

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                              <label for="category" class="col-lg-4">Is Featured</label>
                                              <div class="col-lg-6">
                                                  <select class="form-control" id="isfeatured" name="isfeatured">
                                                    <option <?= (isset($productdata) && $productdata['isfeatured'] == "0")?"selected":"" ?> value="0">No</option>
                                                    <option <?= (isset($productdata) && $productdata['isfeatured'] == "1")?"selected":"" ?> value="1">Yes</option>
                                                  </select>
                                                  <span class="help-block hidden"></span>
                                              </div>
                                          </div>
                                    </div> 

                                   <div class="col-lg-12 col-md-12 submitbtn">
                                   <div class="label"></div> 
                                    <!--<input type="hidden" name="rredirect" value="" />-->
                                   <?php 
                                        if(!isset($productdata)){
                                    ?>
                                         <input class="btn btn-primary" type="button" name="submit" value="Submit" id="addprobtn"  />
                                   <?php }else{
                                   ?>
                                          <input class="btn btn-primary" type="button" name="submit" value="Update" id="editprobtn"  />
                                   <?php
                                   } ?>
                                   </div> 
                                   </form>
                                  </div>
                              </div>  
                         </div>
                     </div>
                </div>
            </div>
         </div>       
     </div>
</div>
<script>
function setvalue(value){
    $("#imagename").val(value);
}
</script>
  
@stop
