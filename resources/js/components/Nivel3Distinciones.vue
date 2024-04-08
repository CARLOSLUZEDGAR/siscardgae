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
                    Buscar Distinciones Nivel 3
                  </h3>
              </div>
             <div class="card-body">
                <div class="form-group row d-flex justify-content-left,"> 
                  <div class="col-md-8 ">
                    <div class="input-group">
                      <select class="form-control col-md-4" v-model="criterio">
                          <option disabled value="">Seleccionar</option>
                          <option value="institucion">Institucion</option>
                          <option value="descripcion">Tipo Distincion</option>
                          <option value="distintivo">Distintivo</option>
                          <option value="observacion">Observaciones</option>
                      </select>
                      <input type="text" class="form-control" placeholder="Ingrese dato..." style="text-transform:uppercase;" v-model="buscar" @keyup.enter="listarDistincion3(1,buscar,criterio)">
                      <button class="btn btn-primary btn-flat " type="subnmit" @click="listarDistincion3(1,buscar,criterio)">
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
                  Listar Distinciones Nivel 3
                </h3>&nbsp;&nbsp;
                    <button v-if="$auth.can('insert-distniv3')" type="button" @click="NuevaDistincion3()" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>&nbsp;NUEVO REGISTRO
                    </button>
                    <button v-if="$auth.can('report-distniv3')" type="button" @click="PdfDistincionesNivel3()" class="btn btn-secondary">
                        <i class="far fa-file-pdf"></i>&nbsp;REPORTE
                    </button>
              </div>
              <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                          <th>Opciones</th>
                          <th>Institución</th>
                          <th>Tipo Distincion</th>
                          <th>Distincion</th>
                          <th>Puntaje</th>
                          <th>Observaciones</th>
                          <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr v-for="distincion3 in arrayDistincion3" :key="distincion3.id">
                        <td>
                          <button v-if="$auth.can('edit-distniv3')" type="button" @click="abrirEditar(distincion3)" class="btn btn-warning btn-sm" >
                              <i class="fas fa-edit"></i>
                          </button> &nbsp;
                          <template v-if="distincion3.estado">
                              <button v-if="$auth.can('delete-distniv3')" type="button" class="btn btn-danger btn-sm" @click="DesactivarDistincion3(distincion3.id)">
                                  <i class="far fa-trash-alt"></i>
                              </button>
                          </template>
                          <template v-else>
                              <button v-if="$auth.can('delete-distniv3')" type="button" class="btn btn-info btn-sm" @click="ActivarDistincion3(distincion3.id)">
                                  <i class="far fa-check-square"></i>
                              </button>
                          </template>
                        </td>
                        <td v-text="distincion3.institucion"></td>
                        <td v-text="distincion3.dest2_descripcion"></td>
                        <td v-text="distincion3.descripcion"></td>
                        <td v-text="distincion3.puntaje"></td>
                        <td v-text="distincion3.observacion"></td>
                        <td>
                          <div v-if="distincion3.estado">
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

      <div class="modal fade" id="NuevoDistincion3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">REGISTRAR NUEVA DISTINCION NIVEL 3</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Tipo Distinción</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <select class="form-control" v-model="tipo_distincion" :class="{ 'is-invalid' : $v.tipo_distincion.$error, 'is-valid':!$v.tipo_distincion.$invalid }">
                          <option v-for="dist in arrayDistincion2" :key="dist.id" :value="dist.id">
                              {{dist.desc}}
                          </option>                                              
                      </select>
                      <div class="invalid-feedback">
                          <span v-if="!$v.tipo_distincion.required">Este campo es Requerido</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Distinción</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <input v-model="distincion" :class="{ 'is-invalid' : $v.distincion.$error, 'is-valid':!$v.distincion.$invalid }" class="form-control" placeholder="CNL.EDUARDO AVAROA-CABALLERO" style="text-transform:uppercase;">
                      <div class="invalid-feedback">
                          <span v-if="!$v.distincion.required">Este campo es Requerido</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Asignación</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <select v-model="clasificacion" class=" form-control" :class="{ 'is-invalid' : $v.clasificacion.$error, 'is-valid':!$v.clasificacion.$invalid }">
                          <option disabled value="">SELECCIONE</option>
                          <option value="O">OFICIALES</option>
                          <option value="S">SUBOFICIALES - SAREGENTOS</option>
                          <option value="A">OFICIALES Y SUBOFICIALES - SAREGENTOS</option>
                          <option value="T">OFICIALES, SUBOFICIALES - SAREGENTOS Y PERSONAL CIVIL</option>
                      </select>
                      <div class="invalid-feedback">
                          <span v-if="!$v.clasificacion.required">Este campo es Requerido</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Puntaje</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <input type="number" v-model="puntaje" :class="{ 'is-invalid' : $v.puntaje.$error, 'is-valid':!$v.puntaje.$invalid }" class="form-control" placeholder="CONDECORACIONES" style="text-transform:uppercase;">
                      <div class="invalid-feedback">
                          <span v-if="!$v.puntaje.required">Este campo es Requerido</span>
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
                <button type="button" class="btn btn-primary" @click="RegistrarDistincion3()">REGISTRAR</button>
              </div>
            </div>
              <!-- /.modal-content -->
          </div>
      </div>

      <div class="modal fade" id="EditarDistincion3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">EDITAR REGISTRO DISTINCION NIVEL 3</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Tipo Distinción</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <select class="form-control" v-model="tipo_distincionA">
                          <option v-for="dist in arrayDistincion2" :key="dist.id" :value="dist.id">
                              {{dist.desc}}
                          </option>                                              
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Distinción</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <input v-model="distincionA" class="form-control" style="text-transform:uppercase;">
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Asignación</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <select v-model="clasificacionA" class=" form-control">
                          <option disabled value="">SELECCIONE</option>
                          <option value="O">OFICIALES</option>
                          <option value="S">SUBOFICIALES - SAREGENTOS</option>
                          <option value="A">OFICIALES Y SUBOFICIALES - SAREGENTOS</option>
                          <option value="T">OFICIALES, SUBOFICIALES - SAREGENTOS Y PERSONAL CIVIL</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-3">
                    <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Puntaje</label>
                    </div>
                  </div>
                  <div class="form-group col-md-9">
                    <div class="col-md-12">
                      <input type="number" v-model="puntajeA" class="form-control" style="text-transform:uppercase;">
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
                <button type="button" class="btn btn-primary" @click="ActualizarDistincion3()">ACTUALIZAR</button>
              </div>
            </div>
              <!-- /.modal-content -->
          </div>
      </div>

    </section>
    <!-- /.content -->
  </div>

