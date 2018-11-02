<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturacion extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Facturacion_m', 'fm');
    }

    function facturar($total) {
    	if ($total>0) {
    		  $this->fm->facturar(rand(1, 9999), $total);
              redirect(base_url('inventario/sold'),'refresh');
    	} else {
    		echo '<script type="text/javascript">alert("Debe tener productos en caja para poder facturar");</script>';
    		  redirect(base_url('inventario/sold'),'refresh');
    	}
    	
    }
}
