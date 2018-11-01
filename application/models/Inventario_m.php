<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_m extends CI_Model {

	public function getStock() {
		$this->db->select('articulos.*, suplidores.nombre as suplidor_nombre, suplidores.apellido as suplidor_apellido');
		$this->db->from('articulos');
		$this->db->join('suplidores', 'articulos.suplidor = suplidores.id', 'left');
		$sql = $this->db->get();

		return $sql->result();
	}

	public function getById($id) {
		$this->db->select('articulos.*, suplidores.nombre as suplidor_nombre, suplidores.apellido as suplidor_apellido, articulos_compra.id_articulo, articulos_compra.fecha_compra as fecha_compra, articulos_compra.suplidor');
		$this->db->join('suplidores', 'articulos.suplidor = suplidores.id', 'left');
		$this->db->join('articulos_compra', 'articulos.id = articulos_compra.id_articulo', 'left');
		$this->db->where('articulos.id', $id);
		$this->db->limit(1);
		$sql = $this->db->get('articulos');

		return $sql->row(0);
	}

	public function getPurchased() {
		$this->db->select('articulos_compra.*, articulos.nombre,  suplidores.nombre as suplidor_nombre, suplidores.apellido as suplidor_apellido');
		$this->db->from('articulos_compra');
		$this->db->join('articulos', 'articulos_compra.id_articulo = articulos.id', 'left');
		$this->db->join('suplidores', 'articulos_compra.suplidor = suplidores.id', 'left');
		$sql = $this->db->get();

		return $sql->result();
	}

	public function getSold() {
		$this->db->select('articulos_vendidos.*, articulos.nombre');
		$this->db->from('articulos_vendidos');
		$this->db->join('articulos', 'articulos_vendidos.id_articulo = articulos.id', 'left');
		$sql = $this->db->get();

		return $sql->result();
	}

	public function save($id) {
		if(is_null($id)) {
			// insert article
			$nombre = $this->input->post('nombre');
			$data_articulo = [
				'nombre' => $nombre,
				'num_serie' => $this->input->post('num_serie'),
				'precio_venta' => $this->input->post('precio_venta'),
				'cantidad' => $this->input->post('cantidad'),
				'estante' => $this->input->post('estante'),
				'suplidor' => $this->input->post('suplidor'),
			];

			$this->db->where('nombre', $nombre);
			$this->db->select('id, nombre');
			$this->db->from('articulos');
			$this->db->limit(1);
			$sql = $this->db->get();
			$item = $sql->row(0);

			if($item !== NULL) {
				$this->session->set_flashdata('item_error', 'Artículo ya existente');
				$this->session->set_flashdata('item_name', $data_articulo['nombre']);
				redirect(base_url('inventario/add'),'refresh');
			} else {
				$this->db->set($data_articulo);
				$this->db->insert('articulos');
				$id = $this->db->insert_id();

				$data_compra = [
					'id_articulo' => $id,
					'fecha_compra' => $this->input->post('fecha_compra'),
					'suplidor' => $this->input->post('suplidor')
				];

				$this->db->set($data_compra);
				$this->db->insert('articulos_compra');
			}


		} else {
			// update article
			$data = [
				'id' => $id,
				'nombre' => $this->input->post('nombre'),
				'num_serie' => $this->input->post('num_serie'),
				'precio_venta' => $this->input->post('precio_venta'),
				'cantidad' => $this->input->post('cantidad'),
				'estante' => $this->input->post('estante'),
				'suplidor' => $this->input->post('suplidor'),
			];
			$this->db->set($data);
			$this->db->where('id', $id);
			$this->db->limit(1);
			$this->db->update('articulos');

			$data_compra = [
				'id_articulo' => $id,
				'fecha_compra' => $this->input->post('fecha_compra'),
				'suplidor' => $this->input->post('suplidor')
			];

			$this->db->set($data_compra);
			$this->db->where('id_articulo', $id);
			$this->db->limit(1);
			$this->db->update('articulos_compra');
		}
	}

	public function sell($id) {
		$data = [
			'id_articulo' => $id,
			'fecha_venta' => date('Y-m-d'),
			'cantidad' => $this->input->post('cantidad_nueva')
		];

		$this->db->set('cantidad', 'cantidad-'.$data['cantidad'], FALSE);
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->update('articulos');

		$this->db->set($data);
		$this->db->insert('articulos_vendidos');

		return $id;
	}

	public function pay($id)
	{
		if ($id<>0) {
			$this->db->set('pagado', 1, FALSE);
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->update('articulos_vendidos');
		} else {

			$this->db->select('id');
	     	$this->db->from('articulos_vendidos');
	     	$this->db->where('pagado', 0);
		    $sql = $this->db->get()->result_array();

		      foreach ($sql as $value) {
		    		$this->db->set('pagado', 1, FALSE);
		            $this->db->where('id', $value['id']);
	            	$this->db->limit(1);
		            $this->db->update('articulos_vendidos');		    	
		      }

		}
		
	}
}