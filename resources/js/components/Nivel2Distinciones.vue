<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              PREMIOS Y DISTINCIONES
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Distinciones</li>
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
            <!-- card 1 Busqueda Personal -->
           <div class="card card-primary card-outline">
              <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-search"></i>
                    Buscar Distinciones Nivel 2
                  </h3>
              </div>
              <div class="card-body">
                <div class="form-group row d-flex justify-content-left"> 
                  <div class="col-md-8 ">
                    <div class="input-group">
                      <select class="form-control col-md-4" v-model="criterio">
                          <option disabled value="">Seleccionar</option>
                          <option value="institucion">Institucion</option>
                          <option value="descripcion">Tipo Distincion</option>
                          <option value="distintivo">Distintivo</option>
                          <option value="observacion">Observaciones</option>
                      </select>
                      <input type="text" class="form-control" placeholder="Ingrese dato..." style="text-transform:uppercase;" v-model="buscar" @keyup.enter="listarDistincion2(1,buscar,criterio)">
                      <button class="btn btn-primary btn-flat " type="subnmit" @click="listarDistincion2(1,buscar,criterio)">
                          <i class="fas fa-search"></i>&nbsp; Buscar
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- fin card 1 Busqueda Personal -->

            <!-- card 2 Muestra listado Destinos 1 -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-bookmark"></i>
                  Listar Distinciones Nivel 2
                </h3>&nbsp;&nbsp;
                    <button v-if="$auth.can('insert-distniv2')" type="button" @click="NuevaDistincion2()" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>&nbsp;NUEVO REGISTRO
                    </button>
                    <button v-if="$auth.can('report-distniv2')" type="button" @click="PdfDistincionesNivel2()" class="btn btn-secondary">
                        <i class="far fa-file-pdf"></i>&nbsp;REPORTE
                    </button>
              </div>
              <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                          <th>Opciones</th>
                          <th>Institucion</th>
                          <th>Tipo Distinción</th>
                          <th>Distincion</th>
                          <th>Observaciones</th>
                          <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr v-for="distincion2 in arrayDistincion2" :key="distincion2.id">
                        <td>
                          <button v-if="$auth.can('edit-distniv2')" type="button" @click="abrirEditar(distincion2)" class="btn btn-warning btn-sm" >
                              <i class="fas fa-edit"></i>
                          </button> &nbsp;
                          <template v-if="distincion2.estado">
                              <button v-if="$auth.can('delete-distniv2')" type="button" class="btn btn-danger btn-sm" @click="DesactivarDistincion2(distincion2.id)">
                                  <i class="far fa-trash-alt"></i>
                              </button>
                          </template>
                          <template v-else>
                              <button v-if="$auth.can('delete-distniv2')" type="button" class="btn btn-info btn-sm" @click="ActivarDistincion2(distincion2.id)">
                                  <i class="far fa-check-square"></i>
                              </button>
                          </template>
                        </td>
                        <td v-text="distincion2.dest1_descripcion"></td>
                        <td v-text="distincion2.dest2_descripcion"></td>
                        <td v-text="distincion2.distintivo"></td>
                        <td v-text="distincion2.observacion"></td>
                        <td>
                          <div v-if="distincion2.estado">
                              <span class="badge badge-success">Activo</span>
                          </div>
                          <div v-else>
                              <span class="badge badge-danger">Desactivado</span>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div><!-- /.card -->
              
              <div class="card-footer clearfix">
                <ul class="pagination  m-0">
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
              </div>

            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->

      <div class="modal fade" id="NuevoDistincion2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true"> <!-- Modal para registro nuevo CERO -->
          <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">REGISTRAR NUEVA DISTINCION NIVEL 2</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Institución</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <select class="form-control" v-model="institucion" :class="{ 'is-invalid' : $v.institucion.$error, 'is-valid':!$v.institucion.$invalid }">
                          <option v-for="institucion in arrayInstitucion" :key="institucion.id" :value="institucion.id">
                              {{institucion.desc}}
                          </option>                                              
                      </select>
                      <div class="invalid-feedback">
                          <span v-if="!$v.institucion.required">Este campo es Requerido</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Tipo Distincion</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <input v-model="descripcion" :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }" class="form-control" placeholder="CONDECORACIONES GOB" style="text-transform:uppercase;">
                      <div class="invalid-feedback">
                          <span v-if="!$v.descripcion.required">Este campo es Requerido</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Distincion</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <input v-model="distincion" :class="{ 'is-invalid' : $v.distincion.$error, 'is-valid':!$v.distincion.$invalid }" class="form-control" placeholder="CONDECORACIONES" style="text-transform:uppercase;">
                      <div class="invalid-feedback">
                          <span v-if="!$v.distincion.required">Este campo es Requerido</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Observaciones</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <input v-model="observaciones" :class="{ 'is-invalid' : $v.observaciones.$error, 'is-valid':!$v.observaciones.$invalid }" class="form-control" placeholder="Ingrese observaciones" style="text-transform:uppercase;">
                      <div class="invalid-feedback">
                          <span v-if="!$v.observaciones.required">Este campo es Requerido</span>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-primary" @click="RegistrarDistincion2()">REGISTRAR</button>
              </div>
            </div>
              <!-- /.modal-content -->
          </div>
            <!-- /.modal-dialog -->
      </div>
        <!-- /.modal -->

    <div class="modal fade" id="EditarDistincion2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true"> <!-- Modal para registro nuevo CERO -->
        <div class="modal-dialog modal-primary modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR DATOS DISTINCION NIVEL 2</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group row">
                <div class="form-group col-md-3">
                  <div class="col-md-12">
                    <label class="form-control-label" for="text-input">Institución</label>
                  </div>
                </div>
                <div class="form-group col-md-9">
                  <div class="col-md-12">
                    <select class="form-control" v-model="institucionA">
                        <option v-for="institucion in arrayInstitucion" :key="institucion.id" :value="institucion.id">
                            {{institucion.desc}}
                        </option>                                              
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="form-group col-md-3">
                  <div class="col-md-12">
                    <label class="form-control-label" for="text-input">Tipo Distincion</label>
                  </div>
                </div>
                <div class="form-group col-md-9">
                  <div class="col-md-12">
                    <input v-model="descripcionA" class="form-control" placeholder="CONDECORACIONES GOB" style="text-transform:uppercase;">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="form-group col-md-3">
                  <div class="col-md-12">
                    <label class="form-control-label" for="text-input">Distincion</label>
                  </div>
                </div>
                <div class="form-group col-md-9">
                  <div class="col-md-12">
                    <input v-model="distincionA" class="form-control" placeholder="CONDECORACIONES" style="text-transform:uppercase;">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="form-group col-md-3">
                  <div class="col-md-12">
                    <label class="form-control-label" for="text-input">Observaciones</label>
                  </div>
                </div>
                <div class="form-group col-md-9">
                  <div class="col-md-12">
                    <input v-model="observacionesA" class="form-control" placeholder="Ingrese observaciones" style="text-transform:uppercase;">
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
              <button type="button" class="btn btn-primary" @click="ActualizarDistincion2()">ACTUALIZAR</button>
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
  import { required, between, minLength, maxLength, alpha, numeric, email} from "vuelidate/lib/validators";
  

    export default {
        data() {
          return {
            arrayDistincion2 : [],
            arrayInstitucion : [],
            
            // Valores para guardar
            institucion : '',
            descripcion : '',
            distincion : '',
            observaciones : '',

            // valores para ACTUALZIZAR
            institucionA : '',
            descripcionA : '',
            distincionA : '',
            observacionesA : '',
            id_dist2 : '',

            pagination : {
                'total' : 0,         
                'current_page' : 0, 
                'per_page' : 0, 
                'last_page' : 0, 
                'from' : 0, 
                'to' : 0, 
            },
            offset : 3, 
            buscar: "",
            criterio: 'institucion',

          }
        },

        validations: {
          institucion: { required },
          descripcion: { required },
          distincion: { required },
          observaciones: { required }
        },

        computed:{
          isActived: function(){
              return this.pagination.current_page;
          },
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

          listarDistincion2(page,buscar, criterio){
              let me = this;
              axios
              .post("/listarDistincion2", {
                page : page,
                buscar : buscar.toUpperCase(),
                criterio : criterio,
                
              })
              .then(function (response) {
                  var respuesta= response.data;
                  me.arrayDistincion2 = respuesta.distincion2.data;
                  me.pagination = respuesta.pagination;
              })
              .catch(function (error) {
              console.log(error);
              });
          },

          cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listarDistincion2(page,buscar,criterio);
          },

          selectInstitucion(){
            let me=this;
            var url= '/listarInstitucion';
            axios
            .get(url)
            .then(function (response) {
                
                me.arrayInstitucion = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
          },

          NuevaDistincion2(){ 
            this.descripcion = '';
            this.distincion = '';
            this.observaciones = '';
            this.selectInstitucion();
            $('#NuevoDistincion2').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
          },

          RegistrarDistincion2(){ 
            if(!this.$v.$invalid){
              swal.fire({
                    title: 'esta seguro de registrar Nueva Distincion?', 
                    icon: 'question', 
                    showCancelButton: true, 
                    confirmButtonColor: 'info', 
                    cancelButtonColor: '#868077', 
                    confirmButtonText: 'Confirmar', 
                    cancelButtonText: 'Cancelar', 
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                      if (result.value) { 

                        let me = this;
                        axios
                        .post("/registrarDistincion2", {
                            institucion: me.institucion,
                            descripcion: me.descripcion.toUpperCase(),
                            distincion: me.distincion.toUpperCase(),
                            observacion: me.observaciones.toUpperCase()
                        })
                        .then(function (response) {
                            
                            $('#NuevoDistincion2').modal('hide'); 
                            swal.fire(
                            'Registrado',
                            'El registro se realizó con éxito',
                            'success'
                            )
                            me.listarDistincion2(1, '', 'descripcion'); 
                        })
                        .catch(function (error) {
                            
                            console.log(error);
                        });

                      }
                    })
            }else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese los datos requeridos',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
          },

          abrirEditar(distincion2){ 
            this.institucionA = distincion2.dist1_cod,
            this.descripcionA = distincion2.dest2_descripcion,
            this.distincionA = distincion2.distintivo,
            this.observacionesA = distincion2.observacion,
            this.id_dist2 = distincion2.id,
            this.selectInstitucion();
            $('#EditarDistincion2').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
          },

          ActualizarDistincion2(){ 
            swal.fire({
                title: 'Esta seguro de actualizar Datos?', // TITULO 
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
                    .put("/editarDistincion2", { 
                        id_dist2: me.id_dist2,
                        institucion: me.institucionA,
                        descripcion: me.descripcionA.toUpperCase(),
                        distincion: me.distincionA.toUpperCase(),
                        observacion: me.observacionesA.toUpperCase()

                    })
                    .then(function (response) {
                        
                        $('#EditarDistincion2').modal('hide'); 
                        swal.fire(
                            'Actualizado',
                            'El registro se actualizó con éxito',
                            'success'
                            )
                        me.listarDistincion2(1, '', 'descripcion');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
                }
            })
          },
             

          DesactivarDistincion2(id){ //DOS_2
            swal.fire({
              title: '¿Está seguro de Desactivar distinción ?', // TITULO 
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
                .put("/desactivarDistincion2", { //Se pone put para el envio de datos
                    'id':id
                })
                .then(function (response) {
                    
                    me.datos = response.data;
                    me.listarDistincion2(1, '', 'descripcion'); //Al momento de cerrar esto actualiza la lista

                    swal.fire(
                        "Aceptado", //TITULO
                        "Se ha desactivado la distincion.", //TEXTO DE MENSAJE
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

          ActivarDistincion2(id){ //DOS_2
            swal.fire({
              title: '¿Está seguro de Activar distinción ?', // TITULO 
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
                .put("/activarDistincion2", { //Se pone put para el envio de datos
                    'id':id
                })
                .then(function (response) {
                    
                    me.datos = response.data;
                    me.listarDistincion2(1, '', 'descripcion'); 

                    swal.fire(
                        "Aceptado", //TITULO
                        "Se ha Activado la distincion.", //TEXTO DE MENSAJE
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

          PdfDistincionesNivel2(){
            window.open('http://sipefab.fab.bo/PdfDistincionesNivel2');
          //  window.open('http://sipefab.fab.bo/PdfDistincionesNivel2');
          },

        },

        mounted() {
            this.listarDistincion2(1, this.buscar, this.criterio); //Esto nos sirve para listar al principio la lista destinos
        },
    }
</script>

<style lang="scss" scoped>

</style>