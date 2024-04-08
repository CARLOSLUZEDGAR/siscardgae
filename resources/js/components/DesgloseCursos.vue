<template>
    <main>
        <section class="content-header">
            <h1><i class="fas fa-graduation-cap"></i> Desglose Cursos</h1>
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
                                <button v-if="$auth.can('create-descur')" type="button" class="btn btn-primary btn-sm float-sm-right" title="Registrar Curso" @click="abrirCrear()">
                                    <i class="fas fa-plus" aria-hidden="true"></i> Nuevo Desglose Curso
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="criterio">
                                            <option value="tc.descripcion">Nombre del Tipo Curso</option>
                                            <option value="dc.descripcion">Descripcion del Desglose Curso</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" @keyup.enter="listadoDesgloseCursos(1,buscar,criterio)" v-model="buscar" style="text-transform:uppercase" placeholder="Realizar búsqueda">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" @click="listadoDesgloseCursos(1,buscar,criterio)" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper-scroll-y my-customscrollbar" style="font-size:16px;">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:100px; text-align:center">Acciones</th>
                                                <th style="width:100px; text-align:center">Tipo Curso</th>
                                                <th style="width:100px; text-align:center">Descripción</th>
                                                <th style="width:100px; text-align:center">Puntaje</th>
                                                <th style="width:100px; text-align:center">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(desglose_cursos, index) in desglose_cursos" :key="index">
                                                <td style="width:100px; text-align:center">
                                                    <template v-if="desglose_cursos.estado == '1'">
                                                        <button v-if="$auth.can('edit-descur')" type="button" class="btn btn-warning btn-sm" title="Modificar Desglose Curso"
                                                            @click="abrirEditar(desglose_cursos)"><i class="fas fa-edit" aria-hidden="true"></i>
                                                        </button>
                                                        <button v-if="$auth.can('delete-descur')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, desglose_cursos.iddc)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </template>
                                                    <template v-else>
                                                        <button v-if="$auth.can('delete-descur')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, desglose_cursos.iddc)">
                                                            <i class="far fa-times-circle"></i>
                                                        </button>
                                                    </template>
                                                </td>
                                                <td>{{desglose_cursos.nombretipocurso}}</td>
                                                <td>{{desglose_cursos.descripcion}}</td>
                                                <td style="width:100px; text-align:center">{{desglose_cursos.puntaje}}</td>
                                                <td style="width:100px; text-align:center">
                                                    <div v-if="desglose_cursos.estado">
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
            <div class="modal fade" id="RegistrarNuevoDesgloseCurso" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Desglose Curso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form role="form" action="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Tipo Curso Perteneciente</label>
                                            <div class="col-md-9 col-form-control">
                                               <v-select label="nombretipocurso" :options="tipo_cursos" v-model="valorTipoCurso"
                                                    :class="{ 'is-invalid' : $v.valorTipoCurso.$error, 'is-valid':!$v.valorTipoCurso.$invalid }"
                                                    placeholder="Seleccione un tipo curso">
                                                    <template v-slot:no-options="{ search, searching }">
                                                    <template v-if="searching">
                                                        Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                    </template>
                                                    <em v-else>
                                                        Lo sentimos, no hay opciones de coincidencia.</em>
                                                    </template>
                                                </v-select>
                                                <div class="invalid-feedback">
                                                    <span v-if="!$v.valorTipoCurso.required">Debe introducir una descripción del curso</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Desglose del Curso</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control content" v-model="descripcion"
                                                onkeypress="return letynum(event)" onpaste="return false"
                                                style="text-transform:uppercase" @keypress="onlyletters"
                                                :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }"
                                                placeholder="Inserte la descripción del desglose curso" required>
                                                <div class="invalid-feedback">
                                                    <span v-if="!$v.descripcion.required">Debe introducir una descripción del curso</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Puntaje</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control content" v-model="puntaje" onkeypress="return solonum(event)" onpaste="return false" placeholder="Inserte un puntaje para el desglose curso si fuese necesario" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click.prevent="RegistrarNuevoDesgloseCurso()">Registrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Registro Desglose Cursos</h5>
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
            <div class="modal fade" id="EditarDesgloseCurso" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Modificar Desglose Curso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" role="form">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-12 form-control-label">Tipo Curso Perteneciente</label>
                                        <div class="col-md-12 col-form-control">
                                            <select class="form-control" v-model="id_tipocurso">
                                                <option v-for="tipo_curso in tipo_cursos" :key="tipo_curso.id" :value="tipo_curso.id" v-text="tipo_curso.nombretipocurso"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-12 form-control-label">Descripción del Curso</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control content" v-model="descripcionA" onkeypress="return letynum(event)" onpaste="return false" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-12 form-control-label">Puntaje</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control content" v-model="puntajeA" onkeypress="return solonum(event)" onpaste="return false" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click.prevent="EditarDesgloseCurso()">Actualizar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modificar Desglose Cursos</h5>
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
        </section>
        <!-- /.content -->
    </main>
