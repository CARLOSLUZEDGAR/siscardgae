<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
                <i class="far fa-bookmark"></i>
                Certificado de Destinos Servicio

                </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Reporte Certificado Servicio</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
                        <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <img v-bind:src="'/destinosPersonal/../img/personal/'+arrayDatosPersonal.per_foto" class="rounded float-left img-fluid" width="150" height="150">
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
                                                </div>
                                                <!-- FILA 2 -->
                                                <div class="row p-2 bd-highlight">
                                                    <div class="col-md-6">
                                                        <dl>
                                                            <dt class="st">CARNET DE IDENTIDAD</dt>
                                                            <dd class="st">{{arrayDatosPersonal.per_ci}} {{arrayDatosPersonal.per_expedido}}</dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <dl>
                                                            <dt class="st">DESTINO ACTUAL</dt>
                                                            <dd class="st">{{arrayDatosPersonal.nomd3}} - {{arrayDatosPersonal.nomd4}}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <!-- FILA 3 -->
                                            </div>
                                        </div>
                                    </div>                                                           
                                </div>
                            <!-- /.card -->
                        </div>

            <div class="card card-primary card-outline">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 d-flex align-items-center">
                        <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                
                            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                              <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th><center>Fecha Destino</center></th>
                                        <th><center>Destino</center></th> 
                                        <th><center>Grado</center></th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="personalDestinos in arrayPersonalDestinos" :key="personalDestinos.id">
                                        <!-- moment("D/MM/YYYY") cambiar formato de fecha -->
                                        <!-- <td ><center>{{personalDestinos.fechadestino | moment("D/MM/YYYY")}}</center></td> -->
                                        <td ><center>{{personalDestinos.fecha_final}}</center></td>
                                        <td>{{personalDestinos.desc_dn2}}&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;{{personalDestinos.desc_dn3}}</td>
                                        <!-- <td>{{personalDestinos.gra_abreviatura}}</td> -->
                                        <td style="width:100px; text-align:center">&nbsp;{{personalDestinos.gra_abreviatura}}&nbsp;
                                            <button type="button" class="btn btn-success btn-sm" @click="ElegirGrado(personalDestinos.idpersonal_destinos)">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button> &nbsp;
                                        </td>
                                        <!-- <td><select class="form-control" v-model="grado">
                                                <option value="0" disabled>SELECCIONE</option>
                                                <option v-for="grados in arrayGrados" :key="grados.id" :value="grados.id"  v-text="grados.abreviatura"></option>
                                            </select>
                                        </td> -->
                                    </tr>
                                </tbody>
                              </table>
                            </div>

                            <div class="row p-2 bd-highlight">
                              <nav>
                                  <!-- inicio para paginacion -->
                              <ul class="pagination">
                                      <li class="page-item" v-if="pagination.current_page > 1">
                                          <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                                      </li>
                                      <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                          <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                                      </li>
                                  
                                      <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                          <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                                      </li>
                                  </ul>
                                  <!-- fin paginacion -->
                              </nav>
                          </div>
                          <div class="row p-2 bd-highlight">                        
                              <div class="col-md-6">
                                    <label class="form-control-label" for="text-input">De:</label>
                                    <input type="date" v-model="fecha_inc" class="form-control" :class="{ 'is-invalid' : $v.fecha_inc.$error, 'is-valid':!$v.fecha_inc.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.fecha_inc.required">Este campo es Requerido</span>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <label class="form-control-label" for="text-input">Hasta:</label>
                                    <input type="date" v-model="fecha_fin" class="form-control" :class="{ 'is-invalid' : $v.fecha_fin.$error, 'is-valid':!$v.fecha_fin.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.fecha_fin.required">Este campo es Requerido</span>
                                    </div>
                              </div>
                            </div>
                            <div class="row p-2 bd-highlight">                        
                              <div class="col-md-6">
                                    <label class="form-control-label" for="text-input">Nro. Documento:</label>
                                    <input type="text" v-model="nro_doc" class="form-control" :class="{ 'is-invalid' : $v.nro_doc.$error, 'is-valid':!$v.nro_doc.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.nro_doc.required">Este campo es Requerido</span>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <label class="form-control-label" for="text-input">Rubrica:</label>
                                    <input type="text" v-model="rubrica" class="form-control" :class="{ 'is-invalid' : $v.rubrica.$error, 'is-valid':!$v.rubrica.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.rubrica.required">Este campo es Requerido</span>
                                    </div>
                              </div>
                            </div>
                            <div class="row p-2 bd-highlight">                        
                                <div class="col-md-12">
                                    <label class="form-control-label" for="text-input">Nota:</label>
                                    <textarea name="textarea" class="form-control" rows="3" v-model="notaSer" placeholder="SIN OBSERVACIONES"></textarea>
                                    <!--<input type="text" v-model="perdest_observacionesA" class="form-control">-->
                                </div>
                            </div>
                            <div class="row p-2 bd-highlight justify-content-center">
                                <div class="col-md-4"> 
                                    <button v-if="$auth.can('report-certdestserv')" type="button" class="btn btn-secondary btn-sm btn-block" @click="DesgServicio(per_codigo,notaSer,nro_doc,rubrica,fecha_inc,fecha_fin)">
                                        <i class="far fa-file-alt" aria-hidden="true">  Generar Reporte</i>
                                    </button> &nbsp;
                                </div>
                                <div class="col-md-4"> 
                                    <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras(per_codigo)">
                                        <i class="fas fa-reply" aria-hidden="true">  Volver Atras</i>
                                    </button> &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
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

      <!--MODAL CAMBIAR GRADO
        id="NombreModal" -->
        <div class="modal fade" id="CambiarGrado">
        <div class="modal-dialog modal-small">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title-datos"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label" for="text-input">Grado</label>
                        <select class="form-control" v-model="grado" :class="{ 'is-invalid' : $v.grado.$error, 'is-valid':!$v.grado.$invalid }">
                            <option value="0" disabled>SELECCIONE</option>
                            <option v-for="grados in arrayGrados" :key="grados.id" :value="grados.id"  v-text="grados.abreviatura"></option>
                        </select>
                        <div class="invalid-feedback">
                            <span v-if="!$v.grado.required">Este campo es Requerido</span>
                        </div>                 
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-primary" @click="GuardarGrado(idPersonalDestino,grado)"> <i class="fas fa-plus" aria-hidden="true">  Cambiar Grado</i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      
    </section>
  </div>
