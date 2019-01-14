<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotaMedica_Controller
 *
 * @author SigueMed
 */

require_once(dirname(__FILE__)."/Agenda_Controler.php");

class NotaMedica_Controller extends Agenda_Controler {
    
    public function __construct() {
        parent::__construct();
        //Cargar herramientas para form
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url_helper');
        
        //Cargar Modelos usados por el Controlador para el manejo de las Notas Medicas
        $this->load->model('NotaMedica_Model');
        $this->load->model('Paciente_Model');
        $this->load->model('CitaServicio_Model');
        $this->load->model('AntecedenteNotaMedica_Model');
        $this->load->model('CatalogoDiagnosticos_Model');
        $this->load->model('Servicio_Model');
        $this->load->model('CatalogoProductos_Model');
        $this->load->model('ProductosNotaMedica_Model');
        $this->load->model('DiagnosticoNotaMedica_Model');
       
        
    }
    
    public function Load_RegistrarSomatometria($IdCita)
    {
        $Cita = $this->CitaServicio_Model->ConsultarCitaPorId($IdCita);
        $Paciente = $this->Paciente_Model->ConsultarPacientePorId($Cita->IdPaciente);
        $data['Paciente'] = $Paciente;
        $data['Cita']= $Cita;
        
        $data['title']='Somatometria Paciente';
        $data['PacienteSubmitAction'] = '';
        $data['PacienteActionsEnabled'] = false;
        $data['SomatometriaActionsEnabled'] = true;
        $data['SomatometriaSubmitAction']='confirmar';
        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('NotaMedica/FormRegistrarSomatometria',$data);
        $this->load->view('Paciente/PacienteCard',$data);
        $this->load->view('NotaMedica/SomatometriaCard',$data);
        $this->load->view('templates/FormFooter',$data); 
        $this->load->view('templates/FooterContainer');
    }
    /*
     * Function: RegistrarSomatometria
     * Descripttion:La función mostrara la vista para Registrar los datos de Somatometria del paciente que agendo la Cita <$IdCita> y creará una nueva nota médica
     */
    public function RegistrarSomatometria($IdCita)
    {
        $action = $this->input->post('action');
            
        if ($action =='confirmar')
        {
            //Actualizar Paciente
            $PacienteUpdt = array(
                'Nombre'=>$this->input->post('Nombre'),
                'Apellidos' => $this->input->post('Apellidos'),
                'FechaNacimiento' => $this->input->post('FechaNacimiento'),
                'Calle' => $this->input->post('Calle'),
                'Colonia' => $this->input->post('Colonia'),
                'CP' => $this->input->post('CP'),
                'ViveCon' => $this->input->post('ViveCon'),
                'Escolaridad' => $this->input->post('Escolaridad'),
                'EstadoCivil' => $this->input->post('EstadoCivil'),
                'NumCelular' => $this->input->post('Celular'),
                'email'=> $this->input->post('email')
                );

            $Cita = $this->CitaServicio_Model->ConsultarCitaPorId($IdCita);
            $this->Paciente_Model->ActualizarPaciente($Cita->IdPaciente, $PacienteUpdt);
            
            //Crear Nota Medica 
            $this->CrearNuevaNotaMedica($IdCita);
            $this->CitaServicio_Model->ActualizarEstatusCita($IdCita, REGISTRADA);
        }
       
        $this->CitasDeHoy(); 
      
            
            
    }
    /*
     * Function: NuevaNotaMedica
     * Description: La función recibirá el Id del Paciente y del servicio para mostrar el formato NotaMedica.php para la creación de una nueva nota
     */
    public function CrearNuevaNotaMedica($IdCita)
    {
        
        //$this->load->view('templates/header');
        //Cargar Información Ultima Nota del Paciente por Servicio
        $Cita = $this->CitaServicio_Model->ConsultarCitaPorId($IdCita);
        $IdUltimaNota = $this->NotaMedica_Model->ConsultarUltimaNotaMedicaPorPaciente($Cita->IdPaciente,$Cita->IdServicio);
        
        if(!isset($Cita->IdNotaMedica))
        {
            $DatosSomatometria = array(
            'PesoPaciente'=>$this->input->post('Peso'),
            'TallaPaciente'=> $this->input->post('Talla'),
            'PresionPaciente'=> $this->input->post('TA'),
            'FrCardiacaPaciente'=> $this->input->post('FC'),
            'FrRespiratoriaPaciente'=> $this->input->post('FR'),
            'TemperaturaPaciente'=> $this->input->post('Temperatura')
             );
            
            $IdEmpleado =  $this->session->userdata('IdEmpleado');
            $NuevaNotaMedica = $this->NotaMedica_Model->CrearNuevaNotaMedica($IdCita,$DatosSomatometria,$IdEmpleado,$IdUltimaNota);
            $this->CitaServicio_Model->AsignarNotaMedica($IdCita, $NuevaNotaMedica);
        }
        
    }   
    
