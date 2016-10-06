<?php
class ControllerModuleFumeproducttab extends Controller {
	private $error = array();

	public function index() {
		
		$this->load->language('module/fumeproducttab');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('fumeproducttab', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['tab_featured'] = $this->language->get('tab_featured');
		$data['tab_lastest'] = $this->language->get('tab_lastest');
		$data['tab_specials'] = $this->language->get('tab_specials');
		$data['tab_bestsellers'] = $this->language->get('tab_bestsellers');
		$data['tab_general'] = $this->language->get('tab_general');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_showempty'] = $this->language->get('entry_showempty');
		

		$data['help_product'] = $this->language->get('help_product');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		
		if(isset($this->error['warning'])){
			$data['error_warning'] = $this->error['warning'];
		}else{
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		//Featured 
		if (isset($this->error['featured_width'])) {
			$data['error_featured_width'] = $this->error['featured_width'];
		} else {
			$data['error_featured_width'] = '';
		}

		if (isset($this->error['featured_height'])) {
			$data['error_featured_height'] = $this->error['featured_height'];
		} else {
			$data['error_featured_height'] = '';
		}
		
		if (isset($this->error['lastest_width'])) {
			$data['error_lastest_width'] = $this->error['lastest_width'];
		} else {
			$data['error_lastest_width'] = '';
		}
		
		if (isset($this->error['lastest_height'])) {
			$data['error_lastest_height'] = $this->error['lastest_height'];
		} else {
			$data['error_lastest_height'] = '';
		}

		if (isset($this->error['special_height'])) {
			$data['error_special_height'] = $this->error['special_height'];
		} else {
			$data['error_special_height'] = '';
		}
		
		if (isset($this->error['special_width'])) {
			$data['error_special_width'] = $this->error['special_width'];
		} else {
			$data['error_special_width'] = '';
		}
		
		if (isset($this->error['bestseller_height'])) {
			$data['error_bestseller_height'] = $this->error['bestseller_height'];
		} else {
			$data['error_bestseller_height'] = '';
		}
		
		if (isset($this->error['bestseller_width'])) {
			$data['error_bestseller_width'] = $this->error['bestseller_width'];
		} else {
			$data['error_bestseller_width'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/fumeproducttab', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/fumeproducttab', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/fumeproducttab', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/fumeproducttab', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		
		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		if (isset($this->request->post['emptytab'])) {
			$data['emptytab'] = $this->request->post['emptytab'];
		} elseif (!empty($module_info)) {
			$data['emptytab'] = $module_info['emptytab'];
		} else {
			$data['emptytab'] = '';
		}

		$this->load->model('catalog/product');

		$data['products'] = array();

		if (isset($this->request->post['featured_product'])) {
			$products = $this->request->post['featured_product'];
		} elseif (!empty($module_info)) {
			$products = $module_info['featured_product'];
		} else {
			$products = array();
		}

		foreach($products as $product_id){
			$product_info = $this->model_catalog_product->getProduct($product_id);
			if($product_info){
				$data['products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		}

		if (isset($this->request->post['featured_limit'])) {
			$data['featured_limit'] = $this->request->post['featured_limit'];
		} elseif (!empty($module_info)) {
			$data['featured_limit'] = $module_info['featured_limit'];
		} else {
			$data['featured_limit'] = 5;
		}

		if (isset($this->request->post['featured_width'])) {
			$data['featured_width'] = $this->request->post['featured_width'];
		} elseif (!empty($module_info)) {
			$data['featured_width'] = $module_info['featured_width'];
		} else {
			$data['featured_width'] = 200;
		}

		if (isset($this->request->post['featured_height'])) {
			$data['featured_height'] = $this->request->post['featured_height'];
		} elseif (!empty($module_info)) {
			$data['featured_height'] = $module_info['featured_height'];
		} else {
			$data['featured_height'] = 200;
		}

		if (isset($this->request->post['featured_status'])) {
			$data['featured_status'] = $this->request->post['featured_status'];
		} elseif (!empty($module_info)) {
			$data['featured_status'] = $module_info['featured_status'];
		} else {
			$data['featured_status'] = '';
		}
		
		
		if (isset($this->request->post['lastest_limit'])) {
			$data['lastest_limit'] = $this->request->post['lastest_limit'];
		} elseif (!empty($module_info)) {
			$data['lastest_limit'] = $module_info['lastest_limit'];
		} else {
			$data['lastest_limit'] = 5;
		}

		if (isset($this->request->post['lastest_width'])) {
			$data['lastest_width'] = $this->request->post['lastest_width'];
		} elseif (!empty($module_info)) {
			$data['lastest_width'] = $module_info['lastest_width'];
		} else {
			$data['lastest_width'] = 200;
		}

		if (isset($this->request->post['lastest_height'])) {
			$data['lastest_height'] = $this->request->post['lastest_height'];
		} elseif (!empty($module_info)) {
			$data['lastest_height'] = $module_info['lastest_height'];
		} else {
			$data['lastest_height'] = 200;
		}

		if (isset($this->request->post['lastest_status'])) {
			$data['lastest_status'] = $this->request->post['lastest_status'];
		} elseif (!empty($module_info)) {
			$data['lastest_status'] = $module_info['lastest_status'];
		} else {
			$data['lastest_status'] = '';
		}
		
		if (isset($this->request->post['special_limit'])) {
			$data['special_limit'] = $this->request->post['special_limit'];
		} elseif (!empty($module_info)) {
			$data['special_limit'] = $module_info['special_limit'];
		} else {
			$data['special_limit'] = 5;
		}

		if (isset($this->request->post['special_width'])) {
			$data['special_width'] = $this->request->post['special_width'];
		} elseif (!empty($module_info)) {
			$data['special_width'] = $module_info['special_width'];
		} else {
			$data['special_width'] = 200;
		}

		if (isset($this->request->post['special_height'])) {
			$data['special_height'] = $this->request->post['special_height'];
		} elseif (!empty($module_info)) {
			$data['special_height'] = $module_info['special_height'];
		} else {
			$data['special_height'] = 200;
		}

		if (isset($this->request->post['special_status'])) {
			$data['special_status'] = $this->request->post['special_status'];
		} elseif (!empty($module_info)) {
			$data['special_status'] = $module_info['special_status'];
		} else {
			$data['special_status'] = '';
		}
		
		if (isset($this->request->post['bestseller_limit'])) {
			$data['bestseller_limit'] = $this->request->post['bestseller_limit'];
		} elseif (!empty($module_info)) {
			$data['bestseller_limit'] = $module_info['bestseller_limit'];
		} else {
			$data['bestseller_limit'] = 5;
		}

		if (isset($this->request->post['bestseller_width'])) {
			$data['bestseller_width'] = $this->request->post['bestseller_width'];
		} elseif (!empty($module_info)) {
			$data['bestseller_width'] = $module_info['bestseller_width'];
		} else {
			$data['bestseller_width'] = 200;
		}

		if (isset($this->request->post['bestseller_height'])) {
			$data['bestseller_height'] = $this->request->post['bestseller_height'];
		} elseif (!empty($module_info)) {
			$data['bestseller_height'] = $module_info['bestseller_height'];
		} else {
			$data['bestseller_height'] = 200;
		}

		if (isset($this->request->post['bestseller_status'])) {
			$data['bestseller_status'] = $this->request->post['bestseller_status'];
		} elseif (!empty($module_info)) {
			$data['bestseller_status'] = $module_info['bestseller_status'];
		} else {
			$data['bestseller_status'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/fumeproducttab.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/fumeproducttab')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!$this->request->post['featured_width']) {
			$this->error['featured_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['featured_height']) {
			$this->error['featured_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['lastest_width']) {
			$this->error['lastest_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['lastest_height']) {
			$this->error['lastest_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['special_width']) {
			$this->error['special_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['special_height']) {
			$this->error['special_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['bestseller_width']) {
			$this->error['bestseller_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['bestseller_height']) {
			$this->error['bestseller_height'] = $this->language->get('error_height');
		}

		return !$this->error;
	}
}