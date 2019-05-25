<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExpedienteClinico_Controller
 *
 * @author SigueMED
 */
class ExpedienteClinico_Controller extends CI_Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Paciente_Model');
    }
    
    public function ConsultarExpedientePacientes()
    {
        $data['title']= 'Pacientes con Expediente Clínico';
        $perfil = $this->session->userdata('IdPerfil');
        $IdClinica = $this->session->userdata('IdClinica');
        if ($perfil==MEDICO)
        {
            $IdServicio = $this->session->userdata('IdServicio');
            $PacientesNotaMedica = $this->Paciente_Model->ConsultarPacientesConNotaMedica($IdClinica,$IdServicio);
        }
        else
        {
            $PacientesNotaMedica = $this->Paciente_Model->ConsultarPacientesConNotaMedica($IdClinica);
        }
        $data['PacientesExpediente']= $PacientesNotaMedica;
        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('ExpedienteClinico/ConsultaExpedienteClinico',$data);
        $this->load->view('templates/FooterContainer');
    }
    //put your code here
}
