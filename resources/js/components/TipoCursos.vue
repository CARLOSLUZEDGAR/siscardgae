<template>
    <main>
        <section class="content-header">
            <h1><i class="fas fa-graduation-cap"></i> Tipo Cursos</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-list-ol"></i> Listado
                                </h3>
                                <button v-if="$auth.can('create-tipcur')" type="button" class="btn btn-primary btn-sm float-sm-right" title="Registrar Curso" @click="abrirCrear()">
                                    <i class="fas fa-plus" aria-hidden="true"></i> Nuevo Tipo Curso
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="form-control" v-model="criterio">
                                            <option value="c.descripcion">Nombre del Curso</option>
                                            <option value="tc.descripcion">Descripcion del Tipo Curso</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" @keyup.enter="listadoTipoCursos(1,buscar,criterio)" v-model="buscar" style="text-transform:uppercase" placeholder="Realizar búsqueda">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" @click="listadoTipoCursos(1,buscar,criterio)" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper-scroll-y my-customscrollbar" style="font-size:16px;">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:100px; text-align:center">Acciones</th>
                                                <th style="width:100px; text-align:center">Curso</th>
                                                <th style="width:100px; text-align:center">Descripción</th>
                                                <th style="width:100px; text-align:center">Puntaje</th>
                                                <th style="width:100px; text-align:center">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(tipo_cursos, index) in tipo_cursos" :key="index">
                                                <td style="width:100px; text-align:center">
                                                    <template v-if="tipo_cursos.estado == '1'">
                                                        <button v-if="$auth.can('edit-tipcur')" type="button" class="btn btn-warning btn-sm" title="Modificar Curso"
                                                            @click="abrirEditar(tipo_cursos)"><i class="fas fa-edit" aria-hidden="true"></i>
                                                        </button>
                                                        <button v-if="$auth.can('delete-tipcur')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, tipo_cursos.idtc)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </template>
                                                    <template v-else>
                                                        <button v-if="$auth.can('delete-tipcur')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, tipo_cursos.idtc)">
                                                            <i class="far fa-times-circle"></i>
                                                        </button>
                                                    </template>
                                                </td>
                                                <td>{{tipo_cursos.nombrecurso}}</td>
                                                <td>{{tipo_cursos.descripcion}}</td>
                                                <td style="width:100px; text-align:center">{{tipo_cursos.puntaje}}</td>
                                                <td style="width:100px; text-align:center">
                                                    <div v-if="tipo_cursos.estado">
                                                        <span class="badge badge-success">Activo</span>
                                                    </div>
                                                    <div v-else>
                                                        <span class="badge badge-danger">Inactivo</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item" v-if="pagination.current_page > 1">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.first_page + 1,buscar,criterio)">&laquo;</a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page > 1">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                        </li>
                                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                        </li>
                                         <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.last_page,buscar,criterio)">&raquo;</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Registro -->
            <div class="modal fade" id="RegistrarNuevoTipoCurso" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Tipo Curso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Curso Perteneciente</label>
                                            <div class="col-md-9 col-form-control">
                                               <v-select label="nombrecurso" :options="cursos" v-model="valorCurso" required
                                                    :class="{ 'is-invalid' : $v.valorCurso.$error, 'is-valid':!$v.valorCurso.$invalid }">
                                                    <template v-slot:no-options="{ search, searching }">
                                                    <template v-if="searching">
                                                        Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                    </template>
                                                    <em v-else>
                                                        Lo sentimos, no hay opciones de coincidencia.</em>
                                                    </template>
                                                </v-select>
                                                <div class="invalid-feedback">
                                                    <span v-if="!$v.valorCurso.required">Debe introducir una descripción del curso</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Descripción del Curso</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control content" v-model="descripcion"
                                                onkeypress="return letynum(event)" onpaste="return false"
                                                style="text-transform:uppercase" @keypress="onlyletters"
                                                :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }"
                                                placeholder="Inserte la descripción del tipo curso" required>
                                                <div class="invalid-feedback">
                                                    <span v-if="!$v.descripcion.required">Debe introducir una descripción del curso</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Abreviatura del Curso</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control content" v-model="abreviatura" onkeypress="return sololetras(event)" onpaste="return false" maxlength="14" placeholder="Seleccione una abreviatura para el tipo curso" style="text-transform:uppercase" @keypress="onlyletters" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Clasificacion del Curso</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="clasificacion"
                                                    :class="{ 'is-invalid' : $v.clasificacion.$error, 'is-valid':!$v.clasificacion.$invalid }"
                                                    placeholder="Seleccione alguna clasificación del tipo curso" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="OFICIALES">OFICIALES</option>
                                                    <option value="SUBOFICIALES Y SARGENTOS">SOF. OFICIALES Y SARGENTOS</option>
                                                    <option value="TODOS">PERSONAL CIVIL</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <span v-if="!$v.clasificacion.required">Debe seleccionar una clasificación del curso</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Puntaje</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control content" v-model="puntaje" onkeypress="return solonum(event)" onpaste="return false" placeholder="Inserte un puntaje para el tipo curso" @keypress="onlyNumber" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row" >
                                            <label for="observacion" class="col-md-3 form-control-label">Observación del Curso</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control content" v-model="observacion" placeholder="Inserte alguna observación del tipo curso">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click.prevent="RegistrarNuevoTipoCurso()">Registrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Registro Tipo Cursos</h5>
                                        <button class="close" @click="abrirModal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError" :key="index" v-text="item"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" @click="abrirModal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Editar -->
            <div class="modal fade" id="EditarTipoCurso" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Modificar Tipo Curso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" role="form">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Curso Perteneciente</label>
                                        <div class="col-md-9 col-form-control">
                                            <select class="form-control" v-model="idcurso">
                                                <option v-for="curso in cursos" :key="curso.id" :value="curso.id" v-text="curso.nombrecurso"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Descripción del Curso</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="descripcionA" onkeypress="return letynum(event)" onpaste="return false" style="text-transform:uppercase" @keypress="onlyletters" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Abreviatura del Curso</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="abreviaturaA" onkeypress="return sololetras(event)" onpaste="return false" style="text-transform:uppercase" @keypress="onlyletters" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Clasificacion del Curso</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="clasificacionA" required>
                                                <option value="">Seleccione</option>
                                                <option value="OFICIALES">OFICIALES</option>
                                                <option value="SUBOFICIALES Y SARGENTOS">SOF. OFICIALES Y SARGENTOS</option>
                                                <option value="TODOS">PERSONAL CIVIL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Puntaje</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="puntajeA" onkeypress="return solonum(event)" onpaste="return false" @keypress="onlyNumber" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row" >
                                        <label for="observacion" class="col-md-3 form-control-label">Observación del Curso</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="observacionA">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="EditarTipoCurso()">Actualizar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </main>
