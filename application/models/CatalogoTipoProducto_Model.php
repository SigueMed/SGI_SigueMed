<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CatalogoTipoProducto_Model extends CI_Model{
  private $table;
  public function __construct()
  {
    parent::__construct();
    $this->table = "catalogotipoproducto";
    //Codeigniter : Write Less Do More
  }

  public function ConsultarCatalogoTipoProducto()
  {
    $this->db->select($this->table.'.*');
    $this->db->from($this->table);

    $query = $this->db->get();

    return $query->result_array();
    // code...
  }

}
