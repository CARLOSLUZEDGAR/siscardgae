<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">            
                <h1>
                <i class="far fa-bookmark"></i>
                Profesion Libre Personal
                <!-- <small>Personal</small> -->
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Profesion Libre</li>
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
                                                <div v-if="$auth.can('insert-perproflib')" class="col-md-4">
                                                    <button type="button" class="btn btn-sm btn-primary btn-block" style="margin-right: 5px;"  @click="NuevaProfesion()">
                                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Nueva Profesión
                                                    </button>
                                                </div>
                                                <div v-if="$auth.can('report-pdfpercur')" class="col-md-4">
                                                    <button v-if="$auth.can('report-perestu')" class="btn btn-sm btn-secondary btn-block" @click="reporteProfesion(per_codigo)">
                                                        <i class="far fa-file-pdf" aria-hidden="true"></i>&nbsp; Reporte Personal
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <router-link type="button" class="btn btn-sm btn-danger btn-block position-reverse" :to="'/DatosProfesion/'">
                                                        <i class="fas fa-reply"></i>&nbsp; Volver Atrás
                                                    </router-link>
                                                </div>
                                            </div>



                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                                <!--DATOS FAMILIARES--> 
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group row border justify-content-center">

                                    <div class="col-md-12" style="font-size: 14px;">
                                        <div class="form-group">
                                            
                                            <div class="card-body">
                                                <div class=" col-md-12">
                                                    <template v-if="arrayPersonalProfesiones.length > 0">
                                                        <table class="table table-bordered table-striped table-sm tables">
                                                            <thead >
                                                                <tr>
                                                                    <th style="width: 100px;">Opciones</th>
                                                                    <th class="text-center">Grado Académico</th>
                                                                    <th class="text-center">Carrera</th>
                                                                    <th class="text-center">Unidad Academica</th>
                                                                    <th class="text-center">Fecha de Egreso</th>
                                                                    <th style="width: 400px;" class="text-center">Descripción</th>
                                                                    <th style="width: 400px;" class="text-center">Observaciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="per_prof in arrayPersonalProfesiones" :key="per_prof.id">
                                                                    <td >
                                                                        <button v-if="$auth.can('edit-perproflib')" type="button" @click="AbrirEditarProfesion(per_prof.id)"  class="btn btn-warning btn-sm">
                                                                            <i class="fas fa-pencil-alt"></i>
                                                                        </button> &nbsp;
                                                                        <template v-if="per_prof.estado=='1'">
                                                                            <button v-if="$auth.can('delete-perproflib')" type="button" class="btn btn-danger btn-sm" @click="desactivarProfesionLibre(per_prof.id)" >
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </button>
                                                                        </template>   
                                                                    </td>
                                                                    <td v-text="per_prof.descripcion_carrera" ></td>
                                                                    <td v-text="per_prof.niv_especialidad"></td>
                                                                    <td v-text="per_prof.lugar_estudio"></td>
                                                                    <td v-text="since(per_prof.fecha_egreso)"></td>
                                                                    <td v-text="per_prof.descripcion"></td>
                                                                    <td v-text="per_prof.observacion"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </template>
                                                    <template v-else>
                                                        <div class="callout callout-info">
                                                            <h6 style="color: #FF0000;"><center>EL PERSONAL NO CUENTA CON REGISTROS EN PROFESION LIBRE</center></h6>
                                                        </div>
                                                    </template>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            
                                <!--FIN DATOS FAMILIARES-->
                                
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- ./row -->
            </div>
            <!-- /.container-fluid -->

            <div class="modal fade" id="NuevaProfesion">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">REGISTRAR NUEVA PROFESIÓN</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>{{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</h5>
                            <div class="row">
                                <div class="col-4">
                                    <label for="">Grado Académico</label>
                                    <v-select                            
                                        label="descripcion"                            
                                        :options="car_codigocombo"                            
                                        v-model="car_codigo"
                                        @input="selectbuscarNivel_profesional"
                                        :class="{ 'is-invalid' : $v.car_codigo.$error, 'is-valid':!$v.car_codigo.$invalid }"
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
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.car_codigo.required">Seleccione un valor porfavor</span>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <label for="">Carrera</label>
                                    <v-select
                                        
                                        label="descripcion"                            
                                        :options="arrayNivel_profesional"                            
                                        v-model="nivelProfesional"
                                        :class="{ 'is-invalid' : $v.nivelProfesional.$error, 'is-valid':!$v.nivelProfesional.$invalid }"
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
                                    <div class="invalid-feedback">
                                    <span v-if="!$v.nivelProfesional.required">Seleccione un valor porfavor</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Descripción de la especialidad</label>
                                        <input type="text" class="form-control" v-model="descripcion" placeholder="Ej: Protesis dental, Auditor externo, idioma ingles, analista, etc." style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }" >
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.descripcion.required">Este campo es Requerido</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unidad Académica de Egreso</label>
                                        <input type="text" class="form-control" v-model="lugar_estudioo" placeholder="" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.lugar_estudioo.$error, 'is-valid':!$v.lugar_estudioo.$invalid }">
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.lugar_estudioo.required">Este campo es Requerido</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fecha de Egreso</label>
                                        <date-picker style="width: 100%; max-width:100;" value-type="date" format="DD/MM/YYYY"
                                            v-model="fecha_egresoo" :disabled-date="fechaactual"
                                            :class="{ 'is-invalid' : $v.fecha_egresoo.$error, 'is-valid':!$v.fecha_egresoo.$invalid }">
                                        </date-picker>
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.fecha_egresoo.required">Debe introducir una fecha</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Observación</label>
                                        <input type="text" class="form-control" v-model="observacion" placeholder="" style="text-transform:uppercase;"  >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="RegistrarProfesion()">Registrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="EditarProfesion">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR PROFESIÓN</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>{{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</h5>
                            <div class="row">
                                <div class="col-4">
                                    <label for="">Grado Academico:</label>
                                    <v-select                            
                                        label="descripcion"                            
                                        :options="car_codigocombo"                            
                                        v-model="car_codigo"
                                        @input="selectbuscarNivel_profesional"
                                        :class="{ 'is-invalid' : $v.car_codigo.$error, 'is-valid':!$v.car_codigo.$invalid }"
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
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.car_codigo.required">Seleccione un valor porfavor</span>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <label for="">Carrera:</label>
                                    <v-select
                                        
                                        label="descripcion"                            
                                        :options="arrayNivel_profesional"                            
                                        v-model="nivelProfesional"
                                        :class="{ 'is-invalid' : $v.nivelProfesional.$error, 'is-valid':!$v.nivelProfesional.$invalid }"
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
                                    <div class="invalid-feedback">
                                    <span v-if="!$v.nivelProfesional.required">Seleccione un valor porfavor</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Descripción de la especialidad</label>
                                        <input type="text" class="form-control" v-model="descripcionA" placeholder="Ej: Protesis dental, Auditor externo, idioma ingles, analista, etc." style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.descripcionA.$error, 'is-valid':!$v.descripcionA.$invalid }">
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.descripcionA.required">Este campo es Requerido</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unidad Académica de Egreso</label>
                                        <input type="text" class="form-control" v-model="lugar_estudioA" placeholder="" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.lugar_estudioA.$error, 'is-valid':!$v.lugar_estudioA.$invalid }">
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.lugar_estudioA.required">Este campo es Requerido</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fecha de Egreso</label>
                                        <!-- <date-picker style="width: 100%; max-width:100;" value-type="date" format="DD/MM/YYYY"
                                            v-model="fecha_egresoA" :disabled-date="fechaactual"
                                            :class="{ 'is-invalid' : $v.fecha_egresoA.$error, 'is-valid':!$v.fecha_egresoA.$invalid }">
                                        </date-picker> -->
                                        <input type="date" v-model="fecha_egresoA" class="form-control" :class="{ 'is-invalid' : $v.fecha_egresoA.$error, 'is-valid':!$v.fecha_egresoA.$invalid }">
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.fecha_egresoA.required">Debe introducir una fecha</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Observación</label>
                                        <input type="text" class="form-control" v-model="observacionA" placeholder="" style="text-transform:uppercase;"  >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="EditarProfesion()">Editar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>


            
            
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

            arrayPersonalProfesiones : [],
            arrayCarrera : [],
            datos: [],
            errorPersonal_profesion : 0,
            errorMostrarMsjPersonal_profesion : [],

            car_codigocombo:[],
            car_codigo : [],
            nivelProfesional:[],
            arrayNivel_profesional : [],

            per_cm : '', 


            nivprof_codigo : 0,
            descripcion : '',
            lugar_estudioo : '',
            fecha_egresoo : '',
            estadoo : '',
            observacion : '',
            sys_usero : '',


            car_codigoA : [],
            nivelProfesionalA:[],
            descripcionA : '',
            lugar_estudioA : '',
            fecha_egresoA : '',
            observacionA : '',
            

            rowId : 0,
            arrayDatosPersonal :[],    

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
        car_codigo : { required },
        nivelProfesional : { required },
        descripcion : { required },
        lugar_estudioo : { required },
        fecha_egresoo : { required },

        /* car_codigoA : { required },
        nivelProfesionalA : { required }, */
        descripcionA : { required },
        lugar_estudioA : { required },
        fecha_egresoA : { required },

        validationGroupReg: ['car_codigo', 'nivelProfesional', 'descripcion', 'lugar_estudioo', 'fecha_egresoo'],
        validationGroupEdit: ['car_codigo', 'nivelProfesional', 'descripcionA', 'lugar_estudioA', 'fecha_egresoA']
    },




    mounted() {
        
        this.listarPersonalProfesion(this.per_codigo);
        this.datosPersonal(this.per_codigo);
        this.listarDatosPersonalSituacion();
    },
    methods: {
        since: function (d){
            return moment(d).format('DD-MM-YYYY');
        },

        fechaactual(date){
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return  date > new Date(today.getTime());
        },

        listarPersonalProfesion(per_codigo){
            let me = this;
            axios
            .post("/listarPersonalProfesion", {
                per_codigo : per_codigo,
            })
            .then(function (response) {
                var respuesta = response.data;
                //me.datos_fisicos = response.data.data;

            me.arrayPersonalProfesiones = respuesta.per_prof.data;
                //console.log(response.data.per_prof.data) //Para ver en consola la Data que recuperamos
            //me.selectCarrera();
            //me.selectNivel_profesional();

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
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




        desactivarProfesionLibre(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
            title: '¿Está usted seguro de eliminar a este profesion?',
            text: "No podra revertir esta acción.",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
            let me =this;
            axios.put('/desactivarPersonalProfesion',{
                    
                    'id' : id
                }).then(function (response) {
                
                    
                    me.listarPersonalProfesion(me.per_codigo);
                    swalWithBootstrapButtons.fire(
                    'Desactivado!',
                    'Tu registro ha sido eliminado.',
                    'success'
                    )

                })
                .catch(function (error) {
                // handle error
                console.log(error);
                })
                .then(function () {
                // always executed
                });



                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    
                }
            })
        },

        Cerrar(){
            this.$v.$reset()
        },


        RegistrarProfesion(){
            this.$v.$reset();
            if(!this.$v.validationGroupReg.$invalid){
            swal.fire({
                title: '¿Desea registrar la nueva profesión?', // TITULO 
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
                    .post("/registrarPersonalProfesion", {
                        'per_codigo' : me.per_codigo,
                        'nivprof_codigo' : me.nivelProfesional.id,
                        'car_codigo' : me.car_codigo.id,
                        'descripcion' : me.descripcion.toUpperCase(),
                        'lugar_estudio' : me.lugar_estudioo.toUpperCase(),
                        'fecha_egreso' : me.fecha_egresoo, 
                        'estado' : '1',
                        'observacion' : me.observacion.toUpperCase()
                    })
                    .then(function (response) {
                        me.listarPersonalProfesion(me.per_codigo);
                        $('#NuevaProfesion').modal('hide');
                        swal.fire(
                            "Aceptado", //TITULO
                            "Se añadio correctamente la Profesion.", //TEXTO DE MENSAJE
                            "success" // TIPO DE MODAL (success, warnning, error, info)
                        );

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    }) 
                }else{
                    swal.fire(
                        "Anulado", //TITULO
                        "No se realizo el registro de la Profesion.", //TEXTO DE MENSAJE
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

        EditarProfesion(){
            this.$v.$reset();
            if(!this.$v.validationGroupEdit.$invalid){
                swal.fire({
                    title: '¿Desea realizar la modificación de la Profesión Libre ?', // TITULO 
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
                        if (me.car_codigo.id) {
                            var car_codigoA = me.car_codigo.id;
                        } else {
                            var car_codigoA =  me.idcar_codigo;
                        }
                        if (me.nivelProfesional.id) {
                            var nivprof_codigo = me.nivelProfesional.id;
                        } else {
                            var nivprof_codigo =  me.idnivprof_codigo;
                        } 
                        if(me.observacionA!==null){
                            me.observacionA=me.observacionA.toUpperCase();
                        }
                        
                        axios
                        .post("/actualizarPersonalProfesion", {
                            idper_prof: me.idper_prof,
                            per_codigo : me.per_codigo,
                            car_codigo : car_codigoA,
                            nivprof_codigo : nivprof_codigo,
                            descripcion : me.descripcionA.toUpperCase(),
                            lugar_estudio : me.lugar_estudioA.toUpperCase(),
                            fecha_egreso : me.fecha_egresoA, 
                            estado : '1',
                            observacion: me.observacionA

                        })
                        .then(function (response) {

                            $('#EditarProfesion').modal('hide')
                            swal.fire(
                                "Aceptado", //TITULO
                                "Se modificó correctamente la Profesión.", //TEXTO DE MENSAJE
                                "success" // TIPO DE MODAL (success, warnning, error, info)
                            )
                            me.listarPersonalProfesion(me.per_codigo);
                            
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })   
                            }else{
                                swal.fire(
                                "Anulado", //TITULO
                                "No se realizo la actualización de la Profesión.", //TEXTO DE MENSAJE
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

        selectCarrera(){
            let me =this;
            axios.
            get('/selectCarreras')
            .then(function (response) {
                me.car_codigocombo = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },


        selectbuscarNivel_profesional(){
            try {
                let me =this;
                me.nivelProfesional=[];
                //me.nivelProfesionalA=[];
                //me.arrayNivel_profesional=[];
                axios
                .post("/selectbuscarNivelProfesionals", {
                    id: me.car_codigo.id
                })
                .then(function (response) {
                    me.arrayNivel_profesional=response.data;
                })
                .catch(function (error) {
                    // handle error 
                    console.log(error);
                })
            } catch (error) {
                this.arrayNivel_profesional=[];
            }
        },


        NuevaProfesion(){
            this.$v.$reset(),
            this.nivprof_codigo = 0,
            this.car_codigo = '',
            this.descripcion = '',
            this.lugar_estudioo = '',
            this.fecha_egreso = '',
            this.observacion = '',
            this.nivelProfesional = '',
            this.fecha_egresoo = '',
            this.selectCarrera();
            $('#NuevaProfesion').modal('show');
            $(".modal-header").css("background-color", "#007bff"); 
            $(".modal-header").css("color", "white" ); 
        },

        AbrirEditarProfesion(s){
            let me = this;
            me.idper_prof = s;
            axios
            .post("/listarPerProfesionModificar", {
                per_prof: s
            })
            .then(function (response) {                
                me.car_codigo = response.data.descripcion_carrera;
                me.idcar_codigo = response.data.car_codigo,
                me.nivelProfesional = response.data.niv_especialidad;
                me.idnivprof_codigo = response.data.nivprof_codigo,
                me.descripcionA = response.data.descripcion;
                me.lugar_estudioA = response.data.lugar_estudio;
                me.fecha_egresoA = response.data.fecha_egreso;
                me.fecha_egresoA= me.fecha_egresoA.substring(0,10);                         
                var info10 = me.fecha_egresoA.split('-');
                me.fecha_egresoA=info10[0] + '-' + info10[1] + '-' + info10[1];
                me.per_codigo = response.data.per_codigo;
                me.arrayNivel_profesional=[];
                me.observacionA = response.data.observacion;
                me.selectCarrera();
                $('#EditarProfesion').modal('show')
                $(".modal-header").css("background-color", "#007bff"); 
                $(".modal-header").css("color", "white" );
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })    
        
        },

        reporteProfesion(per_codigo){
          window.open('http://sipefab.fab.bo/reporteProfesion?per_codigo='+per_codigo);
        },



    },
}
</script>

<style>    
    .tables {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
    /* div.modal-content {
        height: 500px !important;
    } */


</style>