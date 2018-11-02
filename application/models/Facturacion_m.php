<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturacion_m extends CI_Model {

	public function facturar($idFactura, $total)
	{
		
    //Marca los productos de la factura
		$this->db->set('id_factura', $idFactura, FALSE);
		$this->db->where('id_factura', 0);
		$this->db->where('pagado', 1);
		//$this->db->limit(1);
		$this->db->update('articulos_vendidos');

	//Registrar la factura
          $data = [
				'id' => $idFactura,
				'total' => $total,
			];
			    $this->db->set($data);
				$this->db->insert('facturas');
	}

	public function getFacturas()
	{
		$this->db->select('*');
		$this->db->from('facturas');
		$sql = $this->db->get()->result();

		return $sql;
	}
    
    public function getFactura($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('facturas');
		$sql = $this->db->get()->result();

		return $sql;
	}

	public function getArt($id) {
		$this->db->select('articulos_vendidos.*, articulos.nombre');
		$this->db->from('articulos_vendidos');
		$this->db->join('articulos', 'articulos_vendidos.id_articulo = articulos.id', 'left');
		$this->db->where('articulos_vendidos.id_factura', $id);
		$sql = $this->db->get()->result();

		return $sql;
	}
}
       