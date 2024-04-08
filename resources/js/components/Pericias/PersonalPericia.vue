<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">    
              <div class="row">
                  <h1>
                    <i class="far fa-bookmark"></i>
                    PERICIAS
                </h1>&nbsp;
                  
             </div>        
            
            
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Modals & Alerts</li>
            </ol>
          </div> -->
        </div>
        
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                    <!-- card 2 Muestra Datos Personales -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                    <div class="col-2">
                        
                        <img :src="'/img/personal/'+datos.foto" width="100%" height="100%" class="rounded float-left img-fluid">
                    </div>
                     
                     <div class="col-md-10 d-flex align-items-center">
                        <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                            <!-- FILA 1 -->
                            <div class="row p-2 bd-highlight">
                                <div class="col-md-6">
                                    <dl>
                                        <dt class="st">NOMBRE</dt>
                                        <dd class="st">{{ datos.grado }} {{ datos.complemento }} {{ datos.nombre }} {{ datos.paterno }} {{ datos.materno }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">CARNET MILITAR</dt>
                                        <dd class="st">{{ datos.cm }}</dd>
                                    </dl>
                                </div>
                            </div>
                            <!-- FILA 2 -->
                            <div class="row p-2 bd-highlight">
                                <div class="col-md-6">
                                    <dl>
                                        <dt class="st">CARNET DE IDENTIDAD</dt>
                                        <dd class="st">{{ datos.ci }} {{ datos.expedido }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">SITUACION MILITAR ACTUAL</dt>
                                        <dd class="st">{{ datos.nombsit }} - {{datos.nombsub}} - {{datos.nombdet}}</dd>
                                    </dl>
                                </div>

                            </div>
                            <!-- FILA 3 -->
                            <div class="row p-2 bd-highlight justify-content-center">
                                    <div class="col-md-4">                                            
                                        <button class="btn btn-sm btn-success btn-block" @click="NuevaPericia()">
                                            <i class="fa fa-plus-circle"></i> &nbsp;
                                            Nueva Pericia
                                        </button>
                                        
                                    </div>
                                    <!-- <div v-if="$auth.can('report-pub')" class="col-md-4">  
                                        <button type="button" @click="ReportePublicacion(datos.codigo)" class="btn btn-sm btn-secondary btn-block">
                                         <i class="far fa-file-pdf"></i>&nbsp;Reporte Personal
                                        </button>
                                    </div> -->
                                    <div class="col-md-4">  
                                        <router-link type="button" class="btn-danger btn-sm btn position-reverse btn-block" :to="'/indexPericia'" >
                                        <i class="fas fa-reply"></i> Volver Atrás
                                        </router-link> 
                                    </div>
                                
                            </div>

                            

                        </div>
                        
                    </div>
                </div>                                                           
                        </div>
                    <!-- /.card -->
                    </div>
                    <!-- card 3 Muestra Datos de las Designaciones -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <template v-if="pericias.length > 0">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%" class="text-center">OPCIONES</th>
                                            <th style="width: 20%" class="text-center">NIVEL DE PERICIA</th>
                                            <th style="width: 10%" class="text-center">DESCRIPCION</th>
                                            <th style="width: 10%" class="text-center">FECHA</th> 
                                            <th style="width: 30%" class="text-center">ESTADO</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="s in datos " :key="s.id">
                                           <td class="text-center">
                                                <button  type="button" class="btn btn-warning btn-sm" @click="AbrirEditarPublicacion(s.id)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" @click="EliminarPublicacion(s.id)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>                                              
                                                
                                            </td>
                                            <td class="text-center">{{s.pericia}}</td>
                                            <td class="text-center">{{s.descripcion}}</td>
                                            <td class="text-center">{{s.fecha | moment('DD/MM/YYYY')}}</td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <div v-if="s.estado === 1">
                                                <span class="badge badge-success">Actual</span>
                                                </div>
                                                <div v-else>
                                                <span class="badge badge-danger">Deshabilitado</span>                                            
                                                </div>                            
                                            </td> 
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            </template>
                            <template v-else>
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-info"></i> Nota:</h5>
                                    Realice una búsqueda.
                                </div>
                            </template>                                                           
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
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
    data() {
        const today = new Date();
        return {
            pericias: [], //Lista del Personal Buscado
            datos: [], //Datos Personales
            percod: this.$route.params.per,

        }
    },
    // validations:{
    //         representacionC : { required },
    //         documento : { required },
    //         nrodoc : { required },
    //         fecha : { required },
    //         descripcion: { required },
            
    // },
    mounted() {
        this.listarPericias();
        this.listarDatosPersonalSituacion();
    },
    computed:{
    }, 
    methods: {

        listarPericias(){
            let me = this;
            axios
            .post("/listadorPericias", {
                percodigo: me.percod
            })
            .then(function (response) {
                // me.pericias = 
                console.log(response);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },


        listarDatosPersonalSituacion(){
            let me = this;
            
            axios
            .post("/listarDatosPersonalSituacion", {
                percodigo: me.percod
            })
            .then(function (response) {
                me.datos=response.data; 
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

       fechaactual(date){
            const today = new Date();
            console.log(today);
            today.setHours(0, 0, 0, 0);
            return  date > new Date(today.getTime());
        },


        verDatos(codigo){
            let me = this;
            axios
            .post("/datosPersonales", {
                percodigo: codigo
            })
            .then(function (response) {
                
                me.datos = response.data;
                $('#DatosPersonales').modal('show');
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            
        },

        NuevaRepresentacion(){
            this.listarPublicacionesCombo();
            $('#NuevaRepresentacion').modal('show');
            $(".modal-header").css("background-color", "#007bff"); 
            $(".modal-header").css("color", "white" ); 
        },

        
        RegistrarPublicacion(){
            this.$v.$reset();
            if(!this.$v.$invalid){
            swal.fire({
                title: '¿Desea guardar la nueva Publicación?', // TITULO 
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

                axios
                   .post("/registrarPublicacion", {
                        percodigo: me.percod,
                        pubcod: me.representacionC.id,
                        descripcion:me.descripcion.toUpperCase(),
                        documento: me.documento.toUpperCase(),
                        nrodoc: me.nrodoc,
                        fecha: me.fecha,                       
                        observacion: me.observacion.toUpperCase()
                    })
                    .then(function (response) {
                        
                        me.listarPublicacion();
                        me.listarDatosPersonalSituacion();
                        $('#NuevaRepresentacion').modal('hide');
                        swal.fire(
                            "Aceptado", //TITULO
                            "Se añadio correctamente la nueva Publicación.", //TEXTO DE MENSAJE
                            "success" // TIPO DE MODAL (success, warnning, error, info)
                        );

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    }) 
                }else{
                    swal.fire(
                        "Anulado", //TITULO
                        "No se realizo el registro de la nueva Publicación.", //TEXTO DE MENSAJE
                        "info" // TIPO DE MODAL (success, warnning, error, info)
                    );
                }
            })
            }
             else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
                
            } 
        },
        
        
        AbrirEditarPublicacion(s){
            let me = this;
            me.idrepre = s;
            axios
            .post("/listarPublicacionModificar", {
                reppercod: s
            })
            .then(function (response) {
                
                
                me.representacionC = response.data.publicacion;
                me.idrepC = response.data.pubcod;
                me.descripcionA = response.data.descripcion,
                me.documentoA = response.data.documento;
                me.nrodocA = response.data.nrodoc;
                me.fechaA = response.data.fecha;                
                me.observacionA = response.data.observacion
                me.listarPublicacionesCombo();
                $('#EditarSituacionMilitar').modal('show')
                $(".modal-header").css("background-color", "#007bff"); 
                $(".modal-header").css("color", "white" ); 
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })    
           
            },


        EditarPublicacion(){
            
            swal.fire({
                title: '¿Desea realizar la modificación de la Publicación ?', // TITULO 
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
                     if (me.representacionC.id) {
                        var repre = me.representacionC.id;
                    } else {
                        var repre =  me.idrepC;
                    }
                    axios
                    .post("/editarPublicacion", {
                        codigo:me.idrepre,
                        pubcod: repre,
                        descripcion: me.descripcionA.toUpperCase(),
                        documento: me.documentoA.toUpperCase(),
                        nrodoc: me.nrodocA,
                        fecha: me.fechaA,
                        observacion: me.observacionA.toUpperCase()
                    })
                    .then(function (response) {
                        
                        $('#EditarSituacionMilitar').modal('hide');
                        swal.fire(
                            "Aceptado", //TITULO
                            "Se modificó correctamente la Publicación.", //TEXTO DE MENSAJE
                            "success" // TIPO DE MODAL (success, warnning, error, info)
                        )
                        me.listarPublicacion();
                        me.listarDatosPersonalSituacion();
                        
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })   
                        }else{
                            swal.fire(
                            "Anulado", //TITULO
                            "No se realizo la actualización de la Publicación.", //TEXTO DE MENSAJE
                            "info" // TIPO DE MODAL (success, warnning, error, info)
                            );
                        }
                    })
           
            
        },

        EliminarPublicacion(codigo){
            swal.fire({
                title: '¿Desea realizar la eliminación de la Publicación ?', // TITULO 
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
                                     
                    axios
                    .post("/eliminarPublicacion", {
                        idrepre: codigo
                        
                    })
                    .then(function (response) {
                        
                       
                        swal.fire(
                            "Aceptado", //TITULO
                            "Se eliminó correctamente la Publicación.", //TEXTO DE MENSAJE
                            "success" // TIPO DE MODAL (success, warnning, error, info)
                        )
                        me.listarPublicacion();
                        me.listarDatosPersonalSituacion();
                        
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })   
                        }else{
                            swal.fire(
                            "Anulado", //TITULO
                            "No se realizo la eliminación de la Publicación.", //TEXTO DE MENSAJE
                            "info" // TIPO DE MODAL (success, warnning, error, info)
                            );
                        }
                    })
            
        },
        
        ReportePublicacion(codigo){
            window.open('http://sipefab.fab.bo/PublicacionesPdf?per_codigo='+codigo);
        },

        /**
         * validaciones de campos
         */
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
        /**
         * validaciones de campos
         */
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
    },
};
</script>

<style>
.dat {
    width: 100%;
  }

</style>