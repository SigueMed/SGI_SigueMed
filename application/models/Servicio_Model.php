<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicio_Model
 *
 * @author SigueMed
 */
class Servicio_Model extends CI_Model {

    private $table;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = "servicio";

    }
    
    //Autor: Ricardo
    /*
    *
    *Se agrego el codigo de nuevo servico a Servicio model 14/05/2021
    */
    public function AgregarNuevoServicio($DatosServicio,$ClinicasServicio)
    {
      $this->db->select('DescripcionServicio, CodigoColorServicio');
      $this->db->from($this->table);
      $this->db->where('DescripcionServicio' ,$DatosServicio['DescripcionServicio']);
      $query = $this->db->get();

      if ($query->num_rows()<=0)
      {
        $this->db->reset_query();
        $this->db->insert($this->table,$DatosServicio);

        $IdNuevoServicio =  $this->db->insert_id();

        $this->db->reset_query();

        for ($i=0;$i<sizeof($ClinicasServicio);$i++)
        {
          $servicioClinica = array(
            'IdClinica'=>$ClinicasServicio[$i],
            'IdServicio'=>$IdNuevoServicio
          );
          $this->db->insert('servicioclinica',$servicioClinica);



        }

        return $IdNuevoServicio;


      }
      else {
        return false;
      }

    }

    public function ConsultarClinicasServicio($IdServicio)
    {
      $this->db->select('*');
      $this->db->from('clinicas c');
      $this->db->join('servicioclinica sc', 'sc.IdClinica = c.IdClinica');
      $this->db->where('sc.IdServicio', $IdServicio);

      $query = $this->db->get();
      return $query->result_array();

      // code...
    }
    
    public function CatalogoClinicasServicio($IdServicio)
    {
      $this->db->select('c.*, IdServicio');
      $this->db->from('clinicas c');
      $this->db->join('servicioclinica sc', 'sc.IdClinica = c.IdClinica and sc.IdServicio ='.$IdServicio,'left');
      

      $query = $this->db->get();
      return $query->result_array();
    }

    public function ConsultarServiciosPorGrupo($IdGrupo = FALSE)
    {
        $this->db->select($this->table.'.*');
        $this->db->select("gs.EsProveedor");
        $this->db->from($this->table);
        $this->db->join("gruposervicio gs",$this->table.".IdGrupoServicio = gs.IdGrupoServicio");
        $this->db->where('Habilitado',TRUE);

        if($IdGrupo!== FALSE)
        {
            $this->db->where($this->table.'.IdGrupoServicio',$IdGrupo);
        }


        $query = $this->db->get();

        return $query->result_array();

    }
    public function ConsultarServicios($Inventario = FALSE)
    {
         $this->db->select($this->table.'.*');
         $this->db->select("gs.*");
        $this->db->from($this->table);
        $this->db->join("gruposervicio gs",$this->table.".IdGrupoServicio = gs.IdGrupoServicio");
        /*if (!$Todos)
        {
              $this->db->where('Habilitado', TRUE);
        }*/



        if ($Inventario)
        {
            $this->db->where('ManejoInventario', TRUE);
        }

        $query = $this->db->get();

        return $query->result_array();

    }

    public function ConsultarServiciosProveedores()
    {
      $this->db->select($this->table.'.*');
      $this->db->select("gs.EsProveedor");
      $this->db->from($this->table);
      $this->db->join("gruposervicio gs",$this->table.".IdGrupoServicio = gs.IdGrupoServicio");
       $this->db->where('Habilitado', TRUE);
       $this->db->where('EsProveedor',TRUE);

       $query = $this->db->get();

       return $query->result_array();
    }

    public function ConsultarServicioPorId($IdServicio)
    {
        $this->db->select($this->table.'.*, gs.DescripcionGrupoServicio');
        $this->db->from ($this->table);
        $this->db->join("gruposervicio gs",$this->table.".IdGrupoServicio = gs.IdGrupoServicio");
        $this->db->where('IdServicio', $IdServicio);
        //$this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows()>0)
        {
            return $query->row();

        }
        return false;
    }

    //put your code here

    //AUTOR 'Carlos Esquivel' -- muestra los servicios en el dropdown
    public function getServiciosAgenda($IdClinica=FALSE, $IdServicio = FALSE){
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where('ManejoAgenda', TRUE);
        $this->db->where('Habilitado', TRUE);
        if($IdClinica !== FALSE)
        {
            $this->db->join('servicioclinica',$this->table.'.IdServicio = servicioclinica.IdServicio');
            $this->db->where('IdClinica', $IdClinica);
        }

        if($IdServicio !== FALSE)
        {
            $this->db->where($this->table.'.IdServicio', $IdServicio);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function ConsultarServiciosPorFoliador($IdFoliador,$Inventario = FALSE)
    {
      $this->db->select($this->table.'.*');
      $this->db->from($this->table);
      $this->db->join('folioservicio f',$this->table.'.IdServicio = f.IdServicio and f.IdClinica = '.$this->session->userdata('IdClinica'));
      $this->db->where('IdFoliador',$IdFoliador);

      $this->db->where('ManejoInventario',$Inventario);


      $query = $this->db->get();

      return $query->result_array();
      // code...
    }


//Autor: Ricardo
//14/05/2021 Se Agrego editar Servicio
    public function EditarServicio($IdServicio,$ActualizarServicio)
    {
      $this->db->where('IdServicio', $IdServicio);
      return $this->db->update($this->table, $ActualizarServicio);

      // code...
    }

    public function ActualizarClinicasServicio($IdServicio,$ClinicasServicio)
    {
      $this->db->where('IdServicio', $IdServicio);
      $this->db->delete('servicioclinica');

      $this->db->reset_query();
      
      for ($i=0;$i<sizeof($ClinicasServicio);$i++)
      {
        $servicioClinica = array(
          'IdClinica'=>$ClinicasServicio[$i],
          'IdServicio'=>$IdServicio
        );
        $this->db->insert('servicioclinica',$servicioClinica);

      }
      return 1;



      // code...
    }

}

