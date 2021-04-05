<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cuenta_Controller
 *
 * @author SigueMED
 */
class Cuenta_Controller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('Cuenta_Model');

    }

    public function ConsultarCuentasProducto_ajax()
    {
        $IdProducto = $this->input->post('producto_id');


        if ($IdProducto !== null)
        {
            $CuentasProducto = $this->Cuenta_Model->ConsultarCuentasPorProducto($IdProducto);

            if(sizeof($CuentasProducto)>0)
            {
                $output ='<option value ="">Cuenta Base</option>';
                foreach($CuentasProducto as $cuentaProducto)
                {
                    if ($cuentaProducto['CuentaBase']=="1")
                    {
                        $output .='<option value ="'.$cuentaProducto['IdCuenta'].'" selected="selected">'.$cuentaProducto['DescripcionCuenta'].'</option>';
                    }
                    else
                    {
                        $output .='<option value ="'.$cuentaProducto['IdCuenta'].'|'.$cuentaProducto['PorcentajeCuenta'].'">'.$cuentaProducto['DescripcionCuenta'].'</option>';
                    }

                }
            }
            else
            {
                $output ='<option value="" selected = "selected">Cuenta Base</option>';
            }

            echo $output;
        }
    }

    public function ConsultarCuentaMaestra()
    {

      $CuentaMaestra = $this->Cuenta_Model->ConsultarCuentaMaestra();

      echo json_encode($CuentaMaestra);
      // code...
    }
    //put your code here
}
