<?php 




class Personas  
{

	function __construct()
	{
		# code...
		//include('../../Models/conexion.php');
	}


	function IDIntegrantes($iden){
		$enlace1 = $this->conexiones();
		$query = mysqli_query($enlace1,"SELECT idintegrante FROM integrantes where num_identidad LIKE '%".$iden."%'");
		$ID = mysqli_fetch_array($query,MYSQLI_ASSOC);
		$num_integrante = $ID["idintegrante"];
		$num_id_detalle = $this->IDDetalleIntegrante($num_integrante);

		return $num_id_detalle;
	}

	function IDDetalleIntegrante($id_detalle){
		$enlace1 = $this->conexiones();
$query1 = mysqli_query($enlace1,"SELECT idetalle_integrantes FROM detalle_integrantes where id_integrante LIKE '%".$id_detalle."%'");
		$ID1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
		return $ID1["idetalle_integrantes"];
	}

function conexiones(){
	$enlace = mysqli_connect("192.168.2.168", "root", "54321", "db_mayordomia");

if( $enlace ) {
     //echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}
return $enlace;
}


}

 ?>