<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                        <i class="nav-icon fas fa-file-word"></i>
                            Doc. de Ascenso
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Doc. de Ascenso</li>
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
                                            <button v-if="$auth.can('insert-docasc')" type="button" @click="abrirModalRegistro()" class="btn btn-info">
                                                <i class="fas fa-plus-circle"></i>&nbsp;Nuevo
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <select class="form-control col-md-3" v-model="criterio">
                                                            <option value="nrodocumento">Nro. Doc.</option>
                                                            <option value="documento">Documento</option>
                                                            <option value="fechadocumento">Fecha</option>
                                                        </select>
                                                        <input type="text" style="text-transform:uppercase" v-model="buscar" @keyup.enter="listarDocumento(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                                        <button type="submit" @click="listarDocumento(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                                                <table class="table table-bordered table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:100px; text-align:center">Opciones</th>
                                                            <th style="width:100px; text-align:center">Nro. Documento</th>
                                                            <th style="width:100px; text-align:center">Documento</th>
                                                            <th style="width:100px; text-align:center">Fecha</th>
                                                            <th style="width:60px; text-align:center">Observación</th>
                                                            <th style="width:30px; text-align:center">Estado</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="documento in arrayDocumento" :key="documento.id">
                                                            <td style="width:100px; text-align:center">
                                                                <template v-if="documento.estado == '1'">
                                                                    <button v-if="$auth.can('edit-docasc')" type="button" @click="abrirModalEditar(documento)" class="btn btn-warning btn-sm">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button> &nbsp;
                                                                    <button v-if="$auth.can('delete-docasc')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, documento.id)">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>  &nbsp;
                                                                </template>
                                                                <template v-else>
                                                                    <button v-if="$auth.can('delete-docasc')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, documento.id)">
                                                                        <i class="far fa-times-circle"></i>
                                                                    </button>
                                                                </template>
                                                            </td>
                                                            <td style="width:100px; text-align:center" v-text="documento.nrodocumento"></td>
                                                            <td v-text="documento.documento"></td>
                                                            <td style="width:100px; text-align:center" v-text="documento.fechadocumento"></td>
                                                            <td style="width:60px; text-align:center" v-text="documento.observacion"></td>
                                                            <td style="width:30px; text-align:center">
                                                                <div v-if="documento.estado">
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
                                                        <label class="col-md-3 form-control-label" for="text-input">Nro. de Documento</label>
                                                        <div class="col-md-9">
                                                            <input type="text" v-model="nrodocumento" @keypress="numDoc" class="form-control" placeholder="01/2020">
                                                        </div>
                                                    </div>
                                                <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Documento</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="documento">
                                                                <option value="ORDEN DE ASCENSO">ORDEN DE ASCENSO</option>
                                                                <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                                                                <option value="OOGGFFAA">OOGGFFAA</option>
                                                                <option value="RESOLUCION TPFAB">RESOLUCION TPFAB</option>
                                                                <option value="RESOLUCION CAMARAL">RESOLUCION CAMARAL</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                                        <div class="col-md-9">
                                                           <!-- <date-picker class="dat" value-type="date" format="DD/MM/YYYY"
                                                                v-model="fechadocumento"
                                                                :disabled-date="fechaactual"
                                                            ></date-picker>   -->
                                                            <input type="date" v-model="fechadocumento" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Observación</label>
                                                        <div class="col-md-9">
                                                            <input type="text" v-model="observacion" class="form-control"  style="text-transform:uppercase" placeholder="Observacion">
                                                        </div>
                                                    </div>

                                                    <div v-show="errorDocumento" class="form-group row div-error">
                                                        <div class="text-center text-error">
                                                            <div v-for="error in errorMostrarMsjDocumento" :key="error" v-text="error">

                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" @click="registrarDocumento()">Guardar</button>
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
                                                <h4 class="modal-title">Editar Documento de Ascenso</h4>
                                                <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Nro. de Documento</label>
                                                        <div class="col-md-9">
                                                            <input type="text" v-model="nrodocumento_edit" @keypress="numDoc" class="form-control" placeholder="01/2020">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Documento</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" v-model="documento_edit">
                                                                <option value="ORDEN DE ASCENSO">ORDEN DE ASCENSO</option>
                                                                <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                                                                <option value="OOGGFFAA">OOGGFFAA</option>
                                                                <option value="RESOLUCION TPFAB">RESOLUCION TPFAB</option>
                                                                <option value="RESOLUCION CAMARAL">RESOLUCION CAMARAL</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                                        <div class="col-md-9">
                                                            <input type="date" v-model="fechadocumento_edit" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 form-control-label" for="text-input">Observación</label>
                                                        <div class="col-md-9">
                                                            <input type="text" v-model="observacion_edit"  style="text-transform:uppercase" class="form-control" placeholder="Observacion">
                                                        </div>
                                                    </div>

                                                    <div v-show="errorDocumento_editar" class="form-group row div-error">
                                                        <div class="text-center text-error">
                                                            <div v-for="error in errorMostrarMsjDocumento_editar" :key="error" v-text="error">

                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" @click="actualizarDocumento()">Guardar</button>
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
            const today = new Date();
            return {
                documento_id: 0,
                nrodocumento : '',
                documento : '',
                fechadocumento: new Date(today.getTime()),
                observacion : '',
                documento_id_edit: 0,
                nrodocumento_edit : '',
                documento_edit : '',
                fechadocumento_edit: new Date(today.getTime()),
                observacion_edit :'',
                arrayDocumento : [],


                modal : 0,
                errorDocumento : 0,
                errorMostrarMsjDocumento : [],
                errorDocumento_editar : 0,
                errorMostrarMsjDocumento_editar : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nrodocumento',
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
            listarDocumento(page,buscar,criterio){
                let me = this;
                axios
                .post("/personaldocumento", {
                    buscar: buscar.toUpperCase(),
                    criterio: criterio,
                    page: page
                })
                .then(function (response) {
                    var respuesta= response.data;
                    me.arrayDocumento = respuesta.ascensos.data;
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
                me.listarDocumento(page,buscar,criterio);
            },
            registrarDocumento(){
                if (this.validarDocumento()){
                    return;
                }
                let me = this;
                axios.post('/personaldocumento/registrar',{
                    'nrodocumento': this.nrodocumento,
                    'documento': this.documento,
                    'fechadocumento': this.fechadocumento,
                    'observacion': this.observacion.toUpperCase(),
                }).then(function (response) {
                     if(response.data=="existe"){
                        Swal.fire("Mensaje de Advertencia","El Documento  y el Número ya existe registrado","warning");
                    } else {
                        Swal.fire("Mensaje de Confirmacion","Datos Guardados Correctamente","success");
                        me.cerrarModal();
                        me.listarDocumento(1,'','nrodocumento');
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarDocumento(){
                let me = this;
                axios.put('/personaldocumento/actualizar',{
                    'nrodocumento': this.nrodocumento_edit,
                    'documento': this.documento_edit,
                    'fechadocumento': this.fechadocumento_edit,
                     'observacion': this.observacion_edit.toUpperCase(),
                    'id': this.documento_id_edit
                }).then(function (response) {
                   if(response.data=="existe"){
                        Swal.fire("Mensaje de Advertencia","El Documento  y el Número ya existe registrado","warning");
                    } else {
                        Swal.fire("Mensaje de Confirmacion","Datos Actualizados Correctamente","success");
                        me.cerrarModal();
                        me.listarDocumento(1,'','nrodocumento');
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarDocumento(){
                this.errorDocumento=0;
                this.errorMostrarMsjDocumento =[];

                if (!this.nrodocumento) this.errorMostrarMsjDocumento.push("El número de documento no puede estar vacío.");
                 if (!this.documento) this.errorMostrarMsjDocumento.push("El documento no puede estar vacío.");
                 if (!this.fechadocumento) this.errorMostrarMsjDocumento.push("La fecha no puede estar vacío.");
                if (this.errorMostrarMsjDocumento.length) this.errorDocumento = 1;

                return this.errorDocumento;
            },
            validarDocumento_editar(){
                this.errorDocumento_edit=0;
                this.errorMostrarMsjDocumento_edit =[];

                if (!this.nrodocumento_editar) this.errorMostrarMsjDocumento_editar.push("El número de documento no puede estar vacío.");
                 if (!this.documento_editar) this.errorMostrarMsjDocumento_editar.push("El documento no puede estar vacío.");
                 if (!this.fechadocumento_editar) this.errorMostrarMsjDocumento_editar.push("La fecha no puede estar vacío.");
                if (this.errorMostrarMsjDocumento_editar.length) this.errorDocumento_editar = 1;

                return this.errorDocumento;
            },
            cerrarModal(){
                this.asc_nrodocumento ='';
                this.asc_documento ='';
                this.asc_fechadocumento ='';
                this.errorDocumento = 0;
                $('#ModalRegistro').modal('hide');
                $('#ModalEditar').modal('hide');
            },
            abrirModalRegistro(){
                $('#ModalRegistro').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                $(".modal-title-registro").text("Registrar Documento de Ascenso");
            },
            abrirModalEditar(documento){
                this.documento_id_edit = documento.id,
                this.nrodocumento_edit = documento.nrodocumento,
                this.documento_edit = documento.documento,
                this.fechadocumento_edit = documento.fechadocumento,
                this.observacion_edit = documento.observacion,
               // console.log(documento);

                $('#ModalEditar').modal('show');
                $(".modal-header").css("background-color", "#007bff");
                $(".modal-header").css("color", "white" );
                $(".modal-title-editar-instancia").text("Editar Documento de Ascenso");
                $
            },
            CambiarEstado(op, id){
                Swal.fire({
                    title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + 'este numero de Documento?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
                }).then((result) => {
                    if (result.value) {
                        this.fullscreenLoading = true;
                        var url ='/documento/cambiarEstado'
                        axios.post(url, {
                            'id'   :   id,
                            'estado'    :   (op == 1) ? '0' : '1'
                        }).then(response => {

                            Swal.fire({
                                icon    :   'success',
                                title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + 'este numero de Documento',
                                showConfirmButton   : false,
                                timer   :   1500
                            })
                            this.listarDocumento(1,'','nrodocumento');
                        })
                    }
                })
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
            onlyletters ($event) { //SOLO NUMEROS
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
            fechaactual(date){
                const today = new Date();
                console.log(today);
                today.setHours(0, 0, 0, 0);
                return  date > new Date(today.getTime());
            },
        },
        mounted() {
            this.listarDocumento(1,this.buscar,this.criterio);
        }
    }
</script>
<style>
    .dat {
        width: 100% !important;
    }

</style>
