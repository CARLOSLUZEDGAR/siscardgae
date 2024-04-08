<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="fas fa-align-justify nav-icon"></i>
              Subescalafón
              <small></small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subescalafón</li>
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
                        <button type="button" @click="abrirModalRegistro()" class="btn btn-info">
                            <i class="fas fa-plus-circle"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-4" v-model="criterio">  
                                        <option value="sbe.nombre">Descripción</option>
                                        <option value="e.nombre">Escalafón</option>
                                    </select>
                                    <input type="text" style="text-transform:uppercase;" v-model="buscar" @keyup.enter="listarSubescalafon(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarSubescalafon(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 15px;">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="width:70px; text-align:center">Opciones</th>
                                        <th style="width:70px; text-align:center">#</th>
                                        <th style="width:70px; text-align:center">Escalafón</th>
                                        <th style="width:70px; text-align:center">Descripción</th>
                                        <th style="width:70px; text-align:center">Orden</th>
                                        <th style="width:70px; text-align:center">Observación</th>
                                        <th style="width:70px; text-align:center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="subescalafon in arraySubescalafon" :key="subescalafon.id">
                                        <td style="width:70px; text-align:center">
                                            <template v-if="subescalafon.estado == '1'">
                                            <button type="button" @click="abrirModalEditar(subescalafon)" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </button> &nbsp;
                                                <button class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, subescalafon.id)">
                                                    <i class="fas fa-trash"></i>
                                                </button>  &nbsp;
                                            
                                            </template>
                                            <template v-else>
                                                <button class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, subescalafon.id)">
                                                    <i class="far fa-times-circle"></i>
                                                </button>
                                            </template>
                                        </td>
                                        <td style="width:70px; text-align:center" v-text="subescalafon.id"></td>
                                        <td v-text="subescalafon.esca_nombre"></td>
                                        <td v-text="subescalafon.nombre"></td>  
                                        <td style="width:70px; text-align:center" v-text="subescalafon.orden"></td>
                                        <td style="width:70px; text-align:center" v-text="subescalafon.subesca_obs"></td>
                                        <td style="width:70px; text-align:center">
                                            <div v-if="subescalafon.estado">
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
                <!-- Fin ejemplo de tabla Listado -->
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
                                        <label class="col-md-3 form-control-label" for="email-input">Escalafon</label>
                                        <div class="col-md-9">
                                            
                                             <select class="form-control" v-model="esca_cod">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="escalafon in arrayEscalafon" :key="escalafon.id" :value="escalafon.id" v-text="escalafon.nombre"></option>
                                            </select>                                        
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="nombre_subescalafon" @keypress="onlyletters" class="form-control" placeholder="Nombre de Escalafon" style="text-transform:uppercase">  
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Orden</label>
                                        <div class="col-md-9">
                                            <input type="number" v-model="orden" @keypress="onlyNumber " class="form-control" placeholder="Ingrese orden" style="text-transform:uppercase">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Observación</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="subesca_obs" class="form-control" placeholder="Ingrese Observacion" style="text-transform:uppercase">
                                        </div>
                                    </div>

                                    <div v-show="errorSubescalafon" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjSubescalafon" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="registrarSubescalafon()">Guardar</button>
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
                                <h4 class="modal-title-edit"></h4>
                                <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"> 
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Escalafón</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="esca_codigo_edit">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="escalafon in arrayEscalafon" :key="escalafon.id" :value="escalafon.id" v-text="escalafon.nombre"></option>
                                            </select>                                          
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="subesc_nombre_edit" @keypress="onlyletters" class="form-control" placeholder="Nombre de Escalafon" style="text-transform:uppercase"> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Orden</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="orden_edit"  @keypress="onlyNumber " class="form-control" placeholder="Ingrese descripción" style="text-transform:uppercase">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Observación</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="subesca_obs_edit" class="form-control" placeholder="Ingrese descripción" style="text-transform:uppercase">
                                        </div>
                                    </div>

                                    <div v-show="errorSubescalafon_edit" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjSubescalafon_edit" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="actualizarSubescalafon()">Editar</button>
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
                subesca_id : 0,
                subescalafon: '',
                nombre_subescalafon : '',
                esca_cod: 0,
                nombre : '',
                esca_nombre : '',
                orden : '', 
                subesca_obs : '',
                //edit
                subesca_id_edit : 0,
                subescalafon_edit : '',
                subesc_nombre_edit : '',
                esca_codigo_edit : 0,
                orden_edit : 0, 
                subesca_obs_edit : '',
                esca_nombre_edit : '',

                arraySubescalafon : [],
                arrayEscalafon :[],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorSubescalafon : 0,
                errorMostrarMsjSubescalafon : [],
                //edit
                errorSubescalafon_edit : 0,
                errorMostrarMsjSubescalafon_edit : [],

                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'sbe.nombre',
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
            listarSubescalafon (page,buscar,criterio){
               let me = this;
                axios
                .post("/subescalafones", {
                    buscar: buscar.toUpperCase(),
                    criterio: criterio,
                    page: page
                })
                .then(function (response) {
                    var respuesta= response.data;
                    me.arraySubescalafon = respuesta.subescalafones.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectEscalafon(){
                let me=this;
                var url= '/escalafon/selectEscalafon';
                axios.get(url).then(function (response) {
                    //
                    var respuesta= response.data;
                    me.arrayEscalafon = respuesta.escalafones;
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
                me.listarSubescalafon(page,buscar,criterio);
            },
            registrarSubescalafon(){
                if (this.validarSubescalafon()){
                    return;
                }
                let me = this;
                axios.post('/subescalafon/registrar',{
                    'nombre': this.nombre_subescalafon.toUpperCase(),
                    'esca_cod': this.esca_cod,
                    'orden': this.orden,
                    'subesca_obs': this.subesca_obs.toUpperCase(),
                }).then(function (response) {
                    if(response.data=="existe"){
                        Swal.fire("Mensaje de Advertencia","El subescalafon ya se encuentra registrado","warning"); 
                    } else {
                        Swal.fire("Mensaje de Confirmacion","Datos Guardados Correctamente","success");
                         me.cerrarModal();
                        me.listarSubescalafon(1,'','nombre');
                    }   
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarSubescalafon(){
               if (this.validarSubescalafon_edit()){
                    return;
                }
                
                let me = this;

                axios.put('/subescalafon/actualizar',{
                    'nombre': this.subesc_nombre_edit.toUpperCase(),
                    'esca_cod': this.esca_codigo_edit,
                    'orden': this.orden_edit,
                    'subesca_obs': this.subesca_obs_edit.toUpperCase(),
                    'id': this.subesca_id_edit
                }).then(function (response) {
                    
                    if(response.data=="existe"){
                        Swal.fire("Mensaje de Advertencia","El subescalafon ya se encuentra registrado","warning"); 
                    } else {
                        Swal.fire("Mensaje de Confirmacion","Datos Guardados Correctamente","success");
                        me.cerrarModal();
                        me.listarSubescalafon(1,'','nombre');  
                    }  
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            CambiarEstado(op, id){
                Swal.fire({
                    title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' el Subescalafon?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
                }).then((result) => {
                    if (result.value) {
                        this.fullscreenLoading = true;
                        var url ='/subescalafon/cambiarEstado'
                        axios.post(url, {
                            'id'   :   id,
                            'estado'    :   (op == 1) ? '0' : '1'
                        }).then(response => {
                            
                            Swal.fire({
                                icon    :   'success',
                                title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el Subescalafon',
                                showConfirmButton   : false,
                                timer   :   1500
                            })
                            this.listarSubescalafon(1,'','descripcion');
                        })
                    }
                })
            },
            validarSubescalafon(){
                this.errorSubescalafon=0;
                this.errorMostrarMsjSubescalafon =[];

                if (!this.nombre_subescalafon) this.errorMostrarMsjSubescalafon.push("El nombre de la Subescalafon no puede estar vacío.");
                if (!this.esca_cod) this.errorMostrarMsjSubescalafon.push("Debe seleccionar un escalafon");
                if (!this.orden) this.errorMostrarMsjSubescalafon.push("Asigne un orden.");

                if (this.errorMostrarMsjSubescalafon.length) this.errorSubescalafon = 1;

                return this.errorSubescalafon;
            },
            validarSubescalafon_edit(){
                this.errorSubescalafon_edit=0;
                this.errorMostrarMsjSubescalafon_edit =[];

                if (!this.subesc_nombre_edit) this.errorMostrarMsjSubescalafon_edit.push("El nombre de la Subescalafon no puede estar vacío.");
                if (!this.esca_codigo_edit) this.errorMostrarMsjSubescalafon_edit.push("Debe seleccionar un escalafon");
                if (!this.orden_edit) this.errorMostrarMsjSubescalafon_edit.push("Asigne un orden.");

                if (this.errorMostrarMsjSubescalafon_edit.length) this.errorSubescalafon_edit = 1;

                return this.errorSubescalafon_edit;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre_subescalafon='';
                this.esca_cod='';
                 this.orden='';
                this.subesca_obs='';
                $('#ModalRegistro').modal('hide');
                $('#ModalEditar').modal('hide');
            },
            abrirModalRegistro(){
                $('#ModalRegistro').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                $(".modal-title-registro").text("Registrar Subescalafon");
                this.selectEscalafon();
            },
            abrirModalEditar(subescalafon){
                this.subesca_id_edit = subescalafon.id,
                this.subesc_nombre_edit = subescalafon.nombre,
                this.esca_codigo_edit = subescalafon.esca_cod,
                this.orden_edit = subescalafon.orden,
                this.subesca_obs_edit = subescalafon.subesca_obs,
                $('#ModalEditar').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                $(".modal-title-edit").text("Editar Subescalafon");
                this.selectEscalafon();
            },
            onlyNumber ($event) { //SOLO NUMEROS
                //console.log($event.keyCode); //keyCodes value
                let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
                if ((keyCode < 48 || keyCode > 57)) { // 46 is dot
                    $event.preventDefault();
                }
            },
            alphanumeric ($event) { //SOLO NUMEROS
                //console.log($event.keyCode); //keyCodes value
                let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
                if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && (keyCode < 48 || keyCode > 57) && keyCode !== 45) { // 46 is dot
                    $event.preventDefault();
                }
            },
            onlyletters ($event) { //SOLO LETRAS
                //console.log($event.keyCode); //keyCodes value
                let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
                if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122)) { // 46 is dot
                    $event.preventDefault();
                }
            },
            numDoc ($event) { //SOLO NUMEROS
                //console.log($event.keyCode); //keyCodes value
                let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
                if ((keyCode < 48 || keyCode > 57) && keyCode !== 47) { // 46 is dot
                    $event.preventDefault();
                }
            },
        },
        mounted() {
            this.listarSubescalafon(1,this.buscar,this.criterio);
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