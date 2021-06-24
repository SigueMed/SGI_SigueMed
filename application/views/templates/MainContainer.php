<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title><?php echo $title;?></title>
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>app-assets/images/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>app-assets/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>app-assets/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>app-assets/images/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>app-assets/images/ico/favicon-2.ico">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>app-assets/images/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/bootstrap.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/vendors/css/extensions/pace.css">

    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/colors.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
    <!-- END Page Level CSS-->


    <script src="<?php echo base_url();?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="<?php echo base_url();?>js/vendor/jquery-3.3.1.js"></script>
    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <!--SIGUEMED JS
    <script src="<?php echo base_url();?>js/siguemed_general.js"></script>-->

    <!--FONTAWESOME-->
  <script src="https://kit.fontawesome.com/58366cd50a.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">




    <!-- END Custom CSS-->
    <style>
        .embed-responsive-10by3 {
            padding-top: 120%;
         }
    </style>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <!-- navbar-fixed-top-->
    <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-light navbar-shadow navbar-border">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
            <li class="nav-item"><a href="index.html" class="navbar-brand nav-link"><img alt="branding logo" src="<?php echo base_url();?>app-assets/images/logo/SigueMEDLogo.png" data-expand="<?php echo base_url();?>app-assets/images/logo/SigueMEDLogo.png" data-collapse="<?php echo base_url();?>app-assets/images/logo/SigueMEDLogoS.png" class="brand-logo"></a></li>
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">
              <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>
              <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li>

            </ul>

            <ul class="nav navbar-nav float-xs-right" vertical-align="middle">

                <li class="dropdown nav-item">
                    <a id="dropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link"><i class="icon-hospital-o"></i><span class="selected">Clínica:<?php echo $this->session->userdata('DescripcionClinica'); ?></span></a>
                    <div aria-labelledby="dropdown-flag" class="dropdown-menu">
                        <a href="<?php echo site_url(); ?>/Clinica/SeleccionarClinica" class="dropdown-item"><i class="icon-loop2"></i>Cambiar Clínica</a>
                    </div>
                </li>