    public function Load_ElaborarNotaMedica($IdNotaMedica)
    {
        $NotaMedica = $this->NotaMedica_Model->ConsultarNotaMedicaPorId($IdNotaMedica);
        $data['NotaMedica'] = $NotaMedica;
        $data['Paciente'] = $this->Paciente_Model->ConsultarPacientePorId($NotaMedica->IdPaciente);
        $data['Antecedentes'] = $this->AntecedenteNotaMedica_Model->ConsultarAntecedentesNota($IdNotaMedica);
        $data['Servicios'] = $this->Servicio_Model->ConsultarServicios();
        
        $data['title']='Nota Medica';
        $data['PacienteSubmitAction'] = '';
        $data['PacienteActionsEnabled'] = false;
        $data['SomatometriaActionsEnabled'] = false;
        $data['SomatometriaSubmitAction']='';
        $data['ProductosNotaActionsEnabled']= true;
        $data['ProductosNotaSubmitAction']='guardar';
        
        $this->load->view('templates/MainContainer',$data);
        $this->load->view('templates/HeaderContainer',$data);
        $this->load->view('NotaMedica/FormNotaMedica',$data);
        $this->load->view('Paciente/PacienteCard',$data);
        $this->load->view('NotaMedica/SomatometriaCard',$data);
        $this->load->view('NotaMedica/CardAntecedentes',$data);
        $this->load->view('NotaMedica/CardDiagnosticoNotaMedica',$data);
        $this->load->view('NotaMedica/CardProductosNotaMedica',$data);
        $this->load->view('NotaMedica/CardSeguimiento',$data);
        $this->load->view('templates/FormFooter',$data); 
        $this->load->view('templates/FooterContainer');
        
    }
    
