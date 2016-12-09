@extends('layouts.master')
@section('content')
<!-- Services Section -->
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
                <div class="productslist">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="phead pull-left">
                                        Products list
                                    </div>
                                    <div class="pull-right addnewbtn control-lable">
                                        <a class="btn btn-outline btn-primary" href="{{ url('/dashboard/addproduct') }}">Add Product</a>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Is Featured</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $cnt =0; foreach($products as $product){$cnt++ ?>
                                                <tr>
                                                    <td><?= $cnt ?></td>
                                                    <td><img width="50" height="50" src="{{ URL::asset('assets/images/products/'.$product['image']) }}" /> </td>
                                                    <td><?= $product["productname"] ?></td>
                                                    <td><?= $product["price"] ?></td>
                                                    <td><?= ($product["isfeatured"] == 0)?"No":"Yes" ?></td>
                                                    <td><a href="{{ url('/dashboard/editproduct/'.$product['_id']) }}"> <i class="fa fa-edit"></i> Edit</a> | 
                                                        <a onclick="confirm('Are you Sure to delete?')" href="{{ url('/dashboard/deleteproduct/'.$product['_id']) }}"> <i class="fa fa-times"></i> Delete</a> |
                                                        <a href="{{ url('/dashboard/productimage/'.$product['_id']) }}"> <i class="fa fa-picture-o"></i> Set Product image</a> 
                                                    </td>

                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                    </div>
                </div>
            </div>
         </div>       
     </div>
</div>

<!-- ============================= Content Area End ========================================== -->
@stop