</template>

<script>
//import { required, minLength, between } from 'vuelidate/lib/validators'
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.d,
            divisionper: this.$route.params.div,
            arrayPersonalDestinos : [],
            arrayPersonalDestinos2 : [],
            arrayDatosPersonal : [],
            arraySitPersonal : [],
            arrayGrados : [],
            grado : '',

            ano_actual : '',
            per_cmi : '',
            per_cmil : '',
            //VARIABLES MODAL
            rowId : 0,
            modal : 0,
            tituloModal : '',
            tipoAccion : 0,
            per_paterno : '',
            per_materno : '',
            per_nombre : '',
            per_cm : '',
            fecha_inc : '',
            fecha_fin : '',
            notaSer : '',
            nro_doc : '',
            rubrica : '',

            //VARIABLES REGISTRAR DESTINO
            perdest_nro_doc : '',
            perdest_tipo_doc : '',
            perdest_fechadestino : '',
            perdest_destn1_codigo : '',
            perdest_destn2_codigo : '',
            perdest_destn3_codigo : '',
            perdest_destn4_codigo : '',
            perdest_promo : 0,
            perdest_cargo1 : 0,
            perdest_cargo2 : 0,
            perdest_observaciones : '',
            //VARIABLES EDITAR DESTINO
            idPersonalDestino : 0,
            perdest_nro_docA : '',
            perdest_tipo_docA : '',
            perdest_fechadestinoA : '',
            perdest_destn1_codigoA : '',
            perdest_destn2_codigoA : '',
            perdest_destn3_codigoA : '',
            perdest_destn4_codigoA : '',
            promocionA : 0,
            perdest_promoA : 0,
            perdest_cargo1A : '',
            perdest_cargo2A : '',
            perdest_observacionesA : '',
            //ARRAYS
            arrayDestinos_nivel1 : [],
            arrayDestinos_nivel2 : [],
            arrayDestinos_nivel3 : [],
            arrayDestinos_nivel4 : [],
            //VARIABLES SELECT
            arrayCargos : [],
            valor : [],
            valor2 : [],
            valorA : [],
            valorA2 : [],
            //FIN VARIABLES SELCT
            //arrayCargos2 : [],
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
        }
    },

    validations:{
            grado : { required },

            fecha_inc : { required },
            fecha_fin : { required },
            nro_doc : { required },
            rubrica : { required },

            validationGroupGrado: ['grado'],
            validationGroupCert: ['fecha_inc', 'fecha_fin', 'nro_doc', 'rubrica'],
    },

    mounted() {
        //this.ver();
        this.listarPersonalDestinos(this.per_codigo);
        this.datosPersonal(this.per_codigo);
        this.selectGrado(this.divisionper);
    },

    computed:{
            isActived: function(){
                return this.pagination.current_page;
            },

            //Calcuar los elementos de la paginacion
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
            }
        },
    methods: {
        ver(){
            //console.log(this.per_codigo);
            //console.log(this.personal_destinos)
        },

        listarPersonalDestinos(per_codigo,page){
            let me = this;
            axios
          .post("/listarPersonalDestinos", {
            per_codigo : per_codigo,
            page:page
            
          })
          .then(function (response) {
            
           me.arrayPersonalDestinos = response.data.cargo1.data
           me.arrayPersonalDestinos2 = response.data.cargo2
           me.pagination = response.data.pagination
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
            division : me.arrayDatosPersonal.division

          })
          .then(function (response) {
            
            me.arrayDatosPersonal = response.data.personal_datos
            me.arraySitPersonal = response.data.personal_only_sit
            // me.arrayGrados = response.data.listar_grado
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        cambiarPagina(page){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPersonalDestinos(me.per_codigo,page);
        },

        changeItem1: function changeItem1(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarDestinos_nivel2(event.target.value);
        },
        changeItem2: function changeItem2(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarDestinos_nivel3(event.target.value);
        },
        changeItem3: function changeItem3(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectbuscarDestinos_nivel4(event.target.value);
        },

        ElegirGrado(perdestid){
            this.$v.validationGroupGrado.$reset(),
            // //PONER DE CERO EL MODAL ANTES DE REGISTRAR
            // // this.idPersonalDestino = 0,
            this.grado = '',
            this.idPersonalDestino = perdestid,
            // this.motivo = '',
            // this.rubrica = '',
            $('#CambiarGrado').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-datos").text("Cambiar Grado en el Destino");
            this.selectGrado(this.divisionper)
        },

        GuardarGrado(idPersonalDestino,grado){
            this.$v.validationGroupGrado.$reset();
            if(!this.$v.validationGroupGrado.$invalid){
                swal.fire({
                    title: 'Esta seguro de cambiar el grado', // TITULO 
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
                        //CODIGO HA SER VALIDADO
                        let me = this;
                        axios
                        .post("/cambiarGrado", {
                        //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                            perdestid : idPersonalDestino,
                            grado : grado,
                        })
                        .then(function (response) {
                            //Respuesta de la peticion
                            // console.log(response);
                            $('#CambiarGrado').modal('hide');
                            me.listarPersonalDestinos(me.per_codigo);
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                    }else{
                        console.log('no empezamos');
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

        selectGrado(division){
            let me = this;
            axios
        
          .post("/listarGrado", {
            division : division
          })
          .then(function (response) {
            console.log(response)
            me.arrayGrados = response.data.listar_grado;
            // me.pagination = response.data.pagination;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        Cerrar(){
            this.$v.validationGroupGrado.$reset(),
            this.$v.validationGroupCert.$reset()
        },

        Atras(datos){
            this.$router.push({
                name: "DestinosPersonal",
                //ENVIO DE DATOS
                params:{
                    d: datos
                }
                
            });
        },

        DesgServicio(per_codigo,notaSer,nro_doc,rubrica,fecha_inc,fecha_fin){
            this.$v.validationGroupCert.$reset();
        if(!this.$v.validationGroupCert.$invalid){
          window.open('http://sipefab.fab.bo/certificadoDesglServicio?per_codigo='+per_codigo+'&notaSer='+notaSer+'&nro_doc='+nro_doc+'&rubrica='+rubrica+'&fecha_inc='+fecha_inc+'&fecha_fin='+fecha_fin);
                    // window.open('http://127.0.0.1:8000/certificadoDesglServicio?per_codigo='+per_codigo+'&notaSer='+notaSer+'&nro_doc='+nro_doc+'&rubrica='+rubrica+'&fecha_inc='+fecha_inc+'&fecha_fin='+fecha_fin);

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
    },
}
</script>
