<template>
<main>

      <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="far fa-bookmark"></i>REVISTAS INDIVIDUAL
                    </h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
      </section>





      <section class="content">
          <!-- card 2 Muestra Datos Personales -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">

                                    <img :src="'../img/personal/'+a.foto" width="100%" height="60%">
                                </div>

                                <div class="col-md-10 d-flex align-items-center">
                                    <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                        <!-- FILA 1 -->
                                        <div class="row p-2 bd-highlight">
                                            <div class="col-md-6">
                                                <dl>
                                                    <dt class="st">GRADOS Y NOMBRES</dt>
                                                    <dd class="st">{{ a.grado }} {{ a.complemento }} {{ a.nombre }} {{ a.paterno }} {{ a.materno }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-4">
                                                <dl>
                                                    <dt class="st">CARNET MILITAR</dt>
                                                    <dd class="st">{{ a.cm }}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <!-- FILA 2 -->
                                        <div class="row p-2 bd-highlight">
                                            <div class="col-md-6">
                                                <dl>
                                                    <dt class="st">CARNET DE IDENTIDAD</dt>
                                                    <dd class="st">{{ a.ci }} {{ a.expedido }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dl>
                                                    <dt class="st">SITUACION MILITAR ACTUAL</dt>
                                                    <dd class="st">{{ a.nombsit }} - {{a.nombsub}} - {{a.nombdet}}</dd>
                                                </dl>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center margin-bottom col-md-12">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-sm btn-block" title="Registrar Revistas"
                                @click="NuevaRevista"><i class="fas fa-plus-circle">Nueva Revista</i>
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-sm btn-secondary btn-block" @click.prevent="Reporte()">
                                <i class="far fa-file-pdf"></i>Reporte General
                                </button>
                            </div>
                            <button v-if="$auth.can('report-certdestserv')" type="button" class="btn btn-info btn-sm" @click="DesgServicio()">
                        <i class="far fa-file-alt" aria-hidden="true">  GENERAR CERTIFICADO</i>
                    </button>
                            <div class="col-md-3">
                                <router-link type="button" class="btn-info btn-sm position-reverse btn-danger btn-block" :to="'/Revistas'">
                                    <i class="fas fa-reply"></i> Volver Atrás
                                </router-link>
                            </div>
                        </div>


                        <div class="form-group row justify-content-center margin-bottom col-md-12">

                                    <div class="form-group row col-9">

                                            <h3 style="font: 20px bold; margin-top: 6px;">
                                               <i class="far fa-address-card"></i>&nbsp;Reporte por rango de fechas ->
                                            </h3>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;

                                        <label style="font: 15px bold; margin-top: 9px;"><strong>De</strong></label>&nbsp; &nbsp;
                                        <input type="date" format='DD-MM-YYYY' v-model="fecha_inicio" class="form-control col-sm-3">&nbsp; &nbsp;
                                        <label style="font: 15px bold; margin-top: 9px;"><strong>Hasta</strong></label>&nbsp; &nbsp;
                                        <input type="date" format='DD-MM-YYYY' v-model="fecha_fin" class="form-control col-sm-3">&nbsp; &nbsp;
                                        <br>
                                        <div class="form-group row justify-content-center margin-bottom col-md-12 ">
                                            <br>
                                            <button class="btn btn-sm btn-secondary justify-content-center margin-top: 10px" type="button" @click.prevent="generarPDF()"><i class="far fa-file-pdf"></i> Reporte Rango Fechas</button>&nbsp; &nbsp; &nbsp;
                                        </div>
                                    </div>

                        </div>
                    <!-- /.card -->
                    </div>





            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                          <div class="card-header">
                                <h3 class="card-title">
                                    {{a.grado}} {{a.complemento}} {{a.nombre}} {{a.paterno}} {{a.materno}}

                                </h3>
                            </div>
                            <div class="card-body">
                              <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="width: 100px" class="text-center">OPCIONES</th>
                            <th style="width: 100px" class="text-center">CARGO</th>
                            <th style="width: 200px" class="text-center">COMPAÑIA</th>
                            <th style="width: 200px" class="text-center">FECHA DE REVISTA</th>
                            <th style="width: 200px" class="text-center">UNIDAD</th>
                            <th style="width: 350px" class="text-center">DELEGADO REVISTANTE</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="p in b"  v-if="p.funcion != 'DELEGADO REVISTANTE'">

                            <td>

                            &nbsp;
                                <button type="button" class="btn btn-warning btn-sm " @click="AbrirRevista(p)" >
                                <i class="fas fa-edit"></i>
                                </button>

                                <!-- <button type="button" class="btn btn-danger btn-sm " @click="EliminarRevista(p)" >
                                <i class="fas fa-eraser"></i>
                                </button>  -->

                                <button type="button" class="btn btn-danger btn-sm " @click="CambiarEstado(p.idpr)" >
                                <i class="fas fa-trash"></i>
                                </button>



                            </td>

                            <td> {{p.funcion}} </td>
                            <td> {{p.compania}}</td>
                            <td> {{p.fecha}} </td>
                            <td> {{p.lugar}} </td>
                            <td> {{p.delegado_revistante}} </td>
                        </tr>

                    </tbody>

                </table>
                            </div>
                        </div>

                    </div>
                  </div>
            </div>

      </section>


<br>






    <!-- EDITAR REVISTA        -->
    <div class="modal fade" data-backdrop="static" id="EditarModal">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR REVISTA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label for="">COMPAÑIA</label>
                        <select class="form-control" v-model="companiaA">
                            <option value="CADETES">CADETES</option>
                            <option value="ALUMNOS">ALUMNOS</option>
                            <option value="SOLDADOS">SOLDADOS</option>
                            <option value="PREMILITARES">PREMILITARES</option>
                            <option value="VOLUNTARIOS">VOLUNTARIOS</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="">FECHA DE REVISTA</label>
                        <input class="form-control" type="date" v-model="fecha_revistaA">
                    </div>
                    <div class="col-4">
                        <label for="">FUNCION</label>
                        <select class="form-control" v-model="funcionA">
                          <option value="CMDTE. DE BATALLON">CMDTE. DE BATALLON</option>
                          <option value="CMDTE. DE ESCUADRON">CMDTE. DE ESCUADRON</option>
                          <option value="CMDTE. DE COMPAÑIA">CMDTE. DE COMPAÑIA</option>
                          <option value="PRIMERO DE COMPAÑIA">PRIMERO DE COMPAÑIA</option>
                          <option value="CMDTE. DE SECCION">CMDTE. DE SECCION</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">DELEGADO REVISTANTE</label>
                            <v-select label="nombre" :options="Arevistante" v-model="delegado_revistanteA">
                                <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>
                                </template>
                                <em v-else>
                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                </template>
                            </v-select>
                    </div>

                    <div class="col-4">
                            <label for="">UNIDAD</label>
                            <select class="form-control" v-model="lugarA">
                                <option value="GADA 91">GADA 91</option>
                                <option value="GADA 92">GADA 92</option>
                                <option value="GADA 93">GADA 93</option>
                                <option value="GADA 94">GADA 94</option>
                                <option value="GADA 95">GADA 95</option>
                                <option value="GADA 96">GADA 96</option>
                                <option value="GADA 97">GADA 97</option>
                                <option value="SAR FAB - ILLIMANI">SAR FAB - ILLIMANI</option>
                                <option value="SAR FAB - COCHABAMBA">SAR FAB - COCHABAMBA</option>
                                <option value="SAR FAB - SC">SAR FAB - SC</option>
                                <option value="SAR FAB - DEL SUR">SAR FAB - DEL SUR</option>
                                <option value="SAR FAB - TRINIDAD">SAR FAB - TRINIDAD</option>
                                <option value="SAR FAB - COBIJA">SAR FAB - COBIJA</option>
                                <option value="SAR FAB - PUERTO SUAREZ">SAR FAB - PUERTO SUAREZ</option>
                                <option value="COLMILAV">COLMILAV</option>
                                <option value="POLITECNICO">POLITECNICO</option>
                                <option value="ESCUELA MILITAR DE MUSICA">ESCUELA MILITAR DE MUSICA</option>
                                <option value="CUARTEL GENERAL">CUARTEL GENERAL</option>
                                <option value="GRUPO AÉREO 83">GRUPO AÉREO 83</option>
                                <option value="GRUPO AÉREO 61">GRUPO AÉREO 61</option>
                                <option value="GRUPO AÉREO 62">GRUPO AÉREO 62</option>
                                <option value="GRUPO AÉREO 63">GRUPO AÉREO 63</option>
                                <option value="GRUPO AÉREO 64">GRUPO AÉREO 64</option>
                                <option value="GRUPO AÉREO 65">GRUPO AÉREO 65</option>
                                <option value="ECEMA">ECEMA</option>
                                <option value="III BRIGADA AEREA">III BRIGADA AEREA</option>
                                <option value="GAE 22">GAE 22</option>
                                <option value="SAR RIVERALTA">SAR RIVERALTA</option>
                                <option value="SAR CAPITAL">SAR CAPITAL</option>
                                <option value="SAR VILLAMONTES">SAR VILLAMONTES</option>
                                <option value="EMI - LA PAZ">EMI - LA PAZ</option>
                                <option value="EMI - COCHABAMBA">EMI - COCHABAMBA</option>
                                <option value="EMI - SANTA CRUZ">EMI - SANTA CRUZ</option>
                                <option value="EMI - RIBERALTA">EMI - RIBERALTA</option>
                                <option value="EMI - DEL TROPICO">EMI - DEL TROPICO</option>
                            </select>
                        </div>



                </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
              <button type="button" class="btn btn-primary" @click="EditarRevista()">MODIFICAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- MODAL PARA AGREGAR NUEVA REVISTA -->

    <div class="modal fade" data-backdrop="static" id="NuevoModal">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REGISTRAR NUEVA REVISTA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="row">

                  <div class="col-4">
                      <label for="">COMPAÑIA</label>
                      <select class="form-control" v-model="compania">
                          <option value="CADETES">CADETES</option>
                          <option value="ALUMNOS">ALUMNOS</option>
                          <option value="SOLDADOS">SOLDADOS</option>
                          <option value="PREMILITARES">PREMILITARES</option>
                          <option value="VOLUNTARIOS">VOLUNTARIOS</option>
                      </select>
                  </div>

                  <div class="col-4">
                      <label for="">FECHA DE REVISTA</label>
                      <input class="form-control" type="date" v-model="fecha_revista">
                  </div>

                  <div class="col-4">
                      <label for="">FUNCION</label>
                      <select class="form-control" v-model="funcion">
                          <option value="CMDTE. DE BATALLON">CMDTE. DE BATALLON</option>
                          <option value="CMDTE. DE ESCUADRON">CMDTE. DE ESCUADRON</option>
                          <option value="CMDTE. DE COMPAÑIA">CMDTE. DE COMPAÑIA</option>
                          <option value="PRIMERO DE COMPAÑIA">PRIMERO DE COMPAÑIA</option>
                          <option value="CMDTE. DE SECCION">CMDTE. DE SECCION</option>
                      </select>
                  </div>



              </div>

              <div class="row">
                    <div class="col-4">
                        <label for="">REVISTANTE</label>
                        <v-select label="nombre" :options="Arevistante" v-model="delegado_revistante">
                            <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                            </template>
                            <em v-else>
                                Lo sentimos, no hay opciones de coincidencia.</em>
                            </template>
                        </v-select>
                    </div>

                    <div class="col-4">
                        <label for="">UNIDAD</label>
                        <select class="form-control" v-model="lugar">
                            <option value="GADA 91">GADA 91</option>
                                <option value="GADA 92">GADA 92</option>
                                <option value="GADA 93">GADA 93</option>
                                <option value="GADA 94">GADA 94</option>
                                <option value="GADA 95">GADA 95</option>
                                <option value="GADA 96">GADA 96</option>
                                <option value="GADA 97">GADA 97</option>
                                <option value="SAR FAB - ILLIMANI">SAR FAB - ILLIMANI</option>
                                <option value="SAR FAB - COCHABAMBA">SAR FAB - COCHABAMBA</option>
                                <option value="SAR FAB - SC">SAR FAB - SC</option>
                                <option value="SAR FAB - DEL SUR">SAR FAB - DEL SUR</option>
                                <option value="SAR FAB - TRINIDAD">SAR FAB - TRINIDAD</option>
                                <option value="SAR FAB - COBIJA">SAR FAB - COBIJA</option>
                                <option value="SAR FAB - PUERTO SUAREZ">SAR FAB - PUERTO SUAREZ</option>
                                <option value="COLMILAV">COLMILAV</option>
                                <option value="POLITECNICO">POLITECNICO</option>
                                <option value="ESCUELA MILITAR DE MUSICA">ESCUELA MILITAR DE MUSICA</option>
                                <option value="CUARTEL GENERAL">CUARTEL GENERAL</option>
                                <option value="GRUPO AÉREO 83">GRUPO AÉREO 83</option>
                                <option value="GRUPO AÉREO 61">GRUPO AÉREO 61</option>
                                <option value="GRUPO AÉREO 62">GRUPO AÉREO 62</option>
                                <option value="GRUPO AÉREO 63">GRUPO AÉREO 63</option>
                                <option value="GRUPO AÉREO 64">GRUPO AÉREO 64</option>
                                <option value="GRUPO AÉREO 65">GRUPO AÉREO 65</option>
                                <option value="ECEMA">ECEMA</option>
                                <option value="III BRIGADA AEREA">III BRIGADA AEREA</option>
                                <option value="GAE 22">GAE 22</option>
                                <option value="SAR RIVERALTA">SAR RIVERALTA</option>
                                <option value="SAR CAPITAL">SAR CAPITAL</option>
                                <option value="SAR VILLAMONTES">SAR VILLAMONTES</option>
                                <option value="EMI - LA PAZ">EMI - LA PAZ</option>
                                <option value="EMI - COCHABAMBA">EMI - COCHABAMBA</option>
                                <option value="EMI - SANTA CRUZ">EMI - SANTA CRUZ</option>
                                <option value="EMI - RIBERALTA">EMI - RIBERALTA</option>
                                <option value="EMI - DEL TROPICO">EMI - DEL TROPICO</option>
                               
                        </select>
                    </div>
              </div>



            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
              <button type="button" class="btn btn-primary" @click="RegistraRevista()" >REGISTRAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

       <!-- MODAL PARA ELIMINAR NUEVA REVISTA -->

       <div class="modal fade" id="modal-danger">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">ELIMINAR REVISTA</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p>Esta seguro que quiere eliminar esta revista?&hellip;</p>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">CANCELAR</button>
                        <button type="button" class="btn btn-outline-light" @click="BorrarRevista()" >ELIMINAR</button>
                    </div>
                </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

</main>

</template>

<script>
export default {

    data() {
        return {
            b:[],
            percodigo: this.$route.params.id,
            a:[],

            //VALORES PARA GUARDAR
            cod_revista:'',
            lugar:'',
            compania:'',
            fecha_revista:'',
            funcion: '',
            delegado_revistante: '',
            n_memo: '',

            revistante: [],



            //VALORES PARA EDITAR

            cod_revistaA: '',
            lugarA:'',
            companiaA:'',
            fecha_revistaA:'',
            funcionA:'',
            delegado_revistanteA: '',


            //destinos

            delegado_revistante: [],
            // DATOS DESTINOS


            Arevistante:[],
            per_codigo:'',
            idr:'',
            idPr:'',
            fecha_inicio: "",
            fecha_fin: ""

        }
    },

    mounted() {
        this.listaRevista();
        this.ver();
        this.PersonalR();
        this.datospersonales();
        this.listarDatosPersonalSituacion();
    },

    methods: {
        ver(){
            console.log(this.nombre);
        },

        listaRevista(){
            let me = this;

            axios
          .post("/revistasx", {
            dato: me.percodigo  ///envia el dato
          })
          .then(function (response) {
            me.b=response.data
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })

        },

        datospersonales(){
            let me = this;
            axios
          .post("/datos", {
            percodigo: me.percodigo
          })
          .then(function (response) {
           me.a=response.data;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

       RevistaPersona(){
            let me = this;

            axios
            .get('/revistas')
            .then(function (response) {
             me.a = response.data;
            })
            .catch(function (error) {
            console.log(error);
            });
        },

        EditarNombre(nombre){
            this.$router.push({
            name: "EditarNombre",
            params:{
                n:nombre
            }
            });

        },

        Nuevo(nombre){
            this.$router.push({
            name: "NuevaRevista",
            params:{
                n:nombre
            }
            });
        },

        NuevaRevista(){
            $('#NuevoModal').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            $(".modal-title-registro").text("Registrar Nueva Revista");
        },

        RegistraRevista(){

            let me = this;
            axios
            .post("/NuevaRevista", {

                per: me.percodigo,
                c: 1,
                l: me.lugar,
                com: me.compania,
                nm: '',
                fr: me.fecha_revista,
                dr: me.delegado_revistante.nombre,
                f: me.funcion,
                ob: "nada"

            })

            .then(function (response) {
                console.log(response)
                $('#NuevoModal').modal('hide')
                me.listaRevista();

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })

        },

        AbrirRevista(p){

            this.cod_revistaA           = p.cod_rev,
            this.lugarA                 = p.lugar,
            this.companiaA              = p.compania,
            this.fecha_revistaA         = p.fecha,
            this.funcionA               = p.funcion,

            this.delegado_revistanteA   = p.delegado_revistante,
            this.idPr                   = p.idpr
            console.log(p);
            $('#EditarModal').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
        },

        EditarRevista(){
            let me = this;

            axios
            .post("/EditarRevista", {
                id: me.idPr,
                per: me.percodigo,
                c: 1,
                l: me.lugarA,
                com: me.companiaA,
                nm: '',
                fr: me.fecha_revistaA,
                dr: me.delegado_revistanteA.nombre,
                f: me.funcionA,
                ob: "nada"
            })
            .then(function ( response) {
                console.log(response)
                $('#EditarModal').modal('hide')
                me.listaRevista();

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },


        EliminarRevista(){

          $('#modal-danger').modal('show');

        },

        BorrarRevista(){
          let me = this;

            axios
            .post("/EliminarRevista", {

                per: me.percodigo,
                cod: me.id,
               // id: me.idPr

               /* c: 1,
                l: me.lugarA,
                com: me.companiaA,
                fr: me.fecha_revistaA*/
            })
            .then(function (response) {
                console.log(response)
                $('#modal-danger').modal('hide')
                me.listaRevista();

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },



        PersonalR(){
            let me = this;
            axios
            .get("/revistante")
            .then(function (response) {
              console.log(response);
                me.Arevistante = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        CambiarEstado(idpr){
            Swal.fire({
                title: '¿Está seguro de eliminar la revista?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
            }).then((result) => {
                if (result.value) {
                    this.fullscreenLoading = true;
                    var url ='/personalRevistas/cambiarEstado'
                    axios.post(url, {
                        'idpr'   :   idpr
                    }).then(response => {
                        Swal.fire({
                            icon    :   'success',
                            title   :   'Se elimino la revista',
                            showConfirmButton   : false,
                            timer   :   1500
                        })
                        this.listaRevista();
                    })
                }
            })
        },

        generarPDF(){
            var id = this.percodigo;
            var finicio = this.fecha_inicio;
            var ffin = this.fecha_fin;
            window.open('https://sipefab.fab.bo/reporteF/generarRangofechasF?id=' + id+ '&inicio='+ finicio + '&fin=' + ffin, '_blank');
            // window.open('http://192.168.24.56:8000/reporte/generarRangofechas?inicio='+fecha_inicio+'&fin='+fecha_fin,'_blank');
        },

         listarDatosPersonalSituacion(){
            let me = this;
            axios.post("/listarDatosPersonalSituacion", {
                percodigo: me.percodigo
            })
            .then(function (response) {
                me.a=response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
        },

        DesgServicio(){
          let me = this;
          var id = me.percodigo
          window.open('https://sipefab.fab.bo/certificadoRevista?id='+id);
          //window.open('http://sipefabv1.test/certificadoRevista?id='+id);
        },

        Reporte(){
          let me = this;
          var id = me.percodigo
          //window.open('http://sipefabv1.test/reporDest?id=' + id);
          window.open('https://sipefab.fab.bo/reporDest?id=' + id);
        },

    },


}
</script>

<style>

</style>
