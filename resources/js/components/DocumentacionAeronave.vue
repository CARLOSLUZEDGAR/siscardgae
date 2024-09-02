<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">            
            <h1>
              <i class="far fa-bookmark"></i>
              DOCUMENTACIÓN DE LAS AERONAVES
              <!-- <small>Personal</small> -->
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="/">Inicio</a></li> -->
              
              <!-- <li class="breadcrumb-item active">Datos del Personal</li> -->
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
                <div class="row">
                  <div class="col-sm-8">
                    <h3 class="card-title">
                      <!-- <i class="fas fa-search"></i> -->
                      <!-- Buscar Personal -->
                    </h3>  
                  </div>                  
                  <!-- <div class="col-sm-4" v-if="$auth.can('view-insert-per')">
                    <button class="btn btn-primary btn-sm float-right" type="submit" @click="Registro()">
                      <i class="fas fa-user-plus"></i>&nbsp; REGISTRAR NUEVA AERONAVE
                    </button>
                  </div> -->
                </div>  
              </div>
              <div class="card-body">
                <div class="row d-flex justify-content-center"> 
                    <div class="col-md-4">
                        <label for="">BUSCAR AERONAVE:</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" @keyup="BuscarAeronave(1)" v-model="buscar">
                    </div>
                </div>
                <br>

                  <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 12pt;" >

                    <!-- <template v-if="datfis2==1"> -->
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">MATRICULA</th>
                                    <th class="text-center">MODELO</th>
                                    <th class="text-center">NOMBRE</th>
                                    <!-- <th class="text-center">C. IDENTIDAD</th> -->
                                    <th class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(aeronave,index) in listaAeronave"> 
                                    <!-- <td v-text="personal.grado+' '+personal.complemento"></td> -->
                                    <td style="text-align:center; font-weight:bold;">{{ index + 1 }}</td>
                                    <td v-text="aeronave.matricula"></td>
                                    <td v-text="aeronave.modelo"></td>
                                    <td v-text="aeronave.nombre"></td>
                                    <!-- <td v-text="personal.per_ci"></td> -->
                                    <td style="width:100px; text-align:center">
                                      <div v-if="$auth.can('view-renew-per')">
                                        <button type="button" @click="MostrarPDF(aeronave.id)" class="btn btn-success btn-sm">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                      </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <!-- </template> -->
                    <br>
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
                        <!-- <li class="page-item" v-if="pagination.last_page">
                            <a class="page-link" @click.prevent="cambiarPagina(pagination.last_page,buscar,criterio)">>></a>
                        </li> -->
                    </ul>
                </nav>
                  
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
import { required, between, minLength, maxLength, alpha, numeric, email} from "vuelidate/lib/validators";
export default {
  data() {
    return {
      // INICIO VARIABLES DGAE
      per_foto : '',
      per_categoria : '',
      per_entidad : '',
      per_grado : '',
      per_ci : '',
      per_cm : '',
      per_nombre : '',
      per_appaterno : '',
      per_apmaterno : '',
      per_nacionalidad : '',
      per_sexo : '',
      per_celular : '',
      per_email : '',
      per_fechnac : '',
      per_direccion : '',
      per_titlic : '',
      per_habilitacion : '',
      per_comlinguistica : '',
      per_observaciones : '',
      // fechaemision : new Date(),
      per_fechaemision : new Intl.DateTimeFormat("az", {
        year: "numeric",
        day: "2-digit",
        month: "2-digit"
      }).format(new Date()),
      per_fechaexpiracion : '',

      // per_fechaemision : new Date(),
      // per_fechaexpiracion : new Date(),
      per_id : '',
      per_fotoA : '',
      per_categoriaA : '',
      per_entidadA : '',
      per_gradoA : '',
      per_ciA : '',
      per_cmA : '',
      per_nombreA : '',
      per_appaternoA : '',
      per_apmaternoA : '',
      per_nacionalidadA : '',
      per_sexoA : '',
      per_celularA : '',
      per_emailA : '',
      per_fechnacA : '',
      per_direccionA : '',
      per_titlicA : '',
      per_habilitacionA : '',
      per_comlinguisticaA : '',
      per_observacionesA : '',
      per_fechaemisionA : new Intl.DateTimeFormat("az", {
  year: "numeric",
  day: "2-digit",
  month: "2-digit"
}).format(new Date()),
      per_fechaexpiracionA : '',
      arrayCategoria : [],
      arrayEntidad : [],
      arrayGrado : [],
      arrayNacionalidad : [],
      arrayLicencia : [],
      arrayHabilitacion : [],
      arrayCompetenciaLinguistica : [],
      arraySexo : ['MASCULINO','FEMENINO'],
      arrayDatPer : [],
      arrayNacionalidadA : [],
      v : 0,
      vA : 0,

      na_pais : '',
      na_abreviatura : '',
      na_nacionalidad : '',
      vNN : 0,
      en_pais : '',
      en_entidad : '',
      en_sigla : '',
      vNE : 0,

      // FIN VARIABLES DGAE
      arrayPersonal : [],
      arrayDatosFisicos: [],
      datos_fisicos : [],
      listaAeronave: [],
      criterio: "p.per_cm",
      buscar:"",
      setTiemoutBuscador: '',
      isHidden: true,
      datfis2 : 1,

        
      pagination: {
            'total'         :   0,
            'current_page'  :   0,
            'per_page'      :   0,
            'last_page'     :   0,
            'from'          :   0,
            'to'            :   0,
        },
    offset : 3,
    }
  },

  validations: {
          per_foto: { required },
          per_categoria: {required },
          per_nacionalidad: { required },
          per_entidad: { required },
          per_grado: { required },
          per_ci: { required },
          per_cm : { required },
          per_nombre : { required },
          // per_appaterno : { required },
          // per_apmaterno : { required },
          per_sexo : { required },
          per_celular : { required },
          per_email : { required },
          per_fechnac : { required },
          per_direccion : { required },
          per_titlic : { required },
          per_habilitacion : { required },
          per_comlinguistica : { required },
          per_fechaemision: { required },
          per_fechaexpiracion: { required },

          per_fotoA: { required },
          per_categoriaA : { required },
          per_nacionalidadA: { required },
          per_entidadA: { required },
          per_gradoA: { required },
          per_ciA: { required },
          per_cmA: { required },
          per_nombreA: { required },
          // per_appaternoA: { required },
          // per_apmaternoA: { required },
          per_sexoA: { required },
          per_celularA: { required },
          per_emailA: { required },
          per_fechnacA: { required },
          per_direccionA: { required },
          per_titlicA: { required },
          per_habilitacionA: { required },
          per_comlinguisticaA: { required },
          per_habilitacionA : { required },
          per_comlinguisticaA : { required },
          per_fechaemisionA: { required },
          per_fechaexpiracionA: { required },
          // per_observaciones : { required },
          // observacion: { required },

          // nombreA: { required },
          // observacionA: { required },

          na_pais: { required },
          na_abreviatura: { required },
          na_nacionalidad: { required },

          en_pais: { required },
          en_entidad: { required },
          en_sigla: { required },

          validationGroupReg: [
          'per_foto',
          'per_categoria',
          'per_nacionalidad',
          'per_entidad',
          'per_grado',
          'per_ci',
          'per_cm',
          'per_nombre',
          // 'per_appaterno',
          // 'per_apmaterno',
          'per_sexo',
          'per_celular',
          'per_email',
          'per_fechnac',
          'per_direccion',
          'per_titlic',
          'per_habilitacion',
          'per_comlinguistica',
          'per_fechaemision',
          'per_fechaexpiracion'],

          validationGroupRenew: [
          'per_fotoA',
          'per_categoriaA',
          'per_nacionalidadA',
          'per_entidadA',
          'per_gradoA',
          'per_ciA',
          'per_cmA',
          'per_nombreA',
          // 'per_appaternoA',
          // 'per_apmaternoA',
          'per_sexoA',
          'per_celularA',
          'per_emailA',
          'per_fechnacA',
          'per_direccionA',
          'per_titlicA',
          'per_habilitacionA',
          'per_comlinguisticaA',
          'per_fechaemisionA',
          'per_fechaexpiracionA'],

          validationGroupNewNacionalidad: [
          'na_pais',
          'na_abreviatura',
          'na_nacionalidad'],

          validationGroupNewEntidad: [
          'en_pais',
          'en_entidad',
          'en_sigla']
        },

 computed: {
        isActived   : function(){
            return this.pagination.current_page;
        },
        //creando funcion para calcular los elementos de la paginacion
        pagesNumber : function(){
            //si la pagina llega hasta la ultima pagina esta me va retornar un arrary vacio
            if(!this.pagination.to){
                return [];
            }

            var from =  this.pagination.current_page - this.offset;
            if(from < 1){
                from = 1;
            }

            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        imagen(){
            return this.per_foto;
        },
        imagenA(){
            return this.per_fotoA;
        }
    },
  mounted() {
    this.ListarAeronave(1);
  },
  methods: {

    // Registro(){
    //   this.$router.push({
    //                 name: "RegistroAeronave",  
    //             });
    // },
    
    // Renovar(aeronaveid){
    //   this.$router.push({
    //                 name: "RenovarAeronave",
    //                 //ENVIO DE DATOS
    //                 params:{
    //                     aeronaveid: aeronaveid
    //                 }
                    
    //             });
    // },

    MostrarPDF(aeronaveid){ //DGAE
    this.$router.push({
                  name: "MostrarDocumentacionAeronave",
                  //ENVIO DE DATOS
                  params:{
                      aeronaveid: aeronaveid
                  }
              });
    },

    cambiarPagina(page,buscar,criterio){
        let me = this;
        //actualizando la pagina actual
        me.pagination.current_page = page;
        me.ListarAeronave(page,buscar,criterio);
    },
    
    obtenerImagen(e){
        try {
            var fileReader = new FileReader();

            fileReader.onload = (e) => {
                this.per_foto = e.target.result;
            }
            fileReader.readAsDataURL(e.target.files[0])
            this.v = 1;
        } catch (error) {
            
        }
    },

    obtenerImagenA(e){
        try {
            var fileReader = new FileReader();

            fileReader.onload = (e) => {
                this.per_fotoA = e.target.result;
            }
            fileReader.readAsDataURL(e.target.files[0])
            this.vA = 1;
        } catch (error) {
            
        }
    },

    NuevoPersonal(){ //DGAE
      this.$v.validationGroupReg.$reset(),
      this.per_foto = '',
      this.per_categoria = '',
      this.per_nacionalidad = '',
      this.per_entidad = '',
      this.per_grado = '',
      this.per_ci = '',
      this.per_cm = '',
      this.per_nombre = '',
      this.per_appaterno = '',
      this.per_apmaterno = '',
      this.per_sexo = '',
      this.per_celular = '',
      this.per_email = '',
      this.per_fechnac = '',
      this.per_titlic = '',
      this.per_direccion = '',
      this.per_habilitacion = '',
      this.per_comlinguistica = '',
      this.per_observaciones = '',
      this.per_fechaexpiracion = '',
      this.v = 0,
      $('#ModalNewPersonal').modal('show');
      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
      $(".modal-title-registro").text("Registro Personal");
      this.listarCategoria();
      this.listarNacionalidad();
      this.listarEntidad(this.per_nacionalidad);
      this.listarGrado(this.per_entidad);
      this.listarLicencia(this.per_entidad,this.per_categoria);
      this.listarHabilitacion(this.per_titlic);
      this.listarCompetenciaLinguistica()
    },

    EditarPersonal(personal){ //DGAE
      this.$v.validationGroupRenew.$reset(),
      this.per_id = personal.id,
      this.per_fotoA = personal.per_foto,
      this.per_categoriaA = personal.id_categoria,
      this.per_nacionalidadA = personal.id_nacionalidad,
      this.per_entidadA = personal.id_entidad,
      this.per_gradoA = personal.id_grado,
      this.per_ciA = personal.per_ci,
      this.per_cmA = personal.per_cm,
      this.per_nombreA = personal.per_nombre,
      this.per_appaternoA = personal.per_paterno,
      this.per_apmaternoA = personal.per_materno,
      this.per_sexoA = personal.per_sexo,
      this.per_celularA = personal.per_celular,
      this.per_emailA = personal.per_mail,
      this.per_fechnacA = personal.per_fecha_nacimiento,
      this.per_direccionA = personal.per_direccion,
      this.per_titlicA = personal.id_licencia,
      this.per_habilitacionA = personal.id_habilitacion,
      this.per_comlinguisticaA = personal.id_complinguistica,
      this.per_observacionesA = personal.observacion,
      // this.per_fechaemisionA = '',
      this.per_fechaexpiracionA = '',
      this.vA = 0,
      $('#ModalRenewPersonal').modal('show');
      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
      $(".modal-title-registro").text("Renovación Personal");
      this.listarCategoria();
      this.listarNacionalidad();
      this.listarEntidad(this.per_nacionalidadA);
      this.listarGrado(this.per_entidadA);
      this.listarLicencia(this.per_entidadA,this.per_categoriaA);
      this.listarHabilitacion(this.per_titlicA);
      this.listarCompetenciaLinguistica()
    },

    NuevaNacionalidad(){ //DGAE
      this.$v.validationGroupNewNacionalidad.$reset(),
      this.na_pais = '',
      this.na_abreviatura = '',
      this.na_nacionalidad = '',
      this.vNN = 0,
      $('#ModalNewNacionalidad').modal('show');
      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
      $(".modal-title-aumentar").text("Nueva Nacionalidad");
      this.listarNacionalidad();
    },

    NuevaEntidad(){
      this.$v.validationGroupNewEntidad.$reset(),
      this.en_pais = this.per_nacionalidad,
      this.en_entidad = '',
      this.en_sigla = '',
      this.vNE = 0,
      $('#ModalNewEntidad').modal('show');
      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white" );
      $(".modal-title-aumentar").text("Nueva Entidad");
      this.listarNacionalidad();
      this.listarEntidad(this.per_nacionalidad);
    },

    CrearPersonal(){ //DGAE
      if(!this.$v.validationGroupReg.$invalid){
        swal.fire({
            title: '¿Desea registrar?', // TITULO 
            icon: 'question', //ICONO (success, warnning, error, info, question)
            showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
            confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
            cancelButtonColor: '#868077', // COLOR DEL BOTON CANCELAR
            confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
            cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
            buttonsStyling: true,
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                let me = this;
                axios
                .post("/crearPersonal", {
                  foto : me.per_foto,
                  categoria : me.per_categoria,
                  nacionalidad: me.per_nacionalidad,
                  entidad : me.per_entidad,
                  grado : me.per_grado,
                  ci : me.per_ci,
                  cm : me. per_cm,
                  nombre : me.per_nombre,
                  ap_paterno : me.per_appaterno,
                  ap_materno : me.per_apmaterno,
                  sexo : me.per_sexo,
                  celular : me.per_celular,
                  email : me.per_email,
                  fech_nac : me.per_fechnac,
                  direccion : me.per_direccion,
                  tit_licencia : me.per_titlic,
                  habilitacion : me.per_habilitacion,
                  linguistica : me.per_comlinguistica,
                  observacion : me.per_observaciones,
                  fech_emision : me.per_fechaemision,
                  fech_expiracion : me.per_fechaexpiracion
                })
                .then(function (response) {
                    
                    console.log(response);
                    swal.fire({
                        title: 'Se realizo el registro correctamente', //TITULO
                        // response.data.mensaje, //TEXTO DE MENSAJE
                        // response.data.tipo, // TIPO DE MODAL (success, warnning, error, info)
                        // response.personal
                    });
                    if (!response.data.code) {
                        // $('#NuevoUsuario').modal('hide');
                        $('#ModalNewPersonal').modal('hide');
                        // me.nick = '';
                        // me.password = '';
                        me.arrayDatPer = response.data.personal;
                        me.GenerarCarnet(me.arrayDatPer.id_personal);
                        me.ListarAeronave(1);
                        this.$v.$reset();
                    } 
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            }else{
                  swal.fire(
                    "Informacion", //TITULO
                    "Solicitud cancelada.", //TEXTO DE MENSAJE
                    "info" // TIPO DE MODAL (success, warnning, error, info)
                );
            }
        })
      }else{
          this.$v.validationGroupReg.$touch();
          Swal.fire({
              icon: 'warning',
              title: 'Ingrese todos los datos requeridos',
              showConfirmButton: false,
              timer: 2000
          })
          
      }
    },

    RenovarPersonal(){ //DGAE
      if(!this.$v.validationGroupRenew.$invalid){
        swal.fire({
            title: '¿Desea Renovar?', // TITULO 
            icon: 'question', //ICONO (success, warnning, error, info, question)
            showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
            confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
            cancelButtonColor: '#868077', // COLOR DEL BOTON CANCELAR
            confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
            cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
            buttonsStyling: true,
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                let me = this;
                axios
                .post("/renovarPersonal", {
                  id_personal : me.per_id,
                  foto : me.per_fotoA,
                  categoria : me.per_categoriaA,
                  nacionalidad: me.per_nacionalidadA,
                  entidad : me.per_entidadA,
                  grado : me.per_gradoA,
                  ci : me.per_ciA,
                  cm : me.per_cmA,
                  nombre : me.per_nombreA,
                  ap_paterno : me.per_appaternoA,
                  ap_materno : me.per_apmaternoA,
                  sexo : me.per_sexoA,
                  celular : me.per_celularA,
                  email : me.per_emailA,
                  fech_nac : me.per_fechnacA,
                  direccion : me.per_direccionA,
                  tit_licencia : me.per_titlicA,
                  habilitacion : me.per_habilitacionA,
                  linguistica : me.per_comlinguisticaA,
                  observacion : me.per_observacionesA,
                  fech_emision : me.per_fechaemisionA,
                  fech_expiracion : me.per_fechaexpiracionA
                })
                .then(function (response) {
                    
                    console.log(response);
                    swal.fire({
                        title: 'Se realizo el renovación correctamente', //TITULO
                        // response.data.mensaje, //TEXTO DE MENSAJE
                        // response.data.tipo, // TIPO DE MODAL (success, warnning, error, info)
                        // response.personal_foto
                    });
                    if (!response.data.code) {
                        // $('#NuevoUsuario').modal('hide');
                        $('#ModalRenewPersonal').modal('hide');
                        // me.nick = '';
                        // me.password = '';
                        me.arrayDatPer = response.data.personal;
                        me.GenerarCarnet(me.arrayDatPer.id_personal);
                        me.ListarAeronave(1);
                        this.$v.$reset();
                    } 
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            }else{
                  swal.fire(
                    "Informacion", //TITULO
                    "Solicitud cancelada.", //TEXTO DE MENSAJE
                    "info" // TIPO DE MODAL (success, warnning, error, info)
                );
            }
        })
      }else{
          this.$v.validationGroupRenew.$touch();
          Swal.fire({
              icon: 'warning',
              title: 'Ingrese todos los datos requeridos',
              showConfirmButton: false,
              timer: 2000
          })
          
      }
    },

    CrearNacionalidad(){ //DGAE
      if(!this.$v.validationGroupNewNacionalidad.$invalid){
        swal.fire({
            title: '¿Desea registrar?', // TITULO 
            icon: 'question', //ICONO (success, warnning, error, info, question)
            showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
            confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
            cancelButtonColor: '#868077', // COLOR DEL BOTON CANCELAR
            confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
            cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
            buttonsStyling: true,
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                let me = this;
                axios
                .post("/crearNacionalidad", {
                  pais : me.na_pais,
                  nacionalidad: me.na_nacionalidad,
                  abreviatura : me.na_abreviatura,
                })
                .then(function (response) {
                    
                    console.log(response);
                    swal.fire({
                        title: 'Se realizo el registro correctamente', //TITULO
                        // response.data.mensaje, //TEXTO DE MENSAJE
                        // response.data.tipo, // TIPO DE MODAL (success, warnning, error, info)
                        // response.personal
                    });
                    // this.listarNacionalidad();
                    if (!response.data.code) {
                        // $('#NuevoUsuario').modal('hide');
                        $('#ModalNewNacionalidad').modal('hide');
                        me.listarNacionalidad();
                        // me.nick = '';
                        // me.password = '';
                        this.$v.$reset();
                    } 
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            }else{
                  swal.fire(
                    "Informacion", //TITULO
                    "Solicitud cancelada.", //TEXTO DE MENSAJE
                    "info" // TIPO DE MODAL (success, warnning, error, info)
                );
            }
        })
      }else{
          this.$v.validationGroupNewNacionalidad.$touch();
          Swal.fire({
              icon: 'warning',
              title: 'Ingrese todos los datos requeridos',
              showConfirmButton: false,
              timer: 2000
          })
          
      }
    },

    CrearEntidad(){ //DGAE
      if(!this.$v.validationGroupNewEntidad.$invalid){
        swal.fire({
            title: '¿Desea registrar?', // TITULO 
            icon: 'question', //ICONO (success, warnning, error, info, question)
            showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
            confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
            cancelButtonColor: '#868077', // COLOR DEL BOTON CANCELAR
            confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
            cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
            buttonsStyling: true,
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                let me = this;
                axios
                .post("/crearEntidad", {
                  pais : me.en_pais,
                  entidad: me.en_entidad,
                  sigla : me.en_sigla,
                })
                .then(function (response) {
                    
                    console.log(response);
                    swal.fire({
                        title: 'Se realizo el registro correctamente', //TITULO
                        // response.data.mensaje, //TEXTO DE MENSAJE
                        // response.data.tipo, // TIPO DE MODAL (success, warnning, error, info)
                        // response.personal
                    });
                    // this.listarNacionalidad();
                    if (!response.data.code) {
                        // $('#NuevoUsuario').modal('hide');
                        $('#ModalNewEntidad').modal('hide');
                        me.listarEntidad(me.per_nacionalidad);
                        // me.nick = '';
                        // me.password = '';
                        this.$v.$reset();
                    } 
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            }else{
                  swal.fire(
                    "Informacion", //TITULO
                    "Solicitud cancelada.", //TEXTO DE MENSAJE
                    "info" // TIPO DE MODAL (success, warnning, error, info)
                );
            }
        })
      }else{
          this.$v.validationGroupNewEntidad.$touch();
          Swal.fire({
              icon: 'warning',
              title: 'Ingrese todos los datos requeridos',
              showConfirmButton: false,
              timer: 2000
          })
          
      }
    },

    ListarAeronave(page){
            let me = this;
            axios
            .post("/listarAeronave", {
                page: page,
                buscar: me.buscar.toUpperCase(),
            })
            .then(function (response) {
                me.listaAeronave = response.data.aeronave.data;
                me.pagination =response.data.pagination
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        listarCategoria(){ //DGAE
            let me = this;
            axios
          .post("/listarCategoria", {
          })
          .then(function (response) {
           me.arrayCategoria = response.data.categorias
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        listarNacionalidad(){ //DGAE
            let me = this;
            axios
          .post("/listarNacionalidad", {
          })
          .then(function (response) {
           me.arrayNacionalidad = response.data.nacionalidades
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        // selectNacionalidad(nacionalidad){ //DGAE
        //     let me = this;
        //     axios
        //   .post("/selectNacionalidad", {
        //     id_nacionalidadA : nacionalidad,
        //   })
        //   .then(function (response) {
        //    me.arrayNacionalidadA = response.data.nacionalidades
        //   })
        //   .catch(function (error) {
        //     // handle error
        //     console.log(error);
        //   })
        // },

        listarEntidad(nacionalidad){ //DGAE
            let me = this;
            axios
          .post("/listarEntidad", {
            id_nacionalidad : nacionalidad,
          })
          .then(function (response) {
           me.arrayEntidad = response.data.entidades
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        listarGrado(entidad){ //DGAE
            let me = this;
            axios
          .post("/listarGrado", {
            id_entidad : entidad,
          })
          .then(function (response) {
           me.arrayGrado = response.data.grados
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        listarLicencia(entidad,categoria){ //DGAE
            let me = this;
            axios
          .post("/listarLicencia", {
            id_entidad : entidad,
            id_categoria : categoria
          })
          .then(function (response) {
           me.arrayLicencia = response.data.licencias
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        listarHabilitacion(licencia){ //DGAE
            let me = this;
            axios
          .post("/listarHabilitacion", {
            id_titlicencia : licencia,
          })
          .then(function (response) {
           me.arrayHabilitacion = response.data.habilitaciones
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        listarCompetenciaLinguistica(){ //DGAE
            let me = this;
            axios
          .post("/listarCompetenciaLinguistica", {
          })
          .then(function (response) {
           me.arrayCompetenciaLinguistica = response.data.comp_linguisticas
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        BuscarAeronave(){ //DGAE
            clearTimeout(this.setTiemoutBuscador);
            this.setTiemoutBuscador = setTimeout(() => {
                this.ListarAeronave(1)
            }, 360)
        },


        GenerarCarnet(id_personal){ //DGAE
            // this.$v.$reset();
            // if(!this.$v.$invalid){
            // window.open('http://sipefab.fab.bo/certificadoDestAscenso?id_p='+id_personal);
            window.open('http://127.0.0.1:8000/carnet?id_p='+id_personal);
            // }else{
            //     this.$v.$touch();
            //     Swal.fire({
            //         icon: 'warning',
            //         title: 'Ingrese todos los datos requeridos',
            //         showConfirmButton: false,
            //         timer: 2000
            //     })
                
            // }
        },

    EnvioDatos(datos){
      this.$router.push({
          name: "Personal_datos",
          //ENVIO DE DATOS
          params:{
              e: datos
          }
          
      });
    } 
  },
};

</script>

<style>
</style>