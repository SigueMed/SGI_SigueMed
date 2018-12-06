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
    
    /*
     * Descripcion: Consulta la citas de un dia especifico
     * IdStatus: Si se indica, consultas las citas del día especifico con el estatus proporcionado
     */
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
    
    
    /*
     * Descripcion:Consulta TODAS las citas de un servicio del mes actual en adelante
     * IdServicio: El ID del servicio del que se quieren obtener las citas
     */
    public function ConsultarCitasPorServicio($IdServicio)
    {
        $this->load->helper("date");
        
        $Fecha = now();
        
        $mes = mdate('%m',$Fecha);
        $anio = mdate('%Y',$Fecha);
        
        $this->db->select('IdCitaServicio as id, Paciente.IdPaciente as idpac, DescripcionServicio as title, CONCAT(Nombre," ", Apellidos) as descripcion, Paciente.NumCelular as descripcioncel,'
                . 'CAST(CONCAT(anioCita,"-",MesCita,"-",DiaCita,"T",TIME_FORMAT(HoraCita,"%H:%i:%s")) as datetime) as start');
         $this->db->select('CAST(CONCAT(AnioCita,"-",MesCita,"-",DiaCita,"T",TIME_FORMAT(ADDTIME(HoraCita,"1:00:00"),"%H:%i:%s")) as datetime) as end', FALSE);
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


    /*
     * Descripcion:Consultar una cita por ID
     * IdCita: El ID de la cia que se quiere consultar
     */
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
    
    /*
     * Descripcion: Consultar una cita por el Id de la Nota Medica asociada
     * IdNotaMedica: Id de la nota medica de la que se quiere obtener la cita
     */
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
    //AUTOR 'Carlos Esquivel' -- Guarda nuevas citas
    public function agregarEvento($param){
        $campos = array(
            'IdPaciente' => $param['IdPaciente'],
            'IdServicio' => $param['IdServicio'],
            'DiaCita' => $param['DiaCita'],
            'MesCita' => $param['MesCita'],
            'AnioCita' => $param['AnioCita'],
            'HoraCita' => $param['HoraCita'],
            'IdStatusCita' => $param['IdStatusCita']
           );
        
        $this->db->insert($this->table, $campos);
        
        if ($this->db->affected_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
    }

    //AUTOR 'Carlos Esquivel' -- eliminar cita
	public function deleteEvento($id){
		$this->db->where('IdCitaServicio', $id);
		return $this->db->delete($this->table);
	}
        
        //AUTOR 'Carlos Esquivel' -- actualizar cita
	public function ActualizarCita($param){
		$campos = array(
			'IdPaciente' => $param['IdPaciente'],
                        'HoraCita' => $param['HoraCita']
			
			);

		$this->db->where('IdCitaServicio',$param['IdCitaServicio']);
		$this->db->update($this->table,$campos);

		if ($this->db->affected_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
	}
    
    
}
