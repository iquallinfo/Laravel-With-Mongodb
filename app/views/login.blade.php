@extends('layouts.master')
@section('content')
<!-- Services Section -->
<!-- ============================= Content Area ========================================== -->        
<div class="container content-area">
<div class="content login_page">
    <div class="content_login_page">
    <div class="login">
        <form method="post" id="loginform" name="login_form">
        
         <h3>Already a member</h3>
         <div class="form-group">
            <label for="useremail" class="col-lg-4">Email Id:</label>
            <div class="col-lg-6">
                <input type="email" class="form-control" id="useremail" name="useremail" />
                <span class="help-block hidden"></span>
            </div>
        </div>
         <div class="clear"></div>
             
        <div class="form-group">
            <label for="userpassword" class="col-lg-4">Password</label>
            <div class="col-lg-6">
                <input type="password" class="form-control" id="password" name="userpassword" />
                <span class="help-block hidden"></span>
            </div>
        </div>
        <div id="errorlogin" class="alert alert-danger alert-dismissable hide">
        </div>
        <p class="submitLogin line">
        <label for="submit">
            <span class="label">&nbsp;</span>
            <input type="button" value="Sign in" id="loginbtn" class="olx-ui-button orange medium" name="btnSubmit">
        </label>
        <a href="#">
            <small>Forgot  your password?</small>
        </a>
        </p>
        </p></form> </div>
    
    <!-- register -->    
    <div class="register">
        <h3>Register now</h3>
        <p class="line">It will be free and always will be!</p>
        <a class="olx-ui-button orange medium" href="<?= URL::to('/register')?>">Continue</a>
    </div>
    
</div>
</div>
</div>    
@stop