</template>

<script>
import { required} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            desglose_cursos: [],
            tipo_cursos: [],
            valorTipoCurso: "",
            descripcion: "",
            puntaje: "",

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
            id_tipocurso: "",
            descripcionA:"",
            puntajeA:"",
            iddc: "",

            offset  : 3,
            criterio : 'tc.descripcion',
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
        valorTipoCurso : { required },
        descripcion : { required }
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
        this.listadoDesgloseCursos(1,this.buscar.toUpperCase(),this.criterio)
    },
    methods: {
        limpiarCriterios(){
            this.valorTipoCurso = '',
            this.descripcion = '',
            this.puntaje = ''
        },
        abrirModal(){
            this.modalShow = !this.modalShow;
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listadoDesgloseCursos(page,buscar,criterio);
        },
        listadoTipoCursos(){
            let me = this;
            axios.get('/listarTipoCursos')
            .then(function(response)
            {
                me.tipo_cursos = response.data;
            })
            .catch(function(error)
            {
                console.log(error);
            })
        },
        listadoDesgloseCursos(page,buscar,criterio){
            let me = this;
            axios.post("/listDesgloseCurso",{
                page: page,
                buscar: buscar.toUpperCase(),
                criterio: criterio
            }).
            then(function (response){
                var respuesta = response.data;
                me.desglose_cursos = respuesta.desglose_cursos.data;
                me.pagination = respuesta.pagination;
            }).catch(function(error)
            {
                console.log(error);
            })
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
        abrirCrear(id){
            $('#RegistrarNuevoDesgloseCurso').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listadoTipoCursos();
        },
        RegistrarNuevoDesgloseCurso(){
            if(!this.$v.$invalid){
                let me = this;
                axios.post("/RegistroNuevoDesgloseCurso", {
                    'valorTipoCurso'    :   this.valorTipoCurso.id,
                    'descripcion'       :   this.descripcion,
                    'puntaje'           :   this.puntaje,
                })
                .then(function (response) {
                    if(response.data=="existe"){
                        Swal.fire({
                            icon: 'warning',
                            title: 'El desglose ya se encuentra registrado, favor de verificar',
                            showConfirmButton: false,
                            timer: 3500
                        })
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Se registró un desglose de Curso',
                            showConfirmButton: false,
                            timer: 2500
                        })
                        $('#RegistrarNuevoDesgloseCurso').modal('hide');
                        me.limpiarCriterios();
                    }
                }).catch(error => {
                    console.log(error);
                })
                me.listadoDesgloseCursos(1,this.buscar.toUpperCase(),this.criterio);
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
        abrirEditar(desglose_cursos){
            this.id_tipocurso       =   desglose_cursos.tipcur_cod;
            this.descripcionA       =   desglose_cursos.descripcion;
            this.puntajeA           =   desglose_cursos.puntaje;
            this.id_deslogsecursos  =   desglose_cursos.iddc;
            $('#EditarDesgloseCurso').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listadoTipoCursos(1,this.buscar.toUpperCase(),this.criterio);
        },
        EditarDesgloseCurso(){
            let me = this;
            var url = '/modificarDesgloseCurso';
            axios.post(url,{
                'tipcur_cod'    :   this.id_tipocurso,
                'descripcionA'  :   this.descripcionA,
                'puntajeA'      :   this.puntajeA,
                'id'            :   this.id_deslogsecursos
            }).then(function (response){
                 if(response.data=="existe"){
                    Swal.fire({
                        icon: 'warning',
                        title: 'El curso ya se encuentra registrado, favor de verificar',
                        showConfirmButton: false,
                        timer: 3500
                    })
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Se actualizó el Desglose Curso',
                        showConfirmButton: false,
                        timer: 2500
                    }),
                    $('#EditarDesgloseCurso').modal('hide');
                }
            }).catch(error => {
                console.log(error);
            })
            me.listadoDesgloseCursos(1,this.buscar.toUpperCase(),this.criterio);
        },
        CambiarEstado(op, iddc){
            Swal.fire({
                title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' el desglose curso?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
            }).then((result) => {
                if (result.value) {
                    this.fullscreenLoading = true;
                    var url ='/desglose_cursos/cambiarEstado'
                    axios.post(url, {
                        'iddc'   :   iddc,
                        'estado'    :   (op == 1) ? '0' : '1'
                    }).then(response => {
                        Swal.fire({
                            icon    :   'success',
                            title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el desglose curso',
                            showConfirmButton   : false,
                            timer   :   1500
                        })
                        this.listadoDesgloseCursos(1,this.buscar.toUpperCase(),this.criterio);
                    }).catch(function (error) {
                        console.log(error);
                    })
                }else{
                    Swal.fire({
                        icon    :   'info',
                        title   :   'No se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el desglose curso'
                    });
                }
            })
        }
    }
}
</script>

<style>

</style>
