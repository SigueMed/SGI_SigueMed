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

public function ConsultarCortesCaja($IdCuenta,$FechaInicial, $FechaFinal)
{

  $this->db->select($this->table.'.*, e.NombreEmpleado, e.ApellidosEmpleado');
  $this->db->from($this->table);
  $this->db->join('empleado e',$this->table.'.IdEmpleado= e.IdEmpleado');
  if ($IdCuenta !== FALSE && $IdCuenta !="")
  {
    $this->db->where('IdCuenta',$IdCuenta);
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

  // code...
}
//put your code here
}
