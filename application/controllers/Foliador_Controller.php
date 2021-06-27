<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foliador_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Foliador_Model');
    //Codeigniter : Write Less Do More
  }

  public function Load_AgregarNuevoFoliador()
  {
    $data['title']='Foliadores';

    $this->load->view('templates/MainContainer',$data);
    $this->load->view('templates/HeaderContainer',$data);
    $this->load->view('Foliador/CardNuevoFoliador',$data);
    $this->load->view('templates/FormFooter',$data);
    $this->load->view('templates/FooterContainer');

  }

  public function AgregarNuevoFoliador()
  {
//
// $uploadedFile = '';
//     if(!empty($_FILES["ImagenTicket"]["type"])){
//         $ImagenTicket = time().'_'.$_FILES['ImagenTicket']['name'];
//         $valid_extensions = array("jpeg", "jpg", "png");
//         $temporary = explode(".", $_FILES["ImagenTicket"]["name"]);
//         $file_extension = end($temporary);
//         if((($_FILES["hard_file"]["type"] == "image/png") || ($_FILES["ImagenTicket"]["type"] == "image/jpg") || ($_FILES["ImagenTicket"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
//             $sourcePath = $_FILES['ImagenTicket']['tmp_name'];
//             $targetPath = "uploads/".$fileName;
//             if(move_uploaded_file($sourcePath,$targetPath)){
//                 $uploadedFile = $ImagenTicket;
//             }
//         }
//       }





    //





    $DescripionFoliador = $this->input->post('DescripcionFoliador');
    $ValorFolio = $this->input->post('ValorFolio');
    $ResponsableFolio = $this->input->post('ResponsableFolio');
    $DireccionFolio = $this->input->post('DireccionFolio');
    $ManejoInventario = $this->input->post('ManejoInventario');
    $TituloTicket = $this->input->post('TituloTicket');
    $NombreImagenTicket = $this->input->POST($_FILES['ImagenTicket']['name']);


    //$ImagenTicket = $this->input->post("ImagenTicket");



    // $ImagenTicket = $this->input->post($_FILES(["ImagenTicket"]["name"]));

    $DatosFoliador = array(
      'DescripcionFoliador'=>$DescripionFoliador,
      'ValorFolio'=>$ValorFolio,
      'ResponsableFolio'=>$ResponsableFolio,
      'DireccionFolio'=>$DireccionFolio,
      'ManejoInventario'=> ($ManejoInventario=='on' ? 1:0),
      'TituloTicket'=>$TituloTicket,
//      'ImagenTicket'=>$NombreImagenTicket,
      //'NombreImagenTicket'=>$ImagenTicket,


    );
    //'ImagenTicket'=>$NombreImagenTicket

    $this->load->model('Foliador_Model');

    $result = $this->Foliador_Model->AgregarNuevoFoliador($DatosFoliador,$NombreImagenTicket);

    if ($result!==false)
    {

      die(json_encode(['error'=>FALSE,'message'=>'Foliador Registrado Exitosamente con el Id:'.$result]));


    }
    else {

      die(json_encode(['error'=>TRUE,'message'=>'El Foliador ya existe']));

      // code...
    }
      // code...
  }






  // CATALOGO Foliadores
  public function Load_ConsultarFoliador()
  {
    $data['title']='Foliadores';

    $this->load->view('templates/MainContainer',$data);
    $this->load->view('templates/HeaderContainer',$data);
    $this->load->view('Foliador/CardConsultaFoliador',$data);
    $this->load->view('templates/FormFooter',$data);
    $this->load->view('templates/FooterContainer');
  }


  public function ConsultarCatalogoFoliadores_ajax()
  {
    $CatalogoFoliadores = $this->Foliador_Model->ConsultarFoliadores();

    echo json_encode($CatalogoFoliadores);
    // code...
  }

  public function ConsultarFoliadorPorId()
  {
    $IdFoliador = $this->input->post('IdFoliador');

    $Foliador = $this->Foliador_Model->ConsultarFoliadorPorId($IdFoliador);

    echo json_encode($Foliador);
  }


  public function ActualizarFoliador_ajax()
  {

    $ActualizarFoliador = array(
      'IdFoliador'=>$this->input->post('IdFoliador'),
      'DescripcionFoliador'=> $this->input->post('DescripcionFoliador'),
      'ValorFolio'=>$this->input->post('ValorFolio'),
      'ResponsableFolio'=>$this->input->post('ResponsableFolio'),
      'DireccionFolio'=>$this->input->post('DireccionFolio'),
      'ManejoInventario'=>$this->input->post('ManejoInventario'),
      'TituloTicket'=>$this->input->post('TituloTicket'),
      'ImagenTicket'=>$this->input->post('ImagenTicket')

    );

    $IdFoliador = $this->input->post('IdFoliador');

    $this->Foliador_Model->EditarFoliador($IdFoliador,$ActualizarFoliador);

    // code...
  }

}
