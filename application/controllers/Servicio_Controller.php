<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }


  //AJAX

  public function ConsultarServicioPorId_ajax()
  {
    $IdServicio = $this->input->post('IdServicio');

    $this->load->model('Servicio_Model');

    $Servicio = $this->Servicio_Model->ConsultarServicioPorId($IdServicio);

    echo json_encode($Servicio);
    // code...
  }
}
