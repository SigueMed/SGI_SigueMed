<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CatalogoProductos_Controller
 *
 * @author Constanzo Basurto
 */
class CatalogoProductos_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CatalogoProductos_Model');
        $this->load->model('Servicio_Model');
        $this->load->model('Cuenta_Model');
        $this->load->model('CuentaProducto_Model');
    }

    public function Load_AltaProductos()
    {
        $data['title'] = 'Catalogo de Productos';
        $data['InformacionProducto'] = null;
        $data['ProductoActionsEnabled'] = false;
        $data['CuentasProductoActionsEnabled'] = true;
        $data['CuentasProductoCancelActionEnabled']=false;
        $data['CuentasProductoSubmitAction']='AgregarProducto';
        $data['CuentasProductoSubmitTitle']='Agregar';
        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('Producto/FormNuevoProducto');
        $this->load->view('Producto/CardDetalleProducto',$data);
        //$this->load->view('Producto/CardCuentasProducto',$data);
        $this->load->view('templates/FormFooter');


        $this->load->view('templates/FooterContainer');

    }

    public function Load_CatalogoProductos()
    {
        $data['title'] = 'Catalogo de Productos';

        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('Producto/CardConsultaCatalogoProductos',$data);
        $this->load->view('templates/FooterContainer');

    }

    public function AgregarNuevoProducto()
    {
        $action = $this->input->post('action');

        if($action =='AgregarProducto')
        {
            try
            {
                $this->db->trans_start();
                $Cuentas = $this->input->post('IdCuentaProducto');
                $PorcentajeProductos = $this->input->post('PorcentajeProducto');
                $CuentaMaster =$this->input->post('IdCuentaMaestra');
                $PorcentajeCuentaMaestra = $this->input->post('PorcentajeCuentaMaestra');

                $NuevoProducto = array(
                    'IdServicio'=>$this->input->post('cbServicioProducto'),
                    'DescripcionProducto' => $this->input->post('DescripcionProducto'),
                    'CostoProducto'=>$this->input->post('CostoProducto'),
                    'Habilitado'=>1,
                    'PrecioProveedor'=>$this->input->post('PrecioProveedor')
                );

                $NuevoIdProducto = $this->CatalogoProductos_Model->AgregarNuevoProducto($NuevoProducto);





                    if ($NuevoIdProducto>1)
                    {
                        $this->CuentaProducto_Model->InsertarNuevaCuentaProducto($NuevoIdProducto,$CuentaMaster,$PorcentajeCuentaMaestra);

                        if (isset($Cuentas))
                        {
                          for ($i=0; $i<sizeof($Cuentas); $i++)
                          {
                              $result = $this->CuentaProducto_Model->InsertarNuevaCuentaProducto($NuevoIdProducto,$Cuentas[$i],($PorcentajeProductos[$i]));
                              if ($result <0)
                              {
                                  throw new Exception('Error al registrar cuentas del producto');
                              }
                          }
                        }

                         $transStatus = $this->db->trans_complete();

                        if ($transStatus == true)
                        {
                            $this->db->trans_commit();
                        }
                        else
                        {
                            $this->db->trans_rollback();
                        }

                        $data['title'] = 'Corte Exitoso';
                        $data['swal']=true;
                        $data['swalMessage']="title:'Nuevo Producto ',
                        text: 'El nuevo producto se agrego exitosamente',
                        type: 'success',

                        showConfirmButton: true,
                        confirmButtonText:'<i class=\"icon-print\"></i> Catalogo Productos',
                        showCancelButton: true,
                        cancelButtonText: '<i class=\"icon-th-list\"></i> Nuevo Producto'";

                        $data['swalAction'] = ".then((result)=> {
                          if (result.value) {
                            window.open('".site_url("Catalogos/ConsultaProductos")."','_blank');
                          }
                          else {
                            window.location.href = '".site_url("Catalogos/AltaProductos")."';
                          }


                        });";

                        $this->load->view('templates/MainContainer',$data);
                        $this->load->view('templates/HeaderContainer',$data);
                        $this->load->view('templates/FormFooter',$data);
                        $this->load->view('templates/FooterContainer');
                    }


            } catch (Exception $ex) {
                log_message('error', $ex->getMessage());
                $this->db->trans_rollback();
                echo '<script>alert(Error al guardar el producto);</script>';
            }


        }
        else
        {
            redirect(site_url('Dashboard/Main'));
        }
    }

