<?php

class mFunciones {

    private $metodos;

    public function __construct() {
        $this->metodos = new mMetodos();
    }

    function login($datos) {
        $sql = "SELECT * FROM usuario 
where dniUsu='{$datos['dniUsu']}' and  passUsu='{$datos['passUsu']}';";
// echo $sql;
        $resp = $this->metodos->consultarJson($sql);
        return $resp;
    }

    function todosAlumnos($datos) {
        $sql = "SELECT * FROM alumno a 
left join deporte d on a.idDep=d.idDep
left join campeonato c on a.idCamp=c.idCamp
left join escuela e on a.idEsc=e.idEsc
where concat(a.nombAlu,a.apeAlu,a.dniAlu,a.dniApo,a.nombApo,a.apeApo) like '%{$datos['busq']}%' ";
        if ($datos['idDep'] != "0")
            $sql .= " and a.idDep='{$datos['idDep']}'";

        if ($datos['idCamp'] != "0")
            $sql .= " and a.idCamp='{$datos['idCamp']}'";

        if ($datos['idEsc'] != "0")
            $sql .= " and a.idEsc='{$datos['idEsc']}'";

        $sql .= ";";
// echo $sql;
        $resp = $this->metodos->consultarJson($sql);
        return $resp;
    }

    function uno($id) {
        $sql = "SELECT * FROM alumno a 
left join deporte d on a.idDep=d.idDep
left join campeonato c on a.idCamp=c.idCamp
left join escuela e on a.idEsc=e.idEsc
where a.idAlu='{$id}';";
// echo $sql;
        $resp = $this->metodos->consultarJson($sql);
        return $resp;
    }

    function crearAlumno($datos, $foto) {
        if ($foto == "0") {
              $Extension=$foto;
        } else {

//datos del arhivo
            $nombre_archivo = $foto['name'];
            $tipo_archivo = $foto['type'];
            $tamano_archivo = $foto['size'];
            $fileTmpPath = $foto['tmp_name'];
            $fileNameCmps = explode(".", $nombre_archivo);
            $Extension = strtolower(end($fileNameCmps));

            if (move_uploaded_file($fileTmpPath, "./img/" . $datos["dniAlu"] . $Extension)) {
                echo "El archivo ha sido cargado correctamente.";
            } else {
                echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
            }
        }


        $sql = "INSERT INTO `alumno`"
                . "(`nombAlu`, "
                . "`apeAlu`,"
                . " `dniAlu`,"
                . " `fnacAlu`,"
                . " `dniApo`,"
                . " `nombApo`,"
                . " `apeApo`,"
                . " `foto`,"
                . " `idEsc`,"
                . " `idCamp`,"
                . " `idUsu`,"
                . " `pesoAlu`,"
                . " `tallaAlu`,"
                . " `idDep`,`idSexo`) VALUES "
                . "('{$datos['nombAlu']}',"
                . "'{$datos['apeAlu']}',"
                . "'{$datos['dniAlu']}',"
                . "'{$datos['fnacAlu']}',"
                . "'{$datos['dniApo']}',"
                . "'{$datos['nombApo']}',"
                . "'{$datos['apeApo']}',"
                . "'{$Extension}',"
                . "'{$datos['idEsc']}',"
                . "'{$datos['idCamp']}',"
                . "'{$datos['idUsu']}',"
                . "'{$datos['pesoAlu']}',"
                . "'{$datos['tallaAlu']}',"
                . "'{$datos['idDep']}','{$datos['idSexo']}');";
        $resp = $this->metodos->ejecutar($sql,"CREANDO");
        return $resp;
    }

