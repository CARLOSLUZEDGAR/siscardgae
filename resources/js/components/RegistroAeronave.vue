<template>
    <div>
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">            
              <h1>
                <i class="far fa-registered"></i>&nbsp;
                REGISTRAR AERONAVE
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
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
                  <div class="row">
                    <div class="col-sm-8">
                      <h3 class="card-title">
                        <!-- Buscar Personal -->
                      </h3>  
                    </div>                  
                    <div class="col-sm-4">
                      <button class="btn btn-danger btn-sm float-right" type="submit" @click="Atras()">
                        <i class="fas fa-arrow-left"></i>&nbsp; ATRAS
                      </button>
                    </div>
                  </div>  
                </div>
                <div class="card-body">
                    <form>
                        <!-- Paso 1 -->
                        <div class="step" v-if="currentStep === 1">
                          <h3><i class="far fa-folder"></i>&nbsp;PASO 1: ASIGNACIÓN DE UNIDAD</h3>
                                <br>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class="form-control-label" for="text-input">Entidad</label>
                                        <select class="form-control" v-model="entidad" @click="listarGranUnidad(entidad),g_unidad = ''" :class="{ 'is-invalid' : $v.entidad.$error, 'is-valid':!$v.entidad.$invalid }">
                                            <option value="" disabled>SELECCIONE</option>
                                            <option v-for="entidad in arrayEntidad" :key="entidad.id" :value="entidad.id"  v-text="entidad.entidad"></option>                        
                                        </select>                                        
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.entidad.required">Este campo es Requerido</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-control-label" for="text-input">Matricula</label>
                                        <input type="text" v-model="matricula" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.matricula.$error, 'is-valid':!$v.matricula.$invalid }">
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.matricula.required">Este campo es Requerido</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-control-label" for="text-input">Gran Unidad</label>
                                        <select class="form-control" v-model="g_unidad" :class="{ 'is-invalid' : $v.g_unidad.$error, 'is-valid':!$v.g_unidad.$invalid }">
                                            <option value="" disabled>SELECCIONE</option>
                                            <option v-for="gunidad in arrayGranUnidad" :key="gunidad.id" :value="gunidad.id"  v-text="gunidad.gran_unidad"></option>                        
                                        </select>                                        
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.g_unidad.required">Este campo es Requerido</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-control-label" for="text-input">Unidad</label>
                                        <input type="text" v-model="unidad" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.unidad.$error, 'is-valid':!$v.unidad.$invalid }">
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.unidad.required">Este campo es Requerido</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button type="button" class="btn btn-danger" @click="nextStep"><i class="fas fa-forward"></i>&nbsp; SIGUIENTE</button>
                                </div>
                        </div>
                        <div class="step" v-if="currentStep === 2">
                            <h3><i class="fas fa-inbox"></i>&nbsp;PASO 2: INFORMACIÓN DE LA AERONAVE</h3>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Fabrica</label>
                                    <input type="text" v-model="fabrica" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.fabrica.$error, 'is-valid':!$v.fabrica.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.fabrica.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Modelo</label>
                                    <input type="text" v-model="modelo" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.modelo.$error, 'is-valid':!$v.modelo.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.modelo.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Serie</label>
                                    <input type="text" v-model="serie" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.serie.$error, 'is-valid':!$v.serie.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.serie.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-3">
                                  <label class="form-control-label" for="text-input">Estado</label>
                                  <input type="text" v-model.trim="estado" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.estado.$error, 'is-valid':!$v.estado.$invalid }">
                                  <div class="invalid-feedback">
                                      <span v-if="!$v.estado.required">Este campo es Requerido</span>
                                      <span v-else-if="!$v.estado.letrasSpanish">Solo letras</span>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <label class="form-control-label" for="text-input">Fecha de Fabricación</label>
                                  <input type="text" v-model="fech_fabricacion" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.fech_fabricacion.$error, 'is-valid':!$v.fech_fabricacion.$invalid }">
                                  <div class="invalid-feedback">
                                      <span v-if="!$v.fech_fabricacion.required">Este campo es Requerido</span>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <label class="form-control-label" for="text-input">Fecha de Ingreso</label>
                                  <input type="text" v-model.trim="fech_ingreso" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.fech_ingreso.$error, 'is-valid':!$v.fech_ingreso.$invalid }">
                                  <div class="invalid-feedback">
                                      <span v-if="!$v.fech_ingreso.required">Este campo es Requerido</span>
                                      <span v-else-if="!$v.fech_ingreso.letrasSpanish">Solo letras</span>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <label class="form-control-label" for="text-input">Documento de Ingreso</label>
                                  <input type="text" v-model="doc_ingreso" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.doc_ingreso.$error, 'is-valid':!$v.doc_ingreso.$invalid }">
                                  <div class="invalid-feedback">
                                      <span v-if="!$v.doc_ingreso.required">Este campo es Requerido</span>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <label class="form-control-label" for="text-input">Nº Documento de Ingreso</label>
                                  <input type="text" v-model.trim="nro_doc_ingreso" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.nro_doc_ingreso.$error, 'is-valid':!$v.nro_doc_ingreso.$invalid }">
                                  <div class="invalid-feedback">
                                      <span v-if="!$v.nro_doc_ingreso.required">Este campo es Requerido</span>
                                      <span v-else-if="!$v.nro_doc_ingreso.letrasSpanish">Solo letras</span>
                                  </div>
                              </div>
                            </div>
                            <div class="form-group row">
                                
                                
                                  
                                
                            </div>
                            <div class="form-group row">
                                
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <div class="row">
                                        <template v-if="v == 0">
                                            <img :src="'/img/avatar_aeronave.jpg'" width="150px" height="150px" style="border: 1.5px solid black; text-align: center">
                                        </template>
                                        <template v-else>
                                            <img :src="imagen" width="150px" height="150px" style="border: 1.5px solid black; text-align: center">
                                        </template> 
                                    </div>                       
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Fotografia</label>
                                    <input type="file" class="form-control" @change="obtenerImagen" accept="image/*" v-bind:class="{ 'is-invalid': $v.fotografia.$error, 'is-valid':!$v.fotografia.$invalid }">
                                    <div class="invalid-feedback">
                                        <div v-if="!$v.fotografia.required">Por favor, carga tu fotografia.</div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="form-group row">
                                <button type="button" class="btn btn-primary" @click="previousStep"><i class="fas fa-backward"></i>&nbsp; ANTERIOR</button>
                                &nbsp;
                                <button type="button" class="btn btn-danger" @click="nextStep"><i class="fas fa-forward"></i>&nbsp; SIGUIENTE</button>
                            </div>
                        </div>
                        <!-- Paso 2 -->
                        <div class="step" v-if="currentStep === 3">
                          <h3><i class="fas fa-inbox"></i>&nbsp;PASO 3: INFORMACIÓN DEL (DE LOS) MOTOR (MOTORES)</h3>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Fabrica</label>
                                    <input type="text" v-model="fabrica_motor" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.fabrica_motor.$error, 'is-valid':!$v.fabrica_motor.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.fabrica_motor.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Modelo</label>
                                    <input type="text" v-model="modelo_motor" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.modelo_motor.$error, 'is-valid':!$v.modelo_motor.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.modelo_motor.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Serie</label>
                                    <input type="text" v-model="serie_motor" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.serie_motor.$error, 'is-valid':!$v.serie_motor.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.serie_motor.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Estado</label>
                                    <input type="text" v-model.trim="estado_motor" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.estado_motor.$error, 'is-valid':!$v.estado_motor.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.estado_motor.required">Este campo es Requerido</span>
                                        <span v-else-if="!$v.estado_motor.letrasSpanish">Solo letras</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                              
                                
                                
                            </div>
                            <div class="form-group row">
                                
                                
                                  
                                
                            </div>
                            <div class="form-group row">
                                
                                
                            </div>
                            <div class="form-group row">
                                
                            </div>
                            <div class="form-group row">
                                <button type="button" class="btn btn-primary" @click="previousStep"><i class="fas fa-backward"></i>&nbsp; ANTERIOR</button>
                                &nbsp;
                                <button type="button" class="btn btn-danger" @click="nextStep"><i class="fas fa-forward"></i>&nbsp; SIGUIENTE</button>
                            </div>
                        </div>

                    <!-- Paso 3 -->
                    <div class="step" v-if="currentStep === 4">
                      <h3><i class="far fa-folder"></i>&nbsp;PASO 4: DOCUMENTACIÓN DE LA AERONAVE</h3>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-12" style="background-color:gold;">
                                    <label class="form-control-label" for="text-input">LOS DOCUMENTOS DEBEN ESTAR EN FORMATO PDF <i class="fa fa-file-pdf"></i>.</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="form-control-label" for="text-input">GRADO Y NOMBRE: {{matricula}} {{modelo}} {{nombre}}</label>
                                </div>
                            </div>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 12pt;">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">DOCUMENTO</th>
                                            <th class="text-center">ARCHIVO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                       
                                        
                                        
                                
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group row">
                                <button type="button" class="btn btn-primary" @click="previousStep"><i class="fas fa-backward"></i>&nbsp; ANTERIOR</button>
                                &nbsp;
                                <button type="button" class="btn btn-danger" @click="CrearAeronave()"><i class="fas fa-save"></i>&nbsp; GUARDAR</button>
                            </div>
                    </div>
                    </form>
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
  import { required, between, minLength, maxLength, alpha, numeric, email, helpers, date} from "vuelidate/lib/validators";
  export default {
    data() {
      return {
        // INICIO VARIABLES DGAE
        
        currentStep: 1,
        // PASO 1
        entidad : '',
        matricula : '',
        g_unidad : '',
        unidad : '',
        // PASO 2
        fabrica : '',
        modelo : '',
        serie : '',
        estado : '',
        fech_fabricacion : '',
        fech_ingreso : '',
        doc_ingreso : '',
        nro_doc_ingreso : '',
        fotografia : '',
        // PASO 3
        fabrica_motor : '',
        modelo_motor : '',
        serie_motor : '',
        estado_motor : '',

        arrayEntidad : [],
        arrayGranUnidad : [],



        
        arrayCategoria : [],
        arrayGrado : [],
        arrayNacionalidad : [],
        arrayLicencia : [],
        arrayHabilitacion : [],
        arrayCompetenciaLinguistica : [],
        arraySexo : ['MASCULINO','FEMENINO'],
        arrayDatAeronave : [],
        arrayNacionalidadA : [],
        v : 0,
        // vA : 0,
        // vCI : 0,
  
        
  
        // FIN VARIABLES DGAE
        arrayPersonal : [],
        arrayDatosFisicos: [],
        datos_fisicos : [],
        listaPersonal: [],
        criterio: "p.modelo",
        buscar:"",
        setTiemoutBuscador: '',
        isHidden: true,
        datfis2 : 1,
  
          
        pagination: {
              'total'         :   0,
              'current_page'  :   0,
              'per_page'      :   0,
              'last_page'     :   0,
              'from'          :   0,
              'to'            :   0,
          },
      offset : 3,
      }
    },
  
    validations: {
            entidad : { required },
            matricula : { required },
            g_unidad : { required },
            unidad : { required },
            fabrica : { required },
            modelo : { required },
            serie : { required },
            estado : { required },
            fech_fabricacion : { required },
            fech_ingreso : { required },
            doc_ingreso : { required },
            nro_doc_ingreso : { required },
            fotografia : { required },
            fabrica_motor : { required },
            modelo_motor : { required },
            serie_motor : { required },
            estado_motor : { required },
            // nombre : { required, letrasSpanish: value => /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ ]+$/.test(value) },      
            
            validationGroupPaso1: [
              'entidad',
              'matricula',
              'g_unidad',
              'unidad',
            ],

            validationGroupPaso2: [
            'fabrica',
            'modelo',
            'serie',
            'estado',
            'fech_fabricacion',
            'fech_ingreso',
            'doc_ingreso',
            'nro_doc_ingreso',
            'fotografia',
            ],

            validationGroupPaso3: [
            'fabrica_motor',
            'modelo_motor',
            'serie_motor',
            'estado_motor',
            ],
  
            validationGroupReg: [
            'entidad',
            'matricula',
            'g_unidad',
            'unidad',
            'fotografia',
            'modelo',
            'serie',
            'nombre'],

            validationGroupDocument:[
            ]
          },
  
   computed: {
          isActived   : function(){
              return this.pagination.current_page;
          },
          //creando funcion para calcular los elementos de la paginacion
          pagesNumber : function(){
              //si la pagina llega hasta la ultima pagina esta me va retornar un arrary vacio
              if(!this.pagination.to){
                  return [];
              }
  
              var from =  this.pagination.current_page - this.offset;
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
          },
          imagen(){
              return this.fotografia;
          },
          imagenA(){
              return this.fotografiaA;
          }
      },
    mounted() {
        this.NuevoAeronave();
        // this.listarGranUnidad(this.entidad);
        // this.ListarPersonal(1);
    },
    methods: {

      Atras(){ //DGAE
          this.$router.push({
              name: "DatosAeronaves",  
          });
      },

      nextStep() { //DGAE
          switch (this.currentStep) {
            case 1:
              if(!this.$v.validationGroupPaso1.$invalid){
                this.currentStep++;
              }else{
                this.$v.validationGroupPaso1.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })   
              }
            break;
            case 2:
              if(!this.$v.validationGroupPaso2.$invalid){
                this.currentStep++;
              }else{
                  this.$v.validationGroupPaso2.$touch();
                  Swal.fire({
                      icon: 'warning',
                      title: 'Ingrese todos los datos requeridos',
                      showConfirmButton: false,
                      timer: 2000
                  })   
              }
            break;
            case 3:
              if(!this.$v.validationGroupPaso3.$invalid){
                this.currentStep++;
              }else{
                  this.$v.validationGroupPaso3.$touch();
                  Swal.fire({
                      icon: 'warning',
                      title: 'Ingrese todos los datos requeridos',
                      showConfirmButton: false,
                      timer: 2000
                  })   
              }
            break;
          }
      },

      previousStep() { //DGAE
        if (this.currentStep > 1) {
          this.currentStep--;
        }
      },

      obtenerImagen(e){
          try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.fotografia = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.v = 1;
          } catch (error) {
              
          }
      },

      listarEntidad(){ //DGAE
          let me = this;
          axios
        .post("/listarEntidad", {
          id_nacionalidad : 1,
        })
        .then(function (response) {
          me.arrayEntidad = response.data.entidades
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
      },

      listarGranUnidad(entidad){
        let me = this;
          axios
        .post("/listarGranUnidad", {
          id_entidad : entidad,
        })
        .then(function (response) {
          me.arrayGranUnidad = response.data.gran_unidades
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
      },

      NuevoAeronave(){ //DGAE
        this.$v.validationGroupPaso1.$reset(),
        this.$v.validationGroupPaso2.$reset(),
        this.entidad = '',
        this.matricula = '',
        this.g_unidad = '',
        this.unidad = '',
        this.fabrica = '',
        this.modelo = '',
        this.serie = '',
        this.estado = '',
        this.fech_fabricacion = '',
        this.fech_ingreso = '',
        this.doc_ingreso = '',
        this.nro_doc_ingreso = '',
        this.fotografia = '',
        this.fabrica_motor = '',
        this.modelo_motor = '',
        this.serie_motor = '',
        this.estado_motor = '',
        this.v = 0,
        this.listarEntidad(1);
        this.listarGranUnidad(this.entidad);
      },


  
      CrearAeronave(){ //DGAE
        if(!this.$v.validationGroupDocument.$invalid){
          swal.fire({
              title: '¿Desea registrar?', // TITULO 
              icon: 'question', //ICONO (success, warnning, error, info, question)
              showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
              confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
              cancelButtonColor: '#868077', // COLOR DEL BOTON CANCELAR
              confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
              cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
              buttonsStyling: true,
              reverseButtons: true
              }).then((result) => {
              if (result.value) {
                  let me = this;
                  axios
                  .post("/crearAeronave", {
                    foto : me.fotografia,
                    matricula : me.matricula,
                    modelo : me.modelo,
                    nombre : me.nombre,
                  })
                  .then(function (response) {
                      
                      console.log(response);
                      swal.fire({
                          title: 'Se realizo el registro correctamente', //TITULO
                      });
                      if (!response.data.code) {
                          me.arrayDatAeronave = response.data.aeronave;
                          // me.GenerarCarnet(me.arrayDatAeronave.id_personal);
                          me.Atras();
                          this.$v.$reset();
                      } 
                  })
                  .catch(function (error) {
                      // handle error
                      console.log(error);
                  })
              }else{
                    swal.fire(
                      "Informacion", //TITULO
                      "Solicitud cancelada.", //TEXTO DE MENSAJE
                      "info" // TIPO DE MODAL (success, warnning, error, info)
                  );
              }
          })
        }else{
            this.$v.validationGroupDocument.$touch();
            Swal.fire({
                icon: 'warning',
                title: 'Ingrese todos los datos requeridos',
                showConfirmButton: false,
                timer: 2000
            })
            
        }
      },  
    },
  };
  
  </script>
  
  <style>
  </style>