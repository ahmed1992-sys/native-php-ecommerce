<?php
include("include/header.php");
?>
	
	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
	
	<?php
	include("include/sidebar.php");

	?>
	<div class="col-sm-9 padding-right">
		<div class="features_items"><!--features_items-->
<h2 class="title text-center">Features Items</h2>
<?php 
$limit=5;
$page=isset($_GET['page'])?$_GET['page']:1;
if($page<1){
	$page=1;
}
$offset=($page-1)*$limit;
//استعلام عدد العناصر
if(isset($_GET['cat_id'])){
$cat_id=$_GET['cat_id'];

$count_sql="SELECT COUNT(*) AS total from product
 left join image_pro on product.id=image_pro.producte_id 
where product.cat=$cat_id";

}elseif(isset($_GET['brand_id'])){
	$brand_id=$_GET['brand_id'];

$count_sql="SELECT COUNT(*) AS total from product 
 left join image_pro on product.id=image_pro.producte_id 

where product.brand=$brand_id";

} else{   
$count_sql="SELECT COUNT(*) AS total from product
 left join image_pro on product.id=image_pro.producte_id";
}		
$result_con=$conn->query($count_sql);
$row_con=$result_con->fetch_assoc();
$total_pro=$row_con['total'];
$total_page=ceil($total_pro/$limit);
//استعلام المنتجات
if(isset($_GET['cat_id'])){
$cat_id=$_GET['cat_id'];

$select="SELECT product.id ,product.name,product.price,product.desc,image_pro.img 
FROM product LEFT JOIN image_pro ON product.id=image_pro.producte_id
where product.cat=$cat_id limit $offset,$limit";

}elseif(isset($_GET['brand_id'])){
	$brand_id=$_GET['brand_id'];

$select="SELECT product.id ,product.name,product.price,product.desc,image_pro.img 
FROM product LEFT JOIN image_pro ON product.id=image_pro.producte_id
where product.brand=$brand_id limit $offset,$limit";

} else{   
$select="SELECT product.id ,product.name,product.price,product.desc,image_pro.img 
FROM product LEFT JOIN image_pro ON product.id=image_pro.producte_id limit $offset,$limit  ";
}		

$result=$conn->query($select);
if($result->num_rows>0){
while($row=$result->fetch_assoc()){?>
<a href="product-details.php?id=<?= $row['id'] ?>">
	<div class="col-sm-4">
	<div class="product-image-wrapper">
		<div class="single-products">
<div class="productinfo text-center">
	<?php
	if(!empty($row['img'])){?>
	
		<img src="../../imgs/<?= $row['img'] ?>" style="height: 150px;width: 150px; "/>

<?php
	}?>
	<h2>$<?= htmlspecialchars($row['price']) ?></h2>
	<p><?= htmlspecialchars($row['desc']) ?></p>
	<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
</div>
	</div>
	</div>
</div>
</a>
<?php
}
}else{?>
		<h3 style="text-align: center;font-size: 30px; 
		color: #696763;
    font-weight: bold;">
			Empty
		</h3>
		<?php
	}
	?>
 


		</div><!--features_items-->
		<div class="row text-center">
		<?php 
if($total_page>1){
	?>
<ul class="pagination text-center" >
<?php
if($page>1){
		if(isset($_GET['cat_id'])){
	$pre_page="shop.php?cat_id=" . $cat_id . "&page=" . ($page-1);
}elseif(isset($_GET['brand_id'])){
	$pre_page="shop.php?brand_id=" . $brand_id . "&page=" . ($page-1);
}else{
		$pre_page="shop.php?page=" . ($page-1);

}

		?>
	<li>
		<a href="<?= ($pre_page) ?>">السابق</a></li>
			<?php

}?>
<?php
for($i=1;$i<=$total_page;$i++){
if(isset($_GET['cat_id'])){
	$url="shop.php?cat_id=" . $cat_id . "&page=" . $i;
}elseif(isset($_GET['brand_id'])){
	$url="shop.php?brand_id=" . $brand_id . "&page=" . $i;
}else{
		$url="shop.php?page=" . $i;

}


 ?>

	<li class="<?= ($page==$i)?'active':'' ?>">
		<a href="<?= $url ?>"><?= $i ?></a></li>
	<?php }
	if($page<$total_page){
		if(isset($_GET['cat_id'])){
	$next_page="shop.php?cat_id=" . $cat_id . "&page=" . ($page+1);
}elseif(isset($_GET['brand_id'])){
	$next_page="shop.php?brand_id=" . $brand_id . "&page=" . ($page+1);
}else{
		$next_page="shop.php?page=" . ($page+1);

}

		?>
	<li>
		<a href="<?= ($next_page) ?>">التالي</a></li>
</ul>
<?php }
} ?>
</div>
	</div>
