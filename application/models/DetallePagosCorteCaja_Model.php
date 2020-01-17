<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetallePagosCorteCaja_Model extends CI_Model{

  private $table;
  public function __construct()
  {

    parent::__construct();
    $this->table='detallepagoscortecaja';
    //Codeigniter : Write Less Do More
  }

  public function AgregarPagoCorteCaja($PagoCorte)
  {
    $this->db->insert($this->table,$PagoCorte);

    return $this->db->insert_id();

    // code...
  }

  public function ConsultarDetallesPagoCorte($IdCorteCaja)
  {
    $this->db->select($this->table.'.*');
    $this->db->select('DescripcionTipoPago');
    $this->db->from($this->table);
    $this->db->join('catalogotipopago ctp',$this->table.'.IdTipoPago = ctp.IdTipoPago');
    $this->db->where('IdCorteCaja',$IdCorteCaja);

    $query = $this->db->get();

    return $query->result_array();
    // code...
  }

}
