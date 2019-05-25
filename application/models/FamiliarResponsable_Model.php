<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FamiliarResponsable_Model
 *
 * @author SigueMED
 */
class FamiliarResponsable_Model extends CI_Model {
    
    private $table;
    
    public function __construct() {
        parent::__construct();
        $this->table="familiarresponsable";
        $this->load->database();
    }
    
    public function AgregarFamiliarResponsable($FamiliarResponsable)
    {
        return $this->db->insert($this->table,$FamiliarResponsable);
        
    }
    
    public function ConsultarFamiliaresPaciente($IdPaciente)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('IdPaciente',$IdPaciente);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function ConsultarFamiliarPorId($IdFamiliarResponsable)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('IdFamiliarResponsable',$IdFamiliarResponsable);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    public function ActualizarFamiliarResponsable($IdFamiliarResponsable, $FamiliarResponsable)
    {
        $this->db->where('IdFamiliarResponsable',$IdFamiliarResponsable);
        
        return $this->db->update($this->table,$FamiliarResponsable);
    }
    //put your code here
}
