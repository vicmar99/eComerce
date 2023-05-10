<?php
	session_start();
	if (!isset($_SESSION['codusu'])) {
		header('location: index.php');
	}
?>
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
</head>
<body>
<?php include("layouts/_main-header.php"); ?>
    <div class="main-content">
        <div class="content-page">
            <h3>Mis pedidos</h3>
            <div class="body-pedidos" id="space-list">
            </div>
            <h3>Datos de pago</h3>
            <div class="p-line"><div>Subtotal: </div>$&nbsp;<span id="monto"></span></div>
            <div class="p-line"><div>Envío: </div>$99.00</div>
            <div class="p-line"><div>Total: </div>$&nbsp;<span id="montototal"></span></div>
            <div class="p-line"><div>Banco: </div>BBVA</div>
            <div class="p-line"><div>n° de Cuenta:</div>1223443-12132-12332</div>
            <div class="p-line"><div>Titular:</div>Yair V.</div>
            <p><b>NOTA: </b> Para confirmar la compra debe realizar el depósito por el monto total, y 
            enviar el comprobante al correo example@example.com o por whatsapp al númer 7451064584
            </p>
        </div>
    </div>
    <script type="text/javascript" src="js/main-scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
			$.ajax({
				url:'servicios/pedido/get_procesados.php',
				type:'POST',
				data:{},
				success:function(data){
					console.log(data);
                    let html='';
                    let monto=0;
                    let montoab=0;
					for (var i = 0; i < data.datos.length; i++) {
						html+=
                        '<div class="item-pedido">'+
                            '<div class="pedido-img">'+
                                '<img src="img/'+data.datos[i].imgpro+'">'+
                            '</div>'+    
                            '<div class="pedido-detalle">'+
								'<h3>'+data.datos[i].nompro+'</h3>'+
                                '<p><b>'+data.datos[i].despro+'</b></p>'+
								'<p><b>Fecha:</b> '+data.datos[i].fecped+'</p>'+
								'<p><b>Estado:</b> '+data.datos[i].estadotext+'</p>'+
                                '<p><b>Precio:</b> $'+data.datos[i].prepro+'</p>'+
							'</div>'+
						'</div>';
                        if (data.datos[i].estado=="2") {
							monto+=parseFloat(data.datos[i].prepro)+parseFloat(100.00);
                            montoab+=parseFloat(data.datos[i].prepro);
						}
					}
                    document.getElementById("monto").innerHTML=montoab;
                    document.getElementById("montototal").innerHTML=monto;
					document.getElementById("space-list").innerHTML=html;
                },
                error:function(err){
					console.error(err);
				}
            });
        });
    </script>
</body>
</html>