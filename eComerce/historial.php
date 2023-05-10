<?php
	session_start();
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
            <div class="title-section">Compras realizadas</div>
            <div class="products-list" id="space-list">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/main-scripts.js"></script>
    <script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url:'servicios/pedido/get_pedidos_all.php',
				type:'POST',
				data:{},
				success:function(data){
					console.log(data);
					let html='';
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
								'<p><b>Estado:</b> '+data.datos[i].estadotxt+'</p>'+
                                '<p><b>Precio:</b> $'+data.datos[i].prepro+'</p>'+
							'</div>'+
						'</div>';
					}
					document.getElementById("space-list").innerHTML=html;
				},
				error:function(err){
					console.error(err);
				}
			});
		});
        function formato_precio(valor){
			let svalor=valor.toString();
			let array=svalor.split(".");
			return "$"+array[0]+".<span>"+array[1]+"</span>";
		}
	</script>
</body>
</html>