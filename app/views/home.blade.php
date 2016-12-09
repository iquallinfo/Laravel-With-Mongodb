@extends('layouts.master')
@section('content')
<!-- Services Section -->
<!-- ============================= Content Area ========================================== -->        
<div class="container content-area">
    <div class="home-content">
        <div class="row">
            <div class="col-xs-6 col-md-4 pro-ser">
                <h3><span class="protit"><a href="#">Products</a></span> / <span class="ser"><a href="#">Services</a></span>  </h3>
                <ul class="list-inline pro-ser-style">       
                    <?php foreach($categories as $category){ ?>
                    <li>                        
                        <div class="category1">
                          <a href="<?= URL::to('/category/'. $category["slug"])?>"><?= $category["category"] ?></a>
                        </div>                                                         
                    </li>       
                    <?php } ?>                                                                                                           
               </ul>      
          </div>  
            <div class="col-xs-12 col-md-8 why-us">
                <div class="why-us-content">
                    <div class="why-heading1">
                    <h3>
                        <span style="font-weight: bold"> WHY </span> LOOKING PRODUCTS AND SERVICES HERE?                    </h3>
                    </div>
                    
                    <div class="why-text">
                         <p>Donec venenatis, turpis vel hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci. Nam congue, pede vitae dapibus aliquet, elit magna vulputate arcu, vel tempus metus leo non est. Etiam sit amet lectus quis est congue mollis. Phasellus congue lacus eget neque.</p>

<p>Phasellus ornare, ante vitae consectetuer consequat, purus sapien ultricies dolor, et mollis pede metus eget nisi. Praesent sodales velit quis augue. Cras suscipit, urna at aliquam rhoncus, urna quam viverra nisi, in interdum massa nibh nec erat.</p>
                    </div>
                    
                    <div class="mea-block-area">
                        <div class="col-md-4 mea-box">
                            <p class="mea-img">
                                <img src="{{ URL::asset('assets/theme/images/star-icon.png') }}">
                            </p>
                            
                            <p class="mea-title">Many Opportunities</p>
                            
                            <p class="mea-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam.</p>
                        </div>
                        
                        <div class="col-md-4 mea-box">
                            <p class="mea-img">
                                <img src="{{ URL::asset('assets/theme/images/desktop-icon.png') }}">
                            </p>
                            
                            <p class="mea-title">Easy To Use</p>
                            
                            <p class="mea-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam.</p>
                        </div>
                        
                        <div class="col-md-4 mea-box">
                            <p class="mea-img">
                             
                                <img src="{{ URL::asset('assets/theme/images/setting-icon.png') }}">
                            </p>
                            <p class="mea-title">Awesome Features</p>
                            
                            <p class="mea-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam.</p>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>

<div class="feature-product-list">
    <div class="container featured-pro">
        <div class="fpl-heading">
            <h3>
                <span class="cap bold"> Featured </span> Listing for Product & Services
            </h3>
        </div>
        
        <div class="feature-pro-block">
             <?php if(empty($products)) { echo "<center><span style='color:white'>There are no Featured Products Founds</span></center>"; } ?>
             <?php foreach($products as $prod){ ?>
            <div class="col-md-3 fp-box product-grid">
                <div class="fpb-img">                                                  
                   <div class='label'><img src="{{ URL::asset('assets/theme/images/featured-icon.png') }}"></div>
                   <img width="200" src="{{ URL::asset('assets/images/products/'.$prod['image']) }}" /> 
                      <div class="product-hover">
                           <a id="bookmarkme" href="#" rel="sidebar" class="bookmark" title="bookmark">Bookmark</a><br>
                           <a class="read-mores" href="#">Read More</a>
                      </div>
                </div>
               
                <p class="fpb-title"><a href="#"><?php echo $prod['productname'] ?></a></p>
                <p class="fpb-text"><b>Price:</b> $<?php echo $prod['price'] ?></p>
                <p class="fpb-text"><b>Category:</b> <?= $prod['categoryname'] ?></p>
            </div>
            <?php } ?> 
        </div>
      
    </div>
</div>
@stop