</template>

<script>
import { required} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            tipo_cursos: [],
            cursos: [],
            offset  : 3,
            valorCurso: "",
            descripcion: "",
            abreviatura: "",
            clasificacion: "",
            puntaje: "",
            observacion: "",
            modalShow: false,
            mostrarModal:{
                display: 'block',
                background: '#0000006b',
            },
            ocultarModal:{
                display: 'none',
            },
            error: 0,
            mensajeError: [],

            /*Editar Curso*/
            idcurso:"",
            descripcionA:"",
            abreviaturaA: "",
            clasificacionA: "",
            puntajeA:"",
            observacionA:"",
            idtc: "",

            offset  : 3,
            criterio : 'c.descripcion',
            buscar: '',
            pagination: {
                'total'         :   0,
                'current_page'  :   0,
                'per_page'      :   0,
                'last_page'     :   0,
                'from'          :   0,
                'to'            :   0,
            }
        }
    },
    validations:{
        valorCurso : { required },
        descripcion : { required },
        clasificacion : { required }
    },
    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },
        pagesNumber: function(){
            if(!this.pagination.to){
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if(from < 1){
                from = 1;
            }
            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    mounted() {
        this.listadoTipoCursos(1,this.buscar.toUpperCase(),this.criterio);
    },
    methods: {
        limpiarCriterios(){
            this.valorCurso = '',
            this.descripcion = '',
            this.abreviatura = '',
            this.clasificacion = '',
            this.puntaje = '',
            this.observacion = ''
        },
        abrirModal(){
            this.modalShow = !this.modalShow;
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listadoTipoCursos(page,buscar,criterio);
        },
        onlyNumber ($event) { //SOLO NUMEROS
            //console.log($event.keyCode); //keyCodes value
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 48 || keyCode > 57)) { // 46 is dot
                $event.preventDefault();
            }
        },
        alphanumeric ($event) { //NUMEROS Y LETRAS
            // console.log($event.keyCode); //keyCodes value
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && (keyCode < 48 || keyCode > 57)  && keyCode !== 209 && keyCode !== 241 && keyCode !== 32 && keyCode !== 45) { // 46 is dot
                $event.preventDefault();
            }
        },
        onlyletters ($event) { //SOLO letras
            //console.log($event.keyCode); //keyCodes value
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) &&  keyCode !== 209 && keyCode !== 241 && keyCode !== 32) { // 46 is dot
                $event.preventDefault();
            }
        },
        numDoc ($event) { //SOLO NUMEROS y "/"
            //console.log($event.keyCode); //keyCodes value
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 48 || keyCode > 57) && keyCode !== 47) { // 46 is dot
                $event.preventDefault();
            }
        },
        listarCursos(){
            let me = this;
            axios.get('/listarCursos')
            .then(function(response){
                var respuesta = response.data;
                me.cursos = respuesta.cursos;
            }).catch(function(error){
                console.log(error);
            })
        },
        listadoTipoCursos(page,buscar,criterio){
            let me = this;
            axios.post("/listTipoCurso",{
                page: page,
                buscar: buscar.toUpperCase(),
                criterio: criterio
            }).then(function (response){
                var respuesta = response.data;
                me.tipo_cursos= respuesta.tipo_cursos.data;
                me.pagination = respuesta.pagination;
            }).catch(function(error){
                console.log(error);
            })
        },
        abrirCrear(id){
            $('#RegistrarNuevoTipoCurso').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarCursos();
        },
        RegistrarNuevoTipoCurso(){
            if(!this.$v.$invalid){
                let me = this;
                axios.post("/RegistroNuevoTipoCurso", {
                    'valorCurso'    :   this.valorCurso.id,
                    'descripcion'   :   this.descripcion,
                    'abreviatura'   :   this.abreviatura,
                    'clasificacion' :   this.clasificacion,
                    'puntaje'       :   this.puntaje,
                    'observacion'   :   this.observacion
                }).then(function (response) {
                    if(response.data=="existe"){
                        Swal.fire({
                            icon: 'warning',
                            title: 'El tipo curso ya se encuentra registrado, favor de verificar',
                            showConfirmButton: false,
                            timer: 3500
                        })
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Se registró un nuevo Tipo Curso',
                            showConfirmButton: false,
                            timer: 2500
                        })
                        $('#RegistrarNuevoTipoCurso').modal('hide');
                        me.limpiarCriterios();
                    }
                }).catch(error => {
                    console.log(error);
                })
                me.listadoTipoCursos(1,this.buscar.toUpperCase(),this.criterio);
            }else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        },
        abrirEditar(tipo_cursos){
            this.idcurso        =   tipo_cursos.cur_cod;
            this.descripcionA   =   tipo_cursos.descripcion;
            this.abreviaturaA   =   tipo_cursos.abreviatura;
            this.clasificacionA =   tipo_cursos.clasificacion;
            this.puntajeA       =   tipo_cursos.puntaje;
            this.observacionA   =   tipo_cursos.observacion;
            this.idtipocurso    =   tipo_cursos.idtc;
            $('#EditarTipoCurso').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarCursos(1,this.buscar.toUpperCase(),this.criterio);
        },
        EditarTipoCurso(){
            let me = this;
            var url = '/modificarTipoCurso';
            axios.post(url,{
                'cur_cod'           :   this.idcurso,
                'descripcionA'      :   this.descripcionA,
                'abreviaturaA'      :   this.abreviaturaA,
                'clasificacionA'    :   this.clasificacionA,
                'puntajeA'          :   this.puntajeA,
                'observacionA'      :   this.observacionA,
                'id'                :   this.idtipocurso
            }).then(function (response){
                if(response.data=="existe"){
                        Swal.fire({
                            icon: 'warning',
                            title: 'El tipo curso ya se encuentra registrado, favor de verificar',
                            showConfirmButton: false,
                            timer: 3500
                        })
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Se actualizó el Tipo Curso',
                            showConfirmButton: false,
                            timer: 2500
                    })
                    $('#EditarTipoCurso').modal('hide');
                }
            }).catch(error => {
                console.log(error);
            })
            me.listadoTipoCursos(1,this.buscar.toUpperCase(),this.criterio);
        },
        CambiarEstado(op, idtc){
            Swal.fire({
                title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' el tipo curso?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
            }).then((result) => {
                if (result.value) {
                    this.fullscreenLoading = true;
                    var url ='/tipo_cursos/cambiarEstado'
                    axios.post(url, {
                        'idtc'   :   idtc,
                        'estado'    :   (op == 1) ? '0' : '1'
                    }).then(response => {
                        Swal.fire({
                            icon    :   'success',
                            title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el tipo curso',
                            showConfirmButton   : false,
                            timer   :   1500
                        })
                        this.listadoTipoCursos(1,this.buscar.toUpperCase(),this.criterio);
                    }).catch(function (error) {
                        console.log(error);
                    })
                }else{
                    Swal.fire({
                        icon    :   'info',
                        title   :   'No se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el tipo curso'
                    });
                }
            })
        }
    },
}
</script>
<style>
</style>
