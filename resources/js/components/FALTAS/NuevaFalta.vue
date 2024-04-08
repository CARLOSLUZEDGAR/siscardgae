<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i> &nbsp;
              REGISTRO NUEVA FALTA
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Nueva Falta</li>
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

                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fas fa-user-tie"></i> &nbsp;
                    {{ dataPer.grado }} {{ dataPer.complemento }} {{ dataPer.nombre }} {{ dataPer.paterno }} {{ dataPer.materno }}
                    </h3>
                </div>
                <div class="card-body">
                    <!-- SANCIONADO -->
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">DATOS SANCIONADO</legend>
                        <!-- LINEA 1 -->
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">ORGANISMO:</label>
                                <v-select
                                    label="descripcion"
                                    :options="Adestinos1"
                                    v-model.trim="dest1"
                                    @input="Destino2"
                                    :class="{ 'is-invalid' : $v.dest1.$error, 'is-valid':!$v.dest1.$invalid }"
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
                                    <span v-if="!$v.dest1.required">Este campo es Requerido</span>
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <label for="">GRAN UNIDAD:</label>
                                <v-select
                                    label="descripcion"
                                    :options="Adestinos2"
                                    v-model="dest2"
                                    @input="Destino3"
                                    :class="{ 'is-invalid' : $v.dest2.$error, 'is-valid':!$v.dest2.$invalid }"
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
                                    <span v-if="!$v.dest2.required">Este campo es Requerido</span>
                                </div>
                            </div>
                        </div>
                        <!-- LINEA 2 -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">REPARTICION:</label>
                                <v-select
                                    label="descripcion"
                                    :options="Adestinos3"
                                    v-model="dest3"
                                    @input="Destino4"
                                    :class="{ 'is-invalid' : $v.dest3.$error, 'is-valid':!$v.dest3.$invalid }"
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
                                    <span v-if="!$v.dest3.required">Este campo es Requerido</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">SUB-REPARTICION:</label>
                                <v-select
                                    label="descripcion"
                                    :options="Adestinos4"
                                    v-model="dest4"
                                    :class="{ 'is-invalid' : $v.dest4.$error, 'is-valid':!$v.dest4.$invalid }"
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
                                    <span v-if="!$v.dest4.required">Este campo es Requerido</span>
                                </div>
                            </div>
                        </div>
                        <!-- LINEA 3 -->
                        <div class="row p-2 bd-highlight justify-content-center">
                            <div class="col-md-4">
                                <label for="">GRADO</label>
                                <v-select
                                    label="descripcion"
                                    :options="Agrado"
                                    v-model="grado"
                                    :class="{ 'is-invalid' : $v.grado.$error, 'is-valid':!$v.grado.$invalid }"
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
                                    <span v-if="!$v.grado.required">Este campo es Requerido</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">ESTUDIOS:</label>
                                <v-select
                                    label="nombre"
                                    :options="Aestudios"
                                    v-model="complemento"
                                    @input="mostrarCom"
                                    :class="{ 'is-invalid' : $v.complemento.$error, 'is-valid':!$v.complemento.$invalid }"
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
                                    <span v-if="!$v.complemento.required">Este campo es Requerido</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="carnetIdentidad">COMPLEMENTO:</label>
                                <input type="text" class="form-control" disabled v-model="comAbre">
                            </div>
                        </div>
                    </fieldset>
                    <!-- SANCIONADOR -->
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">DATOS SANCIONADOR</legend>
                        <!-- LINEA 1 -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">NOMBRE:</label>
                                <v-select
                                    label="text"
                                    :options="Asancionador"
                                    v-model="sancionador"
                                    @input="DatosSAncionador"
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
                            <div class="col-md-2">
                                <label for="">GRADO:</label>
                                <v-select
                                    label="abreviatura"
                                    :options="GradosSan"
                                    :disabled="cantidadGrado"
                                    v-model="IdGraSan"
                                    :class="{ 'is-invalid' : $v.IdGraSan.$error, 'is-valid':!$v.IdGraSan.$invalid }"
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
                                    <span v-if="!$v.IdGraSan.required">Este campo es Requerido</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">COMPLEMENTO:</label>
                                <v-select
                                    label="nombre"
                                    :options="CompleSan"
                                    :disabled="cantidadComple"
                                    v-model="IdCompleSan"
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
                            </div>
                        </div>
                        <!-- LINMEA 2 -->
                        <div class="row p-2 bd-highlight justify-content-center">
                            <div class="col-md-6">
                                <label for="">UNIDAD:</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid' : $v.unidad.$error, 'is-valid':!$v.unidad.$invalid }" style="text-transform:uppercase;" v-model="unidad">
                                <div class="invalid-feedback">
                                    <span v-if="!$v.unidad.required">Este campo es Requerido</span>                                    
                                    <span v-if="!$v.unidad.maxLength">Este campo permite solo 255 caracteres.</span>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <label for="">CARGO:</label>
                                <input type="text" @keypress="onlyletters" style="text-transform:uppercase;" class="form-control" :class="{ 'is-invalid' : $v.cargo.$error, 'is-valid':!$v.cargo.$invalid }" v-model="cargo">
                                <div class="invalid-feedback">
                                    <span v-if="!$v.cargo.required">Este campo es Requerido</span>                                    
                                    <span v-if="!$v.cargo.maxLength">Este campo permite solo 255 caracteres.</span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!-- DATOS DOCUMENTO -->
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">DATOS DOCUMENTO</legend>
                        <!-- LINEA 1 -->
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
                            <div class="col-md-4">
                                <label for="">NUMERO DOCUMENTO</label>
                                <input type="number" :class="{ 'is-invalid' : $v.ndoc.$error, 'is-valid':!$v.ndoc.$invalid }" @keypress="onlyNumber" class="form-control" min="0" style="text-transform:uppercase;" v-model="ndoc">
                                <div class="invalid-feedback">
                                    <span v-if="!$v.ndoc.required">Este campo es Requerido</span>
                                    <span v-if="!$v.ndoc.maxLength">Este campo permite solo 10 caracteres.</span>
                                </div>
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-3">
                                <label for="">FECHA DE SANCION</label>
                                <date-picker class="dat" value-type="date" format="DD/MM/YYYY"
                                    v-model="fecha"
                                    :disabled-date="fechaactual"
                                    :class="{ 'is-invalid' : $v.fecha.$error, 'is-valid':!$v.fecha.$invalid }"
                                ></date-picker>
                                <div class="invalid-feedback">
                                    <span v-if="!$v.fecha.required">Este campo es Requerido</span>
                                </div>
                                <!-- <input type="date" class="form-control" name="" id="" v-model="fecha"> -->
                            </div>
                            <div class="col-md-3">
                                <label for="">DIAS DE SANCIÓN</label>
                                <input type="number" :class="{ 'is-invalid' : $v.dias.$error, 'is-valid':!$v.dias.$invalid }" @keypress="onlyNumber" class="form-control" min="0" v-model="dias">
                                <div class="invalid-feedback">
                                    <span v-if="!$v.dias.required">Este campo es Requerido</span>
                                </div>
                            </div>                     
                        </div>
                        <!-- LINEA 7 -->
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

                    </fieldset>

                    <!-- LINEA BOTONES -->
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="p-2">
                                <button class="btn btn-sm btn-danger btn-block" @click="Atras()">
                                    <i class="fas fa-undo-alt"></i> &nbsp;
                                    CANCELAR
                                </button>
                            </div>
                            <div class="ml-auto p-2">
                                <button class="btn btn-sm btn-success btn-block" @click="Guardar()">
                                    <i class="fas fa-check-circle"></i> &nbsp;
                                    REGISTRAR
                                </button>
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
      <!-- /.container-fluid -->

        



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
            nivFalta: this.$route.params.nivFalta,
            division: this.$route.params.division,
            externo: this.$route.params.externo,
            divGra: this.$route.params.divGra,
            /**
             * VARIABLES PARAMETRICAS
             */
            //destinos
            dest1: [],
            dest2: [],
            dest3: [],
            dest4: [],
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
            unidad: '',
            complemento: [],

            /**
             * VARIABLES DE RECEPCION
             */   
            // Datos Personales
            dataPer: [],
            // DATOS DESTINOS
            Adestinos1:[],
            Adestinos2:[],
            Adestinos3:[],
            Adestinos4:[],
            //FALTAS Y SANCIONES
            Afaltas1: [],
            Afaltas2: [],
            Asanciones: [],
            //GRADOS
            Agrado:[],
            Asancionador: [],
            //Estudios
            Aestudios: [],
            //GRADOS PARA SANCIONADOR
            IdGraSan: '',
            GradosSan: [],
            IdCompleSan: '',
            CompleSan: [],
            //DOCUMENTOS
            Adocumentos:[
                {
                    id: 'MEMORANDUM',
                    descripcion: 'MEMORANDUM'
                },
                {
                    id: 'ORDEN DEL DIA',
                    descripcion: 'ORDEN DEL DIA'
                }

            ]
        }
    },
    validations: {
        dest1: {required},
        dest2: {required},
        dest3: {required},
        dest4: {required},
        grado: {required},
        complemento: {required},
        sancionador: {required},
        IdGraSan: {required},
        cargo: {required, maxLength: maxLength(255)},
        unidad: {required, maxLength: maxLength(255)},
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
        this.Destino1();
        this.Falta1();
        this.Sancion();
        this.Grados();
        this.SancionadorList();
        this.Estudios();
    },
    computed: {
        mostrarCom(){
            try {
                this.comAbre = this.complemento.abreviatura
            } catch (error) {
                this.comAbre = ''
            }
            
        },
        cantidadComple() {
            var tam = this.CompleSan.length; // Obtenemos el valor del tamaño del array de calificaciones objetivas
            if (tam > 0 ) {
                return false;
            } else {
                return true;
            }
        },
        cantidadGrado() {
            var tam = this.GradosSan.length; // Obtenemos el valor del tamaño del array de calificaciones objetivas
            if (tam > 0 ) {
                return false;
            } else {
                return true;
            }
        },
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
        /**
         * FUNCIONES PARA LOS SELECTS
         */
        //SANCIONADOR
        SancionadorList(){
            let me = this;
             axios
            .post("/listarPersonalTotal", {
                divGra: me.divGra,
                percodigo: me.per_codigo
            })
            .then(function (response) {
                me.Asancionador = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        GradosSancionador(v){
            let me = this;
            axios
            .post("/gradosComboDiv", {
                // division: me.sancionador.division
                division: v
            })
            .then(function (response) {
                // console.log(response);
                me.GradosSan = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })

        },
        EstudiosSancionador(){
            let me = this;
            axios
            .get('/estudiosComboDem')
            .then(function (response) {
        
                me.CompleSan = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            });

        },
        DatosSAncionador(){//Muestra los datos del sancionador Grado y complemento actual
            this.IdGraSan = this.sancionador.grado;
            this.IdCompleSan = this.sancionador.complemento;
            var v = this.sancionador.division;
            this.GradosSancionador(v);
            this.EstudiosSancionador();
            
        },
        //DESTINOS
        Destino1(){
            let me = this;
            axios
            .get('/destino1Combo')
            .then(function (response) {
                me.Adestinos1 = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            });
        },
        Destino2(){
            try {
                let me = this;
                me.dest2 = '';
                me.dest3 = '';
                me.dest4 = '';
                axios
                .post("/destino2Combo", {
                    dest1: me.dest1.id
                })
                .then(function (response) {
                    me.Adestinos2 = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            } catch (error) {
                this.Adestinos2 = [];
                this.Adestinos3 = [];
                this.Adestinos4 = [];
            }            
        },
        Destino3(){
            try {
                let me = this;
                me.dest3 = '';
                me.dest4 = '';
                axios
                .post("/destino3Combo", {
                    dest2: me.dest2.id
                })
                .then(function (response) {
                    me.Adestinos3 = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            } catch (error) {
                this.Adestinos3 = [];
                this.Adestinos4 = [];
            }
            
        },
        Destino4(){
            try {
                let me = this;
                me.dest4 = '';
                axios
                .post("/destino4Combo", {
                    dest3: me.dest3.id
                })
                .then(function (response) {
                    me.Adestinos4 = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            } catch (error) {
                this.Adestinos4 = [];
            }
            
        },
        //FALTAS Y SANCION
        Falta1(){
            let me = this;
            axios
            .get('/faltas1Combo')
            .then(function (response) {
                me.Afaltas1 = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            });
        },
        Falta2(){
            try {
                let me = this;
                me.falta2 = '',
                axios
                .post("/faltas2Combo", {
                    falta1: me.falta1.id,
                    nivel: me.nivFalta
                })
                .then(function (response) {
                    me.Afaltas2 = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            } catch (error) {
                this.Afaltas2 = [];
            }
            
        },
        Sancion(){
            let me = this;
            axios
            .post("/sancionesCombo", {
                nivel: me.nivFalta
            })
            .then(function (response) {
        
                me.Asanciones = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        Grados(){            
            let me = this;
            axios
            .post("/gradosClasificacionCombo", {
                division: me.division
            })
            .then(function (response) {
                
                me.Agrado = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        Estudios(){
            let me = this;
            axios
            .get('/estudiosComboDem')
            .then(function (response) {
        
                me.Aestudios = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            });

        },
        /**
         * FUNCION DE CANCELACION
         */
        Atras(){
           this.$router.push({
                name: "ListaFaltas",
            //ENVIO DE DATOS POR URL
                params:{
                    codigo: this.per_codigo,
                    c: 1,
                    u: 22,
                    e: 0,
                    fu: 0
                }
            });

        },
        Guardar(){
            this.$v.$reset()
            if (!this.$v.$invalid) {

                swal.fire({
                    title: '¿Desea guardar esta Falta?', // TITULO 
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
                        if (me.IdGraSan.abreviatura) {
                            var grado = me.IdGraSan.abreviatura;
                        } else {
                            var grado =  me.IdGraSan;
                        }
                        if (me.IdCompleSan.nombre) {
                           
                            var complemento = me.IdCompleSan.abreviatura;
                           
                        } else {
                            var complemento =  me.IdCompleSan;
                        }
                        axios
                        .post("/guardarFalta", {
                            per_codigo: me.per_codigo,
                            complemento: me.complemento.id,
                            //destinos
                            dest1: me.dest1.id,
                            dest2: me.dest2.id,
                            dest3: me.dest3.id,
                            dest4: me.dest4.id,
                            unidad: me.unidad.toUpperCase(),
                            //faltas y sanciones
                            falta1: me.falta1.id,
                            falta2: me.falta2.id,
                            sancion: me.sancion.id,
                            cargo: me.cargo.toUpperCase(),
                            externo: me.externo,
                            //documento
                            doc: me.doc.id,
                            ndoc: me.ndoc.toUpperCase(),
                            fecha: me.fecha,
                            sancionador: grado+' '+complemento+' '+me.sancionador.text,
                            dias: me.dias,
                            grado:me.grado.id,
                            observacion: me.observacion,
                            estado: 1,
                            faltuni: 1
                        })
                        .then(function (response) {
                    
                            swal.fire(
                                "Aceptado", //TITULO
                                "Se añadio correctamente la falta.", //TEXTO DE MENSAJE
                                "success" // TIPO DE MODAL (success, warnning, error, info)
                            );
                            me.Atras();
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })
                    }else{
                    console.log('no empezamos');
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
    }
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
</style>