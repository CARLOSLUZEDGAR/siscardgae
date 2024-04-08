<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="fas fa-align-right nav-icon"></i>
              Grados
              <small></small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Grados</li>
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
                        <button v-if="$auth.can('insert-gra')" type="button" @click="abrirModalRegistro()" class="btn btn-info">
                            <i class="fas fa-plus-circle"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-4" v-model="criterio">
                                      <option value="nombre">Descripción</option>
                                      <option value="abreviatura">Abreviatura</option>
                                    </select>
                                    <input type="text" style="text-transform:uppercase;" v-model="buscar" @keyup.enter="listarGrado(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarGrado(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 14px;">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="width:50px; text-align:center">Opciones</th>
                                        <th style="width:70px; text-align:center">Descripción</th>
                                        <th style="width:60px; text-align:center">Abreviatura</th>
                                        <th style="width:70px;">Subescalafon</th>
                                        <th style="width:40px; text-align:center">Escalafon</th>
                                        <th style="width:50px; text-align:center">Fuerza</th>
                                        <th style="width:20px; text-align:center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="grado in arrayGrado" :key="grado.id">
                                        <td style="width:50px; text-align:center">
                                            <template v-if="grado.estado == '1'">
                                                <button v-if="$auth.can('edit-gra')" type="button" @click="abrirModalEditar(grado)" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </button> &nbsp;
                                                <button v-if="$auth.can('delete-gra')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, grado.id)">
                                                    <i class="fas fa-trash"></i>
                                                </button>  &nbsp;
                                            
                                            </template>
                                            <template v-else>
                                                <button v-if="$auth.can('delete-gra')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, grado.id)">
                                                    <i class="far fa-times-circle"></i>
                                                </button>
                                            </template>
                                        </td>
                                        <td v-text="grado.nombre"></td>
                                        <td style="width:60px;" v-text="grado.abreviatura"></td>
                                        <td v-text="grado.subescalafon"></td>
                                        <td style="width:40px; text-align:center" v-text="grado.escalafon"></td>
                                        <td style="width:50px; text-align:center" v-text="grado.fuerza"></td>
                                        <td style="width:20px; text-align:center">
                                            <div v-if="grado.estado">
                                                <span class="badge badge-success">Activo</span>
                                            </div>
                                            <div v-else>
                                                <span class="badge badge-danger">Inactivo</span>
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
                                        <label class="col-md-3 form-control-label" for="email-input">Subescalafón</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="subesc_cod">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="subescalafon in arraySubescalafon" :key="subescalafon.id" :value="subescalafon.id" v-text="subescalafon.nombre"></option>
                                            </select>                                       
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="nombre" class="form-control" @keypress="onlyletters" placeholder="Descripción de grado" style="text-transform:uppercase"> 
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Abreviatura</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="abreviatura" @keypress="alphanumeric" class="form-control" placeholder="Abreviaatura de Grado" style="text-transform:uppercase"> 
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Fuerza</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="fuerza" class="form-control" @keypress="onlyletters" placeholder="Ingrese Fuerza" style="text-transform:uppercase">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Orden</label>
                                        <div class="col-md-9">
                                            <input type="number" v-model="orden" @keypress="onlyNumber" class="form-control" placeholder="Ingrese descripción" style="text-transform:uppercase">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Observación</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="observacion" class="form-control" placeholder="Ingrese descripción" style="text-transform:uppercase">
                                        </div>
                                    </div>

                                    <div v-show="errorGrado" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjGrado" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="registrarGrado()">Guardar</button>
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
                                        <label class="col-md-3 form-control-label" for="email-input">Subescalafón</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="subesc_cod_edit">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="subescalafon in arraySubescalafon" :key="subescalafon.id" :value="subescalafon.id" v-text="subescalafon.nombre"></option>
                                            </select>                                       
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="nombre_edit"  @keypress="onlyletters" class="form-control" placeholder="descripcion de grado" style="text-transform:uppercase"> 
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Abreviatura</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="abreviatura_edit" @keypress="alphanumeric" class="form-control" placeholder="Abreviaatura de Grado" style="text-transform:uppercase">  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Fuerza</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="fuerza_edit" @keypress="onlyletters" class="form-control" placeholder="Ingrese Fuerza" style="text-transform:uppercase">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Orden</label>
                                        <div class="col-md-9">
                                            <input type="number" v-model="orden_edit" @keypress="onlyNumber" class="form-control" placeholder="Ingrese descripción" style="text-transform:uppercase">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Observación</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="observacion_edit" class="form-control" placeholder="Ingrese descripción" style="text-transform:uppercase">
                                        </div>
                                    </div>

                                    <div v-show="errorGrado_edit" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjGrado_edit" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>


                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="actualizarGrado()">Editar</button>
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
               
                grado_id : 0,
                subesc_cod: 0,
                abreviatura : '',
                nombre: '',
                fuerza : '',
                orden : '',
                observacion: '',
                //edit
                grado_id_edit : 0,
                subesc_cod_edit: 0,
                abreviatura_edit : '',
                nombre_edit : '',
                fuerza_edit : '',
                orden_edit : '',
                observacion_edit: '',

                arrayGrado : [],
                arraySubescalafon :[],
             
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorGrado : 0,
                errorGrado_edit : 0,
                errorMostrarMsjGrado_edit : [],
                errorMostrarMsjGrado : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
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
            listarGrado (page,buscar,criterio){
                let me=this;
                axios
                .post("/grados", {
                    buscar: buscar.toUpperCase(),
                    criterio: criterio,
                    page: page
                })
                .then(function (response) {
                    var respuesta= response.data;
                    me.arrayGrado = respuesta.grados.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectSubescalafon(){
                let me=this;
                var url= '/subescalafon/selectSubescalafon';
                axios.get(url).then(function (response) {
                   // 
                    var respuesta= response.data;
                    me.arraySubescalafon = respuesta.subescalafones;
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
                me.listarGrado(page,buscar,criterio);
            },
            registrarGrado(){
                if (this.validarGrado()){
                    return;
                }
                
                let me = this;

                axios.post('/grado/registrar',{
                    'subesc_cod': this.subesc_cod,
                    'nombre': this.nombre.toUpperCase(),
                    'abreviatura': this.abreviatura.toUpperCase(),
                    'fuerza': this.fuerza.toUpperCase(),
                    'orden': this.orden,
                    'observacion': this.observacion.toUpperCase()
                }).then(function (response) {
                    if(response.data=="existe"){
                        Swal.fire("Mensaje de Advertencia","El Grado ya se encuentra registrado!!!!","warning"); 
                    } else {
                        Swal.fire("Mensaje de Confirmación","Datos Guardados Correctamente","success");
                        me.cerrarModal();
                        me.listarGrado(1,'','nombre');
                    }   
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarGrado(){
               if (this.validarGrado_Edit()){
                    return;
                }
                
                let me = this;

                axios.put('/grado/actualizar',{
                    'nombre': this.nombre_edit.toUpperCase(),
                    'abreviatura': this.abreviatura_edit.toUpperCase(),
                    'subesc_cod': this.subesc_cod_edit,
                    'orden': this.orden_edit,
                    'fuerza': this.fuerza_edit.toUpperCase(),
                    'observacion': this.observacion_edit.toUpperCase(),
                    'id': this.grado_id_edit
                }).then(function (response) {
                    if(response.data=="existe"){
                        Swal.fire("Mensaje de Advertencia","El Grado ya se encuentra registrado!!!!","warning"); 
                    } else {
                        Swal.fire("Mensaje de Confirmacion","Datos Editados Correctamente","success");
                        me.cerrarModal();
                        me.listarGrado(1,'','nombre');
                    }  
                }).catch(function (error) {
                    console.log(error);
                }); 
            }, 
            CambiarEstado(op, id){
                Swal.fire({
                    title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' el Grado?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
                }).then((result) => {
                    if (result.value) {
                        this.fullscreenLoading = true;
                        var url ='/grado/cambiarEstado'
                        axios.post(url, {
                            'id'   :   id,
                            'estado'    :   (op == 1) ? '0' : '1'
                        }).then(response => {
                            
                            Swal.fire({
                                icon    :   'success',
                                title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el Grado',
                                showConfirmButton   : false,
                                timer   :   1500
                            })
                            this.listarGrado(1,'','gra_nombre');
                        })
                    }
                })
            },         
            validarGrado(){
                this.errorGrado=0;
                this.errorMostrarMsjGrado =[];

                if (!this.subesc_cod) this.errorMostrarMsjGrado.push("Debe seleccionar un subescalafon.");
                if (!this.nombre) this.errorMostrarMsjGrado.push("la descripcion de grado no puede estar vacío.");
                if (!this.abreviatura) this.errorMostrarMsjGrado.push("La abreviatura de grado no puede estar vacío.");
                if (!this.fuerza) this.errorMostrarMsjGrado.push("El campo FUERZA no puede estar vacio.");
                if (!this.orden) this.errorMostrarMsjGrado.push("El campo ORDEN no puede estar vacío.");
                if (this.errorMostrarMsjGrado.length) this.errorGrado = 1;

                return this.errorGrado;
            },
            validarGrado_Edit(){
                this.errorGrado_edit=0;
                this.errorMostrarMsjGrado_edit =[];

                if (!this.subesc_cod_edit) this.errorMostrarMsjGrado.push("Debe seleccionar un subescalafon.");
                if (!this.nombre_edit) this.errorMostrarMsjGrado.push("la descripcion de grado no puede estar vacío.");
                if (!this.abreviatura_edit) this.errorMostrarMsjGrado.push("La abreviatura de grado no puede estar vacío.");
                if (!this.fuerza_edit) this.errorMostrarMsjGrado.push("El campo FUERZA no puede estar vacio.");
                if (!this.orden_edit) this.errorMostrarMsjGrado.push("El campo ORDEN no puede estar vacío.");
                if (this.errorMostrarMsjGrado_edit.length) this.errorGrado_edit = 1;

                return this.errorGrado_edit;
            },
            cerrarModal(){
                this.subesc_codigo='';
                this.gra_abreviatura='';
                this.gra_nombre='';
                this.fuerza='';
                this.orden='';
                this.observacion='';
                $('#ModalRegistro').modal('hide');
                $('#ModalEditar').modal('hide');
             
            },
            abrirModalRegistro(){
                $('#ModalRegistro').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                $(".modal-title-registro").text("Registrar Grado");
                this.selectSubescalafon();
            },
            abrirModalEditar(grado){
                this.grado_id_edit = grado.id,
                this.nombre_edit = grado.nombre,
                this.abreviatura_edit = grado.abreviatura,
                this.subesc_cod_edit = grado.subesc_cod,
                this.orden_edit = grado.orden,
                this.fuerza_edit = grado.fuerza,
                this.observacion_edit = grado.observacion,
                $('#ModalEditar').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                $(".modal-title-edit").text("Editar Grado");
                this.selectSubescalafon();
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
                if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && (keyCode < 48 || keyCode > 57) && keyCode !== 45 && keyCode !== 46) { // 46 is dot
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
            this.listarGrado(1,this.buscar,this.criterio);
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