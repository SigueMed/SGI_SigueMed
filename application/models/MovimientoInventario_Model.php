<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MovimientoInventario_Model
 *
 * @author SigueMED
 */
class MovimientoInventario_Model extends CI_Model {
    private $table;
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table="movimientosinventario";
        $this->load->model("ExistenciaInventario_Model");

    }

    public function RegistrarEntrada($MovimientoInventario)
    {
        $result = $this->db->insert($this->table,$MovimientoInventario);


        if($result >=1)
        {
            $cantidadExistencia = $this->ExistenciaInventario_Model->ConsultarExistencias($MovimientoInventario['IdClinica'],$MovimientoInventario['IdCodigoSubProducto'],$MovimientoInventario['Lote']);

            log_message('debug','Cantidad Existencia=>'.$cantidadExistencia);

            if($cantidadExistencia!==FALSE)
            {
                $cantidadExistencia = $cantidadExistencia+$MovimientoInventario['CantidadMovimiento'];
                log_message('debug','Movimiento Inventario=>'.$MovimientoInventario['CantidadMovimiento']);
                log_message('debug','Cantidad Existencia Actualizada=>'.$cantidadExistencia);
                $ExistenciaInventario = array(
                    'IdClinica'=> $MovimientoInventario['IdClinica'],
                    'IdCodigoSubProducto' => $MovimientoInventario['IdCodigoSubProducto'],
                    'Lote' => $MovimientoInventario['Lote'],
                    'CantidadInventario'=>$cantidadExistencia
                );
                $movimiento = $this->ExistenciaInventario_Model->ActualizarExistencia($ExistenciaInventario);
                if ($movimiento!==FALSE)
                {
                    return true;
                }


            }
            else
            {
                $NuevaExistencia = $MovimientoInventario['CantidadMovimiento'];
                $ExistenciaInventario = array(
                    'IdClinica'=> $MovimientoInventario['IdClinica'],
                    'IdCodigoSubProducto' => $MovimientoInventario['IdCodigoSubProducto'],
                    'Lote' => $MovimientoInventario['Lote'],
                    'CantidadInventario'=>$NuevaExistencia
                );
                $movimiento = $this->ExistenciaInventario_Model->RegistrarNuevaExistencia($ExistenciaInventario);
                if ($movimiento!==FALSE)
                {
                    return true;
                }
            }
        }
        return false;
    }

    public function ConsultarMovimientosProducto($IdProducto,$IdClinica)
    {
      $query=$this->db->query('call Inventario_ConsultaDetalleMovimientosPorProducto('.$IdProducto.','.$IdClinica.')');

      return $query->result_array();


    }

    public function RegistrarSalidaInventario($IdCodigoSubproducto, $Lote, $CantidadSalida, $IdClinica)
    {
        $Fecha = now();

        $cantidadExistencia = $this->ExistenciaInventario_Model->ConsultarExistencias($IdClinica,$IdCodigoSubproducto,$Lote);

        if (intval($CantidadSalida)<= intval($cantidadExistencia->CantidadInventario))
        {
            $SalidaInventario = array(
                'IdCodigoSubproducto'=>$IdCodigoSubproducto,
                'Lote'=> $Lote,
                'IdTipoMovimientoInventario'=>2,
                'FechaMovimiento'=> mdate('%Y-%m-%d',$Fecha),
                'CantidadMovimiento'=> $CantidadSalida,
                'IdClinica'=> $IdClinica
            );
            $result = $this->db->insert($this->table,$SalidaInventario);



            if($result >=1)
            {

                $CantidadInventario =  intval($cantidadExistencia->CantidadInventario) - intval($CantidadSalida);
                echo '<script>alert("'.$CantidadInventario.','.$cantidadExistencia.'-'.$CantidadSalida.');</script>';



                $ExistenciaInventario = array(
                    'IdClinica'=> $IdClinica,
                    'IdCodigoSubProducto' =>$IdCodigoSubproducto,
                    'Lote' => $Lote,
                    'CantidadInventario'=>$CantidadInventario
                );
                $movimiento = $this->ExistenciaInventario_Model->ActualizarExistencia($ExistenciaInventario);
                if ($movimiento!==FALSE)
                    {
                        return true;
                    }
              }
              else
              {
                  return false;
              }
            }

        else
        {
            throw new Exception("INVENTARIO:No se puede registrar una salida mayor a la existencia");
        }


    }
    //put your code here
}
