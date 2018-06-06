<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ingresar | El Milagro EIRL</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url();?>resources/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url();?>resources/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url();?>resources/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url();?>resources/dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url();?>resources/plugins/iCheck/square/blue.css">
	<!--animacion -->
	<link rel="stylesheet" href="<?php echo base_url();?>resources/dist/css/animate.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><b class="text-primary">El Milagro</b> EIRL</a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Ingresar tus datos para iniciar sesión</p>


			<div class="form-group has-feedback">
				<input type="input" class="form-control" id='rut' maxlength="9" placeholder="Rut">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" id='pass' maxlength="20" placeholder="Contraseña">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<input type="checkbox"> Recordarme
						</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="button" id='btIngresar' class="btn btn-primary btn-block btn-flat">Ingresar</button>
				</div>
				<!-- /.col -->
			</div>


    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <a href="#">No recuerdo mi contraseña</a><br>

</div>
<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>resources/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>resources/plugins/iCheck/icheck.min.js"></script>

<script src="<?php echo base_url();?>resources/notify/bootstrap-notify.min.js"></script>

<script src="<?php echo base_url();?>resources/funciones/misfunciones.js"></script>

<script src="<?php echo base_url();?>resources/funciones/jquery.rut.chileno.min.js"></script>

<script>
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' /* optional */
		});

		

	});
</script>

<script type="text/javascript">
	$(function(){
		$('body').on('focusout','#rut',function(e){
			this.value = $.rut.formatear(this.value);
			// if($.rut.validar(this.value)){
			// 		alert('valido');
			// }else{
			// 		alert('malo');
			// }
		});//da formato al input de rut


		$("body").on("click", "#btIngresar", function (e) {
			ingresar();
		});

		$('body').on('keypress','#pass',function (e){
			if (e.which == 13) {
				ingresar();	
			}
		});

	});

	
</script>

</body>
</html>