				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right">
												<i class="fa fa-plus"></i>
											</span>
<?php 
$select="SELECT * FROM cat ";
$result=$conn->query($select);
while($row_cat=$result->fetch_assoc()){?>
<li><a href="shop.php?cat_id=<?= $row_cat['id'] ?>"><?= $row_cat['name'] ?></a></li><br>
<?php
}
 ?>										</a>
									</h4>
						
								</div>
							</div>
						</div><!--/category-products-->
					



						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">

<?php 
$select="SELECT * FROM brand ";
$result=$conn->query($select);
while($row_brand=$result->fetch_assoc()){?>
<li><a href="shop.php?brand_id=<?= $row_brand['id'] ?>"><?= $row_brand['name'] ?></a></li><br>
<?php
}
 ?>									
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>