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
    
        public function CrearNotaRemision($IdNotaMedica = FALSE){
        
            if ($IdNotaMedica) // crear una nota de remisión a partir de una cita
            {
                $NotaMedica = $this->NotaMedica_Model->ConsultarNotaMedicaPorId($IdNotaMedica);
                $data['NotaMedica'] = $NotaMedica;
                $data['Paciente'] = $this->Paciente_Model->ConsultarPacientePorId($NotaMedica->IdPaciente);
                
                $data['ProductosNotaMedica'] = $this->ProductosNotaMedica_Model->ConsultarProductosPorNotaMedica($IdNotaMedica);
            }
            else
            {
            
            }
            
        $this->form_validation->set_rules('FR', 'FR', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('NotaRemision/CrearNota', $data); 
        }
        
    } 
}