//*******************************AJAX***************************************
    public function ConsultarServicios_ajax()
    {
        $Servicios = $this->Servicio_Model->ConsultarServicios(FALSE,TRUE);

        $output = "<option value=''>Selecciona un servicio</option>";
        foreach($Servicios as $servicio)
        {
            $output.='<option value="'.$servicio['IdServicio'].'" data-proveedor="'.$servicio['EsProveedor'].'">'.$servicio['DescripcionServicio'].'</option>';

        }

        echo $output;
    }

    public function ConsultarCuentas_ajax()
    {
        $Cuentas = $this->Cuenta_Model->ConsultarCuentas();

        $output = "<option value=''>Selecciona una cuenta</option>";
        foreach($Cuentas as $cuenta)
        {
            $output.='<option value="'.$cuenta['IdCuenta'].'">'.$cuenta['DescripcionCuenta'].'</option>';

        }

        echo $output;
    }
    public function ConsultarTipoProductos_ajax()
    {
        $this->load->model('CatalogoTipoProducto_Model');
        $TiposProducto = $this->CatalogoTipoProducto_Model->ConsultarCatalogoTipoProducto();

        $output = "<option value=''>Selecciona un Tipo Producto</option>";
        foreach($TiposProducto as $tipoProducto)
        {
            $output.='<option value="'.$tipoProducto['IdTipoProducto'].'">'.$tipoProducto['DescripcionTipoProducto'].'</option>';

        }

        echo $output;
    }

    public function ConsultarProductosServicio()
    {
        $IdServicio = $this->input->post('IdServicio');

        if (isset($IdServicio) && $IdServicio != "")
        {
            $Productos = $this->CatalogoProductos_Model->ConsultarProductosPorServicio($IdServicio);

            echo json_encode($Productos);
        }
    }
    public function ConsultarProductoPorId_ajax()
    {

        $IdProducto = $this->input->post('IdProducto');

        $Producto = $this->CatalogoProductos_Model->ConsultarProductoPorId($IdProducto);

        echo json_encode($Producto);
    }

    public function ConsultarCuentasProducto_ajax()
    {
        $IdProducto = $this->input->post('IdProducto');

        $CuentasProducto = $this->CuentaProducto_Model->ConsultarCuentasPorProducto($IdProducto);

        echo json_encode($CuentasProducto);
    }

    public function GuardarProducto()
    {
        $action = $this->input->post('action');
        if ($action =="GuardarProducto")
        {
            $IdProducto = $this->input->post('Modal_IdProducto');
            $DescripcionProducto = $this->input->post('Modal_Descripcion');
            $CostoProducto = $this->input->post('Modal_CostoProducto');
            $Habilitado = $this->input->post('Modal_chkHabilitado');
            $TipoProducto = $this->input->post('cbTipoProducto');

            if ($TipoProducto=='')
            {
              $TipoProducto=null;
            }

            $DatosProducto = array(

                'DescripcionProducto'=> $DescripcionProducto,
                'CostoProducto' => $CostoProducto,
                'Habilitado'=> $Habilitado,
                'IdTipoProducto'=>$TipoProducto
            );

            $result = $this->CatalogoProductos_Model->ActualizarProducto($IdProducto,$DatosProducto);

            if($result == 1)
            {
                $Cuentas = $this->input->post('IdCuentaProducto');
                $PorcentajeCuentas =$this->input->post('PorcentajeProducto');

                $this->CuentaProducto_Model->EliminarCuentasProducto($IdProducto);

                $CuentaMaestra = $this->input->post('IdCuentaMaestra');
                $PorcentajeCuentaMaestra = $this->input->post('PorcentajeCuentaMaestra');
                $result = $this->CuentaProducto_Model->InsertarNuevaCuentaProducto($IdProducto,$CuentaMaestra,$PorcentajeCuentaMaestra);


                if (isset($Cuentas))
                {


                    for ($i=0; $i<sizeof($Cuentas); $i++)
                        {
                            $result = $this->CuentaProducto_Model->InsertarNuevaCuentaProducto($IdProducto,$Cuentas[$i],($PorcentajeCuentas[$i]));
                            if ($result <0)
                            {
                                throw new Exception('Error al registrar cuentas del producto');
                            }
                        }
                }
                $data['title']="Producto Actualizado";
                $data['swal']=true;
                $data['swalMessage']="title:'Producto Actualizado',
                text: 'El producto ha sido actualizado exitosamente',
                type: 'success',
                showConfirmButton: true,
                confirmButtonText:'<i class=\"icon-check\"></i>Ok'";

                $data['swalAction'] = ".then((result)=> {
                  if (result.value) {
                    window.location.href ='".site_url("Catalogos/ConsultaProductos")."';
                  }
                });";
                $this->load->view('templates/MainContainer',$data);
                $this->load->view('templates/HeaderContainer',$data);
                $this->load->view('templates/FormFooter',$data);
                $this->load->view('templates/FooterContainer');
            }
            else
            {

            }


        }



    }
//**************************************************************************
//**************************[INICIO] ACTUALIZACION PRECIOS****************************

public function Load_PreciosProductos()
{
  $data['title'] = 'Actualización de Precios';

  $this->load->view('templates/MainContainer',$data);
  $this->load->view('templates/HeaderContainer',$data);
  $this->load->view('Producto/CardActualizacionPreciosProducto',$data);
  $this->load->view('templates/FooterContainer');

}

public function ActualizarPreciosProductos()
{
  $Productos = $this->input->post('Productos');
  $Precios = $this->input->post('Precios');
  $PreciosProveedor = $this->input->post('PreciosProveedor');

  if(isset($Productos))
  {
      for($i=0; $i<sizeof($Productos);$i++)
      {
          $PreciosActualizados[]= array(
              'IdProducto'=>$Productos[$i],
              'CostoProducto'=>$Precios[$i],
              'PrecioProveedor'=>$PreciosProveedor[$i]
          );
      }
      $this->CatalogoProductos_Model->ActualizarPrecios_Batch($PreciosActualizados);
    }
}

public function autocompleteProducto(){
  $IdClinica =$this->session->userdata('IdClinica');
    $IdFoliador = $this->input->post('IdFoliador');
    $resultado = $this->CatalogoProductos_Model->ConsultarProductosPuntoVenta($IdFoliador,$IdClinica);
    echo json_encode($resultado);
}
public function ConsultarProductosPuntoVenta(){
    $IdClinica =$this->session->userdata('IdClinica');
    $IdFoliador = $this->input->post('IdFoliador');
    $resultado = $this->CatalogoProductos_Model->ConsultarProductosPuntoVenta($IdFoliador,$IdClinica);
    echo json_encode($resultado);
}
//**************************[FIN] ACTUALIZACION PRECIOS****************************


    //put your code here
}
