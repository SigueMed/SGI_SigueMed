<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empleado_Model
 *
 * @author SigueMED
 */
class Empleado_Model extends CI_Model {

    private $table;

    public function __construct() {
        parent::__construct();
        $this->table = "empleado";
        $this->load->database();


    }

    public function ValidarUsuarioContrasena($Usuario=FALSE, $Contrasena=FALSE)
    {

        $this->db->select($this->table.'.*, DescripcionPerfil, perfil.IdPerfil');
        $this->db->from($this->table.',perfil');
        $this->db->where ($this->table.'.IdPerfil = perfil.IdPerfil');
        $this->db->where ('usuario', $Usuario);
        $this->db->where ('password', $Contrasena);
        $this->db->where('usuario IS NOT NULL');
        $this->db->where('Habilitado',1);
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->row();
    }
    public function ConsultarMedicosPorServicio($IdServicio,$IdClinica = FALSE)
    {

        $this->db->select($this->table.'.*');
        $this->db->select('CONCAT(NombreEmpleado," ",ApellidosEmpleado) as Nombre');
        $this->db->from($this->table);
        $this->db->where('IdServicio', $IdServicio);
        $this->db->where('IdPerfil', MEDICO);
        $this->db->where('Habilitado',TRUE);
        if($IdClinica!== FALSE)
        {
            $this->db->join('empleadoclinica',$this->table.'.IdEmpleado=empleadoclinica.IdEmpleado');
            $this->db->where('IdClinica',$IdClinica);
        }

        $query = $this->db->get();

        return $query->result_array();

    }

    public function ConsultarEmpleadoPorId($IdEmpleado)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('IdEmpleado',$IdEmpleado);
        $query = $this->db->get();

        return $query->row();
    }


    public function ConsultarEmpleados()
    {
      //Carga a los empleados
      $this->db->select($this->table.'.*');
      $this->db->from($this->table);

      $query = $this->db->get();

      return $query->result_array();
      // code...
    }
    //put your code here
}
