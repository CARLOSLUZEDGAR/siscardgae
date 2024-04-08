<template>
    <div>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">            
                    <h1>
                        <i class="far fa-bookmark"></i>
                        Personal Curriculum
                    </h1>&nbsp;
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Personal Curriculum</li>
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
                                            <img v-bind:src="'../../img/personal/'+arrayDatosPersonal.per_foto" class="rounded float-left img-fluid" width="150" height="150">
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
                                                            <dt class="st">ESPECIALIDAD ACTUAL</dt>
                                                            <dd class="st">{{arrayDatosPersonal.nomespe}} - {{arrayDatosPersonal.nomsubespe}}</dd>
                                                        </dl>
                                                    </div>

                                                </div>
                                                <!-- FILA 3 -->
                                                <div class="row p-2 bd-highlight justify-content-center">
                                                    <div class="col-md-3">
                                                        <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="DatosCurrComanjefe()" style="width: 100%;">
                                                            <i class="far fa-file-alt" aria-hidden="true">  Curriculum COMANJEFE</i>
                                                        </button> &nbsp;
                                                    </div>
                                                    <div class="col-md-3"> 
                                                        <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="CurrExtendido(per_codigo)" style="width: 100%;">
                                                            <i class="far fa-file-alt" aria-hidden="true">  Curriculum Extendido</i>
                                                        </button> &nbsp;
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="CurrResumen(per_codigo)" style="width: 100%;">
                                                            <i class="far fa-file-alt" aria-hidden="true">  Curriculum Resumen</i>
                                                        </button> &nbsp;
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="DatosCertTrabajo()" style="width: 100%;">
                                                            <i class="far fa-file-alt" aria-hidden="true">  Certificado de Trabajo</i>
                                                        </button> &nbsp;
                                                    </div>
                                                </div>

                                                <!-- FILA 3 -->
                                                <div class="row p-2 bd-highlight justify-content-center">
                                                    <div class="col-md-3">
                                                        <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="DatosCurrVitae()" style="width: 100%;">
                                                            <i class="far fa-file-alt" aria-hidden="true">  Curriculum Vitae</i>
                                                        </button> &nbsp;
                                                    </div>
                                                    <div class="col-md-3"> 
                                                        <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="DatosHojaVida()" style="width: 100%;">
                                                            <i class="far fa-file-alt" aria-hidden="true">  Hoja de Vida</i>
                                                        </button> &nbsp;
                                                    </div>
                                                    <!-- <div class="col-md-3"> 
                                                        <button  type="button" class="btn btn-secondary btn-sm btn-block" @click="TiempoServicio(per_codigo)" style="width: 100%;">
                                                            <i class="far fa-file-alt" aria-hidden="true">  Años de Servicio</i>
                                                        </button> &nbsp;
                                                    </div> -->
                                                    
                                                </div>

                                                <!-- FILA 5 -->
                                                <div class="row p-2 bd-highlight justify-content-center">
                                                    <div class="col-md-4">  
                                                        <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras()">
                                                            <i class="fas fa-reply" aria-hidden="true"> Volver Atrás</i>
                                                        </button> &nbsp;
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
            </div>

        <!--MODAL CURRICULUM COMANJEFE
        id="NombreModal" -->
        <div class="modal fade" id="DatosCurriculunComanjefe">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title-datos"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">Calificación Fojas de Concepto</label>
                        <!-- <input type="text" v-model="nro_doc" class="form-control"> -->
                        <input type="number" v-model="nota_fojas" class="form-control" maxLength="5" min="0" step=".01" max="100" :class="{ 'is-invalid' : $v.nota_fojas.$error, 'is-valid':!$v.nota_fojas.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.nota_fojas.required">Este campo es Requerido</span>
                            <span v-if="!$v.nota_fojas.between">Debe contener una nota entre 0 a 100.</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">Rubrica</label>
                        <!-- <input type="text" v-model="nro_doc" class="form-control"> -->
                        <input type="text" v-model="rubrica" class="form-control" :class="{ 'is-invalid' : $v.rubrica.$error, 'is-valid':!$v.rubrica.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.rubrica.required">Este campo es Requerido</span>
                        </div>
                    </div>
                </div>
                <template v-if="subescalafon == 1 || subescalafon == 2 || subescalafon == 3 || subescalafon == 4 || subescalafon == 5 || subescalafon == 6 || subescalafon == 21">
                <div class="form-group row">
                    <div class="col-md-12">
                        <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                            <thead class="table-striped">
                                <tr>
                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; text-align: center; font-weight: bold;">
                                        CURSOS ACADEMICOS MILITARES
                                    </td>
                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; text-align: center; font-weight: bold;">
                                        PROMEDIO
                                    </td>
                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; text-align: center; font-weight: bold;">
                                        ORDEN DE MERITO
                                    </td>
                                </tr>  
                            </thead>
                            <tbody class="table-striped">
                                <tr>
                                <template v-if="subescalafon == 1 || subescalafon == 2 || subescalafon == 3">
                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 0.3cm">CURSO DE ESCUADRON AÉREO</td>
                                </template>

                                <template v-else>
                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 0.3cm; ">CURSO DE PERFECCIONAMIENTO</td>
                                </template>

                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px;">
                                        <input type="number" v-model="promedioact" class="form-control" maxLength="5" min="0" step=".01" max="100" :class="{ 'is-invalid' : $v.promedioact.$error, 'is-valid':!$v.promedioact.$invalid }">
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.promedioact.required">Este campo es Requerido</span>
                                            <span v-if="!$v.promedioact.between">Debe contener una nota entre 0 a 100.</span>
                                        </div>
                                    </td>
                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px;">
                                        <input type="number" v-model="meritoact" class="form-control" :class="{ 'is-invalid' : $v.meritoact.$error, 'is-valid':!$v.meritoact.$invalid }">
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.meritoact.required">Este campo es Requerido</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <template v-if="subescalafon == 1 || subescalafon == 2 || subescalafon == 3">
                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 0.3cm">DIPLOMADO EN COMANDO Y ESTADO MAYOR AÉREO</td>
                                </template>

                                <template v-else>
                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 0.3cm">DIPLOMADO EN SUPERVISIÓN</td>
                                </template>

                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px;">
                                        <input type="number" v-model="promediodip" class="form-control" maxLength="5" min="0" step=".01" max="100" :class="{ 'is-invalid' : $v.promediodip.$error, 'is-valid':!$v.promediodip.$invalid }">
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.promediodip.required">Este campo es Requerido</span>
                                            <span v-if="!$v.promediodip.between">Debe contener una nota entre 0 a 100.</span>
                                        </div>
                                    </td>
                                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px;" >
                                        <input type="number" v-model="meritodip" class="form-control" :class="{ 'is-invalid' : $v.meritodip.$error, 'is-valid':!$v.meritodip.$invalid }">
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.meritodip.required">Este campo es Requerido</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </template>

                <template v-else>
                    
                </template>
                
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label" for="text-input">Observación</label>
                        <!-- <input type="text" v-model="motivo" class="form-control"> -->
                        <input type="text" v-model="observacion" class="form-control" style="text-transform:uppercase">
                        <!-- <div class="invalid-feedback">
                            <span v-if="!$v.observacion.required">Este campo es Requerido</span>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="CurrComanjefe(per_codigo,nota_fojas,rubrica,promedioact,meritoact,promediodip,meritodip,observacion)"><i class="far fa-file-alt" aria-hidden="true"> Generar Reporte</i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

            <!--MODAL CERIFICADO DE TRABAJO
        id="NombreModal" -->
        <div class="modal fade" id="DatosCertificadoTrabajo">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title-datos"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">Nro. Documento</label>
                        <!-- <input type="text" v-model="nro_doc" class="form-control"> -->
                        <input type="number" v-model="nro_doc" class="form-control" :class="{ 'is-invalid' : $v.nro_doc.$error, 'is-valid':!$v.nro_doc.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.nro_doc.required">Este campo es Requerido</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">Rubrica</label>
                        <!-- <input type="text" v-model="nro_doc" class="form-control"> -->
                        <input type="text" v-model="rubrica" class="form-control" :class="{ 'is-invalid' : $v.rubrica.$error, 'is-valid':!$v.rubrica.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.rubrica.required">Este campo es Requerido</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label" for="text-input">Motivo</label>
                        <!-- <input type="text" v-model="motivo" class="form-control"> -->
                        <input type="text" v-model="motivo" class="form-control" style="text-transform:uppercase" :class="{ 'is-invalid' : $v.motivo.$error, 'is-valid':!$v.motivo.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.motivo.required">Este campo es Requerido</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="CertTrabajo(per_codigo,nro_doc,motivo,rubrica)"><i class="far fa-file-alt" aria-hidden="true"> Generar Reporte</i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!--MODAL CURRICULUM VITAE
        id="NombreModal" -->
        <div class="modal fade" id="DatosCurriculumVitae">
        <div class="modal-dialog modal-small">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title-datos"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label" for="text-input">Rubrica</label>
                        <!-- <input type="text" v-model="nro_doc" class="form-control"> -->
                        <input type="text" v-model="rubrica" class="form-control" :class="{ 'is-invalid' : $v.rubrica.$error, 'is-valid':!$v.rubrica.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.rubrica.required">Este campo es Requerido</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="CurrVitae(per_codigo,rubrica)"><i class="far fa-file-alt" aria-hidden="true"> Generar Reporte</i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!--MODAL HOJA DE VIDA
        id="NombreModal" -->
        <div class="modal fade" id="DatosHojaVida">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title-datos"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">Horas de Vuelo</label>
                        <!-- <input type="text" v-model="nro_doc" class="form-control"> -->
                        <input type="number" v-model="horavuelo" class="form-control" min="0" step=".01" :class="{ 'is-invalid' : $v.horavuelo.$error, 'is-valid':!$v.horavuelo.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.horavuelo.required">Este campo es Requerido</span>
                            <span v-if="!$v.horavuelo.minValue">Debe ser mayor o igual a 0</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">Rubrica</label>
                        <!-- <input type="text" v-model="nro_doc" class="form-control"> -->
                        <input type="text" v-model="rubrica" class="form-control" :class="{ 'is-invalid' : $v.rubrica.$error, 'is-valid':!$v.rubrica.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.rubrica.required">Este campo es Requerido</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label" for="text-input">Observación</label>
                        <!-- <input type="text" v-model="motivo" class="form-control"> -->
                        <input type="text" v-model="observacion" class="form-control" style="text-transform:uppercase">
                        <!-- <div class="invalid-feedback">
                            <span v-if="!$v.observacion.required">Este campo es Requerido</span>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="HojaVida(per_codigo,horavuelo,rubrica,observacion)"><i class="far fa-file-alt" aria-hidden="true"> Generar Reporte</i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



        <!-- /.container-fluid -->
        </section>
    <!-- /.content -->
    </div>
