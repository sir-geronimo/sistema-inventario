<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suplidores extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Suplidores_m', 'sm');
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
			'suplidores' => $this->sm->getSuppliers()
		];

		$this->load->view('suplidores/suppliers', $data);
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
			'suplidores' => $this->sm->getAll()
		];

		$this->load->view('suplidores/view_all', $data);
	}

	public function add() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}

		$this->load->view('suplidores/add');
	}

	public function edit($id) {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}

		if(!isset($id)) {
			$this->session->set_flashdata('invalid_supplier_id', 'ID de Usuario invalido');
			redirect(base_url('suplidores/view'),'refresh');
		} else {
			$data = [
				'suplidor' => $this->sm->getById($id)
			];

			$this->load->view('suplidores/edit', $data);
		}
	}
	
	public function save() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}

		$headers = $this->input->request_headers(true);
		
		$id = $this->input->post('id');

		$storedId = $this->sm->save($id);
		
		if (isset($headers['X-Requested-With']) && $headers['X-Requested-With'] === 'XMLHttpRequest') {
			echo json_encode($this->sm->getById($storedId));
		} else {
			redirect(base_url('suplidores/view'),'refresh');
		}
	}

	public function delete($id) {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}
		
		$this->sm->delete($id);
		redirect(base_url('suplidores/view'),'refresh');
	}

	public function reactivate($id) {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}
		
		$this->sm->reactivate($id);
		redirect(base_url('suplidores/view'),'refresh');
	}

}

/* End of file suplidores.php */
/* Location: ./application/controllers/suplidores.php */