</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
<div class="container">
	<div class="row">
		<div class="col-sm-2">
<div class="companyinfo">
	<h2><span>e</span>-shopper</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
</div>
		</div>
		<div class="col-sm-7">
<div class="col-sm-3">
	<div class="video-gallery text-center">
		<a href="#">
<div class="iframe-img">
	<img src="images/home/iframe1.png" alt="" />
</div>
<div class="overlay-icon">
	<i class="fa fa-play-circle-o"></i>
</div>
		</a>
		<p>Circle of Hands</p>
		<h2>24 DEC 2014</h2>
	</div>
</div>

<div class="col-sm-3">
	<div class="video-gallery text-center">
		<a href="#">
<div class="iframe-img">
	<img src="images/home/iframe2.png" alt="" />
</div>
<div class="overlay-icon">
	<i class="fa fa-play-circle-o"></i>
</div>
		</a>
		<p>Circle of Hands</p>
		<h2>24 DEC 2014</h2>
	</div>
</div>

<div class="col-sm-3">
	<div class="video-gallery text-center">
		<a href="#">
<div class="iframe-img">
	<img src="images/home/iframe3.png" alt="" />
</div>
<div class="overlay-icon">
	<i class="fa fa-play-circle-o"></i>
</div>
		</a>
		<p>Circle of Hands</p>
		<h2>24 DEC 2014</h2>
	</div>
</div>

<div class="col-sm-3">
	<div class="video-gallery text-center">
		<a href="#">
<div class="iframe-img">
	<img src="images/home/iframe4.png" alt="" />
</div>
<div class="overlay-icon">
	<i class="fa fa-play-circle-o"></i>
</div>
		</a>
		<p>Circle of Hands</p>
		<h2>24 DEC 2014</h2>
	</div>
</div>
		</div>
		<div class="col-sm-3">
<div class="address">
	<img src="images/home/map.png" alt="" />
	<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
</div>
		</div>
	</div>
</div>
		</div>
		
		<div class="footer-widget">
<div class="container">
	<div class="row">
		<div class="col-sm-2">
<div class="single-widget">
	<h2>Service</h2>
	<ul class="nav nav-pills nav-stacked">
		<li><a href="">Online Help</a></li>
		<li><a href="">Contact Us</a></li>
		<li><a href="">Order Status</a></li>
		<li><a href="">Change Location</a></li>
		<li><a href="">FAQ’s</a></li>
	</ul>
</div>
		</div>
		<div class="col-sm-2">
<div class="single-widget">
	<h2>Quock Shop</h2>
	<ul class="nav nav-pills nav-stacked">
		<li><a href="">T-Shirt</a></li>
		<li><a href="">Mens</a></li>
		<li><a href="">Womens</a></li>
		<li><a href="">Gift Cards</a></li>
		<li><a href="">Shoes</a></li>
	</ul>
</div>
		</div>
		<div class="col-sm-2">
<div class="single-widget">
	<h2>Policies</h2>
	<ul class="nav nav-pills nav-stacked">
		<li><a href="">Terms of Use</a></li>
		<li><a href="">Privecy Policy</a></li>
		<li><a href="">Refund Policy</a></li>
		<li><a href="">Billing System</a></li>
		<li><a href="">Ticket System</a></li>
	</ul>
</div>
		</div>
		<div class="col-sm-2">
<div class="single-widget">
	<h2>About Shopper</h2>
	<ul class="nav nav-pills nav-stacked">
		<li><a href="">Company Information</a></li>
		<li><a href="">Careers</a></li>
		<li><a href="">Store Location</a></li>
		<li><a href="">Affillate Program</a></li>
		<li><a href="">Copyright</a></li>
	</ul>
</div>
		</div>
		<div class="col-sm-3 col-sm-offset-1">
<div class="single-widget">
	<h2>About Shopper</h2>
	<form action="#" class="searchform">
		<input type="text" placeholder="Your email address" />
		<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
		<p>Get the most recent updates from <br />our site and be updated your self...</p>
	</form>
</div>
		</div>
		
	</div>
</div>
		</div>
		
		<div class="footer-bottom">
<div class="container">
	<div class="row">
		<p class="pull-left">Copyright © 2013 E-Shopper. All rights reserved.</p>
		<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
	</div>
</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>