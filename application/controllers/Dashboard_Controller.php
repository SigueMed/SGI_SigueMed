<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard_Controller
 *
 * @author SigueMED
 */
class Dashboard_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function Load_Dashboard()
    {
        $data['title'] = 'Tablero Principal';

        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);


        switch ($this->session->userdata('IdPerfil'))
        {
            case 1:
                $this->load->view('Dashboard/CardDashCaja');
                $this->load->view('Dashboard/CardDashPaciente');
                $this->load->view('Agenda/ListaAgendaHoy',$data);
                break;
            case 2:
                $this->load->view('Dashboard/CardDashCaja');
                $this->load->view('Dashboard/CardDashPaciente');
                $this->load->view('Agenda/ListaAgendaHoy',$data);
                break;
            case 3:
                break;
        }

        $this->load->view('templates/FooterContainer');

    }
    //put your code here
}
