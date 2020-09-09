<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Usuario_Model');
    //Codeigniter : Write Less Do More
  }

  public function Load_AgregarNuevoUsuario()
  {
    $data['title']='Agregar Nuevo Usuario';

    $this->load->view('templates/MainContainer',$data);
    $this->load->view('templates/HeaderContainer',$data);
    $this->load->view('Usuario/CardNuevoUsuario',$data);
    $this->load->view('templates/FormFooter',$data);
    $this->load->view('templates/FooterContainer');

  }
  public function AgregarNuevoUsuario()
  {
    $Nombre = $this->input->post('NombreUsuario');
    $Apellidos = $this->input->post('ApellidosUsuario');
    $usuario = $this->input->post('Usuario');
    $password = $this->input->post('Password');
    $servicio = $this->input->post('cbServicio');
    $perfil = $this->input->post('cbPerfil');
    $habilitado = $this->input->post('UsuarioHabilitado');
    $ClinicasUsuario = $this->input->post('ClinicaUsuario');

    $NuevoUsuario = array(
      'NombreEmpleado'=>$Nombre,
      'ApellidosEmpleado'=>$Apellidos,
      'IdServicio'=>($servicio=='' ? null: $servicio),
      'Habilitado'=> ($habilitado=='on' ? 1:0),
      'IdPerfil'=>$perfil,
      'usuario'=>$usuario,
      'password'=>$password
    );

    $this->load->model('Usuario_Model');

    if (isset($ClinicasUsuario)==FALSE)
    {
      die(json_encode(['error'=>TRUE,'message'=>'No se selecciono una clínica al menos']));
    }

    $result = $this->Usuario_Model->AgregarNuevoUsuario($NuevoUsuario,$ClinicasUsuario);

    if ($result!==false)
    {

      die(json_encode(['error'=>FALSE,'message'=>'Usuario Registrado Exitosamente con el Id:'.$result]));


    }
    else {

      die(json_encode(['error'=>TRUE,'message'=>'El usuario ya existe']));

      // code...
    }

    // code...
  }

  // CATALOGO Usuarios
  public function Load_ConsultarUsuarios()
  {
    $data['title']='Usuarios';

    $this->load->view('templates/MainContainer',$data);
    $this->load->view('templates/HeaderContainer',$data);
    $this->load->view('Usuario/CardConsultaUsuarios',$data);
    $this->load->view('templates/FormFooter',$data);
    $this->load->view('templates/FooterContainer');
  }

  public function ConsultarCatalogoUsuarios_ajax()
  {
    $CatalogoUsuarios = $this->Usuario_Model->ConsultarUsuarios();

    echo json_encode($CatalogoUsuarios);
    // code...
  }

  public function ConsultarClinicasUsuario_ajax()
  {

    $IdEmpleado = $this->input->post('IdUsuario');

    $ClinicasUsuario = $this->Usuario_Model->ConsultarClinicasUsuario($IdEmpleado);

    echo json_encode($ClinicasUsuario);
    // code...
  }

  public function CargarCatalogoClinicasUsuario_ajax()
  {

    $IdEmpleado = $this->input->post('IdUsuario');

    $ClinicasUsuario = $this->Usuario_Model->CatalogoClinicasUsuario($IdEmpleado);

    echo json_encode($ClinicasUsuario);
    // code...
  }


  public function ConsultarUsuarioPorId()
  {
    $IdEmpleado = $this->input->post('IdUsuario');

    $Usuario = $this->Usuario_Model->ConsultarUsuarioPorId($IdEmpleado);

    echo json_encode($Usuario);
  }

  public function ActualizarUsuario_ajax()
  {

    $ActualizarEmpleado = array(
      'NombreEmpleado'=>$this->input->post('NombreEmpleado'),
      'ApellidosEmpleado'=> $this->input->post('ApellidosEmpleado'),
      'TelefonoEmpleado'=>$this->input->post('TelefonoEmpleado'),
      'IdServicio'=>$this->input->post('IdServicio'),
      'IdPerfil'=>$this->input->post('IdPerfil'),
      'Habilitado'=>$this->input->post('Habilitado')

    );

    $IdEmpleado = $this->input->post('IdEmpleado');

    $ClinicasUsuario = $this->input->post('Clinicas');

    $this->Usuario_Model->EditarUsuario($IdEmpleado,$ActualizarEmpleado);
    $result = $this->Usuario_Model->ActualizarClinicasUsuario($IdEmpleado,$ClinicasUsuario);
    // code...
  }
  public function ActualizarContrasenaUsuario_ajax()
  {

    $ActualizarEmpleado = array(
      'password'=>$this->input->post('password')

    );

    $IdEmpleado = $this->input->post('IdEmpleado');



    return $this->Usuario_Model->EditarUsuario($IdEmpleado,$ActualizarEmpleado);

    // code...
  }

}
