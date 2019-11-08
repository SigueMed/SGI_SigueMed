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
        $this->load->view('Producto/CardCuentasProducto',$data);
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
                $NuevoProducto = array(
                    'IdServicio'=>$this->input->post('cbServicioProducto'),
                    'DescripcionProducto' => $this->input->post('DescripcionProducto'),
                    'CostoProducto'=>$this->input->post('CostoProducto'),
                    'Habilitado'=>1
                );

                if (sizeof($Cuentas)>0)
                {

                    $NuevoIdProducto = $this->CatalogoProductos_Model->AgregarNuevoProducto($NuevoProducto);

                    if ($NuevoIdProducto>1)
                    {
                        for ($i=0; $i<sizeof($Cuentas); $i++)
                        {
                            $result = $this->CuentaProducto_Model->InsertarNuevaCuentaProducto($NuevoIdProducto,$Cuentas[$i],($PorcentajeProductos[$i]/100));
                            if ($result <0)
                            {
                                throw new Exception('Error al registrar cuentas del producto');
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

                        echo "<script>
                            alert('El producto ha sido guardado');
                            window.location.href='".site_url('Catalogos/AltaProductos')."';
                            </script>";
                    }
                }
                else
                {
                    echo "<script>alert(Debe de asignar cuentas al producto);</script>";
                     $this->db->trans_rollback();
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
        $Servicios = $this->Servicio_Model->ConsultarServicios();

        $output = "<option value=''>Selecciona un servicio</option>";
        foreach($Servicios as $servicio)
        {
            $output.='<option value="'.$servicio['IdServicio'].'">'.$servicio['DescripcionServicio'].'</option>';

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

                if (isset($Cuentas))
                {
                    $this->CuentaProducto_Model->EliminarCuentasProducto($IdProducto);

                    for ($i=0; $i<sizeof($Cuentas); $i++)
                        {
                            $result = $this->CuentaProducto_Model->InsertarNuevaCuentaProducto($IdProducto,$Cuentas[$i],($PorcentajeCuentas[$i]/100));
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

  if(isset($Productos))
  {
      for($i=0; $i<sizeof($Productos);$i++)
      {
          $PreciosActualizados[]= array(
              'IdProducto'=>$Productos[$i],
              'CostoProducto'=>$Precios[$i]
          );
      }
      $this->CatalogoProductos_Model->ActualizarPrecios_Batch($PreciosActualizados);
    }
}
//**************************[FIN] ACTUALIZACION PRECIOS****************************


    //put your code here
}
