<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              SIPEFAB
              <small>2.0.0</small>
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
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-globe-americas"></i>
                  ASCENSOS PERSONAL
                </h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio">
                                <option value="per_ci">C. de Identidad</option>
                                <option value="per_cm">Carnet Militar</option>
                                <option value="per_promo">Cod. Promocion</option>
                                <option value="promoact">Promocion</option>
                                <option value="per_nombre">Nombre</option>
                            </select><!-- el arroba @ es el simplificado del v-on -->
                            <input type="text" v-model="buscar" @keyup.enter="listarPersonal(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" @click="listarPersonal(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                  <table class="table table-bordered table-striped table-sm">
                      <thead>
                          <tr>
                              <th>Cod. Promoción</th>
                              <th>Grado</th>
                              <th>Ap. Paterno</th>
                              <th>Ap. Materno</th>
                              <th>Nombres</th>
                              <th>C. Identidad</th>
                              <th>C. Militar</th>
                              <th>Acción</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="personal in arrayPersonal" :key="personal.per_codigo" > 
                              <td v-text="personal.per_promo"></td>
                              <td v-text="personal.gra_abreviatura+' '+personal.estu_abreviatura"></td>
                              <td v-text="personal.per_paterno"></td>
                              <td v-text="personal.per_materno"></td>
                              <td v-text="personal.per_nombre"></td>
                              <td v-text="personal.per_ci"></td>
                              <td v-text="personal.per_cm"></td>
                              <td style="width:100px; text-align:center">
                                  <button type="button" @click="EnvioDatos(personal.per_codigo)" class="btn btn-success btn-sm">
                                      <i class="far fa-eye"></i>
                                  </button>
                                  <button type="button" @click="generarReporte(personal.per_codigo)" class="btn btn-warning btn-sm">
                                      <i class="far fa-file-pdf"></i>
                                  </button>
                              </td>
                          </tr>
                      </tbody>
                  </table>
                  <nav>
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
                          <li class="page-item" v-if="pagination.last_page">
                              <a class="page-link" @click.prevent="cambiarPagina(pagination.last_page,buscar,criterio)">>></a>
                          </li>
                      </ul>
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
        }
    },
  mounted() {
    this.listarPersonal(this.buscar,this.criterio);
  },
  methods: {
    cambiarPagina(page,buscar,criterio){
        let me = this;
        //actualizando la pagina actual
        me.pagination.current_page = page;
        me.listarPersonal(page,buscar,criterio);
    },
    listarPersonal(page,buscar,criterio){
      let me = this;
      //declarando la variable url
      var url = '/persona?page=' + page + '&buscar=' + this.buscar + '&criterio=' + criterio;
      axios.get(url).then(function (response) {
        
          var respuesta = response.data;
          me.arrayPersonal = respuesta.personals.data;
          me.pagination = respuesta.pagination;
        
      })
      .catch(function (error) {
          console.log(error);
      })
    },
    EnvioDatos(datos){
        this.$router.push({
            name: "Ascensopersonal",
            //ENVIO DE DATOS
            params:{
                a: datos
            }
            
        });
    },
    generarReporte(per_codigo){
      window.open('http://sipefab.fab.bo/listarAscensoReporte?per_codigo='+per_codigo);
    },
  }
};

</script>

<style>
</style>