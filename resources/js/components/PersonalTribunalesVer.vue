<template>
    <main>
        <section class="content-header">
            <h1><i class="fas fa-user-graduate"></i> Tribunales del Personal</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img :src="'../img/personal/'+datos.foto" class="rounded float-left img-fluid" width="150" height="150">
                                    </div>
                                    <div class="col-md-10 d-flex align-items-center">
                                        <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">GRADOS Y NOMBRES</dt>
                                                        <dd class="st">{{ datos.grado }} {{ datos.complemento }} {{ datos.nombre }} {{ datos.paterno }} {{ datos.materno }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-4">
                                                    <dl>
                                                        <dt class="st">CARNET MILITAR</dt>
                                                        <dd class="st">{{ datos.cm }}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">CARNET DE IDENTIDAD</dt>
                                                        <dd class="st">{{ datos.ci }} {{ datos.expedido }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">SITUACION MILITAR ACTUAL</dt>
                                                        <dd class="st">{{ datos.nombsit }} - {{datos.nombsub}} - {{datos.nombdet}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="row p-2 bd-highlight justify-content-center">
                                                <div class="col-md-4">
                                                    <button v-if="$auth.can('create-pertrib')" type="button" class="btn btn-sm btn-primary btn-block" style="margin-right: 5px;" title="Registrar Tribunal" @click="abrirCrear(per_codigo)">
                                                        <i class="fas fa-plus-circle" aria-hidden="true"></i> Nuevo Tribunal
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button v-if="$auth.can('report-pdfpertrib')" class="btn btn-sm btn-secondary btn-block" @click.prevent="genro_docTribunalpersonal(per_codigo)">
                                                        <i class="far fa-file-pdf"></i> Generar PDF
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <router-link type="button" class="btn btn-sm btn-danger btn-block position-reverse" :to="'/tribunales/'">
                                                        <i class="fas fa-reply"></i> Volver Atrás
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="table-wrapper-scroll-y my-customscrollbar" style="font-size:16px;">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:100px; text-align:center">Acciones</th>
                                                <th style="width:100px; text-align:center">Tribunal</th>
                                                <th style="width:100px; text-align:center">Tipo Documento</th>
                                                <th style="width:100px; text-align:center">Nro. Documento</th>
                                                <th style="width:100px; text-align:center">Fecha</th>
                                                <th style="width:100px; text-align:center">Descripción</th>
                                                <th style="width:100px; text-align:center">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(pertrib, index) in personaltribunal" :key="index">
                                                <td style="width:100px; text-align:center">
                                                    <template v-if="pertrib.estado == '1'">
                                                        <button v-if="$auth.can('edit-pertrib')" type="button" class="btn btn-warning btn-sm" title="Modificar Tribunal"
                                                            @click="abrirEditar(pertrib)">
                                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                                        </button> &nbsp;
                                                        <button v-if="$auth.can('delete-pertrib')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, pertrib.id)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </template>
                                                    <template v-else>
                                                        <button v-if="$auth.can('delete-pertrib')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, pertrib.id)">
                                                            <i class="far fa-times-circle"></i>
                                                        </button>
                                                    </template>
                                                </td>
                                                <td v-text="pertrib.nombretribunal"></td>
                                                <td style="width:100px; text-align:center" v-text="pertrib.documento"></td>
                                                <td style="width:100px; text-align:center" v-text="pertrib.nro_doc"></td>
                                                <td style="width:100px; text-align:center" v-text="since(pertrib.fecha)"></td>
                                                <td v-text="pertrib.descripcion"></td>
                                                <td>
                                                    <div v-if="pertrib.estado">
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
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                                        </li>
                                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Registro -->
            <div class="modal fade" id="Registrarpersonaltribunal" data-backdrop="static">
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
                                        <label class="col-md-3 form-control-label">Tribunal</label>
                                        <div class="col-md-9">
                                            <v-select label="nombre" :options="Tribunals" v-model="valorTribunal"
                                                :class="{ 'is-invalid' : $v.valorTribunal.$error, 'is-valid':!$v.valorTribunal.$invalid }">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                </template>
                                                <em v-else>
                                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.valorTribunal.required">Debe seleccionar un tribunal</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Fecha</label>
                                        <div class="col-md-9">
                                             <date-picker style="width: 100%; max-width:100;" value-type="date"
                                                format="DD/MM/YYYY" :disabled-date="fechaactual" onkeydown="return false"
                                                v-model="fecha" min="1920-01-01" max="2021-12-31"
                                                :class="{ 'is-invalid' : $v.fecha.$error, 'is-valid':!$v.fecha.$invalid }">
                                            </date-picker>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.fecha.required">Debe introducir una fecha</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label">Descripción</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="descripcion"
                                            onkeypress="return letynum(event)" onpaste="return false"
                                            :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }"
                                            placeholder="Inserte una descripción del tribunal">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.descripcion.required">Debe introducir una descripción</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label">Nro. del Documento</label>
                                       <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="nro_doc"
                                            onkeypress="return solonumeros(event)" onpaste="return false"
                                            maxlength="8" min="000/0000" placeholder="00/00"
                                            :class="{ 'is-invalid' : $v.nro_doc.$error, 'is-valid':!$v.nro_doc.$invalid }">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.nro_doc.required">Debe introducir el nro. de documento</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Tipo de Documento</label>
                                        <div class="col-md-9">
                                            <v-select :options="opti" v-model="valordocumento"
                                                :class="{ 'is-invalid' : $v.valordocumento.$error, 'is-valid':!$v.valordocumento.$invalid }">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                </template>
                                                <em v-else>
                                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.valordocumento.required">Debe seleccionar el tipo de documento</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label">Observación del Tribunal</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="observacion" onkeypress="return letynum(event)" placeholder="Inserte una observación si fuese el caso necesario">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" v-model="per_codigo">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="Registrarpersonaltribunal()">Registrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Registro Tribunales</h5>
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
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Tribunal</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="tri_cod">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="trib in Tribunals" :key="trib.id" :value="trib.id" v-text="trib.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Fecha</label>
                                        <div class="col-md-9">
                                            <date-picker style="width: 100%; max-width:100;" value-type="date" format="DD/MM/YYYY"
                                                :disabled-date="fechaactual" v-model="fechaA" min="1920-01-01" max="2021-12-31">
                                            </date-picker>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Descripción</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="descripcionA"
                                            onkeypress="return sololetras(event)" onpaste="return false">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Nro. Documento</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="nro_docA"
                                            onkeypress="return solonumeros(event)" onpaste="return false"
                                            maxlength="8" min="000/0000" placeholder="00/00">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Documento</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="documentoA">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="opt in opti" :key="opt.id" :value="opt.label" v-text="opt.label"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Observación</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="observacionA" onkeypress="return letynum(event)">
                                        </div>
                                    </div>
                                </div>
                                <input type="text" hidden v-model="per_codigo">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="EditarTribunal()">Actualizar</button>
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
import moment from 'moment';

//Validación Vuelidate
import { required } from "vuelidate/lib/validators";

export default {
    data: function() {
        const today = new Date();
        return {
            per_codigo: this.$route.params.id,
            subescalafon: this.$route.params.s,
            datos: [],
            personaltribunal:[],
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

            Tribunals:[],
            descripcion:"",
            fecha:"",
            paises:[],
            nombre:"",
            nro_doc:"",
            documento:"",
            observacion:"",

            //Crear Tribunal
            valorTribunal: "",
            valordocumento:"",

            /*
                VALORES PARA EDITAR
             */
            tri_cod:"",
            documentoA:"",
            nro_docA:"",
            fechaA:"",
            descripcionA:"",
            observacionA:"",
            percodigo:"",
            idb: "",

            opti: [
                {
                value: 'DESIGNACION',
                label: 'DESIGNACION'
                }, {
                value: 'DIRECTIVA FAB',
                label: 'DIRECTIVA FAB'
                }, {
                value: 'ORDEN DEL DIA',
                label: 'ORDEN DEL DIA'
                }, {
                value: 'MEMORANDUM',
                label: 'MEMORANDUM'
                }, {
                value: 'RESOLUCION',
                label: 'RESOLUCION'
                }
            ],

            modalShow: false,
            error: 0,
            mensajeError: [],
            criterio : 'fecha',
            id: "",
            pagination: {
                'total'         :   0,
                'current_page'  :   0,
                'per_page'      :   0,
                'last_page'     :   0,
                'from'          :   0,
                'to'            :   0,
            },
            offset  : 3
        }
    },
    validations:{
        valorTribunal : { required },
        fecha : { required },
        descripcion : { required },
        nro_doc : { required },
        valordocumento : { required }
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
        this.listarPersonalTribunal(this.page);
        this.datospersonales();
        this.listarDatosPersonalSituacion();
    },
    methods: {
        since: function (d){
            return moment(d).format('DD-MM-YY');
        },
        abrirModal(){
            this.modalShow = !this.modalShow;
        },
        cambiarPagina(page){
            let me = this;
            me.pagination.current_page = page;
            me.listarPersonalTribunal(page);
        },
        limpiarCriterios(){
            this.valorTribunal = '',
            this.fecha = '',
            this.descripcion = '',
            this.nro_doc = '',
            this.valordocumento = '',
            this.observacion = ''
        },
        fechaactual(date){
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return  date > new Date(today.getTime());
        },
        datospersonales(){
            let me = this;
            axios
            .post("/datosPersoTrib", {
                per_codigo: me.per_codigo
            })
            .then(function (response) {
                me.datos = response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
        },
        listarDatosPersonalSituacion(){
            let me = this;
            axios.post("/listarDatosPersonalSituacion", {
                percodigo: me.per_codigo
            })
            .then(function (response) {
                me.datos=response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
        },
        listarPersonalTribunal($per_codigo,page)
        {
            let me = this;
            axios.post("/listarPersonalTribunales",{
                id: this.per_codigo,
                page: page
            }).
            then(function (response){
                var respuesta = response.data;
                me.personaltribunal = respuesta.personaltribunal.data;
            }).catch(function(error)
            {
                console.log(error);
            })
        },
        listarMiembrosTribunales(){
            let me = this;
            axios.post('/listarMiembrosTribunales',{
                subescalafon: me.subescalafon
            })
            .then(function(response)
            {
                me.Tribunals = response.data;
            })
            .catch(function(error)
            {
                console.log(error);
            })
        },
        abrirCrear(pertrib){
            $('#Registrarpersonaltribunal').modal('show');
             $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarMiembrosTribunales();
        },
        Registrarpersonaltribunal: function(){
            let me = this;
            if(!this.$v.$invalid){
                axios.post("/RegistrarNuevoTribunal", {
                    'per_codigo'        :   this.per_codigo,
                    'valorTribunal'     :   this.valorTribunal.id,
                    'fecha'             :   this.fecha,
                    'descripcion'       :   this.descripcion,
                    'nro_doc'           :   this.nro_doc,
                    'valordocumento'    :   this.valordocumento.value,
                    'observacion'       :   this.observacion,
                    })
                .then(function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se registró el nuevo Tribunal',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    $('#Registrarpersonaltribunal').modal('hide');
                })
                .catch(error => {
                    console.log(error);
                })
                me.listarPersonalTribunal();
                me.limpiarCriterios();
            }
            else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Todos los campos deben ser llenados',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        },
        abrirEditar(pertrib){
            this.percodigo      =   pertrib.per_codigo;
            this.tri_cod        =   pertrib.tribunal;
            this.documentoA     =   pertrib.documento;
            this.nro_docA       =   pertrib.nro_doc;
            this.fechaA         =   pertrib.fecha;
            this.descripcionA   =   pertrib.descripcion;
            this.observacionA   =   pertrib.observacion;
            this.idb            =   pertrib.id;
            console.log(pertrib);
            $('#EditarTribunal').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarMiembrosTribunales();
        },
        EditarTribunal(){
            let me = this
            var url = '/actualizarNuevoTribunal';
            axios.post(url,{
                'percodigo'     :   this.per_codigo,
                'tri_cod'       :   this.tri_cod,
                'documentoA'    :   this.documentoA,
                'nro_docA'      :   this.nro_docA,
                'fechaA'        :   this.fechaA,
                'descripcionA'  :   this.descripcionA,
                'observacionA'  :   this.observacionA,
                'id'            :   this.idb
            }).then(function (response){
                Swal.fire({
                    icon: 'success',
                    title: 'Se actualizó el Tribunal',
                    showConfirmButton: false,
                    timer: 2500
                }),
                $('#EditarTribunal').modal('hide');
                me.listarPersonalTribunal();
            }).catch(function (error){
                console.log(error);
            })
        },
        CambiarEstado(op, id){
            Swal.fire({
                title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' el Tribunal?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
            }).then((result) => {
                if (result.value) {
                    this.fullscreenLoading = true;
                    let me = this;
                    var url ='/personaltribunal/cambiarEstado'
                    axios.post(url, {
                        'id'   :   id,
                        'estado'    :   (op == 1) ? '0' : '1'
                    }).then(response => {
                        Swal.fire({
                            icon    :   'success',
                            title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el Tribunal',
                            showConfirmButton   : false,
                            timer   :   1500
                        })
                        me.listarPersonalTribunal();
                    }).catch(function (error) {
                        console.log(error);
                    })
                }else{
                    Swal.fire({
                        icon    :   'info',
                        title   :   'No se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el tribunal'
                    });
                }
            })
        },
        genro_docTribunalpersonal($per_codigo){
            window.open('http://sipefab.fab.bo/reporte/gendoctribunalpersonal?id='+ $per_codigo, '_blank');
        }
    }
}
</script>

<style>
    .position-reverse{
        flex-direction: row-reverse !important;
    }
    p.error{
        color: red;
    }
    .fail-error{
        border: 1px solid red;
    }
</style>
