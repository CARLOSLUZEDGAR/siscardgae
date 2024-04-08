<template>
    <main>
        <section class="content-header">
            <h1><i class="far fa-id-card"></i> BREVETS</h1>
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
                                <button v-if="$auth.can('create-brev')" type="button" class="btn btn-primary btn-sm float-sm-right" title="Registrar Brevet" @click="abrirCrear()">
                                    <i class="fas fa-plus" aria-hidden="true"></i> Nuevo Brevet
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" v-model="criterio" value="descripcion">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" @keyup.enter="listadoBrevets(1,buscar,criterio)" v-model="buscar" placeholder="Realizar búsqueda" style="text-transform:uppercase">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" @click="listadoBrevets(1,buscar,criterio)" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper-scroll-y my-customscrollbar" style="font-size:16px;">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:100px" class="text-center">Opciones</th>
                                                <!-- <th style="width:100px" class="text-center">Nro.</th> -->
                                                <th style="width:100px" class="text-center">Descripción</th>
                                                <th style="width:100px" class="text-center">Asignación</th>
                                                <th style="width:100px" class="text-center">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(b, index) in brevets" :key="index">
                                                <td style="width:100px" class="text-center">
                                                    <template v-if="b.estado == '1'">
                                                        <button v-if="$auth.can('edit-brev')" type="button" class="btn btn-warning btn-sm" title="Modificar Brevet"
                                                            @click="abrirEditar(b)"><i class="fas fa-edit" aria-hidden="true"></i>
                                                        </button>
                                                        <button v-if="$auth.can('delete-brev')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, b.idb)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                    </template>
                                                    <template v-else>
                                                        <button v-if="$auth.can('delete-brev')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, b.idb)">
                                                            <i class="far fa-times-circle"></i>
                                                        </button>
                                                    </template>
                                                </td>
                                                <!-- <td style="width:100px" class="text-center">{{b.idb}}</td> -->
                                                <td>{{b.descripcion}}</td>
                                                <td style="width:100px" class="text-center">{{b.asignacion}}</td>
                                                <td style="width:100px" class="text-center">
                                                    <div v-if="b.estado">
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
            <div class="modal fade" id="RegistrarNuevoBrevet" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Brevet</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Descripcion del Brevet</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="descripcion"
                                            onkeypress="return sololetras(event)" onpaste="return false"
                                            style="text-transform:uppercase" @keypress="onlyletters"
                                            :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }"
                                            required placeholder="Introduzca una descripción del Brevet">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.descripcion.required">Debe introducir una descripción del curso</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Sub Escalafon Perteneciente</label>
                                        <div class="col-md-9 col-form-control">
                                            <v-select label="nombre" :options="subescalafones" v-model="valorSubEsc"
                                            :class="{ 'is-invalid' : $v.valorSubEsc.$error, 'is-valid':!$v.valorSubEsc.$invalid }"
                                            required>
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                </template>
                                                <em v-else>
                                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.valorSubEsc.required">Debe seleccionar un subescalafón del Brevet</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Puntaje del Brevet</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="puntaje" onkeypress="return solonum(event)" onpaste="return false" maxlength="2" min="1" max="99" required placeholder="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Asignación del Brevet</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="asignacion"
                                                :class="{ 'is-invalid' : $v.asignacion.$error, 'is-valid':!$v.asignacion.$invalid }">
                                                <option value="">SELECCIONE</option>
                                                <option value="OFICIALES">OFICIALES</option>
                                                <option value="SUBOFICIALES MAESTRE">SOF. OFICIALES MAESTRE</option>
                                                <option value="SUBOFICIALES">SOF. OFICIALES</option>
                                                <option value="SARGENTOS">SARGENTOS</option>
                                                <option value="SUBOFICIALES Y SARGENTOS DE MUSICA">SOF. OFICIALES Y SARGENTOS DE MUSICA</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.asignacion.required">Debe Seleccionar una asignación del Brevet</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Clasificacion del Brevet</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="clasificacion"
                                                :class="{ 'is-invalid' : $v.clasificacion.$error, 'is-valid':!$v.clasificacion.$invalid }">
                                                <option value="">SELECCIONE</option>
                                                <option value="BR">BREVET</option>
                                                <option value="CT">CATEGORIA</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.clasificacion.required">Debe Seleccionar una clasificación del Brevet</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Observación del Brevet</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="observacion"
                                            onkeypress="return sololetras(event)" onpaste="return false"
                                            style="text-transform:uppercase" @keypress="onlyletters"
                                            placeholder="Introduzca una observación si fuese necesario">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click.prevent="RegistrarNuevoBrevet()">Registrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Registrar Brevet</h5>
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
            <div class="modal fade" id="EditarBrevet" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Modificar Brevet</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" role="form">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Descripcion del Brevet</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="descripcionA"
                                            onkeypress="return sololetras(event)" onpaste="return false"
                                            style="text-transform:uppercase" @keypress="onlyletters" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Sub Escalafon Perteneciente</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="subesc_cod">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="subescalafon in subescalafones" :key="subescalafon.id" :value="subescalafon.id" v-text="subescalafon.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Puntaje del Brevet</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control content" v-model="puntajeA" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Asignación del Brevet</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="asignacionA">
                                                <option value="" disabled>SELECCIONE</option>
                                                <option value="OFICIALES">OFICIALES</option>
                                                <option value="SUBOFICIALES MAESTRE">SOF. OFICIALES MAESTRE</option>
                                                <option value="SUBOFICIALES">SOF. OFICIALES</option>
                                                <option value="SARGENTOS">SARGENTOS</option>
                                                <option value="SUBOFICIALES Y SARGENTOS DE MUSICA">SOF. OFICIALES Y SARGENTOS DE MUSICA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Clasificacion del Brevet</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="clasificacionA">
                                                <option value="" disabled>SELECCIONE</option>
                                                <option value="BR">BREVET</option>
                                                <option value="CT">CATEGORIA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Observación del Brevet</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="observacionA"
                                            onkeypress="return sololetras(event)" onpaste="return false"
                                            style="text-transform:uppercase" @keypress="onlyletters"
                                            placeholder="Introduzca una observación si fuese necesario">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="EditarBrevet()">Actualizar</button>
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

