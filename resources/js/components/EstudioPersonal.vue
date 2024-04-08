<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">            
                        <h1>
                            <i class="far fa-bookmark"></i>
                            Personal Complemento
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Incio</a></li>
                        <li class="breadcrumb-item active">Complemento Personal</li>
                        </ol>
                    </div>
                </div>
            </div>
        <!-- /.container-fluid -->
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
                                        <img v-bind:src="'../img/personal/'+arrayDatosPersonal.per_foto" class="rounded float-left img-fluid" width="100%" height="100%">
                                    </div>
                                    <div class="col-md-10 d-flex align-items-center">
                                        <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                            <!-- FILA 1 -->
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">GRADOS Y NOMBRES</dt>
                                                        <dd class="st">{{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-4">
                                                    <dl>
                                                        <dt class="st">CARNET MILITAR</dt>
                                                        <dd class="st">{{arrayDatosPersonal.per_cm}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <!-- FILA 2 -->
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">CARNET DE IDENTIDAD</dt>
                                                        <dd class="st">{{arrayDatosPersonal.per_ci}} {{arrayDatosPersonal.per_expedido}}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">SITUACIÓN MILITAR ACTUAL</dt>
                                                        <dd class="st">{{ datos.nombsit }} - {{datos.nombsub}} - {{datos.nombdet}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <!-- FILA 3 -->
                                            <div class="row p-2 bd-highlight justify-content-center">
                                                <div v-if="$auth.can('insert-perestu')" class="col-md-4">
                                                    <button type="button" class="btn btn-sm btn-primary btn-block" style="margin-right: 5px;" title="Registrar Complemento" @click="abrirModalRegistro()">
                                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Nuevo Complemento
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-sm btn-secondary btn-block" @click="generarReporte(per_codigo)">
                                                        <i class="far fa-file-pdf" aria-hidden="true"></i>&nbsp; Reporte Personal
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <router-link type="button" class="btn btn-sm btn-danger btn-block position-reverse" :to="'/listarPersonalEstudio/'">
                                                        <i class="fas fa-reply"></i>&nbsp; Volver Atrás
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="card card-primary card-outline">
                            <div class="card-body" style="font-size: 15px;">
                                <template v-if="arrayListaEstudio.length > 0">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr style="width:100px; text-align:center">
                                                <th>Opciones</th>
                                                <th>Abreviatura</th>
                                                <th>Descripción</th>
                                                <th>Instituto</th>
                                                <th>Documento</th>
                                                <th>Nro. Documento</th>
                                                <th>Fecha</th>
                                                <th>Observaciones</th>
                                                <th>Estado</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="listarEstudioPersonal in arrayListaEstudio" :key="listarEstudioPersonal.id">
                                                <td style="width:100px; text-align:center">
                                                    <button v-if="$auth.can('edit-perestu')" type="button" @click="abrirModalEditar(listarEstudioPersonal.id2)" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </button> &nbsp;
                                                    <template v-if="listarEstudioPersonal.estado==0">
                                                        <button v-if="$auth.can('delete-perestu')" type="button" class="btn btn-danger btn-sm" @click="EliminarEstudio(listarEstudioPersonal.id2)">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </template>
                                                </td>
                                                <td v-text="listarEstudioPersonal.abreviatura"></td>
                                                <td v-text="listarEstudioPersonal.descripcion"></td>
                                                <td v-text="listarEstudioPersonal.instituto"></td>
                                                <td v-text="listarEstudioPersonal.documento"></td>
                                                <td v-text="listarEstudioPersonal.nrodoc"></td>
                                                <td ><center>{{listarEstudioPersonal.fecha_documento | moment("D/MM/YYYY")}}</center></td>
                                                <td v-text="listarEstudioPersonal.observacion"></td>
                                                <td>
                                                    <div v-if="listarEstudioPersonal.estado == 1">
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
                                        <h6 style="color: #FF0000;"><center>EL PERSONAL NO CUENTA CON REGISTROS EN COMPLEMENTO</center></h6>
                                    </div>
                                </template>
                            </div>
                            <!-- /.card -->
                        </div>


                    </div>
                    <!-- /.col -->
                </div>
                <!-- ./row -->
            </div>
            <!-- /.container-fluid -->
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="ModalRegistro">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">REGISTRAR NUEVO COMPLEMENTO PERSONAL</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="carnetIdentidad">Complemento:</label>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" disabled v-model="complemento">
                                </div> 
                                <div class="col-md-8">
                                    <v-select
                                        label="nombre"
                                        :options="Aestudios"
                                        v-model="estudios"
                                        @input="mostrarCom"
                                        :class="{ 'is-invalid' : $v.estudios.$error, 'is-valid':!$v.estudios.$invalid }"
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
                                        <span v-if="!$v.estudios.required">Seleccione un valor porfavor</span>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="col-md-12 form-control-label" for="text-input">Tipo de Documento</label>
                                    <select class="form-control" v-model="documento" :class="{ 'is-invalid' : $v.documento.$error, 'is-valid':!$v.documento.$invalid }">
                                        <option value="0" disabled>Seleccione</option>
                                        <option value="MEMORANDUM">MEMORANDUM</option>
                                        <option value="NINGUNO">NINGUNO</option>
                                        <option value="NOTA DE SERVICIO">NOTA DE SERVICIO</option>
                                        <option value="OFICIO">OFICIO</option>
                                        <option value="ORDEN DE ASCENSO">ORDEN DE ASCENSO</option>
                                        <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                                    </select>  
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.documento.required">Seleccione un valor</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-12 form-control-label" for="">Num. de Documento</label>
                                    <input type="text" class="form-control" v-model="nrodoc" placeholder="00/00" :class="{ 'is-invalid' : $v.nrodoc.$error, 'is-valid':!$v.nrodoc.$invalid }">  
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.nrodoc.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-12 form-control-label" for="">Fecha de Documento</label>
                                    <date-picker style="width: 100%; max-width:100;" value-type="date" format="DD/MM/YYYY"
                                        v-model="fecha_documento" :disabled-date="fechaactual"
                                        :class="{ 'is-invalid' : $v.fecha_documento.$error, 'is-valid':!$v.fecha_documento.$invalid }">
                                    </date-picker>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.fecha_documento.required">Debe introducir una fecha</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-md-3 form-control-label" for="">Observaciones</label>
                                    <input type="text" v-model="observacion" class="form-control" placeholder="Observación" maxlength="500"  style="text-transform:uppercase;">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-primary" @click="registrarEstudioPersonal()">Registrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="cerrar()">Cerrar</button>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

            <!--Inicio del modal editar-->
            <div class="modal fade" id="ModalEditar">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR COMPLEMENTO PERSONAL</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <label for="carnetIdentidad">Complemento:</label>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" disabled v-model="complementoA">
                                </div> 
                                <div class="col-md-8">
                                    <v-select
                                        label="nombre"
                                        :options="Aestudios"
                                        v-model="estudiosA"
                                        @input="mostrarComA"
                                        :class="{ 'is-invalid' : $v.estudiosA.$error, 'is-valid':!$v.estudiosA.$invalid }"
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
                                        <span v-if="!$v.estudiosA.required">Seleccione un valor porfavor</span>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="col-md-12 form-control-label" for="text-input">Tipo de Documento</label>
                                    <select class="form-control" v-model="documentoA" :class="{ 'is-invalid' : $v.documentoA.$error, 'is-valid':!$v.documentoA.$invalid }">
                                        <option value="0" disabled>Seleccione</option>
                                        <option value="MEMORANDUM">MEMORANDUM</option>
                                        <option value="NINGUNO">NINGUNO</option>
                                        <option value="NOTA DE SERVICIO">NOTA DE SERVICIO</option>
                                        <option value="OFICIO">OFICIO</option>
                                        <option value="ORDEN DE ASCENSO">ORDEN DE ASCENSO</option>
                                        <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                                    </select>  
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.documento.required">Seleccione un valor</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-12 form-control-label" for="">Num. de Documento</label>
                                    <input type="text" class="form-control" v-model="nrodocA" placeholder="00/00" :class="{ 'is-invalid' : $v.nrodocA.$error, 'is-valid':!$v.nrodocA.$invalid }">  
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.nrodoc.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-md-12 form-control-label" for="">Fecha de Documento</label>
                                    <!-- <date-picker style="width: 100%; max-width:100;" value-type="date" format="DD/MM/YYYY"
                                        v-model="fecha_documento" :disabled-date="fechaactual"
                                        :class="{ 'is-invalid' : $v.fecha_documento.$error, 'is-valid':!$v.fecha_documento.$invalid }">
                                    </date-picker> -->
                                    <input type="date" v-model="fecha_documentoA" class="form-control" :class="{ 'is-invalid' : $v.fecha_documentoA.$error, 'is-valid':!$v.fecha_documentoA.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.fecha_documento.required">Debe introducir una fecha</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-md-3 form-control-label" for="">Observaciones</label>
                                    <input type="text" v-model="observacionA" class="form-control" placeholder="Observación" maxlength="500"  style="text-transform:uppercase;">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-primary" @click="actualizarEstudioPersonal()">Actualizar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="cerrar()">Cerrar</button>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
import moment from 'moment';
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";

export default {
    data() {
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.e,   /// PUES ACA LLAMAS ELMPARAMETRO d
            
            // DESDE ACA LA TABLE
            // DESDE ACA LA TABLE
            abreviatura : '',
            nrodoc : '',
            documento : 0,
            fecha_documento :'',
            observacion : '',
            est_cod : 0,
            arrayEstudios :[],
            complemento: '',  
            //estudios
            estudios:[],
            //Estudios
            Aestudios:[],


            abreviaturaA : '',
            nrodocA : '',
            documentoA : 0,
            fecha_documentoA :'',
            observacionA : '',
            est_codA : 0,
            arrayEstudiosA :[],
            complementoA: '',  
            //estudios
            estudiosA:[],


            subescalafon_id : 0,
            grado_id : 0,
            
            
            fecha : '',
            
            cm : '',
            sy_suser : '',
            nro_doc : '',
            //edit
            escalafonPersonal_id_edit : 0,
            escalafon_id_edit : 0,
            subescalafon_id_edit : 0,
            grado_id_edit : 0,
            documento_edit :'',
            fecha_doc_edit :'',
            fecha_edit : '',
            observaciones_edit : '',
            cm_edit : '',
            sy_suser_edit : '',
            nro_doc_edit : '',
            // HASTA ACA LA TABLE
            rowId : 0,
            arrayDatosPersonal :[],    
            arrayEscalafon :[],
            arrayListaEstudio : [],
            arraySubescalafon :[],
            arrayGrado :[],
            datos: [],
            modal:0,
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
            criterio : 'per_nombre',
            buscar : ''

        }
    },
    validations:{
        estudios : { required },
        documento : { required },
        nrodoc : { required },
        fecha_documento : { required },

        estudiosA : { required },
        documentoA : { required },
        nrodocA : { required },
        fecha_documentoA : { required },

        validationGroupReg: ['estudios', 'documento', 'nrodoc', 'fecha_documento'],
        validationGroupEdit: ['estudiosA', 'documentoA', 'nrodocA', 'fecha_documentoA'],
    },





    mounted() {
        this.listarEstudioPersonal(this.per_codigo);
        this.datosPersonal(this.per_codigo);
        this.listarDatosPersonalSituacion();
        //this.Estudios();
    },
    computed:{
        mostrarCom(){
            try {
                this.complemento = this.estudios.abreviatura
            } catch (error) {
                this.complemento = ''
            }
            
        },
        imagen(){
            return this.formData.foto;
        }
    },
    methods: {
        ver(){
            //console.log(this.per_codigo);
            //console.log(this.personal_destinos)
        },
        since: function (d){
            return moment(d).format('DD-MM-YYYY');
        },

        fechaactual(date){
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return  date > new Date(today.getTime());
        },

        listarEstudioPersonal(per_codigo){
            let me = this;
            axios.post("/listarEstudioPersonal", {
            per_codigo : per_codigo,
            }).then(function (response) {
            
            me.arrayListaEstudio = response.data
            }).catch(function (error) {
            // handle error
                console.log(error);
            })
        }, 

        Estudios(){
            let me = this;
            axios
            .get('/estudiosCombo')
            .then(function (response) {
                
                me.Aestudios = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            });

        },

        datosPersonal(per_codigo){
           // alert(per_codigo);
            let me = this;
            axios.post("/datosPersonal", {
            per_codigo : per_codigo,
          }).then(function (response) {
            
            me.arrayDatosPersonal = response.data.personal_datos;
          })
          .catch(function (error) {
            // handle error
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

        cerrar(){
            this.$v.$reset()
        },
        
        abrirModalRegistro(){
            this.$v.$reset(),
            this.estudios = '',
            this.documento = '',
            this.nrodoc = '',
            this.fecha_documento = '',
            this.observacion = '',
            this.Estudios();
            $('#ModalRegistro').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
        },

        abrirModalEditar(s){
            let me = this;
            this.$v.$reset(),
            me.id2 = s;
            axios.post("/listarPerEstudioModificar", {
                per_estu : s
            })
            .then(function (response) {
                //console.log(response.data);

                me.est_id_editA = response.data.id2;
                me.est_codA = response.data.est_cod;
                me.estudiosA = response.data.descripcion;
                me.complementoA = response.data.abreviatura;
                me.nrodocA = response.data.nrodoc;
                me.fecha_documentoA = response.data.fecha_documento;
                me.documentoA = response.data.documento; 
                me.observacionA = response.data.observacion;
                me.Estudios();
                $('#ModalEditar').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })            
        },

        mostrarComA(){
            try {
                this.complementoA = this.estudiosA.abreviatura
            } catch (error) {
                this.complementoA = ''
            }
        },
        
        registrarEstudioPersonal(){
            this.$v.$reset();
            if(!this.$v.validationGroupReg.$invalid){
            swal.fire({
                title: '¿Desea registrar el nuevo complemento?', // TITULO 
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
                    .post('/estudioPersonal/registrar',{
                        'per_codigo': this.arrayDatosPersonal.per_codigo,
                        'est_cod': me.estudios.id,
                        'nrodoc':this.nrodoc,
                        'documento':this.documento,
                        'fecha_documento':this.fecha_documento,
                        'observacion':this.observacion.toUpperCase()
                    })
                    .then(function (response) {
                        // 
                        $('#ModalRegistro').modal('hide');
                        me.datosPersonal(me.per_codigo);
                        me.listarEstudioPersonal(me.per_codigo);
                        swal.fire(
                            "Aceptado", //TITULO
                            "Se añadio correctamente el complemento.", //TEXTO DE MENSAJE
                            "success" // TIPO DE MODAL (success, warnning, error, info)
                        );
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                }else{
                    swal.fire(
                        "Anulado", //TITULO
                        "No se realizo el registro del complemento.", //TEXTO DE MENSAJE
                        "info" // TIPO DE MODAL (success, warnning, error, info)
                    );
                }
            })
            }
            else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        },

        actualizarEstudioPersonal(){
            this.$v.$reset();
            if(!this.$v.validationGroupEdit.$invalid){
                swal.fire({
                    title: '¿Desea modificar el Complemento?', // TITULO 
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
                        if (me.estudiosA.id) {
                            var est_codA = me.estudiosA.id;
                        } else {
                            var est_codA =  me.est_codA;
                        }
                        if(me.observacionA!==null){
                            me.observacionA=me.observacionA.toUpperCase();
                        }
                        axios
                        .put('/estudioPersonal/actualizar',{
                            per_codigo : me.per_codigo,
                            est_id_editA : me.id2,
                            est_cod : est_codA,
                            estudios : me.descripcionA,
                            complemento : me.abreviaturaA,
                            nrodoc : me.nrodocA,
                            fecha_documento : me.fecha_documentoA,
                            documento : me.documentoA, 
                            observacion : me.observacionA

                        })
                        .then(function (response) {
                            $('#ModalEditar').modal('hide')
                            swal.fire(
                                "Aceptado", //TITULO
                                "Se modificó correctamente el complemento.", //TEXTO DE MENSAJE
                                "success" // TIPO DE MODAL (success, warnning, error, info)
                            )
                            me.listarEstudioPersonal(me.per_codigo);
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                            }else{
                                swal.fire(
                                "Anulado", //TITULO
                                "No se realizo la actualización del complento.", //TEXTO DE MENSAJE
                                "info" // TIPO DE MODAL (success, warnning, error, info)
                                );
                            }
                    })
            }else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
                
            }
        },

        desactivarEstudioPersonal(listarEstudioPer){
            //if(!this.$v.$invalid){
                swal.fire({
                    title: 'Esta seguro de eliminar este complemento', // TITULO 
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
                        //CODIGO HA SER VALIDADO
                        let me =this;
                        this.id = listarEstudioPer.id2,
                        axios
                        .put('/desactivarEstudioPersonal', {
                    //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                        id : me.id,
                        per_codigo : me.per_codigo,
                    })
                    .then(function (response) {
                        //Respuesta de la peticion
                        
                        me.listarEstudioPersonal(me.per_codigo);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        });
                    }else{
                        console.log('no empezamos');
                    }
                })  
        },


        EliminarEstudio(idpr){
            Swal.fire({
                title: '¿Está seguro de eliminar este complemento?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
            }).then((result) => {
                if (result.value) {
                    let me =this;
                    this.fullscreenLoading = true;
                    var url ='/estudioPersonal/eliminarEstudio'
                    axios.post(url, {
                        'idpr'   :   idpr,
                        per_codigo : me.per_codigo
                    }).then(response => {
                        Swal.fire({
                            icon    :   'success',
                            title   :   'Se eliminó el complemento correctamente',
                            showConfirmButton   : false,
                            timer   :   1500
                        })
                        this.listarEstudioPersonal(this.per_codigo);
                    })
                }
            })
        },

        generarReporte($per_codigo){
            window.open('http://sipefab.fab.bo/reporte/generareportcomplepersonal?JWRD4EHWUJS38R4='+ $per_codigo, '_blank');
        }


    },
}
</script>

<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>