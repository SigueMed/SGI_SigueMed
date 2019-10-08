<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_Controller
 *
 * @author SigueMed
 */

require_once(dirname(__FILE__)."/Agenda_Controler.php");

class Login_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->model('Empleado_Model');
        $this->load->model('FuncionesPerfil_Model');


    }

    public function Cargar_Login($logout=FALSE)
    {
        if($this->session->has_userdata('logged_in'))
            {
//                $data['title'] = "SGI - SigueMED";
//                $this->load->view('templates/MainContainer', $data);
//                $this->load->view('templates/FooterContainer');

                redirect(site_url('Dashboard/Main'));

            }
            else
            {
                if ($logout!== TRUE)
                {
                    $this->load->view('Login/login_form');

                }
                else
                {
                    session_destroy();
                    $data['logout_message'] = "Sesión Cerrada exitosamente";
                    $this->load->view('Login/login_form', $data);
                }

            }
    }

    public function ValidarLogin()
    {

             $Usr = $this->input->post('username');
             $Contrasena = $this->input->post('password');

             //Validar el usuario y contraseña
             $Usuario = $this->Empleado_Model->ValidarUsuarioContrasena($Usr,$Contrasena);
             //$ClinicasUsuario =

             if ($Usuario==TRUE)
             {//El usuario y contrasena son correctos

                 //Cargar funciones del perfil
                 //$MenuPerfil = $this->FuncionesPerfil_Model->ConsultarFuncionesPorPerfil($Usuario->IdPerfil);
                 $IdTurno = $this->CalcularTurno();
                 $SessionData = array(
                     'IdEmpleado'=>$Usuario->IdEmpleado,
                     'NombreUsuario'=>$Usuario->NombreEmpleado.' '.$Usuario->ApellidosEmpleado,
                     'IdPerfil'=>$Usuario->IdPerfil,
                     'DescripcionPerfil'=>$Usuario->DescripcionPerfil,
                     'IdServicio'=>$Usuario->IdServicio,
                     'logged_in'=>TRUE,
                     'IdTurno'=>$IdTurno,
                     'Turno'=>$this->DescripcionTurno($IdTurno)
                 );

                 //Establecer Sesion del usuario
                 $this->session->set_userdata($SessionData);

                $this->load->view('Clinica/SeleccionarClinica');

             }
             else
             {
                $data['errorMessage'] = 'Usuario y/o Contraseña Incorrectos';


                $this->load->view('Login/login_form', $data);
             }


        }

        public function CerrarSesion()
        {
            $this->session->unset_userdata('logged_in','IdUsuario');

            $this->Cargar_Login(TRUE);
        }

        public function CalcularTurno()
        {
            $Fecha = now();
            $dia = date('w', strtotime($Fecha));
            $hora_t= mdate('%h',$Fecha);
            $timeFormat = mdate('%a',$Fecha);

            if ($timeFormat =='pm')
            {
                $hora = intval($hora_t) + 12;
            }
            else
            {
                $hora = intval($hora_t);
                if ($hora >=12)
                {
                    $hora = 0;
                }
            }


            if($dia==6 || $dia==0)
            {
                return JORNADA;
            }
            else if($hora>=0 && $hora <7)
            {
                return NOCTURNO;
            }
            else if($hora >= 7&& $hora <14)
            {
                return MATUTINO;
            }
            else if($hora >=14 && $hora < 21)
            {
                return VESPERTINO;
            }
            else if ($hora >= 21)
            {
                return NOCTURNO;
            }

        }
        public function DescripcionTurno($IdTurno)
        {
            switch ($IdTurno)
            {
                case MATUTINO:
                    return "MATUTINO";

                case VESPERTINO:
                    return "VESPERTINO";

                case NOCTURNO:
                    return "NOCTURNO";

                case JORNADA:
                    return "JORNADA";


            }
        }
    }
