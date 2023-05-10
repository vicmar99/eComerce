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
            <section>
                <div class="part1">
                    <img id="idimg" src="img/betancourt-whey-reloaded-5.3lb.jpg" alt="">
                </div>
                <div class="part2">
                    <h2 id="idtitle">Nombre principal</h2>
                    <h3 id="iddescription">Descripción del producto</h3>
                    <h1 id="idprice">$800</h1>
                    <button onclick="iniciar_compra()">Comprar</button>
                </div>
            </section>
            <div class="title-section">Productos destacados</div>
            <div class="products-list" id="space-list">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/main-scripts.js"></script>
    <script type="text/javascript">
        var p='<?php echo $_GET["p"]; ?>';
    </script>
    <script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url:'servicios/producto/get_all_products.php',
				type:'POST',
				data:{},
				success:function(data){
					console.log(data);
                    let html='';
					for (var i = 0; i < data.datos.length; i++) {
                        if(data.datos[i].codpro==p){
                            document.getElementById("idimg").src="img/"+data.datos[i].imgpro;
                            document.getElementById("idtitle").innerHTML=data.datos[i].nompro;
                            document.getElementById("iddescription").innerHTML=data.datos[i].despro;
                            document.getElementById("idprice").innerHTML=formato_precio(data.datos[i].prepro);
                        }
						html+=
						'<div class="product-box">'+
                        '<a href="producto.php?p='+data.datos[i].codpro+'">'+
								'<div class="product">'+
									'<img src="img/'+data.datos[i].imgpro+'">'+
									'<div class="detail-title">'+data.datos[i].nompro+'</div>'+
									'<div class="detail-description">'+data.datos[i].despro+'</div>'+
									'<div class="detail-precio">'+formato_precio(data.datos[i].prepro)+'</div>'+
								'</div>'+
							'</a>'+
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
        function iniciar_compra(){
            $.ajax({
				url:'servicios/compra/validar_inicio_compra.php',
				type:'POST',
				data:{
                    codpro:p
                },
				success:function(data){
					console.log(data);
                    if (data.state) {
						alert(data.detail);
					}else{
						alert(data.detail);
						if (data.open_login) {
							open_login();
						}
					}
                },
                error:function(err){
					console.error(err);
				}
            });

        }
        function open_login(){
			window.location.href="login.php";
        }
	</script>
</body>
</html>