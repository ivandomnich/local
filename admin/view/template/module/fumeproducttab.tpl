<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-fumeproducttab" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
</div>
<div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-fumeproducttab" class="form-horizontal">
		  <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-featured" data-toggle="tab"><?php echo $tab_featured; ?></a></li>
            <li><a href="#tab-lastest" data-toggle="tab"><?php echo $tab_lastest; ?></a></li>
            <li><a href="#tab-specials" data-toggle="tab"><?php echo $tab_specials; ?></a></li>
            <li><a href="#tab-bestsellers" data-toggle="tab"><?php echo $tab_bestsellers; ?></a></li>
          </ul>
		  <div class="tab-content">
			<div class="tab-pane active" id="tab-general">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
					  <?php if ($error_name){ ?>
						<div class="text-danger"><?php echo $error_name; ?></div>
					  <?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="status" id="input-status" class="form-control">
						<?php if ($status) { ?>
						<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
						<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
						<?php } ?>
					  </select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_showempty; ?></label>
					 <div class="col-sm-10">
						 <select name="emptytab" id="input-status" class="form-control">
							<?php if ($emptytab) { ?>
							<option value="1" selected="selected"><?php echo $text_yes; ?></option>
							<option value="0"><?php echo $text_no; ?></option>
							<?php } else { ?>
							<option value="1"><?php echo $text_yes; ?></option>
							<option value="0" selected="selected"><?php echo $text_no; ?></option>
							<?php } ?>
					  </select>
					 </div>
				</div>
			</div>
			<div class="tab-pane" id="tab-featured">
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-product"><?php echo $entry_product; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="product" value="" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
				  <div id="fumeproducttab-product" class="well well-sm" style="height: 150px; overflow: auto;">
					<?php foreach ($products as $product) { ?>
					<div id="fumeproducttab-product<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
					  <input type="hidden" name="featured_product[]" value="<?php echo $product['product_id']; ?>" />
					</div>
					<?php } ?>
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="featured_limit" value="<?php echo $featured_limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="featured_width" value="<?php echo $featured_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
				  <?php if ($error_featured_width) { ?>
				  <div class="text-danger"><?php echo $error_featured_width; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="featured_height" value="<?php echo $featured_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
				  <?php if ($error_featured_height) { ?>
				  <div class="text-danger"><?php echo $error_featured_height; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
				<div class="col-sm-10">
				  <select name="featured_status" id="input-status" class="form-control">
					<?php if ($featured_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select>
				</div>
			  </div>
			</div>
			<div class="tab-pane" id="tab-lastest">
				 <div class="form-group">
					<label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="lastest_limit" value="<?php echo $lastest_limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
					</div>
				</div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="lastest_width" value="<?php echo $lastest_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
				  <?php if ($error_lastest_width) { ?>
				  <div class="text-danger"><?php echo $error_lastest_width; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="lastest_height" value="<?php echo $lastest_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
				  <?php if ($error_lastest_height) { ?>
				  <div class="text-danger"><?php echo $error_lastest_height; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
				<div class="col-sm-10">
				  <select name="lastest_status" id="input-status" class="form-control">
					<?php if ($lastest_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select>
				</div>
			  </div>
			</div>
			<div class="tab-pane" id="tab-specials">
				 <div class="form-group">
					<label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="special_limit" value="<?php echo $special_limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-special-limit" class="form-control" />
					</div>
				</div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="special_width" value="<?php echo $special_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-special-width" class="form-control" />
				  <?php if ($error_special_width) { ?>
				  <div class="text-danger"><?php echo $error_special_width; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="special_height" value="<?php echo $special_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
				  <?php if ($error_special_height) { ?>
				  <div class="text-danger"><?php echo $error_special_height; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
				<div class="col-sm-10">
				  <select name="special_status" id="input-status" class="form-control">
					<?php if ($special_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select>
				</div>
			  </div>
			</div>
			<div class="tab-pane" id="tab-bestsellers">
				 <div class="form-group">
					<label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="bestseller_limit" value="<?php echo $bestseller_limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-bestseller-limit" class="form-control" />
					</div>
				</div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="bestseller_width" value="<?php echo $bestseller_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-bestseller-width" class="form-control" />
				  <?php if ($error_bestseller_width) { ?>
				  <div class="text-danger"><?php echo $error_bestseller_width; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="bestseller_height" value="<?php echo $bestseller_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
				  <?php if ($error_bestseller_height) { ?>
				  <div class="text-danger"><?php echo $error_bestseller_height; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
				<div class="col-sm-10">
				  <select name="bestseller_status" id="input-status" class="form-control">
					<?php if ($bestseller_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select>
				</div>
			  </div>
			</div>
		  </div>
		</form>
      </div>
    </div>
</div>
<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	select: function(item) {
		$('input[name=\'product\']').val('');
		
		$('#fumeproducttab-product' + item['value']).remove();
		
		$('#fumeproducttab-product').append('<div id="fumeproducttab-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="featured_product[]" value="' + item['value'] + '" /></div>');	
	}
});
	
$('#fumeproducttab-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script></div>
<?php echo $footer; ?>