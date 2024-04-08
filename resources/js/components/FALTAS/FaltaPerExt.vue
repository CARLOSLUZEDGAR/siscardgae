<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">            
                <h1>
                <i class="far fa-bookmark"></i>
                PERSONAL EXTERNO A LA UNIDAD
                </h1>
            </div>
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Modals & Alerts</li>
                </ol>
            </div> -->
            </div>
        </div>
        <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- DATOS PERSONALES -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-dark card-outline">
                        <div class="card-header">
                            <div class="row mb-2">
                                <div class="col-sm-10">
                                    <h3 class="card-title">
                                        <i class="far fa-address-card"></i> &nbsp;
                                        Datos Personales
                                    </h3>
                                </div>
                                
                            </div> 
                        </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                            <img :src="'/img/personal/'+dataPer.foto" width="100%" height="100%" class="rounded float-left img-fluid">
                                    </div>
                                    <div class="col-md-10 d-flex align-items-center">
                                        <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                            <!-- FILA 1 -->
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">Nombre:</dt>
                                                        <dd class="st">{{ dataPer.grado }} {{ dataPer.complemento }} {{ dataPer.nombre }} {{ dataPer.paterno }} {{ dataPer.materno }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-4">
                                                    <dl>
                                                        <dt class="st">Situación Militar:</dt>
                                                        <dd class="st">{{ dataPer.situacion }}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <!-- FILA 2 -->
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">Carnet de Identidad</dt>
                                                        <dd class="st">{{ dataPer.ci }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-4">
                                                    <dl>
                                                        <dt class="st">Carnet Militar</dt>
                                                        <dd class="st">{{ dataPer.cm }}</dd>
                                                    </dl>
                                                </div>

                                            </div>
                                            <!-- FILA 3 -->
                                            <div class="row p-2 bd-highlight justify-content-center">
                                                    <div class="col-md-4">                                            
                                                        <button v-if="$auth.can('insert-faltuniext')" class="btn btn-sm btn-primary btn-block" @click="NuevaFaltaUnidades()">
                                                            <i class="fa fa-plus"></i> &nbsp;
                                                            Agregar Falta
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button class="btn btn-sm btn-danger btn-block" @click="Atras()">
                                                            <i class="fas fa-reply"></i> &nbsp;
                                                            Volver Atrás
                                                        </button>
                                                    </div>
                                                
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- ./row -->
                <!-- LISTA DE FALTAS -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-list-alt"></i> &nbsp;
                                Lista
                            </h3>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 15%" class="text-center">Opciones</th>
                                        <th style="width: 15%" class="text-center">Grado de Falta</th>
                                        <th style="width: 30%" class="text-center">Falta</th>
                                        <th style="width: 20%" class="text-center">Sanción</th>
                                        <th style="width: 10%" class="text-center">Fecha</th>
                                        <th style="width: 10%" class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in Ademeritos">
                                        <td class="text-center" style="vertical-align: middle;">
                                            <button v-if="$auth.can('edit-falta')" type="button" class="btn btn-warning btn-sm" @click="EditarFalta(p.id, p.externo)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-success btn-sm" @click="VerDatosModal(p.id)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button v-if="$auth.can('report-memofaluniext')" type="button" class="btn btn-secondary btn-sm" @click="Imprimir(p.id)">
                                                <i class="fas fa-print"></i>
                                            </button>
                                        </td>
                                        <td>{{p.f1}} </td>
                                        <td class="text-center">{{p.f2}}</td>
                                        <td class="text-center">{{p.sancion}}</td>
                                        <td class="text-center">{{p.fecha}}</td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <div v-if="p.estado === 1">
                                            <span class="badge badge-success">Validado</span>
                                            </div>
                                            <div v-else>
                                            <span class="badge badge-danger">Por Validar</span>                                            
                                            </div>                            
                                        </td> 
                                    </tr>
                                </tbody>
                                
                            </table> 
                            <!-- <nav>
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                    </li>
                                    
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                    </li>
                                </ul>
                            </nav> -->                            
                        </div>
                        <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- ./row -->
            </div>
            <!-- /.container-fluid -->


            <div class="modal fade" data-backdrop="static" id="NuevaFalta">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ dataPer.grado }} {{ dataPer.complemento }} {{ dataPer.nombre }} {{ dataPer.paterno }} {{ dataPer.materno }}</h4>
                            <button type="button" class="close" @click="CerrarModal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- LINEA 1 -->
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="">SANCIONADOR</label>
                                    <v-select
                                        label="text"
                                        :options="Asancionador"
                                        v-model="sancionador"
                                        :class="{ 'is-invalid' : $v.sancionador.$error, 'is-valid':!$v.sancionador.$invalid }"
                                    >
                                        <template v-slot:no-options="{ search, searching }">
                                            <template v-if="searching">
                                                Lo sentimos, no hay opciones de coincidencia para <em>{{
                                                search
                                                }}</em
                                                >.
                                            </template>
                                            <em v-else
                                                >Lo sentimos, no hay opciones de coincidencia.</em
                                            >
                                        </template>
                                    </v-select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.sancionador.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">CARGO:</label>
                                    <input type="text" :class="{ 'is-invalid' : $v.cargo.$error, 'is-valid':!$v.cargo.$invalid }" @keypress="onlyletters" class="form-control" v-model="cargo">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.cargo.required">Este campo es Requerido</span>                                    
                                        <span v-if="!$v.cargo.maxLength">Este campo permite solo 255 caracteres.</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">GRADO DE FALTA</label>
                                    <v-select
                                        label="descripcion"
                                        :options="Afaltas1"
                                        v-model="falta1"
                                        @input="Falta2"
                                        :class="{ 'is-invalid' : $v.falta1.$error, 'is-valid':!$v.falta1.$invalid }"
                                    >
                                        <template v-slot:no-options="{ search, searching }">
                                            <template v-if="searching">
                                                Lo sentimos, no hay opciones de coincidencia para <em>{{
                                                search
                                                }}</em
                                                >.
                                            </template>
                                            <em v-else
                                                >Lo sentimos, no hay opciones de coincidencia.</em
                                            >
                                        </template>
                                    </v-select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.falta1.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                            </div>

                            <!-- LINEA 2 -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">TIPO DE FALTA</label>
                                    <v-select
                                        label="descripcion"
                                        :options="Afaltas2"
                                        v-model="falta2"
                                        :class="{ 'is-invalid' : $v.falta2.$error, 'is-valid':!$v.falta2.$invalid }"
                                    >
                                        <template v-slot:no-options="{ search, searching }">
                                            <template v-if="searching">
                                                Lo sentimos, no hay opciones de coincidencia para <em>{{
                                                search
                                                }}</em
                                                >.
                                            </template>
                                            <em v-else
                                                >Lo sentimos, no hay opciones de coincidencia.</em
                                            >
                                        </template>
                                    </v-select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.falta2.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                            </div>

                            <!-- LINEA 3 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">DOCUMENTO</label>
                                    <v-select
                                        label="descripcion"
                                        :options="Adocumentos"
                                        v-model="doc"
                                        :class="{ 'is-invalid' : $v.doc.$error, 'is-valid':!$v.doc.$invalid }"
                                    >
                                        <template v-slot:no-options="{ search, searching }">
                                            <template v-if="searching">
                                                Lo sentimos, no hay opciones de coincidencia para <em>{{
                                                search
                                                }}</em
                                                >.
                                            </template>
                                            <em v-else
                                                >Lo sentimos, no hay opciones de coincidencia.</em
                                            >
                                        </template>
                                    </v-select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.doc.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">NUMERO DOCUMENTO</label>
                                    <input type="number" :class="{ 'is-invalid' : $v.ndoc.$error, 'is-valid':!$v.ndoc.$invalid }" @keypress="onlyNumber" class="form-control" min="0" style="text-transform:uppercase;" v-model="ndoc">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.ndoc.required">Este campo es Requerido</span>
                                        <span v-if="!$v.ndoc.maxLength">Este campo permite solo 10 caracteres.</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">SANCION</label>
                                    <v-select
                                        label="descripcion"
                                        :options="Asanciones"
                                        v-model="sancion"                                            
                                        :class="{ 'is-invalid' : $v.sancion.$error, 'is-valid':!$v.sancion.$invalid }"
                                    >
                                        <template v-slot:no-options="{ search, searching }">
                                            <template v-if="searching">
                                                Lo sentimos, no hay opciones de coincidencia para <em>{{
                                                search
                                                }}</em
                                                >.
                                            </template>
                                            <em v-else
                                                >Lo sentimos, no hay opciones de coincidencia.</em
                                            >
                                        </template>
                                    </v-select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.sancion.required">Este campo es Requerido</span>
                                    </div>
                                </div>                        
                            </div>

                            <!-- LINEA 4 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">FECHA DE SANCION</label>
                                    <date-picker class="dat" value-type="date" format="DD/MM/YYYY"
                                        v-model="fecha"
                                        :disabled-date="fechaactual"
                                        :class="{ 'is-invalid' : $v.fecha.$error, 'is-valid':!$v.fecha.$invalid }"
                                    ></date-picker>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.fecha.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">DIAS DE SANCIÓN</label>
                                    <input type="number" :class="{ 'is-invalid' : $v.dias.$error, 'is-valid':!$v.dias.$invalid }" @keypress="onlyNumber" class="form-control" min="0" v-model="dias">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.dias.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                            </div>

                            <!-- LINEA 5 -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">DETALLE</label>
                                    <textarea name="" id="" :class="{ 'is-invalid' : $v.observacion.$error, 'is-valid':!$v.observacion.$invalid }" class="form-control" cols="30" rows="3" v-model="observacion"></textarea>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.observacion.required">Este campo es Requerido</span>
                                        <span v-if="!$v.observacion.maxLength">Este campo permite solo 500 caracteres.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="Guardar()">
                                Guardar
                            </button>
                            <button type="button" class="btn btn-danger" @click="CerrarModal" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="VerFalta">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ Adatos.grado }}  {{ dataPer.nombre }} {{ dataPer.paterno }} {{ dataPer.materno }}</h4>
                            <button type="button" class="close" @click="CerrarModal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- SANCIONADO -->
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">DATOS SANCIONADO</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt class="st">UNIDAD:</dt>
                                            <dd class="st">{{Adatos.d3}}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6 separador">
                                        <dl>
                                            <dt class="st"> SECCION:</dt>
                                            <dd class="st">{{Adatos.d4}}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- SANCIONADOR -->
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">DATOS SANCIONADOR</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt class="st">NOMBRE:</dt>
                                            <dd class="st">{{Adatos.sancionador}}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6 separador">
                                        <dl>
                                            <dt class="st"> UNIDAD:</dt>
                                            <dd class="st">{{Adatos.unidad}}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">DATOS SANCIONADOR</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <dl>
                                            <dt class="st">DOCUMENTO:</dt>
                                            <dd class="st">{{Adatos.documento}}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-3 separador">
                                        <dl>
                                            <dt class="st">NUMERO DOCUMENTO:</dt>
                                            <dd class="st">{{Adatos.ndoc}}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-3 separador">
                                        <dl>
                                            <dt class="st">FECHA DE SANCION:</dt>
                                            <dd class="st">{{Adatos.fecha_sancion}}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-4 separador">
                                        <dl>
                                            <dt class="st">NIVEL FALTA:</dt>
                                            <dd class="st">{{Adatos.f1}}</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt class="st">TIPO FALTA:</dt>
                                            <dd class="st">{{Adatos.f2}}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-4 separador">
                                        <dl>
                                            <dt class="st">SANCION:</dt>
                                            <dd class="st">{{Adatos.sancion}}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-2 separador">
                                        <dl>
                                            <dt class="st">DIAS DE SANCION:</dt>
                                            <dd class="st">{{Adatos.dias}}</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <dl>
                                            <dt class="st">DETALLE:</dt>
                                            <dd class="st">{{Adatos.observacion}}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
