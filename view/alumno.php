<div class="row row-cols-1 row-cols-md-12 mb-12 text-center">
    <div class="col" >
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal">MODULO DE ALUMNOS</h1>
                <button type="button" class="btn btn-success float-end"  @click="nuevoAlu()">
                    + Crear Alumno
                </button>
                <button type="button" class="btn btn-primary float-end" @click="repTodos">
                    Generar Reporte
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Buscar:</label>
                        <input type="text" class="form-control" placeholder="Buscar por nombres o nro de documento" @keyup="getAlumnos" v-model="busq">
                    </div>
                    <div class="col-md-3">
                        <label for="">Escuela:</label>
                        <select  class="form-select" v-model="idEsc" @change="getAlumnos">
                            <option value="0" >Sin filtro</option>
                            <option v-bind:value="dato['0']" v-for="dato in instituciones">{{dato['1']}}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="">CAMPEONATO:</label>
                        <select  class="form-select" v-model="idCamp" @change="getAlumnos">
                            <option value="0" >Sin filtro</option>
                            <option v-bind:value="dato['0']" v-for="dato in campeonatos">{{dato['1']}}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">DEPORTE:</label>
                        <select  class="form-select" v-model="idDep" @change="getAlumnos">
                            <option value="0" >Sin filtro</option>
                            <option v-bind:value="dato['0']" v-for="dato in deportes">{{dato['1']}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="table-responsive ">
                            <table class="table justify-content-center">
                                <tr><th>Datos de Alumno</th><th>Datos del Apoderado</th><th>Campeonato</th><th>Deporte</th><th>Institucion</th><th>Foto</th><th>Acciones</th></tr>
                                <tr v-for="dato in alumnos" >
                                    <td>{{dato['nombAlu']+" "+dato['apeAlu']}}</td>
                                    <td>{{dato['nombApo']+" "+dato['apeApo']}}</td>
                                    <td>{{dato['descrCamp']}}</td>
                                    <td>{{dato['descrDep']}}</td>
                                    <td>{{dato['descrEsc']}}</td>
                                    <td><img v-bind:src="'./img/'+dato['dniAlu']+'.'+dato['foto']" alt="alt" width="80px"/></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" @click="repUno(dato['idAlu'])">
                                            Generar Ficha
                                        </button>
                                        <button type="button" class="btn btn-warning " @click="elegirAlu(dato)">
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
