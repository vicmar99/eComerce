<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperSuples</title>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
    <style type="text/css">
		form{
			max-width: 460px;
			width: calc(100% - 40px);
			padding: 20px;
			background: #fff;
			border-radius: 5px;
			margin: auto;
		}
		form h3{
			margin: 5px 0;
		}
		form input{
			padding: 7px 10px;
			width: calc(100% - 22px);
			margin-bottom: 10px;
		}
		form button{
			padding: 10px 15px;
			width: calc(100%);
			border: none;
			color: rgb(250, 250, 250);
			background: rgb(0, 0, 0);
		}
		form p{
			margin: 0;
			margin-bottom: 5px;
			color: #FB0505;
			font-size: 14px;
		}
	</style>
</head>
<body>
<?php include("layouts/_main-header.php"); ?>
	<div class="main-content">
		<div class="content-page">
			<form action="servicios/register.php" method="POST">
				<h3>Regístrese</h3>
				<input type="text" name="nomusur" placeholder="Ingresa tu nombre">
				<input type="text" name="apeusur" placeholder="Ingresa tu apellido">
				<input type="text" name="emausur" placeholder="Correo">
				<input type="password" name="pasusur" placeholder="Contraseña">
				<input type="password" name="pasusu2r" placeholder="Confirmar contraseña">
				<?php
					if (isset($_GET['er'])) {
						switch ($_GET['er']) {
							case '1':
								echo '<p>Error de conexión</p>';
								break;	
							case '2':
								echo '<p>Ya hay una cuenta vinculada a este correo</p>';
								break;	
							case '3':
								echo '<p>las contraseñas no coinciden</p>';
								break;							
							default:
								break;
						}
					}
				?>
				<button type="submit">Crear cuenta</button>
			</form>
		</div>
	</div>
</body>
</html>