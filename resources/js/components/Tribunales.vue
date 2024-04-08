<template>
    <main>
        <section class="content-header">
            <h1><i class="fas fa-balance-scale-right"></i> MIEMBROS DEL TRIBUNAL</h1>
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
                                <button v-if="$auth.can('create-trib')" type="button" class="btn btn-primary btn-sm float-sm-right" title="Registrar Tribunal" @click="abrirCrear()">
                                    <i class="fas fa-plus" aria-hidden="true"></i> Nuevo Tribunal
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" v-model="criterio" value="descripcion">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" @keyup.enter="listaMiembrosTribunal(1,buscar,criterio)" v-model="buscar" placeholder="Realizar búsqueda" style="text-transform:uppercase">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" @click="listaMiembrosTribunal(1,buscar,criterio)" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper-scroll-y my-customscrollbar" style="font-size:16px;">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:100px; text-align:center">Acciones</th>
                                                <th style="width:100px; text-align:center">Nro.</th>
                                                <th>Descripción</th>
                                                <th>Clasificación</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(trib, index) in tribunales" :key="index">
                                                <td style="width:100px; text-align:center">
                                                    <template v-if="trib.estado = 1">
                                                        <button v-if="$auth.can('edit-trib')" type="button" class="btn btn-warning btn-sm" title="Modificar Tribunal"
                                                            @click="abrirEditar(trib)"><i class="fas fa-edit" aria-hidden="true"></i>
                                                        </button>
                                                    </template>
                                                </td>
                                                <td>{{trib.id}}</td>
                                                <td>{{trib.descripcion}}</td>
                                                <td>{{trib.clasificacion}}</td>
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
            <div class="modal fade" id="RegistrarNuevoTribunal" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Tribunal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form role="form" action="">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Descripcion del Tribunal</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="descripcion"
                                            style="text-transform:uppercase" @keypress="onlyletters"
                                            onkeypress="return sololetras(event)" onpaste="return false"
                                            required placeholder="Inserte descripcion del tribunal"
                                            :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.descripcion.required">Debe introducir una descripción del curso</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Clasificacion del Tribunal</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="clasificacion"
                                                :class="{ 'is-invalid' : $v.clasificacion.$error, 'is-valid':!$v.clasificacion.$invalid }">
                                                <option value="" :disabled="estado">Seleccione</option>
                                                <option value="OFICIALES">Oficiales</option>
                                                <option value="SUBOFICIALES Y SARGENTOS">Sof. Oficiales y Sargentos</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.clasificacion.required">Debe introducir una descripción del curso</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Sub Escalafon Perteneciente</label>
                                        <div class="col-md-9 col-form-control">
                                            <v-select label="nombre" :options="subescalafon" v-model="valorSubEsc" required
                                                :class="{ 'is-invalid' : $v.valorSubEsc.$error, 'is-valid':!$v.valorSubEsc.$invalid }">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                </template>
                                                <em v-else>
                                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.valorSubEsc.required">Debe introducir una descripción del curso</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Puntaje</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="puntaje" onkeypress="return solonum(event)" onpaste="return false" maxlength="3" minlength="1" min="0" placeholder="0" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Observaciones</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="observacion" onkeypress="return letynum(event)" onpaste="return false" placeholder="Inserte alguna observación" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click.prevent="RegistrarNuevoTribunal()">Registrar</button>
                        </div>
                        <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Registro Tribunal</h5>
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
            <div class="modal fade" id="EditarTribunal" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Modificar Tribunal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Descripcion del Tribunal</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control content" v-model="descripcionA"
                                                onkeypress="return sololetras(event)" onpaste="return false"
                                                style="text-transform:uppercase" @keypress="onlyletters" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Clasificación del Tribunal</label>
                                            <div class="col-md-9">
                                                <select class="form-control content" v-model="clasificacionA">
                                                    <option value="0" :disabled="estado">Seleccione</option>
                                                    <option value="OFICIALES">Oficiales</option>
                                                    <option value="SUBOFICIALES Y SARGENTOS">Sof. Oficiales y Sargentos</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Sub Escalafon Perteneciente</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="valorSubEscA">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="subesca in subescalafon" :key="subesca.id" :value="subesca.id" v-text="subesca.nombre"></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Puntaje</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control content" v-model="puntajeA" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Observaciones</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control content" v-model="observacionA" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="EditarTribunal()">Actualizar</button>
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
            tribunales: [],
            buscar: '',
            criterio:"descripcion",
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
            clasificacion: "",
            estado: true,
            subescalafon: [],
            valorSubEsc: "",
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

            /*Editar Tribunal*/
            descripcionA:"",
            clasificacionA:"",
            valorSubEscA:"",
            puntajeA:"",
            observacionA:"",
            id: ""
        }
    },
    validations:{
        descripcion : { required },
        clasificacion : { required },
        valorSubEsc : { required },
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
        this.listaMiembrosTribunal(1,this.buscar.toUpperCase(),this.criterio);
    },
    methods: {
        limpiarCriterios(){
            this.descripcion = '',
            this.clasificacion = '',
            this.valorSubEsc = '',
            this.puntaje = '',
            this.observacion = ''
        },
        abrirModal(){
            this.modalShow = !this.modalShow;
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listaMiembrosTribunal(page,buscar,criterio);
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
        listarSubEscalafon(){
            let me = this;
            axios.post('/listaSubEsca')
            .then(function(response)
            {
                me.subescalafon = response.data;
            })
            .catch(function(error)
            {
                console.log(error);
            })
        },
        listaMiembrosTribunal(page,buscar,criterio){
            let me = this;
            axios.post("/listaMiembrosTribunal",{
                page: page,
                buscar: buscar.toUpperCase(),
                criterio: criterio
            }).
            then(function (response){
                var respuesta = response.data;
                me.tribunales = respuesta.tribunales.data;
                me.pagination = respuesta.pagination;
            }).catch(function(error)
            {
                console.log(error);
            })
        },
        abrirCrear(id){
            $('#RegistrarNuevoTribunal').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarSubEscalafon();
        },
        RegistrarNuevoTribunal(){
            if(!this.$v.$invalid){
                let me = this;
                axios.post("/crearNueTribunal/RegNuevTribunal", {
                    'descripcion'   :   this.descripcion,
                    'puntaje'       :   this.puntaje,
                    'clasificacion' :   this.clasificacion,
                    'valorSubEsc'   :   this.valorSubEsc.id,
                    'observacion'   :   this.observacion
                })
                .then(function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se registró un nuevo Tribunal',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    $('#RegistrarNuevoTribunal').modal('hide');
                })
                .catch(error => {
                    console.log(error);
                })
                me.listaMiembrosTribunal(1,this.buscar.toUpperCase(),this.criterio);
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
        abrirEditar(trib){
            this.valorSubEscA   =   trib.subesc_cod;
            this.descripcionA   =   trib.descripcion;
            this.clasificacionA =   trib.clasificacion;
            this.puntajeA       =   trib.puntaje;
            this.observacionA   =   trib.observacion;
            this.idTribunal     =   trib.id;
            $('#EditarTribunal').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarSubEscalafon();
        },
        EditarTribunal(){
            let me = this
            var url = '/modificarNuevoTribunal';
            axios.post(url,{
                'valorSubEscA'      :   this.valorSubEscA,
                'descripcionA'      :   this.descripcionA,
                'clasificacionA'    :   this.clasificacionA,
                'puntajeA'          :   this.puntajeA,
                'observacionA'      :   this.observacionA,
                'id'                :   this.idTribunal
            }).then(function (response){
                Swal.fire({
                    icon: 'success',
                    title: 'Se actualizó el Tribunal',
                    showConfirmButton: false,
                    timer: 2500
                }),
                $('#EditarTribunal').modal('hide');
            }).catch(function (error){
                console.log(error);
            })
            this.listaMiembrosTribunal(1,this.buscar.toUpperCase(),this.criterio);
        }
    }
}
</script>

<style>

</style>
