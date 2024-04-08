<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
             Reportes
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Elegir Escalafon</li>
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
                    <div class="col-md-6">
                        <div class="input-group">
                        <!-- select combo patr abuscar-->
                        <label class="form-control-label col-md-4" for="text-input">EFECTIVO:</label>
                            <select class="form-control col-md-6" v-model="efectivo">
                                <!-- values como la base de datos -->
                                <option value="" disabled>SELECCIONE</option>
                                <option value="O">OFICIALES</option>
                                <option value="ST" >SOFS/SGTOS TECNICOS</option>
                                <option value="SM">SOFS/SGTOS DE MUSICA</option>
                                <option value="C">PERSONAL CIVIL</option>
                                <!-- <option value="T">GENERAL</option> -->
                                <!-- <option value="per_paterno">APELLIDO PATERNO</option> -->
                            </select>
                        </div>
                        <div class="row p-2 bd-highlight justify-content-center">
                            <template v-if="efectivo == 'O' || efectivo == 'ST' || efectivo == 'SM' || efectivo == 'C' || efectivo == 'T'">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-secondary btn-sm btn-block" @click="seleccion(efectivo)">
                                        <i class="far fa-file-alt" aria-hidden="true">  GENERAR CUADRO</i>
                                    </button>
                                </div>
                            </template>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras()">
                                    <i class="fas fa-reply" aria-hidden="true">  ATRAS</i>
                                </button>
                            </div>
                        </div>
                    </div> 

                    
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Title</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body">
                          Start creating your amazing application!
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          Footer
                        </div>
                        <!-- /.card-footer-->
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
export default {
  data() {
    return {
        cod_reporte : this.$route.params.cod_report,
        efectivo : '',
    }
  },
  mounted() {
    
  },
  computed:{
            
        },
  methods: {

        Atras(){
            this.$router.push({
                name: "PruebaReportes",
                //ENVIO DE DATOS
                // params:{
                //     d: datos
                // }   
            });
        },

        // cuadroPericia(){
        //   window.open('http://127.0.0.1:8000/cuadroPericia');
        // },

        // cuadroEfectivoDetallado(){
        //   window.open('http://127.0.0.1:8000/cuadroEfectivoTotal');
        // },

        // cuadroEgresadoNoEgresado(escalafon){
        //   window.open('http://127.0.0.1:8000/cuadroEgresadoNoEgresado?esc='+escalafon);
        // },
        seleccion(escalafon){
          switch (this.cod_reporte) {
            case 'd' :
                window.open('http://sipefab.fab.bo/cuadroEgresadoNoEgresado?esc='+escalafon);
              break;
            
            case 'l' :
                window.open('http://sipefab.fab.bo/cuadroFamiliaresPersonal?esc='+escalafon);
              break;

            case 's' :
                window.open('http://sipefab.fab.bo/cuadroPromocionCant?esc='+escalafon);
              break;

            case 'f' :
                window.open('http://sipefab.fab.bo/cuadroSituacionPersonal?esc='+escalafon);
              break;

            case 'm' :
                window.open('http://sipefab.fab.bo/cuadroFechaIncorporacion?esc='+escalafon);
              break;
          
            default:
              break;
          }
        },
  },
};

</script>

<style>
</style>