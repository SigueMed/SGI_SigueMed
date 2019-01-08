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
    
    public function ConsultarServicios()    
    {
         $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('Habilitado', TRUE);
        
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
    //put your code here

    //AUTOR 'Carlos Esquivel' -- muestra los servicios en el dropdown
    public function getServiciosAgenda(){
        $this->db->from($this->table);
        $this->db->where('ManejoAgenda', TRUE);
        $this->db->where('Habilitado', TRUE);
        $query = $this->db->get();
        return $query->result();
    }
}
