<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <i class="nav-icon fas fa-angle-double-up"></i>
              Ascenso Masivo
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ascenso Masivo</li>
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
                  Buscar Promoción
                </h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <select class="form-control col-md-6" v-model="criterio">
                        <option value="per_promo">Código de Promoción</option>&nbsp;
                      </select>
                      <input type="number" v-model="buscar" @keyup.enter="listarPersonal(1,buscar,criterio)" :class="{ 'is-invalid' : $v.buscar.$error, 'is-valid':!$v.buscar.$invalid }" class="form-control col-md-4" placeholder="31208">&nbsp;
                      <button type="submit" @click="listarPersonal(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                      <div class="invalid-feedback">
                          <span v-if="!$v.buscar.required">Este campo es obligatorio</span>
                          <span v-if="!$v.buscar.minLength">El Campo debe tener al menos {{
                              $v.buscar.$params.minLength.min}} Digitos. </span>
                          <span v-if="!$v.buscar.maxLength">El Campo no debe tener mas de {{
                              $v.buscar.$params.maxLength.max}} Digitos. </span>
                      </div>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <button type="button" class="btn btn-success" @click="abrirModalAgregar()">
                      <i class="fas fa-plus">Agregar</i>
                    </button>&nbsp;

                    <button type="button" class="btn btn-danger" @click="abrirModalRegistro()">
                      <i class="nav-icon fas fa-angle-double-up"> Ascender</i>
                    </button>&nbsp;

                    <button type="button" class="btn btn-secondary" @click="generarReportePromocion(buscar)">
                      <i class="nav-icon fas fa-file-pdf"> Asc. Promoción</i>
                    </button>&nbsp;
                  </div>
                </div>
                <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                  <template v-if="arrayPersonal.length">
                    <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th style="width:10px; text-align:center">Cod. Prom</th>
                          <th style="width:10px; text-align:center">Grado</th>
                          <th style="width:130px; text-align:center">Apellidos y Nombres</th>
                          <th style="width:15%; text-align:center">C. Militar</th>
                          <th style="width:9px; text-align:center">Ultimo Asc.</th>
                          <th style="width:13%; text-align:center">Antiguedad</th>
                          <th style="width:5%; text-align:center">Quitar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(personal,index) in arrayPersonal" :key="personal.per_codigo">

                          <td style="width:10px; text-align:center" v-text="personal.per_promo"></td>
                          <td style="width:10px; text-align:center" v-text="personal.gra_abreviatura+' '+personal.estu_abreviatura"></td>
                          <td v-text="personal.per_paterno+' '+personal.per_materno+' '+personal.per_nombre"></td>
                          <td style="width:15%; text-align:center" v-text="personal.per_cm"></td>
                          <td style="width:9px; text-align:center" v-text="personal.antigfin"></td>
                          <td style="width:13%; text-align:center">
                            <input type="number" v-model="personal.antiguedad" @change="ValidarAntiguedad(personal)" class="form-control" placeholder="Antiguedad" required>
                          </td>
                          <td style="width:5%; text-align:center">
                            <button type="button"  @click="eliminarAsc(index)" class="btn btn-danger btn-sm">
                              <i class="fas fa-window-close"></i>
                            </button> &nbsp;
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
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->
      <div class="modal fade" id="ModalRegistro" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registro Masivo de Ascensos</h4>
                <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
              <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group row">
                  <label class="col-md-4 form-control-label" for="text-input">Num. de Ascenso</label>
                  <div class="col-md-8">
                   <!--- <select class="form-control" v-model="codasc" v-on:change="datosDocumento()">
                      <option value="0" disabled>Seleccione</option>
                      <option v-for="ascenso in arrayAscenso" :key="ascenso.id" :value="ascenso.id" v-text="ascenso.nrodocumento"></option>
                    </select> -->
                    <v-select
                        label="descripcion"
                        :options="arrayAscenso"
                        v-model="codasc"
                        @input="datosDocumento"
                    >
                        <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                Lo sentimos, no hay opciones de coincidencia.<em>{{
                                search
                                }}</em
                                >.
                            </template>
                            <em v-else
                                >Lo sentimos, no hay opciones de coincidencia.</em
                            >
                        </template>
                    </v-select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-4 form-control-label" for="">Fecha de Ascenso</label>
                  <div class="col-md-8">
                      <input type="date" v-model="fechasc" disabled class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 form-control-label" for="text-input">Tipo de Documento</label>
                  <div class="col-md-8">
                      <input type="text" class="form-control" disabled v-model="documento">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-4 form-control-label" for="text-input">Total Ascendido</label>
                  <div class="col-md-8">
                      <input type="number" class="form-control" v-model="total">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-4 form-control-label" for="">Observacion</label>
                  <div class="col-md-8">
                    <input type="text" v-model="observacion" class="form-control" placeholder="Observacion" style="text-transform:uppercase">
                  </div>
                </div>

              </form>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="registrarAscensoPersonal()">Registrar</button>
              <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
      <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="ModalAgregarPersona" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Personas a Lista</h4>
              <button type="button" class="close" @click="cerrarModalDetalle()" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <div class="col-md-10">
                  <div class="input-group">
                    <select class="form-control col-md-5" v-model="criterioA">
                      <option value="per_cm">Carnet Militar</option>
                    </select>
                    <input type="number" v-model="buscarA" @keyup.enter="listarAgregar(buscarA,criterioA)" class="form-control" placeholder="31208065" style="text-transform:uppercase">
                    <button type="submit" @click="listarAgregar(buscarA,criterioA)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <template v-if="arrayAgregar.length">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>

                        <th style="width:15%; text-align:center">Grado</th>
                        <th>Ap. Paterno</th>
                        <th>Ap. Materno</th>
                        <th>Nombres</th>
                        <th style="width:5%; text-align:center">C. Militar</th>
                        <th style="width:2%; text-align:center">Opción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="PersonaAgre in arrayAgregar" :key="PersonaAgre.id">
                        <td style="width:15%; text-align:center" v-text="PersonaAgre.gra_abreviatura+' '+PersonaAgre.estu_abreviatura"></td>
                        <td v-text="PersonaAgre.per_paterno"></td>
                        <td v-text="PersonaAgre.per_materno"></td>
                        <td v-text="PersonaAgre.per_nombre"></td>
                        <td style="width:5%; text-align:center" v-text="PersonaAgre.per_cm"></td>
                        <td style="width:2%; text-align:center">
                          <button type="button" @click="agregarDetalleModal(PersonaAgre)" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i>
                          </button>
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
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" @click="cerrarModalDetalle()">Cerrar</button>
            </div>
          </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    </section>
    <!-- /.content -->
  </div>
