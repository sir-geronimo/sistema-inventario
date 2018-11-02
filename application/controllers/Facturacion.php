<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturacion extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Facturacion_m', 'fm');
    }

    function facturar($total) {
    	if ($total>0) {
    		$codigo = rand(1, 9999);
    		  $this->fm->facturar($codigo, $total);
              redirect(base_url('facturacion/verF/').$codigo,'refresh');
    	} else {
    		echo '<script type="text/javascript">alert("Debe tener productos en caja para poder facturar");</script>';
    		  redirect(base_url('inventario/sold'),'refresh');
    	}
    	
    }

    public function verF($id)
    {
    	$this->load->model('Facturacion_m', 'fm');
        $data = [
			'factura' => $this->fm->getFactura($id),
			'articulos_vendidos' => $this->fm->getArt($id)
		];
    	$this->load->view('inventario/factura', $data);
    }
}