</template>

<script>
//import { required, minLength, between } from 'vuelidate/lib/validators'
import { required, minLength, maxLength, alpha, numeric, email, sameAs, between, minValue, maxValue} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo : this.$route.params.per_codigo,
            subescalafon : this.$route.params.subescalafon,
            nro_doc: '',
            motivo: '',
            rubrica: '',

            nota_fojas : 0,
            promedioact : 0,
            promediodip : 0,
            meritoact : 0,
            meritodip : 0,
            observacion : '',

            horavuelo : '',

            arrayDatosPersonal : [],
        }
    },

    validations:{
            nota_fojas : { required, between: between(0, 100) },
            promedioact : { required, between: between(0, 100) },
            meritoact : { required },
            promediodip : { required, between: between(0, 100) },
            meritodip : { required },

            nro_doc : { required },
            motivo : { required },
            rubrica : { required},

            horavuelo : { required, minValue: minValue(0)},
            
            validationGroupCurrComanjefe: ['nota_fojas', 'promedioact', 'meritoact', 'promediodip', 'meritodip', 'rubrica'],
            validationGroupCertTrabajo: ['nro_doc', 'motivo', 'rubrica'],
            validationGroupCertVitae: ['rubrica'],
            validationGroupHojaVida: ['horavuelo', 'rubrica']
    },

    mounted() {
        //this.ver();
        
        this.datosPersonal(this.per_codigo);
    },
    methods: {

        datosPersonal(per_codigo){
            let me = this;
            axios
          .post("/datosPersonal", {
            per_codigo : per_codigo,
          })
          .then(function (response) {
            console.log(response)
            me.arrayDatosPersonal = response.data.personal_datos
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        Cerrar(){
            this.$v.validationGroupCurrComanjefe.$reset(),
            this.$v.validationGroupCertTrabajo.$reset(),
            this.$v.validationGroupCertVitae.$reset(),
            this.$v.validationGroupHojaVida.$reset()
        },

        DatosCurrComanjefe(){
            this.$v.validationGroupCurrComanjefe.$reset(),
            //PONER DE CERO EL MODAL ANTES DE REGISTRAR
            // this.idPersonalDestino = 0,
            this.nota_fojas = 0,
            this.rubrica = '',
            this.promedioact = 0,
            this.meritoact = 0,
            this.promediodip = 0,
            this.meritodip = 0,
            this.observacion = '',
            $('#DatosCurriculunComanjefe').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-datos").text("Reporte Curriculum COMANJEFE");
        },

        DatosCertTrabajo(){
            this.$v.validationGroupCertTrabajo.$reset(),
            //PONER DE CERO EL MODAL ANTES DE REGISTRAR
            // this.idPersonalDestino = 0,
            this.nro_doc = '',
            this.motivo = '',
            this.rubrica = '',
            $('#DatosCertificadoTrabajo').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-datos").text("Reporte Certificado de Trabajo");
        },

        DatosCurrVitae(){
            this.$v.validationGroupCertVitae.$reset(),
            //PONER DE CERO EL MODAL ANTES DE REGISTRAR
            // this.idPersonalDestino = 0,
            this.rubrica = '',
            $('#DatosCurriculumVitae').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-datos").text("Reporte Curriculum Vitae");
        },

        DatosHojaVida(){
            this.$v.validationGroupHojaVida.$reset(),
            //PONER DE CERO EL MODAL ANTES DE REGISTRAR
            // this.idPersonalDestino = 0,
            this.horavuelo = '',
            this.rubrica = '',
            this.observacion = '',
            $('#DatosHojaVida').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-datos").text("Reporte Hoja de Vida");
        },

        CurrComanjefe(per_codigo,nota_fojas,rubrica,promedioact,meritoact,promediodip,meritodip,observacion){
            this.$v.validationGroupCurrComanjefe.$reset();
            if(!this.$v.validationGroupCurrComanjefe.$invalid){
                window.open('http://127.0.0.1:8000/curriculumComanjefe?per_codigo='+per_codigo+'&nota_fojas='+nota_fojas+'&rubrica='+rubrica+'&promedioact='+promedioact+'&meritoact='+meritoact+'&promediodip='+promediodip+'&meritodip='+meritodip+'&observacion='+observacion);
                // window.open('https://sipefab.fab.bo/curriculumComanjefe?per_codigo='+per_codigo+'&nota_fojas='+nota_fojas+'&rubrica='+rubrica+'&promedioact='+promedioact+'&meritoact='+meritoact+'&promediodip='+promediodip+'&meritodip='+meritodip+'&observacion='+observacion);
                $('#DatosCurriculunComanjefe').modal('hide');
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

        CurrExtendido(per_codigo){
            // window.open('http://127.0.0.1:8000/curriculumExtendido?per_codigo='+per_codigo);
            window.open('https://sipefab.fab.bo/curriculumExtendido?per_codigo='+per_codigo);
        },

        CurrResumen(per_codigo){
            // window.open('http://127.0.0.1:8000/curriculumResumen?per_codigo='+per_codigo);
            window.open('https://sipefab.fab.bo/curriculumResumen?per_codigo='+per_codigo);
        },

        CertTrabajo(per_codigo,nro_doc,motivo,rubrica){
            this.$v.validationGroupCertTrabajo.$reset();
            if(!this.$v.validationGroupCertTrabajo.$invalid){
                // window.open('http://127.0.0.1:8000/certificadoTrabajo?per_codigo='+per_codigo+'&nro_doc='+nro_doc+'&motivo='+motivo+'&rubrica='+rubrica);
                window.open('https://sipefab.fab.bo/certificadoTrabajo?per_codigo='+per_codigo+'&nro_doc='+nro_doc+'&motivo='+motivo+'&rubrica='+rubrica);
                 $('#DatosCertificadoTrabajo').modal('hide');
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

        CurrVitae(per_codigo,rubrica){
            this.$v.validationGroupCertVitae.$reset();
            if(!this.$v.validationGroupCertVitae.$invalid){
                // window.open('http://127.0.0.1:8000/curriculumVitae?per_codigo='+per_codigo+'&rubrica='+rubrica);
                window.open('https://sipefab.fab.bo/curriculumVitae?per_codigo='+per_codigo+'&rubrica='+rubrica);
                $('#DatosCurriculumVitae').modal('hide');
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

        HojaVida(per_codigo,horavuelo,rubrica,observacion){
            this.$v.validationGroupHojaVida.$reset();
            if(!this.$v.validationGroupHojaVida.$invalid){
                // window.open('http://127.0.0.1:8000/hojaVida?per_codigo='+per_codigo+'&horavuelo='+horavuelo+'&rubrica='+rubrica+'&observacion='+observacion);
                window.open('https://sipefab.fab.bo/hojaVida?per_codigo='+per_codigo+'&horavuelo='+horavuelo+'&rubrica='+rubrica+'&observacion='+observacion);
                $('#DatosHojaVida').modal('hide');
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

        TiempoServicio(per_codigo){
            // window.open('http://127.0.0.1:8000/tiempoServicio?per_codigo='+per_codigo);
            window.open('https://sipefab.fab.bo/tiempoServicio?per_codigo='+per_codigo);
        },

        Atras(){
            this.$router.push({
                name: "ListarPerCurriculum"
                //ENVIO DE DATOS
                // params:{
                //     d: datos
                // }
                
            });
        },

    },
}
</script>