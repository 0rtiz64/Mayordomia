<?php 

	function Ubicar($per){

		$accesos = $per;
		$direccion = "";
		$submenu = explode(",",$accesos);

		$miarray = array();
		$miarraySubmenu = array();

		for ($i=0; $i < count($submenu); $i++) { 
	    # code...
	//sacar submenus : preg_match('/SM[0-9].[0-9]/',$submenu[$i])
		    if (preg_match('/^M[0-9]/',$submenu[$i])) 
		    {
		    //echo "HAY COINCIDENCIA<br>";
		    //imprimo el array en pantalla
		    //var_export ($captura);
		    //seria lo mismo que
		    //echo $captura[0];
		        $miarray[] = $submenu[$i];
		    } else 
		        {
		        //echo "NO HAY COINCIDENCIA";
		        }

			}

		//submenus
		for ($i=0; $i < count($submenu); $i++) { 
		    # code...
		//sacar submenus : preg_match('/SM[0-9].[0-9]/',$submenu[$i])
		    if (preg_match('/^S'.$miarray[0].'.[0-9]/',$submenu[$i])) 
		    {
		    //echo "HAY COINCIDENCIA<br>";
		    //imprimo el array en pantalla
		    //var_export ($captura);
		    //seria lo mismo que
		    //echo $captura[0];
		        $miarraySubmenu[] = $submenu[$i];
		    } else 
		        {
		        //echo "NO HAY COINCIDENCIA";
		        }

		}
		switch ($miarray[0]) {
				case 'M1':
					# code...
					switch ($miarraySubmenu[0]) {
						case 'SM1.1':
							# code...
							$direccion = "marcacion_Auto.php";
							break;
						
						case 'SM1.2':
							# code...
							$direccion = "marcacion_manual.php";
							break;

                        case 'SM1.4':
                            # code...
                            $direccion = "marcaciones.php";
                            break;

                        case 'SM1.5':
                            # code...
                            $direccion = "marcacioneAuto.php";
                            break;
					}
					break;
				
				case 'M2':
					# code...
					switch ($miarraySubmenu[0]) {
						case 'SM2.1':
							# code...
							$direccion = "ReporteEquipo.php";
							break;
						
						case 'SM2.2':
							# code...
							$direccion = "reporte_equipo.php";
							break;

                        case 'SM2.3':
                            # code...
                            $direccion = "resumen.php";
                            break;


                        case 'SM2.4':
                            # code...
                            $direccion = "ReporteLiderazgo.php";
                            break;

                        case 'SM2.5':
                            # code...
                            $direccion = "reporteGeneral.php";
                            break;

                        case 'SM2.12':
                            # code...
                            $direccion = "reporteFechas.php";
                            break;
					}
					break;

				case 'M3':
					# code...
					switch ($miarraySubmenu[0]) {


                        case 'SM3.2':
                            # code ...
                            $direccion = "matricula.php";
                            break;

                        case 'SM3.4':
                            # code ...
                            $direccion = "editarMatriculados.php";
                            break;

                        case 'SM3.6':
                            # code ...
                            $direccion = "fichas.php";
                            break;

                        case 'SM3.11':
                            # code ...
                            $direccion = "matriculaDatos.php";
                            break;
                    }
					break;


            case 'M5':
                # code...
                switch ($miarraySubmenu[0]) {
                    case 'SM5.1':
                        # code...
                        $direccion = "tags.php";
                        break;

                    case 'SM5.2':
                        # code...
                        $direccion = "integrarAreas.php";
                        break;

                    case 'SM5.3':
                        # code...
                        $direccion = "reporteIntegracion.php";
                        break;


                    case 'SM5.4':
                        # code...
                        $direccion = "contadorIntegracion.php";
                        break;


                }
                break;

            case 'M8':
                # code...
                switch ($miarraySubmenu[0]) {
                    case 'SM8.1':
                        # code...
                        $direccion = "tagsGraduacion.php";
                        break;

                    case 'SM8.2':
                        # code...
                        $direccion = "contadorGraduacion.php";
                        break;

                    case 'SM8.3':
                        # code...
                        $direccion = "gastosGraduacion.php";
                        break;

                    case 'SM8.4':
                        # code...
                            $direccion = "cierreGastos.php";
                        break;



                }
                break;


            case 'M0':
                # code...
                switch ($miarraySubmenu[0]) {
                    case 'SM0.1':
                        # code...
                        $direccion = "matriculaServidores.php";
                        break;

                    case 'SM0.2':
                        # code...
                        $direccion = "cambiosServidores.php";
                        break;

                }
                break;
				
			}	
		return $direccion;
	}
/*
$ubicacion = Ubicar('M1,SM1.1,SM1.2,,SM1.0,M2,SM2.1,SM2.2,SM2.0');
echo "Ubicacion : ".$ubicacion;
*/ 
 ?>