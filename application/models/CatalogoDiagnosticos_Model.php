<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CatalogoDiagnosticos_Model
 *
 * @author SnakcSalas
 */
class CatalogoDiagnosticos_Model extends CI_Model {
    
    //Atributos CatalogoDiagnostico
    private $table;
    public $IdDiagnostico;
    public $DescripcionDiagnostico;
            
    /*
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->table = "catalogodiagnosticos";
        $this->load->database();

    }
    
    public function ConsultarDiagnosticosPorServicio($IdServicio)
   {
       $this->db->select($this->table.'.*');
       $this->db->from($this->table);
       $this->db->where('IdServicio', $IdServicio);
       
       $query = $this->db->get();
       
       return $query->result_array();
   }
    
}
