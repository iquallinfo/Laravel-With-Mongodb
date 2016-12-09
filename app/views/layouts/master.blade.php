<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="" xml:lang="en" xmlns:og="" xmlns:fb="" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <link rel="icon" href="{{URL::asset('assets/theme/images/favicon.ico')}}">
    
    
    <link rel="stylesheet" href="{{URL::asset('assets/theme/css/style.css')}}" type="text/css"></link>    
    <script src="{{URL::asset('assets/theme/js/jquery-1.8.3.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,500,600' rel='stylesheet' type='text/css'>

     <title><?= (isset($pagename))?$pagename:"B2B"; ?></title>

     <link href="{{URL::asset('assets/theme/font-awesome/css/font-awesome.css')}}" rel="stylesheet"></link>   
    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('assets/theme/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--<link href="css/bootstrap.css" rel="stylesheet">-->
    <link href="{{URL::asset('assets/theme/css/style-sheet.css')}}" rel="stylesheet">
    
    <link href="{{URL::asset('assets/theme/css/bootstrap-select.css')}}" rel="stylesheet">
    <!--<link href="css/bootstrap-select.min.css" rel="stylesheet">-->

        
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
  </head>
  
    <body class="<?= (isset($pageclass))?$pageclass:"pages"; ?> bodypage">
        
    
<script>

$(document).ready(function(){
  $(function() {
    // this will get the full URL at the address bar
    var url = window.location.href;

    // passes on every "a" tag
    $(".nav li a").each(function() {
            // checks if its the same on the address bar
        if(url == (this.href)) {
            $(this).closest(".nav li").addClass("active");
         }
    });
});
});
</script>
    <!-- ============================= Top area ========================================== -->
    <div class="container top-area">
            <div class="row">
                <div class="col-md-4 top-menu-area">
                    <div class="top-menu">
                        <div class="top-meni-inner">
                          <ul class="list-inline top-menu-style">
                              <?php  if(!isset($session["is_login"])){ ?>
                                <li class="active-top"> 
                                    <a href="<?= URL::to('/login')?>"><i class="fa fa-sign-in"></i> Login</a> 
                                </li>
                                <li>
                                    <a href="<?= URL::to('/register')?>"><i class="fa fa-rotate-right"></i> SignUp</a>
                                </li>
                              <?php }else{ ?>
                                <li class="logout">
                                    <a href="<?= URL::to('/logout')?>"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                                <li class="dashboard">
                                    <a href="<?= URL::to('/dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                                </li>
                              <?php } ?>
                          </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 cmp-logo">
                    <div class="logo-area">
                        <div class="logo-inner">
                            <a href="<?= URL::to('/')?>">
                                   <img src="{{ URL::asset('assets/theme/images/logo.jpg') }}" />
                            </a>
                        </div>
                    </div>
                
                </div>
                
                <div class="col-md-4 advertise">
                    <div class="advertise-area">
                        <div class="advertise-inner">
                            <a href="#">
                                <span><img class="adsimg" src="{{ URL::asset('assets/theme/images/advertise.jpg') }}"></span>
                                <span>Advertise &nbsp;</span>
                            </a>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span><?= $session["userdata"]["firstname"]." ".$session["userdata"]["lastname"] ?></span>
                            </a>
                        </div>
                    </div>
                
                </div>
                
        </div>
    </div> 
<!-- ============================= Top area End ========================================== -->
<div class="header-area <?= $pageclass ?>">
<div class="header-bg">
<div class="container header-inner">
        <div class="col-md-12">
              <div class="search-creteria">
                
                <div class="res-drop">
                        <div class="res-inner">
                            <a href="#">
                                <img src="{{ URL::asset('assets/theme/images/res-drop.png') }}">
                            </a>
                        </div>
                </div>
                <div class="selection row">
                 <form action="{{ url('/products/search/') }}">   
                    <div class="col-md-3 textbox-area">
                        <input type="text" class="form-control textbox" name="search" id="search" placeholder="Search for products, services or companies" />
                    </div>                    
                    
                    <div class="col-md-3 selectbox category">
                        <select class="selectpicker" name="category">
                            <option value="">Select Category</option> 
                            <?php
                                $categorylist = categorylist();
                            foreach($categorylist as $category){ ?>
                           <option value="<?= $category["_id"] ?>"><?= $category["category"] ?></option> 
                            <?php } ?>
                       </select>
                        <div class="button-area">
                        <input type="submit" value="" class="subbtn"  />
                    </div>
                    </div> 
                 </form>
                </div>   
                </div>               
                </div>

<?php if(!isset($is_home)){ ?>
<div class="col-md-12 page-title">                
  <div class="col-xs-12 col-md-8">                
    <div class="page-title-text">                
      <span><?= $pagename ?></span>                
    </div>                
  </div>                
  <div class="col-xs-6 col-md-4">                
    <div class="right-menu">                
      <div class="right-menu-inner">                
        <ul class="right-menu-style">                
          <li class="">                
            <a href="<?= URL::to('/')?>">Home</a>                
          </li>                
          <li class=""><?= $pagename ?>      
          </li>                
        </ul>                
      </div>                
    </div>                
  </div>                
</div>
<?php } ?>

</div>
<?php
if(isset($is_home)){ ?> 
<div id="myCarousel" class="carousel slide" data-ride="carousel"> 
<div class="carousel-inner">

 <!-- ==================== Slider One ================================ -->   
    <div class="item active">
      <img src="{{ URL::asset('assets/theme/images/slider/arkapark-background-01.jpg') }}" style="width:100%" alt="First slide">
        <div class="container">
          <div class="carousel-caption">
            <p class="home-title1">Welcome to the Most 1</p>
                <p class="home-title2">Complete</p>
                <p class="home-title3">Directory From Hotel Industry</p>                      
          </div>
        </div>
    </div>
    <div class="item">
      <img src="{{ URL::asset('assets/theme/images/slider/arkapark-background-02.jpg') }}" style="width:100%" alt="First slide">
        <div class="container">
          <div class="carousel-caption">
            <p class="home-title1">Welcome to the Most3</p>
            <p class="home-title2">Complete3</p>
            <p class="home-title3">Directory From Hotel Industry3</p>                      
          </div>
        </div>
    </div>
 <!-- ==================== Slider Two ================================ -->   
</div>
<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> 
</div>
<?php } ?>
</div>
 
</div>
</div>

<div class="col-md-12 navigation-menu">
<!--                  <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav">
                      
                    </ul>
                  </div>-->
                    <nav class="navbar navbar-inverse navbar-fixed-top">
                      <div class="container">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>

                          </button>
                        </div>
                        <div id="navbar" class="collapse navbar-collapse">
                          <ul class="nav navbar-nav">
                            <li class=""><a href="<?= URL::to('/')?>/">Home</a></li>
                            <li><a href="<?= URL::to('/aboutus/')?>">About Us</a></li>
                            <li><a href="<?= URL::to('/products/allproducts')?>">Products</a></li>
                            <li><a href="<?= URL::to('/companies/')?>">Companies</a></li>
                            <li><a href="<?= URL::to('/blogs/')?>">Blog</a></li>
                            <li><a href="<?= URL::to('/contactus/')?>">Contact Us</a></li>
                          </ul>
                        </div><!--/.nav-collapse -->
                      </div>
                    </nav>
                </div>
<div class="row containerarea">
@yield('content')
</div>

<!-- ============================= Content Area End ========================================== -->

<!-- ============================= footer Area  ========================================== -->
<div class="footer-wrapper">
<div class="footer-area">
    <div class="container">
        <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-3">
                      <h3>  About HOTELCONTRACTOR  </h3>
                      <p>
                          <img src="{{ URL::asset('assets/theme/images/extra/images9.jpg') }}"><br><br>                                    
                      </p>
                      <div class="fot1-text">
                         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.1 </p>
                     </div>
                    </div>
                    <div class="footer-col col-md-3">
                        <h3>Latest from Blog </h3>
                        <ul class="list-inline">
                         <?php
                         $footerblog = footerblog();
                         foreach($footerblog as $lblog) { ?>
                          <li>
                                <p class="blog-img">
                                   <?php 
                                     $blogimg = (isset($lblog['image']) && $lblog['image'] !="")?$lblog['image']:"no-pic.gif";
                                    ?>
                                    <img src="{{ URL::asset('assets/images/blogs/'.$blogimg) }}"  style="width:70px"/> 
                                </p>
                                <p class="blog-title">
                                    <a href="{{ url('blog/'.$lblog['slug']) }}"><?= $lblog['blogtitle']; ?></a>
                                </p>                                
                                <p class="blog-text">
                                  <?= limit_words($lblog['description'],20) ?>
                                </p>                                
                            </li>
                         <?php } ?>
                        </ul>
                    </div>
                    <div class="footer-col col-md-3">
                        <h3>Quick Links</h3>
                        <ul class="list-inline pop-cat">
                            <li class=""><a href="<?= URL::to('/')?>/">Home</a></li>
                            <li><a href="<?= URL::to('/aboutus/')?>">About Us</a></li>
                            <li><a href="<?= URL::to('/products/allproducts')?>">Products</a></li>
                            <li><a href="<?= URL::to('/companies/')?>">Companies</a></li>
                            <li><a href="<?= URL::to('/blogs/')?>">Blog</a></li>
                            <li><a href="<?= URL::to('/contactus/')?>">Contact Us</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-col col-md-3">
                      
                        <h3>Newsletter</h3>
                        <div class="navbar-form newsletter">
                            
                            <div class="form-group">
                                <form method="post" id="loginForm" name="loginForm">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address"   required="required">
                                
                              <input type="submit" class="btn btn-success" value="" name="newssub" > 
                                </form>
                              </div>
                            <!--<button class="btn btn-success" type="submit">Sign in</button>-->
                          
                           
                        </div>
                        
                        
                        <div class="social-links">
                            <p class="kit">Keep in Touch</p>
                           <ul class="list-inline social-icon">
                            <li>
                                <a href="#" target="_blank"><img src="{{ URL::asset('assets/theme/images/fb.png') }}" /></a>
                            </li>
                            <li>
                               <a href="#" target="_blank"><img src="{{ URL::asset('assets/theme/images/t.png') }}" /></a>
                            </li>
                            <li>
                                 <a href="#" target="_blank" ><img src="{{ URL::asset('assets/theme/images/g+.png') }}" /></a>
                            </li>
                            <li>
                                 <a href="#" target="_blank"><img src="{{ URL::asset('assets/theme/images/in.png') }}" /></a>
                            </li>
                            </ul> 
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
       
    </footer>
    </div>
    
</div>
    <div class="copyright-area">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 copyrightext">
                        <p>Copyright 2015 &copy; Hotelcontractor.com </p>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="foot-nav">
                           <ul class="list-inline foot-nav">
                            <li>
                                <a href="#">Policies & Rules </a>
                            </li>
                            <li>
                               <a href="#">Terms of Use</a>
                            </li>
                            <li>
                                 <a href="#">Product Listing Policy</a>
                            </li>
                            </ul> 
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>

</div>

</body>  
</html>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

<script src="{{URL::asset('assets/theme/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/theme/js/bootstrap-select.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/theme/js/formValidation.js')}}"></script>

<script src="{{URL::asset('assets/theme/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/theme/plugins/backbone/underscore-min.js')}}"></script>
<script src="{{URL::asset('assets/theme/plugins/backbone/backbone-min.js')}}"></script>     
<script src="{{URL::asset('assets/theme/plugins/backbone/backbone-validation.js')}}"></script>     
<script src="{{URL::asset('assets/theme/plugins/backbone/backbone-validation-amd.js')}}"></script>     
<script src="{{URL::asset('assets/theme/plugins/backbone/script.js')}}"></script>
<script src="{{URL::asset('assets/theme/plugins/ckeditor/ckeditor.js')}}"></script>

<link href="{{ URL::asset('assets/theme/js/owl.carousel/owl-carousel/owl.carousel.css') }}" rel="stylesheet">    
<script src="{{ URL::asset('assets/theme/js/owl.carousel/owl-carousel/owl.carousel.js') }}"></script>
