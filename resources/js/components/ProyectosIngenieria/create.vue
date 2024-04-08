<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">            
            <h1>
              <i class="far fa-bookmark"></i>
              PROYECTOS DE INGENIERIA
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


  <section class="content">
      <div class="container-fluid">
        


        <!-- card 2 Muestra Datos Personales -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    
                                    <img :src="'/img/personal/'+datos.foto" width="100%" height="100%" class="rounded float-left img-fluid">
                                </div>
                                
                                <div class="col-md-10 d-flex align-items-center">
                                    <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                        <!-- FILA 1 -->
                                        <div class="row p-2 bd-highlight">
                                            <div class="col-md-6">
                                                <dl>
                                                    <dt class="st">NOMBRE</dt>
                                                    <dd class="st">{{ datos.grado }} {{ datos.complemento }} {{ datos.nombre }} {{ datos.paterno }} {{ datos.materno }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-4">
                                                <dl>
                                                    <dt class="st">CARNET MILITAR</dt>
                                                    <dd class="st">{{ datos.cm }}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <!-- FILA 2 -->
                                        <div class="row p-2 bd-highlight">
                                            <div class="col-md-6">
                                                <dl>
                                                    <dt class="st">CARNET DE IDENTIDAD</dt>
                                                    <dd class="st">{{ datos.ci }} {{ datos.expedido }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-4">
                                                <dl>
                                                    <dt class="st">SITUACION MILITAR ACTUAL</dt>
                                                    <dd class="st">{{ datos.nombsit }} - {{datos.nombsub}} - {{datos.nombdet}}</dd>
                                                </dl>
                                            </div>

                                        </div>
                                        <!-- FILA 3 -->
                                        <div class="row p-2 bd-highlight justify-content-center">
                                                <div v-if="$auth.can('insert-proying')" class="col-md-4">                                            
                                                    <button class="btn btn-sm btn-success btn-block" @click="ModalNuevoProyecto()">
                                                        <i class="fa fa-plus-circle"></i> &nbsp;
                                                        Agregar Nuevo Proyecto
                                                    </button>
                                                                                             
                                                </div>
                                                <div class="col-md-4">  
                                                    <router-link type="button" class="btn-danger btn-sm btn position-reverse btn-block" :to="'/proyectIng'" >
                                                    <i class="fas fa-reply"></i> Volver Atrás
                                                    </router-link> 

                                                </div>
                                            
                                        </div>

                                        

                                    </div>
                                    
                                </div>
                            </div>                                                           
                        </div>
                    <!-- /.card -->
                    </div>












           <!-- cUERPO DEL BUSCADOR-->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                
                <div class="row">
                  <div class="col-sm-10">
                    <h3 class="card-title">
                      <i class="fas fa-edit"></i>
                      BUSCADOR
                    </h3>
                  </div>
                  <div class="col-sm-2">
                    
                  </div>
                </div>
              </div>
              <div class="card-body">
                  <div class="row d-flex justify-content-center">
                      <div class="col-md-8">
                          <div class="input-group">
                              <select class="form-control col-md-2" v-model="criterio">
                                    <option value="pr.descripcion">ESTADO</option>
                                    <option value="pp.descripcion"> DESCRIPCION</option>
                              </select>
                              <input type="text" class="form-control col-md-7" style="text-transform:uppercase;" v-model="buscar">
                              <button type="button" class="btn btn-primary form-control col-md-3" @click="ListarProyectos(buscar,criterio)">BUSCAR</button>
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



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Lista de Proyectos
                </h3> &nbsp;
                  
              </div>
              <div class="card-body">
                  <table class="table table-bordered table-striped table-sm">
                      <thead>
                          <tr>
                              <th style="width: 10%" class="text-center">Opciones</th>
                              <th style="width: 15%" class="text-center">Estado de Proyecto</th>
                              <th style="width: 60%" class="text-center">Descripción</th>
                              <th style="width: 15%" class="text-center">Fecha</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="k in listarProyectos">
                                <td class="text-center"> 
                                    <button v-if="$auth.can('edit-proying')" type="button" class="btn btn-warning" @click="ModalEditarProyecto(k)"><i class="fas fa-edit"></i></button>
                                    <button v-if="$auth.can('delete-proying')" type="button" class="btn btn-danger" @click="EliminarProyecto(k.id)"><i class="fas fa-trash-alt"></i></button>

                                </td>
                                <td class="text-center">{{k.estado}}</td>
                                <td>{{k.descripcion}}</td>
                                <td class="text-center">{{k.fecha}}</td>
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
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    

    
    

      <div class="modal fade" id="nuevoproyecto">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">AGREGAR PROYECTO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class='col-md-6'>
                  <label for="">ESTADO PROYECTO</label>
                  <v-select
                      label="descripcion"
                      :options="estados"
                      v-model="Nestado"
                      :class="{ 'is-invalid' : $v.Nestado.$error, 'is-valid':!$v.Nestado.$invalid }"
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
                      <span v-if="!$v.Nestado.required">Este campo es Requerido</span>
                  </div>

                </div>
                <div class='col-md-6'> 
                  <label for="">FECHA</label>
                  <date-picker class="dat" value-type="date" format="DD/MM/YYYY"
                      v-model="Nfecha"
                      :disabled-date="fechaactual"
                      :class="{ 'is-invalid' : $v.Nfecha.$error, 'is-valid':!$v.Nfecha.$invalid }"
                  ></date-picker>
                  <div class="invalid-feedback">
                      <span v-if="!$v.Nfecha.required">Este campo es Requerido</span>
                  </div>
                  <!-- <input type="date" class="form-control " style="text-trasform:uppercase;" v-model="Nfecha"> -->

                </div>
              </div>
              <br>
              <div class="row">
                <div class='col-md-12'>
                  <label for="">DESCRIPCION</label>
                  <textarea class="form-control" :class="{ 'is-invalid' : $v.Ndescripcion.$error, 'is-valid':!$v.Ndescripcion.$invalid }" name="" id="" cols="30" rows="3" v-model="Ndescripcion"></textarea>
                  <div class="invalid-feedback">
                      <span v-if="!$v.Ndescripcion.required">Este campo es Requerido</span>
                      <span v-if="!$v.Ndescripcion.maxLength">Este campo permite solo 500 caracteres.</span>
                  </div>
                </div>
                  
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
              <button type="button" class="btn btn-primary " @click="AgregarProyecto()">AGREGAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->








      <div class="modal fade" id="editarproyecto">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR PROYECTO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class='col-md-6'>
                  <label for="">ESTADO PROYECTO</label>
                  <v-select
                      label="descripcion"
                      :options="estados"
                      v-model="Eestado"
                      
                      :class="{ 'is-invalid' : $v.Eestado.$error, 'is-valid':!$v.Eestado.$invalid }"
                  >
                      //EN CASO QUE NO SE ENCENTRE EL VALOR EN LA LISTA
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
                      <span v-if="!$v.Eestado.required">Este campo es Requerido</span>
                  </div>
                </div>
                <div class='col-md-6'> 
                  <label for="">FECHA</label>
                  <input type="date" class="form-control" :class="{ 'is-invalid' : $v.Efecha.$error, 'is-valid':!$v.Efecha.$invalid }" style="text-trasform:uppercase;" v-model="Efecha">
                  <div class="invalid-feedback">
                      <span v-if="!$v.Efecha.required">Este campo es Requerido</span>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class='col-md-12'>
                  <label for="">DESCRIPCION</label>
                  <textarea class="form-control" name="" id="" :class="{ 'is-invalid' : $v.Edescripcion.$error, 'is-valid':!$v.Edescripcion.$invalid }" cols="30" rows="3" v-model="Edescripcion"></textarea>
                  <div class="invalid-feedback">
                      <span v-if="!$v.Edescripcion.required">Este campo es Requerido</span>
                      <span v-if="!$v.Edescripcion.maxLength">Este campo permite solo 500 caracteres.</span>
                  </div>
                </div>                  
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
              <button type="button" class="btn btn-primary" @click="EditarProyecto()">EDITAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


    <!-- /.content -->
  </div>
</template>

<script>
import { required, maxLength, between } from 'vuelidate/lib/validators'
export default {
    data() {      
        const today = new Date();
        return {
            listarProyectos: [],
            mostrar: [],
            criterio: "pr.descripcion",
            buscar:"",
            percodigo: this.$route.params.per,  
            Eestado:"",
            Efecha:"",
            Edescripcion:"",  
            Eid:"",
            estados: [],
            idest: '',
            Nestado:"",
            Nfecha: new Date(today.getTime()),
            Ndescripcion:"",
            
            datos: [], //Datos Personales
            
            
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
    validations: {
      Nestado: {required},
      Nfecha: {required},
      Ndescripcion: {required, maxLength: maxLength(500)},
      Eestado: {required},
      Efecha: {required},
      Edescripcion: {required, maxLength: maxLength(500)},
      validationGroup: ['Nestado', 'Nfecha', 'Ndescripcion'],
      validationGroupEdit: ['Eestado', 'Efecha', 'Edescripcion'],
      
    },
    mounted() {
        this.ListarProyectos(1,this.buscar,this.criterio);
        this.MostrarPersona();
        
    },

    computed: {
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


    methods: {        
        fechaactual(date){
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return  date > new Date(today.getTime());
        },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.ListarProyectos(page,buscar,criterio);
        },

        ListarProyectos(page,buscar,criterio){
            let me =this;
            axios
            .post("/listarProyectos", {
                 page: page,
                 buscar: buscar.toUpperCase(),
                 criterio: criterio,
                 percodigo: me.percodigo,
          })
          .then(function (response) {
                
                me.listarProyectos = response.data.datos.data;
                me.pagination =response.data.pagination

          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },
        
        MostrarPersona(){
            let me = this;
            
            axios
            .post("/listarDatosPersonalSituacion", {
                percodigo: me.percodigo
            })
            .then(function (response) {
                
                me.datos=response.data; 
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        EstadoProyecto(){
            let me = this;
            axios
            .get('/estadoProyecto')
            .then(function (response) {
                  
                  me.estados = response.data;
          //Respuesta de la peticion
            })
           .catch(function (error) {
           // handle error
           console.log(error);
           });

        },

        EditarProyecto(){
          this.$v.$reset()
          if (!this.$v.validationGroupEdit.$invalid) {
            swal.fire({
              title: '¿Usted esta seguro de editar este proyecto?', // TITULO 
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
                if (me.Eestado.id) {
                  var est = me.Eestado.id
                } else {
                  var est = me.idest
                }
                axios
              .put('/editarProyecto', {
                  id: me.Eid,
                  estado: est,
                  fecha: me. Efecha,
                  descripcion: me.Edescripcion
                })
                .then(function (response) {
                  console.log('aca elimino');
                  
                  $('#editarproyecto').modal('hide'); ///permite cerrar el modal al terminar el editado
                  me.ListarProyectos(1,me.buscar,me.criterio);
                  swal.fire(
                      "Editado", //TITULO
                      "Se edito correctamente el proyecto.", //TEXTO DE MENSAJE
                      "success" // TIPO DE MODAL (success, warning, error, info)
                  );
                })
                .catch(function (error) {
                  // handle error
                  console.log(error);
                })

              }else{
              
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


        AgregarProyecto(){
            this.$v.$reset()
            if (!this.$v.validationGroup.$invalid) {

              swal.fire({
              title: '¿Usted esta seguro de agregar este proyecto?', // TITULO 
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
                .post('/agregarProyecto', {
                  percod: me.percodigo,
                  estado: me.Nestado.id,
                  fecha: me.Nfecha,
                  descripcion: me.Ndescripcion
                })
                .then(function (response) {
                  
                  $('#nuevoproyecto').modal('hide'); ///permite cerrar el modal al terminar el editado
                  me.ListarProyectos(1,me.buscar,me.criterio);
                  me.cerrar()
                  swal.fire(
                      "Agregado", //TITULO
                      "Se agrego correctamente el proyecto.", //TEXTO DE MENSAJE
                      "success" // TIPO DE MODAL (success, warning, error, info)
                  );
                })
                .catch(function (error) {
                  // handle error
                  console.log(error);
                })

              }else{
              
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

        ModalNuevoProyecto(){          
          this.EstadoProyecto()
           $('#nuevoproyecto').modal('show'); ///permite abrir el modal al hacer click en el boton agregar

        },



        ModalEditarProyecto(p){
          console.log(p);
          this.Eestado=p.estado,
          this.Efecha=p.fecha,
          this.Edescripcion=p.descripcion,
          this.Eid=p.id,
          this.idest = p.proy_cod,
          this.EstadoProyecto(),
          $('#editarproyecto').modal('show'); ///permite abrir el modal al hacer click en el boton editar
        },


        EliminarProyecto(id){

            swal.fire({
            title: '¿Usted esta seguro de eliminar este proyecto?', // TITULO 
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
              //SI SE DA CLIC A ACEPTAR
              let me = this;
              axios
              .post("/eliminarProyecto", {
                idpro: id
              })
              .then(function (response) {
                console.log('eliminar');
                
                 me.ListarProyectos(1,me.buscar,me.criterio);
                 swal.fire(
                  "Eliminado", //TITULO
                  "Se elimino correctamente el proyecto", //TEXTO DE MENSAJE
                  "success" // TIPO DE MODAL (success, warnning, error, info)
                );

                
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })

            }else{
            console.log('no empezamos');
            }
          })        
            

        },

        cerrar(){
          this.Nestado = ''
          this.Nfecha = ''
          this.Ndescripcion = ''
        },
        
         Atras(){
          this.$router.push({
              name: "ProyectIng"
          });
        },
    },
};

</script>

<style>
</style>