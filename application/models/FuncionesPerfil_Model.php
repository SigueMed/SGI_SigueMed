<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FuncionesPerfil_Model
 *
 * @author SigueMed
 */
class FuncionesPerfil_Model extends CI_Model {
    
    private $table;
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table ="FuncionesPerfil";
    }
    
    public function ConsultarFuncionesPorPerfil($IdPerfil)
    {
        $condition = "IdPerfil =".$IdPerfil;
        $this->db->select($this->table.'.*, Menu.IdMenu, DescripcionMenu, IdMenuPadre, UrlMenu');
        $this->db->from($this->table.',Menu');
        //JOIN
        $this->db->where ($this->table.'.IdMenu = Menu.IdMenu');
        $this->db->order_by('IdMenuPadre', 'ASC');
        
        //CONDITION
        $this->db->where($condition);
        
        $query = $this->db->get();

        if ($query->num_rows() >= 1) 
        {
            return $query->result_array();
        } 
        else 
        {
            return false;
        }
        
    }
}
