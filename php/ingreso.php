<?php 
	include '../gold/enlace.php';
	include 'pelota.php';
	include 'ubicacion.php';
		//$boton="ingresar";
		$boton=$_POST['boton'];
		if ($boton=='cerrar') 
		{
			session_start();
			session_destroy();
		}
		else
		{


			//$email = "1";
			$email = $_POST['email'];
			$email1 =  str_replace("'","",$email);
			//$pass = "1708199200**..";
			$pass = $_POST['password'];
			$nombreServidor = $_POST['nombreServidor'];
			$equipoGG = $_POST['equipoGG'];
			//$pass1 =  str_replace("'","",$pass);
			$pass1 = encriptar($pass);
$sql="SELECT idAccesos,nombre,permisos FROM accesos WHERE idAccesos=".$email." AND contra='".$pass1."' AND estado=1";
			$stmt = mysqli_query( $enlace, $sql);



			if ($stmt){
				
				$rows = mysqli_num_rows( $stmt );
				if ($rows == 1){
						 
						 $Datos = mysqli_fetch_array($stmt,MYSQLI_ASSOC);

						$num_acceso = $Datos["idAccesos"];
						$nombre = $Datos["nombre"];
						$area 	= $Datos["permisos"];

						session_start();
						$_SESSION['ingreso']='YES';
						$_SESSION['num_acceso']=$num_acceso;
						$_SESSION['nombre'] = $nombre;
						$_SESSION['area'] = $area;
						$_SESSION['nombreServidor'] = $nombreServidor;
						$_SESSION['equipoGG'] = $equipoGG;
						$ubicacion = Ubicar($area);
						echo $ubicacion;
						//echo " Nombre de usuario: ".$nombre." Y contraseña es :".$nombre;
				}
				
			   else{
			   	echo "0";
			   }
			   	
			   
			}

			
		}

				 
?>