<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              Cargo
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Cargos</li>
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
                    Buscar Cargo
                  </h3>
              </div>
              <div class="card-body">
                <div class="row  d-flex justify-content-center"> <!-- Para centrear se pone estos codigos -->
                  <div class="col-md-8 ">
                    <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                          <option value="descripcion">Descripcion</option>
                          <option value="asignacion">Asignacion</option>
                      </select>
                      <input type="text" class="form-control col-md-4" placeholder="Ingrese dato..." style="text-transform:uppercase;" v-model="buscar" @keyup.enter="listarCargo(1,buscar,criterio)">
                      <button class="btn btn-primary btn-flat " type="subnmit" @click="listarCargo(1,buscar,criterio)">
                          <i class="fas fa-search"></i>&nbsp; Buscar
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- fin card 1 Busqueda Personal -->

            <!-- card 2 Muestra listado Destinos 1 -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"> 
                  <i class="fas fa-list"></i>
                  Listado&nbsp;
                </h3>
                <button v-if="$auth.can('insert-carg')" type="button" @click="NuevoCargo()" class="btn btn-secondary btn-sm" style="vertical-align: top">
                    <i class="fas fa-plus-circle"></i>&nbsp;Nuevo
                </button>
                <button v-if="$auth.can('report-cargo')" type="button"  @click.prevent="GenerarPdfCargo()" class="btn btn-info btn-flat btn-sm" style="vertical-align: top">
                    <i class="fas fa-file-pdf"></i>&nbsp;&nbsp;Ver PDF
                </button>
              </div>

              <!-- <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading">Asignación</h4>
                <hr><font size=3>
                <p class="mb-0">S = Suboficiales y sargentos
                <br></p>
                </font>
              </div> -->
              
              <div class="card-body">
                <div class="alert alert-light" role="alert">
                  <strong>ASIGNACIÓN</strong>  <br>
                  &nbsp;&nbsp;<strong>O</strong> -> Personal de Oficiales <br>
                  &nbsp;&nbsp;<strong>S</strong> -> Personal de Suboficiales y Sargentos<br>
                  &nbsp;&nbsp;<strong>M</strong> -> Personal de Musica<br>
                  &nbsp;&nbsp;<strong>C</strong> -> Personal Civil
                </div>
                <table class="table table-bordered table-striped table-sm">
                  <thead>
                      <tr>
                        <th>Opciones</th>
                        <th>Descripción</th>
                        <th>Puntaje</th>
                        <th>Asignacion</th>
                        <th>Area</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr v-for="cargo in arrayCargo" :key="cargo.id">
                      <td>
                        <button v-if="$auth.can('edit-carg')" type="button" @click="abrirEditar(cargo)" class="btn btn-warning btn-sm" >
                            <i class="fas fa-edit"></i>
                        </button> &nbsp;
                        <template v-if="cargo.estado">
                            <button v-if="$auth.can('delete-carg')" type="button" class="btn btn-danger btn-sm" @click="DesactivarCargo(cargo.id)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </template>
                        <template v-else>
                            <button v-if="$auth.can('delete-carg')" type="button" class="btn btn-info btn-sm" @click="ActivarCargo(cargo.id)">
                                <i class="far fa-check-square"></i>
                            </button>
                        </template>
                      </td>
                      <td v-text="cargo.descripcion"></td>
                      <td v-text="cargo.puntaje"></td>
                      <td v-text="cargo.asignacion"></td>
                      <td v-text="cargo.area"></td>
                      <td v-text="cargo.observaciones"></td>
                      <td>
                        <div v-if="cargo.estado">
                            <span class="badge badge-success">Activo</span>
                        </div>
                        <div v-else>
                            <span class="badge badge-danger">Desactivado</span>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
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

      <div class="modal fade" id="NuevoCargo"> <!-- Modal para registro nuevo CERO -->
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REGISTRAR NUEVO CARGO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                
              <div class="col-md-12"><!-- descripcion -->
                <div class="form-group">
                    <label>Descripción</label>
                        <input  class="form-control" v-model="descripcion" placeholder="Ingrese descripción" maxlength="30">
                </div>
              </div>

              <div class="col-md-12"><!-- puntaje -->
                <div class="form-group">
                    <label>Puntaje</label>
                        <input  class="form-control" v-model="puntaje" placeholder="Ingrese puntaje" maxlength="30">
                </div>
              </div>

              <div class="col-md-12"><!-- asignacion -->
                <div class="form-group">
                    <label>Asignación</label>
                        <input  class="form-control" v-model="asignacion" placeholder="Ingrese asignacion" maxlength="30">
                </div>
              </div>

              <div class="col-md-12"><!-- area -->
                <div class="form-group">
                    <label>Area</label>
                        <input  class="form-control" v-model="area" placeholder="Ingrese area" maxlength="30">
                </div>
              </div>

              <div class="col-md-12"><!-- observaciones -->
                <div class="form-group">
                    <label>Observaciones</label>
                        <input  class="form-control" v-model="observaciones" placeholder="Ingrese observaciones" maxlength="30">
                </div>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" @click="RegistrarCargo()">REGISTRAR</button>
            </div>
          </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
      </div>
        <!-- /.modal -->

      <div class="modal fade" id="EditarCargo"> <!-- Modal para actualizar CERO-->
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR CARGO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="col-md-12"><!-- descripcion -->
                <div class="form-group">
                    <label>Descripción</label>
                        <input  class="form-control" v-model="descripcionA" placeholder="Ingrese descripción" maxlength="30">
                </div>
              </div>

              <div class="col-md-12"><!-- puntaje -->
                <div class="form-group">
                    <label>Puntaje</label>
                        <input  class="form-control" v-model="puntajeA" placeholder="Ingrese puntaje" maxlength="30">
                </div>
              </div>

              <div class="col-md-12"><!-- asignacion -->
                <div class="form-group">
                    <label>Asignación</label>
                        <input  class="form-control" v-model="asignacionA" placeholder="Ingrese asignacion" maxlength="30">
                </div>
              </div>

              <div class="col-md-12"><!-- area -->
                <div class="form-group">
                    <label>Area</label>
                        <input  class="form-control" v-model="areaA" placeholder="Ingrese area" maxlength="30">
                </div>
              </div>

              <div class="col-md-12"><!-- observaciones -->
                <div class="form-group">
                    <label>Observaciones</label>
                        <input  class="form-control" v-model="observacionesA" placeholder="Ingrese observaciones" maxlength="30">
                </div>
              </div>

              <input type="text" hidden v-model="id" name="" id=""> <!-- con esto recuperamos el percodigo para poder actualizar los datos -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" @click="EditarCargo()">ACTUALIZAR</button>
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
    export default {
        data() {
          return {
            arrayCargo : [],
            
            // Valores para guardar
            descripcion : "",
            puntaje : "",
            asignacion : "",
            area : "",
            observaciones : "",

            // valores para ACTUALZIZAR
            descripcionA : "",
            puntajeA : "",
            asignacionA : "",
            areaA : "",
            observacionesA :"",
            id : "",

            pagination : {
                'total' : 0,   //total de registros       
                'current_page' : 0, //pagina actual
                'per_page' : 0, //numero de registro por paginas
                'last_page' : 0, //la ultima pagina
                'from' : 0, //desde la pagina 
                'to' : 0, //hasta la pagina
            },
            offset : 3, //pagination
            buscar: "",
            criterio: 'descripcion',

          }
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
          },
        },   

        methods: {

          listarCargo(page,buscar, criterio){
              let me = this;
              var url = '/listarCargo?page=' + page + '&buscar=' + buscar.toUpperCase() + '&criterio=' + criterio;
              axios
              .get(url)
              .then(function (response) {
                  //Respuesta de la peticion
                  // //Para hacer prueba
                  var respuesta= response.data;
                  me.arrayCargo = respuesta.cargo.data;
                  me.pagination = respuesta.pagination;
              })
              .catch(function (error) {
              // handle error
              console.log(error);
              });
          },

          cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listarCargo(page,buscar,criterio);
          },

          NuevoCargo(){ //UNO
            $('#NuevoCargo').modal('show');
          },

          RegistrarCargo(){ //DOS
            let me = this;
            axios
            .post("/registrarCargo", {
                descripcion: me.descripcion.toUpperCase(),
                puntaje: me.puntaje,
                asignacion: me.asignacion.toUpperCase(),
                area: me.area,
                observaciones: me.observaciones.toUpperCase(),
            })
            .then(function (response) {
                
                me.datos = response.data;
                $('#NuevoCargo').modal('hide'); //nos permite cerrar
                me.listarCargo(1, '', 'descripcion'); //Al momento de cerrar esto actualiza la lista
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
          },

          abrirEditar(cargo){ //UNO_1
            this.descripcionA = cargo.descripcion,
            this.puntajeA = cargo.puntaje,
            this.asignacionA = cargo.asignacion,
            this.areaA = cargo.area,
            this.observacionesA = cargo.observaciones,
            this.id = cargo.id,
            $('#EditarCargo').modal('show');
          },
          
          EditarCargo(){ //DOS_2
            let me = this;
            axios
            .put("/editarCargo", { //Se pone put para el envio de datos
                id: me.id,
                descripcion: me.descripcionA.toUpperCase(),
                puntaje: me.puntajeA,
                asignacion: me.asignacionA.toUpperCase(),
                area: me.areaA,
                observaciones: me.observacionesA.toUpperCase(),

            })
            .then(function (response) {
                
                me.datos = response.data;
                $('#EditarCargo').modal('hide'); //nos permite cerrar
                me.listarCargo(1, '', 'descripcion'); //Al momento de cerrar esto actualiza la lista
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
          },

          DesactivarCargo(id){ //DOS_2
            swal.fire({
              title: '¿Está seguro de Desactivar cargo ?', // TITULO 
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
                .put("/desactivarCargo", { //Se pone put para el envio de datos
                    'id':id
                })
                .then(function (response) {
                    
                    me.datos = response.data;
                    me.listarCargo(1, '', 'descripcion'); //Al momento de cerrar esto actualiza la lista

                    swal.fire(
                        "Aceptado", //TITULO
                        "Se ha desactivado el destino.", //TEXTO DE MENSAJE
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

          ActivarCargo(id){ //DOS_2
            swal.fire({
              title: '¿Está seguro de Activar Cargo ?', // TITULO 
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
                .put("/activarCargo", { //Se pone put para el envio de datos
                    'id':id
                })
                .then(function (response) {
                    
                    me.datos = response.data;
                    me.listarCargo(1, '', 'descripcion'); //Al momento de cerrar esto actualiza la lista

                    swal.fire(
                        "Aceptado", //TITULO
                        "Se ha Activado el destino.", //TEXTO DE MENSAJE
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

          GenerarPdfCargo(){
            window.open('http://sipefab.fab.bo/generarPdfCargo');
          }

        },

        mounted() {
            this.listarCargo(1, this.buscar, this.criterio); //Esto nos sirve para listar al principio la lista destinos
        },
    }
</script>

<style lang="scss" scoped>

</style>