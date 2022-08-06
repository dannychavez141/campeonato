<?php

class mMetodos {

    function ejecutar($sql, $msj) {
        // echo $sql;
        $conexion = new mConexion();
        $bd = $conexion->getBd();
        if ($bd->query($sql)) {
            $resp = $msj;
        } else {
            $resp = mysqli_error($bd);
        }
        return $resp;
    }

    function consultarJson($sql) {
        $conexion = new mConexion();
        $bd = $conexion->getBd();
        // print_r($sql);
        $datos = array();
        $respuesta = $bd->query($sql);
        if (!empty($respuesta) && mysqli_num_rows($respuesta) > 0) {
            while ($dato = mysqli_fetch_array($respuesta)) {
                $datos[] = array_map('utf8_encode', $dato);
            }
        } 
        $datosAjax = json_encode($datos);
       // print_r($datosAjax);
        return $datosAjax;
    }
     function consultarArray($sql) {
        $conexion = new mConexion();
        $bd = $conexion->getBd();
        //print_r($sql);
        $datos = array();
        $respuesta = $bd->query($sql);
        if (!empty($respuesta) && mysqli_num_rows($respuesta) > 0) {
            while ($dato = mysqli_fetch_array($respuesta)) {
              $datos[] = array_map('utf8_decode', $dato);
                // print_r($dato);
            }
        }
        //print_r($datos);
        return $datos;
    }

}