<!--              Navbar Notificaciones 1
              <li class="dropdown dropdown-notification nav-item"><a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="ficon icon-bell4"></i><span class="tag tag-pill tag-default tag-danger tag-default tag-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span><span class="notification-tag tag tag-default tag-danger float-xs-right m-0">5 New</span></h6>
                  </li>
                  <li class="list-group scrollable-container">
                      <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-cart3 icon-bg-circle bg-cyan"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">You have new order!</h6>
                          <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">30 minutes ago</time></small>
                        </div>
                      </div></a>
                      <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-monitor3 icon-bg-circle bg-red bg-darken-1"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading red darken-1">99% Server load</h6>
                          <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Five hour ago</time></small>
                        </div>
                      </div></a>
                      <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-server2 icon-bg-circle bg-yellow bg-darken-3"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                          <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Today</time></small>
                        </div>
                      </div></a>
                      <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-check2 icon-bg-circle bg-green bg-accent-3"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">Complete the task</h6><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Last week</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left valign-middle"><i class="icon-bar-graph-2 icon-bg-circle bg-teal"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">Generate monthly report</h6><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Last month</time></small>
                        </div>
                      </div></a></li>
                  <li class="dropdown-menu-footer"><a href="javascript:void(0)" class="dropdown-item text-muted text-xs-center">Read all notifications</a></li>
                </ul>
              </li>
              Navbar Notificaciones 2
              <li class="dropdown dropdown-notification nav-item"><a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="ficon icon-mail6"></i><span class="tag tag-pill tag-default tag-info tag-default tag-up">8</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span><span class="notification-tag tag tag-default tag-info float-xs-right m-0">4 New</span></h6>
                  </li>
                  <li class="list-group scrollable-container"><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="<?php echo base_url();?>app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Margaret Govan</h6>
                          <p class="notification-text font-small-3 text-muted">I like your portfolio, let's start the project.</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Today</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-busy rounded-circle"><img src="<?php echo base_url();?>app-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Bret Lezama</h6>
                          <p class="notification-text font-small-3 text-muted">I have seen your work, there is</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Tuesday</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="<?php echo base_url();?>app-assets/images/portrait/small/avatar-s-3.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Carie Berra</h6>
                          <p class="notification-text font-small-3 text-muted">Can we have call in this week ?</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Friday</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-away rounded-circle"><img src="<?php echo base_url();?>app-assets/images/portrait/small/avatar-s-6.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Eric Alsobrook</h6>
                          <p class="notification-text font-small-3 text-muted">We have project party this saturday night.</p><small>
                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">last month</time></small>
                        </div>
                      </div></a></li>
                  <li class="dropdown-menu-footer"><a href="javascript:void(0)" class="dropdown-item text-muted text-xs-center">Read all messages</a></li>
                </ul>
              </li>
              <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar"><img src="<?php echo base_url();?>img/ubicacion2.jpg" alt="avatar"><i></i></span><span class="user-name">Clínica:<?php echo $this->session->userdata('DescripcionClinica'); ?></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="<?php echo site_url(); ?>/Clinica/SeleccionarClinica" class="dropdown-item"><i class="icon-loop2"></i>Cambiar Clínica</a>

                </div>
              </li>-->
              <!--Navbar Usuario-->
              <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="<?php echo base_url();?>app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span><span class="user-name"><?php echo $this->session->userdata('NombreUsuario'); ?></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-mail6"></i> My Inbox</a>
                    <a href="#" class="dropdown-item"><i class="icon-clipboard2"></i> Task</a>
                    <a href="#" class="dropdown-item"><i class="icon-calendar5"></i> Calender</a>
                  <div class="dropdown-divider"></div><a href="<?php echo site_url(); ?>/Usuario/CerrarSesion" class="dropdown-item"><i class="icon-power3"></i>Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <!-- main menu-->
    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-light menu-accordion menu-shadow">
      <!-- main menu header-->
      <div class="main-menu-header">
          <label><i class="icon-user"></i> <?php echo $this->session->userdata('NombreUsuario');?></label>
          <label><i class="icon-clock3"></i> <?php echo $this->session->userdata('Turno');?></label>
          <hr>
      </div>

      <!-- / main menu header-->
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
          <li class=" nav-item"><a href="#"><i class="icon-calendar5"></i><span data-i18n="nav.agenda.main" class="menu-title">Agenda</span></a>
            <ul class="menu-content">
              <li><a href="<?php echo site_url();?>/Agenda/VistaAgenda" data-i18n="nav.agenda.main" class="menu-item">Agenda</a>
              </li>
              <li><a href="<?php echo site_url();?>/Agenda/CitasHoy" data-i18n="nav.agenda.main" class="menu-item">Citas del día</a>
              </li>

            </ul>
          </li>
          <?php
            if ($this->session->userdata('IdPerfil') == '1' || $this->session->userdata('IdPerfil') == '2')
            {

                echo '<li class=" nav-item"><a href="#"><i class="icon-ios-people"></i><span data-i18n="nav.advance_cards.main" class="menu-title">Pacientes</span></a>
                    <ul class="menu-content">
                      <li><a href="'.site_url('Paciente/ListaPacientes').'" data-i18n="nav.cards.card_statistics" class="menu-item">Listado de Pacientes </a>
                      </li>
                      <li><a href="'.site_url('Paciente/NuevoPaciente').'" data-i18n="nav.cards.card_statistics" class="menu-item">Registro de Paciente </a>
                      </li>
                      <li><a href="'.site_url('Paciente/SeguimientoPaciente').'" data-i18n="nav.cards.card_statistics" class="menu-item">Seguimiento a Pacientes </a>
                      </li>


                    </ul>
                  </li>';
            }
            ?>
