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
        $this->load->model('Servicio_Model');
        $this->load->helper('date');
        
    }
    
    public function index(){
        $this->load->view('templates/headerMenu');
		$this->load->view('Agenda/VistaAgenda');
	}
        
    public function getEventos()
    {
        //f($this->input->post('servicio_id'))
        $IdServicio =$this->input->post('IdServicio');
            
        //$this->load->Model('CitaServicio_Model');

        $r= $this->CitaServicio_Model->ConsultarCitasPorServicio($IdServicio);
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
    
    //Autor: Carlos Esquivel
    public function agregarEvento()
    {

//        $dia = mdate('%d',$this->input->post('fecini'));
//        $mes = mdate('%m',$this->input->post('fecini'));
//        $anio = mdate('%Y',$this->input->post('fecini'));
//        $hora = mdate('%h:%i', $this->input->post('fecini'));
        
        $param['IdPaciente'] = $this->input->post('IdPaciente');
        $param['IdServicio'] = $this->input->post('IdServicio');
        $param['DiaCita'] = $this->input->post('DiaCita');
        $param['MesCita'] = $this->input->post('MesCita');
        $param['AnioCita'] = $this->input->post('AnioCita');
        $param['HoraCita'] = $this->input->post('HoraCita');
        $param['IdStatusCita'] = $this->input->post('IdStatusCita');
//	$param['fecfin'] = $this->input->post('fecfin');
//        $param['web'] = $this->input->post('web');


        $r = $this->CitaServicio_Model->agregarEvento($param);
        echo $r;
    }
    
    /*
     * Descripcion: Función que devuelve todas las citas del día actual
     */
    public function CitasDeHoy()
    {
        $Fecha = now();
        
        $data['Citas'] = $this->CitaServicio_Model->ConsultarCitasPorDia($Fecha);
        
        if (empty($data['Citas']))
        {
            $data['infoMessage'] ='No existen citas para: '.mdate('%d',$Fecha).'/'.mdate('%M', $Fecha);
            
        }
        $data['title']= 'Citas del día';
        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('Agenda/ListaAgendaHoy',$data);
        $this->load->view('templates/footer');

        
        
       
        
    }
    
    /*
     * Descripcion: Función para consultar todas las citas YA confirmadas de un servicio especifico
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
    
    
       
    /*
     * Descripcion: Funcion que Carga Vista para confirmar cita 
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
                    $data['title']='Confirmar Cita';
                    $this->load->view('templates/MainContainer',$data);
                    $this->load->view('templates/HeaderContainer',$data);
                    $this->load->view('Agenda/ConfirmarCita',$data);
                    $this->load->view('templates/footer');

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
                    //$Paciente = $this->Paciente_Model->ConsultarPacientePorId($Cita->IdPaciente);
                
                    $PacienteUpdt = array(
                        'Nombre'=>$this->input->post('Nombre'),
                        'Apellidos' => $this->input->post('Apellidos'),
                        'FechaNacimiento' => $this->input->post('FechaNacimiento'),
                        'Calle' => $this->input->post('Calle'),
                        'Colonia' => $this->input->post('Colonia'),
                        'CP' => $this->input->post('CP'),
                        'ViveCon' => $this->input->post('ViveCon'),
                        'Escolaridad' => $this->input->post('Escolaridad'),
                        'EstadoCivil' => $this->input->post('EstadoCivil'),
                        'NumCelular' => $this->input->post('Celular')
                        );
                
                    $this->Paciente_Model->ActualizarPaciente($Cita->IdPaciente, $PacienteUpdt);
                }
                
                //Confirmar Cita
                $this->CitaServicio_Model->ActualizarEstatusCita($IdCita,CONFIRMADA);
            }
            if($action=='cancelar')
            {
                //CancelarCita
                $this->CitaServicio_Model->ActualizarEstatusCita($IdCita, CANCELADA);
                
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

    //------------------
    
    
        //AUTOR 'Carlos Esquivel' -- muestra los servicios en el dropdown
        public function getServiciosClinica(){
            $resultado = $this->Servicio_Model->getServiciosClinica();
            echo json_encode($resultado);
        }
        
        
       //AUTOR 'Carlos Esquivel' -- muestra el nombre del paciente aucomcompletenado el input (no usa modelo)
       public function autocompleteNombre(){
           $resultado = $this->db->get('paciente');
           echo json_encode($resultado->result());
       }
       
   
       //AUTOR 'Carlos Esquivel' -- agrega nuevo paciente si este no existe
       public function agregarNuevoPaciente(){

            $param['nombre'] = $this->input->post('nombre');
            $param['apellido'] = $this->input->post('apellido');
            $param['telefono'] = $this->input->post('telefono');
            
            
            $r = $this->Paciente_Model->agregarNuevoPaciente($param);
            if($r == 1){
                $row = $this->Paciente_Model->consultarIdNuevoPaciente($param);
            echo $row->IdPaciente;
            
            }else{
            echo 0;
            }
       }

       //AUTOR 'Carlos Esquivel' -- Borra cita
        public function deleteEvento(){
            $id = $this->input->post('id');
            $r = $this->CitaServicio_Model->deleteEvento($id);
            echo $r;
        }
        //AUTOR 'Carlos Esquivel'
        public function ActualizarCita(){
            $param['IdCitaServicio'] = $this->input->post('IdCitaServicio');
            $param['IdPaciente'] = $this->input->post('IdPaciente');
            $param['HoraCita'] = $this->input->post('HoraCita');

            $r = $this->CitaServicio_Model->ActualizarCita($param);

            echo $r;
        }
    
}
