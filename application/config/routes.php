<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//Control de Agenda
$route['Agenda/CitasHoy'] = 'Agenda_Controler/Load_ConsultarCitas';
$route['Agenda/VistaAgenda'] = 'Agenda_Controler';
$route['Agenda/CargarAgenda'] = 'Agenda_Controler/CargarAgenda';
$route['Agenda/ConfirmarCita/(.+)'] = 'Agenda_Controler/Load_ConfirmarCita/$1';
$route['Agenda/CitasAtendidas'] = 'Agenda_Controler/CitasAtendidas';
$route['NotaMedica/Registrar/(.+)'] = 'NotaMedica_Controller/Load_RegistrarSomatometria/$1';

//Index.php Dirige al Login
$route['default_controller'] = 'Login_Controller/Cargar_Login';

//$route['default_controller'] = 'Ccalendar';
$route['NotaMedica/ElaborarNota/(.+)'] = 'NotaMedica_Controller/Load_ElaborarNotaMedica/$1';
$route['Usuario/CerrarSesion'] = 'Login_Controller/CerrarSesion';
$route['Clinica/SeleccionarClinica'] = 'Clinica_Controller/Cargar_SeleccionarClinica';


//Expediente Clinico
$route['ExpedienteClinico/ConsultarExpediente'] = 'ExpedienteClinico_Controller/ConsultarExpedientePacientes';
$route['ExpedienteClinico/ConsultarNotaMedica/(.+)'] = 'NotaMedica_Controller/ConsultarNotaMedica/$1';

//Inventario
$route['Inventario/RegistrarEntrada'] = 'Inventario_Controller/Load_RegistrarEntradaInventario';
$route['Inventario/ConsultarInventario'] = 'Inventario_Controller/ConsultarInventario';
$route['Inventario/ConsultarDetalleProducto/(.+)'] = 'Inventario_Controller/ConsultarDetalleProducto/$1';

//Paciente

$route['Paciente/ListaPacientes'] = 'Paciente_Controller/ConsultarPacientes';
$route['Paciente/EditarPaciente/(.+)'] = 'Paciente_Controller/Load_EditarPaciente/$1';
$route['Paciente/SeguimientoPaciente'] = 'Seguimiento_Controller/Load_ConsultarSeguimientoPacientes';
$route['Paciente/NuevoPaciente'] = 'Paciente_Controller/Load_AgregarNuevoPaciente';



//Nota de Remisión

$route['NotaRemision/CrearNota'] = 'NotaRemision_Controller/Load_RegistrarNotaRemision';
$route['NotaRemision/CrearNotaFarmacia'] = 'NotaRemision_Controller/Load_RegistrarVentaFarmacia';
//$route['NotaRemision/RegistrarVentaFarmacia'] = 'NotaRemision_Controller/Load_RegistrarVentaFarmacia';
$route['NotaRemision/CrearPDF/(.+)'] = 'NotaRemision_Controller/generarPDFNotaRemision/$1';
$route['NotaRemision/CargarNotaRemision/(.+)'] = 'NotaRemision_Controller/CargarTemplateNotaRemision/$1';



//SALIDA CAJAS
$route['SalidaCaja/PagarServicioMedico'] = 'SalidaCaja_Controller/Load_PagarServicioMedico';
$route['SalidaCaja/AbrirPDFSalida/(.+)'] = 'templates/NewWindow/$1';
$route['SalidaCaja/CargarPDFSalida/(.+)'] = 'SalidaCaja_Controller/CargarPDFSalida/$1';

//CORTE CAJA
$route['CorteCaja/ElaborarCorteCaja'] = 'CorteCaja_Controller/Load_IniciarCorteCaja';
$route['CorteCaja/DetalleCorteCaja'] = 'CorteCaja_Controller/Load_RealizarCorteCajaCuenta';
$route['CorteCaja/ConsultaCortesCaja'] = 'CorteCaja_Controller/Load_ConsultarCortesCaja';
$route['CorteCaja/ConsultarDetalleCorte/(.+)'] = 'CorteCaja_Controller/Load_ConsultarDetalleCorteCaja/$1';
$route['CorteCaja/ImprimirCorteCaja/(.+)'] = 'CorteCaja_Controller/ImprimirCorte/$1';
$route['CorteCaja/ImprimirTicketCorteCaja/(.+)']='CorteCaja_Controller/ImprimirTicketCorte/$1';

//CAJA
$route['NotaRemision/ConsultarNotasRemision'] = 'NotaRemision_Controller/Load_ConsultaNotasRemision';
$route['NotaRemision/BuscarNotas'] = 'NotaRemision_Controller/Load_BuscarNotas';

//DASHBOARD
$route['Dashboard/Main'] = 'Dashboard_Controller/Load_Dashboard';

//CATALOGOS
$route['Catalogos/AltaProductos'] = 'CatalogoProductos_Controller/Load_AltaProductos';
$route['Catalogos/ActualizacionPrecios'] = 'CatalogoProductos_Controller/Load_PreciosProductos';
$route['Catalogos/ConsultaProductos'] = 'CatalogoProductos_Controller/Load_CatalogoProductos';

//Proveedores
$route['Proveedores/PagarProveedor'] = 'Proveedor_Controller/Load_PagarProveedor';

//usuarios
$route['Catalogos/NuevoUsuario'] = 'Usuario_Controller/Load_AgregarNuevoUsuario';
$route['Catalogos/ConsultaUsuarios'] = 'Usuario_Controller/Load_ConsultarUsuarios';
