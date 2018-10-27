<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('inventario_m', 'im');
		$this->load->model('suplidores_m', 'sm');
	}

	public function add() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}
		
		$data = [
			'suplidores' => $this->sm->getSuppliers()
		];
		$this->load->view('inventario/add', $data);	
	}

	public function view() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}
		
		$data = [
			'articulos' => $this->im->getStock()
		];
		$this->load->view('inventario/view', $data);
	}

	public function view_all() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}
		
		$data = [
			'articulos' => $this->im->getStock()
		];
		$this->load->view('inventario/view', $data);
	}

	public function purchased() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}

		$data = [
			'articulos_comprados' => $this->im->getPurchased()
		];
		$this->load->view('inventario/purchased', $data);
	}

	public function sold() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}

		$data = [
			'articulos_vendidos' => $this->im->getSold()
		];
		$this->load->view('inventario/sold', $data);
	}

	public function save() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}
		
		$id = $this->input->post('id');

		$this->im->save($id);
		redirect(base_url('inventario/view'),'refresh');
	}

	public function edit($id) {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}
		
		$data = [
			'articulo' => $this->im->getById($id),
			'suplidores' => $this->sm->getSuppliers()
		];
		$this->load->view('inventario/edit', $data);
	}

    public function pagar($id) {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}
				
			$this->im->pay($id);
		    redirect(base_url('inventario/sold'),'refresh');
	}

	public function sell() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}

		$id = $this->input->post('sell_id');

		$storedId = $this->im->sell($id);
		echo JSON_encode($this->im->getById($storedId));
		// redirect(base_url('inventario/view'),'refresh');
	}
}