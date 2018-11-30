<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotaMedica_Model
 *
 * @author SigueMed
 */
class NotaMedica_Model extends CI_Model {
    
    //Atributos NotaMedica
    private $table;
    public $IdNotaMedica;
    public $IdPaciente;
    public $FechaNotaMedica;
    public $IdServicio;
    private $UpdateFields;
            
    /*
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->table = "NotaMedica";
        $this->tabla = "productosnotamedica";
        $this->load->database();
        
        $this->load->model('CitaServicio_Model');
        $this->load->model('AntecedenteServicio_Model');
        $this->load->model('AntecedenteNotaMedica_Model');
        $this->load->helper('date');
        $this->load->helper('array');
        $this->UpdateFields = array('FechaNotaMedica','PesoPaciente','TallaPaciente','PresionPaciente','FrCardiacaPaciente','FrRespiratoriaPaciente','TemperaturaPaciente');
        //$this->load->model ('Paciente_Model');

    }
    
    private function LoadRow($row)
    {
        $this->IdPaciente = $row->IdPaciente;
        $this->IdServicio = $row->IdServicio;
        $this->IdNotaMedica = $row->IdNotaMedica;
        $this->FechaNotaMedica = $row->FechaNotaMedica;
        
    }
    
    /*
     * Descripción: Consulta el ultimo ID de la nota medica del paciente por servicio
     * Salida: Devuelve el ultimo ID de la nota medica del paciente
     */
    public function ConsultarUltimaNotaMedicaPorPaciente($IdPaciente, $IdServicio)
    {
        //Query de Consulta
        //SELECT MAX IdNotaMedica FROM NotaMedica WHERE IdPaciente = $IdPaciente AND IdServicio = IdServicio

        $this->db->select_max('IdNotaMedica', 'IdUltimaNotaMedica');
        $this->db->from($this->table);
        $this->db->where('IdPaciente', $IdPaciente);
        $this->db->where('IdServicio', $IdServicio);
        $query = $this->db->get();
        

        if ($query->num_rows() == 1) 
        {
            return $query->row()->IdUltimaNotaMedica;       
        } 
        else 
        {
            return false;
        }
    }
    
    public function ConsultarNotaMedicaPorId($IdNotaMedica)
    {
        $condition = "IdNotaMedica =" . $IdNotaMedica;
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) 
        {
            return $query->row();
        } 
        else 
        {
            return false;
        }
        
    }
    
    public function CrearNuevaNotaMedica($IdCita, $DatosSomatometria,$IdUsuario, $IdUltimaNotaMedica = FALSE)
    {
        //No tiene notas medias anteriores
        $Cita = $this->CitaServicio_Model->ConsultarCitaPorId($IdCita);
        
        //Crear Nueva Nota con Datos Somatometria
        $InsertArray = array(
                'IdPaciente'=>$Cita->IdPaciente,
                'IdServicio'=>$Cita->IdServicio,
                'FechaNotaMedica'=>mdate('%Y-%m-%d'),
                'PesoPaciente'=>$DatosSomatometria['PesoPaciente'],
                'TallaPaciente'=>$DatosSomatometria['TallaPaciente'],
                'PresionPaciente'=>$DatosSomatometria['PresionPaciente'],
                'FrCardiacaPaciente'=>$DatosSomatometria['FrCardiacaPaciente'],
                'FrRespiratoriaPaciente'=>$DatosSomatometria['FrRespiratoriaPaciente'],
                'TemperaturaPaciente'=>$DatosSomatometria['TemperaturaPaciente'],
                'IdUsuario'=>$IdUsuario
            );
            
        $this->db->insert('NotaMedica', $InsertArray);
                    
        $IdNuevaNota = $this->ConsultarUltimaNotaMedicaPorPaciente($Cita->IdPaciente, $Cita->IdServicio);
                   
            
        if ($IdUltimaNotaMedica == FALSE)
        {
            $resultado = $this->AntecedenteNotaMedica_Model->CrearNuevosAntecedentesPorServicio($IdNuevaNota, $Cita->IdServicio);
           
        }

        else
        {
            $resultado = $this->AntecedenteNotaMedica_Model->CopiarAntecedentesNotaMedica($IdNuevaNota,$IdUltimaNotaMedica);
                      
        }
            
        return $IdNuevaNota;    
    }
    
    public function ActualizarNotaMedica($IdNotaMedica, $DatosNotaMedica)
    {
         
        
        $data = elements($this->UpdateFields,$DatosNotaMedica); 
        $this->db->where('IdNotaMedica', $IdNotaMedica);
       
        return $this->db->update($this->table,$data);
        
    }
                    
    public function CrearNotaDeRemision(){
       
      /*  $this->db->select($this->table.'.*, Nombre, Apellidos, FechaNacimiento,'
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
        
        $this->db->select($this->table.'.*,Nombre, Apellidos,FechaNacimiento, Calle, Colonia,'
                . 'FechaNotaMedica, PesoPaciente, TallaPaciente, TemperaturaPaciente,'
                . 'IMCPaciente, PresionPaciente, FrCardiacaPaciente,FrRespiratoriaPaciente, DescripcionProducto'
                . ',CantidadProductoNM, Descuento');
        $this->db->from($this->table);
        $this->db->join('Paciente','Paciente.IdPaciente ='.$this->table.'.IdPaciente');
        $this->db->join('ProductosNotaMedica','ProductosNotaMedica.IdNotaMedica='.$this->table.'.IdNotaMedica');
        $this->db->join('catalogoproductos','catalogoproductos.Idproducto ='.$this->tabla.'.IdProducto');
        $this->db->where($this->table.'.IdNotaMedica = NotaMedica.IdNotaMedica');
        $this->db->where($this->table.'.IdPaciente = Paciente.IdPaciente');
        
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
        
        
}

