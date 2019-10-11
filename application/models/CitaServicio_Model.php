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
        $this->table = "citaservicio";
        $this->load->database();

    }

    /*
     * Descripcion: Consulta la citas de un dia especifico
     * IdStatus: Si se indica, consultas las citas del día especifico con el estatus proporcionado
     */
    public function ConsultarCitasPorDia($FechaInicio, $FechaFin, $IdStatus=FALSE, $IdEmpleado=FALSE)
    {
        $this->load->helper("date");

        $this->db->select($this->table.'.*, DescripcionServicio, CASE WHEN Nombre IS NULL THEN TituloCita ELSE CONCAT(Nombre, " ", Apellidos) END as NombrePaciente,NumCelular, DescripcionEstatusCita');
        $this->db->select('CONCAT(e.NombreEmpleado," ",e.ApellidosEmpleado) as NombreElaboradaPor');
        $this->db->select('CONCAT(em.NombreEmpleado," ",em.ApellidosEmpleado) as NombreModificadaPor');
        $this->db->from($this->table);
        // JOIN
        $this->db->join('servicio', $this->table.'.IdServicio = servicio.IdServicio');
        $this->db->join('paciente',$this->table.'.IdPaciente = paciente.IdPaciente','left');
        $this->db->join('catalogoestatuscita', $this->table.'.IdStatusCita = catalogoestatuscita.IdStatusCita');
        $this->db->join('empleado e',$this->table.'.ElaboradaPor = e.IdEmpleado','left');
        $this->db->join('empleado em',$this->table.'.ModificadoPor = em.IdEmpleado','left');

        $this->db->where('FechaInicio >=',$FechaInicio);
        $this->db->where('FechaInicio <=',$FechaFin);

        if($IdStatus!=false)
        {
            if ($IdStatus!= -1) {
                $this->db->where($this->table.'.IdStatusCita', $IdStatus);// code...
            }

        }
        else
        {
            $this->db->where($this->table.'.IdStatusCita !=', ATENDIDA);
        }


        If($IdEmpleado!=FALSE)
        {
            $this->db->where($this->table.'.IdEmpleado', $IdEmpleado);
        }

        $this->db->where('IdClinica',$this->session->userdata('IdClinica'));


        $this->db->order_by('FechaInicio', 'DESC');


        $query = $this->db->get();

        return $query->result_array();

    }


    /*
     * Descripcion:Consulta TODAS las citas de un servicio del mes actual en adelante
     * IdServicio: El ID del servicio del que se quieren obtener las citas
     */
    public function ConsultarCitasPorServicio($IdServicio=FALSE, $IdStatus=FALSE)
    {
        $this->load->helper("date");

        $Fecha = date("Y/m/d");
        log_message("error", "$Fecha");


        $FechaConsulta = date("Y/m/d",strtotime($Fecha."- 1 month"));
        log_message("error", "$FechaConsulta");
        $mes = mdate('%m',strtotime($FechaConsulta));
        $anio = mdate('%Y',strtotime($FechaConsulta));

        log_message("debug",$mes);
        log_message("debug",$anio);

        $this->db->select('IdCitaServicio as id, paciente.IdPaciente as idpac, DescripcionServicio as descripcion, CASE WHEN Nombre IS NULL THEN TituloCita ELSE CONCAT(Nombre, " ", Apellidos) END as title, paciente.NumCelular as descripcioncel,'
                . 'DATE_FORMAT(FechaInicio, "%Y-%m-%d %H:%i:%s") as start');
         $this->db->select('DATE_FORMAT(FechaFin, "%Y-%m-%d %H:%i:%s") as end', FALSE);
         $this->db->select('IdStatusCita');
         $this->db->select('IdEmpleado');
         $this->db->select('Comentarios');
         $this->db->select($this->table.'.IdServicio');
         $this->db->select('CodigoColorServicio as color');
        $this->db->from($this->table);
        // JOIN
        $this->db->join('servicio','servicio.IdServicio='.$this->table.'.IdServicio');
        $this->db->join('paciente','paciente.IdPaciente='.$this->table.'.IdPaciente','left');


        $this->db->where('MONTH(FechaInicio) >='.$mes);
        $this->db->where('YEAR(FechaInicio)>='.$anio);

        if ($IdServicio !== FALSE)
        {
            $this->db->where($this->table.'.IdServicio', $IdServicio);
        }

        if($IdStatus!== FALSE)
        {
            $this->db->where($this->table.'.IDStatusCita', $IdStatus);
        }
        else
        {
            $this->db->where($this->table.'.IDStatusCita!=', ATENDIDA);
            $this->db->where($this->table.'.IDStatusCita!=', CANCELADA);

        }

        if($this->session->has_userdata('IdClinica'))
        {
            $IdClinica = $this->session->userdata('IdClinica');
            $this->db->where($this->table.'.IdClinica',$IdClinica);
        }

        $query = $this->db->get();

        return $query->result_array();
    }


    /*
     * Descripcion:Consultar una cita por ID
     * IdCita: El ID de la cia que se quiere consultar
     */
    public function ConsultarCitaPorId($IdCita)
    {

        $this->db->select($this->table.'.*,DescripcionServicio, CONCAT(doctor.NombreEmpleado," ",doctor.ApellidosEmpleado) as NombreDoctor');
        $this->db->from($this->table);
        //JOIN
        $this->db->join('servicio',$this->table.'.IdServicio = servicio.IdServicio');
        $this->db->join('empleado doctor',$this->table.'.IdEmpleado = doctor.IdEmpleado','left');

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
        $this->db->from($this->table.',servicio');
        //JOIN
        $this->db->where($this->table.'.IdServicio = servicio.IdServicio');
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

    public function ActualizarEstatusCita($IdCita, $IdStatus,$Comentarios=FALSE)
    {


        $this->db->set('IdStatusCita',$IdStatus);
        if ($Comentarios !== FALSE)
            {$this->db->set('ComentariosCambio',$Comentarios);}
        $this->db->set('ModificadoPor',$this->session->userdata('IdEmpleado'));
        $this->db->set('FechaModificacion',mdate('%Y-%m-%d %H:%i:%s',now()));
        $this->db->where('IdCitaServicio', $IdCita);

        return $this->db->update($this->table);
    }


    //AUTOR 'Carlos Esquivel' -- Guarda nuevas citas
    public function agregarEvento($param){
        $campos = array(
            'IdPaciente' => $param['IdPaciente'],
            'IdServicio' => $param['IdServicio'],
            'FechaInicio' => $param['FechaInicio'],
            'FechaFin' => $param['FechaFin'],

            'IdStatusCita' => $param['IdStatusCita'],
            'IdEmpleado'=> $param['IdEmpleado'],
            'Comentarios'=>$param['Comentarios'],
            'IdClinica'=> $param['IdClinica'],
            'TituloCita'=>$param['TituloCita'],
            'ElaboradaPor'=>$this->session->userdata('IdEmpleado')
           );

        log_message('debug', '[CitaServicio.agergarEvento] Guardando Evento IdPaciente:'.$param['IdPaciente']);
        $query =  $this->db->insert($this->table, $campos);
        log_message('debug', '[CitaServicio.agergarEvento] Resultado Evento:'.$query);
        return $query;

    }

    //AUTOR 'Carlos Esquivel' -- eliminar cita
	public function deleteEvento($id){
		$this->db->where('IdCitaServicio', $id);
		return $this->db->delete($this->table);
	}

        //AUTOR 'Carlos Esquivel' -- actualizar cita
	public function ActualizarCita($param){
		$campos = array(

                    'IdEmpleado'=> $param['IdEmpleado'],
                    'FechaInicio'=>$param['FechaInicio'],
                    'FechaFin'=>$param['FechaFin'],
                    'Comentarios'=>$param['Comentarios'],
                    'TituloCita'=>$param['TituloCita']

                    );

		$this->db->where('IdCitaServicio',$param['IdCitaServicio']);
		$this->db->update($this->table,$campos);

		if ($this->db->affected_rows() == 1) {
			return 1;
		}else{
                    if($this->db->error()!="")
                    {
                        log_message('Error', $this->db->error());
                        throw new Exception($this->db->error('error'));
                    }
			return 0;
		}
	}

        public function ConsultasTotalCitasDia()
        {
            $this->db->select('COUNT(IdCitaServicio) as TotalCitas');
            $this->db->from($this->table);
            $this->db->where('FechaInicio >=',mdate('%Y-%m-%d 00:00:00',now()));
            $this->db->where('FechaInicio <=',mdate('%Y-%m-%d 23:59:59',now()));
            $this->db->where('IdStatusCita <',4);

            $query = $this->db->get();
            return $query->row();
        }


}
