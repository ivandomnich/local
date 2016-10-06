<?php 
class ControllerProductLatest extends Controller {  
	private $error = array(); 
	public function index() { 
	
	$this->language->load('product/latest');

	$this->load->model('catalog/product');
	$this->load->model('catalog/latest');

	$this->load->model('tool/image');
	
	if (isset($this->request->get['filter'])) {
		$filter = $this->request->get['filter'];
	} else {
		$filter = '';
	}
			
	if (isset($this->request->get['sort'])) {
		$sort = $this->request->get['sort'];
	} else {
		$sort = 'p.sort_order';
	}

	if (isset($this->request->get['order'])) {
		$order = $this->request->get['order'];
	} else {
		$order = 'ASC';
	}
	
	if (isset($this->request->get['page'])) {
		$page = $this->request->get['page'];
	} else { 
		$page = 1;
	}	
						
	if (isset($this->request->get['limit'])) {
		$limit = $this->request->get['limit'];
	} else {
		$limit = $this->config->get('config_catalog_limit');
	}

	$this->data['breadcrumbs'] = array();

	$this->data['breadcrumbs'][] = array(
		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home'),
		'separator' => false
	);	
	$this->data['breadcrumbs'][] = array(
		'text'      => $this->language->get('text_breadcrumb'),
		'href'      => $this->url->link('common/home'),
		'separator' => $this->language->get('text_separator')
	);	
	$url = '';
	if (isset($this->request->get['path'])) {   if (isset($this->request->get['sort'])) { $url .= '&sort=' . $this->request->get['sort']; }  if (isset($this->request->get['order'])) { $url .= '&order=' . $this->request->get['order']; }  if (isset($this->request->get['limit'])) { $url .= '&limit=' . $this->request->get['limit']; }  $path = '';  $parts = explode('_', (string)$this->request->get['path']);  $category_id = (int)array_pop($parts);  foreach ($parts as $path_id) { if (!$path) { $path = (int)$path_id; } else { $path .= '_' . (int)$path_id; }  $category_info = $this->model_catalog_category->getCategory($path_id);  if ($category_info) { $this->data['breadcrumbs'][] = array( 'text'      => $category_info['name'], 'href'      => $this->url->link('product/category', 'path=' . $path . $url), 'separator' => $this->language->get('text_separator') ); } } } else { $category_id = 0; }
	$this->document->setTitle = $this->language->get('text_title'); $this->document->setKeywords = $this->language->get('text_keywords'); $this->document->setDescription = $this->language->get('text_description'); $this->data['heading_title'] = $this->language->get('text_product'); $this->data['text_sort'] = $this->language->get('text_sort'); $this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');  $this->data['text_refine'] = $this->language->get('text_refine'); $this->data['text_empty'] = $this->language->get('text_empty'); $this->data['text_quantity'] = $this->language->get('text_quantity'); $this->data['text_manufacturer'] = $this->language->get('text_manufacturer'); $this->data['text_model'] = $this->language->get('text_model'); $this->data['text_price'] = $this->language->get('text_price'); $this->data['text_tax'] = $this->language->get('text_tax'); $this->data['text_points'] = $this->language->get('text_points'); $this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0)); $this->data['text_display'] = $this->language->get('text_display'); $this->data['text_list'] = $this->language->get('text_list'); $this->data['text_grid'] = $this->language->get('text_grid'); $this->data['text_sort'] = $this->language->get('text_sort'); $this->data['text_limit'] = $this->language->get('text_limit');  $this->data['button_cart'] = $this->language->get('button_cart'); $this->data['button_wishlist'] = $this->language->get('button_wishlist'); $this->data['button_compare'] = $this->language->get('button_compare'); $this->data['button_continue'] = $this->language->get('button_continue');   $this->data['compare'] = $this->url->link('product/compare'); 
		
	$this->data['limits'] = array();
	$limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));
	sort($limits);
	foreach($limits as $limits){
	$this->data['limits'][] = array(
		'text'  => $limits,
		'value' => $limits,
		'href'  => $this->url->link('product/latest', $url . '&limit=' . $limits)
	);
	}
	$this->data['limit'] = $limit;
	$product_total = $this->model_catalog_product->getTotalProducts(); // suiz
		
		if ($product_total) {
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}				

			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'p.sort_order';
			}

			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'ASC';
			}
			
			$this->load->model('catalog/review');
				
			$this->data['button_add_to_cart'] = $this->language->get('button_add_to_cart');
				
			$this->data['products'] = array();
        		
			$results = $this->model_catalog_latest->getLatestProducts(($page - 1) * $limit, $limit);
			
			foreach ($results as $result) {
					if ($result['image']) {
						$image = $result['image'];
					} else {
						$image = 'no_image.jpg';
					}
						
					if ($this->config->get('config_review')) {
						$rating = $this->model_catalog_review->getAverageRating($result['product_id']);	
					} else {
						$rating = false;
					}
						
					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}
					if(!isset($result['special'])){
					$result['special'] = false;
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
										
				$add = HTTPS_SERVER . 'index.php?route=checkout/cart&product_id=' . $result['product_id'];
				
				$this->data['products'][] = array(
						'product_id'  => $result['product_id'],
						'name'    => $result['name'],
						'model'   => $result['model'],
						'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
						'rating'  => $rating,
						'stars'   => sprintf($this->language->get('text_stars'), $rating),            			
						'thumb'   => $this->model_tool_image->resize($image, $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height')),
						'tax'         => $tax,
						'price'   => $price,
						'special' => $special,
						'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
						'add'	  => $add
				);
				
			}
				
			if (!$this->config->get('config_customer_price')) {
				$this->data['display_price'] = TRUE;
			} elseif ($this->customer->isLogged()) {
				$this->data['display_price'] = TRUE;
			} else {
				$this->data['display_price'] = FALSE;
			}

		$url = '';
				if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}
			
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}
												
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
				
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
				
			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('product/latest', $url . '&page={page}');
			$this->data['pagination'] = $pagination->render();

			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
				
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/latest.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/latest.tpl';
			} else {
				$this->template = 'default/template/product/latest.tpl';
			}	
				
			$this->children = array(
				'common/column_right',
				'common/column_left',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);		
				
			$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));										
      } else {
      	$this->document->setTitle = "Latest";

       	$this->data['heading_title'] = "Latest";

        	$this->data['text_error'] = $this->language->get('text_empty');

        	$this->data['button_continue'] = $this->language->get('button_continue');

        	$this->data['continue'] = HTTP_SERVER . 'index.php?route=common/home';
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}
				
			$this->children = array(
				'common/column_right',
				'common/column_left',
				'common/content_top',
				'common/footer',
				'common/header'
			);		
				
			$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));					
      }

  	}
}
?>