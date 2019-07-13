<?php 

     function menuSubmenu($per,$focusMenu,$focusSubMenu)
    {
        # code...

        $accesos = $per;
$submenu = explode(",",$accesos);

$miarray = array();

$miarraySubmenu = array();

//preg_match('[0-9]{0}', $accesos, $captura);
//guardamos las coincidencias en un array
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
    if (preg_match('/^SM[0-9].[0-9]/',$submenu[$i]))
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


$accesoMenus = '';

//Seccion para menu
for ($ff=0; $ff < count($miarray) ; $ff++) { 
    # code...

    switch($miarray[$ff]){
            case 'M1':

                if($focusMenu == "M1"){
                    $accesoMenus .='<li class="sub-menu active">
                                    <a href="javascript:void(0);"><i class="fa fa-check-square-o"></i><span>Marcación</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
                }else{
                    $accesoMenus .='<li class="sub-menu">
                                    <a href="javascript:void(0);"><i class="fa fa-check-square-o"></i><span>Marcación</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
                }
                
                for ($z=0; $z < count($miarraySubmenu); $z++) { 
                    # code...
                    switch ($miarraySubmenu[$z]) {
                        case 'SM1.1':
                            # code...
                            if($focusSubMenu == "SM1.1"){
                                $accesoMenus .='<li class="active"><a href="marcacion_Auto.php">Marcación Automatica</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="marcacion_Auto.php">Marcación Automatica</a></li>';
                            }
                            
                            break;
                        case 'SM1.2':
                            # code...
                            if($focusSubMenu == "SM1.2"){
                                $accesoMenus .='<li class="active"><a href="marcacion_manual.php">Marcacion Manual</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="marcacion_manual.php">Marcacion Manual</a></li>';
                            }

                            
                            break;

                        case 'SM1.3':
                            # code...
                            if($focusSubMenu == "SM1.3"){
                                $accesoMenus .='<li class="active"><a href="marcacionProvicional.php">Marcacion Provisional</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="marcacionProvicional.php">Marcacion Provisional</a></li>';
                            }

                            break;


                        case 'SM1.4':
                            # code...
                            if($focusSubMenu == "SM1.4"){
                                $accesoMenus .='<li class="active"><a href="marcaciones.php">Marcaciones</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="marcaciones.php">Marcaciones</a></li>';
                            }

                            break;

                        case 'SM1.5':
                            # code...
                            if($focusSubMenu == "SM1.4"){
                                $accesoMenus .='<li class="active"><a href="marcacioneAuto.php">Marcacion Automatica</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="marcacioneAuto.php">Marcacion Automatica</a></li>';
                            }

                            break;

                        case 'SM1.0':
                            # code...
                            $accesoMenus .="</ul>
                                            </li>";
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            break;

            case 'M2':
                if($focusMenu == "M2"){
                    $accesoMenus .='<li class="sub-menu active">
                                    <a href="javascript:void(0);"><i class="fa fa-bar-chart-o"></i><span>Reporteria</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
                }else{
                    $accesoMenus .='<li class="sub-menu ">
                                    <a href="javascript:void(0);"><i class="fa fa-bar-chart-o"></i><span>Reporteria</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
                }

                
                for ($z=0; $z < count($miarraySubmenu); $z++) { 
                    # code...
                    switch ($miarraySubmenu[$z]) {
                        case 'SM2.1':
                            # code...
                            if($focusSubMenu == "SM2.1"){
                                $accesoMenus .='<li class="active"><a href="ReporteEquipo.php">Reporte Ovejas Detallado</a></li>';
                            }else{
                            $accesoMenus .='<li><a href="ReporteEquipo.php">Reporte Ovejas Detallado </a></li>';
                            }
                            
                            break;
                        case 'SM2.2':
                            # code...

                            if($focusSubMenu == "SM2.2"){
                                $accesoMenus .='<li class="active"><a href="reporte_equipo.php">Reporte Ovejas Resumen</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="reporte_equipo.php">Reporte Ovejas Resumen</a></li>';
                            }

                            
                            break;
                        case 'SM2.3':
                            # code...

                            if($focusSubMenu == "SM2.3"){
                                $accesoMenus .='<li class="active"><a href="resumen.php">Reporte Liderazgo Resumen</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="resumen.php">Reporte Liderazgo Resumen</a></li>';
                            }

                            
                            break;

                        case 'SM2.4':
                            # code...

                            if($focusSubMenu == "SM2.4"){
                                $accesoMenus .='<li class="active"><a href="ReporteLiderazgo.php">Reporte Liderazgo Detallado</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="ReporteLiderazgo.php">Reporte Liderazgo Detallado</a></li>';
                            }


                            break;


                        case 'SM2.5':
                            # code...

                            if($focusSubMenu == "SM2.5"){
                                $accesoMenus .='<li class="active"><a href="reporteGeneral.php">Reporte General</a></li>';
                            }else{
                                $accesoMenus .= '<li ><a href="reporteGeneral.php">Reporte General</a></li>';
                            }


                            break;

                        case 'SM2.6':
                            # code...

                            if($focusSubMenu == "SM2.6"){
                                $accesoMenus .='<li class="active"><a href="reporteAusentes.php">Reporte Ausentes</a></li>';
                            }else{
                                $accesoMenus .= '<li ><a href="reporteAusentes.php">Reporte Ausentes</a></li>';
                            }


                            break;

                        case 'SM2.7':
                            # code...

                            if($focusSubMenu == "SM2.7"){
                                $accesoMenus .='<li class="active"><a href="php/EXCELgeneralAsistencias.php">Reporte Asistencia General Excel</a></li>';
                            }else{
                                $accesoMenus .= '<li ><a href="php/EXCELgeneralAsistencias.php">Reporte Asistencia General Excel</a></li>';
                            }


                            break;


                        case 'SM2.8':
                            # code...

                            if($focusSubMenu == "SM2.8"){
                                $accesoMenus .='<li class="active"><a href="php/EXCELdocumentos.php">Reporte Documentos Pendientes Excel</a></li>';
                            }else{
                                $accesoMenus .= '<li ><a href="php/EXCELdocumentos.php">Reporte Documentos Pendientes Excel</a></li>';
                            }


                            break;

                        case 'SM2.9':
                            # code...

                            if($focusSubMenu == "SM2.9"){
                                $accesoMenus .='<li class="active"><a href="reporteEnlazados.php">Reporte Enlazados</a></li>';
                            }else{
                                $accesoMenus .= '<li ><a href="reporteEnlazados.php">Reporte Enlazados</a></li>';
                            }


                            break;


                        case 'SM2.10':
                            # code...
                            if($focusSubMenu == "SM2.10"){
                                $accesoMenus .='<li class="active"><a href="php/EXCELmatriculados.php"> Excel Matriculados</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="php/EXCELmatriculados.php">Excel Matriculados</a></li>';
                            }

                            break;

                        case 'SM2.11':
                            # code...
                            if($focusSubMenu == "SM2.11"){
                                $accesoMenus .='<li class="active"><a href="php/EXCELmatriculadosEquipo.php"> Excel Matriculados Enlazados</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="php/EXCELmatriculadosEquipo.php">Excel Matriculados Enlazados</a></li>';
                            }

                            break;


                        case 'SM2.12':
                            # code...
                            if($focusSubMenu == "SM2.12"){
                                $accesoMenus .='<li class="active"><a href="reporteFechas.php"> Reporte Fechas</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="reporteFechas.php">Reporte Fechas</a></li>';
                            }

                            break;




                        case 'SM2.0':
                            # code...
                            $accesoMenus .="</ul>
                                            </li>";
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            break;
            
            case 'M3':

                if($focusMenu == "M3"){
                    $accesoMenus .='<li class="sub-menu active">
                                    <a href="javascript:void(0);"><i class="fa fa-cogs"></i><span>Gestiones</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
                }else{
                    $accesoMenus .='<li class="sub-menu">
                                    <a href="javascript:void(0);"><i class="fa fa-cogs"></i><span>Gestiones</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
                }
                
                for ($z=0; $z < count($miarraySubmenu); $z++) { 
                    # code...
                    switch ($miarraySubmenu[$z]) {



                        case 'SM3.2':
                            # code...
                            if($focusSubMenu == "SM3.2"){
                                $accesoMenus .='<li class="active"><a href="matricula.php"> Matricula de Integrantes </a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="matricula.php"> Matricula de Integrantes </a></li>';
                            }

                            break;


                        case 'SM3.3':
                            # code...
                            if($focusSubMenu == "SM3.3"){
                                $accesoMenus .='<li class="active"><a href="cambios.php"> Cambios  Enlazados</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="cambios.php"> Cambios  Enlazados</a></li>';
                            }
                            
                            break;
                        case 'SM3.4':
                            # code...
                            if($focusSubMenu == "SM3.4"){
                                $accesoMenus .='<li class="active"><a href="editarMatriculados.php"> Cambios Matriculados</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="editarMatriculados.php">Cambios Matriculados</a></li>';
                            }

                            break;





                        case 'SM3.6':
                            # code...
                            if($focusSubMenu == "SM3.6"){
                                $accesoMenus .='<li class="active"><a href="fichas.php">Fichas de Inscripcion</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="fichas.php">Fichas de Inscripcion</a></li>';
                            }

                            break;




                        case 'SM3.9':
                            # code...
                            if($focusSubMenu == "SM3.9"){
                                $accesoMenus .='<li class="active"><a href="enlazar.php">Enlazar Integrantes</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="enlazar.php">Enlazar Integrantes</a></li>';
                            }

                            break;

                        case 'SM3.10':
                            # code...
                            if($focusSubMenu == "SM3.10"){
                                $accesoMenus .='<li class="active"><a href="listadoServidores.php">Listado Servidores</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="listadoServidores.php">Listado Servidores</a></li>';
                            }

                            break;


                        case 'SM3.11':
                            # code...
                            if($focusSubMenu == "SM3.10"){
                                $accesoMenus .='<li class="active"><a href="matriculaDatos.php">Contador Matricula</a></li>';
                            }else{
                                $accesoMenus .='<li ><a href="matriculaDatos.php">Contador Matricula</a></li>';
                            }

                            break;


                        case 'SM3.0':
                            # code...
                            $accesoMenus .="</ul>
                                            </li>";
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            break;

            case 'M4':

            if($focusMenu == "M4"){
                $accesoMenus .='<li class="sub-menu active">
                                    <a href="javascript:void(0);"><i class="fa fa-bookmark"></i><span>Promociones</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }else{
                $accesoMenus .='<li class="sub-menu">
                                    <a href="javascript:void(0);"><i class="fa fa-bookmark"></i><span>Promociones</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }

            for ($z=0; $z < count($miarraySubmenu); $z++) {
                # code...
                switch ($miarraySubmenu[$z]) {
                    case 'SM4.1':
                        # code...
                        if($focusSubMenu == "SM4.1"){
                            $accesoMenus .='<li class="active"><a href="listarPromociones.php"> Listar </a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="listarPromociones.php"> Listar</a></li>';
                        }

                        break;

                    case 'SM4.0':
                        # code...
                        $accesoMenus .="</ul>
                                            </li>";
                        break;
                    default:
                        # code...
                        break;
                }
            }
            break;

            case 'M5':

            if($focusMenu == "M5"){
                $accesoMenus .='<li class="sub-menu active">
                                    <a href="javascript:void(0);"><i class="fa fa-users"></i><span>Integración</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }else{
                $accesoMenus .='<li class="sub-menu">
                                    <a href="javascript:void(0);"><i class="fa fa-users"></i><span>Integración</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }

            for ($z=0; $z < count($miarraySubmenu); $z++) {
                # code...
                switch ($miarraySubmenu[$z]) {
                    case 'SM5.1':
                        # code...
                        if($focusSubMenu == "SM5.1"){
                            $accesoMenus .='<li class="active"><a href="tags.php"> Imprimir Tags</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="tags.php"> Imprimir Tags</a></li>';
                        }

                        break;

                    case 'SM5.2':
                        # code...
                        if($focusSubMenu == "SM5.2"){
                            $accesoMenus .='<li class="active"><a href="integrarAreas.php"> Integración </a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="integrarAreas.php"> Integración</a></li>';
                        }

                        break;

                    case 'SM5.3':
                        # code...
                        if($focusSubMenu == "SM5.3"){
                            $accesoMenus .='<li class="active"><a href="reporteIntegracion">Reporte Integración </a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="reporteIntegracion">Reporte Integración</a></li>';
                        }

                        break;

                    case 'SM5.4':
                        # code...
                        if($focusSubMenu == "SM5.4"){
                            $accesoMenus .='<li class="active"><a href="contadorIntegracion.php">Contador Integracion</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="contadorIntegracion.php">Contador Integracion</a></li>';
                        }

                        break;

                    case 'SM5.0':
                        # code...
                        $accesoMenus .="</ul>
                                            </li>";
                        break;
                    default:
                        # code...
                        break;
                }
            }
            break;

            case 'M6':

            if($focusMenu == "M6"){
                $accesoMenus .='<li class="sub-menu active">
                                    <a href="javascript:void(0);"><i class="fa fa-tags"></i><span>Equipos</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }else{
                $accesoMenus .='<li class="sub-menu">
                                    <a href="javascript:void(0);"><i class="fa fa-tags"></i><span>Equipo</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }

            for ($z=0; $z < count($miarraySubmenu); $z++) {
                # code...
                switch ($miarraySubmenu[$z]) {
                    case 'SM6.1':
                        # code...
                        if($focusSubMenu == "SM6.1"){
                            $accesoMenus .='<li class="active"><a href="equipos.php"> Crear Equipo</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="equipos.php"> Crear Equipo</a></li>';
                        }

                        break;


                    case 'SM6.2':
                        # code...
                        if($focusSubMenu == "SM6.2"){
                            $accesoMenus .='<li class="active"><a href="listadoEquipos.php"> Listado de Equipo</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="listadoEquipos.php"> Listado de Equipo</a></li>';
                        }

                        break;

                    case 'SM6.3':
                        # code...
                        if($focusSubMenu == "SM6.3"){
                            $accesoMenus .='<li class="active"><a href="listadoPastoreadoresEquipos.php"> Listado Pastoreadores Por Equipo</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="listadoPastoreadoresEquipos.php"> Listado Pastoreadores Por Equipo</a></li>';
                        }

                        break;


                    case 'SM6.0':
                        # code...
                        $accesoMenus .="</ul>
                                            </li>";
                        break;
                    default:
                        # code...
                        break;
                }
            }
            break;

            case 'M7':

            if($focusMenu == "M7"){
                $accesoMenus .='<li class="sub-menu active">
                                    <a href="respaldoDB.php"><i class="fa fa-chevron-circle-down"></i><span>Respaldo</span></a>
                                    <ul>';
            }else{
                $accesoMenus .='<li class="sub-menu">
                                    <a href="respaldoDB.php"><i class="fa fa-chevron-circle-down"></i><span>Respaldo</span></a>
                                    <ul>';
            }

            case 'M8':

            if($focusMenu == "M8"){
                $accesoMenus .='<li class="sub-menu active">
                                    <a href="javascript:void(0);"><i class="fa fa-dedent"></i><span>Graduación</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }else{
                $accesoMenus .='<li class="sub-menu">
                                    <a href="javascript:void(0);"><i class="fa fa-dedent"></i><span>Graduación</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }

            for ($z=0; $z < count($miarraySubmenu); $z++) {
                # code...
                switch ($miarraySubmenu[$z]) {
                    case 'SM8.1':
                        # code...
                        if($focusSubMenu == "SM8.1"){
                            $accesoMenus .='<li class="active"><a href="tagsGraduacion.php">  Tags Graduacion</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="tagsGraduacion.php"> Tags Graduacion</a></li>';
                        }

                        break;

                    case 'SM8.2':
                        # code...
                        if($focusSubMenu == "SM8.2"){
                            $accesoMenus .='<li class="active"><a href="contadorGraduacion.php">  Contador de Togas</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="contadorGraduacion.php"> Contador de Togas</a></li>';
                        }

                        break;





                    case 'SM8.0':
                        # code...
                        $accesoMenus .="</ul>
                                            </li>";
                        break;
                    default:
                        # code...
                        break;
                }
            }
            break;

            case 'M9':

            if($focusMenu == "M9"){
                $accesoMenus .='<li class="sub-menu active">
                                    <a href="javascript:void(0);"><i class="fa fa-keyboard-o"></i><span>Multimedios</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }else{
                $accesoMenus .='<li class="sub-menu">
                                    <a href="javascript:void(0);"><i class="fa fa-keyboard-o"></i><span>Multimedios</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }

            for ($z=0; $z < count($miarraySubmenu); $z++) {
                # code...
                switch ($miarraySubmenu[$z]) {
                    case 'SM9.1':
                        # code...
                        if($focusSubMenu == "SM9.1"){
                            $accesoMenus .='<li class="active"><a href="multimedios.php"> Estados</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="multimedios.php"> Estados</a></li>';
                        }

                        break;

                    case 'SM9.2':
                        # code...
                        if($focusSubMenu == "SM9.2"){
                            $accesoMenus .='<li class="active"><a href="matriculaServidores.php"> Registro</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="matriculaServidores.php"> Registro</a></li>';
                        }

                        break;

                    case 'SM9.3':
                        # code...
                        if($focusSubMenu == "SM9.3"){
                            $accesoMenus .='<li class="active"><a href="cambiosServidores.php"> Cambios</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="cambiosServidores.php"> Cambios</a></li>';
                        }

                        break;


                    case 'SM9.0':
                        # code...
                        $accesoMenus .="</ul>
                                            </li>";
                        break;
                    default:
                        # code...
                        break;
                }
            }
            break;

            case 'M0':

            if($focusMenu == "M0"){
                $accesoMenus .='<li class="sub-menu active">
                                    <a href="javascript:void(0);"><i class="fa fa-users"></i><span>Servidores</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }else{
                $accesoMenus .='<li class="sub-menu">
                                    <a href="javascript:void(0);"><i class="fa fa-users"></i><span>Servidores</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                    <ul>';
            }

            for ($z=0; $z < count($miarraySubmenu); $z++) {
                # code...
                switch ($miarraySubmenu[$z]) {
                    case 'SM0.1':
                        # code...
                        if($focusSubMenu == "SM0.1"){
                            $accesoMenus .='<li class="active"><a href="matriculaServidores.php"> Registro</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="matriculaServidores.php"> Registro</a></li>';
                        }

                        break;

                    case 'SM0.2':
                        # code...
                        if($focusSubMenu == "SM0.2"){
                            $accesoMenus .='<li class="active"><a href="cambiosServidores.php"> Cambios</a></li>';
                        }else{
                            $accesoMenus .='<li ><a href="cambiosServidores.php"> Cambios</a></li>';
                        }

                        break;


                    case 'SM0.0':
                        # code...
                        $accesoMenus .="</ul>
                                            </li>";
                        break;
                    default:
                        # code...
                        break;
                }
            }
            break;

        }

}


echo $accesoMenus;
    }


 ?>