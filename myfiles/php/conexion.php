<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 12/9/2017
 * Time: 10:27
 */



$con=mysqli_connect("127.0.0.1","root","","db_mayordomia");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}