import { required, maxLength, between } from 'vuelidate/lib/validators'
export default {
    data() {
        const today = new Date();
        return {
            per_codigo: this.$route.params.codigo, 
            r: this.$route.params.c, 
            u: this.$route.params.u,             
            fu: this.$route.params.fu,
            /**
             * VARIABLES DE RECEPCION
             */   
            // Datos Personales
            dataPer: [],       
            Ademeritos: [],
            /**
            * Variables paginacion
            */
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
            code: "",

            /**
             * VARIABLES NUEVA FALTA
             */
            //VARIABLES PARAMETRICAS
            //faltas y sanciones
            falta1: [],
            falta2: [],
            sancion: [],
            //documento
            doc: [],
            ndoc: '',
            fecha: new Date(today.getTime()),
            sancionador: [],
            dias: 0,
            grado:[],
            observacion: '',
            cargo: '',

            //VARIABLES DE RECEPCION
            //FALTAS Y SANCIONES
            Afaltas1: [
                {
                    id: 1,
                    descripcion: 'FALTA LEVE'
                },
                {
                    id: 2,
                    descripcion: 'FALTA GRAVE'
                }
            ],
            Afaltas2: [],
            Asanciones: [],
            Asancionador: [],
            //DOCUMENTOS
            Adocumentos:[
                {
                    id: 'MEMORANDUM',
                    descripcion: 'MEMORANDUM'
                }
            ],
            Adatos: []
            
        }
    },
    validations: {
        sancionador: {required},
        cargo: {required, maxLength: maxLength(255)},
        doc: {required},
        ndoc: {required, maxLength: maxLength(10)},
        falta1: {required},
        falta2: {required},
        sancion: {required},
        fecha: {required},
        dias: {required},
        observacion: {required, maxLength: maxLength(500)},
    },
    mounted() {
        this.DatosPersonales();
        this.ListarDemeritos();
    },
    methods: {
        DatosPersonales(){
            let me = this;
            axios
            .post("/datosPersonalesDem", {
                percodigo: me.per_codigo
            })
            .then(function (response) {
                
                me.dataPer = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        ListarDemeritos(){
            let me = this;
            axios
            .post("/listaDemeritosExternos", {
                per_codigo: me.per_codigo,
                unidad: me.u,
                faltuni: me.fu
            })
            .then(function (response) {
                
                me.Ademeritos = response.data;
                // me.Ademeritos = response.data.demeritos.data;
                // me.pagination = response.data.pagination;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        
        ListarSancinadores(){
            let me = this;
             axios
            .post("/listarPersonalTotalUnidad", {
                divGra: me.dataPer.divGra
            })
            .then(function (response) {
                me.Asancionador = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        NuevaFaltaDpto(){
            this.$router.push({
                name: "NuevaFalta",
            //ENVIO DE DATOS POR URL
                params:{
                    codigo: this.per_codigo,
                    nivFalta: this.dataPer.nivFalta,
                    division: this.dataPer.division
                }
            });
        },
        NuevaFaltaUnidades(){
            this.Sancion();
            
            this.ListarSancinadores();
            $('#NuevaFalta').modal('show');
        },
        Falta2(){
            let me = this;
            axios
            .post("/faltas2Combo", {
                falta1: me.falta1.id,
                nivel: me.dataPer.nivFalta
            })
            .then(function (response) {
                
                me.Afaltas2 = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        Sancion(){
            let me = this;
            axios
            .post("/sancionesCombo", {
                nivel: me.dataPer.nivFalta
            })
            .then(function (response) {
                
                me.Asanciones = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        CerrarModal(){
            //faltas y sanciones
            this.falta1= [];
            this.falta2= [];
            this.sancion= [];
            //documento
            this.doc= [];
            this.ndoc= '';
            this.fecha= '';
            this.sancionador= [];
            this.dias= 0;
            this.grado=[];
            this.observacion= '';
        },
        VerDatosModal(falta){
            this.VerDatos(falta);
            $('#VerFalta').modal('show');
        },
        VerDatos(falta){
            // alert(falta)
            let me = this;
            axios
            .post("/datosFalta", {
                per_codigo: me.per_codigo,
                id: falta
            })
            .then(function (response) {
                
                me.Adatos = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        Guardar(){
            this.$v.$reset()
            if (!this.$v.$invalid) {
                swal.fire({
                    title: '¿Desea guardar esta falta?', // TITULO 
                    icon: 'question', //ICONO (success, warnning, error, info, question)
                    showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
                    confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
                    cancelButtonColor: '#868077', // CLOR DEL BOTON CANCELAR
                    confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
                    cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios
                        .post("/guardarFalta", {
                            per_codigo: me.dataPer.codigo,
                            //destinos
                            dest1: me.dataPer.d1,
                            dest2: me.dataPer.d2,
                            dest3: me.dataPer.d3,
                            dest4: me.dataPer.d4,
                            unidad: me.u,
                            //faltas y sanciones
                            falta1: me.falta1.id,
                            falta2: me.falta2.id,
                            sancion: me.sancion.id,
                            externo: 1,
                            //documento
                            doc: me.doc.id,
                            ndoc: me.ndoc,
                            fecha: me.fecha,
                            sancionador: me.sancionador.text,
                            dias: me.dias,
                            grado:me.dataPer.gid,
                            complemento: me.dataPer.comid,
                            observacion: me.observacion,
                            cargo: me.cargo,
                            estado: 2,                        
                            faltuni: 2
                        })
                        .then(function (response) {
                            swal.fire(
                                "Aceptado", //TITULO
                                "Se añadio correctamente la falta.", //TEXTO DE MENSAJE
                                "success" // TIPO DE MODAL (success, warnning, error, info)
                            );

                            
                            me.ListarDemeritos();
                            
                            $('#NuevaFalta').modal('hide');
                            me.CerrarModal();

                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })
                    }
                })
            } else {
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

        },
        EditarFalta(falta, externo){
            this.$router.push({
                name: "EditarFalta",
            //ENVIO DE DATOS POR URL
                params:{
                    falta: falta,
                    codigo: this.per_codigo,
                    nivFalta: this.dataPer.nivFalta,
                    division: this.dataPer.division,
                    externo: externo,                    
                    fu: this.fu
                }
            });
        },
        /**
         * BOTON ATRAS
         */
        Atras(){
            this.$router.push({
                name: "ListaPersonalFaltasExterno"
            });
        },
        /**
         * validaciones de campos
         */
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
            // console.log($event.keyCode); //keyCodes value
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) &&  keyCode !== 209 && keyCode !== 241 && keyCode !== 32 && keyCode !== 46) { // 46 is dot
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
        fechaactual(date){
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return  date > new Date(today.getTime());
        },
        /**
         * IMPRESION DE REPORTE PARA CONSTANCIA
         */
        Imprimir(falta){
        window.open('http://sipefab.fab.bo/reporteDemeritos/'+falta);
        // window.open('http://sipefab.fab.bo:8000/reporteDemeritos/'+falta);
        }

    },

};
</script>

<style>
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    width:auto;
    padding:0 10px;
    border-bottom:none;
}

.separador {
    border-left: 1px #000 solid;
    padding-left: 15px;
}
</style>