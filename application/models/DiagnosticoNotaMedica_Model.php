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
    public $IdNotaMedica;
    public $IdDiagnostico;
    public $ObservacionesDiagnostico;
            
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
    
  
    
}
