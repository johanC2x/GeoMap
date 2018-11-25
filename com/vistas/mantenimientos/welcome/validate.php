<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>GMap</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"><meta name="apple-mobile-web-app-capable" content="yes"> 
<link rel="stylesheet" href="../../../../assets/css/bootstrap.min.css" >
<link href="../../../../assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
<link href="../../../../assets/css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="../../../../assets/css/style.css" rel="stylesheet" type="text/css">
<link href="../../../../assets/css/signin.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="navbar navbar-fixed-top"> 
	<div class="navbar-inner"> 
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="index.html">
				<span><i class="fa fa-map-marker" style='color:red;'></i>GMap</span>			
            </a>	
            <div class="nav-collapse">
				<ul class="nav pull-right">
					<li class="">						
						<a href="../../../../index.php" class="">
							Salir
						</a> 
					</li>
				</ul>
			</div><!--/.nav-collapse -->		
		</div> <!-- /container -->
	</div> <!-- /navbar-inner -->
</div> <!-- /navbar -->
<div class="account-container">
	<div class="content clearfix">
		<form>
			<h1>Ingresar código de acceso</h1>		
			<div class="login-fields">
				<div class="field">
					<label for="username">Ingresar código de acceso</label>
					<input type="text" id="cod_access" name="cod_access" value="" class="login username-field" />
				</div>
			</div> <!-- /login-fields -->
			<div class="login-actions">				
				<button type="button" class="button btn btn-success btn-large" onclick="validateAccessCode()">
                    Ingresar código
                </button>
            </div> <!-- .actions --> 
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->

<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="../../../../assets/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="../../../../assets/js/block-ui.js" ></script>
<script type="text/javascript" src="../../../../assets/js/usuario.js"></script>
</body>
</html>
