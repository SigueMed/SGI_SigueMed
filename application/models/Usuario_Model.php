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



        }

        return $IdNuevoUsuario;


      }
      else {
        return false;
      }

    }
    public function ConsultarUsuarios()
    {
        $this->db->select($this->table.'.*, p.DescripcionPerfil, s.DescripcionServicio');
        $this->db->from($this->table);
        $this->db->join('perfil p', $this->table.'.IdPerfil = p.IdPerfil');
        $this->db->join('servicio s', 's.IdServicio = '.$this->table.'.IdServicio','left');

        $query = $this->db->get();
        return $query->result_array();

    }

    public function ConsultarClinicasUsuario($IdEmpleado)
    {
      $this->db->select('*');
      $this->db->from('clinicas c');
      $this->db->join('empleadoclinica ec', 'ec.IdClinica = c.IdClinica');
      $this->db->where('ec.IdEmpleado', $IdEmpleado);

      $query = $this->db->get();
      return $query->result_array();

      // code...
    }

    public function CatalogoClinicasUsuario($IdEmpleado)
    {
      $this->db->select('c.*, IdEmpleado');
      $this->db->from('clinicas c');
      $this->db->join('empleadoclinica ec', 'ec.IdClinica = c.IdClinica and ec.IdEmpleado ='.$IdEmpleado,'left');


      $query = $this->db->get();
      return $query->result_array();
    }



    public function ConsultarUsuarioPorId($IdEmpleado)
    {
      $this->db->select($this->table.'.*, p.DescripcionPerfil');
      $this->db->from($this->table);
      $this->db->join('perfil p', $this->table.'.IdPerfil = p.IdPerfil');
      $this->db->where('IdEmpleado', $IdEmpleado);

      $query = $this->db->get();
      return $query->row();

      // code...
    }

    public function EditarUsuario($IdEmpleado,$ActualizarEmpleado)
    {
      $this->db->where('IdEmpleado', $IdEmpleado);
      return $this->db->update($this->table, $ActualizarEmpleado);

      // code...
    }

    public function ActualizarClinicasUsuario($IdEmpleado,$ClinicasUsuario)
    {
      $this->db->where('IdEmpleado', $IdEmpleado);
      $this->db->delete('empleadoclinica');

      $this->db->reset_query();

      for ($i=0;$i<sizeof($ClinicasUsuario);$i++)
      {
        $empleadoClinica = array(
          'IdClinica'=>$ClinicasUsuario[$i],
          'IdEmpleado'=>$IdEmpleado
        );
        $this->db->insert('empleadoclinica',$empleadoClinica);

      }
      return 1;



      // code...
    }

}
