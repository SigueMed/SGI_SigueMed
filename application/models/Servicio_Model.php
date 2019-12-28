<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicio_Model
 *
 * @author SigueMed
 */
class Servicio_Model extends CI_Model {

    private $table;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = "servicio";

    }
    public function ConsultarServiciosPorGrupo($IdGrupo = FALSE)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('Habilitado',TRUE);

        if($IdGrupo!== FALSE)
        {
            $this->db->where('IdGrupoServicio',$IdGrupo);
        }


        $query = $this->db->get();

        return $query->result_array();

    }
    public function ConsultarServicios($Inventario = FALSE)
    {
         $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('Habilitado', TRUE);

        if ($Inventario)
        {
            $this->db->where('ManejoInventario', TRUE);
        }

        $query = $this->db->get();

        return $query->result_array();

    }

    public function ConsultarServiciosProveedores()
    {
      $this->db->select($this->table.'.*');
      $this->db->from($this->table);
       $this->db->where('Habilitado', TRUE);
       $this->db->where('Proveedor',TRUE);

       $query = $this->db->get();

       return $query->result_array();
    }

    public function ConsultarServicioPorId($IdServicio)
    {
        $this->db->select($this->table.'.*');
        $this->db->from ($this->table);
        $this->db->where('IdServicio', $IdServicio);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows()>0)
        {
            return $query->row();

        }
        return false;
    }
    //put your code here

    //AUTOR 'Carlos Esquivel' -- muestra los servicios en el dropdown
    public function getServiciosAgenda($IdClinica=FALSE, $IdServicio = FALSE){
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('ManejoAgenda', TRUE);
        $this->db->where('Habilitado', TRUE);
        if($IdClinica !== FALSE)
        {
            $this->db->join('servicioclinica',$this->table.'.IdServicio = servicioclinica.IdServicio');
            $this->db->where('IdClinica', $IdClinica);
        }

        if($IdServicio !== FALSE)
        {
            $this->db->where($this->table.'.IdServicio', $IdServicio);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function ConsultarServiciosPorFoliador($IdFoliador,$Inventario = FALSE)
    {
      $this->db->select($this->table.'.*');
      $this->db->from($this->table);
      $this->db->join('folioservicio f',$this->table.'.IdServicio = f.IdServicio and f.IdClinica = '.$this->session->userdata('IdClinica'));
      $this->db->where('IdFoliador',$IdFoliador);

      $this->db->where('ManejoInventario',$Inventario);


      $query = $this->db->get();

      return $query->result_array();
      // code...
    }




}
