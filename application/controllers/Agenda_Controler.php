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

        if ($this->session->userdata('IdPerfil')==MEDICO)
        {
            $IdServicio = $this->session->userdata('IdServicio');
        }

        if ($IdServicio == "*")
        {
            $r= $this->CitaServicio_Model->ConsultarCitasPorServicio();
        }
        else
        {
            $r= $this->CitaServicio_Model->ConsultarCitasPorServicio($IdServicio);
        }
            echo json_encode($r);
    }


    //Autor: Carlos Esquivel
    public function agregarEvento()
    {
        try
        {
            $param['IdPaciente'] = $this->input->post('IdPaciente');
            $param['IdServicio'] = $this->input->post('IdServicio');
            $param['FechaInicio'] = $this->input->post('FechaInicio');
            $param['FechaFin'] = $this->input->post('FechaFin');

            $param['IdStatusCita'] = $this->input->post('IdStatusCita');
            $param['IdEmpleado'] = $this->input->post('IdEmpleado');
            $param['Comentarios'] = $this->input->post('Comentarios');
            $param['IdClinica'] = $this->session->userdata('IdClinica');



            $r = $this->CitaServicio_Model->agregarEvento($param);
            if ($r<1)
            {
                throw new Exception('No se ha agregado el evento');

            }
            echo $r;

        } catch (Exception $ex) {

            echo 0;
            log_message('error', '[Agenda_Controller.agregarEvento] Error:'.$ex->getMessage());
        }

    }

    /*
     * Descripcion: Función que devuelve todas las citas del día actual
     */
    public function Load_ConsultarCitas()
    {

        $data['title']= 'Citas';

        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('Agenda/ListaAgendaHoy',$data);
        $this->load->view('templates/FooterContainer');

    }

    public function ConsultarCitas()
    {
        $FechaInicio = $this->input->post('FechaInicio');
        $FechaFin = $this->input->post('FechaFin');
        $EstatusCita = $this->input->post('EstatusCita');
        $IdPerfil =$this->session->userdata('IdPerfil');
        $IdEmpleado = $this->session->userdata('IdEmpleado');

        if ($IdPerfil!=='3')
        {
            // Si es doctor consulta las citas agendadas al médico
             $IdEmpleado = FALSE;
        }

        $Citas = $this->CitaServicio_Model->ConsultarCitasPorDia($FechaInicio,$FechaFin,$EstatusCita,$IdEmpleado);

        echo json_encode($Citas);
        

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

        //botones paciente
        $data['PacienteActionsEnabled'] = false;


        //botones Cita
        $data['CitaSubmitAction'] = 'confirmar';
        $data['CitaActionsEnabled'] = true;
        $data['CitaSubmitTitle'] = 'Confirmar Cita';
        $data['CitaCancelActionEnabled'] = true;
        $data['CitaCancelAction'] = 'cancelar';
        $data['CitaCancelTitle'] = 'Cancelar Cita';


        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('Agenda/FormConfirmarCita',$data);
        $this->load->view('Paciente/PacienteCard',$data);
        $this->load->view('Agenda/CardCita',$data);
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


                $this->Paciente_Model->ActualizarPaciente_Post($Cita->IdPaciente);
            }

            //Confirmar Cita
            $Comentarios = $this->input->post('CitaComentarios');
            $this->CitaServicio_Model->ActualizarEstatusCita($IdCita,CONFIRMADA, $Comentarios);
        }
        if($action=='cancelar')
        {
            //CancelarCita
            $Comentarios = $this->input->post('CitaComentarios');

            $this->CitaServicio_Model->ActualizarEstatusCita($IdCita, CANCELADA,$Comentarios);

        }
            $this->Load_ConsultarCitas();

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
            $IdClinica = $this->session->userdata('IdClinica');

            if ($this->session->userdata('IdPerfil') ==MEDICO)
            {
                //$ServicioPerfil = $this->Empleado_Model->ConsultarEmpleadoPorId($this->session->userdata('IdEmpleado'));
                $resultado = $this->Servicio_Model->getServiciosAgenda($IdClinica,$this->session->userdata('IdServicio'));
            }
            else
            {
                $resultado = $this->Servicio_Model->getServiciosAgenda($IdClinica);
            }

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

            $paciente = $this->Paciente_Model->BuscarPacientePorNombre($param['nombre'], $param['apellido']);

            if ($paciente === false)
            {
                $r = $this->Paciente_Model->agregarNuevoPaciente($param);
                if($r == 1){
                    $row = $this->Paciente_Model->consultarIdNuevoPaciente($param);
                    echo json_encode($row);//$row->IdPaciente;

                    }
            }
            else
            {
                echo 2;
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
                $param['FechaInicio'] = $this->input->post('Inicio');
                $param['FechaFin'] = $this->input->post('Fin');

                $param['IdEmpleado'] = $this->input->post('IdEmpleado');
                $param['Comentarios'] = $this->input->post('Comentarios');

                $Cita = $this->CitaServicio_Model->ConsultarCitaPorId($this->input->post('IdCitaServicio'));

                if($Cita !== null)
                {

                    if ($Cita->IdStatusCita== CONFIRMADA || $Cita->IdStatusCita == REGISTRADA)
                    {
                        echo 2;
                    }
                    else
                    {
                        $r = $this->CitaServicio_Model->ActualizarCita($param);

                        echo 1;

                    }

                }
                else
                {
                    throw new Exception();
                }


            } catch (Exception $ex) {
                log_message('error', $ex->getMessage());
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
                $IdClinica = $this->session->userdata('IdClinica');
                $Medicos = $this->Empleado_Model->ConsultarMedicosPorServicio($IdServicio,$IdClinica);
                $output='<option value="">Selecciona un Medico</option>';
                foreach($Medicos as $Medico)
                {
                     $output .= '<option value="'.$Medico['IdEmpleado'].'">'.$Medico['Nombre'].'</option>';
                }
            }
            echo $output;

        }

        public function ConsultarTotalCitasDia_ajax()
        {
            $TotalCitas = $this->CitaServicio_Model->ConsultasTotalCitasDia();

            echo json_encode($TotalCitas);
        }

}
