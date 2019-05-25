<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Inventario_Controller
 *
 * @author SigueMED
 */
class Inventario_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');

        $this->load->helper('url_helper');
        $this->load->helper('date');
        
        //Load Models
        $this->load->model('Proveedor_Model');
         $this->load->model('CatalogoProductos_Model');
         $this->load->model('FacturaEntradaInventario_Model');
         $this->load->model('SubProducto_Model');
         $this->load->model('MovimientoInventario_Model');
         $this->load->model('LoteSubProducto_Model');
         $this->load->model('Servicio_Model');
         
         
        
    }
    
    public function Load_RegistrarEntradaInventario()
    {
        $data['title'] = 'Registrar Entrada al Inventario';
        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('Inventario/FormEntradaInventario');
        $this->load->view('Inventario/CardEntradaInventario');
        $this->load->view('templates/FormFooter',$data); 
        $this->load->view('templates/FooterContainer');
        
    }
    
    /*
     * RegistrarEntradaInventario
     * Descripción: Función para crear una entrada al inventario a través de una factura
     * Autor: Constanzo Manuel Basurto Chipolini
     */
    public function RegistrarEntradaInventario()
    {
        
        $action = $this->input->post('action');
        try
        {
            $CodigosProducto = $this->input->post('CodigoProducto');
            if ($action =='GuardarEntrada' && sizeof($CodigosProducto)>0)
            {

                //Crear Transacción
                $this->db->trans_begin();

                $FacturaEntradaInventario =array(
                    'NumeroFactura'=>$this->input->post('NumeroFactura'),
                    'IdProveedor'=>$this->input->post('proveedor'),
                    'FechaFactura'=>$this->input->post('FechaFactura')
                    );

                //Crear Factura Entrada
                $IdFacturaEntradaInventario = $this->FacturaEntradaInventario_Model->CrearNuevaFactura($FacturaEntradaInventario);
                if ($IdFacturaEntradaInventario!==FALSE)
                {
                    //$CodigosProducto = $this->input->post('CodigoProducto');
                    $CodigosSubProducto = $this->input->post('CodigoBarras');
                    $DescripcionesSubProducto = $this->input->post('DescripcionSubProducto');
                    $LotesSubProducto = $this->input->post('LoteSubProducto');
                    $FechaCaducidadSubProducto = $this->input->post('FechaCaducidad');
                    $CantidadSubProducto = $this->input->post('CantidadSubProducto');
                    $CostoSubProducto = $this->input->post('CostoSubProducto');

                     for ($i=0;$i<sizeof($CodigosSubProducto); $i++)
                        {
                            //Buscar si el producto ya existe (Por Codigo)
                            $SubProducto = $this->SubProducto_Model->ConsultarSubProducto($CodigosSubProducto[$i]);
                            if($SubProducto==FALSE)
                            {
                                //Si no existe se registra nuevo SubProducto
                                $NuevoSubProducto =array(
                                    'IdCodigoSubProducto' => $CodigosSubProducto[$i],
                                    'IdProducto' => $CodigosProducto[$i],
                                    'NombreSubProducto'=> $DescripcionesSubProducto[$i],
                                    'IdProveedor'=>$this->input->post('proveedor'),

                                    );
                                $this->SubProducto_Model->AgregarNuevoSubProducto($NuevoSubProducto);


                            }
                            //Buscar si ya existe el lote registrado
                            $LoteSubProducto = $this->LoteSubProducto_Model->ConsultarLote($CodigosSubProducto[$i],$LotesSubProducto[$i]);
                            if ($LoteSubProducto == FALSE)
                            {
                                $NuevoLote = array(
                                    'IdCodigoSubProducto'=>$CodigosSubProducto[$i],
                                    'Lote'=> $LotesSubProducto[$i],
                                    'Costo'=>$CostoSubProducto[$i],
                                    'FechaCaducidad'=>$FechaCaducidadSubProducto[$i]
                                );
                                $this->LoteSubProducto_Model->RegistrarNuevoLote($NuevoLote);
                            }

                            $Fecha = now();                        

                            $MovimientoInventario=array(
                                'IdTipoMovimientoInventario'=>1,
                                'FechaMovimiento'=>mdate('%Y-%m-%d',$Fecha),
                                'IdCodigoSubProducto'=>$CodigosSubProducto[$i],
                                'CantidadMovimiento'=>$CantidadSubProducto[$i],
                                'Lote'=>$LotesSubProducto[$i],
                                'IdClinica'=>$this->session->userdata('IdClinica'),
                                'IdFacturaEntradaInventario'=>$IdFacturaEntradaInventario
                            );
                            //Crear el movimiento de entrada 
                            $this->MovimientoInventario_Model->RegistrarEntrada($MovimientoInventario);
                        }
                    if ($this->db->trans_status() !== FALSE)
                    {
                        $this->db->trans_commit();
                        echo '<script> alert("Entrada al inventario registrada exitosamente.");</script>';
                        redirect(site_url('Inventario/RegistrarEntrada'));
                    }
                }
                else // Error al crear la factura
                {
                     throw new Exception($this->db->error());
                    
                }


            }
            
        } 
        catch (Exception $ex) 
        {
            log_message("error", $ex->getMessage());
            $this->db->trans_rollback();
            echo '<script> alert("Error al Crear la factura");</script>';

        }
        
        
        
        
    }
    
    
    /*
     * DESCRIPCION: Consulta de Proveedores habilitados, llamada por metodo ajax
     * RETURN: Devuelve a través de un echo la lista de valores de los proveedores
     */
    public function ConsultarProveedores_ajax()
    {
        $Proveedores = $this->Proveedor_Model->ConsultarProveedores();
        
        
        $output='<option value="">Selecciona un Proveedor</option>';
        foreach($Proveedores as $proveedor)
        {
            $output .= '<option value="'.$proveedor['IdProveedor'].'">'.$proveedor['NombreProveedor'].'</option>';
        }
        echo $output;
        
        
    }
    
    public function ConsultarProveedorPorId()
    {
        if ($this->input->post('IdProveedor')!= null)
        {
            
            $Proveedor = $this->Proveedor_Model->ConsultarProveedorPorId($this->input->post('IdProveedor'));
            
            if ($Proveedor != FALSE)
            {
                echo json_encode($Proveedor); 
            }
            else 
            {
                echo 2;
     
            }
            
        }
    }
    public function CargarCatalogoProductos_ajax()
    {
        $IdServicio = $this->input->post('IdServicio');
        $Productos=  $this->CatalogoProductos_Model->ConsultarProductosPorServicio($IdServicio);
            
            $output='<option value="">Selecciona un Producto</option>';
            foreach($Productos as $producto)
            {
                $output .= '<option value="'.$producto['IdProducto'].'">'.$producto['DescripcionProducto'].'</option>';
            }
            echo $output;
        
    }
    
    public function ConsultarSubProducto_ajax()
    {
        if ($this->input->post('CodigoSubProducto')!= null)
        {
            
            $SubProducto = $this->SubProducto_Model->ConsultarSubProducto($this->input->post('CodigoSubProducto'));
            
            echo json_encode($SubProducto);
            
        }
        else
        {
            echo 2;
        }
        
    }
    
    /*
     * DESCRIPCION: Función para mostrar la consulta del inventario 
     * RETURN: 
     */
    public function ConsultarInventario()
    {
        
        $data['ProductosInventario'] = $this->CatalogoProductos_Model->ConsultarProductosInventario($this->session->userdata('IdClinica'));
        $data['title']= "Consulta Inventario";
        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('Inventario/ConsultaInventario',$data);
        $this->load->view('templates/FooterContainer');
        
        
    }
    
    public function ConsultarDetalleProducto($IdProducto)
    {
        try
        {
            $IdClinica = $this->session->userdata('IdClinica');
            $data['InformacionProducto'] = $this->CatalogoProductos_Model->ConsultarProductoPorId($IdProducto);
            $data['SubProductos'] = $this->SubProducto_Model->ConsultarSubProductosProducto($IdProducto,$IdClinica);
            $data['MovimientosInventario'] = $this->MovimientoInventario_Model->ConsultarMovimientosProducto($IdProducto,$IdClinica);


            $data['title']= "Consulta Inventario";
            $data['ProductoActionsEnabled'] = false;
            $this->load->view('templates/MainContainer',$data);
            $this->load->view('templates/HeaderContainer',$data);
            $this->load->view('Producto/CardDetalleProducto',$data);
            $this->load->view('Inventario/CardSubProductosProducto',$data);
            $this->load->view('Inventario/CardMovimientosProducto',$data);
            $this->load->view('templates/FooterContainer');
            
        } catch (Exception $ex) {

        }
        
        
        
    }
    
    public function ConsultarExistenciaSubProducto_ajax()
    {
         $IdCodigoSubProducto = $this->input->post('CodigoSubProducto');
         
        if ($IdCodigoSubProducto !== "")
        {
           
        
            $IdClinica = $this->session->userdata('IdClinica');

            $SubProducto = $this->SubProducto_Model->ConsultarExistenciaPorCaducidadSubProducto($IdCodigoSubProducto,$IdClinica);

            echo json_encode($SubProducto);
        }
        else
        {
            echo json_encode('2');
        }
        
        
        
    }
    
    public function ConsultarServiciosInventario_ajax()
    {
        $ServiciosInventario = $this->Servicio_Model->ConsultarServicios(TRUE);
        
        $output='<option value="">Selecciona un Servicio</option>';
            foreach($ServiciosInventario as $servicio)
            {
                $output .= '<option value="'.$servicio['IdServicio'].'">'.$servicio['DescripcionServicio'].'</option>';
            }
            echo $output;
    }
}
