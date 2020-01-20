<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClinicaModel
 *
 * @author SigueMED
 */
class Clinica_Model extends CI_Model {
    private $table;
    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->table = "clinicas";
    }

    public function ConsultarClinicasEmpleado($IdEmpleado)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->join('empleadoclinica',$this->table.'.IdClinica=empleadoclinica.IdClinica');
        $this->db->where('IdEmpleado',$IdEmpleado);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function ConsultarClinicaPorId($IdClinica)
    {

        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('IdClinica',$IdClinica);

        $query = $this->db->get();

        return $query->row();
    }

    public function ConsultarClinicas()
    {
      $this->db->select($this->table.'.*');
      $this->db->from($this->table);

      $query = $this->db->get();
      return $query->result_array();
      // code...
    }
    //put your code here
}
