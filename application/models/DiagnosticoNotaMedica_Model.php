<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DiagnosticoNotaMedica_Model
 *
 * @author SnakcSalas
 */
class DiagnosticoNotaMedica_Model extends CI_Model {
    
    //Atributos DiagnosticoNotaMedica
    private $table;            
    /*
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->table = "diagnosticonotamedica";
        $this->load->database();

    }
    
    public function AgregarDiagnosticosNotaMedicaBatch($Diagnosticos)
    {
        $resultado = $this->db->insert_batch($this->table,$Diagnosticos);
        
        return $resultado;
        
    }
    
    public function ConsultarDiagnosticosNotaMedica($IdNotaMedica)
    {
        $this->db->select($this->table.'.*, DescripcionDiagnostico');
        $this->db->from($this->table);
        $this->db->join('catalogodiagnosticos','catalogodiagnosticos.IdDiagnostico='.$this->table.'.IdDiagnostico');
        $this->db->where('IdNotaMedica',$IdNotaMedica);
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
  
    
}