    function modiAlumno($datos, $foto) {
        if ($foto == "0") {
         //   print_r($datos);
            $Extension=$foto;
        } else {

//datos del arhivo
            $nombre_archivo = $foto['name'];
            $tipo_archivo = $foto['type'];
            $tamano_archivo = $foto['size'];
            $fileTmpPath = $foto['tmp_name'];
            $fileNameCmps = explode(".", $nombre_archivo);
            $Extension = strtolower(end($fileNameCmps));

            if (move_uploaded_file($fileTmpPath, "./img/" . $datos["dniAlu"] . $Extension)) {
                echo "El archivo ha sido cargado correctamente.";
            } else {
                echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
            }
            
        }
        
        $sql = "UPDATE `alumno` SET "
                . "`nombAlu`='{$datos['nombAlu']}'"
                . ",`apeAlu`='{$datos['apeAlu']}'"
                . ",`dniAlu`='{$datos['dniAlu']}'"
                . ",`fnacAlu`='{$datos['fnacAlu']}'"
                . ",`dniApo`='{$datos['dniApo']}'"
                . ",`nombApo`='{$datos['nombApo']}'"
                . ",`apeApo`='{$datos['apeApo']}'"
                . ",`foto`='{$Extension}'"
                . ",`idEsc`='{$datos['idEsc']}'"
                . ",`idCamp`='{$datos['idCamp']}'"
                . ",`idUsu`='{$datos['idUsu']}'"
                . ",`pesoAlu`='{$datos['pesoAlu']}'"
                . ",`tallaAlu`='{$datos['tallaAlu']}'"
                . ",`idSexo`='{$datos['idSexo']}'"
                . ",`idDep`='{$datos['idDep']}' WHERE `idAlu`='{$datos['idAlu']}';";
       echo $sql;
                $resp = $this->metodos->ejecutar($sql,"MODIFICANDO");
        return $resp;
    }

    function elimAlumno($id) {
        $sql = "DELETE FROM `alumno` WHERE idAlu`='{$id}';";
        $resp = $this->metodos->ejecutar($sql);
        return $resp;
    }

//institucion educativa
    function todosInst($datos) {
        $sql = "SELECT * FROM `escuela`
where concat(descrEsc) like '%{$datos['busq']}%' ";

// echo $sql;
        $resp = $this->metodos->consultarJson($sql);
        return $resp;
    }

    function crearInst($datos) {
        $sql = "INSERT INTO `escuela`(`descrEsc`, `dirEsc`) VALUES ('{$datos['descrEsc']}','{$datos['dirEsc']}')";
        $resp = $this->metodos->ejecutar($sql,"CREANDO");
        return $resp;
    }

    function modiInst($datos) {
        $sql = "UPDATE `escuela` SET `descrEsc`='{$datos['descrEsc']}',`dirEsc`='{$datos['dirEsc']}' WHERE `idEsc`='{$datos['idEsc']}'";
        $resp = $this->metodos->ejecutar($sql,"MODIFICANDO");
        return $resp;
    }

//campeonato
    function todosCamp($datos) {
        $sql = "SELECT * FROM `campeonato`
where concat(descrCamp) like '%{$datos['busq']}%' ";

// echo $sql;
        $resp = $this->metodos->consultarJson($sql);
        return $resp;
    }

    function crearCamp($datos) {
        $sql = "INSERT INTO `campeonato`(`descrCamp`, `finiCamp`) VALUES ('{$datos['descrCamp']}','{$datos['finiCamp']}')";
        $resp = $this->metodos->ejecutar($sql,"CREANDO");
        return $resp;
    }

    function modiCamp($datos) {
        $sql = "UPDATE `campeonato` SET `descrCamp`='{$datos['descrCamp']}',`finiCamp`='{$datos['finiCamp']}' WHERE `idCamp`='{$datos['idCamp']}'";
        $resp = $this->metodos->ejecutar($sql,"MODIFICANDO");
        return $resp;
    }

//deporte
    function todosDep($datos) {
        $sql = "SELECT * FROM `deporte`
where concat(descrDep) like '%{$datos['busq']}%' ";

// echo $sql;
        $resp = $this->metodos->consultarJson($sql);
        return $resp;
    }

    function crearDep($datos) {
        $sql = "INSERT INTO `deporte`(`descrDep`) VALUES ('{$datos['descrDep']}')";
        $resp = $this->metodos->ejecutar($sql,"CREANDO");
        return $resp;
    }

    function modiDep($datos) {
        $sql = "UPDATE `deporte` SET `descrDep`='{$datos['descrDep']}' WHERE `idDep`='{$datos['idDep']}'";
        $resp = $this->metodos->ejecutar($sql,"MODIFICANDO");
        return $resp;
    }

}
