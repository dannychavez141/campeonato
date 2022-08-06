
<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
include '../model/mConexion.php';
include '../model/mMetodos.php';
include '../model/mFunciones.php';

$c = null;
if (isset($_POST['c']) && $c == null) {
    $c = $_POST['c'];
} else if (isset($_GET['c']) && $c == null) {
    $c = $_GET['c'];
}

$modelo = new mFunciones();
switch ($c) {
    //visualizacion
    case 'login':
        echo $modelo->login($_POST);
        break;
    case 'verAlumnos':
        echo $modelo->todosAlumnos($_GET);
        break;
    case 'unoAlumnos':
        echo $modelo->uno($_GET);
        break;
    case 'verInst':
        echo $modelo->todosInst($_GET);
        break;
    case 'verDep':
        echo $modelo->todosDep($_GET);
        break;
    case 'verCamp':
        echo $modelo->todosCamp($_GET);
        break;
    //creacion
    case 'crearAlumnos':
        if (isset($_FILES['foto'])) {
           echo $modelo->crearAlumno($_POST,$_FILES['foto']);  
        }else{
             echo $modelo->crearAlumno($_POST,"0");  
        }
       
        break;
    case 'crearInst':
        echo $modelo->crearInst($_POST);
        break;
    case 'crearDep':
        echo $modelo->crearDep($_POST);
        break;
    case 'crearCamp':
        echo $modelo->crearDep($_POST);
        break;
    //modificacion
    case 'modiAlumnos':
          print_r($_POST);
     
        if (isset($_FILES['foto'])) {
           echo $modelo->modiAlumno($_POST,$_FILES['foto']);  
        }else{
             echo $modelo->modiAlumno($_POST,"0");  
        }
        break;
    case 'modiInst':
        echo $modelo->modiInst($_POST);
        break;
    case 'modiDep':
        echo $modelo->modiDep($_POST);
        break;
    case 'modiCamp':
        echo $modelo->modiCamp($_POST);
        break;
    default:
        echo "no se recibio las variables";
        break;
}

    