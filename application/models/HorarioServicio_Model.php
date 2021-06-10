<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HorarioServicio_Model extends CI_Model{
  private $table;
  public function __construct()
  {
    parent::__construct();
    $this->table = "horarioservicio";
    //Codeigniter : Write Less Do More
  }

  public function ValidarHorarioCita($IdServicio,$IdClinica, $DiaSemana,$Hora)
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('IdServicio',$IdServicio);
    $this->db->where('DiaSemana',$DiaSemana);
    $this->db->where('HoraInicio <=',$Hora);
    $this->db->where('HoraFin>=',$Hora);
    $this->db->where('IdClinica',$IdClinica);


    $query = $this->db->get();

    if ($query->num_rows()>=1)
    {
      return true;
    }
    else {
      return false;
    }
    // code...
  }

  public function ConsultarHorarioServicioPorId($IdServicio)
  {
      $this->db->select($this->table.'.*, s.DescripcionServicio');
      $this->db->select('NombreClinica');
      $this->db->from ($this->table);
      $this->db->join("servicio s",$this->table.".IdServicio = s.IdServicio");
      $this->db->join('clinicas c',$this->table.'.IdClinica = c.IdClinica');
      $this->db->where('s.IdServicio',$IdServicio);

      $query = $this->db->get();    
      return $query->result_array();

  }

  public function ConsultarHorarioServicios()
  {
       $this->db->select($this->table.'.*');
       $this->db->select("s.*");
       $this->db->from($this->table);
       $this->db->join("servicio s",$this->table.".IdServicio = s.IdServicio");

      $query = $this->db->get();
      return $query->result_array();

  }

  public function CatalogoHorarioServicio($IdServicio)
  {
    $this->db->select('s.*, IdServicio, DescripcionServicio');
    $this->db->from('clinicas c');
    $this->db->join('servicio s', 's.IdClinica = c.IdClinica and s.IdServicio ='.$IdServicio,'left');
    

    $query = $this->db->get();
    return $query->result_array();
  }


  //---07/06/2021
  //AUTOR: RICARDO
  public function EliminarHorario($IdServicio)
  {
    $this->db->where('IdHorarioServicio',$IdServicio);
    return $this->db->delete($this->table);
    // code...
  }

  public function AgregarNuevoHorario($DatosHorario)
  {
    $this->db->select('IdHorarioServicio');
    $this->db->from($this->table);
    $this->db->where('IdHorarioServicio' ,$DatosHorario['IdHorarioServicio']);
    $query = $this->db->get();

    if ($query->num_rows()<=0)
    {
      $this->db->reset_query();
      $this->db->insert($this->table,$DatosHorario);

      $IdNuevoHorario =  $this->db->insert_id();

      $this->db->reset_query();
      return $IdNuevoServicio;

    }
    else {
      return false;
    }

  }
  
}