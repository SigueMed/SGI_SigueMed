<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta_ControllerPersona extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Cuenta_Model');
    //Codeigniter : Write Less Do More
  }

  public function Load_AgregarNuevaCuenta()
  {
    $data['title']='Agregar Nueva Cuenta';

    $this->load->view('templates/MainContainer',$data);
    $this->load->view('templates/HeaderContainer',$data);
    $this->load->view('Cuenta/CardNuevaCuenta',$data);
    $this->load->view('templates/FormFooter',$data);
    $this->load->view('templates/FooterContainer');

  }
  public function AgregarNuevaCuenta()
  {

    $Descripcion = $this->input->post('DescripcionCuenta');
    $IdEmpleado = $this->input->post('IdEmpleado');
    $habilitado = $this->input->post('Habilitado');
    $CorteCaja = $this->input->post('CorteCaja');
    $CuentaMaestra = $this->input->post('CuentaMaestra');



    $NuevaCuenta = array(
      'DescripcionCuenta'=>$Descripcion,
      'IdEmpleado'=>$IdEmpleado,

      'Habilitado'=> ($habilitado=='on' ? 1:0),
      'CorteCaja'=> ($CorteCaja=='on' ? 1:0),
      'CuentaMaestra' => ($CuentaMaestra=='on' ? 1:0)

    );

    $this->load->model('Cuenta_Model');

    if (($IdEmpleado)==FALSE)
    {
      die(json_encode(['error'=>TRUE,'message'=>'No se selecciono a un empleado']));
    }

    if ($CuentaMaestra=='on')
    {
      $result = $this->Cuenta_Model->ConsultarCuentaMaestra();
      if (($result)>=1){
        die(json_encode(['error'=>TRUE,'message'=>'Ya existe una cuenta Maestra']));
      }
    }
    else {
      // code...

          $result = $this->Cuenta_Model->AgregarNuevaCuenta($NuevaCuenta);

          if ($result==TRUE)
          {
            die(json_encode(['error'=>FALSE,'message'=>'Se registro la cuenta con el id: '.$result]));
          }
          else {

            die(json_encode(['error'=>TRUE,'message'=>'Esta cuenta ya existe']));
            // code...
          }
    }
  }

  // CATALOGO Cuentas
  public function Load_ConsultarCuentas()
  {
    $data['title']='Cuentas';

    $this->load->view('templates/MainContainer',$data);
    $this->load->view('templates/HeaderContainer',$data);
    $this->load->view('Cuenta/CardConsultaCuenta',$data);
    $this->load->view('templates/FormFooter',$data);
    $this->load->view('templates/FooterContainer');
  }

  public function ConsultarCatalogoCuentas_ajax()
  {
    $CatalogoCuentas = $this->Cuenta_Model->ConsultarTodasCuentas();

   echo json_encode($CatalogoCuentas);
    // code...
  }

  public function ConsultarEmpleadosCuenta_ajax()
  {

    $IdCuenta = $this->input->post('IdEmpleado');

    $ClinicasCuenta = $this->Cuenta_Model->ConsultarEmpleadosCuenta($IdEmpleado);

    echo json_encode($ClinicasCuenta);
    // code...
  }

  public function CargarCatalogoEmpleadosCuenta_ajax()
  {

    $IdCuenta = $this->input->post('IdEmpleado');

    $ClinicasCuenta = $this->Cuenta_Model->CatalogoEmpledosCuenta($IdEmpleado);

    echo json_encode($EmpleadosCuenta);
    // code...
  }


  public function ConsultarCuentaPorId()
  {
    $IdCuenta = $this->input->post('IdCuenta');

    $Cuenta = $this->Cuenta_Model->ConsultarCuentaPorId($IdCuenta);


    echo json_encode($Cuenta);
  }

  public function ActualizarCuenta_ajax()
  {

    $ActualizarCuenta = array(
      //'IdCuenta'=>$this->input->post('IdCuenta'),
      'DescripcionCuenta'=> $this->input->post('DescripcionCuenta'),
      'IdEmpleado'=>$this->input->post('IdEmpleado'),

      'Habilitado'=>$this->input->post('Habilitado'),
      'CorteCaja'=>$this->input->post('CorteCaja'),
      'CuentaMaestra' =>$this->input->post('CuentaMaestra')
    );

    if ($this->input->post('CuentaMaestra')=='1')
    {
      $result = $this->Cuenta_Model->ConsultarCuentaMaestra();
      if (($result)>=1){
        die(json_encode(['error'=>TRUE,'message'=>'Ya existe una cuenta Maestra']));
      }
    }


    if ($this->input->post('CuentaMaestra')!== '')
    {
      $ActualizarCuenta['CuentaMaestra']= $this->input->post('CuentaMaestra');
    }
    else {
      $ActualizarCuenta['CuentaMaestra']= 0;
    }

    $IdCuenta = $this->input->post('IdCuenta');

    $EmpleadosCuenta = $this->input->post('IdEmpleado');

    $this->Cuenta_Model->EditarCuenta($IdCuenta,$ActualizarCuenta);

    // code...
  }



}
