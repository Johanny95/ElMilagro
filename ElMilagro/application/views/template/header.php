<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$usuario = $this->session->userdata('usuario');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="Johanny adonis Lopez Mendez">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>resources/dist/img/logos/icono.gif" type="image/gif">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!--Morris datacharts-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/morris.js/morris.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/dist/css/AdminLTE.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>resources/dist/css/skins/_all-skins.min.css">

      <link rel="stylesheet" href="<?php echo base_url(); ?>resources/dist/css/Style.css">

      <!-- TagsInput -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/tagsinput/src/bootstrap-tagsinput.css">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!--- JS -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>resources/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url(); ?>resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>resources/bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url(); ?>resources/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url(); ?>resources/bower_components/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo base_url(); ?>resources/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>
    <!-- bootstrap color picker -->
    <script src="<?php echo base_url(); ?>resources/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url(); ?>resources/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url(); ?>resources/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url(); ?>resources/plugins/iCheck/icheck.min.js"></script>

    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>resources/bower_components/fastclick/lib/fastclick.js"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>resources/dist/js/adminlte.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>resources/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap  -->
    <script src="<?php echo base_url(); ?>resources/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- SlimScroll -->
    <script src="<?php echo base_url(); ?>resources/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <!-- ChartJS -->
    <script src="<?php echo base_url(); ?>resources/bower_components/Chart.js/Chart.js"></script>

    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>resources/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/datatables/extensions/bootstrap_extensions/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/datatables/extensions/bootstrap_extensions/js/buttons.bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/datatables/extensions/bootstrap_extensions/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/datatables/extensions/bootstrap_extensions/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/datatables/extensions/bootstrap_extensions/js/buttons.colVis.min.js"></script>
    <!-- Pace -->
    <script src="<?php echo base_url(); ?>resources/plugins/pace/pace.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/pace/pace.min.css">

    <!-- fancybox -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>resources/dist/js/pages/dashboard2.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>resources/dist/js/demo.js"></script> 
    <!--notificaciones-->
    <script src="<?php echo base_url(); ?>resources/notify/bootstrap-notify.min.js"></script>
    <!--funciones propias y de rut-->
    <script src="<?php echo base_url();?>resources/funciones/misfunciones.js"></script>
    <script src="<?php echo base_url();?>resources/funciones/jquery.rut.chileno.min.js"></script>
    <script src="<?php echo base_url();?>resources/funciones/funciones_materiales.js"></script>
    <!--JS morris-->
    <!-- Morris.js charts -->
    <script src="<?php echo base_url(); ?>resources/bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/bower_components/morris.js/morris.min.js"></script>


    <title>Ménu | El Milagro EIRL</title>
  </head>

  <body class="hold-transition fixed skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
          <div class="logo-mini logo-img">
            <!--<img class="logo-img" src="<?php echo base_url(); ?>resources/logo.png"/>-->
            EM
          </div>
          <span class="logo-lg logo-img">
            El Milagro EIRL
            <!--<img class="logo-img" src="<?php echo base_url(); ?>resources/logo.png"/>-->
          </span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">

                <ul class="dropdown-menu">

                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <li><!-- start message -->

                    </li>
                    <!-- end message -->

                  </ul>
                </li>

              </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->

            <!-- Tasks: style can be found in dropdown.less -->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user margin-right-5"></i>
                <span class="hidden-xs"><?php echo $usuario[0]->NOMBRE; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url(); ?>resources/dist/img/usuario.jpg" class="img-circle" alt="User Image">
                  <p>
                    <h4><?php echo $usuario[0]->NOMBRE; ?></h4>
                    <small>Cargo: <?php echo $usuario[0]->NOMBRE_ROL; ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <h5><?php echo $usuario[0]->RUT_USUARIO?></h5>
                  <h5><?php echo $usuario[0]->CORREO?></h5>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="<?php echo site_url(); ?>/logout">
                      <i class="fa fa-sign-out"></i> Cerrar Sesión
                    </a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- search form -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">



          <?php if($usuario[0]->ID_ROL == 1 || $usuario[0]->ID_ROL == 2){?>
          <li class="header">Materiales y herramientas</li>

          <li class="treeview">
            <a href="#"><i class="fa fa-cubes"></i> <span>Materiales</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php print site_url()?>/dashboard"><i class="fa fa-plus"></i><span>Entrada</span></a></li>
              <li><a href="<?php print site_url()?>/salidaMaterial"><i class="fa fa-truck"></i><span>Salida</span></a></li>
              <li><a href="<?php print site_url()?>/stockMaterial"><i class="fa fa-list-ol"></i><span>Stock</span></a></li>
            </ul>

          </li>

          <li class="treeview">
            <a href="#"><i class="fa fa-wrench"></i> <span>Herramientas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php print site_url()?>/subirArchivo"><i class="fa fa-plus"></i><span>Ingresar</span></a></li>
              <li><a href="<?php print site_url()?>/subirArchivo"><i class="fa fa-truck"></i><span>Prestación</span></a></li>
            </ul>
          </li>
          <?php }?>
          <?php if($usuario[0]->ID_ROL == 1 ){?>
          <li class="header">Usuarios y permisos</li>

          <li class="treeview">
            <a href="#"><i class="fa fa-user"></i> <span>Usuarios</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo site_url()?>/ingresoPersonal"><i class="fa fa-user-plus"></i><span>Ingresar usuarios</span></a></li>
            </ul>
          </li>
          <li class="header">Proyectos</li>
          <li class="treeview">
            <a href="#"><i class="fa fa-folder"></i> <span>Proyectos y recursos</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo site_url()?>/charts"><i class="fa fa-folder-open"></i><span>Ingresar proyecto</span></a></li>
            </ul>
          </li>
          <li class="header">Reportes</li>

          <li class="treeview">
            <a href="#"><i class="fa fa-folder"></i> <span>Trazabilidad de materiales</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo site_url()?>/charts"><i class="fa fa-folder-open"></i><span>Ver tranzabilidad</span></a></li>
            </ul>
          </li>

          <?php }?>




        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!--fin menu-->
