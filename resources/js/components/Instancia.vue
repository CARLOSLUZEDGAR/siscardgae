<template>
    <div>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">            
                        <h1>
                            <i class="nav-icon fas fa-people-arrows"></i>
                            Instancia
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Instancia</li>
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
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                <!-- Ejemplo de tabla Listado -->
                                    <div class="card">
                                        <div class="card-header">
                                            <button v-if="$auth.can('insert-inst')" type="button" @click="abrirModalRegistro()" class="btn btn-primary">
                                                <i class="fas fa-plus-circle"></i>&nbsp;Nuevo
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <select class="form-control col-md-3" v-model="criterio">
                                                            <option value="instancia">Instancia</option>
                                                            
                                                        </select>
                                                        <input type="text" style="text-transform:uppercase;" v-model="buscar" @keyup.enter="listarInstancia(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                                        <button type="submit" @click="listarInstancia(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                                                <table class="table table-bordered table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:5px; text-align:center">Opciones</th>
                                                            <th style="width:300px; text-align:center">Instancia</th>    
                                                            <th style="width:5px; text-align:center">Perdida de Promocion</th>
                                                            <th style="width:5px; text-align:center">Estado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="instancia in arrayInstancia" :key="instancia.id">
                                                                <td style="width:5px; text-align:center">
                                                                    <template v-if="instancia.estado == '1'">
                                                                        <button v-if="$auth.can('edit-inst')" type="button" @click="abrirModalEditar(instancia)" class="btn btn-warning btn-sm">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button> &nbsp; 
                                                                        <button v-if="$auth.can('delete-inst')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, instancia.id)">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>  &nbsp;
                                                                    </template>
                                                                    <template v-else>
                                                                        <button v-if="$auth.can('delete-inst')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, instancia.id)">
                                                                            <i class="far fa-times-circle"></i>
                                                                        </button>
                                                                    </template>
                                                            </td>
                                                            <td v-text="instancia.instancia"></td>
                                                            <td style="width:5px; text-align:center">
                                                                <div v-if="instancia.postergacion">
                                                                    <span class="badge badge-danger">SI</span>
                                                                </div>
                                                                <div v-else>  
                                                                    <span class="badge badge-success">NO</span>
                                                                </div>
                                                            </td>
                                                            <td style="width:5px; text-align:center">
                                                                <div v-if="instancia.estado">
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
                                    </div>
                                <!-- Fin ejemplo de tabla Listado -->
                                </div>
                                <!--Inicio del modal agregar-->
                                <div class="modal fade" id="ModalRegistro" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-primary modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title-registro-instancia">Registrar Instancia</h4>
                                                <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                                        <div class="col-md-9">
                                                            <input type="text" v-model="instancia" style="text-transform:uppercase;" class="form-control" placeholder="Descripcion de Instancia">  
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Orden</label>
                                                        <div class="col-md-9">
                                                            <input type="number" v-model="orden" class="form-control" placeholder="Ingrese Orden de Instancia">  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Observacion</label>
                                                        <div class="col-md-9">
                                                            <input type="text" v-model="observacion" style="text-transform:uppercase;" class="form-control" placeholder="Ingrese Observacion">  
                                                        </div>
                                                    </div>
                                                    
                                                    <div v-show="errorInstancia" class="form-group row div-error">
                                                        <div class="text-center text-error">
                                                            <div v-for="error in errorMostrarMsjInstancia" :key="error" v-text="error">

                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" @click="registrarInstancia()">Guardar</button>
                                                <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
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
                                                <h4 class="modal-title-actualizar-instancia">Editar Instancia</h4>
                                                <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                                        <div class="col-md-9">
                                                            <input type="text" v-model="instancia_editar" style="text-transform:uppercase;" class="form-control" placeholder="Descripcion de Instancia">  
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Orden</label>
                                                        <div class="col-md-9">
                                                            <input type="text" v-model="orden_editar" class="form-control" placeholder="Ingrese Orden de Instancia">  
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Observacion</label>
                                                        <div class="col-md-9">
                                                            <input type="text" v-model="observacion_editar" style="text-transform:uppercase;" class="form-control" placeholder="Ingrese Observacion">  
                                                        </div>
                                                    </div>
                                                    
                                                    <div v-show="errorInstancia" class="form-group row div-error">
                                                        <div class="text-center text-error">
                                                            <div v-for="error in errorMostrarMsjInstancia" :key="error" v-text="error">

                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" @click="actualizarInstancia()">Actualizar</button>
                                                <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
                                                
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!--Fin del modal-->
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
        data (){
            return {
             
                instancia_id: 0,
                instancia : '',
                orden : '',
                observacion : '',
                postergacion :'',

                instancia_id_edit :0,
                instancia_editar :'',
                orden_editar : '',
                observacion_editar : '',
                estado: '',
                arrayInstancia : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorInstancia : 0,
                errorMostrarMsjInstancia : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'instancia',
                buscar : ''
            }
        },
        computed:{
           
        },
        methods : {
            listarInstancia (page,buscar,criterio){
                let me = this;
                axios
                .post("/instancias", {
                    buscar: buscar.toUpperCase(),
                    criterio: criterio,
                    page: page
                })
                .then(function (response) {
                  
                   var respuesta= response.data;
                    me.arrayInstancia = respuesta.instancias.data;
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
                me.listarInstancia(page,buscar,criterio);
            },
            registrarInstancia(){
                let me = this;
                axios.post('/instancia/registrar',{
                    'instancia': this.instancia.toUpperCase(),
                    'orden': this.orden,
                    'observacion': this.observacion.toUpperCase(),
                }).then(function (response) {
                     if(response.data=="existe"){
                        Swal.fire("Mensaje de Advertencia","la Instancia ya se encuentra registrado","warning"); 
                    } else {
                        Swal.fire("Mensaje de Confirmacion","Datos Guardados Correctamente","success");
                        me.cerrarModal();
                        me.listarInstancia(1,'','nombre');
                    }  
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarInstancia(){
                let me = this;
                axios.put('/instancia/actualizar',{
                    'instancia': this.instancia_editar.toUpperCase(),
                    'orden': this.orden_editar,
                    'observacion': this.observacion_editar.toUpperCase(),
                    'id': this.instancia_id_edit
                }).then(function (response) {
                     if(response.data=="existe"){
                        Swal.fire("Mensaje de Advertencia","la Instancia ya se encuentra registrado","warning"); 
                    } else {
                        Swal.fire("Mensaje de Confirmacion","Datos editados Correctamente","success");
                        me.cerrarModal();
                        me.listarInstancia(1,'','nombre');
                    }  
                }).catch(function (error) {
                    console.log(error);
                });
            },
            CambiarEstado(op, id){
                Swal.fire({
                    title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' esta Instancia?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
                }).then((result) => {
                    if (result.value) {
                        this.fullscreenLoading = true;
                        var url ='/instancia/cambiarEstado'
                        axios.post(url, {
                            'id'   :   id,
                            'estado'    :   (op == 1) ? '0' : '1'
                        }).then(response => {
                            
                            Swal.fire({
                                icon    :   'success',
                                title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' esta Instancia',
                                showConfirmButton   : false,
                                timer   :   1500
                            })
                            this.listarInstancia(1,'','nombre');
                        })
                    }
                })
            },
            cerrarModal(){
                this.instancia='';
                this.orden='';
                this.observacion='';
                $('#ModalRegistro').modal('hide');
                $('#ModalEditar').modal('hide');
            },
            abrirModalRegistro(){
                $('#ModalRegistro').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                $(".modal-title-registro-instancia").text("Registrar Instancia");
            },
            abrirModalEditar(instancia){
                this.instancia_id_edit = instancia.id,
                this.instancia_editar = instancia.instancia,
                this.orden_editar = instancia.orden,
                this.observacion_editar = instancia.observacion,
             //  alert(instancia.orden);
           
                $('#ModalEditar').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                $(".modal-title-editar-instancia").text("Editar Instancia");
                $
            },
           
        },
        mounted() {
            this.listarInstancia(1,this.buscar,this.criterio);
        }
    }
</script>


<style>
</style>