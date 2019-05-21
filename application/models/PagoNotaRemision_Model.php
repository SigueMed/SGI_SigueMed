<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PagoNotaRemision_Model
 *
 * @author SigueMED
 */
class PagoNotaRemision_Model extends CI_Model {
    private $table;
    public function __construct() {
        $this->table = 'pagonotaremision';
        parent::__construct();
        
        $this->load->database();
    }
    
    public function RegistrarPagoNotaRemision($PagoNotaRemision)
    {
        $result = $this->db->insert($this->table,$PagoNotaRemision);
        
        if ($result == 1)
        {
            $this->db->select_max('IdPagoNotaRemision');
            $this->db->from($this->table);
            $query = $this->db->get();
            
            return $query->row();
        }
        else
        {
            return false;
        }
        
    }
    
    public function ConsultarPagosNotaRemision($IdNotaRemision)
    {
        $this->db->select($this->table.'.*, CONCAT(NombreEmpleado," ", ApellidosEmpleado) as RecibidoPor, DescripcionTipoPago');
        $this->db->from ($this->table);
        $this->db->join('empleado', $this->table.'.IdEmpleado = empleado.IdEmpleado');
        $this->db->join('catalogotipopago',$this->table.'.IdTipoPago = catalogotipopago.IdTipoPago');
        $this->db->where('IdNotaRemision', $IdNotaRemision);
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
    //put your code here
}
