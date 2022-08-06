<div class="row row-cols-1 row-cols-md-12 mb-12 text-center">
    <div class="col" >
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal">MODULO DE CAMPEONATOS</h1>

            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-5 mt-3">
                        <div class="card">
                            <div class="card-header">
                                {{op}} CAMPEONATO
                                 </div>
                            <div class="card-body">
                                <form method="POST" v-on:submit.prevent="ejecCamp">
                                    <table class="table table-borderless text-end">
                                        <tr>
                                            <td>ID DEL CAMPEONATO:</td>
                                            <td><input type="text" class="form-control" placeholder="Automatico" v-model="campeonato['idCamp']" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>NOMBRE DEL CAMPEONATO:</td>
                                            <td><input type="text" class="form-control" placeholder="Escribe el Descripcion" v-model="campeonato['descrCamp']" required maxlength="60"></td>
                                        </tr>

                                        <tr>
                                            <td>FECHA DEL CAMPEONATO:</td>
                                            <td><input type="date" class="form-control" v-model="campeonato['finiCamp']" required></td>
                                        </tr>
                                        <tr>
                                            <td><button type="button" class="btn btn-warning" @click="limpCamp">Limpiar</button></td>
                                            <td><button type="submit" class="btn btn-primary">{{op}}</button></td>
                                        </tr>

                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Buscar:</label>
                                <input type="text" class="form-control" placeholder="Buscar por campeonato" @keyup="getCamp" v-model="busqCamp">
                            </div>

                        </div>
                        <div class="table-responsive ">
                            <table class="table justify-content-center">
                                <tr><th>Id</th><th>Nombre del Campeonaro</th><th>Fecha</th><th>Acciones</th></tr>
                                <tr v-for="dato in campeonatos" >
                                    <td>{{dato['idCamp']}}</td>
                                    <td>{{dato['descrCamp']}}</td>
                                    <td>{{dato['finiCamp']}}</td>

                                    <td><button type="button" class="btn btn-warning " @click="elegirCamp(dato)">
                                            Modificar
                                        </button>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
