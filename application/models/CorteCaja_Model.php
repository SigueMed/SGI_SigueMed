<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CorteCaja_Model
 *
 * @author SigueMED
 */
class CorteCaja_Model extends CI_Model {

    private $table;
public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->table="cortecaja";

}

public function CrearCorteCaja($NuevoCorte_Array)
{
    $this->db->insert($this->table,$NuevoCorte_Array);

    return $this->db->insert_id();

}

public function ConsultarCortesCaja($IdCuenta,$FechaInicial = FALSE, $FechaFinal=FALSE)
{

  $this->db->select($this->table.'.*, e.NombreEmpleado, e.ApellidosEmpleado');
  $this->db->select('DescripcionCuenta');
  $this->db->select('DescripcionTurno');
  $this->db->from($this->table);
  $this->db->join('empleado e',$this->table.'.IdEmpleado= e.IdEmpleado');
  $this->db->join('cuenta c', $this->table.'.IdCuenta = c.IdCuenta');
  $this->db->join('catalogoturno ct',$this->table.'.IdTurno = ct.IdTurno');

  $this->db->where('IdClinica',$this->session->userdata('IdClinica'));

  if ($IdCuenta !== FALSE && $IdCuenta !="")
  {
    $this->db->where($this->table.'.IdCuenta',$IdCuenta);
  }

  if($FechaInicial !== FALSE && $FechaInicial !== "")
  {
    if($FechaFinal!== FALSE && $FechaFinal !== "")
    {
        $this->db->where('FechaCorte >=', $FechaInicial);
        $this->db->where('FechaCorte <=',$FechaFinal);
    }
    else {
      $this->db->where('FechaCorte',$FechaInicial);
    }
  }
  $query = $this->db->get();

  return $query->result_array();

  // code...
}

public function ConsultarCorteCajaPorId($IdCorteCaja)
{
  $this->db->select($this->table.'.*');
  $this->db->select('CONCAT(NombreEmpleado," ",ApellidosEmpleado) as Responsable');
  $this->db->select('DescripcionTurno');
  $this->db->from($this->table);
  $this->db->join('empleado e',$this->table.'.IdEmpleado = e.IdEmpleado');
  $this->db->join('catalogoturno ct',$this->table.'.IdTurno = ct.IdTurno');
  $this->db->join('cuenta c',$this->table.'.IdCuenta = c.IdCuenta');
  $this->db->where('IdCorteCaja',$IdCorteCaja);

  $query = $this->db->get();
  return $query->row();
  // code...
}
//put your code here
}
