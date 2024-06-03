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
                <!-- <small>Personal</small> -->
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <!-- <li class="breadcrumb-item"><a href="/">Inicio</a></li> -->
                <!-- <li class="breadcrumb-item active">Datos del Personal</li> -->
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
                        <!-- <i class="fas fa-search"></i> -->
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
                            <h3><i class="fas fa-inbox"></i>&nbsp;PASO 1: INFORMACIÓN DE LA AERONAVE</h3>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Matricula</label>
                                    <input type="text" v-model="matricula" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.matricula.$error, 'is-valid':!$v.matricula.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.matricula.required">Este campo es Requerido</span>
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
                                    <label class="form-control-label" for="text-input">Nombre</label>
                                    <input type="text" v-model.trim="nombre" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.nombre.$error, 'is-valid':!$v.nombre.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.nombre.required">Este campo es Requerido</span>
                                        <span v-else-if="!$v.nombre.letrasSpanish">Solo letras</span>
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
                                <button type="button" class="btn btn-danger" @click="nextStep"><i class="fas fa-forward"></i>&nbsp; SIGUIENTE</button>
                            </div>
                        </div>
                        <!-- Paso 2 -->
                        <div class="step" v-if="currentStep === 2">
                            <h3><i class="far fa-folder"></i>&nbsp;PASO 2: DOCUMENTACIÓN DE LA AERONAVE</h3>
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
                                <!-- <button type="button" class="btn btn-danger" @click="nextStep"><i class="fas fa-forward"></i>&nbsp; SIGUIENTE</button> -->
                                <button type="button" class="btn btn-danger" @click="CrearAeronave()"><i class="fas fa-address-card"></i>&nbsp; GUARDAR/GENERAR</button>
                            </div>
                        </div>

                    <!-- Paso 3 -->
                    <div class="step" v-if="currentStep === 3">
                        <h3>Paso 3: Confirmación</h3>
                        <p>Por favor, confirma la información:</p>
                        <p>Nombre: {{ nombre }}</p>
                        <p>Email: {{ nombre }}</p>
                        <p>Teléfono: {{ nombre }}</p>
                        <p>Dirección: {{ nombre }}</p>
                        <button type="button" @click="previousStep">Anterior</button>
                        <button type="submit">Enviar</button>
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
        fotografia : '',
        matricula : '',
        modelo : '',
        nombre : '',
        
        arrayCategoria : [],
        arrayEntidad : [],
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
  
        na_pais : '',
        na_abreviatura : '',
        na_nacionalidad : '',
        vNN : 0,
        en_pais : '',
        en_entidad : '',
        en_sigla : '',
        vNE : 0,
  
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
            fotografia: { required },
            matricula: { required },
            modelo : { required },
            nombre : { required, letrasSpanish: value => /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ ]+$/.test(value) },                   
  
            validationGroupReg: [
            'fotografia',
            'matricula',
            'modelo',
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
        // this.ListarPersonal(1);
    },
    methods: {

      Atras(){ //DGAE
          this.$router.push({
              name: "DatosAeronaves",  
          });
      },

      nextStep() { //DGAE
        if (this.currentStep < 3) {
          if(this.currentStep == 1){
              if(!this.$v.validationGroupReg.$invalid){
                this.currentStep++;
              }else{
                  this.$v.validationGroupReg.$touch();
                  Swal.fire({
                      icon: 'warning',
                      title: 'Ingrese todos los datos requeridos',
                      showConfirmButton: false,
                      timer: 2000
                  })   
              }
          }
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

      NuevoAeronave(){ //DGAE
        this.$v.validationGroupReg.$reset(),
        this.fotografia = '',
        this.matricula = '',
        this.modelo = '',
        this.nombre = '',
        this.v = 0
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