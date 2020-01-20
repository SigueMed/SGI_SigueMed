<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_Model
 *
 * @author SigueMed
 */
class Usuario_Model extends CI_Model {
    private $table;

    public function __construct()
    {
        parent::__construct();
            $this->load->database();
            $this->table = "empleado";
    }

    public function ValidarUsuarioContrasena($Usuario=FALSE, $Contrasena=FALSE)
    {

        $this->db->select($this->table.'.*,NombreEmpleado, ApellidosEmpleado, DescripcionPerfil, Perfil.IdPerfil');
        $this->db->from($this->table.', Empleado, Perfil');
        $this->db->where ($this->table.'.IdEmpleado = empleado.IdEmpleado');
        $this->db->where ($this->table.'.IdPerfil = perfil.IdPerfil');
        $this->db->where ('usuario', $Usuario);
        $this->db->where ('contrasena', $Contrasena);
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->row();
    }

    public function AgregarNuevoUsuario($DatosUsuario,$ClinicasUsuario)
    {
      $this->db->select('NombreEmpleado, ApellidosEmpleado');
      $this->db->from($this->table);
      $this->db->where('usuario',$DatosUsuario['usuario']);
      $query = $this->db->get();

      if ($query->num_rows()<=0)
      {
        $this->db->reset_query();
        $this->db->insert($this->table,$DatosUsuario);

        $IdNuevoUsuario =  $this->db->insert_id();

        $this->db->reset_query();

        for ($i=0;$i<sizeof($ClinicasUsuario);$i++)
        {
          $empleadoClinica = array(
            'IdClinica'=>$ClinicasUsuario[$i],
            'IdEmpleado'=>$IdNuevoUsuario
          );
          $this->db->insert('empleadoclinica',$empleadoClinica);

          return $IdNuevoUsuario;

        }


      }
      else {
        return false;
      }

    }

}
