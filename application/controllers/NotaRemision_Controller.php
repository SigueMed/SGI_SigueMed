<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NotaRemision_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        //Cargar herramientas para form
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url_helper');
         //Cargar Modelos usados por el Controlador para el manejo de las Notas de remision
        $this->load->model('NotaMedica_Model');
        $this->load->model('Paciente_Model');
        $this->load->model('ProductosNotaMedica_Model');
        $this->load->model('NotaRemision_Model');
        
    }
    
        public function CrearNotaRemision(){
        $this->load->model('NotaRemision_Model');
        $data ['Nota'] = $this->NotaRemision_Model->CrearNotaDeRemision();
        $this->form_validation->set_rules('FR', 'FR', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('NotaRemision/CrearNota', $data); 
        }
        
    } 
}