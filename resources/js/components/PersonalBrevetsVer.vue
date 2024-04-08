<template>
    <main>
        <section class="content-header">
            <h1><i class="far fa-id-card"></i> Listado de Brevetaciones del Personal</h1>
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
                                                    <button v-if="$auth.can('create-perbrev')" type="button" class="btn btn-sm btn-primary btn-block" style="margin-right: 5px;" title="Registrar Brevet" @click="abrirCrear(per_codigo)">
                                                        <i class="fas fa-plus" aria-hidden="true"></i> Nuevo Brevet
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button v-if="$auth.can('report-pdfperbrev')" class="btn btn-sm btn-secondary btn-block" @click.prevent="gendocbrevetpersonal(per_codigo)">
                                                        <i class="far fa-file-alt" aria-hidden="true"></i> Generar PDF
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <router-link type="button" class="btn btn-sm btn-danger btn-block position-reverse" :to="'/PersonalBrevets/'">
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
                                    <template v-if="PersonalBrevets.length">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 90px">Opciones</th>
                                                    <th>Brevet</th>
                                                    <th>Fecha de Imposición</th>
                                                    <th>País Brevetado</th>
                                                    <th>Nro. Documento</th>
                                                    <th>Tipo Documento</th>
                                                    <th class="text-center" style="width: 90px">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(pb, index) in PersonalBrevets" :key="index">
                                                    <td class="text-center" style="width: 90px">
                                                        <template v-if="pb.estado == '1'">
                                                            <button v-if="$auth.can('edit-perbrev')" type="button" class="btn btn-warning btn-sm" title="Modificar Brevet"
                                                                @click="abrirEditar(pb)">
                                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                                            </button>
                                                            <button v-if="$auth.can('delete-perbrev')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, pb.idPerBrev)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>

                                                        </template>
                                                        <template v-else>
                                                            <button v-if="$auth.can('delete-perbrev')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, pb.idPerBrev)">
                                                                <i class="far fa-times-circle"></i>
                                                            </button>
                                                        </template>
                                                    </td>
                                                    <td v-text="pb.descripcion"></td>
                                                    <td v-text="since(pb.fecha_imposicion)"></td>
                                                    <td v-text="pb.nombre"></td>
                                                    <td v-text="pb.ndoc"></td>
                                                    <td v-text="pb.tipodoc"></td>
                                                    <td class="text-center" style="width: 90px">
                                                        <div v-if="pb.estado">
                                                            <span class="badge badge-success">Actual</span>
                                                        </div>
                                                        <div v-else>
                                                            <span class="badge badge-danger">Anterior</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </template>
                                    <template v-else>
                                        <div class="callout callout-info">
                                            <h5><i class="fas fa-exclamation-triangle x-lg-2"></i> Usted no cuenta con ningún brevet...</h5>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Registro -->
            <div class="modal fade" id="RegistrarPersonalBrevets" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Brevet</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form role="form" action="">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Brevet</label>
                                            <div class="col-md-9">
                                                <v-select label="descripcion" :options="brevets" v-model="valorBrevet"
                                                    :class="{ 'is-invalid' : $v.valorBrevet.$error, 'is-valid':!$v.valorBrevet.$invalid }">>
                                                    <template v-slot:no-options="{ search, searching }">
                                                    <template v-if="searching">
                                                        Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                    </template>
                                                    <em v-else>
                                                        Lo sentimos, no hay opciones de coincidencia.</em>
                                                    </template>
                                                </v-select>
                                                <div class="invalid-feedback">
                                                    <span v-if="!$v.valorBrevet.required">Debe introducir una fecha inicio</span>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Fecha de Imposición</label>
                                        <div class="col-md-9 col-form-control">
                                            <date-picker style="width: 100%; max-width:100;" value-type="date" format="DD/MM/YYYY"
                                                v-model="fecha_imposicion" :disabled-date="fechaactual"
                                                :class="{ 'is-invalid' : $v.fecha_imposicion.$error, 'is-valid':!$v.fecha_imposicion.$invalid }">
                                            </date-picker>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.fecha_imposicion.required">Debe introducir una fecha</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Pais</label>
                                        <div class="col-md-9">
                                            <v-select label="nombre" :options="paises" v-model="valorPais"
                                                :class="{ 'is-invalid' : $v.valorPais.$error, 'is-valid':!$v.valorPais.$invalid }">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                </template>
                                                <em v-else>
                                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.valorPais.required">Debe introducir una fecha inicio</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="ndoc" class="col-md-3 form-control-label">Nro. del Documento</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="ndoc"
                                            onkeypress="return solonumeros(event)" onpaste="return false"
                                            maxlength="8" min="000/0000" placeholder="00/00"
                                            :class="{ 'is-invalid' : $v.ndoc.$error, 'is-valid':!$v.ndoc.$invalid }">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.ndoc.required">Debe introducir el nro. de documento</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Tipo de Documento</label>
                                        <div class="col-md-9">
                                            <v-select :options="opti" v-model="valortipodoc"
                                                :class="{ 'is-invalid' : $v.valortipodoc.$error, 'is-valid':!$v.valortipodoc.$invalid }">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                </template>
                                                <em v-else>
                                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.valortipodoc.required">Debe introducir el tipo de docuemtno</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group row">
                                        <label for="observacion" class="col-md-3 form-control-label">Observación del Brevet</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="observacion" onkeypress="return letynum(event)">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" v-model="per_codigo">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="RegistrarPersonalBrevets()">Registrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modificar Personal Cursos</h5>
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
                                        <label for="">Brevet</label>
                                        <select class="form-control" v-model="brevet_cod">
                                            <option v-for="brevet in brevets" :key="brevet.id" :value="brevet.id" v-text="brevet.descripcion"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="">Fecha de Imposición</label>
                                        <input type="date" v-model="fecha_imposicionA" class="form-control" format='DD-MM-YYYY' onkeydown="return false" min="1920-01-01" max="2021-12-31">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="">País Brevetado</label>
                                        <select class="form-control" v-model="pais_cod">
                                            <option value="0" disabled>SELECCIONE</option>
                                            <option v-for="pais in paises" :key="pais.id" :value="pais.id" v-text="pais.nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="">Nro. Documento</label>
                                        <input type="text" class="form-control"
                                        v-model="ndocA" onkeypress="return solonumeros(event)"
                                        onpaste="return false" maxlength="8" min="000/0000" placeholder="00/00">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="">Tipo Documento</label>
                                        <select class="form-control" v-model="tipodocA">
                                            <option value="0" disabled>SELECCIONE</option>
                                            <option v-for="opt in opti" :key="opt.id" :value="opt.label" v-text="opt.label"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="">Observaciones</label>
                                        <input type="text" class="form-control" v-model="observacionA" onkeypress="return letynum(event)">
                                    </div>
                                </div>
                                <input type="text" hidden v-model="per_codigo">
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

