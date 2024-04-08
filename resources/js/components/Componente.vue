<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="fas fa-atlas"></i>
              COMPOMENTES CIES Y EME
            </h1> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Componentes</li>
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
                Buscar Componente
                </h3>
              </div>
                <div class="card-body">
                    <div class="form-group row d-flex justify-content-left"> 
                    <div class="col-md-8 ">  
                        <div class="input-group">
                            <select class="form-control col-md-4" v-model="criterio">
                                <option value="descripcion">Descripción</option>
                                <option value="puntaje">Puntaje</option>
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarEscalafon(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" @click="listarEscalafon(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                    </div>
                <!-- Fin ejemplo de tabla Listado -->
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fas fa-bookmark"></i>
                    Listar Componente
                    </h3>&nbsp;&nbsp;
                    <button v-if="$auth.can('insert-comp')" type="button" @click="abrirModalRegistro()" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Accion</th>
                                    <th>#</th>
                                    <th>descripcion</th>
                                    <th>puntaje</th>
                                    <th>Obsrvacion</th>
                                    <th>Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="componente in arrayComponente" :key="componente.id">
                                    <td>
                                        
                                        <template v-if="componente.estado == '1'">
                                            <button v-if="$auth.can('edit-comp')" type="button" @click="abrirModalEditar(componente)" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button v-if="$auth.can('delete-comp')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, componente.id)">
                                                <i class="fas fa-trash"></i>
                                            </button>  &nbsp;
                                           
                                        </template>
                                        <template v-else>
                                            <button v-if="$auth.can('delete-comp')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, componente.id)">
                                                <i class="far fa-times-circle"></i>
                                            </button>
                                        </template>



                                    </td>
                                    <td v-text="componente.id"></td>
                                    <td v-text="componente.descripcion"></td>
                                    <td v-text="componente.puntaje"></td>
                                    <td v-text="componente.observacion"></td>
                                    <td>
                                        <div v-if="componente.estado">
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
                </div>
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
                <!-- Fin ejemplo de tabla Listado -->
          </div>
        </div>
              <!-- /.card -->
      </div>

                      <!--Inicio del modal agregar-->
                <div class="modal fade" id="ModalRegistro" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-primary modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title-registro"></h4>
                                <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese Descripcion">  
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Puntaje</label>
                                        <div class="col-md-9">
                                            <input type="number" v-model="puntaje" class="form-control" placeholder="Ingrese puntaje">  
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Clasificacion</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="clasificacion" class="form-control" placeholder="Ingrese Clasificacion">  
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Observacion</label>
                                        <div class="col-md-9">
                                            <input type="email" v-model="observacion" class="form-control" placeholder="Observacion">
                                        </div>
                                    </div>

                                    <div v-show="errorComponente" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjComponente" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="registrarComponente()">Guardar</button>
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--Fin del modal-->

                <!--Inicio del modal actualizar-->
                <div class="modal fade" id="ModalEditar" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-primary modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title-edit"></h4>
                                <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="descripcion_edit" class="form-control" placeholder="Ingrese Descripcion">  
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Puntaje</label>
                                        <div class="col-md-9">
                                            <input type="number" v-model="puntaje_edit" class="form-control" placeholder="Ingrese Puntaje">  
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Clasificacion</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="clasificacion_edit" class="form-control" placeholder="Ingrese Clasificacion">  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Observacion</label>
                                        <div class="col-md-9">
                                            <input type="email" v-model="observacion_edit" class="form-control" placeholder="Observacion">
                                        </div>
                                    </div>

                                    

                                    <div v-show="errorComponente_edit" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjComponente_edit" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="actualizarComponente()">Editar</button>
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--Fin del modal-->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
    export default {
        data (){
            return {
                componente_id: 0,
                descripcion : '',
                puntaje : '',
                clasificacion : '',
                observacion : '',
                //edit
                componente_id_edit: 0,
                descripcion_edit : '',
                puntaje_edit : 0,
                clasificacion_edit : '',
                observacion_edit : '',

                arrayComponente : [],

                tipoAccion : 0,
                errorComponente : 0,
                errorMostrarMsjComponente : [],
                //edit
                errorComponente_edit : 0,
                errorMostrarMsjComponente_edit : [],
                modal : 0,
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'descripcion',
                buscar : ''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarComponente (page,buscar,criterio){
                let me=this;
                var url= '/componente?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayComponente = respuesta.componentes.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarEscalafon(page,buscar,criterio);
            },
            registrarComponente(){
                if (this.validarComponente()){
                    return;
                }
                let me = this;
                axios.post('/componente/registrar',{
                    'descripcion': this.descripcion,
                    'puntaje': this.puntaje,
                    'clasificacion': this.clasificacion,
                    'observacion': this.observacion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarComponente(1,'','descripcion');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarComponente(){
               if (this.validarComponente_edit()){
                    return;
                }              
                let me = this;
                axios.put('/componente/actualizar',{
                    'descripcion': this.descripcion_edit,
                    'puntaje': this.puntaje_edit,
                    'clasificacion': this.clasificacion_edit,
                    'observacion': this.observacion_edit,
                    'id': this.componente_id_edit
                }).then(function (response) {                                    
                    me.cerrarModal();
                    me.listarComponente(1,'','descripcion');
                    //
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            CambiarEstado(op, id){
                Swal.fire({
                    title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' el Componente?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
                }).then((result) => {
                    if (result.value) {
                        this.fullscreenLoading = true;
                        var url ='/componente/cambiarEstado'
                        axios.post(url, {
                            'id'   :   id,
                            'estado'    :   (op == 1) ? '0' : '1'
                        }).then(response => {
                            
                            Swal.fire({
                                icon    :   'success',
                                title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el Compomente',
                                showConfirmButton   : false,
                                timer   :   1500
                            })
                            this.listarComponente(1,'','descripcion');
                        })
                    }
                })
            },
            validarComponente(){
                this.errorComponente=0;
                this.errorMostrarMsjComponente =[];

                if (!this.descripcion) this.errorMostrarMsjComponente.push("la descripcion de Componente no puede estar vacío.");
                if (!this.puntaje) this.errorMostrarMsjComponente.push("El puntaje de Componente no puede estar vacío.");
                if (!this.clasificacion) this.errorMostrarMsjComponente.push("la clasificacion de Componente no puede estar vacío.");

                if (this.errorMostrarMsjComponente.length) this.errorComponente = 1;

                return this.errorComponente;
            },
            validarComponente_edit(){
                this.errorComponente_edit=0;
                this.errorMostrarMsjComponente_edit =[];

                if (!this.descripcion_edit) this.errorMostrarMsjComponente_edit.push("la descripcion de Componente no puede estar vacío.");
                if (!this.puntaje_edit) this.errorMostrarMsjComponente_edit.push("El puntaje de Componente no puede estar vacío.");
                if (!this.clasificacion_edit) this.errorMostrarMsjComponente_edit.push("la clasificacion de Componente no puede estar vacío.");

                if (this.errorMostrarMsjComponente_edit.length) this.errorComponente_edit = 1;

                return this.errorComponente_edit;
            },
            cerrarModal(){
                this.descripcion = '';
                this.puntaje = '';
                this.clasificacion = '';
                this.observacion = '';

                this.descripcion_edit = '';
                this.puntaje_edit ='';
                this.clasificacion_edit = '';
                this.observacion_edit = '';
                $('#ModalRegistro').modal('hide');
                $('#ModalEditar').modal('hide');
            },
            abrirModalRegistro(){
                $('#ModalRegistro').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                $(".modal-title-registro").text("Registrar Componente");
            },
            abrirModalEditar(componente){
                this.componente_id_edit = componente.id,
                this.descripcion_edit = componente.descripcion,
                this.puntaje_edit = componente.puntaje,
                this.clasificacion_edit = componente.clasificacion,
                this.observacion_edit = componente.observacion,
               // console.log(escalafon);
           
                $('#ModalEditar').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                $(".modal-title-edit").text("Editar Componente");
                $
            },
        },
        mounted() {
            this.listarComponente(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>