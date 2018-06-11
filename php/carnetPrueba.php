<?php
/**
 * Created by PhpStorm.
 * User: Megacenter
 * Date: 27/12/2017
 * Time: 14:53
 */

include '../gold/enlace.php';

$PromCorderitos=$_POST["phpPromoCordero"];
$EstadoCivil=$_POST["phpEstadoCivil"];
$Genero=$_POST["phpGenero"];
$Transporte=$_POST["phpTransporte"];
$Identidad=$_POST["phpIdentidad"];
$Nombre=$_POST["phpNombre"];
$ApeCasada=$_POST["phpApeCasada"];
$FechaCumpleanos=$_POST["phpFechaCumpleanos"];
$Tel1=$_POST["phpTel1"];
$Tel2=$_POST["phpTel2"];
$IntegradoRes=$_POST["phpIntegradoRes"];
$Areas=$_POST["phpAreas"];
$Direccion=$_POST["phpDireccion"];
$Id= $_POST["phpId"];
$fechaentrada = date('Y-m-d  h:i:s');
$NombreMayus = strtoupper($Nombre);




$CODIGO = '


^XA
^MMT
^PW670
^LL0386
^LS0
^FO480,224^GFA,03840,03840,00024,:Z64:
eJzt1z+I21YYAPBPkbBMIyzRLFd4lRzokNGdqhDn7GsEWVratdDBoUtHGUO5wa2U5EgzhOPGDkcaMnXu0MlQpeeGbk1LoS0EomBosp3KFU5wwq/vn+/0niRaeqRT3mD7fv70+Xufnt/zAbzwEQAYEARDYxicKk97dpTMDpKFf7/X35zvHm53ub87f/+DrUcbkzd+/sH4bfqN87twc6v7ztbO2+e624Zx+8I9Z+ce99dmV36dTb47h742Lq9d3A0fCW9vJRs0vnXfMm6v3XCuC3+vOPxldvj9s+LutJ87d7Mn3VNNozI+vPI4bJnZ1SILIxgnEwi5d3Sr17JzuwhHOCYeC7cxCm+5yEX++M9kjBeGcBNb44f9jo/615I0xIs7wq8u0eSh35qi10mKMNpzhevb1lt/9MweunRAfLz37cp3UfRJSDw6gDB/8+Yk4659YX22TuNHH8VhfunmQvhGjqYujU8n8fixpz8VDhnyXb/lU792x9OTlYcobJHyUTh+urjV0VfzgpHVbdmFV0Qp3jM7OvQ4ByM0bJmFXQyy6HPTOAPOqnNtUmyq5XbqkiyljhoNnfbpQxzHqjusq7hwp+ePnn35aVZ+j/qZYL194frQUd2bv3r2+YNxJf6VudX+6oG1U81jtT/+yXACxd0+nH2+fbGSp24O/8aHav6GeC+rd3tZ70Y0py8NQ3Gw0/p6tGqpvM71BrfjuvrJbU7q47XKDEQf8gafgrI8hFdaJNxs8rjeK4VSxxloaZ3jFNQJcC9gU1It5o6hD2xHFUNfeYyk+GNP5YmZsM8978ifqv3IvZAn3DH3Vy5NGPF1gvFSV5yO89STsvfZ4zTCWJOcfSNh4JGJSc63hOgJmVha9cF+vUeHxMOy86BBg0e0cb2y8yIGR8T9EouiWbxfWkDCB7g+njo0+VqDo9L6F80lvoTyDf7vXhA3gqrnYFXjPeo1ebzm+IzED9X6mdfHp3X5ybpK6uKZIyNQ6yceN+QBybWVLxVP2JPJPDip/9jJV7vmfpmkDZKL9aOT6Ur3XbjGnPwUOvZUeKLEcwcyLZDW54g/0e1TWs+lP8JSf4T7pUvhREyaHlJHdRunJyXwwZrl0fK1pJyf+YB7OZ7tOhFtj7wPsF2H7+hx2c1jN6Gcn+06dDWDXQ5nV2vM5X2MVYHV2wts+9WEl/PT7Ze71H7WOO6h7P4qfyo7Ek4+SMrvClfPBVPMVz1faBztW0dxOgHqZCOV8tMJ0P5vKvH0oPNwWj0f1+l9T/RUdTsBbQleTF5K+Xlk9bxmR3vN+Q4RSWHX/LDw/iLvJaDmp22u/0UzwLhSJb+gcrhLYxic7v+MfxjBC87/cvyf428hcjn+:8B15
^FT604,186^A0I,45,45^FH\^FD'.$NombreMayus.'^FS
^FT490,270^A0I,45,45^FH\^FD'.$Identidad.'^FS
^FT119,323^A0I,45,45^FH\^FD'.$Id.'^FS
^BY3,3,81^FT450,49^BCI,,N,N
^FD>916161617^FS
^PQ2,0,1,Y^XZ

';

print ($CODIGO);


?>