<div class="row row-cols-1 row-cols-md-12 mb-12 text-center">
    <div class="col" >
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal">MODULO DE ALUMNOS</h1>
                <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#exampleModalCenter" @click="nuevoAlu()">
                    + Crear Alumno
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Buscar:</label>
                        <input type="text" class="form-control" placeholder="Buscar por nombres o nro de documento" @keyup="getAlumnos" v-model="busq">
                    </div>
                    <!--                            <div class="col-md-6">
                                                    <label for="">Estado de Usuario:</label>
                                                    <select  class="form-select" v-model="estado" @change="getDatos">
                                                        <option value="0" >Sin filtro</option>
                                                        <option v-bind:value="est['EstId']" v-for="est in estados">{{est['EstDescr']}}</option>
                                                    </select>
                                                </div>-->
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="table-responsive ">
                            <table class="table justify-content-center">
                                <tr><th>Datos de Alumno</th><th>Datos del Apoderado</th><th>Campeonato</th><th>Deporte</th><th>Institucion</th><th>Acciones</th></tr>
                                <tr v-for="dato in alumnos" >
                                    <td>{{dato['nombAlu']+" "+dato['apeAlu']}}</td>
                                    <td>{{dato['nombApo']+" "+dato['apeApo']}}</td>
                                    <td>{{dato['descrCamp']}}</td>
                                    <td>{{dato['descrDep']}}</td>
                                    <td>{{dato['descrEsc']}}</td>
                                    <td><button type="button" class="btn btn-warning " @click="elegirAlu(dato)">
                                            Modificar
                                        </button>
                                        <button type="button" class="btn btn-danger " @click="elimAlu(dato)">
                                            Eliminar
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
