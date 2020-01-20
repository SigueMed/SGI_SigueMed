<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
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

}
