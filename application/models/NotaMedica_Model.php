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
    
    private $UpdateFields;
            
    /*
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->table = "notamedica";
        $this->tabla = "productosnotamedica";
        $this->load->database();
        
        $this->load->model('CitaServicio_Model');
        $this->load->model('AntecedenteServicio_Model');
        $this->load->model('AntecedenteNotaMedica_Model');
        
        $this->load->helper('date');
        $this->load->helper('array');
        $this->UpdateFields = array('FechaNotaMedica','PesoPaciente','TallaPaciente','PresionPaciente','FrCardiacaPaciente','FrRespiratoriaPaciente','TemperaturaPaciente','DiagnosticoGeneral');
        //$this->load->model ('Paciente_Model');

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
        $this->db->select($this->table.'.*');
        $this->db->select('CONCAT (NombreEmpleado," ", ApellidosEmpleado) as ElaboradoPor');
        $this->db->from($this->table);
        $this->db->join('empleado',$this->table.'.IdEmpleado = empleado.IdEmpleado');
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
    
    public function CrearNuevaNotaMedica($IdCita, $DatosSomatometria,$IdEmpleado,$IdClinica, $IdUltimaNotaMedica = FALSE)
    {
        //No tiene notas medias anteriores
        $Cita = $this->CitaServicio_Model->ConsultarCitaPorId($IdCita);
        $Fecha = now();
        
        //Crear Nueva Nota con Datos Somatometria
        $InsertArray = array(
                'IdPaciente'=>$Cita->IdPaciente,
                'IdServicio'=>$Cita->IdServicio,
                'FechaNotaMedica'=>mdate('%Y-%m-%d', $Fecha),
                'PesoPaciente'=>$DatosSomatometria['PesoPaciente'],
                'TallaPaciente'=>$DatosSomatometria['TallaPaciente'],
                'PresionPaciente'=>$DatosSomatometria['PresionPaciente'],
                'FrCardiacaPaciente'=>$DatosSomatometria['FrCardiacaPaciente'],
                'FrRespiratoriaPaciente'=>$DatosSomatometria['FrRespiratoriaPaciente'],
                'TemperaturaPaciente'=>$DatosSomatometria['TemperaturaPaciente'],
                'IdEmpleado'=>$IdEmpleado,
                'IdClinica'=>$IdClinica,
                'IdEstatusNotaMedica'=> NM_ABIERTA
            );
            //log_message('info', 'CrearNuevaNotaMedica: Peso='.$InsertArray['PesoPaciente']);
            
        $this->db->insert($this->table, $InsertArray);
                    
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
         
        
        //$data = elements($this->UpdateFields,$DatosNotaMedica); 
        $this->db->where('IdNotaMedica', $IdNotaMedica);
       
        return $this->db->update($this->table,$DatosNotaMedica);
        
    }
    
    /*
     * DESCRIPCION: Consulta las notas medicas Atendidas para el IdPaciente
     * RETURN: result_array() de las notas medicas del paciente
     * AUTOR: Constanzo Manuel Basurto Chipolini
     */
    public function ConsultarNotaMedicaAtendidasPaciente($IdPaciente,$IdClinica)
    {
        $this->db->select($this->table.'.*, DescripcionServicio');
        $this->db->from($this->table);
        $this->db->join('servicio','servicio.IdServicio = '.$this->table.'.IdServicio');
        $this->db->where($this->table.'.IdPaciente', $IdPaciente);
        $this->db->where($this->table.'.IdEstatusNotaMedica', NM_ATENDIDA);
        $this->db->where($this->table.'.IdClinica', $IdClinica);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function ActualizarEstatusNotaMedica($IdNotaMedica,$IdEstatusNotaMedica)
    {
        $this->db->set('IdEstatusNotaMedica',$IdEstatusNotaMedica);
        $this->db->where ('IdNotaMedica',$IdNotaMedica);
        return $this->db->update($this->table);
    }
}