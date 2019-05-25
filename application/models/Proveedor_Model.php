<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proveedor_Model
 *
 * @author SigueMED
 */
class Proveedor_Model extends CI_Model {
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table = "proveedor";
        $this->load->database();
    }
    
    public function ConsultarProveedores()
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
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
    
    public function ConsultarProveedorPorId($IdProveedor)
    {
        if($IdProveedor != null || $IdProveedor!="")
        {
            $this->db->select($this->table.'.*');
            $this->db->from($this->table);
            $this->db->where('IdProveedor',$IdProveedor);
            $query = $this->db->get();        
            return $query->row_array();
        }
        else
        {
            return false;
        }
    }
    //put your code here
}
