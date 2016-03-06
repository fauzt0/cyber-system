<body>


	<form action="http://localhost/cyber-system/index.php/login/logear" method="POST">
		<?php 
		if(isset($erro_code)){ 			
			switch($erro_code)
			{
			
			//
			case -1:
				echo '<div class="alert alert-danger" role="alert" ><strong>ups!</strong>Usuario o contraseña incorrectas.</div>';
			break;



			case 1:
				echo '<div class="alert alert-success" role="alert" ><strong>Correcto</strong></div>';
			break;


			case 0:
				echo '<div class="alert alert-danger" role="alert" ><strong>ups!</strong>No Existe el Usuario.</div>';
			break;

			case 2://si existen campos en blanco
				echo '<div class="alert alert-warning" role="alert" ><strong>ups!</strong>No dejar campos en blanco.</div>';
			break;
			//
			default:
				echo '<div class="alert alert-warning" role="alert" ><strong>ERROR DESCONOCIDO!</strong>No se puede iniciar sesión</div>';
			break;

			}				
		}
		?>

		<div class="container">
			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 "></div>

				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 ">
					<div class="jumbotron">
						<center>
  						<h1>Inicio de Sesión </h1>
  						<p>Sistema Cyber Visión</p>

  						<p>
  							<label>Usuario:</label>
							<input type="text" name="usuario">					
  						</p>
  						<p>
  							<label>Contraseña:</label>
							<input type="password" name="contraseña">
  						</p>

  						<input type="submit" value="Ingresar" class="btn btn-success">
						<a href="#" class="btn btn-default btn-xs disabled" alt="no dispobible" >Olvide la contraseña</a>
						</center>
					</div>
				</div>

				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 "></div>
			</div>
		</div>

		

	</form>





</body>