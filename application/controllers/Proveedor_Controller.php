<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

    $this->load->helper('form');
   $this->load->library('form_validation');
   $this->load->helper('url_helper');
   $this->load->helper('date');
    //Codeigniter : Write Less Do More
  }

  public function Load_PagarProveedor()
  {
    $data['title'] = 'Pago a Proveedores';

    $this->load->view('templates/MainContainer',$data);
    $this->load->view('templates/HeaderContainer',$data);
    $this->load->view('Proveedor/CardPagoProveedor',$data);
    $this->load->view('templates/FooterContainer');


  }

  public function ConsultarMovimientosProveedorSinPagar_ajax()
  {

    $IdServicio = $this->input->post('IdServicio');

    $this->load->model('DetalleNotaRemision_Model');
    $MovimientosProveedor = $this->DetalleNotaRemision_Model->ConsultarMovimientosProveedorSinPagar($IdServicio);

    echo json_encode($MovimientosProveedor);

    // code...
  }

  public function ConsultarResumenTipoPagoProveedor_ajax()
  {

    $IdServicio = $this->input->post('IdServicio');

    $this->load->model('DetalleNotaRemision_Model');
    $MovimientosProveedor = $this->DetalleNotaRemision_Model->ConsultarResumenTipoPagoProveedor($IdServicio);

    echo json_encode($MovimientosProveedor);
    // code...
  }

  public function AplicarPagoProveedor()
  {
      $IdServicio = $this->input->post('cbServicioProveedor');
      $Comentarios = $this->input->post('ComentariosPago');
      $TotalPagoProveedor = $this->input->post('TotalPagoProveedor');

      $this->load->model('PagoProveedor_Model');
      $this->load->model('DetalleNotaRemision_Model');
      $NuevoPago_array = array(
        "IdServicio"=>$IdServicio,
        "FechaPagoProveedor"=> mdate('%Y-%m-%d',now()),
        "TotalPagoProveedor"=>$TotalPagoProveedor,
        "ComentariosPago"=>$Comentarios
      );

      $IdPagoProveedor = $this->PagoProveedor_Model->RegistrarPagoProveedor($NuevoPago_array);
      $this->DetalleNotaRemision_Model->AsignarPagoProveedor($IdServicio,$IdPagoProveedor);

    // code...
  }

  public function ConsultarTotalPagoProveedor_ajax()
  {

    $IdProveedor = $this->input->post('IdProveedor');
    $this->load->model('DetalleNotaRemision_Model');

    $TotalPagoProveedor = $this->DetalleNotaRemision_Model->ConsultarTotalPagoProveedor($IdProveedor);

    echo json_encode($TotalPagoProveedor->TotalPago);

    // code...
  }

}
