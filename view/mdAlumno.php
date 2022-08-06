<div class="row row-cols-1 row-cols-md-12 mb-12 text-center">
    <div class="col" >
        <form method="POST" enctype="multipart/form-data"  v-on:submit.prevent="ejecutarAlu">
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal">{{op}} ALUMNO</h1>
                
            </div>
            <div class="card-body">
                
                <table class="table table-borderless text-end">
                    <tr>
                        <td>DNI DEL ALUMNO:</td>
                        <td><input type="text" class="form-control" placeholder="Escribe el dni del alumno" v-model="alumno['dniAlu']"></td>
                    </tr>
                    <tr>
                        <td>NOMBRES DEL ALUMNO:</td>
                        <td><input type="text" class="form-control" placeholder="Escribe el NOMBRES del alumno" v-model="alumno['nombAlu']"></td>
                    </tr>
                    <tr>
                        <td>APELLIDOS DEL ALUMNO:</td>
                        <td><input type="text" class="form-control" placeholder="Escribe el APELLIDOS del alumno" v-model="alumno['apeAlu']"></td>
                    </tr>
                    <tr>
                        <td>SEXO:</td>
                        <td>
                            <select class='form-select' v-model="alumno['idSexo']">
                                <option value="1">MASCULINO</option>
                                <option value="2">FEMENINO</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>FECHA DE NACIMIENTO DEL ALUMNO:</td>
                        <td><input type="date" class="form-control" v-model="alumno['fnacAlu']"></td>
                    </tr>
                     <tr>
                        <td>PESO DEL ALUMNO:</td>
                        <td><input type="number" step=".01"class="form-control" v-model="alumno['pesoAlu']"></td>
                    </tr>
                    <tr>
                        <td>TALLA DEL ALUMNO:</td>
                        <td><input type="number" step=".01" class="form-control" v-model="alumno['tallaAlu']"></td>
                    </tr>
                    <tr>
                        <td>FOTO DEL ALUMNO:</td>
                        <td><input type="file" class="form-control" accept="image/*" id="foto"></td>
                    </tr>
                    <tr>
                        <td>DNI DEL APODERADO:</td>
                        <td><input type="text" class="form-control" placeholder="Escribe el dni del APODERADO" v-model="alumno['dniApo']"></td>
                    </tr>
                    <tr>
                        <td>NOMBRES DEL APODERADO:</td>
                        <td><input type="text" class="form-control" placeholder="Escribe el NOMBRES del APODERADO" v-model="alumno['nombApo']"></td>
                    </tr>
                    <tr>
                        <td>APELLIDOS DEL APODERADO:</td>
                        <td><input type="text" class="form-control" placeholder="Escribe el APELLIDOS del APODERADO" v-model="alumno['apeApo']"></td>
                    </tr>
                    <tr>
                        <td>ESCUELA:</td>
                        <td>
                            <select class='form-select' v-model="alumno['idEsc']">
                                <option v-bind:value="dato['0']" v-for='dato in instituciones'>{{dato['1']}}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>CAMPEONATO:</td>
                        <td>
                            <select class='form-select' v-model="alumno['idCamp']">
                                <option v-bind:value="dato['0']" v-for='dato in campeonatos'>{{dato['1']}}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>DEPORTE:</td>
                        <td>
                            <select class='form-select' v-model="alumno['idDep']">
                                <option v-bind:value="dato['0']" v-for='dato in deportes'>{{dato['1']}}</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <input type="button" value="CANCELAR" class='btn btn-warning' @click="modo='alu'"/>
                <input type="submit" v-model="op" class='btn btn-primary'/>
            </div>
        </div>
            </form>
    </div>
</div>
