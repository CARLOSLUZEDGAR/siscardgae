<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <i class="nav-icon fas fa-arrow-alt-circle-up"></i>
              Ascenso Personal
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ascenso Personal</li>
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

                                    <img v-bind:src="'../img/personal/'+arrayDatosPersonal.per_foto" class="rounded float-left img-fluid" width="150" height="150">
                                </div>

                                <div class="col-md-10 d-flex align-items-center">
                                    <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                        <!-- FILA 1 -->
                                        <div class="row p-2 bd-highlight">
                                            <div class="col-md-6">
                                                <dl>
                                                    <dt class="st">GRADOS Y NOMBRES</dt>
                                                    <dd class="st">{{ arrayDatosPersonal.gra_abreviatura }} {{ arrayDatosPersonal.estu_abreviatura }} {{ arrayDatosPersonal.per_nombre }} {{ arrayDatosPersonal.per_paterno }} {{ arrayDatosPersonal.per_materno }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-4">
                                                <dl>
                                                    <dt class="st">CARNET MILITAR</dt>
                                                    <dd class="st">{{ arrayDatosPersonal.per_cm }}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <!-- FILA 2 -->
                                        <div class="row p-2 bd-highlight">
                                            <div class="col-md-6">
                                                <dl>
                                                    <dt class="st">CARNET DE IDENTIDAD</dt>
                                                    <dd class="st">{{ arrayDatosPersonal.per_ci }} {{ arrayDatosPersonal.per_expedido }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dl>
                                                    <dt class="st">ESCALAFON-SUBESCALAFON-GRADO ACTUAL</dt>
                                                    <dd class="st">{{ arrayDatosPersonal.esca_nombre }} - {{arrayDatosPersonal.subesca_nombre}} - {{arrayDatosPersonal.gra_nombre}}</dd>
                                                </dl>
                                            </div>

                                        </div>
                                        <!-- FILA 3 -->
                                        <div class="row p-2 bd-highlight justify-content-center">
                                            <div class="col-md-4">
                                                <button v-if="$auth.can('insert-peresc')" type="button" class="btn btn-primary btn-sm btn-block" @click="abrirModalRegistro(arrayDatosPersonal.gra_cod)">
                                                    <i class="fas fa-plus"> Nuevo</i>
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <button v-if="$auth.can('report-peresc')" type="button" class="btn btn-secondary btn-sm btn-block" @click="generarReporte(per_codigo)">
                                                    <i class="far fa-file-alt" aria-hidden="true"> Reporte</i>
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                    <router-link class="btn btn-danger btn-sm btn-block" :to="'/listarPersonalAscenso'">
                                                    <i class="fas fa-reply"></i>&nbsp; Volver Atras
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
                        <div class="card-body">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                                <template v-if="arrayListaAscenso.length">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:50px; text-align:center">Opciones</th>
                                                <th style="width:100px; text-align:center">Fecha</th>
                                                <th style="width:100px; text-align:center">Grado</th>
                                                <th style="width:100px; text-align:center">Nro. Doc.</th>
                                                <th style="width:100px; text-align:center">Documento</th>
                                                <th style="width:100px; text-align:center">Ant. Final</th>
                                                <th style="width:100px; text-align:center">Instancia</th>
                                                <th style="width:100px; text-align:center">Estado</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="listaasc in arrayListaAscenso" :key="listaasc.id">
                                                <td style="width:50px; text-align:center">
                                                    <button v-if="$auth.can('edit-perasc')" type="button" @click="abrirModalEditar(listaasc.id)" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </button> &nbsp;
                                                </td>
                                                <td style="width:100px; text-align:center">{{listaasc.fechasc | moment("D/MM/YYYY")}}</td>
                                                <td style="width:100px; text-align:center" v-text="listaasc.abreviatura"></td>
                                                <td style="width:100px; text-align:center" v-text="listaasc.nrodocumento"></td>
                                                <td v-text="listaasc.documento"></td>
                                                <td style="width:100px; text-align:center" v-text="listaasc.antigfin"></td>
                                                <td style="width:100px; text-align:center" v-text="listaasc.instancia"></td>
                                                <td style="width:50px; text-align:center">
                                                        <div v-if="listaasc.estado">
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
                                        <h5><i class="fas fa-exclamation-triangle x-lg-2"></i> No se encontraron resultados de ascenso...</h5>
                                    </div>
                                </template>
                            </div>
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
        <div class="modal fade" id="ModalRegistro" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">ASCENSO DE: {{arrayDatosPersonal.gra_abreviatura}} {{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                            <div class="form-group row">
                                <label class="col-md-6 form-control-label" for="text-input">Ascenso del Grado: {{ arrayGradoDesde.nombre }} </label>
                                <label class="col-md-6 form-control-label" for="text-input">Ascenso al Grado: {{ arrayGradoActual.nombre }} </label><br><br>

                                <label class="col-md-2 form-control-label" for="text-input">Num. de Ascenso:</label>
                                <div class="col-md-4">
                                    <v-select
                                        label="descripcion"
                                        :options="arrayAscenso"
                                        v-model="codasc"
                                        @input="datosDocumento"
                                    >
                                        <template v-slot:no-options="{ search, searching }">
                                            <template v-if="searching">
                                                Lo sentimos, no hay opciones de coincidencia.<em>{{
                                                search
                                                }}</em
                                                >.
                                            </template>
                                            <em v-else
                                                >Lo sentimos, no hay opciones de coincidencia.</em
                                            >
                                        </template>
                                    </v-select>

                                </div>

                                <label class="col-md-2 form-control-label" for="text-input">Instancia:</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="instancia" @change="onChangeSelect($event)" :class="{ 'is-invalid' : $v.instancia.$error, 'is-valid':!$v.instancia.$invalid }">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="instancia in arrayInstancia" :key="instancia.id" :value="instancia.id" v-text="instancia.instancia">

                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.instancia.required">Seleccione un Opcion</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="">Antiguedad:</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="antiguedad" class="form-control" placeholder="Ingrese Antiguedad" :class="{ 'is-invalid' : $v.antiguedad.$error, 'is-valid':!$v.antiguedad.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.antiguedad.required">Este campo es Requerido</span>
                                    </div>
                                </div>

                                <label class="col-md-2 form-control-label" for="">total Ascendidos:</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="total_promo" class="form-control" placeholder="Ingrese Total Promoción" :class="{ 'is-invalid' : $v.total_promo.$error, 'is-valid':!$v.total_promo.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.total_promo.required">Este campo es Requerido</span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="">Promocion:</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="promoact" :disabled="inputDisabled" class="form-control" placeholder="Promocion Actual" :class="{ 'is-invalid' : $v.promoact.$error, 'is-valid':!$v.promoact.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.promoact.required">Este campo es Requerido</span>
                                    </div>
                                </div>

                                <label class="col-md-2 form-control-label" for="">Codigo de Promocion:</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="codpromo" :disabled="inputDisabled" class="form-control" placeholder="Codigo de promocion 31208" :class="{ 'is-invalid' : $v.codpromo.$error, 'is-valid':!$v.codpromo.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.codpromo.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="">Observaciones:</label>
                                <div class="col-md-10">
                                    <textarea type="text" v-model="observacion" class="form-control" placeholder="Observaciones" style="text-transform:uppercase"></textarea>
                                </div>
                            </div>

                            <div v-show="errorAscensoPersonal" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjAscensoPersonal" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="registrarAscensoPersonal()">Guardar</button>
                        <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
        <!--Inicio del modal editar-->
        <div class="modal fade" id="ModalEditar" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                       <h4 class="modal-title">EDITAR ASCENSO DE: {{arrayDatosPersonal.gra_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Num. de Ascenso:</label>
                                <div class="col-md-4">
                                    <v-select
                                        label="descripcion"
                                        :options="arrayAscenso"
                                        v-model="codasc_edit"
                                        @input="datosDocumento2"
                                    >
                                        <template v-slot:no-options="{ search, searching }">
                                            <template v-if="searching">
                                                Lo sentimos, no hay opciones de coincidencia.<em>{{
                                                search
                                                }}</em
                                                >.
                                            </template>
                                            <em v-else
                                                >Lo sentimos, no hay opciones de coincidencia.</em
                                            >
                                        </template>
                                    </v-select>
                                </div>

                                <label class="col-md-2 form-control-label" for="text-input">Instancia:</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="instancia_edit"  @change="onChangeSelect($event)">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="instancia in arrayInstancia" :key="instancia.id" :value="instancia.id" v-text="instancia.instancia"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="">Codigo de Promocion:</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="codpromo_edit" :disabled="inputDisabled" class="form-control" placeholder="Codigo de promocion 31208" :class="{ 'is-invalid' : $v.codpromo.$error, 'is-valid':!$v.codpromo.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.codpromo.required">Este campo es Requerido</span>
                                    </div>
                                </div>

                                <label class="col-md-2 form-control-label" for="">Promocion Actual:</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="promoact_edit" :disabled="inputDisabled" class="form-control" placeholder="Promocion Actual">
                                </div>

                            </div>

                            <div class="form-group row">

                                <label class="col-md-2 form-control-label" for="">Antiguedad:</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="antiguedad_edit" class="form-control" placeholder="Ingrese Antiguedad">
                                </div>


                                <label class="col-md-2 form-control-label" for="">Antiguedad Final:</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="antigfin_edit" class="form-control" placeholder="Antiguedad Final">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Tipo de Documento:</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" disabled v-model="documento_edit">
                                </div>

                                <label class="col-md-2 form-control-label" for="">Num. de Documento:</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" disabled v-model="nro_doc_edit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="">Observaciones:</label>
                                <div class="col-md-10">
                                    <textarea type="text" v-model="observaciones_edit" class="form-control" placeholder="Observaciones" style="text-transform:uppercase"></textarea>
                                </div>
                            </div>



                            <div v-show="errorAscensoPersonal" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjAscensoPersonal" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="actualizarAscensoPersonal()">Actualizar</button>
                        <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
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
import { required, minLength, maxLength, alpha, numeric, email} from "vuelidate/lib/validators";

export default {
    data() {
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.a,   /// PUES ACA LLAMAS ELMPARAMETRO d
            // desde aca
            personal_seleccionado: {},
            subescalafon_id: null,
            codasc : '',
            promoact: '',
            codpromo : '',
            antiguedad: '',
            instancia:0,
            fechasc:'',
            observacion:'',
            flag:'',
            sysuser:'',
            gracod:'',
            antigfin:'',
            total_promo : '',
            // edit
            id_ascensoPersonal : 0,
            codasc_edit : '',
            promoact_edit : '',
            codpromo_edit : '',
            fechasc_edit : '',
            instancia_edit : 0,
            antiguedad_edit : '',
            antigfin_edit : '',
            documento_edit : '',
            nro_doc_edit : '',
            observaciones_edit : '',

            // tabla escalafon_persob al_promocions
            escalafon_id : 0,
            subescalafon_id : 0,
            grado_id : 0,
            documento :'',
            fecha_doc :'',
            fecha : '',
            observacion : '',
            cm : '',
            sy_suser : '',
            nro_doc : '',
            rowId : 0,
            arrayEscalafon :[],
            arrayListaEscalafon : [],
            arraySubescalafon :[],
            arrayGrado :[],
            //
            arrayDatosPersonal :[],
            arrayDatosPersona:[],
            arrayListaAscenso:[],
            arrayGradoActual : [],
            arrayGradoDesde : [],
            arrayGrado:[],
            arrayAscenso:[],
            arrayInstancia:[],
            modal:0,
            tituloModal:'',
            tipoAccion:0,
            errorPersonal:0,
            errorMostrarMsjAscensoPersonal:[],
            errorAscensoPersonal :0,
            errorAscenso:0,
            errorMostrarMsjAscenso:[],
            pagination: {
                    'total'         :   0,
                    'current_page'  :   0,
                    'per_page'      :   0,
                    'last_page'     :   0,
                    'from'          :   0,
                    'to'            :   0,
                },
            offset : 3,
            criterio: 'per_ci',
            buscar: '',
            gradoid: 0,
            numero_doc: 0,
            descripcion_doc:'',
            // para instancia
            idinstancia: 0,
            nombre:'',
            numero:'',
            /**
             * reucperacion datos documento
             */
            datDoc: [],
            inputDisabled: true,

        }
    },
    validations:{/*
        nombre_den :{   required,
                        minLength: minLength(3),
                        maxLength: maxLength(14),
                        alpha
                    },
        ap_paterno_den :{   required,
                        minLength: minLength(3),
                        maxLength: maxLength(14),
                        alpha
                    },
        c_identidad_den :{   required,
                        minLength: minLength(5),
                        maxLength: maxLength(9),
                        numeric
                    },
        extencion_den : { required },
        telefono_celular :{   required,
                        minLength: minLength(8),
                        maxLength: maxLength(8),
                        numeric
                    },

        estado_civil : { required },
        fecha_nacimiento : { required },
        id_lugar_trabajo : { required },*/

        codpromo : { required},
        promoact : { required },
        instancia : { required },
        antiguedad : { required },
        fechasc : { required },
        total_promo : { required },

    },
    mounted() {
        this.ListarAscensoPersona(this.per_codigo);
        this.datosPersonal(this.per_codigo);
    },
    methods: {
        ListarAscensoPersona(per_codigo){
            let me = this;
            axios.post("/listarAscenso", {
            per_codigo : per_codigo,
            })
            .then(function (response) {
           console.log(response);
            me.arrayListaAscenso = response.data
            })
            .catch(function (error) {
            // handle error
                console.log(error);
            })
        },
        onChangeSelect(e) {
            if (e.target.value == 6) {
                this.inputDisabled = true;
            };
            if (e.target.value != 6) {
                this.inputDisabled = false;
            };
        },
        datosPersonal(per_codigo){
           let me = this;
            axios
          .post("/datosPersonalAscenso", {
            per_codigo : per_codigo,
          })
          .then(function (response) {
          //  console.log(response)
            me.arrayDatosPersonal = response.data.personal_datos
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },
        datosDocumento(){
            let me = this;
            axios.post("/personaldocumento/dato", {
            id : me.codasc,
          }).then(function (response) {

            me.documento = response.data.documento;
            me.nro_doc= response.data.nrodocumento;
            me.fechasc= response.data.fechadocumento;

          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },
        datosDocumento2(){
            let me = this;
            axios.post("/personaldocumento/dato", {
            id : me.codasc_edit,
          }).then(function (response) {
            me.documento_edit = response.data.documento;
            me.nro_doc_edit = response.data.nrodocumento;
            me.fechasc_edit= response.data.fechadocumento;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },
        escalafonPersonalActual(per_codigo){
            let me =this;
            //me.buscarD= per_codigo;
            me.arrayEscalafonPerActual=[];
            axios.post("/escalafonPersonal/escalafonPerActual", {
            per_codigo : per_codigo,
            }).then(function (response) {

                me.arrayEscalafonPerActual = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        cerrarModal(){
            $('#ModalRegistro').modal('hide');
            $('#ModalRegistroGeneral').modal('hide');
            $('#ModalEditar').modal('hide');
            this.codasc = '';
            this.promoact = '';
            this.codpromo = '';
            this.antiguedad = '';
            this.instancia = '';
            this.fechasc = '';
            this.observaciones = '';
            this.antigfin = '';
            this.documento = '';
            this.nro_doc = '';
            this.total_promo = '';
            //edit
            this.codasc_edit = '';
            this.promoact_edit = '';
            this.antiguedad_edit = '';

            this.fechasc_edit = '';
            this.observaciones_edit = '';
            this.antigfin_edit = '';
        },
        selectAscenso(){
            let me=this;
            var url= '/escalafon/selecAscenso';
            axios.get(url).then(function (response) {
                //
                var respuesta= response.data;
                me.arrayAscenso = respuesta.ascensos;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        selectAscensoEdit(asc_cod){
             let me = this;
            //me.buscarD= per_codigo;
            me.arrayAscenso=[];
            axios.post("/escalafon/selecAscenso", {
            asc_cod : asc_cod,
            }).then(function (response) {

                me.arrayAscenso = response.ascensos;
            })
            .catch(function (error) {
                console.log(error);
            })
        },
        selectInstancia(){
            let me=this;
            var url= '/selectInstancia';
            axios.get(url).then(function (response) {
               //
                var respuesta= response.data;
                me.arrayInstancia = respuesta.instancias;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        selectGradoActual(per_codigo){
            let me =this;
            axios.post("/ascensoPersonal/selecGradoActual", {
            per_codigo : per_codigo,
            }).then(function (response) {
                var respuesta= response.data;
                me.arrayGradoActual = respuesta.gradoAscensoInmediatoSuperior;
                me.promoact = respuesta.promoActual.promocion;
                me.codpromo = respuesta.promoActual.codpromo;
                me.arrayGradoDesde = respuesta.gradoActualDesde;
                me.escalafon = respuesta.escalafon;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        selectEscalafon(){
            let me=this;
            var url= '/escalafon/selectEscalafon';
            axios.get(url).then(function (response) {

                var respuesta= response.data;
                me.arrayEscalafon = respuesta.escalafones;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        registrarAscensoPersonal(){
            if(!this.$v.$invalid){

                swal.fire({
                    title: 'Se registrar el Ascenso de la Persona', // TITULO
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
                    axios.post('/ascensoPersonal/registrar',{
                        'per_codigo': me.arrayDatosPersonal.per_codigo,
                        'asc_cod': me.codasc.id,
                        'codpromo': me.codpromo,
                        'promoact': me.promoact,
                        'antiguedad': me.antiguedad,
                        'instasc_cod': me.instancia,
                        'fechasc': me.fechasc,
                        'observacion': me.observacion.toUpperCase(),
                        'gra_cod': me.arrayGradoActual.id,
                        'antigfin': me.antigfin,
                        'total_promo': me.total_promo,
                        ///
                        'documento': me.documento,
                        'cm': me.arrayDatosPersonal.per_cm,
                        'nro_doc': me.nro_doc,
                        'subesc': me.arrayGradoActual.subesc_cod,
                        'escalafon': me.escalafon
                    }).then(function (response) {
                       // console.log(response);
                        if(response.data=="existe"){
                           return Swal.fire("Mensaje de Advertencia","La persona ya tiene registrado el grado maximo en su Subescalafon","warning");
                        } else {
                            Swal.fire("Mensaje de Confirmación","Datos Guardados Correctamente","success");
                            console.log(response);
                            me.cerrarModal();
                            me.datosPersonal(me.per_codigo);
                            me.ListarAscensoPersona(me.per_codigo);
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });

                    }
                })
            }else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: true,
                    timer: 2500
                })
            }
        },
        actualizarAscensoPersonal(){
            let me = this;
            if (me.codasc_edit.id) {
                var codasc_edit = me.codasc_edit.id;

            } else {
                var codasc_edit =  me.idcodas;
            }
            axios.put('/ascensoPersonal/actualizar',{
            'percod': me.arrayDatosPersonal.per_codigo,
            'asc_cod': codasc_edit,
            'promoact': me.promoact_edit,
            'codpromo': me.codpromo_edit,
            'antiguedad': me.antiguedad_edit,
            'instancia': me.instancia_edit,
            'fechasc': me.fechasc_edit,
            'observacion': me.observaciones_edit.toUpperCase(),
            'antigfin': me.antigfin_edit,
            'id': me.id_ascensoPersonal,
            }).then(function (response) {
                Swal.fire("Mensaje de Confirmacion","Datos Actualizados Correctamente","success");
                me.cerrarModal();
                me.datosPersonal(me.per_codigo);
                me.ListarAscensoPersona(me.per_codigo);
            }).catch(function (error) {
                console.log(error);
            });
        },
        abrirModalRegistro(gra_cod){

            var valor = gra_cod;
            if(valor == 1 || valor == 10 || valor == 18  || valor == 23 || valor == 29 || valor == 34 || valor == 39 || valor == 44 || valor == 164){
               return  Swal.fire("Mensaje de Advertencia","La persona ya tiene el grado máximo en el Subescalafon!!!","warning");
            } else{
                this.selectAscenso();
                this.selectInstancia();
                this.selectGradoActual(this.per_codigo);
                $('#ModalRegistro').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                // $(".modal-title").text("Registrar Ascenso Personal");
            }
        },

         abrirModalEditar(listaasc){

            let me = this;
            me.idrepre = listaasc;
            axios
            .post("/listarAscensosEdit", {
                id: listaasc
            })
            .then(function (response) {
                console.log(response);
                me.codasc_edit          = response.data[0].nrodocumento + ' - ' + response.data[0].documento+ ' - ' +response.data[0].fechadocumento;
                me.idcodas              = response.data[0].asc_cod;

                me.instancia_edit       = response.data[0].instancia;
                me.codpromo_edit        = response.data[0].codpromo;
                me.promoact_edit        = response.data[0].promoact;
                me.antiguedad_edit      = response.data[0].antiguedad;
                me.antigfin_edit        = response.data[0].antigfin;
                me.documento_edit       = response.data[0].documento;
                me.nro_doc_edit         = response.data[0].nrodocumento;
                me.observaciones_edit   = response.data[0].observacion;

                me.id_ascensoPersonal          = response.data[0].id;
               // alert(me.id_personal);
                me.selectAscenso();
                me.selectInstancia();
                $('#ModalEditar').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
            }).catch(function (error) {
                console.log(error);
            })

            },
        generarReporte(per_codigo){
           window.open('http://sipefab.fab.bo/listarAscensoReporte?per_codigo='+per_codigo);
        },


    },
}
</script>

<style>

</style>
