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
        $this->table = "paciente";
        $this->load->database();
        
    }
      
   
    public function ConsultarPacientePorId($IdPaciente)
    {
        $condition = "IdPaciente =" . $IdPaciente;
        $this->db->select($this->table.'.*');
        $this->db->select('TIMESTAMPDIFF(YEAR,FechaNacimiento,NOW()) AS Edad');
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) 
        {
            return $query->row();
        } 
       return false;
        
        
    }
    
    public function ActualizarPaciente_Post($IdPacienteUpdt)
    {
        if($this->input->post('cbEscolaridad')=="")
                { $IdEscolaridad = null;}
                else
                {
                    $IdEscolaridad = $this->input->post('cbEscolaridad');
                }
                 if($this->input->post('cbEstadoCivil')=="")
                { $IdEstadoCivil = null;}
                else
                {
                    $IdEstadoCivil = $this->input->post('cbEstadoCivil');
                }
                 if($this->input->post('cbReligion')=="")
                { $IdReligion = null;}
                else
                {
                    $IdReligion = $this->input->post('cbReligion');
                }
                if($this->input->post('cbOcupacion')=="")
                { $IdOcupacion = null;}
                else
                {
                    $IdOcupacion = $this->input->post('cbOcupacion');
                }
                if($this->input->post('cbRecursosMedicos')=="")
                { $IdRecursosMedicos = null;}
                else
                {
                    $IdRecursosMedicos = $this->input->post('cbRecursosMedicos');
                }
                
                

                $PacienteUpdt = array(
                    'Nombre'=>$this->input->post('Nombre'),
                    'Apellidos' => $this->input->post('Apellidos'),
                    'Sexo' => $this->input->post('cbSexo'),
                    'FechaNacimiento' => $this->input->post('FechaNacimiento'),
                    'Calle' => $this->input->post('Calle'),
                    'Colonia' => $this->input->post('Colonia'),
                    'CP' => $this->input->post('CP'),
                    'ViveCon' => $this->input->post('ViveCon'),
                    'Escolaridad' => $this->input->post('Escolaridad'),
                    
                    'IdEscolaridad' => $IdEscolaridad,
                    'IdReligion' => $IdReligion,
                    'Religion' => $this->input->post('Religion'),
                    'IdOcupacion' => $IdOcupacion,
                    'Ocupacion' => $this->input->post('Ocupacion'),
                    'IdEstadoCivil' => $IdEstadoCivil,
                    'IdRecursosMedicos' =>$IdRecursosMedicos,
                    'DondeVive' => $this->input->post('DondeVive'),
                    'NumCelular' => $this->input->post('Celular'),
                    'email'=> $this->input->post('email'),
                    'RFC'=> $this->input->post('RFC')
                    );

        $this->db->where('IdPaciente', $IdPacienteUpdt);
       
        return $this->db->update($this->table,$PacienteUpdt);
    }
    
   
    //------------------
    //AUTOR 'Carlos Esquivel' -- Guarda nuevo paciente
    public function agregarNuevoPaciente($param){
            
        $campos = array(
            'Nombre' => $param['nombre'],
            'Apellidos' => $param['apellido'],
            'NumCelular' => $param['telefono'],
        );
        
       
        $this->db->insert($this->table, $campos);
        if ($this->db->affected_rows() == 1) 
            {
                return 1;
            }
        return 0;
    }
    
    public function BuscarPacientePorNombre($Nombre, $Apellidos)
    {
        $this->db->select('Nombre, Apellidos');
        $this->db->from($this->table);
        $this->db->like('Nombre',$Nombre);
        $this->db->like('Apellidos', $Apellidos);
        $query = $this->db->get();
        if ($query->num_rows()>0)
        {
            return $query->result_array();
            
        }
        
        return false;
    }

    public function consultarIdNuevoPaciente($param){
            
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('Nombre',$param['nombre']);
        $this->db->where('Apellidos',$param['apellido']);
        $this->db->where('NumCelular',$param['telefono']);
        $query = $this->db->get();

        if ($query->num_rows() == 1) 
        {
            $row = $query->row();
            
            return $row;
        } 
        else 
        {
            return 0;
    }
    
        }
    
    /**
     * DESCRIPCION: Función para consultar todos los pacientes que tengan nota medica
     * $IdServicio: Filtra los pacientes de acuerdo al servicio, Todos en caso de que no se indique
     * RETURN: Devuelve un result_array con la información de los pacientes incluyendo el Id de la nota Medica, FechaNotaMedica,DescripcionServicio
     * AUTOR: Constanzo Manuel Basurto Chipolini
     * **/
    public function ConsultarPacientesConNotaMedica($IdClinica=FALSE,$IdServicio =FALSE)
    {
        $this->db->select($this->table.'.*, IdNotaMedica,FechaNotaMedica, DescripcionServicio');
        $this->db->from($this->table);
        
        $this->db->join('notamedica',$this->table.'.IdPaciente = notamedica.IdPaciente');
        $this->db->join('servicio','notamedica.IdServicio = servicio.IdServicio');
        $this->db->order_by('Apellidos','asc');
        $this->db->order_by('DescripcionServicio','asc');
        $this->db->order_by('IdNotaMedica','asc');
        
        if($IdClinica!== FALSE)
        {
            $this->db->where('IdClinica',$IdClinica);
        }
        if($IdServicio!== FALSE)
        {
            $this->db->where('notamedica.IdServicio', $IdServicio);
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
        
        
    }
    
    /*
     * DESCRIPCION: Consultar TODOS los pacientes 
     * RETURN: array con la información de todos los pacientes
     * AUTOR: Constanzo Manuel Basurto Chipolini
     */
    public function ConsultarPacientes()
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $query = $this->db->get();
        
        return $query->result_array();
    }
}
