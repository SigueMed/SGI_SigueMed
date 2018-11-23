<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
/**
 * Description of Agenda_Controler
 *
 * @author SigueMed
 */
class Agenda_Controler extends CI_Controller 
{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('CitaServicio_Model');
        $this->load->model('Paciente_Model');
        $this->load->helper('date');
        
        
    }
    
    public function index(){
		$this->load->view('Agenda/VistaAgenda');
	}
        
    public function getEventos()
    {
            
        $this->load->Model('CitaServicio_Model');

        $r= $this->CitaServicio_Model->ConsultarCitasPorServicio(1);
            //$r = $this->Mcalendar->getEventos();
            echo json_encode($r);
    }
    
    public function updEvento()
    {
        $param['id'] = $this->input->post('id');
        $fdate = human_to_unix($this->input->post('fecini'));
        $param['fecini'] = $fdate;
        $param['fecfin'] = $this->input->post('fecfin');

        $r = $this->CitaServicio_Model->updEvento($param);

        echo $r;
    }
    
     public function agregarEvento()
    {
         
        $dia = mdate('%d',$this->input->post('fecini'));
        $mes = mdate('%m',$this->input->post('fecini'));
        $anio = mdate('%Y',$this->input->post('fecini'));
        $hora = mdate('%h:%i', $this->input->post('fecini'));
        
        $param['idPaciente'] = $this->input->post('idPaciente');
        $param['DiaCita'] = $dia;
        $param['MesCita'] = $mes;
        $param['AnioCita'] = $anio;
        $param['Hora'] = $hora;
//	$param['fecfin'] = $this->input->post('fecfin');
//        $param['web'] = $this->input->post('web');
        
        
        $r = $this->Mcalendar->agregarEvento($param);
        echo $r;
    }
    
    /*
     * Función que devuelve todas las citas con estatus de Agendadas
     */
    public function CitasDeHoy()
    {
        $Fecha = now();
        
        $data['Citas'] = $this->CitaServicio_Model->ConsultarCitasPorDia($Fecha);
        
        if (empty($data['Citas']))
        {
            $data['errorMessage'] ='No existen citas para: '.mdate('%d',$Fecha).'/'.mdate('%M', $Fecha);
            
        }
        $this->load->view('templates/headerMenu');
        $this->load->view('Agenda/ListaAgendaHoy',$data);
        
       
        
    }
    
    /*
     * Función para consultar todas las citas YA confirmadas de un servicio especifico
     */
    public function CitasConfirmadasPorServicio($IdServicio)
    {
         $Fecha = now();
        
        $data['Citas'] = $this->CitaServicio_Model->ConsultarCitasPorDiaPorServicio($Fecha,$IdServicio,1);
        
        if (empty($data['Citas']))
        {
            $data['errorMessage'] ='No existen citas para: '.mdate('%d',$Fecha).'/'.mdate('%M', $Fecha);
            $this->load->view('Agenda/Agenda',$data);
        }
        else
        {

            $this->load->view('Agenda/ListaAgendaHoy',$data);
        }
        
        
    }
    
    
    public function CargarAgendaServicio($IdServicio){
        $this->load->model('CitaServicio_Model');
        $data ['Citas']= $this->CitaServicio_Model->ConsultarCitasPormes($IdServicio);
        
        } 
    /*
     * Funcion que Carga Vista para confirmar cita 
     */
    public function ConfirmarCita($IdCita)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Nombre', 'nombre', 'required');
        $this->form_validation->set_rules('Apellidos', 'apellidos', 'required');
        $this->form_validation->set_rules('FechaNacimiento', 'Fecha de Nacimiento', 'required');
        

        if ($this->form_validation->run() === FALSE)
        {
            $Cita = $this->CitaServicio_Model->ConsultarCitaPorId($IdCita);
            if (isset($Cita))
            {
                $Paciente = $this->Paciente_Model->ConsultarPacientePorId($Cita->IdPaciente);

                if(isset($Paciente))
                {
                    $data['Paciente'] = $Paciente;
                    $data['Cita']= $Cita;
                    $this->load->view('Agenda/ConfirmarCita',$data);
                }
            }
            else
            {
                //TODO: Manejo de error cuando el paciente de la cita no existe
            }
 
    
        }
        else
        { 
            $action = $this->input->post('action');
            
            if ($action =='confirmar')
            {
                
                //Actualizar Paciente
                $Cita = $this->CitaServicio_Model->ConsultarCitaPorId($IdCita);
                if (isset($Cita))
                {
                    $Paciente = $this->Paciente_Model->ConsultarPacientePorId($Cita->IdPaciente);
                
                    $PacienteUpdt = array(
                        'Nombre'=>$this->input->post('Nombre'),
                        'Apellidos' => $this->input->post('Apellidos'),
                        'FechaNacimiento' => $this->input->post('FechaNacimiento'),
                        'Calle' => $this->input->post('Calle'),
                        'Colonia' => $this->input->post('Colonia'),
                        'CP' => $this->input->post('CP'),
                        'ViveCon' => $this->input->post('ViveCon'),
                        'Escolaridad' => $this->input->post('Escolaridad'),
                        'NumCelular' => $this->input->post('Celular')
                        );
                
                    $this->Paciente_Model->ActualizarPaciente($Paciente->IdPaciente, $PacienteUpdt);
                }
                
                //Confirmar Cita
                $this->CitaServicio_Model->ConfirmarCita($IdCita);
            }
            if($action=='cancelar')
            {
                //CancelarCita
                $this->CitaServicio_Model->CancelarCita($IdCita);
                
            }
            $this->CitasDeHoy();
           
        }
        
    }
    
    public function CitasAtendidas()
    {
        $Fecha = now();
        
        $data['Citas'] = $this->CitaServicio_Model->ConsultarCitasPorDia($Fecha,ATENDIDA);
        
        if (empty($data['Citas']))
        {
            $data['errorMessage'] ='No existen citas para: '.mdate('%d',$Fecha).'/'.mdate('%M', $Fecha);
            
        }
        $this->load->view('templates/headerMenu');
        $this->load->view('Agenda/CitasAtendidas',$data);
        
       
        
    }
    
}
