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
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url_helper');
        
        $this->load->model('CitaServicio_Model');
        $this->load->model('Paciente_Model');
        $this->load->model('Servicio_Model');
        $this->load->model('Empleado_Model');
        $this->load->helper('date');
        
    }
    
    public function index(){
        $data['title']="Agenda Servicios";


        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
//        //$this->load->view('Agenda/VistaAgenda');
        $this->load->view('Agenda/CardAgenda',$data);
        $this->load->view('templates/FooterContainer');
//        $this->load->view('Agenda/VistaAgenda');

              
	}
        
        public function CargarAgenda()
        {
            $this->load->view('Agenda/VistaAgenda');
        }
        
    public function getEventos()
    {
        //f($this->input->post('servicio_id'))
        $IdServicio =$this->input->post('IdServicio');
            
        if ($IdServicio == "*")
        {
            $r= $this->CitaServicio_Model->ConsultarCitasPorServicio();
        }
        else
        {
            $r= $this->CitaServicio_Model->ConsultarCitasPorServicio($IdServicio);
        }
        //$this->load->Model('CitaServicio_Model');

        
            //$r = $this->Mcalendar->getEventos();
            echo json_encode($r);
    }
    
//    public function updEvento()
//    {
//        $param['IdCitaServicio'] = $this->input->post('id');
//        $param['DiaCita'] = $this->input->post('DiaCita');
//        $param['MesCita'] = $this->input->post('MesCita');
//        $param['AnioCita'] = $this->input->post('AnioCita');
//        $param['HoraCita'] = $this->input->post('HoraCita');
//        $param['Comentarios'] = $this->input->post('Comentarios');
//
//        $r = $this->CitaServicio_Model->updEvento($param);
//
//        echo $r;
//    }
    
    //Autor: Carlos Esquivel
    public function agregarEvento()
    {
        try
        {
            $param['IdPaciente'] = $this->input->post('IdPaciente');
            $param['IdServicio'] = $this->input->post('IdServicio');
            $param['DiaCita'] = $this->input->post('DiaCita');
            $param['MesCita'] = $this->input->post('MesCita');
            $param['AnioCita'] = $this->input->post('AnioCita');
            $param['HoraCita'] = $this->input->post('HoraCita');
            $param['IdStatusCita'] = $this->input->post('IdStatusCita');
            $param['IdEmpleado'] = $this->input->post('IdEmpleado');
            $param['Comentarios'] = $this->input->post('Comentarios');
            $param['IdClinica'] = $this->session->userdata('IdClinica');



            $r = $this->CitaServicio_Model->agregarEvento($param);
            echo $r;

        } catch (Exception $ex) {
            echo 2;
        }
        
    }
    
    /*
     * Descripcion: Función que devuelve todas las citas del día actual
     */
    public function CitasDeHoy()
    {
        $Fecha = now();
        
        $IdPerfil =$this->session->userdata('IdPerfil');
        $IdEmpleado = $this->session->userdata('IdEmpleado');
    
        if ($IdPerfil==MEDICO)
        {
             $data['Citas'] = $this->CitaServicio_Model->ConsultarCitasPorDia($Fecha,FALSE,$IdEmpleado);

        }
        else
        {
            $data['Citas'] = $this->CitaServicio_Model->ConsultarCitasPorDia($Fecha);
        }
        

        
        if (empty($data['Citas']))
        {
            $data['infoMessage'] ='No existen citas para: '.mdate('%d',$Fecha).'/'.mdate('%M', $Fecha);
            
        }
        $data['title']= 'Citas del día';
        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('Agenda/ListaAgendaHoy',$data);
        $this->load->view('templates/FooterContainer');

        
        
       
        
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
    
    public function Load_ConfirmarCita($IdCita)
    {
        $Cita = $this->CitaServicio_Model->ConsultarCitaPorId($IdCita);
        $Paciente = $this->Paciente_Model->ConsultarPacientePorId($Cita->IdPaciente);
        
        $data['Paciente'] = $Paciente;
        $data['Cita']= $Cita;
        $data['title']='Confirmar Cita';
        $data['PacienteSubmitAction'] = 'confirmar';
        $data['PacienteActionsEnabled'] = true;
        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('Agenda/FormConfirmarCita',$data);
        $this->load->view('Paciente/PacienteCard',$data);
        $this->load->view('templates/FormFooter',$data);
        $this->load->view('templates/FooterContainer');
    }
       
    /*
     * Descripcion: Funcion que Carga Vista para confirmar cita 
     */
    public function ConfirmarCita($IdCita)
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
                    'NumCelular' => $this->input->post('Celular'),
                    'email'=> $this->input->post('email')
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
        public function getServiciosAgenda(){
            $resultado = $this->Servicio_Model->getServiciosAgenda();
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
            
            try
            {
                $param['IdCitaServicio'] = $this->input->post('IdCitaServicio');
                $param['HoraCita'] = $this->input->post('HoraCita');
                $param['MesCita'] = $this->input->post('MesCita');
                $param['AnioCita'] = $this->input->post('AnioCita');
                $param['DiaCita'] = $this->input->post('DiaCita');
                $param['IdEmpleado'] = $this->input->post('IdEmpleado');
                $param['Comentarios'] = $this->input->post('Comentarios');

                $Cita = $this->CitaServicio_Model->ConsultarCitaPorId($this->input->post('IdCitaServicio'));

                if ($Cita->IdStatusCita== CONFIRMADA || $Cita->IdStatusCita == REGISTRADA)
                {
                    echo 2;
                }
                else
                {
                    $r = $this->CitaServicio_Model->ActualizarCita($param);

                    echo $r;

                }
                
            } catch (Exception $ex) {
                echo 3;
                

            }
            
           
            
        }
        
        //Cargar Medicos por servicio seleccionado
        //Parametros metodo POST
        public function ConsultarMediciosServicio()
        {
            $IdServicio = $this->input->post('IdServicio');
            
            if ($IdServicio !== null)
            {
                $Medicos = $this->Empleado_Model->ConsultarMedicosPorServicio($IdServicio);
                $output='<option value="">Selecciona un Medico</option>';
                foreach($Medicos as $Medico)
                {
                     $output .= '<option value="'.$Medico['IdEmpleado'].'">'.$Medico['Nombre'].'</option>';
                }
            }
            echo $output;   
            
        }
    
}
