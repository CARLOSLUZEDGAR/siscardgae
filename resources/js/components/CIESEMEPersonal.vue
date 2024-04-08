<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="fas fa-award"></i>
              COMPONENTES CIES Y EME

            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Componente CIES y EME</li>
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
                        <i class="far fa-id-card"></i>
                        DATOS PERSONALES
                        </h3>
                    </div>
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
                                                <dd class="st">{{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-4">
                                            <dl>
                                                <dt class="st">CARNET MILITAR</dt>
                                                <dd class="st">{{arrayDatosPersonal.per_cm}}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-2">
                                            
                                        </div>
                                    </div>
                                    <!-- FILA 2 -->
                                    <div class="row p-2 bd-highlight">
                                        <div class="col-md-6">
                                            <dl>
                                                <dt class="st">CARNET DE IDENTIDAD</dt>
                                                <dd class="st">{{arrayDatosPersonal.per_ci}}</dd>
                                            </dl>
                                        </div>
                                    <!--    <div class="col-md-6">
                                            <dl>
                                                <dt class="st">SITUACION MILITAR ACTUAL</dt>
                                                <dd class="st">{{arrayDatosPersonal.per_ci}}</dd>
                                            </dl>
                                        </div>-->

                                    </div>
                                    <!-- FILA 3 -->
                                    <div class="row p-2 bd-highlight justify-content-center">
                                        <div class="col-md-4"> 
                                            <button v-if="$auth.can('insert-percomp')" class="btn btn-info btn-sm btn-block" @click="abrirModalRegistro()">
                                                <i class="fas fa-plus"> Nuevo</i>
                                            </button>                                           
                                        </div>
                                        <div class="col-md-4"> 
                                            <button v-if="$auth.can('report-percomp')" class="btn btn-secondary btn-sm btn-block" @click="generarReporte(per_codigo)">
                                                <i class="far fa-file-alt" aria-hidden="true">  Reporte</i>
                                            </button> 
                                        </div>
                                        <div class="col-md-4">  
                                            <router-link class="btn btn-danger btn-sm btn-block" data-dismiss="modal" to="/listarPersonalEME" >
                                                <i class="fas fa-reply"></i> &nbsp;
                                                Volver Atras
                                            </router-link>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-bookmark"></i>
                        Listar
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">   
                            <template v-if="arrayListaComponente.length">    
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Acción</th>
                                            <th>Fecha</th>
                                            <th>Tipo Doc.</th>
                                            <th>Nro. Doc.</th>
                                            <th>Designacion</th>
                                            <th>Estado</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="listarComponente in arrayListaComponente" :key="listarComponente.id"> 
                                            <td >
                                                <button v-if="$auth.can('edit-percomp')" type="button" @click="abrirModalEditar(listarComponente)" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </button> &nbsp;
                                            </td>   
                                            <td ><center>{{listarComponente.fecha_doc | moment("D/MM/YYYY")}}</center></td>
                                            <td v-text="listarComponente.documento"></td>
                                            <td v-text="listarComponente.ndoc"></td>
                                            <td v-text="listarComponente.descripcion"></td>
                                            <td>
                                                <div v-if="listarComponente.estado">
                                                    <span class="badge badge-success">Activo</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger">Desactivado</span>
                                                </div>
                                            </td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </template>
                            <template v-else>
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-exclamation-triangle x-lg-2"></i> No se encontraron resultados...</h5>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            </div>
            <!-- ./row -->
        </div>
        <!-- /.container-fluid -->
        <!--Inicio del modal agregar-->
        <div class="modal fade" id="ModalRegistro" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Designacion de Comp. CIEES Y EME DE: {{arrayDatosPersonal.gra_abreviatura}} {{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</h5>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="">Fecha de Designacion</label>
                            <!--    <div class="col-md-9">
                                    <input type="date" v-model="fecha_doc" class="form-control"  :class="{ 'is-invalid' : $v.fecha_doc.$error, 'is-valid':!$v.fecha_doc.$invalid }"> 
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.fecha_doc.required">Seleccione un Opcion</span>
                                    </div> 
                                </div>-->
                                <div class="col-md-9">    
                                    <div class="col-md-12">
                                        <date-picker class="dat" value-type="date" format="DD/MM/YYYY"  v-model="fecha_doc" :disabled-date="fechaactual" :class="{ 'is-invalid' : $v.fecha_doc.$error, 'is-valid':!$v.fecha_doc.$invalid }"></date-picker>
                                        <div class="invalid-feedback">
                                            <span v-if="!$v.fecha_doc.required">Este campo es Requerido</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Designacion</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="comp_cod" :class="{ 'is-invalid' : $v.comp_cod.$error, 'is-valid':!$v.comp_cod.$invalid }">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="componente in arrayComponente" :key="componente.id" :value="componente.id" v-text="componente.descripcion"></option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.comp_cod.required">Seleccione un Opcion</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="">Num. de Doc.</label>
                                <div class="col-md-3">
                                    <input type="text" v-model="ndoc" class="form-control"  :class="{ 'is-invalid' : $v.ndoc.$error, 'is-valid':!$v.ndoc.$invalid }" placeholder="01/2010"> 
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.ndoc.required">Este campo es Requerido</span>
                                    </div> 
                                </div>

                                <label class="col-md-2 form-control-label" for="">Tipo Doc.</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="documento" :class="{ 'is-invalid' : $v.documento.$error, 'is-valid':!$v.documento.$invalid }">
                                        <option value="0" disabled>Seleccione</option>
                                        <option value="MEMORANDUM">MEMORANDUM</option>
                                        <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.documento.required">Seleccione un Opcion</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Observacion</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="observacion" class="form-control" placeholder="Observacion" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">   
                                </div>
                            </div>      

                        </form>
                    </div>

                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-primary" @click="registrarComponentePersonal()">Guardar</button>
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
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                       <h5 class="modal-title">EDITAR DESIGNACION DE COMPONENTE DE: {{arrayDatosPersonal.gra_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</h5>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="">Fecha de Designacion</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fecha_doc_edit" class="form-control"> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Designacion</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="comp_cod_edit">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="componente in arrayComponente" :key="componente.id" :value="componente.id" v-text="componente.descripcion"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="">Num. de Doc.</label>
                                <div class="col-md-3">
                                    <input type="text" v-model="ndoc_edit" class="form-control" placeholder="01/2010"> 
                                </div>

                                <label class="col-md-2 form-control-label" for="">Tipo Doc.</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="documento_edit">
                                        <option value="0" disabled>Seleccione</option>
                                        <option value="MEMORANDUM">MEMORANDUM</option>
                                        <option value="OFICIO">OFICIO</option>
                                        <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                                        <option value="RESOLUCION">RESOLUCION</option>
                                        <option value="TELEFONEMA FAX">TELEFONEMA FAX</option>
                                        <option value="OTROS">OTROS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Observacion</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="observacion_edit" class="form-control" placeholder="Observacion" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">  
                                </div>
                            </div>      

                        </form>
                    </div>

                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-primary" @click="actualizarComponentePersonal()">Actualizar</button>
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
import { required, minLength, maxLength, alpha, numeric, email} from "vuelidate/lib/validators";

export default {
    
    data() {
        const today = new Date();
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.a,   /// PUES ACA LLAMAS ELMPARAMETRO d
            // desde aca
            personal_seleccionado: {},
            componente_id : 0,
            fecha_doc : new Date(today.getTime()),
            comp_cod : 0,
            ndoc : '',
            documento : '',
            observacion : '',

            //edit
            fecha_doc_edit : '',
            comp_cod_edit : 0,
            ndoc_edit : '',
            documento_edit : '',
            observacion_edit : '',

            arrayListaComponente :[],
            arrayDatosPersonal: [],
            arrayComponente : [],
            modal: 0,
        }
    },
    validations:{
        fecha_doc : { required },
        comp_cod : { required },
        ndoc : { required },
        documento : { required },  
       
    },
    mounted() {
        this.ListarComponentePersona(this.per_codigo);
        this.datosPersonal(this.per_codigo);
    },
    methods: { 
        ListarComponentePersona(per_codigo){
            let me = this;
            axios.post("/listarComponentePersona", {
            per_codigo : per_codigo,
            })
            .then(function (response) {
           //    
            me.arrayListaComponente = response.data
            })
            .catch(function (error) {
            // handle error
                console.log(error);
            })
        },
        datosPersonal(per_codigo){
           let me = this;
            axios
          .post("/datosPersonal", {
            per_codigo : per_codigo,
          })
          .then(function (response) {
            console.log(response)
            me.arrayDatosPersonal = response.data.personal_datos
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },
        cerrarModal(){
            $('#ModalRegistro').modal('hide');
            $('#ModalRegistroGeneral').modal('hide');
            $('#ModalEditar').modal('hide');
            this.fecha_doc = '';
            this.comp_cod = '';
            this.ndoc = '';
            this.documento = '';
            this.observacion = '';

            //edit
            this.codasc_edit = '';
            this.promoact_edit = '';
            this.antiguedad_edit = '';
            this.instancia_edit = '';
            this.fechasc_edit = '';
            this.observaciones_edit = '';
            this.antigfin_edit = '';   
        },
        selectComponente(){
            let me=this;
            var url= '/componente/selectComponente';
            axios.get(url).then(function (response) {
                //
                var respuesta= response.data;
                me.arrayComponente = respuesta.componentes;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        registrarComponentePersonal(){
            if(!this.$v.$invalid){

                swal.fire({
                    title: 'Se registrara la designacion de Componente', // TITULO 
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
                            axios.post('/componentePersonal/registrar',{
                                'per_codigo': me.arrayDatosPersonal.per_codigo,
                                'comp_cod': this.comp_cod,
                                'ndoc': this.ndoc,
                                'documento': this.documento,
                                'fecha_doc': this.fecha_doc,
                                'observacion': this.observacion,

                            }).then(function (response) {
                           // 
                            me.cerrarModal();
                            me.datosPersonal(me.per_codigo);
                            me.ListarComponentePersona(me.per_codigo); 
                        }).catch(function (error) {
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
        actualizarComponentePersonal(){
            let me = this;
            axios.put('/componentePersonal/actualizar',{
                'per_codigo': me.arrayDatosPersonal.per_codigo,
                'comp_cod': this.comp_cod_edit,
                'ndoc': this.ndoc_edit,
                'documento': this.documento_edit,
                'fecha_doc': this.fecha_doc_edit,
                'observacion': this.observacion_edit,
                'id': this.componente_id,

            }).then(function (response) {
               // console.log(PaymentResponse);
                Swal.fire("Mensaje de Confirmacion","Datos Actualizados Correctamente","success"); 
                me.cerrarModal();
                me.datosPersonal(me.per_codigo);
                me.ListarComponentePersona(me.per_codigo); 
            }).catch(function (error) {
                console.log(error);
            });         
        },
        abrirModalRegistro(){
            this.selectComponente();
            $('#ModalRegistro').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
           // $(".modal-title").text("Registrar Ascenso Personal");            
        },  
        abrirModalEditar(componente){
            this.fecha_doc_edit = componente.fecha_doc,
            this.fecha_doc_edit = this.fecha_doc_edit.substring(0,10);
                                        var info10 = this.fecha_doc_edit.split('-');
                                        this.fecha_doc_edit = info10[0] + '-' + info10[1] + '-' + info10[2];
            this.comp_cod_edit = componente.comp_cod,
            this.ndoc_edit = componente.ndoc,
            this.documento_edit = componente.documento,
            this.observacion_edit = componente.observacion,
            this.componente_id = componente.id,
            $('#ModalEditar').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
           // $(".modal-title-edit").text("Editar Ascenso Personal");
            this.selectComponente();
   
        },
        generarReporte(per_codigo){
          window.open('http://sipefab.fab.bo/ReportePersonalComponente?per_codigo='+per_codigo);
         // window.open('http://127.0.0.1:8000/ReportePersonalComponente?per_codigo='+per_codigo);
        },

        fechaactual(date){
            const today = new Date();
            console.log(today);
            today.setHours(0,0,0,0);
            return date > new Date(today.getTime());
        },
    },
}
</script>

<style>
.dat{
    width: 100%;
}
</style>