//Validación Vuelidate
import { required} from "vuelidate/lib/validators";

export default {
    data() {
        return {
            brevets: [],
            pagination: {
                'total'         :   0,
                'current_page'  :   0,
                'per_page'      :   0,
                'last_page'     :   0,
                'from'          :   0,
                'to'            :   0,
            },
            buscar: '',
            offset  : 3,

            descripcion: "",
            subescalafones: [],
            valorSubEsc: "",
            criterio : 'descripcion',
            puntaje: "",
            asignacion: "",
            clasificacion: "",
            subesc_cod:0,
            observacion:"",

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

            /*Editar Brevet*/
            descripcionA:"",
            subesca:"",
            puntajeA:"",
            asignacionA:"",
            clasificacionA:"",
            observacionA:"",
            idB: ""
        }
    },
    validations:{
        descripcion : { required },
        valorSubEsc : { required },
        asignacion : { required },
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
        this.listadoBrevets(1,this.buscar.toUpperCase(),this.criterio);
    },
    methods: {
        limpiarCriterios(){
            this.descripcion = '',
            this.valorSubEsc = '',
            this.puntaje = '',
            this.asignacion = '',
            this.clasificacion = ''
        },
        abrirModal(){
            this.modalShow = !this.modalShow;
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listadoBrevets(page,buscar,criterio);
        },
        onlyNumber ($event) { //SOLO NUMEROS
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 48 || keyCode > 57)) {
                $event.preventDefault();
            }
        },
        alphanumeric ($event) { //NUMEROS Y LETRAS
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && (keyCode < 48 || keyCode > 57)  && keyCode !== 209 && keyCode !== 241 && keyCode !== 32 && keyCode !== 45) {
                $event.preventDefault();
            }
        },
        onlyletters ($event) { //SOLO letras
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) &&  keyCode !== 209 && keyCode !== 241 && keyCode !== 32) { // 46 is dot
                $event.preventDefault();
            }
        },
        numDoc ($event) { //SOLO NUMEROS y "/"
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 48 || keyCode > 57) && keyCode !== 47) {
                $event.preventDefault();
            }
        },
        listarSubEscalafon(){
            let me = this;
            axios.get('/listarSubEsca')
            .then(function(response){
                var respuesta = response.data;
                me.subescalafones = respuesta.subescalafones;
            }).catch(function(error){
                console.log(error);
            })
        },
        listadoBrevets(page,buscar,criterio){
            let me = this;
            axios.post("/listadoBrevets",{
                page: page,
                buscar: buscar.toUpperCase(),
                criterio: criterio
            }).then(function (response){
                var respuesta = response.data;
                me.brevets = respuesta.brevets.data;
                me.pagination = respuesta.pagination;
            }).catch(function(error){
                console.log(error);
            })
        },
        abrirCrear(id){
            $('#RegistrarNuevoBrevet').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarSubEscalafon();
        },
        RegistrarNuevoBrevet(){
            if(!this.$v.$invalid){
                let me = this;
                axios.post("/crearNueBrevet/RegNuevBrevet", {
                    'descripcion'   :   this.descripcion,
                    'valorSubEsc'   :   this.valorSubEsc.id,
                    'puntaje'       :   this.puntaje,
                    'asignacion'    :   this.asignacion,
                    'clasificacion' :   this.clasificacion,
                    'observacion'   :   this.observacion
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
                            title: 'Se registró un nuevo Brevet',
                            showConfirmButton: false,
                            timer: 2500
                        })
                        $('#RegistrarNuevoBrevet').modal('hide');
                        me.limpiarCriterios();
                    }
                }).catch(function (error){
                    console.log(error);
                })
                me.listadoBrevets(1,this.buscar.toUpperCase(),this.criterio);
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
        abrirEditar(b){
            this.descripcionA   =   b.descripcion;
            this.subesc_cod     =   b.subesc_cod;
            this.puntajeA       =   b.puntaje;
            this.asignacionA    =   b.asignacion;
            this.clasificacionA =   b.clasificacion;
            this.observacionA   =   b.observacion;
            this.idBrevet       =   b.idb;
            $('#EditarBrevet').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarSubEscalafon();
        },
        EditarBrevet(){
            let me = this
            var url = '/modificarNuevoBrevet';
            axios.post(url,{
                'descripcionA'      :   this.descripcionA,
                'subesc_cod'        :   this.subesc_cod,
                'puntajeA'          :   this.puntajeA,
                'asignacionA'       :   this.asignacionA,
                'clasificacionA'    :   this.clasificacionA,
                'observacion'       :   this.observacionA,
                'id'                :   this.idBrevet
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
                        title: 'Se actualizó el Brevet',
                        showConfirmButton: false,
                        timer: 2500
                    }),
                    $('#EditarBrevet').modal('hide');
                    this.listadoBrevets(1,this.buscar.toUpperCase(),this.criterio);
                }
            }).catch(function (error){
                console.log(error);
            })
            me.listadoBrevets(1,this.buscar.toUpperCase(),this.criterio);
        },
        CambiarEstado(op, idb){
            Swal.fire({
                title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' el brevet?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
            }).then((result) => {
                
                if (result.value) {
                    this.fullscreenLoading = true;
                    let me = this;
                    var url ='/brevets/cambiarEstado'
                    axios.post(url, {
                        'idb'       :   idb,
                        'estado'    :   (op == 1) ? '0' : '1'
                    }).then(response => {
                        Swal.fire({
                            icon    :   'success',
                            title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el brevet',
                            showConfirmButton   : false,
                            timer   :   1500
                        })
                        me.listadoBrevets(1,this.buscar.toUpperCase(),this.criterio);
                    }).catch(function (error) {
                        console.log(error);
                    })
                }else{
                    Swal.fire({
                        icon    :   'info',
                        title   :   'No se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el brevet'
                    });
                }
            })
        }
    }
}
</script>

<style>

</style>
