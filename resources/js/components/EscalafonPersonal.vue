<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">            
                        <h1>
                            <i class="fas fa-chalkboard-teacher nav-icon"></i>
                            Escalafón Personal
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Escalafón Personal</li>
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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                       
                                        <img v-bind:src="'../img/personal/'+arrayDatosPersonal.per_foto" class="rounded float-left img-fluid" width="150" height="150">
                                    </div>
                        
                                    <div class="col-md-10 d-flex align-items-center">
                                        <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                            <!-- FILA 1 -->
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">GRADOS Y NOMBRES</dt>
                                                        <dd class="st">{{ arrayDatosPersonal.gra_abreviatura }} {{ arrayDatosPersonal.estu_abreviatura }} {{ arrayDatosPersonal.per_nombre }} {{ arrayDatosPersonal.per_paterno }} {{ arrayDatosPersonal.per_materno }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-4">
                                                    <dl>
                                                        <dt class="st">CARNET MILITAR</dt>
                                                        <dd class="st">{{ arrayDatosPersonal.per_cm }}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <!-- FILA 2 -->
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">CARNET DE IDENTIDAD</dt>
                                                        <dd class="st">{{ arrayDatosPersonal.per_ci }} {{ arrayDatosPersonal.per_expedido }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">ESCALAFON-SUBESCALAFON-GRADO ACTUAL</dt>
                                                        <dd class="st">{{ arrayDatosPersonal.esca_nombre }} - {{arrayDatosPersonal.subesca_nombre}} - {{arrayDatosPersonal.gra_nombre}}</dd>
                                                    </dl>
                                                </div>

                                            </div>
                                            <!-- FILA 3 -->
                                            <div class="row p-2 bd-highlight justify-content-center">
                                                <div class="col-md-4">                                            
                                                    <button v-if="$auth.can('insert-peresc')" type="button" class="btn btn-primary btn-sm btn-block" @click="abrirModalRegistro()">
                                                        <i class="fas fa-plus"> Nuevo</i>
                                                    </button> &nbsp;
                                                </div>
                                                <div class="col-md-4">                                      
                                                    <button v-if="$auth.can('report-peresc')" type="button" class="btn btn-secondary btn-sm btn-block" @click="generarReporte(per_codigo)">
                                                        <i class="far fa-file-alt" aria-hidden="true"> Reporte</i>
                                                    </button> &nbsp;
                                                </div>
                                                <div class="col-md-4">                        
                                                     <router-link class="btn btn-danger btn-sm btn-block" :to="'/listarEscalafonPersonal'">
                                                        <i class="fas fa-reply"></i>&nbsp; Volver Atras
                                                    </router-link>
                                                </div>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>                                                           
                            </div>
                        <!-- /.card -->
                        </div>
                        
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                                    <template v-if="arrayListaEscalafon.length > 0">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width:10%; text-align:center">Opciones</th>
                                                    <th style="width:8%; text-align:center">Fecha</th>
                                                    <th style="width:40px; text-align:center">Escalafón</th>
                                                    <th style="width:50px; text-align:center">Sub Escalafón</th>
                                                    <th style="width:5%; text-align:center">Grado</th>
                                                    <th style="width:50px; text-align:center">Documento</th>
                                                    <th style="width:10%; text-align:center">Número Doc.</th>
                                                    <th style="width:10%; text-align:center">Estado</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="listarEscalafonPer in arrayListaEscalafon" :key="listarEscalafonPer.id">
                                                    <td style="width:10%; text-align:center">
                                                        <button v-if="$auth.can('edit-peresc')" type="button" @click="abrirModalEditar(listarEscalafonPer)" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </button> &nbsp;
                                                    <!--  <template v-if="listarEscalafonPer.estado">
                                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarEscalafonPersonal(listarEscalafonPer.id)">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </template>
                                                        <template v-else>
                                                            <button type="button" class="btn btn-info btn-sm" @click="activarEscalafonPersonal(listarEscalafonPer.id)">
                                                                <i class="far fa-check-circle"></i>
                                                            </button>
                                                        </template>  -->
                                                    </td>
                                                    <td style="width:8%; text-align:center">{{listarEscalafonPer.fecha_doc | moment("D/MM/YYYY")}}</td>
                                                    <td style="width:40px; text-align:center" v-text="listarEscalafonPer.escalafon_nombre"></td>
                                                    <td v-text="listarEscalafonPer.subesc_nombre"></td>
                                                    <td style="width:5%; text-align:center" v-text="listarEscalafonPer.grados"></td>
                                                    <!-- moment("D/MM/YYYY") cambiar formato de fecha -->
                                                
                                                    <td style="width:10%; text-align:center" v-text="listarEscalafonPer.documento"></td>
                                                    <td style="width:50px; text-align:center" v-text="listarEscalafonPer.nro_doc"></td>
                                                    <td style="width:10%; text-align:center">
                                                        <div v-if="listarEscalafonPer.estado">
                                                            <span class="badge badge-success">Actual</span>
                                                        </div>
                                                        <div v-else>
                                                            <span class="badge badge-danger">Anterior</span>
                                                        </div>   
                                                    </td> 
                                                </tr>
                                            </tbody>
                                            
                                        </table>
                                        
                                    </template>
                                    <template v-else>
                                        <div class="callout callout-info">
                                            <h5><i class="fas fa-info"></i> Nota:</h5>
                                            No tiene registrado ningun Escalafón!!!!
                                        </div>
                                    </template>   
                                </div>                                                        
                            </div>
                        <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- ./row -->
            </div>
            <!-- /.container-fluid -->
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="ModalRegistro" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-xl" role="document">
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
                                    <label class="col-md-2 form-control-label" for="text-input">Escalafón</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="escalafon_id"  v-on:change="changeItem1(rowId, $event)">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="escalafon in arrayEscalafon" :key="escalafon.id" :value="escalafon.id" v-text="escalafon.nombre"></option>
                                        </select>
                                    </div>

                                    <label class="col-md-2 form-control-label" for="text-input">Sub-Escalafón</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="subescalafon_id" v-on:change="changeItem2(rowId, $event)">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="subescalafon in arraySubescalafon" :key="subescalafon.id" :value="subescalafon.id" v-text="subescalafon.nombre"></option>
                                        </select>
                                    </div>
                                </div>
                             
                                
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Grado</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="grado_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="grado in arrayGrado" :key="grado.id" :value="grado.id" v-text="grado.nombre"></option>
                                        </select>
                                    </div>

                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Doc.</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="documento">
                                            <option value="0" disabled>Seleccione</option>
                                            <option value="MEMORAMDUM">MEMORAMDUM</option>
                                            <option value="ORDEN DE ASCENSO">ORDEN DE ASCENSO</option>
                                            <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                                           
                                        </select>  
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="">Núm. de Doc.</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control"  @keypress="numDoc" v-model="nro_doc" placeholder="01/2021 (* cumpla el formato)">  
                                    </div>

                                    <label class="col-md-2 form-control-label" for="">Fecha de Doc.</label>
                                    <div class="col-md-4">
                                        <date-picker class="dat" value-type="date" format="DD/MM/YYYY"
                                        v-model="fecha_doc"
                                        :disabled-date="fechaactual"
                                        
                                    ></date-picker>
                                    </div>  
                                </div>
   
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="">Observaciones</label>
                                    <div class="col-md-10">
                                        <textarea type="text" v-model="observacion" class="form-control" placeholder="Observación" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                    </div>
                                </div>
                                <div v-show="errorEscalafonPersonal" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjEscalafonPersonal" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-primary" @click="registrarEscalafonPersonal()">Guardar</button>
                            <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

            <!--Inicio del modal editar-->
            <div class="modal fade" id="ModalEditar" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-xl" role="document">
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
                                    <label class="col-md-2 form-control-label" for="text-input">Escalafón</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="escalafon_id_edit"  v-on:change="changeItem1(rowId, $event)">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="escalafon in arrayEscalafon" :key="escalafon.id" :value="escalafon.id" v-text="escalafon.nombre"></option>
                                        </select>
                                    </div>
                                
                                    <label class="col-md-2 form-control-label" for="text-input">Sub-Escalafón</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="subescalafon_id_edit" v-on:change="changeItem2(rowId, $event)">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="subescalafon in arraySubescalafon" :key="subescalafon.id" :value="subescalafon.id" v-text="subescalafon.nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Grado</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="grado_id_edit">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="grado in arrayGrado" :key="grado.id" :value="grado.id" v-text="grado.nombre"></option>
                                        </select>
                                    </div>
                                
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Doc.</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="documento_edit">
                                            <option value="0" disabled>Seleccione</option>
                                            <option value="MEMORAMDUM">MEMORAMDUM</option>
                                            <option value="ORDEN GENERAL DE ASCENSO">ORDEN GENERAL DE ASCENSO</option>
                                            <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                                        </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="">Núm. de Doc.</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" v-model="nro_doc_edit"  @keypress="numDoc">  
                                    </div>
                                
                                    <label class="col-md-2 form-control-label" for="">Fecha de Doc.</label>
                                    <div class="col-md-4">
                                        <input type="date" v-model="fecha_doc_edit" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="">Observaciones</label>
                                    <div class="col-md-10">
                                        <textarea type="text" v-model="observaciones_edit" class="form-control" placeholder="Observación" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                    </div>
                                </div>
                                <div v-show="errorEscalafonPersonal_edit" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjEscalafonPersonal_edit" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-primary" @click="actualizarEscalafonPersonal()">Actualizar</button>
                            <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
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
    data() {
        const today = new Date();
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.e,   /// PUES ACA LLAMAS ELMPARAMETRO d
            
            // DESDE ACA LA TABLE
            // DESDE ACA LA TABLE
        
            escalafon_id : 0,
            subescalafon_id : 0,
            grado_id : 0,
            documento :'',
            fecha_doc : new Date(today.getTime()),
            fecha : '',
            observacion : '',
            nro_doc : '',
            //edit
            escalafonPersonal_id_edit : 0,
            escalafon_id_edit : 0,
            subescalafon_id_edit : 0,
            grado_id_edit : 0,
            documento_edit :'',
            fecha_doc_edit :'',
            fecha_edit : '',
            observaciones_edit : '',
            cm_edit : '',
            sy_suser_edit : '',
            nro_doc_edit : '',
            // HASTA ACA LA TABLE
            rowId : 0,
            arrayDatosPersonal :[],    
            arrayEscalafon :[],
            arrayListaEscalafon : [],
            arraySubescalafon :[],
            arrayGrado :[],
            errorEscalafonPersonal :0,
            errorMostrarMsjEscalafonPersonal : [],
            errorEscalafonPersonal_edit :0,
            errorMostrarMsjEscalafonPersonal_edit : [],
            modal:0,
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
            criterio : 'per_nombre',
            buscar : ''

        }
    },
    mounted() {
        this.listarEscalafonPersonal(this.per_codigo);
        this.datosPersonal(this.per_codigo);
    },
    methods: {
        ver(){
            //console.log(this.per_codigo);
            //console.log(this.personal_destinos)
        },
        listarEscalafonPersonal(per_codigo){
            let me = this;
            axios.post("/listarEscalafon", {
            per_codigo : per_codigo,
            }).then(function (response) {
               
            me.arrayListaEscalafon = response.data
            }).catch(function (error) {
            // handle error
                console.log(error);
            })
        }, 
        datosPersonal(per_codigo){
           let me = this;
            axios
          .post("/datosPersonalAscenso", {
            per_codigo : per_codigo,
          })
          .then(function (response) {
            
            me.arrayDatosPersonal = response.data.personal_datos
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },
        validarEscalafonPersonalRegistro(){
            this.errorEscalafonPersonal=0;
            this.errorMostrarMsjEscalafonPersonal =[];

            if(!this.escalafon_id) this.errorMostrarMsjEscalafonPersonal.push("Seleccione Escalafón.");
            if(!this.subescalafon_id) this.errorMostrarMsjEscalafonPersonal.push("Seleccione Subescalafón");
            if(!this.grado_id) this.errorMostrarMsjEscalafonPersonal.push("Seleccione Grado.");
            if(!this.documento) this.errorMostrarMsjEscalafonPersonal.push("Seleccione Tipo de Documento");
            if(!this.nro_doc) this.errorMostrarMsjEscalafonPersonal.push("Debe introducir el Número de Documento");
            if(!this.fecha_doc) this.errorMostrarMsjEscalafonPersonal.push("Debe introducir la fecha del Documento");
            if (this.errorMostrarMsjEscalafonPersonal.length) this.errorEscalafonPersonal = 1;
            return this.errorEscalafonPersonal;
        },
        validarEscalafonPersonalActualizar(){
            this.errorEscalafonPersonal_edit=0;
            this.errorMostrarMsjEscalafonPersonal_edit =[];

            if(!this.escalafon_id_edit) this.errorMostrarMsjEscalafonPersonal_edit.push("Seleccione Escalafón.");
            if(!this.subescalafon_id_edit) this.errorMostrarMsjEscalafonPersonal_edit.push("Seleccione Subescalafón");
            if(!this.grado_id_edit) this.errorMostrarMsjEscalafonPersonal_edit.push("Seleccione Grado.");
            if(!this.documento_edit) this.errorMostrarMsjEscalafonPersonal_edit.push("Seleccione Tipo de Documento");
            if(!this.nro_doc_edit) this.errorMostrarMsjEscalafonPersonal_edit.push("Debe introducir el Numero de Documento"); 
            if(!this.fecha_doc_edit) this.errorMostrarMsjEscalafonPersonal_edit.push("Debe introducir la fecha del Documento");
            if (this.errorMostrarMsjEscalafonPersonal_edit.length) this.errorEscalafonPersonal_edit = 1;
            return this.errorEscalafonPersonal_edit;
        },
        cerrarModal(){
            this.escalafon_id='';
            this.subescalafon_id='';
            this.grado_id='';
            this.flag='';
            this.documento='';
            this.fecha_doc='';
            this.fecha='';
            this.observaciones='';
            this.cm='';
            this.sy_suser='';
            this.nro_doc=''; 
            $('#ModalRegistro').modal('hide');
            $('#ModalEditar').modal('hide');
        },
        abrirModalRegistro(){
            $('#ModalRegistro').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-registro").text("Registrar Escalafon Personal");
            this.selectEscalafon();
            this.selectbuscarSubescalafon(this.esca_codigo);
            this.selectbuscarGrado(this.subesc_codigo);
        },
        abrirModalEditar(listarEscalafonPer){
            this.escalafonPersonal_id_edit = listarEscalafonPer.id,
            this.escalafon_id_edit = listarEscalafonPer.esca_cod,
            this.subescalafon_id_edit = listarEscalafonPer.subesc_cod,
            this.grado_id_edit = listarEscalafonPer.gra_cod,
            this.documento_edit = listarEscalafonPer.documento,
            this.fecha_doc_edit = listarEscalafonPer.fecha_doc,
            this.fecha_doc_edit = this.fecha_doc_edit.substring(0,10);
                                        var info10 = this.fecha_doc_edit.split('-');
                                        this.fecha_doc_edit = info10[0] + '-' + info10[1] + '-' + info10[2];
            this.fecha_edit = listarEscalafonPer.fecha_doc,
            this.fecha_edit = this.fecha_edit.substring(0,10);
                                        var info10 = this.fecha_edit.split('-');
                                        this.fecha_edit = info10[0] + '-' + info10[1] + '-' + info10[2];
            this.observaciones_edit = listarEscalafonPer.observacion,
            this.cm_edit = listarEscalafonPer.cm,
            this. nro_doc_edit = listarEscalafonPer.nro_doc, 
                                      
          //  console.log(listarEscalafonPer.id+' '+listarEscalafonPer.nro_doc);
            $('#ModalEditar').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-edit").text("Editar Escalafon Personal");
            this.selectEscalafon();
            this.selectbuscarSubescalafon(this.esca_codigo);
            this.selectbuscarGrado(this.subesc_codigo);
            this.selectSubescalafon();
            this.selectGrado();
           
           
                
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
        selectGrado(){
            let me=this;
            var url= '/selectGrado';
            axios.get(url).then(function (response) {
                
                var respuesta= response.data;
                me.arrayGrado = respuesta.grados;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        changeItem1: function changeItem1(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarSubescalafon(event.target.value);
        },
        changeItem2: function changeItem2(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarGrado(event.target.value);
        },  
        selectbuscarSubescalafon(id_escalafon){
            let me =this;
            me.buscarD= id_escalafon;
            me.arraySubescalafon=[];
        //  me.prov_codigo=0;
            var url='/subescalafon/selectBuscarSubescalafon?buscar=' + id_escalafon;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arraySubescalafon = respuesta.subescalafon; 
                
            }).catch(function (error) {
            // handle error 
                me.selected =error;
                console.log(error);
            }).then(function () {
            // always executed
            }); 
        },
        selectbuscarGrado(id_subescalafon){
            let me =this;
            me.buscarD= id_subescalafon;
            me.arrayGrado=[];
            var url='/grado/selectBuscarGrado?buscar=' + id_subescalafon;
            me.selected = url;
            axios.get(url).then(function (response) {
               // 
                var respuesta = response.data;
                me.arrayGrado = respuesta.grado; 
                
            }).catch(function (error) {
            // handle error 
                me.selected =error;
                console.log(error);
            }).then(function () {
            // always executed
            }); 
        },
        registrarEscalafonPersonal(){
        
            if (this.validarEscalafonPersonalRegistro()){
                return;
            }
            let me = this;
            axios.post('/escalafonPersonal/registrar',{
                'per_codigo': this.arrayDatosPersonal.per_codigo,
                'esca_cod': this.escalafon_id,
                'subesc_cod': this.subescalafon_id,
                'gra_cod': this.grado_id,
                'documento': this.documento,
                'fecha_doc': this.fecha_doc,
                'fecha': this.fecha_doc,
                'observacion': this.observacion,
                'cm': this.arrayDatosPersonal.per_cm,
                'nro_doc': this.nro_doc
            }).then(function (response) {
                
                if(response.data=="existe"){
                    Swal.fire("Mensaje de Advertencia","Los Datos ya se encuentra registrado!!!!","warning"); 
                } else {
                    Swal.fire("Mensaje de Confirmacion","Datos Guardados Correctamente","success"); 
                    me.cerrarModal();
                    me.datosPersonal(me.per_codigo);
                    me.listarEscalafonPersonal(me.per_codigo);
                }  
            }).catch(function (error) {
                console.log(error);
            });
        },
        actualizarEscalafonPersonal(){
            if(this.validarEscalafonPersonalActualizar()){
                return;
            }
            let me = this;
            axios.put('/escalafonPersonal/actualizar',{
                'id': this.escalafonPersonal_id_edit,
                'per_codigo': this.arrayDatosPersonal.per_codigo,
                'esca_cod': this.escalafon_id_edit,
                'subesc_cod':this.subescalafon_id_edit,
                'gra_cod':this.grado_id_edit,
                'documento':this.documento_edit,
                'fecha_doc':this.fecha_doc_edit,
                'fecha':this.fecha_doc_edit,
                'observacion':this.observaciones_edit,
                'nro_doc':this.nro_doc_edit
            
            }).then(function (response) {
               if(response.data=="existe"){
                    Swal.fire("Mensaje de Advertencia","Los Datos ya se encuentra registrado!!!!","warning"); 
                } else {
                    Swal.fire("Mensaje de Confirmacion","Datos Actualizados Correctamente","success"); 
                    me.cerrarModal();
                    me.datosPersonal(me.per_codigo);
                    me.listarEscalafonPersonal(me.per_codigo);
                } 
            }).catch(function (error) {
                console.log(error);
            });
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
        generarReporte(per_codigo){
            window.open('http://sipefab.fab.bo/reporteEscalafonPersonal?per_codigo='+per_codigo);
        },


    },
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
    .dat {
        width: 100% !important;
    }
</style>