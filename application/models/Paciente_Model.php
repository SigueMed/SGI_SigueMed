<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Paciente_Model
 *
 * @author SigueMed
 */
class Paciente_Model extends CI_Model {
    
    private $table;
  

    
    public function __construct() {
        parent::__construct();
        $this->table = "Paciente";
        $this->load->database();
        
    }
      
   
    public function ConsultarPacientePorId($IdPaciente)
    {
        $condition = "IdPaciente =" . $IdPaciente;
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) 
        {
            $row = $query->row();
            
            return $row;
        } 
        else 
        {
            return false;
        }
        
        
    }
    
    public function ActualizarPaciente($IdPacienteUpdt, $PacienteUpdt)
    {
        $this->db->where('IdPaciente', $IdPacienteUpdt);
       
        return $this->db->update($this->table,$PacienteUpdt);
    }

    //------------------
    
    public function agregarNuevoPaciente($param){
            
        $campos = array(
            'Nombre' => $param['nombre'],
            'Apellidos' => $param['apellido'],
            'NumCelular' => $param['telefono'],
        );
        
        $this->db->insert($this->table, $campos);
        if ($this->db->affected_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
    }
}
