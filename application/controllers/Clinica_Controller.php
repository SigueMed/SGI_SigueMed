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
            //echo '<script> alert(Bienvenido a "'.$DetalleClinica->NombreClinica.'");</script>';
            $this->session->set_userdata('DescripcionClinica',$DetalleClinica->NombreClinica);

            redirect(site_url('Dashboard/Main'));
        }

        else
        {
            echo "<script>alert('Debe de seleccionar una Clínica para continuar');</script>";
            $this->load->view('Clinica/SeleccionarClinica');
        }



    }

    public function Load_AgregarNuevaClinica()
    {
      $data['title']='Agregar Nueva Clinica';

      $this->load->view('templates/MainContainer',$data);
      $this->load->view('templates/HeaderContainer',$data);
      $this->load->view('Clinica/CardNuevaClinica',$data);
      $this->load->view('templates/FormFooter',$data);
      $this->load->view('templates/FooterContainer');

    }
    public function AgregarNuevaClinica()
    {
      $Nombre = $this->input->post('NombreClinica');
      $Direccion = $this->input->post('DireccionClinica');
      $Telefono = $this->input->post('TelefonoClinica');

      $NuevaClinica = array(
        'NombreClinica'=>$Nombre,
        'DireccionClinica'=>$Direccion,
        'TelefonoClinica'=>$Telefono

      );

      $this->load->model('Clinica_Model');

      $result = $this->Clinica_Model->AgregarNuevaClinica($NuevaClinica);

      if ($result!==false)
      {

        die(json_encode(['error'=>FALSE,'message'=>'Clinica Registrada Exitosamente con el Id:'.$result]));

      }
      else {

        die(json_encode(['error'=>TRUE,'message'=>'Esta Clinica ya existe']));

        // code...
      }

      // code...
    }

    public function Load_ConsultarClinicas()
    {
      $data['title']='Usuarios';

      $this->load->view('templates/MainContainer',$data);
      $this->load->view('templates/HeaderContainer',$data);
      $this->load->view('Clinica/CardConsultarClinicas',$data);
      $this->load->view('templates/FormFooter',$data);
      $this->load->view('templates/FooterContainer');
    }

    public function ConsultarCatalogoClinicas_ajax()
    {
      $CatalogoUsuarios = $this->Clinica_Model->ConsultarClinicas();

      echo json_encode($CatalogoUsuarios);
      // code...
    }

    //Consulta los datos de clinicas en segun el ID

    public function ConsultarClinicaPorId()
    {
      $IdClinica = $this->input->post('IdClinica');

      $Clinica = $this->Clinica_Model->ConsultarClinicaPorId($IdClinica);

      echo json_encode($Clinica);
    }

    //Actualizar Clinica
    public function ActualizarClinica_ajax()
    {

      $ActualizarClinica = array(
        'IdClinica'=>$this->input->post('IdClinica'),

        'NombreClinica'=>$this->input->post('NombreClinica'),
        'DireccionClinica'=> $this->input->post('DireccionClinica'),
        'TelefonoClinica'=>$this->input->post('TelefonoClinica'),

      );

      $IdClinica = $this->input->post('IdClinica');

      $this->Clinica_Model->EditarClinica($IdClinica,$ActualizarClinica);

      // code...
    }

    //put your code here
}
