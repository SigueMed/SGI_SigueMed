<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoteSubProducto_Model
 *
 * @author SigueMED
 */
class LoteSubProducto_Model extends CI_Model {
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table="lotesubproducto";
        $this->load->database();
    }
    
    public function ConsultarLote($IdCodigoSubProducto,$Lote)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('IdCodigoSubProducto',$IdCodigoSubProducto);
        $this->db->where('Lote',$Lote);
        $query = $this->db->get();
        
        if ($query->num_rows()>=1)
        {
            return $query->row();
            
        }
        return false;
    }
    public function RegistrarNuevoLote($NuevoLote)
    {
        return $this->db->insert($this->table,$NuevoLote);
    }
    //put your code here
}
