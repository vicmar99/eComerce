<?php
include('../_conexion.php');
$response=new stdClass();
function estado2texto($id){
    switch ($id) {
        case '1':
            return 'Por procesar';
            break;
        case '2':
            return 'Por Pagar';
            break;
        case '3':
			return 'Confirmado';
			break;
		case '4':
			return 'En camino';
			break;			
		case '5':
			return 'Entregado';
			break;
        default:
            break;
    }
}

session_start();
$codusu=$_SESSION['codusu'];
$datos=[];
$i=0;
$sql="select ped.*,pro.*,ped.estado estadoped
from pedido ped
inner join producto pro
on ped.codpro=pro.codpro
where ped.codusu=$codusu and ped.estado=2";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$obj=new stdClass();
	$obj->codped=$row['codped'];
	$obj->codpro=$row['codpro'];
	$obj->nompro=$row['nompro'];
	$obj->despro=$row['despro'];
	$obj->prepro=$row['prepro'];
	$obj->imgpro=$row['imgpro'];
    $obj->fecped=$row['fecped'];
    $obj->dirusuped=$row['dirusuped'];
    $obj->telusuped=$row['telusuped'];
    $obj->estado=$row['estadoped'];
	$obj->estadotext=estado2texto($row['estadoped']);
	$datos[$i]=$obj;
	$i++;
}
$response->datos=$datos;

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);