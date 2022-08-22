<?php
include './header.php';
?>

<body>

    <div class="container-fluid " id="app">
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom mt-3">
            <a href="./" class="d-flex align-items-center text-dark text-decoration-none">
                <img src="./img/logo.png" alt="alt" width="30px"/>
                <span class="fs-4">SISCAMP</span>
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <button class="btn btn-success m-1" @click="modo='inst'">INSTITUCIONES</button>
                <button class="btn btn-success m-1" @click="modo='camp'">CAMPEONATOS</button>
                <button class="btn btn-success m-1" @click="modo='alu'">ALUMNOS</button>
                <button class="btn btn-warning" @click="cerrarSesion()">CERRAR SESION</button>
            </nav>
            <br>

        </div>
        <div class="row">

            <div class="col-md-12 " >
                <label class="float-end">Hola,  {{msj}}</label>

            </div>
        </div>
        <div v-if="modo=='ini'">
            <?php
            include './view/inicio.php';
            ?>

        </div>
        <div v-if="modo=='alu'">
            <?php
            include './view/alumno.php';
            ?>

        </div>
        <div v-if="modo=='regalu'">
            <?php
            include './view/mdAlumno.php';
            ?>

        </div>
        <div v-if="modo=='camp'">
            <?php
            include './view/campeonato.php';
            ?>

        </div>
        <div v-if="modo=='inst'">
            <?php
            include './view/institucion.php';
            ?>

        </div>



    </div>
