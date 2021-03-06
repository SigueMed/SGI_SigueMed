<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AntecedenteNotaMedica_Model
 *
 * @author SigueMed
 */
class AntecedenteNotaMedica_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table = "antecedentenotamedica";
        $this->load->model('NotaMedica_Model');
        
        $this->load->database();
    }
    
    Public function ConsultarAntecedentesNota($IdNotaMedica)
    {

        $this->db->select($this->table.'.*, DescripcionAntecedente, MinEdad,MaxEdad,Sexo');
        $this->db->from($this->table.', catalogoantecedentes');
        $this->db->where($this->table.'.IdAntecedente = catalogoantecedentes.IdAntecedente');
        $this->db->where('IdNotaMedica', $IdNotaMedica);
        
        $query = $this->db->get();

        if ($query->num_rows() >= 1) 
        {
            return $query->result_array();
        } 
        else 
        {
            return false;
        }
    }
    
    public function CrearNuevosAntecedentesPorServicio($IdNotaMedica, $IdServicio)
    {
        
        //Crear Antecedentes
        $AntecedentesServicios = $this->AntecedenteServicio_Model->ConsultarAntecedentesPorServicio($IdServicio);
        $NotaMedica = $this->NotaMedica_Model->ConsultarNotaMedicaPorId($IdNotaMedica);
        $Paciente = $this->Paciente_Model->ConsultarPacientePorId($NotaMedica->IdPaciente);
        
        
        
        

        log_message('debug', 'AntecedenteNotaMedica_Model->CrearNuevosAntecedentesPorServicio: Edad ='.$Paciente->Edad);
        
        if ($AntecedentesServicios)
        {
            foreach ($AntecedentesServicios as $Antecedente)
            {
                $sexo = true;
                if($Antecedente['Sexo']!=="")
                {
                    if($Paciente->Sexo !== $Antecedente['Sexo'])
                    {
                        $sexo = false;
                    }
                    
                }
                if($Paciente->Edad >= $Antecedente['MinEdad'] && $Paciente->Edad <= $Antecedente['MaxEdad'] && $sexo)
                {
                    $ahora = now();
                
                    $NuevoAntecedente = array(
                        'IdNotaMedica'=>$IdNotaMedica,
                        'IdAntecedente'=>$Antecedente['IdAntecedente'],
                        'DescripcionAntecedenteNotaMedica'=>'PRIMER CONSULTA [Fecha: '.mdate('%Y-%m-%d',$ahora).']'
                    );


                    $resultado = $this->db->insert($this->table, $NuevoAntecedente);
                }
                

            }
            return true;
        }
        else
        {
            return false;
        }

        
        
        
    
    }
    
    
    public function CopiarAntecedentesNotaMedica($IdNuevaNotaMedica, $IdUltimaNotaMedica)
    {
        //Consultar Antecedentes Ultima Nota y cargarlos a la nueva nota
            $AntecedentesNotaMedica = $this->AntecedenteNotaMedica_Model->ConsultarAntecedentesNota($IdUltimaNotaMedica);
            
            if($AntecedentesNotaMedica!=FALSE)
            {
                foreach ($AntecedentesNotaMedica as $Antecedente)
                {
                    $NuevoAntecedente = array(
                        'IdNotaMedica'=>$IdNuevaNotaMedica,
                        'IdAntecedente'=>$Antecedente['IdAntecedente'],
                        'DescripcionAntecedenteNotaMedica'=>$Antecedente['DescripcionAntecedenteNotaMedica'].' -- [Fecha: '.mdate('%Y-%m-%d',now()).']' 
                    );

                    $resultado = $this->db->insert($this->table, $NuevoAntecedente);

                    if ($resultado == FALSE)
                    {
                        return false;
                    }
                }
                
            }
            else
            {
                $NotaMedica = $this->NotaMedica_Model->ConsultarNotaMedicaPorId($IdNuevaNotaMedica);
                
                $resultado = $this->CrearNuevosAntecedentesPorServicio($IdNuevaNotaMedica, $NotaMedica->IdServicio);
            }
            
            return $resultado;
    }
    
    public function ActualizarAntecedente($IdAntecedente,$DescripcionAntecedente)
    {
        $data = array('DescripcionAntecedenteNotaMedica' => $DescripcionAntecedente);
        $this->db->where('IdAntecedenteNotaMedica', $IdAntecedente);
       
        return $this->db->update($this->table,$data);
        
    }
    //put your code here
}
