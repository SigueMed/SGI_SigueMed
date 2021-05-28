<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CargaCatalogos_Controller
 *
 * @author SigueMED
 */
class CargaCatalogos_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();


    }

    public function CargarGruposServicio_ajax()
    {
        $this->load->model('GrupoServicio_Model');
        $GruposServicios = $this->GrupoServicio_Model->ConsultarGruposServicios();

         $output='<option value="">Selecciona un Grupo</option>';
         $output.='<optionselected="selected" value="*">Todos</option>';
        foreach($GruposServicios as $grupoServicio)
        {
            $output .= '<option value="'.$grupoServicio['IdGrupoServicio'].'">'.$grupoServicio['DescripcionGrupoServicio'].'</option>';
        }
        echo $output;

    }

    public function CargarServiciosPorGrupo_ajax()
    {
        $grupo = $this->input->post('IdGrupo');

        $this->load->model('Servicio_Model');
        if ($grupo!== "" && $grupo !== null)
        {
            if ($grupo=="*")
            {
                $Servicios = $this->Servicio_Model->ConsultarServiciosPorGrupo();

            }
            else
            {
                $Servicios = $this->Servicio_Model->ConsultarServiciosPorGrupo($grupo);
            }

         $output='<option value="">Selecciona un Servicio</option>';

        foreach($Servicios as $servicio)
        {
            $output .= '<option value="'.$servicio['IdServicio'].'">'.$servicio['DescripcionServicio'].'</option>';
        }
        echo $output;

        }
    }

    public function CargarServiciosPorFoliador_ajax()
    {
      $IdFoliador = $this->input->post('IdFoliador');
      $Inventario = $this->input->post('Inventario');
      $this->load->model('Servicio_Model');
      $Servicios = $this->Servicio_Model->ConsultarServiciosPorFoliador($IdFoliador,$Inventario);
      $output='<option value="">Selecciona un Servicio</option>';

       foreach($Servicios as $servicio)
       {
           $output .= '<option value="'.$servicio['IdServicio'].'">'.$servicio['DescripcionServicio'].'</option>';
       }
       echo $output;

      // code...
    }

    public function CargarProductosPorServicio_ajax()
    {

        $IdServicio = $this->input->post('IdServicio');
        $this->load->model('CatalogoProductos_Model');
        $Productos = $this->CatalogoProductos_Model->ConsultarProductosPorServicio($IdServicio);

         $output='<option value="">Selecciona un Producto</option>';

        foreach($Productos as $producto)
        {
            $output .= '<option value="'.$producto['IdProducto'].'" data-proveedor="'.$producto['Proveedor'].'" data-precioproveedor = "'.$producto['PrecioProveedor'].'">'.$producto['DescripcionProducto'].'</option>';
        }
        echo $output;



    }

    public function CargarFoliador_ajax()
    {
      $this->load->model('Foliador_Model');
      $Inventario = $this->input->post('ManejoInventario');

      $Foliadores = $this->Foliador_Model->ConsultarFoliadoresClinica($this->session->userdata('IdClinica'),$Inventario);

      $output='<option value="">Selecciona un Grupo</option>';

     foreach($Foliadores as $Foliador)
     {
         $output .= '<option value="'.$Foliador['IdFoliador'].'">'.$Foliador['DescripcionFoliador'].'</option>';
     }
     echo $output;

      // code...
    }

    public function CargarCuentas_ajax()
    {
      $this->load->model('Cuenta_Model');

      $CuentasCorte = $this->input->post('CuentasCorte');

      if (isset($CuentasCorte))
      {
        $Cuentas = $this->Cuenta_Model->ConsultarCuentas($CuentasCorte);

      }
      else {
        $Cuentas = $this->Cuenta_Model->ConsultarCuentas();
      }


      $output='<option value="">Selecciona una Cuenta</option>';

       foreach($Cuentas as $cuenta)
       {
           $output .= '<option value="'.$cuenta['IdCuenta'].'">'.$cuenta['DescripcionCuenta'].'</option>';
       }
       echo $output;

      // code...
    }

    public function ConsultarTiposPago_ajax()
    {

      $this->load->model('CatalogoTipoPago_Model');

      $result = $this->CatalogoTipoPago_Model->ConsultarTipoPago();

      echo json_encode($result);
      // code...
    }

    public function ConsultarServiciosProveedores_ajax()
    {

      $this->load->model('Servicio_Model');

      $Proveedores = $this->Servicio_Model->ConsultarServiciosProveedores();

      $output='<option value="">Selecciona un Proveedor</option>';

       foreach($Proveedores as $Proveedor)
       {
           $output .= '<option value="'.$Proveedor['IdServicio'].'">'.$Proveedor['DescripcionServicio'].'</option>';
       }
       echo $output;

      // code...
    }

    public function ConsultarClinicas_ajax()
    {
      $this->load->model('Clinica_Model');

      $result = $this->Clinica_Model->ConsultarClinicas();

      echo json_encode($result);

      // code...
    }

    public function CargarPerfiles_ajax()
    {

      $this->load->model('Perfil_Model');

      $Perfiles = $this->Perfil_Model->ConsultarPerfiles();

      $output='<option value="">Selecciona un Perfil</option>';

       foreach($Perfiles as $perfil)
       {
           $output .= '<option value="'.$perfil['IdPerfil'].'">'.$perfil['DescripcionPerfil'].'</option>';
       }
       echo $output;

      // code...
    }

    public function CargarMedicoservicio_ajax()
    {
      $servicio = $this->input->post('IdServicio');

      $this->load->model('Empleado_Model');

      $Medicos = $this->Empleado_Model->ConsultarMedicosPorServicio($servicio,$this->session->userdata('IdClinica'));


       $output='<option value="">Selecciona un Medico</option>';

      foreach($Medicos as $medico)
      {
          $output .= '<option value="'.$medico['IdEmpleado'].'">'.$medico['Nombre'].'</option>';
      }
      echo $output;
    }




    public function CargarEmpleados_ajax()
    {

      $this->load->model('Empleado_Model');

      $Empleado = $this->Empleado_Model->ConsultarEmpleados();

      $output='<option value="">Selecciona un empleado</option>';

       foreach($Empleado as $empleado)
       {
           $output .= '<option value="'.$empleado['IdEmpleado'].'">'.$empleado['NombreEmpleado'].'</option>';
       }
       echo $output;

      // code...
    }


    //put your code here
}
