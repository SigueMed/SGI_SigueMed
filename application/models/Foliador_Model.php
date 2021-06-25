<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foliador_Model extends CI_Model{
  private $table;
  public function __construct()
  {
    parent::__construct();
    $this->table = 'foliador';
    //Codeigniter : Write Less Do More
  }

  public function ConsultarFoliadoresClinica($IdClinica, $Inventario)
  {

    $this->db->select('DISTINCT ('.$this->table.'.IdFoliador), DescripcionFoliador');
    $this->db->from($this->table);
    $this->db->join('folioservicio',$this->table.'.IdFoliador = folioservicio.IdFoliador');
    $this->db->where('IdClinica',$IdClinica);
    $this->db->where('ManejoInventario',$Inventario);

    $query = $this->db->get();

    return $query->result_array();
    // code...
  }

  

  public function BuscarFoliadorServicio($IdClinica,$IdServicio)
  {
    $this->db->select('DISTINCT ('.$this->table.'.IdFoliador), DescripcionFoliador');
    $this->db->from($this->table);
    $this->db->join('folioservicio',$this->table.'.IdFoliador = folioservicio.IdFoliador');
    $this->db->where('IdClinica',$IdClinica);
    $this->db->where('IdServicio',$IdServicio);

    $query = $this->db->get();

    return $query->row();
    // code...
  }

  public function ObtenerFolioPorServicio($IdClinica,$IdServicio)
  {

    $this->db->select($this->table.'.ValorFolio');
    $this->db->from($this->table);
    $this->db->join('folioservicio f',$this->table.'.IdFoliador = f.IdFoliador');
    $this->db->where('f.IdServicio',$IdServicio);
    $this->dd->where('f.IdClinica',$IdClinica);

    $query = $this->db->get();
    $folio = $query->row()->ValorFolio;
    return $folio+1;
    // code...
  }

  public function ObtenerFolio($IdFoliador)
  {
    $this->db->select($this->table.'.ValorFolio');
    $this->db->from($this->table);
    $this->db->where('IdFoliador',$IdFoliador);

    $query = $this->db->get();
    $folio = $query->row();
    return $folio->ValorFolio+1;

    // code...
  }

  public function AplicarFolio($IdFoliador)
  {
    $NuevoFolio = $this->ObtenerFolio($IdFoliador);

    $this->db->set('ValorFolio',$NuevoFolio);
    $this->db->where('IdFoliador',$IdFoliador);
    return $this->db->update($this->table);
    // code...
  }

  ///CARGAR FOLIADOR 
  public function ConsultarFoliadores()
  {
    $this->db->select($this->table.'.*');
    $this->db->from($this->table);

    $query = $this->db->get();

    return $query->result_array();
    // code...
  }

  public function AgregarNuevoFoliador($DatosFoliador,$NombreImagenTicket)
  {
    $this->db->select('DescripcionFoliador, ValorFolio');
    $this->db->from($this->table);
    $this->db->where('DescripcionFoliador',$DatosFoliador['DescripcionFoliador']);
    $query = $this->db->get();

    if ($query->num_rows()<=0)
    {
      $this->db->reset_query();
      $this->db->insert($this->table,$DatosFoliador,$NombreImagenTicket);

      $IdNuevoFoliador =  $this->db->insert_id();


      $Ruta = 'files/Foliadores/'.$IdNuevoFoliador;
      $Archivo = $Ruta.$_FILES["ImagenTicket"]["name"];
      if(!file_exists($Ruta)){
        mkdir($Ruta);
      }
      if(!file_exists($Archivo)){
        $resultado = @move_uploaded_file($_FILES["ImagenTicket"]["tmp_name"],
        $Archivo);

      //   if ($resultado) {
      //     echo "Archivo Guardado";
      //     // code...
      //   }
      //   else {
      //     echo "Error al Guardar el Archivo";
      //     // code...
      //   }
      //
      // }
      // else {
      //   echo "El achivo ya existe";
      //   // code...
      }


      // $nom=$_REQUEST["txtnom"];
      // $foto=$_FILES["foto"]["name"];
      // $ruta=$_FILES["foto"]["tmp_name"];
      // $destino="fotos/".$foto;

      // if ($_FILES["ImagenTicket"]["error"]>0) {
      //   echo "Error al cargar achivo";
      //   // code...
      // }
      // else {
      //   $permitidos = array("image/png","image/jpg");
      //   $limite_kb = 200;
      //   if(in_array($_FILES["ImagenTicket"]["type"], $permitidos) && $_FILES["ImagenTicket"]["size"] <=  $limite_kb * 1024){
      //         $Ruta = 'files/Foliadores/'.$IdNuevoFoliador;
      //         $Archivo = $Ruta.$_FILES["ImagenTicket"]["name"];
      //         if(!file_exists($Ruta)){
      //           mkdir($Ruta);
      //         }
      //         if(!file_exists($Archivo)){
      //           $resultado = @move_uploaded_file($_FILES["ImagenTicket"]["tmp_name"],
      //           $Archivo);
      //
      //           if ($resultado) {
      //             echo "Archivo Guardado";
      //             // code...
      //           }
      //           else {
      //             echo "Error al Guardar el Archivo";
      //             // code...
      //           }
      //
      //         }
      //         else {
      //           echo "El achivo ya existe";
      //           // code...
      //         }
      //   }
      //   else {
      //     echo "Archivo no permitido o exceso el tamano";
      //     // code...
      //   }
      //   // code...
      // }

      $this->db->reset_query();




      return $IdNuevoFoliador;

    }
    else {
      return false;
    }

  }

  //Carga todos los Foliadores
  public function ConsultarFoliadores()
  {
    $this->db->select('*');
    $this->db->from($this->table);

    $query = $this->db->get();
    return $query->result_array();
    // code...
  }

  public function EditarFoliador($IdFoliador,$ActualizarFoliador)
  {
    $this->db->where('IdFoliador', $IdFoliador);
    return $this->db->update($this->table, $ActualizarFoliador);

    // code...
  }

}
