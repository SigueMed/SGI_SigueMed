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

  public function ValidarHorarioCita($IdServicio,$DiaSemana,$Hora)
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('IdServicio',$IdServicio);
    $this->db->where('DiaSemana',$DiaSemana);
    $this->db->where('HoraInicio <=',$Hora);
    $this->db->where('HoraFin>=',$Hora);

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

}
