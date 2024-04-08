<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              Subespecialidad
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Subespecialidades</li>
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
                    Buscar Subespecialidad
                  </h3>
              </div>
              <div class="card-body">
                <div class="row form-group"> <!-- Para centrear se pone estos codigos -->
                  <div class="col-md-8 ">
                    <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                          <option value="nombre">Descripción</option>
                          <!--<option value="observacion">Clasificación</option>-->
                      </select>
                      <input type="text" class="form-control col-md-4" placeholder="Ingrese dato..." style="text-transform:uppercase;" v-model="buscar" @keyup.enter="listarSubespecialidad(1,buscar,criterio)">
                      <button class="btn btn-primary btn-flat " type="subnmit" @click="listarSubespecialidad(1,buscar,criterio)">
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
                <button v-if="$auth.can('insert-subesp')" type="button" @click="NuevaSubespecialidad()" class="btn btn-primary btn-sm" style="vertical-align: top">
                    <i class="fas fa-plus"></i>&nbsp;Nuevo
                </button>
                <button v-if="$auth.can('update')" type="button"  @click.prevent="SubespecialidadesPDF()" class="btn btn-secondary btn-sm" style="vertical-align: top">
                    <i class="fas fa-file-alt"></i>&nbsp;&nbsp;Ver PDF
                </button>
              </div>
              <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                <table class="table table-bordered table-striped table-sm">
                  <thead>
                      <tr style="width:100px; text-align:center">
                        <th>Opciones</th>
                        <th>Especialidad</th>
                        <th>Subespecialidad</th>
                        <th>Estado</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr v-for="subespecialidad in arraySubespecialidad" :key="subespecialidad.id">
                      <td style="width:100px; text-align:center"> 
                        
                        <template v-if="subespecialidad.estado == 1">
                          <button v-if="$auth.can('edit-subesp')" type="button" @click="abrirEditar(subespecialidad)" class="btn btn-warning btn-sm" >
                            <i class="fas fa-edit"></i>
                        </button> &nbsp;
                            <button v-if="$auth.can('delete-subesp')" type="button" class="btn btn-danger btn-sm" @click="DesactivarSubespecialidad(subespecialidad)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </template>
                        <template v-else>
                            <button v-if="$auth.can('delete-subesp')" type="button" class="btn btn-secondary btn-sm" @click="ActivarSubespecialidad(subespecialidad)">
                                <i class="far fa-times-circle"></i>
                            </button>
                        </template>
                      </td>
                      <td v-text="subespecialidad.nomespe"></td>
                      <td v-text="subespecialidad.nomsubespe"></td>
                      <td style="width:100px; text-align:center">
                        <div v-if="subespecialidad.estado == 1">
                            <span class="badge badge-success">Activo</span>
                        </div>
                        <div v-else>
                            <span class="badge badge-danger">Desactivo</span>
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

      <div class="modal fade" id="NuevaSubespecialidad"> <!-- Modal para registro nuevo CERO -->
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title-registro"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                
              <div class="col-md-12"><!-- descripcion -->
                <div class="form-group">
                  <label>Descripción</label>
                      <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese descripción" :class="{ 'is-invalid' : $v.nombre.$error, 'is-valid':!$v.nombre.$invalid }" style="text-transform:uppercase">
                  <div class="invalid-feedback">
                      <span v-if="!$v.nombre.required">Este campo es Requerido</span>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <label class="form-control-label" for="text-input">Especialidad</label>
                <select class="form-control" v-model="especialidad" :class="{ 'is-invalid' : $v.especialidad.$error, 'is-valid':!$v.especialidad.$invalid }">
                  <option value="" disabled>SELECCIONE</option>
                  <option v-for="especialidad in arrayEspecialidad" :key="especialidad.id" :value="especialidad.id"  v-text="especialidad.nombre"></option>
                </select>
                <div class="invalid-feedback">
                  <span v-if="!$v.especialidad.required">Este campo es Requerido</span>
                </div>
              </div>

              <div class="col-md-12"><!-- observaciones -->
                <div class="form-group">
                  <label>Observación</label>
                    <textarea name="textarea" class="form-control" rows="3" v-model="observacion" style="text-transform:uppercase"></textarea>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="RegistrarSubespecialidad()" :disabled="submitStatus === 'PENDING'">Registrar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

          </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
      </div>
        <!-- /.modal -->

      <div class="modal fade" id="EditarSubespecialidad"> <!-- Modal para actualizar CERO-->
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title-edit"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="col-md-12">
                <div class="form-group">
                  <label>Descripción</label>
                    <input  class="form-control" v-model="nombreA" placeholder="Ingrese descripción" :class="{ 'is-invalid' : $v.nombreA.$error, 'is-valid':!$v.nombreA.$invalid }" style="text-transform:uppercase">
                    <div class="invalid-feedback">
                      <span v-if="!$v.nombreA.required">Este campo es Requerido</span>
                    </div>
                </div>
              </div>

              <div class="col-md-12">
                <label class="form-control-label" for="text-input">Especialidad</label>
                <select class="form-control" v-model="especialidadA" :class="{ 'is-invalid' : $v.especialidadA.$error, 'is-valid':!$v.especialidadA.$invalid }">
                  <option value="" disabled>SELECCIONE</option>
                  <option v-for="especialidad in arrayEspecialidad" :key="especialidad.id" :value="especialidad.id"  v-text="especialidad.nombre"></option>
                </select>  
                <div class="invalid-feedback">
                  <span v-if="!$v.especialidadA.required">Este campo es Requerido</span>
                </div>   
              </div>

              <div class="col-md-12"><!-- observaciones -->
                <div class="form-group">
                  <label>Observación</label>
                    <textarea name="textarea" class="form-control" rows="3" v-model="observacionA" style="text-transform:uppercase"></textarea>
                </div>
              </div>

              <!-- <div class="form-group row">
                <div v-show="errorSubespecialidadActualizar" class="form-group row div-error">
                  <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjSubespecialidadActualizar" :key="error" v-text="error">
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="EditarSubespecialidad()">Actualizar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
            arraySubespecialidad : [],
            arrayEspecialidad : [],
            errorSubespecialidadActualizar : 0,
            errorMostrarMsjSubespecialidadActualizar : [],
            
            // Valores para guardar
            idSubespecialidad : 0,
            nombre : "",
            observacion : "",
            especialidad : "",
            nombreA : "",
            observacionA : "",
            especialidadA : "",

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
            criterio: 'nombre',
          }
        },

        validations: {
          nombre: { required },
          especialidad : { required},

          nombreA: { required },
          especialidadA : { required},

          validationGroupReg: ['nombre', 'especialidad'],
          validationGroupEdit: ['nombreA', 'especialidadA']
          
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

          listarSubespecialidad(page,buscar, criterio){
              let me = this;
            axios
        
          .post("/listarSubespecialidades", {
            page : page,
            buscar : buscar.toUpperCase(),
            criterio : criterio,
            
          })
          .then(function (response) {
            
            me.arraySubespecialidad = response.data.subespecialidad.data
            me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
          },

          cambiarPagina(page,buscar,criterio){
            let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page= page;
                //Envia la peticion para visualizar la data de esa pagina
                me.listarSubespecialidad(page, buscar, criterio);
          },

          validarSubespecialidadActualizar(){
            this.errorSubespecialidadActualizar=0;
            this.errorMostrarMsjSubespecialidadActualizar =[];
            if(!this.nombreA) this.errorMostrarMsjSubespecialidadActualizar.push("Ingresar la Descripción");
            if(!this.especialidadA) this.errorMostrarMsjSubespecialidadActualizar.push("Seleccione una Especialidad");  
            if
            (this.errorMostrarMsjSubespecialidadActualizar.length) this.errorSubespecialidadActualizar = 1;
            return this.errorSubespecialidadActualizar;
        },

          selectEspecialidad(){
            let me =this;
            var url='/especialidad/selectEspecialidad';
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayEspecialidad = respuesta.especialidad; 
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        Cerrar(){
            this.$v.$reset();
        },

          NuevaSubespecialidad(){ 
            this.$v.$reset()
            this.nombre = "";
            this.observacion = "";
            $('#NuevaSubespecialidad').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-registro").text("Registrar Nueva Subespecialidad");
            this.selectEspecialidad()
          },

          RegistrarSubespecialidad(){
            this.$v.$reset() 
            if(!this.$v.validationGroupReg.$invalid){
              swal.fire({
                    title: 'Se registrara la Subespecialidad', 
                    icon: 'warning', 
                    showCancelButton: true, 
                    confirmButtonColor: '#3085d6', 
                    cancelButtonColor: '#d33', 
                    confirmButtonText: 'Registrar', 
                    cancelButtonText: 'Cancelar', 
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                      if (result.value) { 

                        let me = this;
                        axios
                        .post("/registrarSubespecialidad", {
                            nombre : me.nombre.toUpperCase(),
                            especialidad : me.especialidad,
                            observacion : me.observacion
                        })
                        .then(function (response) {
                            
                            Swal.fire({
                                icon    :   'success',
                                title   :   'Se ha registrado la nueva Subespecialidad',
                                showConfirmButton   : false,
                                timer   :   1500
                            })
                            me.datos = response.data;
                            $('#NuevaSubespecialidad').modal('hide'); 
                            me.listarSubespecialidad(1, '', 'nombre'); 
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

          abrirEditar(subespecialidad){ 
            this.$v.$reset(),
            this.idSubespecialidad = subespecialidad.idsubespe,
            this.nombreA = subespecialidad.nomsubespe,
            this.especialidadA = subespecialidad.idespe,
            this.observacionA = subespecialidad.observacion
            $('#EditarSubespecialidad').modal('show');
            $('#EditarEspecialidad').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-edit").text("Editar Subespecialidad");
            this.selectEspecialidad()
          },
          EditarSubespecialidad(){ //DOS_2
            this.$v.$reset() 
            if(!this.$v.validationGroupEdit.$invalid){
                swal.fire({
                    title: 'Se actualizara la Subespecialidad', // TITULO 
                    icon: 'warning', //ICONO (success, warnning, error, info, question)
                    showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
                    confirmButtonColor: '#3085d6', // COLOR DEL BOTON PARA CONFIRMAR
                    cancelButtonColor: '#d33', // CLOR DEL BOTON CANCELAR
                    confirmButtonText: 'Actualizar', //TITULO DEL BOTON CONFIRMAR
                    cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {

                      let me = this;
                      axios
                      .put("/editarSubespecialidad", { 
                          id: me.idSubespecialidad,
                          nombre: me.nombreA.toUpperCase(),
                          especialidad: me.especialidadA,
                          observacion : me.observacionA

                      })
                      .then(function (response) {
                          
                          Swal.fire({
                                icon    :   'success',
                                title   :   'Se ha actualizado la subespecialidad',
                                showConfirmButton   : false,
                                timer   :   1500
                            })
                          me.datos = response.data;
                          $('#EditarSubespecialidad').modal('hide'); 
                          me.listarSubespecialidad(1, '', 'nombre'); 
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
                    timer: 2500
                })
            }
          },
             

          DesactivarSubespecialidad(subespecialidad){ //DOS_2
            swal.fire({
              title: '¿Está seguro de Desactivar destino ?', // TITULO 
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
                .put("/desactivarSubespecialidad", { //Se pone put para el envio de datos
                    id:subespecialidad.idsubespe
                })
                .then(function (response) {
                    
                    me.datos = response.data;
                    me.listarSubespecialidad(1, '', 'nombre'); //Al momento de cerrar esto actualiza la lista

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

          ActivarSubespecialidad(subespecialidad){ //DOS_2
            swal.fire({
              title: '¿Está seguro de Activar destino ?', // TITULO 
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
                .put("/activarSubespecialidad", { //Se pone put para el envio de datos
                    id :subespecialidad.idsubespe
                })
                .then(function (response) {
                    
                    me.datos = response.data;
                    me.listarSubespecialidad(1, '', 'nombre'); 

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

          SubespecialidadesPDF(){
            window.open('http://sipefab.fab.bo/reporteSubespecialidad');
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
            this.listarSubespecialidad(1, this.buscar, this.criterio); //Esto nos sirve para listar al principio la lista destinos
        },
    }
</script>

<style lang="scss" scoped>

</style>