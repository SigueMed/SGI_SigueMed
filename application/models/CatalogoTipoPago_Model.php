<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CatalogoTipoPago_Model
 *
 * @author SigueMED
 */
class CatalogoTipoPago_Model extends CI_Model{
    private $table;
    
    public function __construct() {
        parent::__construct();
        
        $this->table = "catalogotipopago";
        $this->load->database();
    }
    
    public function ConsultarTipoPago()
    {
        $this->db->select($this->table.'.*');
        $this->db->from ($this->table);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    //put your code here
}
