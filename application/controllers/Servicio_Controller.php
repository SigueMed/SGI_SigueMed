<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Servicio_Model');
    //Codeigniter : Write Less Do More
  }
  //Autor: Ricardo
  //* Se Agrego El Load_AgregarNuevoServicio junto con else
  // AgregarNuevoServicio con el array para poder darlo de alta

  public function Load_AgregarNuevoServicio()
  {
    $data['title']='Agregar Nuevo Servicio';

    $this->load->view('templates/MainContainer',$data);
    $this->load->view('templates/HeaderContainer',$data);
    $this->load->view('Servicio/CardNuevoServicio',$data);
    $this->load->view('templates/FormFooter',$data);
    $this->load->view('templates/FooterContainer');

  }
  public function AgregarNuevoServicio()
  {
    $DescripcionServicio = $this->input->post('DescripcionServicio');
    $CodigoColorServicio = $this->input->post('CodigoColorServicio');
    $Habilitado = $this->input->post('ServicioHabilitado');
    $ManejoAgenda = $this->input->post('ManejoAgenda');
    $ManejoInventario = $this->input->post('ManejoInventario');
    $DiasSemana = $this->input->post('DiasSemana');
    $HoraFin = $this->input->post('HoraFin');
    $GrupoServicio = $this->input->post('cbGrupoServicio');
    $ClinicasServicio = $this->input->post('ClinicaServicio');
    //log_message('debug','$ClinicaServicio=>'.$ClinicasServicio);

    $NuevoServicio = array(
      'DescripcionServicio'=>$DescripcionServicio,
      'CodigoColorServicio'=>$CodigoColorServicio,
      'Habilitado'=> ($Habilitado=='on' ? 1:0),
      'ManejoAgenda'=>($ManejoAgenda=='on' ? 1:0),
      'ManejoInventario'=>($ManejoInventario=='on' ? 1:0),
      'DiasSemana'=>$DiasSemana,
      'HoraFin'=>$HoraFin,
      'IdGrupoServicio'=>($GrupoServicio=='' ? null: $GrupoServicio)
    );

    $this->load->model('Servicio_Model');

    if (isset($ClinicasServicio)==FALSE)
    {
      die(json_encode(['error'=>TRUE,'message'=>'No se selecciono una clinica al menos']));
    }

    $result = $this->Servicio_Model->AgregarNuevoServicio($NuevoServicio,$ClinicasServicio);
    //log_message('debug','Id Nuevo Servicio=>'.$result);
    if ($result!==false)
    {

      die(json_encode(['error'=>FALSE,'message'=>'Servicio Registrado Exitosamente con el Id:'.$result]));


    }
    else {

      die(json_encode(['error'=>TRUE,'message'=>'El servicio ya existe']));

      // code...
    }

    // code...
  }

  //CATALOGO Servicios 18/05/2021
  public function Load_ConsultarServicios()
  {
    $data['title']='Servicios';

    $this->load->view('templates/MainContainer',$data);
    $this->load->view('templates/HeaderContainer',$data);
    $this->load->view('Servicio/CardConsultaServicio',$data);
    $this->load->view('templates/FormFooter',$data);
    $this->load->view('templates/FooterContainer');
  }

  //AJAX
  //Añadio ConsultarCatalogoServicios
  public function ConsultarCatalogoServicios_ajax()
  {
    $CatalogoServicios = $this->Servicio_Model->ConsultarServicios();

    echo json_encode($CatalogoServicios);
    // code...
  }

  
  public function CargarCatalogoClinicasServicio_ajax()
  {

    $IdServicio = $this->input->post('IdServicio');

    $ClinicasServicio = $this->Servicio_Model->CatalogoClinicasServicio($IdServicio);

    echo json_encode($ClinicasServicio);
    // code...
  }


  //AÑADIO CONSULTAR ConsultarServicios_AJAX
  public function ConsultarServicios_ajax()
  {
      $this->load->model('Servicio_Model');

      $IdServicios = $this->Servicio_Model->ConsultarServicios(FALSE,TRUE);

      $output = "<option value=''>Selecciona un servicio</option>";
      foreach($Servicios as $servicio)
      {
          $output.='<option value="'.$servicio['IdServicio'].'" data-proveedor="'.$servicio['EsProveedor'].'">'.$servicio['DescripcionServicio'].'</option>';

      }

      echo $output;
  }

  public function ConsultarClinicasServicio_ajax()
  {

    $IdServicio = $this->input->post('IdServicio');

    $ClinicasServicio = $this->Servicio_Model->ConsultarClinicasServicio($IdServicio);

    echo json_encode($ClinicasServicio);
    // code...

  }
  public function ConsultarServicioPorId()
  {
    $IdServicio = $this->input->post('IdServicio');

    $Servicio = $this->Servicio_Model->ConsultarServicioPorId($IdServicio);

    echo json_encode($Servicio);
    // code...
  }

  ///CONSULTAR SERVICIOS HORARIO
  public function ConsultarHorarioServicioPorId()
  {
    $IdServicio = $this->input->post('IdServicio');

    $Servicio = $this->Servicio_Model->ConsultarHorarioServicioPorId($IdServicio);

    echo json_encode($Servicio);
    // code...
  }


  //
  ///ACTUALIZAR LOS SERVICIOS
  //
  public function ActualizarServicio_ajax()
  {
    
    $ActualizarServicio = array(
      'IdServicio'=>$this->input->post('IdServicio'),
      'DescripcionServicio'=>$this->input->post('DescripcionServicio'),
      'CodigoColorServicio'=> $this->input->post('CodigoColorServicio'),
      'ManejoAgenda'=>$this->input->post('ManejoAgenda'),
      'ManejoInventario'=>$this->input->post('ManejoInventario'),
      'IdGrupoServicio'=>$this->input->post('IdGrupoServicio'),
      'Habilitado'=>$this->input->post('Habilitado')

    );
    if ($this->input->post('IdServicio')!== '')
    {
      $ActualizarServicio['IdServicio']= $this->input->post('IdServicio');
    }
    else {
      $ActualizarServicio['IdServicio']= NULL;
    }

    $IdServicio = $this->input->post('IdServicio');


    $ClinicasServicio = $this->input->post('Clinicas');

    //log_message('debug','ClinicasServicio='.$ClinicasServicio);

    $this->Servicio_Model->EditarServicio($IdServicio,$ActualizarServicio);
    $result = $this->Servicio_Model->ActualizarClinicasServicio($IdServicio,$ClinicasServicio);
    // code...
  }
}
