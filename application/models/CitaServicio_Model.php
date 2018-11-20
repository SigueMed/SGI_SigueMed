<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CitaServicio
 *
 * @author SigueMed
 */
class CitaServicio_Model extends CI_Model 
{
    private $table;

    
    public function __construct() {
        parent::__construct();
        $this->table = "CitaServicio";
        $this->load->database();
        
    }
    
    public function ConsultarCitasPorDia($Fecha, $IdStatus=FALSE)
    {
        $this->load->helper("date");
        
        $dia = mdate('%d',$Fecha);
        $mes = mdate('%m',$Fecha);
        $anio = mdate('%Y',$Fecha);
        
        
        
        $this->db->select($this->table.'.*, DescripcionServicio, Nombre, Apellidos, DescripcionEstatusCita');
        $this->db->from($this->table.',Servicio,Paciente, CatalogoEstatusCita');
        // JOIN
        $this->db->where($this->table.'.IdServicio = Servicio.IdServicio');
        $this->db->where($this->table.'.IdPaciente = Paciente.IdPaciente');
        $this->db->where($this->table.'.IdStatusCita = CatalogoEstatusCita.IdStatusCita');
        //CONDICION
        $this->db->where('DiaCita', $dia);
        $this->db->where('MesCita', $mes);
        $this->db->where('AnioCita', $anio);
        
        if($IdStatus!=FALSE)
        {
            $this->db->where($this->table.'.IdStatusCita', $IdStatus);
        }
        else
        {
            $this->db->where($this->table.'.IdStatusCita !=', ATENDIDA);
        }
        
        $this->db->order_by('HoraCita', 'ASC');
      
        
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
    
    public function ConsultarCitasPorServicio($IdServicio)
    {
        $this->load->helper("date");
        
        $Fecha = now();
        
        $mes = mdate('%m',$Fecha);
        $anio = mdate('%Y',$Fecha);
        
        
        
        $this->db->select('IdCitaServicio as id, DescripcionServicio as title, CONCAT(Nombre," ", Apellidos) as descripcion, '
                . 'CONCAT(anioCita,"-",MesCita,"-",DiaCita," ",TIME_FORMAT(HoraCita,"%H:%i:%s"), FALSE) as start');
         $this->db->select('CONCAT(AnioCita,"-",MesCita,"-",DiaCita," ",TIME_FORMAT(ADDTIME(HoraCita,"1:00:00"),"%H:%i:%s"),FALSE) as end', FALSE);
         $this->db->select('IdStatusCita');
        $this->db->from($this->table);
        // JOIN
        $this->db->join('Servicio','Servicio.IdServicio='.$this->table.'.IdServicio');
        $this->db->join('Paciente','Paciente.IdPaciente='.$this->table.'.IdPaciente');
    

        $this->db->where('MesCita >='.$mes);
        $this->db->where('AnioCita>='.$anio);
        
        $this->db->where($this->table.'.IdServicio', $IdServicio);
                
        
        $query = $this->db->get();
        
        return $query->result_array();
    }


public function ConsultarCitaPorId($IdCita)
    {
         
        $this->db->select($this->table.'.*,DescripcionServicio');
        $this->db->from($this->table.',Servicio');
        //JOIN
        $this->db->where($this->table.'.IdServicio = Servicio.IdServicio');
        //CONDICION
        $this->db->where('IdCitaServicio', $IdCita);
       
        $query = $this->db->get();
        
        return $query->row();
        
    }
     public function ConsultarCitaPorNotaMedica($IdNotaMedica)
    {
         
        $this->db->select($this->table.'.*,DescripcionServicio');
        $this->db->from($this->table.',Servicio');
        //JOIN
        $this->db->where($this->table.'.IdServicio = Servicio.IdServicio');
        //CONDICION
        $this->db->where('IdNotaMedica', $IdNotaMedica);
       
        $query = $this->db->get();
        
        return $query->row();
        
    }
    
    public function ConfirmarCita($IdCita)
    {
        $data = array('IdStatusCita' => CONFIRMADA);
        $this->db->where('IdCitaServicio', $IdCita);
       
        return $this->db->update($this->table,$data);
               
    }
    
    public function CancelarCita($IdCita)
    {
        $data = array('IdStatusCita'=>CANCELADA);
        
        $this->db->where('IdCitaServicio', $IdCita);
       
        return $this->db->update($this->table,$data);
        
    }
    
    public function RegistrarCita($IdCita)
    {
        $data = array('IdStatusCita'=>REGISTRADA);
        
        $this->db->where('IdCitaServicio', $IdCita);
       
        return $this->db->update($this->table,$data);
    }

    public function AsignarNotaMedica($IdCita,$IdNotaMedica)
    {
        
        $data = array('IdNotaMedica'=>$IdNotaMedica);
        
        $this->db->where('IdCitaServicio', $IdCita);
       
        return $this->db->update($this->table,$data);
    }
    
    public function ActualizarEstatusCita($IdCita, $IdStatus)
    {
        $data = array('IdStatusCita'=>$IdStatus);
        
        $this->db->where('IdCitaServicio', $IdCita);
       
        return $this->db->update($this->table,$data);
    }
    public function ConsultarCitasporMes($Fecha){
        $this->load->helper("date");
        
        $dia = mdate('%d',$Fecha);
        $mes = mdate('%m',$Fecha);
        $anio = mdate('%Y',$Fecha);
        
        $this->db->select($this->table.'.*, DescripcionServicio, Nombre, Apellidos, DescripcionEstatusCita');
        $this->db->from($this->table.',Servicio,Paciente, CatalogoEstatusCita');
        // JOIN
        $this->db->where($this->table.'.IdServicio = Servicio.IdServicio');
        $this->db->where($this->table.'.IdPaciente = Paciente.IdPaciente');
        $this->db->where($this->table.'.IdStatusCita = CatalogoEstatusCita.IdStatusCita');
        
        $this->db->where('DiaCita', $dia);
        $this->db->where('MesCita BETWEEN', $mes,'AND', $mes);
        $this->db->where('AnioCita', $anio);
    }
    
    public function updEvento($param)
    {
        
        $dia = mdate('%d',$param['fecini']);
        $mes = mdate('%m',$param['fecini']);
        $anio = mdate('%Y',$param['fecini']);
        $hora = mdate('%h:%i:%s', $param['fecini']);
        $campos = array(
                'DiaCita' => $dia,
                'MesCita' => $mes,
                'AnioCita' => $anio,
                'HoraCita' => $hora
                );

        $this->db->where('IdCitaServicio',$param['id']);
        $this->db->update($this->table,$campos);

        if ($this->db->affected_rows() == 1) {
                return 1;
        }else{
                return 0;
        }
    }
    public function agregarEvento($param){
        $campos = array(
            'IdPaciente' => $param['idPaciente'],
            'DiaCita' => $param['idPaciente'],
            'MesCita' => $param['idPaciente'],
            'AnioCita' => $param['idPaciente'],
            'Hora' => $param['idPaciente']
           );
        
        $this->db->insert('eventospruebas', $campos);
        
        if ($this->db->affected_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
        
        
    }

}
