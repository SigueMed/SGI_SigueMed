<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Salida_Model
 *
 * @author SigueMED
 */
class Salida_Model extends CI_Model {
    private $table;
    public function __construct() {
        parent::__construct();
        
        $this->table="salidacaja";
        
        $this->load->database();
        
    }
    
    public function RegistrarSalidaCaja($Salida)
    {
        
        $result = $this->db->insert($this->table,$Salida);
        if($result >=1)
        {
            $this->db->select_max('IdSalida','IdUltimaSalida');
            $this->db->from($this->table);
            $IdNuevaSalida = $this->db->get()->row();
            
            return $IdNuevaSalida;
        }
        else
        {
            return null;
        }
        
        
    }
    
    public function ConsultarSalidaPorId($IdSalida)
    {
        $this->db->select($this->table.'.*, DescripcionCuenta, CONCAT(empleado_B.NombreEmpleado," ",empleado_B.ApellidosEmpleado) as ElaboradaPor,CONCAT(empleado_A.NombreEmpleado," ",empleado_A.ApellidosEmpleado) as NombreMedico  ');
        $this->db->from($this->table);
        $this->db->join('cuenta', $this->table.'.IdCuenta = cuenta.IdCuenta');
        $this->db->join('empleado empleado_A', 'cuenta.IdEmpleado = empleado_A.IdEmpleado','left');
        $this->db->join('empleado empleado_B',$this->table.'.IdEmpleado = empleado_B.IdEmpleado');
        $this->db->where('IdSalida', $IdSalida);
        
        $query = $this->db->get();
        
        return $query->row();
        
    }
    //put your code here
}
