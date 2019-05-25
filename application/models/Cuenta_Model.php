<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cuenta_Model
 *
 * @author SigueMED
 */
class Cuenta_Model extends CI_Model{
    private $table;
    public function __construct() {
        parent::__construct();
        $this->table = 'cuenta';
        
        $this->load->database();
    }
    
    public function ConsultarCuentasPorProducto($IdProducto)
    {
        $this->db->select($this->table.'.*, PorcentajeCuenta');
        $this->db->from($this->table);
        $this->db->join('cuentaproducto',$this->table.'.IdCuenta=cuentaproducto.IdCuenta');
        $this->db->where('cuentaproducto.IdProducto',$IdProducto);
        $this->db->where('Habilitado','1');
        $this->db->where('CuentaBase','0');
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function ConsultarCuentas()
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        
        $this->db->where('Habilitado',true);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function ConsultarCuentaPorId($IdCuenta)
    {
        $this->db->select($this->table.'.*, CONCAT(NombreEmpleado," ",ApellidosEmpleado) as PropietarioCuenta, DescripcionServicio');
        $this->db->from($this->table);
        $this->db->join('empleado',$this->table.'.IdEmpleado = empleado.IdEmpleado');
        $this->db->join('servicio','empleado.IdServicio = servicio.IdServicio');
        $this->db->where('IdCuenta', $IdCuenta);
        $this->db->where($this->table.'.Habilitado',true);
        $query = $this->db->get();
        
        return $query->row();
        
    }
    //put your code here
}
