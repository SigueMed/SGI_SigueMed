<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foliador_Model extends CI_Model{
  private $table;
  public function __construct()
  {
    parent::__construct();
    $this->table = 'foliador';
    //Codeigniter : Write Less Do More
  }

  public function ConsultarFoliadoresClinica($IdClinica, $Inventario)
  {

    $this->db->select('DISTINCT ('.$this->table.'.IdFoliador), DescripcionFoliador');
    $this->db->from($this->table);
    $this->db->join('folioservicio',$this->table.'.IdFoliador = folioservicio.IdFoliador');
    $this->db->where('IdClinica',$IdClinica);
    $this->db->where('ManejoInventario',$Inventario);

    $query = $this->db->get();

    return $query->result_array();
    // code...
  }

  public function BuscarFoliadorServicio($IdClinica,$IdServicio)
  {
    $this->db->select('DISTINCT ('.$this->table.'.IdFoliador), DescripcionFoliador');
    $this->db->from($this->table);
    $this->db->join('folioservicio',$this->table.'.IdFoliador = folioservicio.IdFoliador');
    $this->db->where('IdClinica',$IdClinica);
    $this->db->where('IdServicio',$IdServicio);

    $query = $this->db->get();

    return $query->row();
    // code...
  }

  public function ObtenerFolioPorServicio($IdClinica,$IdServicio)
  {

    $this->db->select($this->table.'.ValorFolio');
    $this->db->from($this->table);
    $this->db->join('folioservicio f',$this->table.'.IdFoliador = f.IdFoliador');
    $this->db->where('f.IdServicio',$IdServicio);
    $this->dd->where('f.IdClinica',$IdClinica);

    $query = $this->db->get();
    $folio = $query->row()->ValorFolio;
    return $folio+1;
    // code...
  }

  public function ObtenerFolio($IdFoliador)
  {
    $this->db->select($this->table.'.ValorFolio');
    $this->db->from($this->table);
    $this->db->where('IdFoliador',$IdFoliador);

    $query = $this->db->get();
    $folio = $query->row();
    return $folio->ValorFolio+1;

    // code...
  }

  public function AplicarFolio($IdFoliador)
  {
    $NuevoFolio = $this->ObtenerFolio($IdFoliador);

    $this->db->set('ValorFolio',$NuevoFolio);
    $this->db->where('IdFoliador',$IdFoliador);
    return $this->db->update($this->table);
    // code...
  }

}
