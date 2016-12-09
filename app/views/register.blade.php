@extends('layouts.master')
@section('content')

<!-- Services Section -->
<!-- ============================= Content Area ========================================== -->        
<div class="content register_page">
      <div id="success_reg" class="alert alert-success fade in hide">
           <a href="#" class="close" data-dismiss="alert">&times;</a>
           Registration Success. <a href="{{ url('/login') }}">Click here</a> to get Login
      </div>
      <div id="postadd_div">
         <div class="homeTitleBar">
             <h1>Register Account   </h1>
         </div>
         <form id="registerform" action="{{ url('/register') }}" method="post" class="form-horizontal" >
         <h4>Your Personal Details </h4>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="firstname" class="col-lg-4">Firstname</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="firstname" name="firstname" />
                    <span class="help-block hidden"></span>
                </div>
            </div>
        </div>
         
          <div class="col-lg-6 col-md-6">
              <div class="form-group">
                    <label for="lastname" class="col-lg-4">Lastname</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="lastname" name="lastname" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
          </div>  


            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="email" class="col-lg-4">Email</label>
                    <div class="col-lg-6">
                        <input type="email" class="form-control" id="email" name="email" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
            </div>

          <div class="col-lg-6 col-md-6">
              <div class="form-group">
                    <label for="contact_no" class="col-lg-4">Contact no</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="contact_no" name="contact_no" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
          </div>

         <div class="col-lg-6 col-md-6">
             <div class="form-group">
                    <label for="password" class="col-lg-4">Password</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="password" name="password" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>  

          <div class="col-lg-6 col-md-6">
              <div class="form-group">
                    <label for="repeatPassword" class="col-lg-4">Confirm Password</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="repeatPassword" name="repeatPassword" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>  


         <br /><br/><br/>
         <!---- address ------------------->
         <div>
         <h4>Your Address</h4>

         <div class="col-lg-6 col-md-6">
             <div class="form-group">
                    <label for="address_1" class="col-lg-4">Address 1</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="address_1" name="address_1" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>

         <div class="col-lg-6 col-md-6">
              <div class="form-group">
                    <label for="address_2" class="col-lg-4">Address 2</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="address_2" name="address_2" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>  

         <div class="col-lg-6 col-md-6">
             <div class="form-group">
                    <label for="city" class="col-lg-4">City</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="city" name="city" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>

         <div class="col-lg-6 col-md-6">
             <div class="form-group">
                    <label for="postcode" class="col-lg-4">Zipcode</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="postcode" name="postcode" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>

         <div class="col-lg-6 col-md-6">
             <div class="form-group">
                    <label for="state" class="col-lg-4">State</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="state" name="state" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>

         <div class="col-lg-6 col-md-6">
             <div class="form-group">
                    <label for="country" class="col-lg-4">Country</label>
                    <div class="col-lg-6">
                        <select class="form-control" id="country" name="country">
                            <?php foreach($countries as $country){ ?>
                            <option value="<?= $country['_id'] ?>"><?= $country['country'] ?></option>
                            <?php } ?>
                          </select>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>

         <br/><br/>
         </div>
          <h4>Company Details</h4>
         <div class="col-lg-6 col-md-6">
             <div class="form-group">
                    <label for="companyname" class="col-lg-4">Company name</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="companyname" name="companyname" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>

         <div class="col-lg-6 col-md-6">
             <div class="form-group">
                    <label for="companyloca" class="col-lg-4">Company Locality</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="companyloca" name="companyloca" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>

         <div class="col-lg-6 col-md-6">
             <div class="form-group">
                    <label for="companydesc" class="col-lg-4">Company Description</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="companydesc" name="companydesc" />
                        <span class="help-block hidden"></span>
                    </div>
                </div>
         </div>

         <div class="col-lg-12 col-md-12 submitbtn">
         <div class="label"></div> 
          <!--<input type="hidden" name="rredirect" value="" />-->
          <input class="btn btn-primary" type="button" name="submit" value="Submit" id="registerbtn"  />
         </div> 
         </form>
        </div>
    </div>
@stop