<!--          <li class=" nav-item"><a href="#"><i class="icon-aid-kit"></i><span data-i18n="nav.expediente.main" class="menu-title">Expediente Clínico</span></a>
            <ul class="menu-content">
              <li><a href="<?php echo site_url();?>/ExpedienteClinico/ConsultarExpediente" data-i18n="nav.expediente.main" class="menu-item">Consulta Expediente</a>
              </li>

            </ul>
          </li>-->
          <?php
          if ($this->session->userdata('IdPerfil') == '1'|| $this->session->userdata('IdPerfil') == '2')
          {

              echo '<li class=" nav-item"><a href="#"><i class="icon-lecturer"></i><span data-i18n="nav.project.main" class="menu-title">Recepción</span></a>
                        <ul class="menu-content">
                            <li><a href="'.site_url('NotaRemision/CrearNota').'" data-i18n="nav.invoice.invoice_template" class="menu-item">Cobro Clínica</a>
                            </li>
                            <li><a href="'.site_url('NotaRemision/CrearNotaFarmacia').'" data-i18n="nav.invoice.invoice_template" class="menu-item">Cobro Farmacia</a>
                            </li>
                            <li><a href="'.site_url('SalidaCaja/PagarServicioMedico').'" data-i18n="nav.invoice.invoice_template" class="menu-item">Pagar Servicios Médicos</a>
                            </li>
                            <li><a href="'. site_url('CorteCaja/ElaborarCorteCaja').'" data-i18n="nav.invoice.invoice_template" class="menu-item">Cerrar Caja</a></li>
                            <li><a href="'. site_url('NotaRemision/BuscarNotas').'" data-i18n="nav.invoice.invoice_template" class="menu-item">Buscar Notas</a></li>
                            <li><a href="'. site_url('NotaRemision/ConsultarNotasDeRemision').'" data-i18n="nav.invoice.invoice_template" class="menu-item">Consultar Notas De Remision</a></li>

                        </ul>
                    </li>';
                    //<li><a href="'.site_url('NotaRemision/RegistrarVentaFarmacia').'" data-i18n="nav.invoice.invoice_template" class="menu-item">Cobro Farmacia</a>
                    //</li>
          }
          ?>

           <?php
            if ($this->session->userdata('IdPerfil') == '2')
            {

                echo '<li class=" nav-item"><a href="#"><i class="icon-ios-albums-outline"></i><span data-i18n="nav.cards.main" class="menu-title">Administrar Caja</span></a>
                    <ul class="menu-content">

                      <li><a href="'. site_url('CorteCaja/ConsultaCortesCaja').'" data-i18n="nav.invoice.invoice_template" class="menu-item">Consultar Cortes Caja</a></li>
                      <li><a href="'. site_url('Proveedores/PagarProveedor').'" data-i18n="nav.cards.card_bootstrap" class="menu-item">Pago a Proveedor</a>
                      <li><a href="'. site_url('Proveedores/ConsultarPagosProveedor').'" data-i18n="nav.cards.card_bootstrap" class="menu-item">Consultar Pagos Proveedor</a>
                      <li><a href="'. site_url('NotaRemision/ConsultarNotasRemision').'" data-i18n="nav.cards.card_bootstrap" class="menu-item">Consultar Notas Remisión</a>
                      </li>

                    </ul>
                </li>
                        <li class=" nav-item"><a href="#"><i class="icon-archive2"></i><span data-i18n="nav.advance_cards.main" class="menu-title">Inventario</span></a>
                        <ul class="menu-content">';
                echo '<li><a href="'. site_url('/Inventario/RegistrarEntrada').'" data-i18n="nav.cards.card_statistics" class="menu-item">Registrar Entrada </a>
                    </li>';
                echo '<li><a href="'. site_url('/Inventario/ConsultarInventario').'" data-i18n="nav.cards.card_charts" class="menu-item">Consultar Inventario</a>
                    </li>
                    </ul>
                </li>';
            }
          ?>
          <?php
            if ($this->session->userdata('IdPerfil') == '2')
            {

                echo '<li class=" nav-item"><a href="#"><i class="icon-monitor"></i><span data-i18n="nav.advance_cards.main" class="menu-title">Catalogos SígueMED</span></a>
                        <ul class="menu-content">';
                echo '<li><a href="#" data-i18n="nav.menu_levels.second_level_child.main" class="menu-item">Catalogo de Productos</a>
                        <ul class="menu-content">';
                echo '<li><a href="'. site_url('/Catalogos/AltaProductos').'" data-i18n="nav.cards.card_statistics" class="menu-item">Alta Productos </a>
                    </li>';
                echo '<li><a href="'. site_url('/Catalogos/ActualizacionPrecios').'" data-i18n="nav.cards.card_statistics" class="menu-item">Actualización Precios </a>
                    </li>';

                        echo '<li><a href="'. site_url('/Catalogos/ConsultaProductos').'" data-i18n="nav.cards.card_charts" class="menu-item">Consultar Productos</a>
                        </li>
                      </ul>
                    </li>';

                //CATALOGO USUARIOS
                echo '<li><a href="#" data-i18n="nav.menu_levels.second_level_child.main" class="menu-item">Catalogo de Usuarios</a>
                        <ul class="menu-content">';
                if($this->session->userdata('IdPerfil')=='2')
                {
                    echo '<li><a href="'. site_url('/Catalogos/NuevoUsuario').'" data-i18n="nav.cards.card_statistics" class="menu-item">Alta Usuario </a>
                        </li>';

                }
                        echo '<li><a href="'. site_url('/Catalogos/ConsultaUsuarios').'" data-i18n="nav.cards.card_charts" class="menu-item">Consultar Usuarios</a>
                        </li>
                      </ul>
                    </li>';



              //Catalogo de Cuentas
            echo '<li><a href="#" data-i18n="nav.menu_levels.second_level_child.main" class="menu-item">Catalogo de Cuentas</a>
                    <ul class="menu-content">';
            if($this->session->userdata('IdPerfil')=='2')
            {
                echo '<li><a href="'. site_url('/Catalogos/NuevaCuenta').'" data-i18n="nav.cards.card_statistics" class="menu-item">Alta de Cuentas </a>
                    </li>';

            }
                    echo '<li><a href="'. site_url('/Catalogos/ConsultarCuentas').'" data-i18n="nav.cards.card_charts" class="menu-item">Consultar Cuentas</a>
                    </li>
                  </ul>
                </li>';

                //CATALOGO Clinicas
                echo '<li><a href="#" data-i18n="nav.menu_levels.second_level_child.main" class="menu-item">Catalogo de Clinicas</a>
                        <ul class="menu-content">';
                if($this->session->userdata('IdPerfil')=='2')
                {
                    echo '<li><a href="'. site_url('/Catalogos/NuevaClinica').'" data-i18n="nav.cards.card_statistics" class="menu-item">Alta Nueva Clinica</a>
                        </li>';

                }
                        echo '<li><a href="'. site_url('/Catalogos/ConsultarClinicas').'" data-i18n="nav.cards.card_charts" class="menu-item">Consultar Clinicas</a>
                        </li>
                      </ul>
                    </li>';
        }
          ?>

          <?php
                //CATALOGO SERVICIOS
                if ($this->session->userdata('IdPerfil') == '2')
                {
                echo '<li><a href="#" data-i18n="nav.menu_levels.three_level_child.main" class="menu-item">Catalogo de Servicios</a>
                        <ul class="menu-content">';
                if($this->session->userdata('IdPerfil')=='2')
                {
                    echo '<li><a href="'. site_url('/Catalogos/NuevoServicio').'" data-i18n="nav.cards.card_statistics" class="menu-item">Alta Servicio</a>
                        </li>';

                }
                        echo '<li><a href="'. site_url('/Catalogos/ConsultarServicios').'" data-i18n="nav.cards.card_charts" class="menu-item">Consultar Servicios</a>
                        </li>
                      </ul>
                    </li>';
            }
          ?>

        </ul>
      </div>
      <!-- /main menu content-->
      <!-- main menu footer-->
      <!-- include includes/menu-footer-->
      <!-- main menu footer-->
    </div>
    <!-- / main menu-->