import moment from 'moment';

//Validación Vuelidate
import { required, alpha } from "vuelidate/lib/validators";

export default {
    data: function() {
        return {
            per_codigo: this.$route.params.id,
            subescalafon: this.$route.params.s,
            datos: [],
            PersonalBrevets:[],
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
            brevets:[],
            descripcion:"",
            fecha_imposicion:"",
            paises:[],
            nombre:"",
            ndoc:"",
            tipodoc:"",
            observacion:"",

            //Crear Brevet

            valorBrevet: "",
            valorPais: "",
            valortipodoc:"",

            /*
                VALORES PARA EDITAR
             */
            brevet_cod:"",
            fecha_imposicionA:"",
            pais_cod:"",
            ndocA:"",
            tipodocA:"",
            observacionA:"",
            percodigo:"",
            idb: "",

            id: "",

            opti: [
                {
                value: 'CERTIFICADO',
                label: 'CERTIFICADO'
                }, {
                value: 'DIPLOMA',
                label: 'DIPLOMA'
                }, {
                value: 'ORDEN DEL DIA',
                label: 'ORDEN DEL DIA'
                }, {
                value: 'MEMORANDUM',
                label: 'MEMORANDUM'
                }, {
                value: 'OTROS',
                label: 'OTROS'
                }
            ]
        }
    },
    validations:{
        valorBrevet: { required },
        fecha_imposicion: { required },
        valorPais: { required },
        ndoc: { required },
        valortipodoc: { required }
    },
    mounted() {
        this.listarPersonalBrevets();
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
        limpiarCriterios(){
            this.valorBrevet = '',
            this.fecha_imposicion = '',
            this.valorPais = '',
            this.ndoc = '',
            this.valortipodoc = '',
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
            .post("/datosPersoBrevets", {
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
        listarPersonalBrevets($per_codigo){
            let me = this;
            axios.post("/listarPersonalBrevets",{
                id: this.per_codigo
            }).
            then(function (response){
                me.PersonalBrevets = response.data;
            }).catch(function(error)
            {
                console.log(error);
            })
        },
        listarBrevets(){
            let me = this;
            axios.post('/listarBrevets',{
                subescalafon: me.subescalafon
            }).then(function(response){
                me.brevets = response.data;
            })
            .catch(function(error)
            {
                console.log(error);
            })
        },
        listarPaises(){
            let me = this;
            axios.get('/listarPaises')
            .then(function(response)
            {
                me.paises = response.data;
            })
            .catch(function(error)
            {
                console.log(error);
            })
        },
        abrirCrear(pb){
            $('#RegistrarPersonalBrevets').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarPaises();
            this.listarBrevets();
        },
        RegistrarPersonalBrevets: function(){
            let me = this;
            if(!this.$v.$invalid){
                axios.post("/crearBrevets", {
                    'per_codigo'        :   this.per_codigo,
                    'valorBrevet'       :   this.valorBrevet.id,
                    'fecha_imposicion'  :   this.fecha_imposicion,
                    'valorPais'         :   this.valorPais.id,
                    'ndoc'              :   this.ndoc,
                    'valortipodoc'      :   this.valortipodoc.value,
                    'observacion'       :   this.observacion,
                })
                .then(function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se registró el nuevo Brevet',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    $('#RegistrarPersonalBrevets').modal('hide');
                })
                .catch(error => {
                    console.log(error);
                })
                this.listarPersonalBrevets();
                this.limpiarCriterios();
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
        abrirEditar(pb){
            this.percodigo              =   pb.per_codigo;
            this.brevet_cod             =   pb.brevet_cod;
            this.pais_cod               =   pb.pais_cod;
            this.fecha_imposicionA      =   pb.fecha_imposicion;
                this.fecha_imposicionA  =   this.fecha_imposicionA.substring(0,10);
                var info10              =   this.fecha_imposicionA.split('-');
                this.fecha_imposicionA  =   info10[0] + '-' + info10[1] + '-' + info10[2];
            this.ndocA                  =   pb.ndoc;
            this.tipodocA               =   pb.tipodoc;
            this.observacionA           =   pb.observacion;
            this.idb                    =   pb.idPerBrev;
            $('#EditarBrevet').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarBrevets();
            this.listarPaises();
        },
        EditarBrevet(){
            let me = this
            var url = '/modificarBrevet';
            axios.post(url,{
                'percodigo'         :   this.per_codigo,
                'brevet_cod'        :   this.brevet_cod,
                'pais_cod'          :   this.pais_cod,
                'fecha_imposicionA' :   this.fecha_imposicionA,
                'ndocA'             :   this.ndocA,
                'tipodocA'          :   this.tipodocA,
                'observacionA'      :   this.observacionA,
                'id'                :   this.idb
            }).then(function (response){
                Swal.fire({
                    icon: 'success',
                    title: 'Se actualizó el Brevet',
                    showConfirmButton: false,
                    timer: 2500
                }),
                $('#EditarBrevet').modal('hide');
                me.listarPersonalBrevets();
            }).catch(function (error){
                console.log(error);
            })
        },
        CambiarEstado(op, idPerBrev){
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
                    var url ='/personalBrevets/cambiarEstado'
                    axios.post(url, {
                        'pb'   :   idPerBrev,
                        'estado'    :   (op == 1) ? '0' : '1'
                    }).then(response => {
                        Swal.fire({
                            icon    :   'success',
                            title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el brevet',
                            showConfirmButton   : false,
                            timer   :   1500
                        })
                        this.listarPersonalBrevets();
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
        },
        gendocbrevetpersonal($per_codigo){
            window.open('http://sipefab.fab.bo/reporte/gendocbrevetpersonal?id='+ $per_codigo, '_blank');
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
