<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">            
            <h1>
              <i class="far fa-bookmark"></i> &nbsp;
              {{unidad.descripcion}}
            </h1>
          </div>
          <!-- <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Modals & Alerts</li>
            </ol>
          </div> -->
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
                  <i class="fas fa-edit"></i>
                  PERSONAL
                </h3>
              </div>
              <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <div class="input-group">
                                <select class="form-control col-md-4" v-model="criterio">
                                    <option value="p.per_nombre">Nombre</option>
                                    <option value="p.per_paterno">Ap. Paterno</option>
                                    <option value="p.per_materno">Ap. Materno</option>
                                    <option value="p.per_cm">Carnet Militar</option>
                                    <option value="p.per_ci">C. de Identidad</option>
                                </select>
                                <input type="text"  class="form-control" style="text-transform:uppercase;" placeholder="Texto a buscar" v-model="buscar">
                                <button type="submit" class="btn btn-primary" @click="ListarPersonal(1,buscar,criterio)"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-wrapper-scroll-y my-custom-scrollbar" style="font-size: 13px;">
                      <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Grado</th>
                                <th class="text-center">Ap. Paterno</th>
                                <th class="text-center">Ap. Materno</th>
                                <th class="text-center">Nombres</th>
                                <th class="text-center">C. Identidad</th>
                                <th class="text-center">C. Militar</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="ds in Apersonal">
                                <td>{{ds.grado}} {{ds.complemento}}</td>
                                <td> {{ds.paterno}} </td>
                                <td> {{ds.materno}}</td>
                                <td> {{ds.nombre}} </td>
                                <td class="text-center">{{ds.ci}} {{ds.expedido}}</td>
                                <td class="text-center">{{ds.cm}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm" @click="RegistroFalta(ds.codigo)">
                                        <i class="fa fa-eye"></i>
                                    </button> &nbsp; &nbsp;
                                    <!-- <button type="button" class="btn btn-danger btn-sm" @click="Imprimir(ds.codigo)">
                                        <i class="fas fa-print"></i>
                                    </button>  -->
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
                          </ul>
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


      <div class="modal fade" data-backdrop="static" id="NuevaAbreviatura">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- <div class="modal-header">
              <h4 class="modal-title">BIENVENIDA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> -->
            <div class="modal-body">
              <div class="row" style="padding-left: 15px; padding-right: 15px; padding-top: 10px; font-size: 20px;">
                Bienvenido al módulo de faltas diciplinarias, para empezar el uso del modulo registre la abreviatura del nombre de su unidad.
              </div>
              <div class="row p-2 bd-highlight justify-content-center">
                <div class="col-md-5">
                    <dl>
                        <dt class="">Ejemplo:</dt>
                        <dd class="">Grupo Aéreo de Caza 31 -> GAC 31</dd>
                    </dl>
                </div>                
              </div>
              <div class="row p-2 bd-highlight justify-content-center">
                  <div class="col-md-6">
                    <label for="">Abreviatura:</label>
                    <input type="text" :class="{ 'is-invalid' : $v.abreviatura.$error, 'is-valid':!$v.abreviatura.$invalid }" @keypress="alphanumeric" style="text-transform:uppercase;" class="form-control" v-model="abreviatura">
                    <div class="invalid-feedback">
                        <span v-if="!$v.abreviatura.required">Este campo es Requerido</span>                                    
                        <span v-if="!$v.abreviatura.maxLength">Este campo permite solo 255 caracteres.</span>
                    </div>
                  </div>                  
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-primary" @click="GuardarAbreviatura">
                  Guardar
              </button>
              <button class="btn btn-sm btn-danger" @click="Atras()">
                  Volver al Menú
              </button>
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
import { required, maxLength, between } from 'vuelidate/lib/validators'
export default {
  data() {
    return {
      /**
       * Valor de recuperacion
       */
      Apersonal: [],
      Asancionador:[],
      unidad: [],
      /**
       * Variables paginacion y buscador
       */
      pagination : {
        'total' : 0,
        'current_page' : 0,
        'per_page' : 0,
        'last_page' : 0,
        'from' : 0,
        'to' : 0,
      },
      offset : 3,
      criterio : 'p.per_cm',
      buscar : '',
      /**
       * agregar abreviatura a la unidad
       */
      abreviatura: '',
    }
  },  
  validations: {
    abreviatura: {required},  
  },
  computed:{
    ActivarButton(){
      if (this.abreviatura != '') {
        return false;
      } else {
        return true;
      }

    },
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
    },
  },
  mounted() {
    this.NombreUnidad();
    this.ValidarNombre();
    this.ListarPersonal(1,this.buscar,this.criterio);    
    
  },
  methods: {
    Atras(){
      $('#NuevaAbreviatura').modal('hide');
      this.$router.push({
        name: "Inicio"
      });  
    },
    cambiarPagina(page,buscar,criterio){
      let me = this;
      me.pagination.current_page = page;
      me.ListarPersonal(page,buscar,criterio);
    },
    ListarPersonal(page, buscar, criterio){
      let me = this;
        axios
          .post("/listarPersonalUnidad", {
            page: page,
            buscar: buscar.toUpperCase(),
            criterio: criterio
          })
          .then(function (response) {
            // 
            me.Apersonal = response.data.datos.data;
            me.pagination = response.data.pagination;        
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
    },
    /**
     * Rederigir para registrar Nueva Falta
     */
    RegistroFalta(per_codigo){
        this.$router.push({
            name: "ListaFaltas",
        //ENVIO DE DATOS POR URL
            params:{
                codigo: per_codigo,
                c: 2,
                u: this.unidad.descripcion,
                e: 1,
                fu: 1
            }
        });
    },
    NombreUnidad(){
      let me = this;
      axios
      .get('/nombreUnidad')
      .then(function (response) {
        
          me.unidad = response.data;
      })
      .catch(function (error) {
      // handle error
      console.log(error);
      });
    },
    ValidarNombre(){
      let me = this;
      axios
      .get('/valDestino3Abrev')
      .then(function (response) {
        
        if (response.data == 400) {
          $('#NuevaAbreviatura').modal('show');
        } 
      })
      .catch(function (error) {
      // handle error
      console.log(error);
      });
    },
    GuardarAbreviatura(){
      this.$v.$reset()
      if (!this.$v.$invalid) {
          swal.fire({
              title: '¿Desea guardar esta abreviatura?', // TITULO 
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
                  .post("/guardarAbreviaturaDestino3", {
                      abreviatura: me.abreviatura.toUpperCase(),
                      unidad: me.unidad.id
                  })
                  .then(function (response) {
                      swal.fire(
                          "Aceptado", //TITULO
                          "Se añadio correctamente la falta.", //TEXTO DE MENSAJE
                          "success" // TIPO DE MODAL (success, warnning, error, info)
                      );

                      
                      
                      $('#NuevaAbreviatura').modal('hide');

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
    alphanumeric ($event) { //NUMEROS Y LETRAS
        // console.log($event.keyCode); //keyCodes value
        let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && (keyCode < 48 || keyCode > 57)  && keyCode !== 209 && keyCode !== 241 && keyCode !== 32 && keyCode !== 45) { // 46 is dot
            $event.preventDefault();
        }
    },
  },
};
</script>

<style>
</style>