<div class="row">
	<ul class="nav nav-tabs">
		<?php if($featured_permision){
				if($emptyfeaturedtabpermsion){ ?>
				 <li class="<?php echo ($featured_active ? 'active' : ''); ?>"><a href="#tab-featured" data-toggle="tab"><?php echo $tab_featured; ?></a></li>
				<?php } ?>
		<?php } ?>
		<?php if($lastest_permision){
			if($emptylastesttabpermsion){ ?>
				<li class="<?php echo ($lastest_active ? 'active' : ''); ?>"><a href="#tab-lastest" data-toggle="tab"><?php echo $tab_lastest; ?></a></li>
			<?php } ?>
		<?php } ?>
		<?php if($special_permision){
		  if($emptyspecialtabpermsion){ ?>
		<li class="<?php echo ($special_active ? 'active' : ''); ?>"><a href="#tab-specials" data-toggle="tab"><?php echo $tab_specials; ?></a></li>	  
		<?php } } ?>
		
		<?php if($bestseller_permision){
				if($emptybestsellertabpermsion){ ?>
		<li class="<?php echo ($bestseller_active ? 'active' : ''); ?>"><a href="#tab-bestsellers" data-toggle="tab"><?php echo $tab_bestsellers; ?></a></li>
		<?php } ?>
		<?php } ?>
    </ul>
	<div class="tab-content">
	  <div class="tab-pane <?php echo ($featured_active ? 'active' : ''); ?>" id="tab-featured">
			<div id="featured<?php echo $module; ?>" class="row owl-carousel">
				  <?php foreach ($featured_products as $product){ ?>
					  <div class="product-layout item">
						<div class="product-thumb transition">
						  <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
						  <div class="caption">
							<h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
							<p><?php echo $product['description']; ?></p>
							<?php if ($product['rating']) { ?>
							<div class="rating">
							  <?php for ($i = 1; $i <= 5; $i++) { ?>
							  <?php if ($product['rating'] < $i) { ?>
							  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
							  <?php } else { ?>
							  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
							  <?php } ?>
							  <?php } ?>
							</div>
							<?php } ?>
							<?php if ($product['price']) { ?>
							<p class="price">
							  <?php if (!$product['special']) { ?>
							  <?php echo $product['price']; ?>
							  <?php } else { ?>
							  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
							  <?php } ?>
							  <?php if ($product['tax']) { ?>
							  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
							  <?php } ?>
							</p>
							<?php } ?>
						  </div>
						  <div class="button-group">
							<button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
							<button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
							<button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
						  </div>
						</div>
					  </div>
				  <?php } ?>
		  </div>
	</div>
	<div class="tab-pane <?php echo ($lastest_active ? 'active' : ''); ?>" id="tab-lastest">
	<div id="lastest<?php echo $module; ?>" class="row owl-carousel">
	  <?php foreach ($lastest_products as $product){ ?>
	  <div class="product-layout item">
		<div class="product-thumb transition">
		  <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
		  <div class="caption">
			<h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
			<p><?php echo $product['description']; ?></p>
			<?php if ($product['rating']) { ?>
			<div class="rating">
			  <?php for ($i = 1; $i <= 5; $i++) { ?>
			  <?php if ($product['rating'] < $i) { ?>
			  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } else { ?>
			  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } ?>
			  <?php } ?>
			</div>
			<?php } ?>
			<?php if ($product['price']) { ?>
			<p class="price">
			  <?php if (!$product['special']) { ?>
			  <?php echo $product['price']; ?>
			  <?php } else { ?>
			  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
			  <?php } ?>
			  <?php if ($product['tax']) { ?>
			  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
			  <?php } ?>
			</p>
			<?php } ?>
		  </div>
		  <div class="button-group">
			<button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
			<button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
			<button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
		  </div>
		</div>
	  </div>
		<?php } ?>
	</div>
	</div>
	<div class="tab-pane <?php echo ($special_active ? 'active' : ''); ?>" id="tab-specials">
	 <div id="specials<?php echo $module; ?>" class="row owl-carousel">
	  <?php foreach ($special_products as $product){ ?>
	  <div class="product-layout item">
		<div class="product-thumb transition">
		  <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
		  <div class="caption">
			<h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
			<p><?php echo $product['description']; ?></p>
			<?php if ($product['rating']) { ?>
			<div class="rating">
			  <?php for ($i = 1; $i <= 5; $i++) { ?>
			  <?php if ($product['rating'] < $i) { ?>
			  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } else { ?>
			  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } ?>
			  <?php } ?>
			</div>
			<?php } ?>
			<?php if ($product['price']) { ?>
			<p class="price">
			  <?php if (!$product['special']) { ?>
			  <?php echo $product['price']; ?>
			  <?php } else { ?>
			  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
			  <?php } ?>
			  <?php if ($product['tax']) { ?>
			  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
			  <?php } ?>
			</p>
			<?php } ?>
		  </div>
		  <div class="button-group">
			<button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
			<button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
			<button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
		  </div>
		</div>
	  </div>
	  <?php } ?>
	</div>
	</div>
	<div class="tab-pane <?php echo ($bestseller_active ? 'active' : ''); ?>" id="tab-bestsellers">
	  <div id="bestsellers<?php echo $module; ?>" class="row owl-carousel">
	  <?php foreach ($bestseller_products as $product){ ?>
	   <div class="product-layout item">
		<div class="product-thumb transition">
		  <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
		  <div class="caption">
			<h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
			<p><?php echo $product['description']; ?></p>
			<?php if ($product['rating']) { ?>
			<div class="rating">
			  <?php for ($i = 1; $i <= 5; $i++) { ?>
			  <?php if ($product['rating'] < $i) { ?>
			  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } else { ?>
			  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } ?>
			  <?php } ?>
			</div>
			<?php } ?>
			<?php if ($product['price']) { ?>
			<p class="price">
			  <?php if (!$product['special']) { ?>
			  <?php echo $product['price']; ?>
			  <?php } else { ?>
			  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
			  <?php } ?>
			  <?php if ($product['tax']) { ?>
			  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
			  <?php } ?>
			</p>
			<?php } ?>
		  </div>
		  <div class="button-group">
			<button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
			<button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
			<button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
		  </div>
		</div>
	  </div>
	  <?php } ?>
	</div>
	</div>
   </div>
</div>
<script type="text/javascript"><!--
$('#featured<?php echo $module; ?>').owlCarousel({
	items: 4,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: false
});
$('#lastest<?php echo $module; ?>').owlCarousel({
	items: 4,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: false
});
$('#specials<?php echo $module; ?>').owlCarousel({
	items: 4,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: false
});
$('#bestsellers<?php echo $module; ?>').owlCarousel({
	items: 4,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: false
});
--></script>