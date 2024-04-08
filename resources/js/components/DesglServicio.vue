<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              SIPEFAB
              <small>2.0.0</small>

            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Modals & Alerts</li>
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
                  <i class="fas fa-globe-americas"></i>
                  <strong>DESGLOSE AÑOS DE SERVICIO</strong>
                </h3>
              </div>
              <div class="card-body">
                  <div class="form-group row">
                        <img v-bind:src="'/destinosPersonal/../img/personal/'+arrayDatosPersonal.per_foto" class="img-responsive" height="100" width="90">
                    </div>
                    <div class="form-group row">
                        <div>
                            <label class="col-md-12 form-control-label">
                                <template v-if="arrayDatosPersonal.per_sexo=='MASCULINO'">
                                        DEL SEÑOR: {{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}
                                </template>
                                <template v-else>
                                        DE LA SEÑORA: {{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}
                                </template>
                            </label>
                        </div>
                       
                        
                    </div>


                    <div class="form-group row">
                        <button type="button" class="btn btn-info btn-sm" @click="DesgServicio(per_codigo,notaSer)">
                            <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                        </button> &nbsp;
                        <button type="button" class="btn btn-danger btn-sm" @click="Atras(per_codigo)">
                            <i class="fas fa-arrow-left" aria-hidden="true">  ATRAS</i>
                        </button> &nbsp;
                    </div>
                    
                    <div class="form-group row">
                        <label for="">DESTINOS</label>
                    </div>
                    <table class="table table-bordered table-striped table-sm table-responsive">
                        <thead>
                            <tr>
                                <th><center>FECHA DESTINO</center></th>
                                <th><center>DESTINO</center></th> 
                                <th><center>GRADO</center></th>  
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="personalDestinos in arrayPersonalDestinos">
                                <!-- moment("D/MM/YYYY") cambiar formato de fecha -->
                                <!-- <td ><center>{{personalDestinos.fechadestino | moment("D/MM/YYYY")}}</center></td> -->
                                <td ><center>{{personalDestinos.fecha_final}}</center></td>
                                <td>{{personalDestinos.desc_dn2}} - {{personalDestinos.desc_dn3}}</td>
                                <td>{{personalDestinos.gra_abreviatura}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label" for="text-input">NOTA:</label>
                        <textarea name="textarea" class="form-control" rows="3" v-model="notaSer" placeholder="SIN OBSERVACIONES"></textarea>
                        <!--<input type="text" v-model="perdest_observacionesA" class="form-control">-->
                    </div>
                </div>
                    <div class="form-group row">
                        <button type="button" class="btn btn-info btn-sm" @click="DesgServicio(per_codigo,notaSer)">
                            <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                        </button> &nbsp;
                        <button type="button" class="btn btn-danger btn-sm" @click="Atras(per_codigo)">
                            <i class="fas fa-arrow-left" aria-hidden="true">  ATRAS</i>
                        </button> &nbsp;
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
      
    </section>
    <!-- /.content -->
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
            arrayPersonalDestinos : [],
            arrayPersonalDestinos2 : [],
            arrayDatosPersonal : [],
            arraySitPersonal : [],

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
            notaSer : '',
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
        }
    },

    validations:{
        
            perdest_nro_doc : { required },
            perdest_tipo_doc : { required },
            perdest_fechadestino : { required },
            perdest_destn1_codigo : { required },
            perdest_destn2_codigo : { required },
            perdest_destn3_codigo : { required },
            perdest_destn4_codigo : { required },
            valor : { required },
    //},
        
       // actualizar: {
            perdest_nro_docA : { required },
            perdest_tipo_docA : { required },
            perdest_fechadestinoA : { required },
            perdest_destn1_codigoA : { required },
            perdest_destn2_codigoA : { required },
            perdest_destn3_codigoA : { required },
            perdest_destn4_codigoA : { required },
            perdest_cargo1A : { required },
        //}
        
    },

    mounted() {
        //this.ver();
        this.listarPersonalDestinos(this.per_codigo);
        this.datosPersonal(this.per_codigo);
    },
    methods: {
        ver(){
        },

        listarPersonalDestinos(per_codigo){
            let me = this;
            axios
          .post("/listarPersonalDestinos", {
            per_codigo : per_codigo,
          })
          .then(function (response) {
            
           me.arrayPersonalDestinos = response.data.cargo1.data
           me.arrayPersonalDestinos2 = response.data.cargo2.data
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
            
            me.arrayDatosPersonal = response.data.personal_datos
            me.arraySitPersonal = response.data.personal_only_sit
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
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
        selectDestinos_nivel1(){
            let me =this;
            var url='/destinos_nivel1/selectDestinos_nivel1';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel1 = respuesta.destinos_nivel1; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectDestinos_nivel2(){
            let me =this;
            var url='/destinos_nivel2/selectDestinos_nivel2';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel2 = respuesta.destinos_nivel2; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectDestinos_nivel3(){
            let me =this;
            var url='/destinos_nivel3/selectDestinos_nivel3';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel3 = respuesta.destinos_nivel3; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectDestinos_nivel4(){
            let me =this;
            var url='/destinos_nivel4/selectDestinos_nivel4';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel4 = respuesta.destinos_nivel1; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },
            
        selectbuscarDestinos_nivel2(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arrayDestinos_nivel2=[];
          //  me.prov_codigo=0;
            var url='/destinos_nivel2/selectbuscarDestinos_nivel2?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel2 = respuesta.destinos_nivel2; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
            // always executed
            }); 
        },

        selectbuscarDestinos_nivel3(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arrayDestinos_nivel3=[];
          //  me.prov_codigo=0;
            var url='/destinos_nivel3/selectbuscarDestinos_nivel3?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel3 = respuesta.destinos_nivel3; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
            // always executed
            }); 
        },

        selectbuscarDestinos_nivel4(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arrayDestinos_nivel4=[];
          //  me.prov_codigo=0;
            var url='/destinos_nivel4/selectbuscarDestinos_nivel4?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDestinos_nivel4 = respuesta.destinos_nivel4; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
            // always executed
            }); 
        },

        listarCargos(){
            let me = this;
            axios
            .post("/listarCargos", {
                filtro : me.arrayDatosPersonal.subescid,
            })
            .then(function (response) {
        //Respuesta de la peticion
            ;
            
            me.arrayCargos = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            });
        },

        RegistrarDestino(){
            this.$v.$reset();
            if(!this.$v.$invalid){
                swal.fire({
                    title: 'Esta seguro de registrar este destino', // TITULO 
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
                        .post("/registrarDestino", {
                        //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                            perdest_codigocambio : me.per_codigo,
                            perdest_nro_doc : me.perdest_nro_doc,
                            perdest_tipo_doc : me.perdest_tipo_doc,
                            perdest_fechadestino : me.perdest_fechadestino,
                            perdest_destn1_codigo : me.perdest_destn1_codigo,
                            perdest_destn2_codigo : me.perdest_destn2_codigo,
                            perdest_destn3_codigo : me.perdest_destn3_codigo,
                            perdest_destn4_codigo : me.perdest_destn4_codigo,
                            perdest_cargo1 : me.valor.id,
                            perdest_cargo2 : me.valor2.id,
                            promocion : me.perdest_promo,
                            perdest_observaciones : me.perdest_observaciones,
                        })
                        .then(function (response) {
                            //Respuesta de la peticion
                            ;
                            $('#NuevoDestino').modal('hide');
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


        EditarDestino(){
            this.$v.$reset();
            if(!this.$v.$invalid){
                swal.fire({
                    title: 'Esta seguro de modificar este destino', // TITULO 
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
                        .put("/editarDestino", {
                    //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                        idPersonalDestino : me.idPersonalDestino,
                        perdest_codigocambio : me.per_codigo,
                        perdest_nro_doc : me.perdest_nro_docA,
                        perdest_tipo_doc : me.perdest_tipo_docA,
                        perdest_fechadestino : me.perdest_fechadestinoA,
                        perdest_destn1_codigo : me.perdest_destn1_codigoA,
                        perdest_destn2_codigo : me.perdest_destn2_codigoA,
                        perdest_destn3_codigo : me.perdest_destn3_codigoA,
                        perdest_destn4_codigo : me.perdest_destn4_codigoA,
                        perdest_cargo1 : me.perdest_cargo1A,
                        perdest_cargo2 : me.perdest_cargo2A,
                        promocion : me.perdest_promo,
                        perdest_observaciones : me.perdest_observacionesA,
                    })
                    .then(function (response) {
                        //Respuesta de la peticion
                        ;
                        $('#EditarDestino').modal('hide');
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

        Atras(datos){
            this.$router.push({
                name: "DestinosPersonal",
                //ENVIO DE DATOS
                params:{
                    d: datos
                }
                
            });
        },

        DesgServicio(per_codigo,notaSer){
          //window.open('http://sipefab.fab.bo/reporteIndividual?per_codigo='+per_codigo);
          window.open('http://sipefab.fab.bo/desgServicio?per_codigo='+per_codigo+'&notaSer='+notaSer);
        },
    },
}
</script>
