<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 27/2/2018
 * Time: 9:58 AM
 */
$db_host = "localhost"; //Host del Servidor MySQL
$db_name= 'db_mayordomia';
$db_user = "root";
$db_pass = '';

$fecha = date("Ymd-His");

$salida_sql = $db_name.'_'.$fecha.'.sql';

$dump = "mysqldump -h$db_host -u$db_user -p$db_pass --opt $db_name >$salida_sql";

system($dump,$output);
?>