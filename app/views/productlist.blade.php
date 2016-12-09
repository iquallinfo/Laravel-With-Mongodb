@extends('layouts.master')
@section('content')
<!-- Services Section -->
<!-- ============================= Content Area ========================================== -->        
<div class="container content-area">
    <div class="col-md-12 service-content">
        <div class="col-xs-6 col-md-4 ser-left">
            <div class="sl-heading">
                <h3><a href="#"><span class="protit">Products</span></a> / <a href="#"><span class="ser">Services</span></a>  </h3>
            </div>
                
            <div class="sl-part1">
            </div>
            <div class="sl-part2">
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
        </div>
        
        <div class="col-xs-12 col-md-8 ser-right">
            <div class="sr-top">
            <div class="srght-heading">
                <h3><span class="srght-bold">Products</h3>
            </div>
<!--            <div class="sr-fil filter">
                <span>
                 
                    <input type="text" id="search" name="search" onkeypress="return runScript(event)"  class="form-control textbox filter-txt" id="name" placeholder="Filter by Keywords & Tags" />
                   
                </span>    
            </div>-->
                <div class="clear"></div>
            </div>
            
            <div class="clear"></div>
            <div class="sort-paging">
                <form name="sortform">
                    <div class="sorting-part">
                        <p class="sort-img">
                            <?php if(isset($_GET['view']) && $_GET['view']=="grid") { ?>
                                    <img onclick="filtro('grid','<?php if(isset($_GET['sort'])){ echo $_GET['sort']; } ?>')"  src="{{ URL::asset('assets/theme/images/icon2.png') }}"  />                   
                            <?php }else { ?>                       
                            <?php if(!isset($_GET['view'])) { ?>
                                    <img onclick="filtro('grid','<?php if(isset($_GET['sort'])){ echo $_GET['sort']; } ?>')"  src="{{ URL::asset('assets/theme/images/icon2.png') }}"  />                   
                            <?php } else { ?>
                                   <img style="border: 1px solid #cccccc;" onclick="filtro('grid','<?php if(isset($_GET['sort'])){ echo $_GET['sort']; } ?>')"  src="{{ URL::asset('assets/theme/images/icon2hover.png') }}"  />
                            <?php } ?>        

                            <?php } ?>
                               <span style="display: none"><input type="radio" value="grid" id="grid" name="view"></span>
                        </p>                
                        <p class="sort-img">
                             <?php if(isset($_GET['view']) && $_GET['view']=="list") { ?>
                               <img onclick="filtro('list','<?php if(isset($_GET['sort'])){ echo $_GET['sort']; } ?>')" src="{{ URL::asset('assets/theme/images/icon-3hover.png') }}"  />
                              <?php }else { ?>                       
                              <img onclick="filtro('list','<?php if(isset($_GET['sort'])){ echo $_GET['sort']; } ?>')" src="{{ URL::asset('assets/theme/images/icon-3.png') }}"  />
                              <?php } ?>                       
                               <span style="display: none"><input type="radio" id="list" value="list" name="view"></span>
                        </p>

                        <div class="selectbox sortby">
                            <select class="selectpicker" id="sort" onchange="filtro2('<?php if(isset($_GET['sort'])){ echo $_GET['view']; }else{ echo 'grid' ; } ?>',this)" name="sort">
                               <option value="">- Sort By -</option>
                               <option value="productname">Name</option>
                               <option value="price">Price</option>
                           </select>
                            <div class="clear"></div>
                        </div>
                        
                        <div class="sr-fil filter pull-right srchkey">
                            <span>
                                <input type="text" id="search" name="search" value="<?= (isset($_GET["search"]))?$_GET["search"]:''?>" class="form-control textbox filter-txt" id="name" placeholder="Filter by Keywords & Tags" />
                            </span>    
                        </div>
                    </div>
                    </form>
                 <div class="clear"></div>
                 
               </div>
            
            
            <div class="product-block">
            <?php if(empty($products)){ echo "There are no products matching the selection."; } ?>    
            <!-- ======= Price Sorting ===== -->
            
             <?php for($i=0;$i<sizeof($products);$i++){ 
            
                       $psort[$i] = $products[$i]['price'];
                       
             } 
             if(isset($_GET['sort']) && $_GET['sort']=="price" && !empty($products))
             {
              sort($psort);
              for($i=0;$i<sizeof($psort);$i++) $products[$i]['price']=$psort[$i];  
             
             }
            ?>
            <?php if(empty($products)) { echo "<center><span style='color:white'>There are no Featured Products Founds</span></center>"; } 
            if(isset($_GET["view"])){
                if(  $_GET["view"] != ""){
                    if($_GET["view"] == "list"){
                        $class="col-md-3 fp-box products-list";
                    }
                    else{
                        $class="col-md-3 fp-box product-grid";
                    }
                }
                else{
                    $class="col-md-3 fp-box product-grid";
                }
            }
            else{
                $class="col-md-3 fp-box product-grid";
            }
            
            ?>
             <?php foreach($products as $prod){ ?>
            <div class="<?= $class ?>">
                <div class="fpb-img">                                                  
                   <div class='label'><img src="{{ URL::asset('assets/theme/images/featured-icon.png') }}"></div>
                   <img width="270" height="200" src="{{ URL::asset('assets/images/products/'.$prod['image']) }}" /> 
                      <div class="product-hover">
                           <a id="bookmarkme" href="#" rel="sidebar" class="bookmark" title="bookmark">Bookmark</a><br>
                           <a class="read-mores" href="<?= URL::to('/products/'.$prod["owner"].'/'.$prod["slug"])?>">Read More</a>
                      </div>
                </div>
               
                <p class="fpb-title"><a href="<?= URL::to('/products/'.$prod["owner"].'/'.$prod["slug"])?>"><?php echo $prod['productname'] ?></a></p>
                <p class="fpb-text"><b>Price:</b> $<?php echo $prod['price'] ?></p>
                <p class="fpb-text"><b>Category:</b> <?= $prod['categoryname'] ?></p>
            </div>
            <?php } ?>       
                <div class="clear"></div>
        </div>
        </div>
        
        <div class="clear"></div>
    
    </div>
</div>
<!-- ============================= Content Area End ========================================== -->

<script>
document.getElementById("sort").value = "<?php if(isset($_GET['sort'])) { echo $_GET['sort']; } ?>";   

<?php if(isset($_GET["view"]) && $_GET["view"] !=""){
    if($_GET["view"]=="list"){?>
        $("#list").attr("checked","checked");
    <?php
    }
    else{ ?>
        $("#grid").attr("checked","checked");
   <?php
    }
}else{
?>
    $("#grid").attr("checked","checked");
<?php
} ?>
 
function filtro(v,s) 
{
    
       document.getElementById(v).checked = true;
       document.getElementById("sort").value = s;
       document.forms["sortform"].submit();
       

}    

function filtro2(v,s) 
{
    
       document.getElementById(v).checked = true;
       document.getElementById("sort").value = s.value;
       document.forms["sortform"].submit();
       

} 
</script> 
@stop
