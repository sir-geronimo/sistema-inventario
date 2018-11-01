<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturacion extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Facturacion_m', 'fm');
    }

    function index() {
        
    }
}
