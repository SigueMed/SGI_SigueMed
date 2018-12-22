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

        // Load form validation library
        $this->load->library('form_validation');
        
        $this->load->model('Usuario_Model');
        $this->load->model('FuncionesPerfil_Model');
        
        
    }
    
    public function ValidarLogin()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) 
        {
            if($this->session->has_userdata('logged_in'))
            {
                $this->load->view('templates/MainContainer');
                $this->load->view('templates/FooterContainer');
                
            }
            else
            {
                $this->load->view('Login/login_form');                
            }
        }
        else
        {
            $Usr = $this->input->post('username');
            $Contrasena = $this->input->post('password');
            
             $data = array(
            'usuario' => $this->input->post('username'),
            'contrasena' => $this->input->post('password')
            );
             
             //Validar el usuario y contraseña
             $Usuario = $this->Usuario_Model->ValidarUsuarioContrasena($Usr,$Contrasena);
             
             if ($Usuario==TRUE)
             {//El usuario y contrasena son correctos
                 
                 //Cargar funciones del perfil
                 $MenuPerfil = $this->FuncionesPerfil_Model->ConsultarFuncionesPorPerfil($Usuario->IdPerfil);
                 
                 $SessionData = array(
                     'IdUsuario'=>$Usuario->IdUsuario,
                     'NombreUsuario'=>$Usuario->NombreEmpleado.' '.$Usuario->ApellidosEmpleado,
                     'IdPerfil'=>$Usuario->IdPerfil,
                     'DescripcionPerfil'=>$Usuario->DescripcionPerfil,
                     'FuncionesPerfil'=>$MenuPerfil,
                     'logged_in'=>TRUE
                 );
                 
                 //Establecer Sesion del usuario
                 $this->session->set_userdata($SessionData);
                 $data['title'] = 'Clinica Siguemed';
                $this->load->view('templates/MainContainer', $data);
                $this->load->view('templates/FooterContainer');
                 
                         
                 
             }
             else
             {
                $data = array(
                'error_message' => 'Usuario y/o Contraseña Incorrectos'
                );
          
                $this->load->view('Login/login_form', $data);
             }
             
             
        }
    }
}
