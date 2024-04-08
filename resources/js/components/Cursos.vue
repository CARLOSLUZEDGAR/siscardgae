<template>
    <main>
        <section class="content-header">
            <h1><i class="fas fa-graduation-cap"></i> CURSOS</h1>
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
                                <button v-if="$auth.can('create-curso')" type="button" class="btn btn-primary btn-sm float-sm-right" title="Registrar Curso" @click="abrirCrear()">
                                    <i class="fas fa-plus" aria-hidden="true"></i> Nuevo Curso
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" v-model="criterio" value="descripcion" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" @keyup.enter="listadoCursos(1,buscar,criterio)" v-model="buscar" placeholder="Realizar búsqueda" style="text-transform:uppercase">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" @click="listadoCursos(1,buscar,criterio)" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper-scroll-y my-customscrollbar" style="font-size:16px;">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:100px" class="text-center">Acciones</th>
                                                <th style="width:100px" class="text-center">Descripción</th>
                                                <th style="width:100px" class="text-center">Observación</th>
                                                <th style="width:100px" class="text-center">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(c, index) in cursos" :key="index">
                                                <td style="width: 100px" class="text-center">
                                                    <template v-if="c.estado == '1'">
                                                        <button v-if="$auth.can('edit-curso')" type="button" class="btn btn-warning btn-sm" title="Modificar Curso"
                                                            @click="abrirEditar(c)"><i class="fas fa-edit" aria-hidden="true"></i>
                                                        </button>
                                                        <button v-if="$auth.can('delete-curso')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, c.idc)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </template>
                                                    <template v-else>
                                                        <button v-if="$auth.can('delete-curso')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, c.idc)">
                                                            <i class="far fa-times-circle"></i>
                                                        </button>
                                                    </template>
                                                </td>
                                                <td>{{c.descripcion}}</td>
                                                <td style="width:100px" class="text-center">{{c.observacion}}</td>
                                                <td style="width:100px" class="text-center">
                                                    <div v-if="c.estado">
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
            <div class="modal fade" id="RegistrarNuevoCurso" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Curso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Descripcion del Curso</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control content" v-model="descripcion"
                                                onkeypress="return sololetras(event)" onpaste="return false"
                                                style="text-transform:uppercase" @keypress="onlyletters"
                                                :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }"
                                                placeholder="Introduzca la descripción del curso" required>
                                                <div class="invalid-feedback">
                                                    <span v-if="!$v.descripcion.required">Debe introducir una descripción del curso</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row" >
                                            <label for="observacion" class="col-md-3 form-control-label">Observación del Curso</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control content" v-model="observacion" onkeypress="return sololetras(event)" onpaste="return false" placeholder="Introduzca una observación si fuese necesario" style="text-transform:uppercase" @keypress="onlyletters">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click.prevent="RegistrarNuevoCurso()">Registrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Registro Cursos</h5>
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
            <div class="modal fade" id="EditarCurso" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Modificar Curso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Descripcion del Curso</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="descripcionA" onkeypress="return sololetras(event)" onpaste="return false" @keypress="onlyletters" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row" >
                                        <label for="observacion" class="col-md-3 form-control-label">Observación del Curso</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="observacionA" onkeypress="return sololetras(event)" onpaste="return false" @keypress="onlyletters">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="EditarCurso()">Actualizar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
            cursos: [],
            pagination: {
                'total'         :   0,
                'current_page'  :   0,
                'per_page'      :   0,
                'last_page'     :   0,
                'from'          :   0,
                'to'            :   0,
            },
            offset  : 3,
            descripcion: "",
            observacion: "",

            offset  : 3,
            criterio : 'descripcion',
            buscar: '',
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
            descripcionA:"",
            observacionA:"",
            idc: "",

            pagination: {
                'first_page'    :   0,
                'total'         :   0,
                'current_page'  :   0,
                'per_page'      :   0,
                'last_page'     :   0,
                'from'          :   0,
                'to'            :   0,
            },
        }
    },
    validations:{
        descripcion : { required },

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
        this.listadoCursos(1,this.buscar.toUpperCase(),this.criterio);
    },
    methods: {
        limpiarCriterios(){
            this.descripcion = '',
            this.observacion = ''
        },
        abrirModal(){
            this.modalShow = !this.modalShow;
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listadoCursos(page,buscar,criterio);
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
        listadoCursos(page,buscar,criterio)
        {
            let me = this;
            axios.post("/listCurso",{
                page: page,
                buscar: buscar.toUpperCase(),
                criterio: criterio
            }).
            then(function (response){
                var respuesta = response.data;
                me.cursos = respuesta.cursos.data;
                me.pagination = respuesta.pagination;
            }).catch(function(error)
            {
                console.log(error);
            })
        },
        abrirCrear(id){
            $('#RegistrarNuevoCurso').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
        },
        RegistrarNuevoCurso(){
            if(!this.$v.$invalid){
                let me = this;
                axios.post("/crearNueCurso/RegNuevCurso", {
                    'descripcion'   :   this.descripcion,
                    'observacion'   :   this.observacion,
                })
                .then(function (response) {
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
                            title: 'Se registró un nuevo Curso',
                            showConfirmButton: false,
                            timer: 2500
                        })
                        $('#RegistrarNuevoCurso').modal('hide');
                        me.limpiarCriterios();
                    }
                }).catch(function (error){
                    console.log(error);
                })
                me.listadoCursos(1,this.buscar.toUpperCase(),this.criterio);
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
        abrirEditar(c){
            this.descripcionA   =   c.descripcion;
            this.observacionA   =   c.observacion;
            this.idCurso        =   c.idc;
            $('#EditarCurso').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
        },
        EditarCurso(){
            let me = this
            var url = '/modificarCurso';
            axios.post(url,{
                'id'            :   this.idCurso,
                'descripcionA'  :   this.descripcionA,
                'observacionA'  :   this.observacionA
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
                        title: 'Se actualizó el Curso',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    $('#EditarCurso').modal('hide');
                }
            }).catch(function (error){
                console.log(error);
            })
            me.listadoCursos(1,this.buscar.toUpperCase(),this.criterio);
        },
        CambiarEstado(op, idc){
            Swal.fire({
                title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' el curso?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
            }).then((result) => {
                if (result.value) {
                    this.fullscreenLoading = true;
                    var url ='/cursos/cambiarEstado'
                    axios.post(url, {
                        'idc'   :   idc,
                        'estado'    :   (op == 1) ? '0' : '1'
                    }).then(response => {
                        Swal.fire({
                            icon    :   'success',
                            title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el curso',
                            showConfirmButton   : false,
                            timer   :   1500
                        })
                        this.listadoCursos(1,this.buscar.toUpperCase(),this.criterio);
                    }).catch(function (error) {
                        console.log(error);
                    })
                }else{
                    Swal.fire({
                        icon    :   'info',
                        title   :   'No se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el curso'
                    });
                }
            })
        }
    }
}
</script>

<style>

</style>
