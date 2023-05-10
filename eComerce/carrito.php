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
            <h3>Mi carrito</h3>
            <div class="body-pedidos" id="space-list">
            </div>
            <input class="ipt-procom" type="text" id="dirusu" placeholder="Dirección">
            <br>
            <input class="ipt-procom" type="text" id="telusu" placeholder="Telefono personal">
            <br>
            <h4>Forma de pago</h4>
            <div class="metodo-pago">
                <input type="radio" name="tipopago" value="1" id="tipo1">
                <label for="tipo1">Pago por transferencia </label>
            </div>
            <div class="metodo-pago">
                <input type="radio" name="tipopago" value="2" id="tipo2">
                <label for="tipo2">Pago con tarjeta</label>
            </div>
            <button class="btn-pedido" onclick="procesar_compra()">Procesar compra</button>
        </div>
    </div>
    <script type="text/javascript" src="js/main-scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
			$.ajax({
				url:'servicios/pedido/get_porprocesar.php',
				type:'POST',
				data:{},
				success:function(data){
					console.log(data);
                    let html='';
                    let sumaMonto=0;
					for (var i = 0; i < data.datos.length; i++) {
						html+=
                        '<div class="item-pedido">'+
                            '<div class="pedido-img">'+
                                '<img src="img/'+data.datos[i].imgpro+'">'+
                            '</div>'+    
                            '<div class="pedido-detalle">'+
                                '<h3>'+data.datos[i].nompro+'</h3>'+
                                '<p><b>Precio:</b> $'+data.datos[i].prepro+'</p>'+
                                '<p><b>fecha:</b> '+data.datos[i].fecped+'</p>'+
                                '<p><b>Estado:</b> '+data.datos[i].estado+'</p>'+
                                '<p><b>Direccción:</b> '+data.datos[i].dirusuped+'</p>'+
                                '<p><b>Telefono:</b> '+data.datos[i].telusuped+'</p>'+
                                '<button class="btn-delete-cart" onclick="delete_product('+data.datos[i].codped+')">Eliminar</button>'+
                            '</div>'+
						'</div>';
                        sumaMonto+=parseInt(data.datos[i].prepro)+1;
					}
                    Culqi.settings({
                        title: 'SuperSuples',
                        currency: 'MXN',
                        description: 'Supersuples',
                        amount: sumaMonto 
                    });
					document.getElementById("space-list").innerHTML=html;
                },
                error:function(err){
					console.error(err);
				}
            });
        });
        function delete_product(codped){
			$.ajax({
				url:'servicios/pedido/delete_pedido.php',
				type:'POST',
				data:{
					codped:codped,
				},
				success:function(data){
					console.log(data);
					if (data.state) {
						window.location.reload();
					}else{
						alert(data.detail);
					}
				},
				error:function(err){
					console.error(err);
				}
			});
		}
        function procesar_compra() {
            let dirusu=document.getElementById("dirusu").value;
            let telusu=$("#telusu").val();
            let tipopago=1;
            if (document.getElementById("tipo2").checked) {
                tipopago=2;
            }
            if (dirusu=="" || telusu=="") {
                alert("Complete los campos");
            }else{
                if (!document.getElementById("tipo1").checked &&
                    !document.getElementById("tipo2").checked) {
                    alert("seleccione un método de pago!!");
                }else{
                    if (tipopago==2) {
                        Culqi.open();
                    }else{
                        $.ajax({
                            url:'servicios/pedido/confirm.php',
                            type:'POST',
                            data:{
                                dirusu:dirusu,
                                telusu:telusu,
                                tipopago:tipopago,
                                token:''
                            },
                            success:function(data){
                                console.log(data);
                                if (data.state) {
                                    window.location.href="pedido.php";
                                }else{
                                    alert(data.detail);
                                }
                            },
                            error:function(err){
                                console.error(err);
                            }
                        });
                    }
                }
            }
        }
        function culqi() {
			if (Culqi.token) { 
		        var token = Culqi.token.id;
		    	$.ajax({
					url:'servicios/pedido/confirm.php',
					type:'POST',
					data:{
						dirusu:document.getElementById("dirusu").value,
						telusu:$("#telusu").val(),
						tipopago:2,
						token:token
					},
					success:function(data){
						console.log(data);
						if (data.state) {
							window.location.href="pedido.php";
						}else{
							alert(data.detail);
						}
					},
					error:function(err){
						console.error(err);
					}
				});
		    }else {
		        console.log(Culqi.error);
		        alert(Culqi.error.user_message);
		    }
		};
    </script>
    <script src="https://checkout.culqi.com/js/v3"></script>
    <script src="https://checkout.culqi.com/v2"></script>
    <script>
        Culqi.publicKey = 'pk_test_c3f2594e580aeede';
    </script>

</body>
</html>