<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              Carreras Universitarias
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Carreras</li>
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
                    Buscar Carrera
                  </h3>
              </div>
              <div class="card-body">
                <div class="row  d-flex justify-content-center"> <!-- Para centrear se pone estos codigos -->
                  <div class="col-md-8 ">
                    <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                          <option value="c.descripcion">Grado Académico</option>
                          <option value="np.descripcion">Carrera</option>
                      </select>
                      <input type="text" class="form-control col-md-4" placeholder="Ingrese dato..." style="text-transform:uppercase;" v-model="buscar" @keyup.enter="listarNivProf(1,buscar,criterio)">
                      <button class="btn btn-primary btn-flat " type="subnmit" @click="listarNivProf(1,buscar,criterio)">
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
                <h3 class="card-title align-middle"> 
                  <i class="fas fa-list"></i>
                  Listado&nbsp;
                </h3>
                <button v-if="$auth.can('insert-nivprof')" type="button" @click="NuevoNivProf()" class="btn btn-secondary btn-sm " style="vertical-align: top; padding: 5px 50px;">
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
                        <th style="width: 145px;">Grado Académico</th>
                        <th>Carreras Universitarias</th>
                        <th>Puntaje</th>
                        <th>Clasificación</th>
                        <th>Observaciones</th>
                        <th>Estado</th>

                      </tr>
                  </thead>
                  <tbody>
                    <tr v-for="niveprof in arrayNiveprof" :key="niveprof.id">
                      <td style="width:100px; text-align:center">
                        <template v-if="niveprof.estado == 1">
                          <button v-if="$auth.can('edit-nivprof')" type="button" @click="abrirEditar(niveprof)" class="btn btn-warning btn-sm" >
                            <i class="fas fa-edit"></i>
                          </button> &nbsp;
                          <button v-if="$auth.can('delete-nivprof')" type="button" class="btn btn-danger btn-sm" @click="DesactivarNivProf(niveprof.id2)">
                            <i class="fas fa-trash"></i>
                          </button>
                        </template>
                        <template v-else>
                          <button v-if="$auth.can('delete-nivprof')" type="button" class="btn btn-secondary btn-sm" @click="ActivarNivProf(niveprof.id2)">
                            <i class="far fa-times-circle"></i>
                          </button>
                        </template>
                      </td>
                      <td v-text="niveprof.descripcion"></td>
                      <td v-text="niveprof.npdescrip"></td>
                      <td v-text="niveprof.puntaje"></td>
                      <td v-text="niveprof.clasificacion"></td>
                      <td v-text="niveprof.observacion"></td>
                      <td>
                        <div v-if="niveprof.estado">
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

      <div class="modal fade" id="NuevoNivProf"> <!-- Modal para registro nuevo CERO -->
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REGISTRAR NUEVA CARRERA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" @submit.prevent="submit">

              <div class="form-group row">
                <div class="col-md-5"><!-- grado academico -->
                  <div class="form-group">
                    <label>Grado Académico</label>
                    <v-select                            
                        label="descripcion"                            
                        :options="car_codigocombo"                            
                        v-model="car_codigo"
                        :class="{ 'is-invalid' : $v.car_codigo.$error, 'is-valid':!$v.car_codigo.$invalid }"
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
                        <span v-if="!$v.car_codigo.required">Seleccione un valor porfavor</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-7"><!-- carrera -->
                  <div class="form-group">
                    <label>Carrera Universitaria</label>
                    <input type="text" class="form-control" v-model="descripcion" placeholder="Ingrese descripción" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }">
                    <div class="invalid-feedback">
                        <span v-if="!$v.descripcion.required">Este campo es Requerido</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-5"><!-- clasificacion -->
                  <div class="form-group">
                    <label>Clasificación</label>
                    <select class="form-control" v-model="clasificacion" :class="{ 'is-invalid' : $v.clasificacion.$error, 'is-valid':!$v.clasificacion.$invalid }">
                      <option value="0" disabled>SELECCIONE</option>
                      <option value="T">T</option>
                      <option value="O">O</option>
                      <option value="S">S</option>
                      <option value="C">C</option>
                    </select>
                    <div class="invalid-feedback">
                      <span v-if="!$v.clasificacion.required">Este campo es Requerido</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-7"><!-- puntaje -->
                  <div class="form-group" >
                    <label>Puntaje</label>
                    <select class="form-control" v-model="puntaje" :class="{ 'is-invalid' : $v.puntaje.$error, 'is-valid':!$v.puntaje.$invalid }">
                      <option value="0" disabled>SELECCIONE</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>      
                      <option value="5">5</option>  
                      <option value="6">6</option>  
                      <option value="7">7</option>  
                      <option value="8">8</option>                                    
                      <option value="9">9</option>  
                      <option value="10">10</option>  
                    </select>
                    <div class="invalid-feedback">
                      <span v-if="!$v.puntaje.required">Este campo es Requerido</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12"><!-- observaciones -->
                    <div class="form-group">
                      <label>Observaciones</label>
                      <input  class="form-control" v-model="observacion" placeholder="Ingrese observaciones" style="text-transform:uppercase;" maxlength="300">
                    </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="RegistrarNivProf()">Registrar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
            </div>
          </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
      </div>
        <!-- /.modal -->

      <div class="modal fade" id="EditarNiveprof"> <!-- Modal para actualizar CERO-->
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR CARRERA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group row">
                <div class="col-md-6"><!-- grado academico -->
                  <div class="form-group">
                    <label>Grado Académico</label>
                    <v-select                            
                        label="descripcion"                            
                        :options="car_codigocombo"                            
                        v-model="car_codigo"
                        :class="{ 'is-invalid' : $v.car_codigo.$error, 'is-valid':!$v.car_codigo.$invalid }"
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
                        <span v-if="!$v.car_codigo.required">Seleccione un valor porfavor</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-6"><!-- carrera -->
                  <div class="form-group">
                    <label>Carrera Universitaria</label>
                    <input type="text" class="form-control" v-model="descripcion" placeholder="Ingrese descripción" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }">
                    <div class="invalid-feedback">
                        <span v-if="!$v.descripcion.required">Este campo es Requerido</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6"><!-- clasificacion -->
                  <div class="form-group">
                    <label>Clasificación</label>
                    <select class="form-control" v-model="clasificacion" :class="{ 'is-invalid' : $v.clasificacion.$error, 'is-valid':!$v.clasificacion.$invalid }">
                      <option value="0" disabled>SELECCIONE</option>
                      <option value="T">T</option>
                      <option value="O">O</option>
                      <option value="S">S</option>
                      <option value="C">C</option>
                    </select>
                    <div class="invalid-feedback">
                      <span v-if="!$v.clasificacion.required">Este campo es Requerido</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-6"><!-- puntaje -->
                  <div class="form-group" >
                    <label>Puntaje</label>
                    <select class="form-control" v-model="puntaje" :class="{ 'is-invalid' : $v.puntaje.$error, 'is-valid':!$v.puntaje.$invalid }">
                      <option value="0" disabled>SELECCIONE</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>      
                      <option value="5">5</option>  
                      <option value="6">6</option>  
                      <option value="7">7</option>  
                      <option value="8">8</option>                                    
                      <option value="9">9</option>  
                      <option value="10">10</option>  
                    </select>
                    <div class="invalid-feedback">
                      <span v-if="!$v.puntaje.required">Este campo es Requerido</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12"><!-- observaciones -->
                    <div class="form-group">
                      <label>Observaciones</label>
                      <input  class="form-control" v-model="observacion" placeholder="Ingrese observaciones" style="text-transform:uppercase;" maxlength="300" @keypress="alphanumeric">
                    </div>
                </div>
              </div>

              <input type="text" hidden v-model="id2" name="" id=""> <!-- con esto recuperamos el percodigo para poder actualizar los datos -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="EditarNivProf()">Actualizar</button>
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
            arrayNiveprof : [],

            
            // Valores para guardar
            //car_codigo : 0,
            descripcion : "",
            npdescrip : "",
            puntaje : 0,
            clasificacion : 0,
            observacion : '',
            id2 : "",
            arrayCarrera : [],

            car_codigocombo:[],
            car_codigo : [],

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
            criterio: 'np.descripcion',

          }
        },

        validations:{
          car_codigo : { required },
          descripcion : { required },
          clasificacion : { required },
          puntaje : { required },
          validationGroupReg: ['car_codigo', 'descripcion', 'clasificacion', 'puntaje'],
          validationGroupEdit: ['car_codigo', 'descripcion', 'clasificacion', 'puntaje']
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

        listarNivProf(page,buscar, criterio){
          let me = this;
          var url = '/listarNivelProfesionals?page=' + page + '&buscar=' + buscar.toUpperCase() + '&criterio=' + criterio;
          axios
          .get(url)
          .then(function (response) {
              //console.log(response.data);
              var respuesta= response.data;
              me.arrayNiveprof = respuesta.niveprof.data;
              me.pagination = respuesta.pagination;
          })
          .catch(function (error) {
          console.log(error);
          });
        },

        cambiarPagina(page,buscar,criterio){
          let me = this;
          me.pagination.current_page = page;
          me.listarNivProf(page,buscar,criterio);
        },

        Cerrar(){
            this.$v.$reset()
        },

        DesactivarNivProf(id){ //DOS_2
          swal.fire({
            title: '¿Está seguro de Desactivar esta Carrera?', // TITULO 
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
              .put("/desactivarNivelProfesionals", { //Se pone put para el envio de datos
                  'id':id
              })
              .then(function (response) {
                  //
                  me.datos = response.data;
                  me.listarNivProf(1, '', 'np.descripcion'); //Al momento de cerrar esto actualiza la lista

                  swal.fire(
                      "Aceptado", //TITULO
                      "Se ha desactivado la Carrera.", //TEXTO DE MENSAJE
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

        ActivarNivProf(id){ //DOS_2
          swal.fire({
            title: '¿Está seguro de Activar esta Carrera?', // TITULO 
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
              .put("/activarNivelProfesionals", { //Se pone put para el envio de datos
                  'id':id
              })
              .then(function (response) {
                  //
                  me.datos = response.data;
                  me.listarNivProf(1, '', 'np.descripcion');

                  swal.fire(
                      "Aceptado", //TITULO
                      "Se ha Activado la Carrera.", //TEXTO DE MENSAJE
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

        abrirEditar(niveprof){
          this.car_codigo = niveprof.descripcion,
          //this.descripcion = niveprof.descripcion,
          this.descripcion = niveprof.npdescrip,
          this.puntaje = niveprof.puntaje,
          this.clasificacion = niveprof.clasificacion,
          this.observacion = niveprof.observacion,
          this.id2 = niveprof.id2,
          this.id1 = niveprof.id1,
          this.selectCarrera();
          $('#EditarNiveprof').modal('show');
          $(".modal-header").css("background-color", "#007bff"); 
          $(".modal-header").css("color", "white" );
        },

        EditarNivProf(){ 
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
                if (me.car_codigo.id) {
                  var car_codigoA = me.car_codigo.id;
                } else {
                  var car_codigoA =  me.id1;
                }

                if(me.observacion!==null){
                  me.observacion=me.observacion.toUpperCase();
                }
                axios
                .put("/editarNivelProfesionals", { 
                  id2: me.id2,
                  car_codigo : car_codigoA,
                  descripcion : me.descripcion.toUpperCase(),
                  puntaje : me.puntaje,
                  clasificacion : me.clasificacion,
                  observacion: me.observacion

                })
                .then(function (response) {
                    me.datos = response.data;
                    $('#EditarNiveprof').modal('hide'); 
                    swal.fire(
                      "Aceptado", //TITULO
                      "Se modificó correctamente la Carrera.", //TEXTO DE MENSAJE
                      "success" // TIPO DE MODAL (success, warnning, error, info)
                    )
                    me.listarNivProf(1,'', 'np.descripcion');
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

        selectCarrera(){
            let me =this;
            axios.
            get('/selectCarreras')
            .then(function (response) {
                me.car_codigocombo = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        NuevoNivProf(){ 
          this.selectCarrera();
          this.descripcion = "",
          this.npdescrip = "",
          this.puntaje = "",
          this.clasificacion = "",
          this.observacion = "",
          this.car_codigo = "",
          $('#NuevoNivProf').modal('show');
          $(".modal-header").css("background-color", "#007bff"); 
          $(".modal-header").css("color", "white" ); 
        },

        RegistrarNivProf(){ 
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

                  if (me.car_codigo.id) {
                    var car_codigoA = me.car_codigo.id;
                  } else {
                    var car_codigoA =  me.id1;
                  }

                  if(me.observacion!==null){
                    me.observacion=me.observacion.toUpperCase();
                  }
                  axios
                  .post("/registrarNivelProfesionals", {
                    car_codigo : car_codigoA,                      
                    descripcion : me.descripcion.toUpperCase(),
                    puntaje : me.puntaje,
                    clasificacion : me.clasificacion,
                    observacion : me.observacion,
                  })
                  .then(function (response) {
                      me.datos = response.data;
                      $('#NuevoNivProf').modal('hide'); 
                      swal.fire(
                        "Aceptado", //TITULO
                        "Se añadio correctamente la carrera.", //TEXTO DE MENSAJE
                        "success" // TIPO DE MODAL (success, warnning, error, info)
                      );
                      me.listarNivProf(1,'', 'np.descripcion'); 
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
        },

        alphanumeric ($event) { //SOLO NUMEROS
          //console.log($event.keyCode); //keyCodes value
          let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
          if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && (keyCode < 48 || keyCode > 57) && keyCode !== 45 && keyCode !== 32) { // 46 is dot
              $event.preventDefault();
          }
        },


        },

        mounted() {
            this.listarNivProf(1, this.buscar, this.criterio); //Esto nos sirve para listar al principio la lista destinos
        },
    }
</script>

<style lang="scss" scoped>

</style>