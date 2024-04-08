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
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Imicio</a></li>
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
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-search"></i>
                  Buscar Personal
                </h3>
              </div>
              <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                                <select class="form-control col-md-4" v-model="criterio">
                                    <!-- values como la base de datos -->
                                    <option value="per_cm">Carnet Militar</option>
                                    <option value="per_ci">Carnet de Identidad</option>
                                    <option value="per_paterno">Ap. Paterno</option>
                                    <option value="per_materno">Ap. Materno</option>
                                    <option value="per_nombre">Nombre</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarPersonal(1,buscar,criterio)" class="form-control" placeholder="Ingrese dato..." style="text-transform:uppercase" >
                                <button type="submit" @click="listarPersonal(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button>
                            </div>
                        </div>
                    </div>
                <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                  <template v-if="arrayPersonal.length">  
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr style="width:100px; text-align:center; vertical-align: middle">
                               
                                <th><center>Grado</center></th>
                                <th><center>Ap. Paterno</center></th>
                                <th><center>Ap. Materno</center></th>
                                <th><center>Nombres</center></th>
                                <th><center>C. Identidad</center></th>
                                <th><center>C. Militar</center></th>
                                <th><center>Opciones</center></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="personal in arrayPersonal" :key="personal.id">
                                
                                
                                <td>{{personal.gra_abreviatura}}{{personal.estu_abreviatura}}</td>
                                <td v-text="personal.per_paterno"></td>
                                <td v-text="personal.per_materno"></td>
                                <td v-text="personal.per_nombre"></td>
                                <td v-text="personal.per_ci" style="width:100px; text-align:center"></td>
                                <td v-text="personal.per_cm" style="width:100px; text-align:center"></td>
                                
                                <td style="width:100px; text-align:center">
                                  <button type="button" class="btn btn-success btn-sm" @click="EnvioDatos(personal.per_codigo,personal.subescalafonesid)">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                  </button> &nbsp;
                          
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
                  <div class="form-group row">
                    <nav>
                        <!-- inicio para paginacion -->
                       <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                            </li>
                           
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>
                        <!-- fin paginacion -->
                    </nav>
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
      arrayPersonal : [],
      criterio : 'per_cm',
      buscar : '',
     // page : 0,
      pagination : {
          'total' : 0,
          'current_page' : 0,
          'per_page' : 0,
          'last_page' : 0,
          'from' : 0,
          'to' : 0,
      },
      offset : 3,
    }
  },
  mounted() {
    this.listarPersonal(this.page,this.buscar,this.criterio);
  },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },

            //Calcuar los elementos de la paginacion
            pagesNumber: function() {
                if(!this.pagination.to){
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset *2);
                if( to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while( from <= to){
                    pagesArray.push(from);
                    from ++;
                }
                return pagesArray;
            }
        },
  methods: {
    listarPersonal(page,buscar,criterio){
            let me = this;
            axios
        
          .post("/listarPersonal2", {
            page : page,
            buscar : buscar.toUpperCase(),
            criterio : criterio,
            
          })
          .then(function (response) {
            console.log(response)
            me.arrayPersonal = response.data.personal.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },
        cambiarPagina(page, buscar, criterio){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page= page;
                //Envia la peticion para visualizar la data de esa pagina
                me.listarPersonal(page, buscar, criterio);
            },

        EnvioDatos (per_codigo,subescalafon){
            this.$router.push({
                name: "PersonalCurriculum",
                //ENVIO DE DATOS
                params:{
                    per_codigo : per_codigo,
                    subescalafon : subescalafon  
                }
                
            });
        },

        reportesEspe(){
            this.$router.push({
                name: "EspecialidadReporte",
                
                
            });
        },

        // ordenDestinos(){
        //   window.open('http://192.168.3.77/ordenDestinos');
        // },

  },
};

</script>

<style>
</style>