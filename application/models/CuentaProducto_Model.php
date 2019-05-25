<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CuentaProducto_Model
 *
 * @author SigueMED
 */
class CuentaProducto_Model extends CI_Model {
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table = "cuentaproducto";
        $this->load->database();
    }
    
    public function InsertarNuevaCuentaProducto($NuevoIdProducto,$Cuenta,$PorcentajeProducto)
    {
        $this->db->set('IdProducto',$NuevoIdProducto);
        $this->db->set('IdCuenta',$Cuenta);
        $this->db->set('PorcentajeCuenta',$PorcentajeProducto);
        return $this->db->insert($this->table);
        
    }
    
    public function ConsultarCuentasPorProducto($IdProducto)
    {
        $this->db->select($this->table.'.*');
        $this->db->select('DescripcionProducto');
        $this->db->select('DescripcionCuenta');
        $this->db->from($this->table);
        $this->db->join('catalogoproductos',$this->table.'.IdProducto = catalogoproductos.IdProducto');
        $this->db->join('cuenta',$this->table.'.IdCuenta = cuenta.IdCuenta');
        $this->db->where($this->table.'.IdProducto',$IdProducto);
        
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
    //put your code here
}
