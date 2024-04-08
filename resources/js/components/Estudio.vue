<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              Complemento
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Estudio</li>
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
                  Buscar Complemento
                </h3>
              </div>
              <div class="card-body">
                <div class="row form-group"> <!-- Para centrear se pone estos codigos -->
                  <div class="col-md-8 ">
                    <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                        <option value="abreviatura">Abreviatura</option>
                        <option value="descripcion">Descripcion</option>
                        <option value="instituto">Instituto</option>
                      </select>
                      <input type="text" class="form-control col-md-4" placeholder="Ingrese dato..." style="text-transform:uppercase;" v-model="buscar" @keyup.enter="listarEstudio(1,buscar,criterio)">
                      <button class="btn btn-primary btn-flat " type="subnmit" @click="listarEstudio(1,buscar,criterio)">
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
                <button v-if="$auth.can('view-estu')" type="button" @click="NuevoEstudio()" class="btn btn-secondary btn-sm " style="vertical-align: top; padding: 5px 50px;">
                  <i class="fas fa-plus-circle"></i>&nbsp;Nuevo
                </button>
                <!-- <button type="button"  @click.prevent="GenerarPdfEstudio()" class="btn btn-info btn-flat btn-sm" style="vertical-align: top">
                  <i class="fas fa-file-pdf"></i>&nbsp;&nbsp;Ver PDF
                </button> -->
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr style="width:100px; text-align:center">
                      <th>Opciones</th>
                      <th>Abreviatura</th>
                      <th>Descripción</th>
                      <th>Instituto</th>
                      <th>Correlativo</th>
                      <th>Observaciones</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="estudio in arrayEstudios" :key="estudio.id">
                      <td style="width:100px; text-align:center">
                        <template v-if="estudio.estado">
                          <button v-if="$auth.can('edit-estu')" type="button" @click="abrirEstudio(estudio)" class="btn btn-warning btn-sm" >
                            <i class="fas fa-edit"></i>
                          </button> &nbsp;
                          <button v-if="$auth.can('delete-estu')" type="button" class="btn btn-danger btn-sm" @click="DesactivarEstudio(estudio.id)">
                            <i class="fas fa-trash"></i>
                          </button>
                        </template>
                        <template v-else>
                          <button v-if="$auth.can('delete-estu')" type="button" class="btn btn-info btn-sm" @click="ActivarEstudio(estudio.id)">
                            <i class="far fa-times-circle"></i>
                          </button>
                        </template>
                      </td>
                      <td v-text="estudio.abreviatura"></td>
                      <td v-text="estudio.descripcion"></td>
                      <td style="width:100px;" v-text="estudio.instituto"></td>
                      <td v-text="estudio.correlativo"></td>
                      <td v-text="estudio.observacion"></td>
                      <td style="width:100px; text-align:center">
                        <div v-if="estudio.estado">
                          <span class="badge badge-success">Activo</span>
                        </div>
                        <div v-else>
                          <span class="badge badge-danger">Desactivo</span>
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

      <div class="modal fade" id="NuevoEstudio"> <!-- Modal para registro nuevo CERO -->
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REGISTRAR NUEVO COMPLEMENTO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                
              <div class="form-group row">
                <div class="col-md-6"><!-- abreviatura -->
                  <label class="col-md-3 form-control-label" for="text-input">Abreviatura</label>
                  <input type="text" v-model="estu_abreviatura" class="form-control" placeholder="Ingrese abreviatura" :class="{ 'is-invalid' : $v.estu_abreviatura.$error, 'is-valid':!$v.estu_abreviatura.$invalid }" style="text-transform:uppercase" maxlength="30">
                  <div class="invalid-feedback">
                    <span v-if="!$v.estu_abreviatura.required">Este campo es Requerido</span>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12"><!-- nombre -->
                  <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                  <input type="text" v-model="estu_nombre" class="form-control" placeholder="Ingrese descripción" :class="{ 'is-invalid' : $v.estu_nombre.$error, 'is-valid':!$v.estu_nombre.$invalid }" style="text-transform:uppercase" maxlength="300">
                  <div class="invalid-feedback">
                    <span v-if="!$v.estu_nombre.required">Este campo es Requerido</span>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label class="col-md-12 form-control-label" for="text-input">Instituto al que pertenece el Complemento</label>
                  <select class="form-control" v-model="estu_instituto" :class="{ 'is-invalid' : $v.estu_instituto.$error, 'is-valid':!$v.estu_instituto.$invalid }">
                    <option value="" disabled>SELECCIONE</option>
                    <option value="ESCUELA DE ALTOS ESTUDIOS NACIONALES (DAEN)">ESCUELA DE ALTOS ESTUDIOS NACIONALES (DAEN)</option>
                    <option value="ESCUELA DE COMANDO Y ESTADO MAYOR AÉREO (ECEMA)">ESCUELA DE COMANDO Y ESTADO MAYOR AÉREO (ECEMA)</option>
                    <option value="ESCUELA MILITAR DE INGENIERIA">ESCUELA MILITAR DE INGENIERIA</option>
                    <option value="ESCUELA DE PERFECCIONAMIENTO TECNICO AERONAUTICO (EPTA)">ESCUELA DE PERFECCIONAMIENTO TECNICO AERONAUTICO (EPTA)</option>
                    <option value="ESCUELA DE PERFECCIONAMIENTO DE MUSICA (DEPSSM)">ESCUELA DE PERFECCIONAMIENTO DE MUSICA (DEPSSM)</option>
                    <option value="COLEGIO MILITAR DE AVIACION (COLMILAV)">COLEGIO MILITAR DE AVIACION (COLMILAV)</option>
                    <option value="POLITECNICO MILITAR DE AERONAUTICA (POLMILAE)">POLITECNICO MILITAR DE AERONAUTICA (POLMILAE)</option>
                    <option value="ESCUELA DE MUSICA DE LA FAB (EMMFAB)">ESCUELA DE MUSICA DE LA FAB (EMMFAB)</option>
                    <option value="FAB">FAB</option>
                    <option value="PERSONAL CIVIL FAB">PERSONAL CIVIL FAB</option>
                    <option value="RETIRADO DE LA FAB">RETIRADO DE LA FAB</option>
                    <option value="SEGUN ORDEN DEL DIA">SEGUN ORDEN DEL DIA</option>
                    <option value="EJERCITO">EJERCITO</option>
                    <option value="ESCUELA DE SOFS. Y SGTOS DEL EJERCITO">ESCUELA DE SOFS. Y SGTOS DEL EJERCITO</option>
                    <option value="ESCUELA DE MUSICA DEL EJERCITO">ESCUELA DE MUSICA DEL EJERCITO</option>
                    <option value="NO APLICA">NO APLICA</option>
                  </select>
                  <div class="invalid-feedback">
                    <span v-if="!$v.estu_instituto.required">Seleccione un valor</span>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6"><!-- correlativo -->
                  <label class="col-md-3 form-control-label" for="text-input">Correlativo</label>
                  <input type="number" v-model="estu_correlativo" class="form-control" placeholder="INGRESE NUMERO" :class="{ 'is-invalid' : $v.estu_correlativo.$error, 'is-valid':!$v.estu_correlativo.$invalid }"  maxlength="10">
                  <div class="invalid-feedback">
                    <span v-if="!$v.estu_correlativo.required">Este campo es Requerido</span>
                  </div>
                </div>
              </div>

              <div class="form-group row"><!-- observaciones -->
                <label class="col-md-3 form-control-label" for="text-input">Observaciones</label>
                <div class="col-md-12">
                  <input class="form-control" v-model="observaciones" placeholder="Ingrese observaciones" style="text-transform:uppercase;" maxlength="300">
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="RegistrarEstudio()">Registrar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
            </div>
          </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="EditarEstudio1"> <!-- Modal para actualizar CERO-->
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR COMPLEMENTO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group row">
                <div class="col-md-6"><!-- abreviatura -->
                  <label class="col-md-3 form-control-label" for="text-input">Abreviatura</label>
                  <input type="text" v-model="estu_abreviaturaA" class="form-control" placeholder="Ingrese abreviatura" :class="{ 'is-invalid' : $v.estu_abreviaturaA.$error, 'is-valid':!$v.estu_abreviaturaA.$invalid }" style="text-transform:uppercase" maxlength="30">
                  <div class="invalid-feedback">
                    <span v-if="!$v.estu_abreviaturaA.required">Este campo es Requerido</span>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12"><!-- nombre -->
                  <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                  <input type="text" v-model="estu_nombreA" class="form-control" placeholder="Ingrese descripción" :class="{ 'is-invalid' : $v.estu_nombreA.$error, 'is-valid':!$v.estu_nombreA.$invalid }" style="text-transform:uppercase" maxlength="300">
                  <div class="invalid-feedback">
                    <span v-if="!$v.estu_nombreA.required">Este campo es Requerido</span>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label class="col-md-12 form-control-label" for="text-input">Instituto al que pertenece el Complemento</label>
                  <select class="form-control" v-model="estu_institutoA" :class="{ 'is-invalid' : $v.estu_institutoA.$error, 'is-valid':!$v.estu_institutoA.$invalid }">
                    <option value="" disabled>SELECCIONE</option>
                    <option value="ESCUELA DE ALTOS ESTUDIOS NACIONALES (DAEN)">ESCUELA DE ALTOS ESTUDIOS NACIONALES (DAEN)</option>
                    <option value="ESCUELA DE COMANDO Y ESTADO MAYOR AÉREO (ECEMA)">ESCUELA DE COMANDO Y ESTADO MAYOR AÉREO (ECEMA)</option>
                    <option value="ESCUELA MILITAR DE INGENIERIA">ESCUELA MILITAR DE INGENIERIA</option>
                    <option value="ESCUELA DE PERFECCIONAMIENTO TECNICO AERONAUTICO (EPTA)">ESCUELA DE PERFECCIONAMIENTO TECNICO AERONAUTICO (EPTA)</option>
                    <option value="ESCUELA DE PERFECCIONAMIENTO DE MUSICA (DEPSSM)">ESCUELA DE PERFECCIONAMIENTO DE MUSICA (DEPSSM)</option>
                    <option value="COLEGIO MILITAR DE AVIACION (COLMILAV)">COLEGIO MILITAR DE AVIACION (COLMILAV)</option>
                    <option value="POLITECNICO MILITAR DE AERONAUTICA (POLMILAE)">POLITECNICO MILITAR DE AERONAUTICA (POLMILAE)</option>
                    <option value="ESCUELA DE MUSICA DE LA FAB (EMMFAB)">ESCUELA DE MUSICA DE LA FAB (EMMFAB)</option>
                    <option value="FAB">FAB</option>
                    <option value="PERSONAL CIVIL FAB">PERSONAL CIVIL FAB</option>
                    <option value="RETIRADO DE LA FAB">RETIRADO DE LA FAB</option>
                    <option value="SEGUN ORDEN DEL DIA">SEGUN ORDEN DEL DIA</option>
                    <option value="EJERCITO">EJERCITO</option>
                    <option value="ESCUELA DE SOFS. Y SGTOS DEL EJERCITO">ESCUELA DE SOFS. Y SGTOS DEL EJERCITO</option>
                    <option value="ESCUELA DE MUSICA DEL EJERCITO">ESCUELA DE MUSICA DEL EJERCITO</option>
                    <option value="NO APLICA">NO APLICA</option>
                  </select>
                  <div class="invalid-feedback">
                    <span v-if="!$v.estu_institutoA.required">Seleccione un valor</span>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6"><!-- correlativo -->
                  <label class="col-md-3 form-control-label" for="text-input">Correlativo</label>
                  <input type="number" v-model="estu_correlativoA" class="form-control" placeholder="INGRESE NUMERO" :class="{ 'is-invalid' : $v.estu_correlativoA.$error, 'is-valid':!$v.estu_correlativoA.$invalid }"  maxlength="10">
                  <div class="invalid-feedback">
                    <span v-if="!$v.estu_correlativoA.required">Este campo es Requerido</span>
                  </div>
                </div>
              </div>

              <div class="form-group row"><!-- observaciones -->
                <label class="col-md-3 form-control-label" for="text-input">Observaciones</label>
                <div class="col-md-12">
                  <input class="form-control" v-model="observacionesA" placeholder="Ingrese observaciones" style="text-transform:uppercase;" maxlength="300">
                </div>
              </div>

              <input type="text" hidden v-model="id" name="" id=""> <!-- con esto recuperamos el percodigo para poder actualizar los datos -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="EditarEstudio()">Actualizar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
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
            submitStatus: null,
            arrayEstudios : [],
            
            // Valores para guardar
            estu_abreviatura : "",
            estu_nombre : "",
            estu_correlativo : "",
            estu_instituto : "",
            observaciones : "",

            // valores para ACTUALZIZAR
            estu_abreviaturaA : "",
            estu_nombreA : "",
            estu_correlativoA : "",
            estu_institutoA : "",
            observacionesA : "",
            id : "",

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
            criterio: 'descripcion',

          }
        },

        validations: {
            estu_abreviatura : { required},
            estu_instituto : { required},
            estu_nombre: { required },
            estu_correlativo :{ required},

            estu_abreviaturaA : { required},
            estu_institutoA : { required},
            estu_nombreA: { required },
            estu_correlativoA :{ required},
          validationGroupReg: ['estu_abreviatura', 'estu_instituto','estu_nombre','estu_correlativo'],
          validationGroupEdit: ['estu_abreviaturaA', 'estu_institutoA','estu_nombreA','estu_correlativoA']
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

          listarEstudio(page,buscar, criterio){
              let me = this;
              var url = '/listarEstudio?page=' + page + '&buscar=' + buscar.toUpperCase() + '&criterio=' + criterio;
              axios
              .get(url)
              .then(function (response) {
                  //console.log(response.data);
                  var respuesta= response.data;
                  me.arrayEstudios = respuesta.estudio.data;
                  me.pagination = respuesta.pagination;
              })
              .catch(function (error) {
              console.log(error);
              });
          },

          Cerrar(){
            this.$v.$reset()
          },

          cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listarEstudio(page,buscar,criterio);
          },

          NuevoEstudio(){ 
            this.estu_abreviatura = "",
            this.estu_nombre = "",
            this.estu_instituto = "",
            this.estu_correlativo = "",
            this.observaciones = "",
            $('#NuevoEstudio').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
          },

          RegistrarEstudio(){ 
            this.$v.$reset();
              if(!this.$v.validationGroupReg.$invalid){
                swal.fire({
                  title: 'Se registrarán los siguientes datos', 
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
                    if(me.observaciones!==null){
                      me.observaciones=me.observaciones.toUpperCase();
                    }
                    axios
                    .post("/registrarEstudio", {
                      abreviatura : me.estu_abreviatura.toUpperCase(),
                      descripcion : me.estu_nombre.toUpperCase(),
                      instituto : me.estu_instituto,
                      correlativo : me.estu_correlativo,
                      observacion : me.observaciones
                    })
                    .then(function (response) {
                      me.datos = response.data;
                      $('#NuevoEstudio').modal('hide');
                      swal.fire(
                        "Aceptado", //TITULO
                        "Se añadio correctamente el Complemento", //TEXTO DE MENSAJE
                        "success" // TIPO DE MODAL (success, warnning, error, info)
                      );
                      me.listarEstudio(1, '', 'descripcion'); 
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                  }
                })
              }
              else{
                this.$v.$touch();
                Swal.fire({
                  icon: 'warning',
                  title: 'Ingrese todos los datos requeridos',
                  showConfirmButton: false,
                  timer: 2000
                })
              }
          },

          abrirEstudio(estudio){ 
            this.estu_abreviaturaA = estudio.abreviatura,
            this.estu_nombreA = estudio.descripcion,
            this.estu_institutoA = estudio.instituto,
            this.estu_correlativoA = estudio.correlativo,
            this.observacionesA = estudio.observacion,
            this.id = estudio.id,
            $('#EditarEstudio1').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
          },

          EditarEstudio(){ //DOS_2
            this.$v.$reset();
            if(!this.$v.validationGroupEdit.$invalid){
              swal.fire({
                title: 'Se actualizarán los siguientes campos', // TITULO 
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
                  if(me.observacionesA!==null){
                    me.observacionesA=me.observacionesA.toUpperCase();
                  }
                  axios
                  .put("/editarEstudio", { 
                      id: me.id,
                      abreviatura : me.estu_abreviaturaA.toUpperCase(),
                      descripcion : me.estu_nombreA.toUpperCase(),
                      correlativo : me.estu_correlativoA,
                      instituto : me.estu_institutoA,
                      observacion : me.observacionesA

                  })
                  .then(function (response) {
                      
                      me.datos = response.data;
                      $('#EditarEstudio1').modal('hide'); 
                      swal.fire(
                        "Aceptado", //TITULO
                        "Se modificó correctamente el Complemento", //TEXTO DE MENSAJE
                        "success" // TIPO DE MODAL (success, warnning, error, info)
                      )
                      me.listarEstudio(1,'', 'descripcion'); 
                  })
                  .catch(function (error) {
                      // handle error
                      console.log(error);
                  });
                }
              })
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
             

          DesactivarEstudio(id){ //DOS_2
            swal.fire({
              title: '¿Está seguro de Desactivar este Complemento ?', // TITULO 
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
                .put("/desactivarEstudio", { //Se pone put para el envio de datos
                    'id':id
                })
                .then(function (response) {
                    //
                    me.datos = response.data;
                    me.listarEstudio(1, '', 'descripcion'); //Al momento de cerrar esto actualiza la lista

                    swal.fire(
                        "Aceptado", //TITULO
                        "Se ha desactivado el Complemento.", //TEXTO DE MENSAJE
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

          ActivarEstudio(id){ //DOS_2
            swal.fire({
              title: '¿Está seguro de Activar este Complemento ?', // TITULO 
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
                .put("/activarEstudio", { //Se pone put para el envio de datos
                    'id':id
                })
                .then(function (response) {
                    //
                    me.datos = response.data;
                    me.listarEstudio(1, '', 'descripcion'); 

                    swal.fire(
                        "Aceptado", //TITULO
                        "Se ha Activado el Complemeto.", //TEXTO DE MENSAJE
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

          GenerarPdfDestinos1(){
            window.open('http://sipefab.fab.bo/generarPdfDestinos1');
          },

          submit() {
            console.log('submit!')
            this.$v.$touch()
            if (this.$v.$invalid) {
              this.submitStatus = 'ERROR'
            } else {
              // do your submit logic here
              this.submitStatus = 'PENDING'
              setTimeout(() => {
                this.submitStatus = 'OK'
              }, 500)
            }
          }


        },

        mounted() {
            this.listarEstudio(1, this.buscar, this.criterio); //Esto nos sirve para listar al principio la lista destinos
        },
    }
</script>

<style lang="scss" scoped>
  table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }
</style>