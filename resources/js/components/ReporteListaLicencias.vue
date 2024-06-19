<template>
    <div>
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">            
              <h1>
                <i class="far fa-bookmark"></i>
                REPORTE LICENCIAS EXTENDIDAS
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
                    <!-- <div class="col-sm-4" v-if="$auth.can('view-insert-per')">
                      <button class="btn btn-primary btn-sm float-right" type="submit" @click="Registro()">
                        <i class="fas fa-user-plus"></i>&nbsp; REGISTRAR NUEVO PERSONAL
                      </button>
                    </div> -->
                  </div>  
                </div>
                <div class="card-body">
                    <div class="row d-flex justify-content-center"> 
                        <label for="">RANGO DE FECHAS</label>
                    </div>
                    <div class="row d-flex justify-content-center"> 
                        <div class="col-md-4">
                          <label for="">DE:</label>
                          <input type="date" v-model="fechaDe" class="form-control" :class="{ 'is-invalid' : $v.fechaDe.$error, 'is-valid':!$v.fechaDe.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.fechaDe.required">Este campo es Requerido</span>
                            </div>                        
                        </div>
                        <div class="col-md-4">
                          <label for="">HASTA:</label>
                          <input type="date" v-model="fechaHasta" class="form-control" :class="{ 'is-invalid' : $v.fechaHasta.$error, 'is-valid':!$v.fechaHasta.$invalid }">
                          <div class="invalid-feedback">
                              <span v-if="!$v.fechaHasta.required">Este campo es Requerido</span>
                          </div>                        
                        </div>
                    </div>
                    <br>
                    <div class="row d-flex justify-content-center"> 
                        <button type="button" class="btn btn-danger" @click="GenerarListaLicencia(fechaDe,fechaHasta)"><i class="fa fa-file-pdf"></i>&nbsp; GENERAR</button>
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
  import { required, between, minLength, maxLength, alpha, numeric, email} from "vuelidate/lib/validators";
  export default {
    data() {
      return {
        // INICIO VARIABLES DGAE
        fechaDe : new Intl.DateTimeFormat("az", {
          year: "numeric",
          day: "2-digit",
          month: "2-digit"
        }).format(new Date()),

        fechaHasta : new Intl.DateTimeFormat("az", {
          year: "numeric",
          day: "2-digit",
          month: "2-digit"
        }).format(new Date()), 
   
      }
    },
  
    validations: {
                            
            fechaDe : { required },
            fechaHasta : { required },
                             
          },

    methods: {  
      GenerarListaLicencia(de,hasta){ //DGAE
          this.$v.$reset();
          if(!this.$v.$invalid){
          // window.open('http://sipefab.fab.bo/certificadoDestAscenso?id_p='+id_personal);
          window.open('http://127.0.0.1:8000/lista?de='+de+'&hasta='+hasta);
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
  
      EnvioDatos(datos){
        this.$router.push({
            name: "Personal_datos",
            //ENVIO DE DATOS
            params:{
                e: datos
            }
            
        });
      } 
    },
  };
  
  </script>
  
  <style>
  </style>