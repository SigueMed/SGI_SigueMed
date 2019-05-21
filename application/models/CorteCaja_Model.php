<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CorteCaja_Model
 *
 * @author SigueMED
 */
class CorteCaja_Model extends CI_Model {
    
    private $table;
public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->table="cortecaja";
    
}    

public function CrearCorteCaja($NuevoCorte_Array)
{
    $this->db->insert($this->table,$NuevoCorte_Array);
    
    return $this->db->insert_id();
    
}
//put your code here
}
