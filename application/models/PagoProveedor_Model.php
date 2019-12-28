<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagoProveedor_Model extends CI_Model{
  private $table;
  public function __construct()
  {

    parent::__construct();
    $this->table = 'pagoproveedor';
    //Codeigniter : Write Less Do More
  }

  public function RegistrarPagoProveedor($NuevoPago_array)
  {
    $this->db->insert($this->table,$NuevoPago_array);

    return $this->db->insert_id();
    // code...
  }

}
