<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cuenta_Model
 *
 * @author SigueMED
 */
class Cuenta_Model extends CI_Model{
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table = 'cuenta';

        $this->load->database();
    }

    public function ConsultarCuentasPorProducto($IdProducto)
    {
        $this->db->select($this->table.'.*, PorcentajeCuenta');
        $this->db->from($this->table);
        $this->db->join('cuentaproducto',$this->table.'.IdCuenta=cuentaproducto.IdCuenta');
        $this->db->where('cuentaproducto.IdProducto',$IdProducto);
        $this->db->where('Habilitado','1');
        $this->db->where('CuentaBase','0');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function ConsultarCuentas($CuentasCorte = FALSE)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);

        if ($CuentasCorte !== FALSE && $CuentasCorte ==1)
        {
          $this->db->where('CorteCaja',TRUE);
        }
        elseif ($CuentasCorte !== FALSE && $CuentasCorte ==0) {
          $this->db->where('CorteCaja',FALSE);
        }


        $this->db->where('Habilitado',true);
        $query = $this->db->get();

        return $query->result_array();
    }



    public function ConsultarCuentaPorId($IdCuenta)
    {
        $this->db->select($this->table.'.*,IdCuenta, CONCAT(NombreEmpleado," ",ApellidosEmpleado) as PropietarioCuenta, DescripcionServicio');
        $this->db->from($this->table);
        $this->db->join('empleado',$this->table.'.IdEmpleado = empleado.IdEmpleado');
        $this->db->join('servicio','empleado.IdServicio = servicio.IdServicio','left');
        $this->db->where('IdCuenta', $IdCuenta);
        //$this->db->where($this->table.'.Habilitado',true);
        $query = $this->db->get();

        return $query->row();

    }



    public function ConsultarCuentaMaestra()
    {

      $this->db->select($this->table.'.*');
      $this->db->from($this->table);


      $this->db->where('CuentaMaestra', true);

      $query = $this->db->get();

      return $query->row();
      // code...
    }


    //Brandon 20/mayo/2021

    public function ConsultarTodasCuentas()
  {
    $this->db->select($this->table.'.*, e.NombreEmpleado, e.ApellidosEmpleado');
    $this->db->from($this->table);
    $this->db->join('empleado e', $this->table.'.IdEmpleado = e.IdEmpleado');
    //$this->db->join('servicio s', 's.IdServicio = '.$this->table.'.IdServicio','left');

    $query = $this->db->get();
    return $query->result_array();
  }





    public function AgregarNuevaCuenta($NuevaCuenta)
    {
      $this->db->select('DescripcionCuenta');
      $this->db->from($this->table);
      $this->db->where('DescripcionCuenta',$NuevaCuenta['DescripcionCuenta']);
      $query = $this->db->get();

      if ($query->num_rows()<=0)
      {
          $this->db->reset_query();
        $this->db->insert($this->table,$NuevaCuenta);

        $IdNuevaCuenta =  $this->db->insert_id();

        $this->db->reset_query();

        return $IdNuevaCuenta;
      }
      else {
        return false;
      }
    }

    public function EditarCuenta($IdCuenta,$ActualizarEmpleado)
    {
      $this->db->where('IdCuenta', $IdCuenta);
      return $this->db->update($this->table, $ActualizarEmpleado);
      

      // code...
    }

    public function ConsultarDatosId($IdCuenta)
    {
      $this->db->select($this->table.'.*, e.NombreEmpleado, e.ApellidosEmpleado');
      $this->db->from($this->table);
        $this->db->where('IdCuenta',$IdCuenta['IdCuenta']);
      $this->db->join('empleado e', $this->table.'.IdEmpleado = e.IdEmpleado');
      //$this->db->join('servicio s', 's.IdServicio = '.$this->table.'.IdServicio','left');

      $query = $this->db->get();
      return $query->result_array();

    }



    //put your code here
}