    public function ElaborarNotaMedica($IdNotaMedica)
    {
     
        try
        {
        $action = $this->input->post('action');

        if ($action =='guardar')
        {
                $DatosNotaMedica = array(
                'PesoPaciente'=>$this->input->post('Peso'),
                'TallaPaciente'=> $this->input->post('Talla'),
                'PresionPaciente'=> $this->input->post('TA'),
                'FrCardiacaPaciente'=> $this->input->post('FC'),
                'FrRespiratoriaPaciente'=> $this->input->post('FR'),
                'TemperaturaPaciente'=> $this->input->post('Temperatura'),
                'DiagnosticoGeneral' => $this->input->post('DiagnosticoGeneral')
             );
                
                $this->db->trans_begin();

            $Antecedentes = $this->AntecedenteNotaMedica_Model->ConsultarAntecedentesNota($IdNotaMedica);


            foreach($Antecedentes as $Antecedente)
            {
                $DescripcionAntecedente = $this->input->post('Antecedente'.$Antecedente['IdAntecedenteNotaMedica']);
                $this->AntecedenteNotaMedica_Model->ActualizarAntecedente($Antecedente['IdAntecedenteNotaMedica'],$DescripcionAntecedente);

            }

            $this->NotaMedica_Model->ActualizarNotaMedica($IdNotaMedica,$DatosNotaMedica);

            $DatosPaciente = array(
                'Nombre'=>$this->input->post('Nombre'),
                'Apellidos' => $this->input->post('Apellidos'),
                'FechaNacimiento' => $this->input->post('FechaNacimiento'),
                'Calle' => $this->input->post('Calle'),
                'Colonia' => $this->input->post('Colonia'),
                'CP' => $this->input->post('CP'),
                'ViveCon' => $this->input->post('ViveCon'),
                'Escolaridad' => $this->input->post('Escolaridad'),
                'EstadoCivil' => $this->input->post('EstadoCivil'),
                'NumCelular' => $this->input->post('Celular'),
                'email'=> $this->input->post('email')
            );
            $NotaMedica = $this->NotaMedica_Model->ConsultarNotaMedicaPorId($IdNotaMedica);

            $this->Paciente_Model->ActualizarPaciente($NotaMedica->IdPaciente,$DatosPaciente);

            $Cita = $this->CitaServicio_Model->ConsultarCitaPorNotaMedica($IdNotaMedica);
            $this->CitaServicio_Model->ActualizarEstatusCita($Cita->IdCitaServicio,ATENDIDA);

             $IdProductos = $this->input->post('IdProducto');
             $cantidadProductos = $this->input->post('cantidad');
             $precioProductos = $this->input->post('precio');
             $DescuentoProductos = $this->input->post('producto');
             
             if (isset($IdProductos))
             {
             
                for ($i=0;$i<sizeof($IdProductos); $i++)
                {
                    $NuevoProducto = array(
                        'IdProducto'=>$IdProductos[$i],
                        'cantidad'=>$cantidadProductos[$i],
                        'precio'=> $precioProductos[$i],
                        'descuento'=>$DescuentoProductos[$i]
                    );

                $this->ProductosNotaMedica_Model->AgregarProductoNotaMedica($IdNotaMedica,$NuevoProducto);
                }
                 
             }
             
             $IdDiagnosticos = $this->input->post('IdDiagnostico');
             
             if(isset($IdDiagnosticos))
             {
                 for($i=0; $i<sizeof($idDiagnosticos);$i++)
                 {
                     $data[]= array(
                         'IdDiagnostico'=>$IdDiagnosticos[$i],
                         'IdNotaMedica'=>$IdNotaMedica
                     );
                 }
                 
                 $this->DiagnosticoNotaMedica_Model->AgregarDiagnosticosNotaMedicaBatch($data);
                 
             }
             
             if($this->db->trans_status()===FALSE)
             {
                 $this->db->trans_rollback();
                 echo "<script>alert('Hubo un error al guardar la información');</script>";
             }
             else
             {
                 $this->db->trans_commit();
                 echo "<script>alert('La Nota Medica ha sido guardada con éxito');</script>";
             }
             
        }   

        $this->CitasDeHoy();
        
        }
        catch(Exception $e)
        {
            $this->db->trans_rollback();
            echo "<script>alert('Hubo un error al guardar la información');</script>";   
            log_message('error', $e->getMessage());
        }
           
    }
    
    public function ConsultarProductosPorServicio()
    {
        
        if($this->input->post('servicio_id'))
        {
        
            $Productos=  $this->CatalogoProductos_Model->ConsultarProductosPorServicio($this->input->post('servicio_id'));
            
            $output='<option value="">Selecciona un Producto</option>';
            foreach($Productos as $producto)
            {
                $output .= '<option value="'.$producto['IdProducto'].'">'.$producto['DescripcionProducto'].'</option>';
            }
            echo $output;
        }
        
    }
    
    public function ConsultarProductoPorId()
    {
        if($this->input->post('producto_id'))
        {
            
            $Producto_detail = $this->CatalogoProductos_Model->ConsultarProductoPorId($this->input->post('producto_id'));
            
            echo json_encode($Producto_detail);
        }
    }
    
    public function CargarCBDiagnosticoServicio()
    {
        if($this->input->post('servicio_id'))
        {
            $CategoriasDiagnostico = $this->CatalogoDiagnosticos_Model->ConsultarDiagnosticosPorServicio($this->input->post('servicio_id'));
            
            $output='<option value="">Selecciona una Categoria</option>';
            foreach ($CategoriasDiagnostico as $Categoria)
            {
                $output .= '<option value="'.$Categoria['IdDiagnostico'].'">'.$Categoria['DescripcionDiagnostico'].'</option>';
            }
            
            echo $output;
        }
    }
    
    
  
   
}
    
