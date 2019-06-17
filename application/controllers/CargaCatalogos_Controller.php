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
    
    public function CargarProductosPorServicio_ajax()
    {
     
        $IdServicio = $this->input->post('IdServicio');
        $this->load->model('CatalogoProductos_Model');
        $Productos = $this->CatalogoProductos_Model->ConsultarProductosPorServicio($IdServicio);
        
         $output='<option value="">Selecciona un Producto</option>';
         
        foreach($Productos as $producto)
        {
            $output .= '<option value="'.$producto['IdProducto'].'">'.$producto['DescripcionProducto'].'</option>';
        }
        echo $output;
        
        
        
    }
    //put your code here
}