</template>

<script>
  import { required, between, minLength, maxLength, alpha, numeric, email} from "vuelidate/lib/validators";
  

    export default {
        data() {
          return {
            arrayDistincion3 : [],
            arrayDistincion2 : [],
            
            // Valores para guardar
            tipo_distincion : '',
            distincion : '',
            clasificacion : '',
            puntaje : '',
            observaciones : '',

            // valores para ACTUALZIZAR
            tipo_distincionA : '',
            distincionA : '',
            clasificacionA : '',
            puntajeA : '',
            observacionesA : '',
            id_dist3 : '',

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
          tipo_distincion: { required },
          distincion: { required },
          clasificacion: { required },
          puntaje: { required },
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

          listarDistincion3(page,buscar, criterio){
              let me = this;
              axios
              .post("/listarDistincion3", {
                page : page,
                buscar : buscar.toUpperCase(),
                criterio : criterio,
                
              })
              .then(function (response) {
                  var respuesta= response.data;
                  me.arrayDistincion3 = respuesta.distincion3.data;
                  me.pagination = respuesta.pagination;
              })
              .catch(function (error) {
              console.log(error);
              });
          },

          cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listarDistincion3(page,buscar,criterio);
          },

          selectDistincion2(){
            let me=this;
            var url= '/listarDist2';
            axios
            .get(url)
            .then(function (response) {
                
                me.arrayDistincion2 = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
          },

          NuevaDistincion3(){ 
            this.tipo_distincion = '';
            this.distincion = '';
            this.clasificacion = '';
            this.puntaje = '';
            this.observaciones = '';
            this.selectDistincion2();
            $('#NuevoDistincion3').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
          },

          RegistrarDistincion3(){ 
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
                        .post("/registrarDistincion3", {
                            dist2_cod: me.tipo_distincion,
                            descripcion: me.distincion.toUpperCase(),
                            clasificacion: me.clasificacion,
                            puntaje: me.puntaje,
                            observacion: me.observaciones.toUpperCase()
                        })
                        .then(function (response) {
                            
                            $('#NuevoDistincion3').modal('hide'); 
                            swal.fire(
                            'Registrado',
                            'El registro se realizó con éxito',
                            'success'
                            )
                            me.listarDistincion3(1, '', 'descripcion'); 
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

          abrirEditar(distincion3){ 
            this.tipo_distincionA = distincion3.dist2_cod,
            this.distincionA = distincion3.descripcion,
            this.clasificacionA = distincion3.clasificacion,
            this.puntajeA = distincion3.puntaje,
            this.observacionesA = distincion3.observacion,
            this.id_dist3 = distincion3.id,
            this.selectDistincion2();
            $('#EditarDistincion3').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
          },

          ActualizarDistincion3(){ 
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
                    .put("/editarDistincion3", { 
                        id_dist3: me.id_dist3,
                        tipo_dist: me.tipo_distincionA,
                        distincion: me.distincionA.toUpperCase(),
                        asignacion: me.clasificacionA,
                        puntaje: me.puntajeA,
                        observacion: me.observacionesA.toUpperCase()

                    })
                    .then(function (response) {
                        
                        $('#EditarDistincion3').modal('hide'); 
                        swal.fire(
                            'Actualizado',
                            'El registro se actualizó con éxito',
                            'success'
                            )
                        me.listarDistincion3(1, '', 'descripcion');
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
                }
            })
          },
             

          DesactivarDistincion3(id){ //DOS_2
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
                .put("/desactivarDistincion3", { //Se pone put para el envio de datos
                    'id':id
                })
                .then(function (response) {
                    
                    me.datos = response.data;
                    me.listarDistincion3(1, '', 'descripcion'); //Al momento de cerrar esto actualiza la lista

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

          ActivarDistincion3(id){ //DOS_2
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
                .put("/activarDistincion3", { //Se pone put para el envio de datos
                    'id':id
                })
                .then(function (response) {
                    
                    me.datos = response.data;
                    me.listarDistincion3(1, '', 'descripcion'); 

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

          PdfDistincionesNivel3(){
            window.open('http://sipefab.fab.bo/PdfDistincionesNivel3');
          //  window.open('http://sipefab.fab.bo/PdfDistincionesNivel3');
          },

        },

        mounted() {
            this.listarDistincion3(1, this.buscar, this.criterio); //Esto nos sirve para listar al principio la lista destinos
        },
    }
</script>

<style lang="scss" scoped>

</style>