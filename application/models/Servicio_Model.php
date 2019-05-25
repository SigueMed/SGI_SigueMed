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
    public function getServiciosAgenda($IdClinica=FALSE){
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('ManejoAgenda', TRUE);
        $this->db->where('Habilitado', TRUE);
        if($IdClinica !== FALSE)
        {
            $this->db->join('servicioclinica',$this->table.'.IdServicio = servicioclinica.IdServicio');
            $this->db->where('IdClinica', $IdClinica);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    
    
  
}
