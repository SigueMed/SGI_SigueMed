<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NotaRemision_Model extends CI_Model {
    
    //Atributos NotaMedica
    private $table;
    private $tproductosnm;
    private $tpaciente;
    
    public $IdNotaMedica;
    public $IdPaciente;
    
    public function __construct() {
        parent::__construct();
        $this->table = "NotaMedica";
        $this->tabla = "productosnotamedica";
        $this->tpaciente = "paciente";
        
        $this->load->database();
        
        $this->load->model('NotaMedica_Model');
        $this->load->model('NotaRemision_Model');
        $this->load->model('ProductosNotaMedica_Model');
        
        $this->load->model('Paciente_Model');
        $this->load->helper('date');
        $this->load->helper('array');
        
        
       }
           private function LoadRow($row)
    {
        $this->IdPaciente = $row->IdPaciente;
        $this->IdServicio = $row->IdServicio;
        $this->IdNotaMedica = $row->IdNotaMedica;
        $this->FechaNotaMedica = $row->FechaNotaMedica;
        
    }
    
     public function CrearNotaDeRemision($IdNotaMedica){
       
      /* $this->db->select($this->table.'.*, Nombre, Apellidos, FechaNacimiento,'
                . ' FechaNotaMedica, PesoPaciente, TallaPaciente, TemperaturaPaciente,'
                . 'IMCPaciente, PresionPaciente, FrCardiacaPaciente, FrRespiratoriaPaciente,'
                . 'CantidadProductoNM, Descuento');
        $this->db->from($this->table);
        
        $this->db->join('Paciente','Paciente.IdPaciente='.$this->table.'.IdPaciente');
        $this->db->join('ProductosNotaMedica','ProductosNotaMedica.IdNotaMedica='.$this->table.'.IdNotaMedica');
        $this->db->where($this->table.'.IdNotaMedica = ProductosNotaMedica.IdNotaMedica');
        $this->db->where($this->table.'.IdNotaMedica = NotaMedica.IdNotaMedica');
        $this->db->where($this->table.'.IdPaciente = Paciente.IdPaciente');
        */
        
        /*$this->db->select($this->table.'.*,Nombre, Apellidos,FechaNacimiento, Calle, Colonia,'
                . 'FechaNotaMedica, PesoPaciente, TallaPaciente, TemperaturaPaciente,'
                . 'IMCPaciente, PresionPaciente, FrCardiacaPaciente,FrRespiratoriaPaciente, DescripcionProducto'
                . ',CantidadProductoNM, Descuento');
        $this->db->from($this->table);
        $this->db->join('Paciente','Paciente.IdPaciente ='.$this->table.'.IdPaciente');
        $this->db->join('ProductosNotaMedica','ProductosNotaMedica.IdNotaMedica='.$this->table.'.IdNotaMedica');
        $this->db->join('catalogoproductos','catalogoproductos.Idproducto ='.$this->tabla.'.IdProducto');
        $this->db->where($this->table.'.IdNotaMedica = NotaMedica.IdNotaMedica');
        $this->db->where($this->table.'.IdPaciente = Paciente.IdPaciente');
        
        */
          $this->db->select($this->tpaciente.'.*,Nombre,Apellidos,FechaNacimiento');
          $this->db->from($this->tpaciente);
         //$this->db->select($this->table.'.*,Nombre, Apellidos,FechaNacimiento, Calle, Colonia');
//         $this->db->from($this->tpasiente);
  //       $this->db->where($this->tpasiente.'.IdPaciente = Paciente.IdPaciente');
    //     $this->db->where($this->tproductosnm.'.IdNotaMedica = ProductosNotaMedica.IdNotaMedica');
         
        $query = $this->db->get();
        
        return $query->result_array();
    }
}