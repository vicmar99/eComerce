<?php
//1: Error de conexion
//2: Email invalido
//3: Contraseña incorrecta
include('_conexion.php');
$nomusu=$_POST['nomusur'];
$apeusu=$_POST['apeusur'];
$emausu=$_POST['emausur'];
$sql="SELECT * FROM USUARIO WHERE emausu='$emausu'";
$result=mysqli_query($con,$sql);
if ($result) {
	$row=mysqli_fetch_array($result);
	$count=mysqli_num_rows($result);
	if ($count==0) {
        //Se crea un usuario
		$pasusu=$_POST['pasusur'];
        $pasusu2=$_POST['pasusu2r'];
		if ($pasusu!=$pasusu2) {
			header('Location: ../register.php?er=3');
		}else{
            $sql="INSERT into usuario (codusu,nomusu,apeusu,emausu,pasusu,estado)
			VALUES ('','$nomusu','$apeusu','$emausu','$pasusu',1)";
			$result=mysqli_query($con,$sql);
			$codusu=mysqli_insert_id($con);
            session_start();
			$_SESSION['codusu']=$codusu;
			$_SESSION['emausu']=$emausu;
			$_SESSION['nomusu']=$nomusu;
			header('Location: ../');
		}
	}else{
		header('Location: ../register.php?er=2');
	}
}else{
	header('Location: ../register.php?er=1');
}
