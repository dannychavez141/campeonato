<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>SISTEMA DE CONTROL DE CAMPEONATOS </title>
        <script src="./js/axios.js" type="text/javascript"></script>
        <script src="./js/bootstrap.bundle.js" type="text/javascript"></script>
        <script src="./js/sweetalert.js" type="text/javascript"></script>
        <script src="./js/vue.js" type="text/javascript"></script>
        <link href="./css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>
        <link href="./css/style.css" rel="stylesheet" type="text/css"/>
        <script src="./js/config.js" type="text/javascript"></script>

    </head>
    <body>

        <div class="container float-lg-none" id="app">



            <div class="row  text-center abs-center">
                <div class="col-md-6" >
                    <form method="POST" v-on:submit.prevent="login" >
                        <div class="card rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h3 class="my-0 fw-normal">Sistema de campeonatos escolares</h3>
                                <h4 class="my-0 fw-normal">INICIO DE SESION</h4>
                            </div>
                            <div class="card-body">
                                <label>Usuario</label>
                                <input type="text" placeholder="Escribe tu Usuario" class="form-control" required="" v-model="user">
                                <label>Clave</label>
                                <input type="password" placeholder="Escribe tu Contraseña" class="form-control" required v-model="pass">
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-warning" type="reset">Limpiar</button>
                                <button class="btn btn-primary" type="submit">Ingresar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
        <script>

            var app = new Vue({
                el: "#app",
                data: {
                    user: "",
                    pass: "",
                    usuario: [],
                    sesion: []

                },
                methods: {
                    async login() {
                        let urlApi = server + "controller/cUsuario.php";
                        const parametros = new URLSearchParams();
                        parametros.append('methods', 'POST');
                        parametros.append('c', "login");
                        parametros.append('dniUsu', this.user);
                        parametros.append('passUsu', this.pass);
                        try {
                            let resp = await axios.post(urlApi, parametros);
                            console.log(resp.data);
                            let datos = resp.data;
                            if (datos.length > 0) {
                                this.usuario = datos[0];
                                // console.log(this.usuario);
                                this.crearSesion(this.usuario);
                            } else {
                                Swal.fire(
                                        'Error de Inicio de sesion.',
                                        'Por favor, intente nuevamente iniciar sesion',
                                        'error'
                                        )
                            }
                        } catch (e) {
                            console.log(e.toString());
                        }
                    }, crearSesion(datos) {
                        document.cookie = "id=" + datos['idUsu'] + "; max-age=8000; path=/";
                        document.cookie = "datos=" + datos['nombUsu'] + " " + datos['apeUsu'] + "; max-age=8000; path=/";
                        window.location.href = "./";
                    }, cookies() {
                        let lasCookies = document.cookie;
                        console.log(lasCookies);
                        let arrayCook = lasCookies.split(";");

                        for (var i = 0; i < arrayCook.length; i++) {
                            let data = arrayCook[i].split("=");
                            this.sesion[data[0].trim()] = data[1];
                        }
                        console.log(this.sesion);
                        if (this.sesion['id'] != null) {
                            window.location.href = "./";
                        }

                    }
                },
                mounted() {
                    this.cookies();
                },
            });

        </script>

    
</body>
</html>
