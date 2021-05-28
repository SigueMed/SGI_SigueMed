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
    //$IdCuenta = $this->input->post('IdCuenta');
    $Descripcion = $this->input->post('DescripcionCuenta');
    $IdEmpleado = $this->input->post('IdEmpleado');
    $habilitado = $this->input->post('Habilitado');
    $CorteCaja = $this->input->post('CorteCaja');
    $CuentaMaestra = $this->input->post('CuentaMaestra');

    log_message('debug','IdEmpleado='+$IdEmpleado);


    $NuevaCuenta = array(
      //'IdCuenta'=>$IdCuenta,
      'DescripcionCuenta'=>$Descripcion,
      'IdEmpleado'=>$IdEmpleado,


      'Habilitado'=> ($habilitado=='on' ? 1:0),
      'CorteCaja'=> ($CorteCaja=='on' ? 1:0),
      'CuentaMaestra' => ($CuentaMaestra=='on' ? 1:0)

    );

    $this->load->model('Cuenta_Model');

    if (isset($IdEmpleado)==FALSE)
    {
      die(json_encode(['error'=>TRUE,'message'=>'No se selecciono a un empleado']));
    }

    $result = $this->Cuenta_Model->AgregarNuevaCuenta($NuevaCuenta);

    if ($result!==false)
    {

      die(json_encode(['error'=>FALSE,'message'=>'Cuenta Registrada Exitosamente con el Id:'.$result]));


    }
    else {

      die(json_encode(['error'=>TRUE,'message'=>'Esta cuenta ya existe']));

      // code...
    }

    // code...
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
      'IdCuenta'=>$this->input->post('IdCuenta'),
      'DescripcionCuenta'=> $this->input->post('DescripcionCuenta'),
      'IdEmpleado'=>$this->input->post('IdEmpleado'),

      'Habilitado'=>$this->input->post('Habilitado'),
      'CorteCaja'=>$this->input->post('CorteCaja'),
      'CuentaMaestra' =>$this->input->post('CuentaMaestra')

    );

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
    //$result = $this->Cuenta_Model->ActualizarCuenta($IdCuenta,$EmpleadosCuenta);
    // code...
  }

  // public function ActualizarContrasenaUsuario_ajax()
  // {
  //
  //   $ActualizarEmpleado = array(
  //     'password'=>$this->input->post('password')
  //
  //   );
  //
  //   $IdEmpleado = $this->input->post('IdEmpleado');
  //
  //
  //
  //   return $this->Usuario_Model->EditarUsuario($IdEmpleado,$ActualizarEmpleado);
  //
  //   // code...
  // }

}
