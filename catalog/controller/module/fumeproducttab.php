<?php
class ControllerModuleFumeproducttab extends Controller {
	public function index($setting) {
		static $module = 0;
		$this->load->language('module/fumeproducttab');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		
		$data['tab_featured'] = $this->language->get('tab_featured');
		$data['tab_lastest'] = $this->language->get('tab_lastest');
		$data['tab_specials'] = $this->language->get('tab_specials');
		$data['tab_bestsellers'] = $this->language->get('tab_bestsellers');
		
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
		
		
		$this->load->model('catalog/product');

		$this->load->model('tool/image');
		
		//Featured Start Coding
		
		$data['featured_products'] = array();
		
		$data['featured_permision'] = false;
		if($setting['featured_status']){
			$data['featured_permision'] = $setting['featured_status'];
		}

		if(!$setting['featured_limit']){
			$setting['featured_limit'] = 4;
		}

		if ($setting['featured_status']) {
		 if (!empty($setting['featured_product'])) {
			$products = array_slice($setting['featured_product'], 0, (int)$setting['featured_limit']);

			foreach ($products as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info) {
					if ($product_info['image']) {
						$image = $this->model_tool_image->resize($product_info['image'], $setting['featured_width'], $setting['featured_height']);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $setting['featured_width'], $setting['featured_height']);
					}

					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}

					if ((float)$product_info['special']) {
						$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}

					if ($this->config->get('config_tax')) {
						$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
					} else {
						$tax = false;
					}

					if ($this->config->get('config_review_status')) {
						$rating = $product_info['rating'];
					} else {
						$rating = false;
					}

					$data['featured_products'][] = array(
						'product_id'  => $product_info['product_id'],
						'thumb'       => $image,
						'name'        => $product_info['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
						'price'       => $price,
						'special'     => $special,
						'tax'         => $tax,
						'rating'      => $rating,
						'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
					);
				}
			}
		  }
		}
		
		$data['emptyfeaturedtabpermsion'] = true;
		if(!$setting['emptytab'] && !$data['featured_products']){
		 $data['emptyfeaturedtabpermsion'] = false;
		}
		
		
		//Featured End Coding
		
		//Latest Start Coding
		$data['lastest_products'] = array();

		$filter_data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['lastest_limit']
		);
		
		$data['lastest_permision'] = false;
		if($setting['lastest_status']){
			$data['lastest_permision'] = $setting['lastest_status'];
		}
		
		$results = $this->model_catalog_product->getProducts($filter_data);
		if($setting['lastest_status']){
		  if($results){
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['lastest_width'], $setting['lastest_height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['lastest_width'], $setting['lastest_height']);
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
				
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}

				$data['lastest_products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}
		  }
		}
		
		$data['emptylastesttabpermsion'] = true;
		if(!$setting['emptytab'] && !$data['lastest_products']){
		 $data['emptylastesttabpermsion'] = false;
		}
		
		
		//Latest End Coding
		
		//special Start Coding
		$data['special_products'] = array();

		$filter_data = array(
			'sort'  => 'pd.name',
			'order' => 'ASC',
			'start' => 0,
			'limit' => $setting['special_limit']
		);

		$results = $this->model_catalog_product->getProductSpecials($filter_data);
		
		
		$data['special_permision'] = false;
		if($setting['special_status']){
			$data['special_permision'] = $setting['special_status'];
		}

		if($setting['special_status']){
		if($results){
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['special_width'], $setting['special_height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['special_width'], $setting['special_height']);
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}

				$data['special_products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}
		}
		}
		
		$data['emptyspecialtabpermsion'] = true;
		if(!$setting['emptytab'] && !$data['special_products']){
		 $data['emptyspecialtabpermsion'] = false;
		}
		
		
		//special End Coding
		
		//bestseller End Coding
		
		$data['bestseller_products'] = array();

		$results = $this->model_catalog_product->getBestSellerProducts($setting['bestseller_limit']);
		
		$data['bestseller_permision'] = false;
		if($setting['bestseller_status']){
			$data['bestseller_permision'] = $setting['bestseller_status'];
		}
		
		if($setting['bestseller_status']){
		if($results){
			foreach ($results as $result){
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['bestseller_width'], $setting['bestseller_height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['bestseller_width'], $setting['bestseller_height']);
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}

				$data['bestseller_products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}
		}
		}
		
		$data['emptybestsellertabpermsion'] = true;
		if(!$setting['emptytab'] && !$data['bestseller_products']){
		 $data['emptybestsellertabpermsion'] = false;
		}
		
		
		$data['featured_active'] = false;
		$data['lastest_active'] = false;
		$data['special_active'] = false;
		$data['bestseller_active'] = false;
		if($data['featured_permision'] && $data['emptybestsellertabpermsion']){
			$data['featured_active'] = true;
		}elseif($data['lastest_permision'] && $data['emptylastesttabpermsion']){
			$data['lastest_active'] = true;
		}elseif($data['special_permision'] && $data['emptyspecialtabpermsion']){
			$data['special_active'] = true;
		}elseif($data['bestseller_permision'] && $data['emptybestsellertabpermsion']){
			$data['bestseller_active'] = true;
		}
		
		$data['module'] = $module++;
		
		if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/fumeproducttab.tpl')){
			return $this->load->view($this->config->get('config_template') . '/template/module/fumeproducttab.tpl', $data);
		}else{
			return $this->load->view('default/template/module/fumeproducttab.tpl', $data);
		}
		
	}
}