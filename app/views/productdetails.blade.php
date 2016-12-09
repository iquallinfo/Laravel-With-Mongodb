@extends('layouts.master')
@section('content')
<!-- Services Section -->
<!-- ============================= Content Area ========================================== -->        
<div class="container content-area user-product-page">  
    <div class="col-md-12 service-content">
        <div class="col-xs-6 col-md-4 ser-left">            
        <!-- Left side Start -->
         
            <div class="sl-part2 left-box">
                <div class="slp2-inner">
                    <ul class="list-inline pro-ser-style">       
                    <?php foreach($categories as $category){ ?>
                    <li <?= (isset($categoryname) && $category["slug"] == $categoryname)?"class='activecat'":"" ?>>                        
                        <div class="category1">
                          <a href="<?= URL::to('/category/'. $category["slug"])?>"><?= $category["category"] ?></a>
                        </div>                                                         
                    </li>       
                    <?php } ?>                                                                                                           
                    </ul>
                </div>
            </div>
        
            <div class="left-box contactdet">
                <div class="uln-heading"><h3>
                    <span class="cnt-bold">Owner Details
                    </span></h3>
                </div>
                <div class="contact-text">    
                  <div class="addrows">        
                    <div class="addcols first-cols">            
                      <span><b>Owner Name</b>            
                      </span>        
                    </div>        
                    <div class="addcols">            
                      <span><?= $ownerdetails["firstname"]." ".$ownerdetails["lastname"] ?>
                      </span>        
                    </div>    
                  </div>   
                  <div class="addrows">        
                    <div class="addcols first-cols">            
                      <span>            <b>Full Address</b>            
                      </span>        
                    </div>        
                    <div class="addcols">            
                      <span><?= $ownerdetails["address_1"] ?>
                        <br><?= $ownerdetails["address_2"] ?>
                        <br>            
                      </span>        
                    </div>    
                  </div>    
                  <div class="addrows">        
                    <div class="addcols first-cols">            
                      <span><b>ZIP Code</b>            
                      </span>        
                    </div>        
                    <div class="addcols">            
                      <span><?= $ownerdetails["postcode"] ?>
                      </span>        
                    </div>    
                  </div>    
                  <div class="addrows">        
                    <div class="addcols first-cols">            
                      <span><b>Phone</b>            
                      </span>        
                    </div>        
                    <div class="addcols">            
                      <span><?= $ownerdetails["contact_no"] ?>          
                      </span>        
                    </div>    
                  </div>        
                  <div class="addrows">        
                    <div class="addcols first-cols">            
                      <span>            <b>City</b>            
                      </span>        
                    </div>        
                    <div class="addcols">            
                      <span><?= $ownerdetails["city"] ?>         
                      </span>        
                    </div>    
                  </div>    
                  <div class="addrows">        
                    <div class="addcols first-cols">            
                      <span>            <b>State</b>            
                      </span>        
                    </div>        
                    <div class="addcols">            
                      <span><?= $ownerdetails["state"] ?>         
                      </span>        
                    </div>    
                  </div>   
                  <div class="addrows">        
                    <div class="addcols first-cols">            
                      <span>            <b>Email</b>            
                      </span>        
                    </div>        
                    <div class="addcols">            
                      <span> <?= $ownerdetails["email"] ?>          
                      </span>        
                    </div>    
                  </div>
                  <div class="addrows"> 
                      <div class="viewmorelink">
                          <a href="<?= URL::to('products/owner/'.$ownerdetails["_id"].'/allproducts/')?>">View Other Products of this Owner</a>
                      </div>
                  </div>
                </div>
              </div>
            
        </div>
        
<script type="text/javascript">
  $(document).ready(function() {
    $("#bookmarkme").click(function() {
      if (window.sidebar) { // Mozilla Firefox Bookmark
        window.sidebar.addPanel(location.href,document.title,"");
      } else if(window.external) { // IE Favorite
        window.external.AddFavorite(location.href,document.title); }
      else if(window.opera && window.print) { // Opera Hotlist
        this.title=document.title;
        return true;
  }
});
});
</script>             

        <!-- Left side End -->
        <div class="col-xs-12 col-md-8 user-right-panel ">
            <div class="urp-top pro-title"> 
                <div class="urpt-left col-xs-6">
                    <div class="urp-heading product-title">
                    <h3><span class="cnt-bold"><?= $product['productname'] ?></span></h3>
                    </div>
                </div>
                <div class="urpt-right col-xs-6">
                    <div class="addtobookmark">
                        <a id="bookmarkme" href="#" rel="sidebar" title="bookmark this page"><img src="{{ URL::asset('assets/theme/images/addtobookmark.png') }}"></a> 
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="product-detail-area">
                <div class="pda-inner">
                    
                    <div class="product-desp">
                        <div class="proimg-featured">
                            <div class="pro-img">
                                   <!--- main image -------->    
                                        <img src="{{ URL::asset('assets/images/products/'.$product['image']) }}" /> 
                                    <!-- main image --->
                            </div>
                            
                            <div class="pro-feature">
                                <div class="addrows price">
                                    <div class="proprice">
                                        <b>Price: $<?php echo $product['price']; ?></b>
                                    </div>
                                </div>
                                <div class="addrows">
                                    <div class="addcols">
                                        <span><b>Category:</b></span>
                                    </div>
                                    <div class="addcols">
                                        <span>
                                           <?php echo $product['categoryname']; ?>                                        
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="product-desp">
                        <div class="product-details">
                                <div class="prodethead">
                                   <b>Product Description</b>
                                </div>
                              <?= $product['description'] ?>
                        </div>
                        <div class="clear"></div>
                </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    
</div>

<div class="feature-product-list">
    <div class="container featured-pro">
        <div class="fpl-heading">
            <h3>
                <span class="cap bold"> Recommended </span> Listing for Product & Services
            </h3>
        </div>
        
        <div class="feature-pro-block">
             <?php if(empty($recommended)) { echo "<center><span style='color:white'>There are no Recommended Products Founds</span></center>"; } ?>
            <div id="owl-demo" class="owl-carousel"> 
            <?php foreach($recommended as $prod){ ?>
            <div class="fp-box product-grid recommendedpro">
                <div class="fpb-img">                                                  
                    <img src="{{ URL::asset('assets/images/products/'.$prod['image']) }}" /> 
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
</div>
<!-- ============================= Content Area End ========================================== -->

<script>
$(document).ready(function() {

  $("#owl-demo").owlCarousel({
    navigation : true,
    items:4,
    loop:true,
    margin:20,
    autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true
  });

});
</script>

<?php 

function summary1($str, $limit=300, $strip = false) 
{
    $str = ($strip == true)?strip_tags($str):$str;
    if (strlen ($str) > $limit) {
        $str = substr ($str, 0, $limit - 3);
        return (substr ($str, 0, strrpos ($str, ' ')).'...');
    }
    return trim($str);
}
function days($date1, $date2) 
{
    $date1 = strtotime($date1);
    $date2 = strtotime($date2);
    return ($date1 - $date2) / (24 * 60 * 60);
}

?>
<!-- ============================= Content Area End ========================================== -->
@stop
