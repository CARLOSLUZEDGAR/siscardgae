<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
             <h1>
                <i class="far fa-bookmark"></i>
                Personal Especialidad
            </h1>&nbsp;
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Personal Especialidad</li>
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

                                <!-- <img :src="'../img/personal/'+datos.foto" width="100%" height="60%"> -->
                            </div>
                    
                            <div class="col-md-10 d-flex align-items-center">
                                <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                    <!-- FILA 1 -->
                                    <div class="row p-2 bd-highlight">
                                        <div class="col-md-6">
                                            <dl>
                                                <dt class="st">GRADOS Y NOMBRES</dt>
                                                <dd class="st">{{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</dd>

                                                <!-- <dd class="st">{{ datos.grado }} {{ datos.complemento }} {{ datos.nombre }} {{ datos.paterno }} {{ datos.materno }}</dd> -->
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
                                            <div v-if="$auth.can('insert-peresp')" class="col-md-4">                                            
                                                <button type="button" class="btn btn-primary btn-sm btn-block" @click="NuevaEspecialidad()">
                                                    <i class="fas fa-plus" aria-hidden="true"> Nueva Especialidad</i>
                                                </button> &nbsp;
                                            </div>
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








            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                <template v-if="arrayPersonalEspecialidades.length">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr style="width:100px; text-align:center">
                                <th><center>Opciones</center></th>
                                <th><center>Fecha</center></th>
                                <th><center>Nro. Documento</center></th>
                                <th><center>Documento</center></th>
                                <th><center>Especialidad</center></th>
                                <th><center>Subespecialidad</center></th>
                                <th><center>Estado</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="personalEspecialidad in arrayPersonalEspecialidades" :key="personalEspecialidad.id" style="width: 100%">
                                
                                <td style="width:100px; text-align:center">
                                    <button v-if="$auth.can('edit-peresp')" type="button" class="btn btn-warning btn-sm" @click="abrirEditar(personalEspecialidad)">
                                        <i class="fas fa-edit"></i>
                                    </button> &nbsp;
                                    <template v-if="personalEspecialidad.estado == 0">
                                        <button v-if="$auth.can('delete-peresp')" type="button" class="btn btn-danger btn-sm" @click="desactivarPerEspecialidad(personalEspecialidad)" >
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    </template>
                                    <!-- <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="ActivarPerEspecialidad(personalEspecialidad)">
                                            <i class="far fa-check-square"></i>
                                        </button>
                                    </template> -->
                                </td>
                                <td ><center>{{personalEspecialidad.fecha_documento | moment("D/MM/YYYY")}}</center></td>
                                <td v-text="personalEspecialidad.nrodoc" style="width:100px; text-align:center"></td> 
                                <td v-text="personalEspecialidad.documento"></td> 
                                <td v-text="personalEspecialidad.nomespe"></td> 
                                <td v-text="personalEspecialidad.nomsubespe"></td>                
                                <td>
                                <div v-if="personalEspecialidad.estado == 1">
                                    <center><span class="badge badge-success">Actual</span></center>
                                </div>
                                <div v-else>
                                   <center><span class="badge badge-danger">Anterior</span></center>
                                </div>
                                </td>                           
                            </tr>
                            
                        </tbody>
                    </table>
                </template>
                <template v-else>
                    <div class="callout callout-info">
                        <h5><i class="fas fa-exclamation-triangle x-lg-2"></i> No se encontraron resultados...</h5>
                    </div>
                </template>
                </div>
                    <nav>
                        <!-- inicio para paginacion -->
                       <!-- <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                            </li>
                           
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul> -->
                        <!-- fin paginacion -->
                    </nav>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->


        <!--MODAL CLASES
        id="NombreModal" -->
        <div class="modal fade" id="NuevaEspecialidad">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title-registro"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="form-control-label" for="text-input">Nro. Documento</label>
                        <input type="text" v-model="perespe_nrodoc" class="form-control" :class="{ 'is-invalid' : $v.perespe_nrodoc.$error, 'is-valid':!$v.perespe_nrodoc.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.perespe_nrodoc.required">Este campo es Requerido</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-control-label" for="text-input">Tipo Documento</label>
                        <select class="form-control" v-model="perespe_tipodoc" :class="{ 'is-invalid' : $v.perespe_tipodoc.$error, 'is-valid':!$v.perespe_tipodoc.$invalid }">
                            <option value="0" disabled>SELECCIONAR</option>
                            <option value="ORDEN GENERAL DE DESTINOS">ORDEN GENERAL DE DESTINOS</option>
                            <option value="MEMORANDUM">MEMORANDUM</option>
                            <option value="FAX">FAX</option>
                            <option value="DIRECTIVA">DIRECTIVA</option>
                        </select>
                        <div class="invalid-feedback">
                            <span v-if="!$v.perespe_tipodoc.required">Este campo es Requerido</span>
                        </div>
                    </div>
                        
                    <div class="col-md-4">
                        <label class="form-control-label" for="text-input">Fecha de Documento</label>
                        <input type="date" v-model="perespe_fechadoc" class="form-control" :class="{ 'is-invalid' : $v.perespe_fechadoc.$error, 'is-valid':!$v.perespe_fechadoc.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.perespe_fechadoc.required">Este campo es Requerido</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">Especialidad</label>
                        <select class="form-control" v-model="perespe_especialidad" v-on:change="changeItem1(rowId, $event)" :class="{ 'is-invalid' : $v.perespe_especialidad.$error, 'is-valid':!$v.perespe_especialidad.$invalid }">
                            <option value="" disabled>SELECCIONE</option>
                            <option v-for="especialidad in arrayEspecialidad" :key="especialidad.id" :value="especialidad.id"  v-text="especialidad.nombre"></option>
                        </select>
                        <div class="invalid-feedback">
                            <span v-if="!$v.perespe_especialidad.required">Este campo es Requerido</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">Subespecialidad</label>
                        <select class="form-control" v-model="perespe_subespecialidad" :class="{ 'is-invalid' : $v.perespe_subespecialidad.$error, 'is-valid':!$v.perespe_subespecialidad.$invalid }">
                            <option value="" disabled>SELECCIONE</option>
                            <option v-for="subespecialidad in arraySubespecialidad" :key="subespecialidad.id" :value="subespecialidad.id"  v-text="subespecialidad.nombre"></option>                        
                        </select>
                        <div class="invalid-feedback">
                            <span v-if="!$v.perespe_subespecialidad.required">Este campo es Requerido</span>
                        </div>
                    </div> 
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label" for="text-input">Observación</label>
                        <textarea name="textarea" class="form-control" rows="3" v-model="perespe_observacion" style="text-transform:uppercase"></textarea>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="RegistrarEspecialidad()">Registrar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      
<div class="modal fade" id="EditarEspecialidad">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title-edit"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="form-control-label" for="text-input" >Nro. Documento</label>
                        <input type="text" v-model="perespe_nrodocA" class="form-control" :class="{ 'is-invalid' : $v.perespe_nrodocA.$error, 'is-valid':!$v.perespe_nrodocA.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.perespe_nrodocA.required">Este campo es Requerido</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-control-label" for="text-input">Tipo Documento</label>
                        <select class="form-control" v-model="perespe_tipodocA" :class="{ 'is-invalid' : $v.perespe_tipodocA.$error, 'is-valid':!$v.perespe_tipodocA.$invalid }">
                            <option value="0" disabled>SELECCIONAR</option>
                            <option value="ORDEN GENERAL DE DESTINOS">ORDEN GENERAL DE DESTINOS</option>
                            <option value="MEMORANDUM">MEMORANDUM</option>
                            <option value="FAX">FAX</option>
                            <option value="DIRECTIVA">DIRECTIVA</option>
                        </select>
                        <div class="invalid-feedback">
                            <span v-if="!$v.perespe_tipodocA.required">Este campo es Requerido</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-control-label" for="text-input">Fecha de Documento</label>
                        <input type="date" v-model="perespe_fechadocA" class="form-control" :class="{ 'is-invalid' : $v.perespe_fechadocA.$error, 'is-valid':!$v.perespe_fechadocA.$invalid }">
                        <div class="invalid-feedback">
                            <span v-if="!$v.perespe_fechadocA.required">Este campo es Requerido</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">Especialidad</label>
                        <select class="form-control" v-model="perespe_especialidadA" v-on:change="changeItem1(rowId, $event)" :class="{ 'is-invalid' : $v.perespe_especialidadA.$error, 'is-valid':!$v.perespe_especialidadA.$invalid }">
                            <option value="0" disabled>SELECCIONE</option>
                            <option v-for="especialidad in arrayEspecialidad" :key="especialidad.id" :value="especialidad.id"  v-text="especialidad.nombre"></option>
                        </select>
                        <div class="invalid-feedback">
                            <span v-if="!$v.perespe_especialidadA.required">Este campo es Requerido</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="text-input">Subespecialidad</label>
                        <select class="form-control" v-model="perespe_subespecialidadA" :class="{ 'is-invalid' : $v.perespe_subespecialidadA.$error, 'is-valid':!$v.perespe_subespecialidadA.$invalid }">
                            <option value="0" disabled>SELECCIONE</option>
                            <option v-for="subespecialidad in arraySubespecialidad" :key="subespecialidad.id" :value="subespecialidad.id"  v-text="subespecialidad.nombre"></option>                        
                        </select>
                        <div class="invalid-feedback">
                            <span v-if="!$v.perespe_subespecialidadA.required">Este campo es Requerido</span>
                        </div>
                    </div>
                    
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label" for="text-input">Observación</label>
                        <textarea name="textarea" class="form-control" rows="3" v-model="perespe_observacionA" style="text-transform:uppercase"></textarea>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <div v-show="errorEspecialidadActualizar" class="form-group row div-error">
                        <div class="text-center text-error">
                            <div v-for="error in errorMostrarMsjEspecialidadActualizar" :key="error" v-text="error">
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="EditarEspecialidad()">Actualizar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
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
//import { required, minLength, between } from 'vuelidate/lib/validators'
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.d,
            arrayPersonalEspecialidades : [],
            arrayDatosPersonal : [],
            arrayEspecialidad : [],
            arraySubespecialidad : [],

            errorEspecialidadActualizar : 0,
            errorMostrarMsjEspecialidadActualizar : [],

            ano_actual : '',
            per_cmi : '',
            per_cmil : '',
            //VARIABLES MODAL
            per_paterno : '',
            per_materno : '',
            per_nombre : '',
            //VARIABLES REGISTRAR PER_ESPECIALIDAD
            perespe_nrodoc : '',
            perespe_tipodoc : '',
            perespe_fechadoc : '',
            perespe_especialidad : '',
            perespe_subespecialidad : '',
            perespe_observacion : '',
            //VARIABLES EDITAR PER_ESPECIALIDAD
            idPersonalEspecialidad : 0,
            perespe_nrodocA : '',
            perespe_tipodocA : '',
            perespe_fechadocA : '',
            perespe_especialidadA : '',
            perespe_subespecialidadA : '',
            perespe_observacionA : '',
            rowId : 0,
        }
    },

    validations:{
            perespe_nrodoc : { required },
            perespe_tipodoc : { required },
            perespe_fechadoc : { required },
            perespe_especialidad : { required },
            perespe_subespecialidad : { required },

            perespe_nrodocA : { required },
            perespe_tipodocA : { required },
            perespe_fechadocA : { required },
            perespe_especialidadA : { required },
            perespe_subespecialidadA : { required },

            validationGroupReg: ['perespe_nrodoc', 'perespe_tipodoc', 'perespe_fechadoc', 'perespe_especialidad', 'perespe_subespecialidad'],
            validationGroupEdit: ['perespe_nrodocA', 'perespe_tipodocA', 'perespe_fechadocA', 'perespe_especialidadA', 'perespe_subespecialidadA']
    },

    mounted() {
        //this.ver();
        this.listarPersonalEspecialidades(this.per_codigo);
        this.datosPersonal(this.per_codigo);
    },
    methods: {

        listarPersonalEspecialidades(per_codigo){
            let me = this;
            axios
          .post("/listarPersonalEspecialidad", {
            per_codigo : per_codigo,
          })
          .then(function (response) {
            
           me.arrayPersonalEspecialidades = response.data.especialidad.data
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        datosPersonal(per_codigo){
            let me = this;
            axios
          .post("/datosPersonal", {
            per_codigo : per_codigo,
          })
          .then(function (response) {
            
            me.arrayDatosPersonal = response.data.personal_datos
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        changeItem1: function changeItem1(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarSubespecialidad(event.target.value);
        },
        
        selectEspecialidad(){
            let me =this;
            var filtro = me.arrayDatosPersonal.subescid;
            var url='/especialidad/selectEspecialidad?filtro='+ filtro;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayEspecialidad = respuesta.especialidad; 
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectSubespecialidad(){
            let me =this;
            var url='/subespecialidad/selectSubespecialidad';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arraySubespecialidad = respuesta.subespecialidad; 
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectbuscarSubespecialidad(depa)
        {
            let me =this;
           
            me.buscarD= depa;
            me.arraySubespecialidad=[];
          //  me.prov_codigo=0;
            var url='/subespecialidad/selectbuscarSubespecialidad?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arraySubespecialidad = respuesta.subespecialidad; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
            // always executed
            }); 
        },

        Cerrar(){
            this.$v.$reset()
        },

        NuevaEspecialidad(){
            this.$v.$reset(),
            //PONER DE CERO EL MODAL ANTES DE REGISTRAR
            this.idPersonalEspecialidad = 0,
            this.perespe_nrodoc = '',
            this.perespe_tipodoc = '',
            this.perespe_fechadoc = '',
            this.perespe_especialidad = '',
            this.perespe_subespecialidad = '',
            this.perespe_observacion = '',
            //FIN PONER A CERO MODAL
            $('#NuevaEspecialidad').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-registro").text("Registrar Nueva Especialidad");
            this.selectEspecialidad()
            this.selectSubespecialidad()
            this.selectbuscarSubespecialidad(this.perespe_especialidad)
        },

        RegistrarEspecialidad(){
            this.$v.$reset();
            if(!this.$v.validationGroupReg.$invalid){
                swal.fire({
                    title: 'Se registrara la Especialidad', // TITULO 
                    icon: 'warning', //ICONO (success, warnning, error, info, question)
                    showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
                    confirmButtonColor: '#3085d6', // COLOR DEL BOTON PARA CONFIRMAR
                    cancelButtonColor: '#d33', // CLOR DEL BOTON CANCELAR
                    confirmButtonText: 'Registrar', //TITULO DEL BOTON CONFIRMAR
                    cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        //CODIGO HA SER VALIDADO
                        let me = this;
                        axios
                        .post("/registrarPerEspecialidad", {
                        //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                            per_codigo : me.per_codigo,
                            espe_cod : me.perespe_especialidad,
                            subespe_cod : me.perespe_subespecialidad,
                            documento : me.perespe_tipodoc,
                            fecha_documento : me.perespe_fechadoc,
                            fecha : me.perespe_fechadoc,
                            nrodoc : me.perespe_nrodoc,
                            observacion : me.perespe_observacion,
                            filtro : me.arrayDatosPersonal.subescid
                        })
                        .then(function (response) {
                            //Respuesta de la peticion
                            
                            Swal.fire({
                                icon    :   'success',
                                title   :   'Se ha registrado la nueva Especialidad',
                                showConfirmButton   : false,
                                timer   :   1500
                            })
                            $('#NuevaEspecialidad').modal('hide');
                            me.listarPersonalEspecialidades(me.per_codigo);
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                    }else{
                        console.log('no empezamos');
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

        abrirEditar(personalEspecialidad){
            let me =this;
            this.$v.$reset(),
            this.idPersonalEspecialidad = personalEspecialidad.idpersonal_especialidades,
            this.perespe_nrodocA = personalEspecialidad.nrodoc, 
            this.perespe_tipodocA   = personalEspecialidad.documento,
            this.perespe_fechadocA = personalEspecialidad.fecha_documento,
            this.perespe_fechadocA = this.perespe_fechadocA.substring(0,10);
                                        var info10 = this.perespe_fechadocA.split('-');
                                        this.perespe_fechadocA = info10[0] + '-' + info10[1] + '-' + info10[2];
            this.perespe_especialidadA = personalEspecialidad.idespe,
            this.perespe_subespecialidadA = personalEspecialidad.idsubespe,
            this.perespe_observacionA = personalEspecialidad.observacion,
            $('#EditarEspecialidad').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-edit").text("Editar Especialidad");
            this.selectEspecialidad()
            this.selectSubespecialidad()
            this.selectbuscarSubespecialidad(this.perespe_especialidadA)
        },

        // validarEspecialidadActualizar(){
        //     this.errorEspecialidadActualizar=0;
        //     this.errorMostrarMsjEspecialidadActualizar =[];
        //     if(!this.perespe_nrodocA) this.errorMostrarMsjEspecialidadActualizar.push("Ingresar Nro de Documento");
        //     if(!this.perespe_tipodocA) this.errorMostrarMsjEspecialidadActualizar.push("Seleccione tipo de Documento");
        //     if(!this.perespe_fechadocA) this.errorMostrarMsjEspecialidadActualizar.push("Registre la Fecha del Documento");
        //     if(!this.perespe_especialidadA) this.errorMostrarMsjEspecialidadActualizar.push("Seleccione una Especialidad");
        //     if(!this.perespe_subespecialidadA) this.errorMostrarMsjEspecialidadActualizar.push("Seleccione una Subespecialidad");  
        //     if
        //     (this.errorMostrarMsjEspecialidadActualizar.length) this.errorEspecialidadActualizar = 1;
        //     return this.errorEspecialidadActualizar;
        // },

        EditarEspecialidad(){
            this.$v.$reset();
            if(!this.$v.validationGroupEdit.$invalid){
                swal.fire({
                    title: 'Se modificara esta Especialidad', // TITULO 
                    icon: 'warning', //ICONO (success, warnning, error, info, question)
                    showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
                    confirmButtonColor: '#3085d6', // COLOR DEL BOTON PARA CONFIRMAR
                    cancelButtonColor: '#d33', // CLOR DEL BOTON CANCELAR
                    confirmButtonText: 'Actualizar', //TITULO DEL BOTON CONFIRMAR
                    cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        //CODIGO HA SER VALIDADO
                        let me = this;
                        axios
                        .put("/editarPerEspecialidad", {
                    //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                        id : me.idPersonalEspecialidad,
                        per_codigo : me.per_codigo,
                        espe_cod : me.perespe_especialidadA,
                        subespe_cod : me.perespe_subespecialidadA,
                        documento : me.perespe_tipodocA,
                        fecha_documento : me.perespe_fechadocA,
                        nrodoc : me.perespe_nrodocA,
                        observacion : me.perespe_observacionA,
                    })                                                                                                                                                                                            
                    .then(function (response) {
                        //Respuesta de la peticion
                        
                        Swal.fire({
                                icon    :   'success',
                                title   :   'Se ha actualizado la Especialidad',
                                showConfirmButton   : false,
                                timer   :   1500
                            })
                        $('#EditarEspecialidad').modal('hide');
                        me.listarPersonalEspecialidades(me.per_codigo);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        });
                    }else{
                        console.log('no empezamos');
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

        desactivarPerEspecialidad(personalEspecialidad){
            //if(!this.$v.$invalid){
                swal.fire({
                    title: 'Esta seguro de eliminar esta especialidad', // TITULO 
                    icon: 'warning', //ICONO (success, warnning, error, info, question)
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
                        this.idPersonalEspecialidad = personalEspecialidad.idpersonal_especialidades,
                        this.perespe_fechadoc = personalEspecialidad.fecha_documento,
                        axios
                        .put('/desactivarPerEspecialidad', {
                    //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                        idPersonalEspecialidad : me.idPersonalEspecialidad,
                        fecha_documento : me.perespe_fechadoc,
                        per_codigo : me.per_codigo,
                    })
                    .then(function (response) {
                        //Respuesta de la peticion
                        
                        me.listarPersonalEspecialidades(me.per_codigo);
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

        PerEspecialidadPDF(per_codigo){
            window.open('http://sipefab.fab.bo/certificadoDestAscenso?per_codigo='+per_codigo+'&notaAsc='+notaAsc+'&rep_reporte=CERTIFICADO DESTINOS ASCENSO');

            let me = this;
            axios
            .post("/registrarReporte", {
            //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                rep_reporte : 'CERTIFICADO DESTINOS ASCENSO',
                rep_per_codigo : me.per_codigo,
                rep_observacion : me.notaAsc,
            })
            .then(function (response) {
                //Respuesta de la peticion
                
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
        },

        

        Atras(){
            this.$router.push({
                name: "ListarPersonalEspecialidades"
                //ENVIO DE DATOS
                // params:{
                //     d: datos
                // }
                
            });
        },

    },
}
</script>