</div>
<script>
    var app = new Vue({
        el: "#app",
        data: {sesion: [], msj: "",
            modo: "alu", alumnos: [], alumno: [], instituciones: [], institucion: [], campeonatos: [], campeonato: [], deportes: [], deporte: [],
            busq: "", busqInst: "", busqDep: "", busqCamp: "", idDep: "0", idCamp: "0", idEsc: "0", op: "CREANDO"
        },
        methods: {
            cookies() {
                let lasCookies = document.cookie;
                console.log(lasCookies);
                let arrayCook = lasCookies.split(";");

                for (var i = 0; i < arrayCook.length; i++) {
                    let data = arrayCook[i].split("=");
                    this.sesion[data[0].trim()] = data[1];
                }

                if (this.sesion['id'] == null) {
                    window.location.href = "./login.php";
                }

                this.msj = this.sesion['datos'];


            },
            cerrarSesion() {
                Swal.fire({
                    title: '¿Deseas Cerrar Sesion?',
                    showDenyButton: true,
                    confirmButtonText: 'Si, Cerrar Sesión',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        document.cookie = "id=;max-age=0;path=/";
                        document.cookie = "datos=;max-age=0;path=/";
                        window.location.href = "./login";
                    }
                });




            },
            async getAlumnos() {
                let url = "./controller/cUsuario.php?c=verAlumnos&busq=" + this.busq;
                url += "&idDep=" + this.idDep;
                url += "&idCamp=" + this.idCamp;
                url += "&idEsc=" + this.idEsc;
                try {
                    let resp = await axios.get(url);
                    this.alumnos = resp.data;
                    console.log(this.alumnos);
                } catch (e) {
                    console.log(e.toString());
                }

            }, async getDeportes() {
                let url = "./controller/cUsuario.php?c=verDep&busq=" + this.busqDep;
                try {
                    let resp = await axios.get(url);
                    this.deportes = resp.data;
                    console.log(resp.data);
                } catch (e) {
                    console.log(e.toString());
                }

            }, async getInsti() {
                let url = "./controller/cUsuario.php?c=verInst&busq=" + this.busqInst;
                try {
                    let resp = await axios.get(url);
                    this.instituciones = resp.data;
                    console.log(resp.data);
                } catch (e) {
                    console.log(e.toString());
                }

            }, async getCamp() {
                let url = "./controller/cUsuario.php?c=verCamp&busq=" + this.busqCamp;
                try {
                    let resp = await axios.get(url);
                    this.campeonatos = resp.data;
                    console.log(resp.data);
                } catch (e) {
                    console.log(e.toString());
                }

            }, nuevoAlu()
            {
                this.op = "CREANDO";
                this.modo = "regalu";
                this.alumno = [];
                this.alumno['idDep'] = "1";
                this.alumno['idCamp'] = "1";
                this.alumno['idEsc'] = "1";
                this.alumno['idSexo'] = "1";
            }, elegirAlu(dato)
            {
                this.modo = "regalu";
                this.op = "MODIFICAR";
                this.alumno = dato;

            }, async ejecutarAlu()
            {
                let urlApi = "./controller/cUsuario.php";
                const params = new FormData();
                params.append('methods', 'POST');
                params.append('idAlu', this.alumno['idAlu']);
                let file = document.getElementById('foto').files[0];
                // console.log(file);
                if (file != null) {
                    params.append('foto', file);
                    params.append('ext', file.type);
                } else {
                    params.append('ext', "0");
                }
                params.append('nombAlu', this.alumno['nombAlu']);
                params.append('apeAlu', this.alumno['apeAlu']);
                params.append('dniAlu', this.alumno['dniAlu']);
                params.append('fnacAlu', this.alumno['fnacAlu']);
                params.append('dniApo', this.alumno['dniApo']);
                params.append('nombApo', this.alumno['nombApo']);
                params.append('apeApo', this.alumno['apeApo']);
                params.append('idEsc', this.alumno['idEsc']);
                params.append('idCamp', this.alumno['idCamp']);
                params.append('idUsu', "1");
                params.append('pesoAlu', this.alumno['pesoAlu']);
                params.append('tallaAlu', this.alumno['tallaAlu']);
                params.append('idDep', this.alumno['idDep']);
                params.append('idSexo', this.alumno['idSexo']);
                if (this.op == "CREANDO") {
                    params.append('c', "crearAlumnos");
                } else {
                    params.append('c', "modiAlumnos");
                }

                try {
                    let resp = await axios.post(urlApi, params, {headers: {'Content-Type': 'multipart/form-data; charset=utf-8;  boundary=something'}});

                    let r = resp.data.trim();
                    console.log(r);
                    if (r == "CREANDO" || r == "MODIFICAR")
                    {
                        Swal.fire(r, '', 'info');
                    } else
                    {
                        Swal.fire("No se realizo ningun cambio, recuerde que los nros de DNI son unicos", '', 'error');
                    }

                    app.getAlumnos();

                    $("#btncerrar").click();
                } catch (e) {
                    console.log(e);
                }
            }, async elimAlu(dato)
            {
                Swal.fire({
                    title: '¿Deseas Eliminar al alumno?',
                    showDenyButton: true,
                    confirmButtonText: 'Si',
                    denyButtonText: `Cancelar`,
                }).then(async (result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let urlApi = "./controller/cUsuario.php";
                        const params = new FormData();
                        params.append('methods', 'POST');
                        params.append('idAlu', dato);
                        params.append('c', "eliAlum");
                        try {
                            let resp = await axios.post(urlApi, params);
                            let r = resp.data.trim();
                            console.log(r);

                            Swal.fire(r, '', 'info');

                            app.getAlumnos();

                        } catch (e) {
                            console.log(e);
                        }
                    }
                });

            }, elegirCamp(dato)
            {
                this.op = "MODIFICAR";
                this.campeonato = dato;

            }
            , limpCamp()
            {
                this.op = "CREANDO";
                this.campeonato = [];

            }, async ejecCamp()
            {

                let urlApi = "./controller/cUsuario.php";
                const params = new FormData();
                params.append('methods', 'POST');
                params.append('idCamp', this.campeonato['idCamp']);
                params.append('descrCamp', this.campeonato['descrCamp']);
                params.append('finiCamp', this.campeonato['finiCamp']);
                if (this.op == "CREANDO") {
                    params.append('c', "crearCamp");
                } else {
                    params.append('c', "modiCamp");
                }
                try {
                    let resp = await axios.post(urlApi, params);
                    let r = resp.data.trim();
                    console.log(r);

                    Swal.fire(r, '', 'info');
                    app.op = "CREANDO";
                    app.campeonato = [];
                    app.getCamp();

                } catch (e) {
                    console.log(e);
                }


            }, elegirEsc(dato)
            {
                this.op = "MODIFICAR";
                this.institucion = dato;

            }
            , limpEsc()
            {
                this.op = "CREANDO";
                this.institucion = [];

            }, async ejecEsc()
            {

                let urlApi = "./controller/cUsuario.php";
                const params = new FormData();
                params.append('methods', 'POST');
                params.append('idEsc', this.institucion['idEsc']);
                params.append('descrEsc', this.institucion['descrEsc']);
                params.append('dirEsc', this.institucion['dirEsc']);
                if (this.op == "CREANDO") {
                    params.append('c', "crearInst");
                } else {
                    params.append('c', "modiInst");
                }
                try {
                    let resp = await axios.post(urlApi, params);
                    let r = resp.data.trim();
                    console.log(r);

                    Swal.fire(r, '', 'info');
                    app.op = "CREANDO";
                    app.institucion = [];
                    app.getInsti();

                } catch (e) {
                    console.log(e);
                }


            }, repTodos() {
                let url = "./reportes/repEquipo.php?busq=" + this.busq;
                url += "&idDep=" + this.idDep;
                url += "&idCamp=" + this.idCamp;
                url += "&idEsc=" + this.idEsc;
                window.open(url, "REPORTE DE ALUMNOS REGISTRADOS", "width=600,height=600,scrollbars=NO")
            }
            , repEval() {
                let url = "./reportes/repEval.php?busq=" + this.busq;
                url += "&idDep=" + this.idDep;
                url += "&idCamp=" + this.idCamp;
                url += "&idEsc=" + this.idEsc;
                window.open(url, "REPORTE DE ALUMNOS REGISTRADOS EVALUACION", "width=600,height=600,scrollbars=NO")
            }
            , repUno(id) {
                let url = "./reportes/repAlumno.php?id=" + id;
                window.open(url, "REPORTE DE ALUMNO", "width=600,height=600,scrollbars=NO")
            }, async evaluar(dato) {
                console.log(dato);
                Swal.fire({
                    title: '¿Deseas Modificar la Evaluacion?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        app.ejecModEval(dato);
                        Swal.fire('Evaluacion registrada', '', 'success');
                    } else if (result.isDenied) {

                    }
                });

            }, async ejecModEval(dato) {
                let urlApi = "./controller/cUsuario.php";
                const params = new FormData();
                params.append('methods', 'POST');
                params.append('idAlu', dato['idAlu']);
                params.append('eval', dato['eval']);
                params.append('c', "modEval");

                try {
                    let resp = await axios.post(urlApi, params);
                    let r = resp.data.trim();
                    console.log(r);
                } catch (e) {
                    console.log(e.toString());
                }
            }




        },
        mounted() {
            this.cookies();
            this.getAlumnos();
            this.getDeportes();
            this.getInsti();
            this.getCamp();
        }
    });
</script>
</body>
