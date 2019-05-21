<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DetalleNotaRemision
 *
 * @author SigueMED
 */
class DetalleNotaRemision_Model extends CI_Model{
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table = "detallenotaremision";
        $this->load->database();
        
    }
    
    public function AgregarDetalleNotaRemision($DetalleNotaRemision)
    {
        return $this->db->insert ($this->table,$DetalleNotaRemision);
    }
    
    public function ConsultarDetalleNotaRemision($IdNotaRemision)
    {
        $this->db->select($this->table.'.*, catalogoproductos.DescripcionProducto, NombreSubProducto');
        $this->db->from($this->table);
        $this->db->join('catalogoproductos',$this->table.'.IdProducto=catalogoproductos.IdProducto');
        $this->db->join('subproducto',$this->table.'.IdCodigoSubProducto = subproducto.IdCodigoSubProducto','left');
        $this->db->where('IdNotaRemision',$IdNotaRemision);
        
        $query = $this->db->get();
        
        return $query->result_array();
        
        
    }
    //put your code here
}
