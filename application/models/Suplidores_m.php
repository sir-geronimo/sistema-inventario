<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suplidores_m extends CI_Model {

	public function getSuppliers() {
		$this->db->select('suplidores.*');
		$this->db->where('active', '1');
		$this->db->from('suplidores');
		$sql = $this->db->get();

		return $sql->result();
	}

	public function getAll() {
		$this->db->select('suplidores.*');
		$this->db->from('suplidores');
		$sql = $this->db->get();

		return $sql->result();
	}

	public function save($id) {
		if(is_null($id)) {
			// insert supplier
			$data = [
				'nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido'),
				'direccion' => $this->input->post('direccion')
			];
			$this->db->set($data);
			$this->db->insert('suplidores');
			$id = $this->db->insert_id();

			return $id;

		} else {
			// update supplier
			$data = [
				'id' => $id,
				'nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido'),
				'direccion' => $this->input->post('direccion')
			];
			$this->db->set($data);
			$this->db->where('id', $id);
			$this->db->limit(1);
			$this->db->update('suplidores');

			if($this->db->affected_rows() > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	public function getById($id) {
		$this->db->select('suplidores.*');
		$this->db->where('id', $id);
		$sql = $this->db->get('suplidores', 1);

		return $sql->row(0);
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->set('active', '0');
		$this->db->update('suplidores');

		if($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function reactivate($id) {
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->set('active', '1');
		$this->db->update('suplidores');

		if($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file suplidores_m.php */
/* Location: ./application/models/suplidores_m.php */