</template>

<script>
import { required, minLength, maxLength } from "vuelidate/lib/validators";
export default {
  data() {
      return {
      arrayPersonal : [],
      arrayAgregar : [],
      criterio : 'per_promo',
      buscar : '',
      modal :'',
      //desde aca
      codasc : '',
      fechasc : '',
      documento : '',
      total : '',
      observacion :'',
      //hasta aca
      arrayAscenso:[],
      arrayTotalPromo : [],
      pagination : {
          'total' : 0,
          'current_page' : 0,
          'per_page' : 0,
          'last_page' : 0,
          'from' : 0,
          'to' : 0,
      },
      offset : 3,
      criterio: 'per_promo',
      criterioA : 'per_cm',
      buscarA: '',
      per_codigo : 0,
      }
  },
  mounted() {
     // this.listarPersonal(this.page,this.buscar,this.criterio);
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
    }
  },
  validations:{
			buscar :{ required,minLength: minLength(5), maxLength: maxLength(5), },
        },
  methods: {
    listarPersonal(page,buscar,criterio){
      if(!this.$v.$invalid){
          Swal.fire({
          title: 'Seguro de Listar?',
          text: 'Se listará el Ascenso masivo',
          icon: 'question',
          showCancelButton: true,
					confirmButtonColor: '#38BE5D',
					cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          reverseButtons: true
          }).then((result) => {
          if (result.value) {
              if(buscar.length == ''){
              //  return  Swal.fire("Mensaje de Advertencia","Ingrese los 5 primeros digitos de Carnet Militar para la busqueda!!!","warning");
              } else {
                let me = this;
                axios
                .post("/listarAscensoMasivo", {
                page : page,
                buscar : buscar.toUpperCase(),
                criterio : criterio,
              })
              .then(function (response) {
                console.log(response);
                me.arrayPersonal = response.data.personals.data;
                me.arrayTotalPromo = response.data.totalPromo.data;
                me.pagination = response.data.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                })
              }
            }
            else {
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            }
            })
      }else{
          this.$v.$touch();
          Swal.fire({
              icon: 'error',
              title: 'LLene el campo requerido .....',
              timer: 2500
          });
      }
    },
    listarAgregar(buscar,criterio){
      let me=this;
      var url= '/listarDetalle?buscar='+ buscar + '&criterio='+ criterio;
      axios.get(url).then(function (response) {
          var respuesta= response.data;
          me.arrayAgregar = respuesta.detalles.data;
      })
      .catch(function (error) {
          console.log(error);
      });
    },
    agregarDetalleModal(data =[]){
      let me=this;
      if(me.encuentra(data['per_codigo'])){
         Swal.fire("Mensaje de Advertencia","La persona ya se encuentra en la lista!!!!!!","error");
        }
      else{
        me.arrayPersonal.push({
        per_codigo: data['per_codigo'],
        per_promo: data['per_promo'],
        gra_abreviatura: data['gra_abreviatura'],
        estu_abreviatura: data['estu_abreviatura'],
        per_paterno: data['per_paterno'],
        per_materno: data['per_materno'],
        per_nombre: data['per_nombre'],
        per_cm: data['per_cm'],
        antigfin: data['antigfin'],
        esca_cod: data['esca_cod'],
        anti: data['anti'],
        gra_cod: data['gra_cod'],
        per_ci: data['per_ci'],
        promoact: data['promoact'],
        subesc_cod: data['subesc_cod'],

        });
      }
    },
    cambiarPagina(page, buscar, criterio){
      let me = this;
      //Actualiza la pagina actual
      me.pagination.current_page= page;
      //Envia la peticion para visualizar la data de esa pagina
      me.listarPersonal(page, buscar, criterio);
    },
    datosDocumento(){
      let me = this;
        axios.post("/personaldocumento/dato", {
        id : me.codasc,
      }).then(function (response) {
      //  console.log(response);
        me.documento = response.data.documento;
        me.nro_doc= response.data.nrodocumento;
        me.fechasc= response.data.fechadocumento;

      })
      .catch(function (error) {
        // handle error
        console.log(error);
      })
    },
    selectAscenso(){
      let me=this;
      var url= '/escalafon/selecAscenso';
      axios.get(url).then(function (response) {
          //console.log(response);
          var respuesta= response.data;
          me.arrayAscenso = respuesta.ascensos;
      })
      .catch(function (error) {
          console.log(error);
      });
    },
    abrirModalRegistro(){
      const antiguedades = this.arrayPersonal.filter(personal => personal.antiguedad != undefined).map(personal => personal.antiguedad);
      if(this.arrayPersonal.length==0){
        Swal.fire("Mensaje de Advertencia","Debe selecciona una promocion digitando 5 primeros numeros de Carnet Militar en el buscador!!!!!","error");
      } else  {
          if(antiguedades.length==this.arrayPersonal.length){
            this.selectAscenso();
            $('#ModalRegistro').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
          }
          else {
            Swal.fire("Mensaje de Advertencia","Debe Asignar una Antiguedad a cada Persona de la Lista!!!!!!","error");

          }
      }

    },
    abrirModalAgregar(){
      $('#ModalAgregarPersona').modal('show');
      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
    },
    cerrarModal(){
      this.codasc = "";
      this.fechasc = "";
      this.documento = "";
      this.total = "";
      this.observacion = "";
      $('#ModalRegistro').modal('hide');
      $('#ModalRegistroGeneral').modal('hide');
      $('#ModalEditar').modal('hide');

    },
    cerrarModalDetalle(){
        $('#ModalAgregarPersona').modal('hide');
        $('#ModalRegistroGeneral').modal('hide');
        $('#ModalEditar').modal('hide');
        this.arrayAgregar = "";
        this.buscarA = "";
    },
    ValidarAntiguedad(personal){
      const antiguedades = this.arrayPersonal.filter(personal => personal.antiguedad != undefined).map(personal => personal.antiguedad);
      const duplicado = this.duplicate(antiguedades);
      if(duplicado){
        Swal.fire("Mensaje de Advertencia","La Antiguedad insertada ya fue asignada anteriormente!!!!!!","error");
        personal.antiguedad = "";
      }
    },
    duplicate(array){
      const unique = Array.from(new Set(array));
      if(array.length === unique.length) {
        return false
      } else {
        return true
      }
    },
    registrarAscensoPersonal() {
      let me = this;
      axios
      .post("/ascensoPersonal/registrarMasivo", {
        // 1ra tabla
        personal: me.arrayPersonal,
        //totalPromo: me.arrayTotalPromo,
        'asc_cod': me.codasc,
        'fechasc': me.fechasc,
        'total' :  me.total,
        'observacion': me.observacion.toUpperCase(),
        // 2da tabla
        'documento': me.documento,
        'nro_doc': me.nro_doc,
        //subesc: me.arrayGradoActual.sc
      })
      .then(function(response) {
        if(response.data==400){
           return  Swal.fire("Mensaje de Advertencia","No se pudo completar la transaccion....!!!!!","error");
        }
        if(response.data==200){
            Swal.fire("Mensaje de Confirmación","Ascenso Masivo Registrado Correctamente","success");
            me.cerrarModal();
            location.reload();
        }
      })
      .catch(function(error) {
        console.log(error);
      });
    },
    eliminarAsc(index){
      let me = this;
      me.arrayPersonal.splice(index, 1);
    },
    encuentra(per_codigo){
      var sw=0;
      for(var i=0;i<this.arrayPersonal.length;i++){
        if(this.arrayPersonal[i].per_codigo==per_codigo){
          sw=true;
        }
      }
      return sw;
    },
    generarReportePromocion(buscar){

      if(buscar.length == ''){
        return  Swal.fire("Mensaje de Advertencia","Ingrese los 5 primeros digitos de Carnet Militar para generar el reporte!!!","warning");
      } else {
        window.open('http://sipefab.fab.bo/AscensoReportePromocion?codpromo='+buscar);
        //  para servidor o produccion window.open('http://192.168.3.77//AscensoReportePromocion?codpromo='+buscar);
      }
    },
  },
};

</script>

<style>
  @media (min-width: 600px) {
    .btnagregar {
        margin-top: 2rem;
    }
  }
</style>
