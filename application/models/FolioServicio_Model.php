<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FolioServicio_Model extends CI_Model{
  private $table;
  public function __construct()
  {
    parent::__construct();
    $this->table = 'folioservicio';
  }


  ///ELIMINAR FOLIADOR
  ///15/06/2021 AUTOR:RICARDO
  public function EliminarFoliador($IdServicio,$IdClinica,$IdFoliador)
  {
    $this->db->where('IdServicio',$IdServicio);
    $this->db->where('IdClinica',$IdClinica);
    $this->db->where('IdFoliador',$IdFoliador);

    return $this->db->delete($this->table);
    // code...
  }
  
    ///AGREGAR FOLIADOR
    ///15/06/2021
  public function AgregarNuevoFoliador($DatosFolio)
  {
    $this->db->select('IdServicio');
    $this->db->from($this->table);
    $this->db->where('IdServicio' ,$DatosFolio['IdFoliador']);
    $query = $this->db->get();

    $this->db->insert($this->table,$DatosFolio);
    $IdNuevoFoliador =  $this->db->insert_id();    
    return $IdNuevoFoliador;

  }

  ///CONSULTAR FOLIADOR
  ///---15/06/2021
  public function ConsultarFoliadorPorId($IdServicio)
  {
    $this->db->select($this->table.'.*');
    $this->db->select('DescripcionFoliador');
    $this->db->select('NombreClinica');
    $this->db->from($this->table);
    $this->db->join('foliador f', $this->table.'.IdFoliador = f.IdFoliador');
    $this->db->join('clinicas c',$this->table.'.IdClinica = c.IdClinica');
    $this->db->where('IdServicio',$IdServicio);

    $query = $this->db->get();
    return $query->result_array();

    // code...
  }
}