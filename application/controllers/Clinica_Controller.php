<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Clinica_Controller
 *
 * @author SigueMED
 */
class Clinica_Controller extends CI_Controller{    
    
    public function __construct() {
        
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        $this->load->Model('Clinica_Model');
    }
    
    public function Cargar_SeleccionarClinica()
    {
        $this->load->view('Clinica/SeleccionarClinica');
    }
    
    public function ConsultarClinicasEmpleado()
    {
        $IdEmpleado = $this->input->post('IdEmpleado');
        
        $Clinicas = $this->Clinica_Model->ConsultarClinicasEmpleado($IdEmpleado);
        
        $output='<option value="*">Selecciona una Clínica</option>';
            foreach($Clinicas as $clinica)
            {
                $output .= '<option value="'.$clinica['IdClinica'].'">'.$clinica['NombreClinica'].'</option>';
            }
            echo $output;
        
    }
    
    public function SeleccionarClinica()
    {
        
        
        $Clinica = $this->input->post('Clinicas');
        
        if ($Clinica!== "*")
        {
             if ($this->session->has_userdata('IdClinica'))
            {
                $this->session->unset_userdata('IdClinica');
                $this->session->unset_userdata('DescripcionClinica');

            }

            $this->session->set_userdata('IdClinica', $Clinica);
            
            $DetalleClinica = $this->Clinica_Model->ConsultarClinicaPorId($Clinica);
            echo '<script> alert("'.$DetalleClinica->NombreClinica.');</script>';
            $this->session->set_userdata('DescripcionClinica',$DetalleClinica->NombreClinica);

            $data['title'] = 'SGI-Siguemed';
            $this->load->view('templates/MainContainer', $data);
            $this->load->view('templates/FooterContainer');
        }
        
        else
        {
            echo "<script>alert('Debe de seleccionar una Clínica para continuar');</script>";
            $this->load->view('Clinica/SeleccionarClinica');
        }
            
        
        
    }
    //put your code here
}
