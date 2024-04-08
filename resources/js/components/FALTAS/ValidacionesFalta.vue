<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              VALIDACION DE FALTAS
            </h1>
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
        <!-- CABECERA DE BUSQUEDA POR DESTINO -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"> 
                  <i class="fas fa-edit"></i>&nbsp;&nbsp;
                  SELECCION DE UNIDAD
                </h3>
              </div>
              <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Organismo:</label>
                            <v-select
                                label="descripcion"
                                :options="Adestinos1"
                                v-model="dest1"
                                @input="Destino2"
                            >
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                        Lo sentimos, no hay opciones de coincidencia para <em>{{
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
                        <div class="col-md-8">
                            <label for="">Gran Unidad:</label>
                            <v-select
                                label="descripcion"
                                :options="Adestinos2"
                                v-model="dest2"
                                @input="Destino3"
                            >
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                        Lo sentimos, no hay opciones de coincidencia para <em>{{
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
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Repartición:</label>
                            <v-select
                                label="descripcion"
                                :options="Adestinos3"
                                v-model="dest3"
                            >
                                <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Lo sentimos, no hay opciones de coincidencia para <em>{{
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
                    <div class="row p-2 bd-highlight justify-content-center">
                        <div class="col-md-4">                                            
                            <button class="btn btn-sm btn-primary btn-block" @click="ListaFaltas()">
                                <i class="fas fa-plus"></i> &nbsp; &nbsp;
                                Buscar Faltas
                            </button>
                        </div>                        
                    </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
        <!-- TABLA DE FALTAS A VALIDAR -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;
                  LISTA DE FALTAS
                </h3>
              </div>
              <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10%" class="text-center">Opcion</th>
                                <th style="width: 25%" class="text-center">Sancionador</th>
                                <th style="width: 25%" class="text-center">Sancionado</th>
                                <th style="width: 15%" class="text-center">Documento</th>
                                <th style="width: 10%" class="text-center">Fecha</th>
                                <th style="width: 15%" class="text-center">Nro. Documento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="ds in Ademeritos">
                                <td class="text-center">
                                    <button v-if="$auth.can('val-faltuni')" type="button" class="btn btn-info btn-sm" @click="Validacion(ds.id)">
                                        <i class="fas fa-check-circle"></i>
                                    </button> 
                                    <button type="button" class="btn btn-success btn-sm" @click="VerDatosModal(ds.id,ds.per_codigo)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                <td class="text-center">{{ ds.sancionador}}</td>
                                <td>{{ ds.grado }} {{ ds.complemento }} {{ ds.nombre }} {{ ds.paterno }} {{ ds.materno }}  </td>
                                <td class="text-center">{{ ds.documento }}</td>    
                                <td class="text-center">{{ ds.fecha_sancion }}</td>
                                <td class="text-center">{{ ds.ndoc}}</td>               
                            </tr>
                        </tbody>
                        
                    </table>
                    

              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->

        <div class="modal fade" id="VerFalta">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ Adatos.grado }} {{Adatos.compleSanc}}  {{ dataPer.nombre }} {{ dataPer.paterno }} {{ dataPer.materno }}</h4>
                        <button type="button" class="close" @click="CerrarModal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- SANCIONADO -->
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">DATOS SANCIONADO</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <dl>
                                        <dt class="st">UNIDAD:</dt>
                                        <dd class="st">{{Adatos.d3}}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6 separador">
                                    <dl>
                                        <dt class="st"> SECCION:</dt>
                                        <dd class="st">{{Adatos.d4}}</dd>
                                    </dl>
                                </div>
                            </div>
                        </fieldset>
                        <!-- SANCIONADOR -->
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">DATOS SANCIONADOR</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <dl>
                                        <dt class="st">NOMBRE:</dt>
                                        <dd class="st">{{Adatos.sancionador}}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6 separador">
                                    <dl>
                                        <dt class="st"> UNIDAD:</dt>
                                        <dd class="st">{{Adatos.unidad}}</dd>
                                    </dl>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">DATOS SANCIONADOR</legend>
                            <div class="row">
                                <div class="col-md-2">
                                    <dl>
                                        <dt class="st">DOCUMENTO:</dt>
                                        <dd class="st">{{Adatos.documento}}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-3 separador">
                                    <dl>
                                        <dt class="st">NUMERO DOCUMENTO:</dt>
                                        <dd class="st">{{Adatos.ndoc}}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-3 separador">
                                    <dl>
                                        <dt class="st">FECHA DE SANCION:</dt>
                                        <dd class="st">{{Adatos.fecha_sancion}}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-4 separador">
                                    <dl>
                                        <dt class="st">NIVEL FALTA:</dt>
                                        <dd class="st">{{Adatos.f1}}</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <dl>
                                        <dt class="st">TIPO FALTA:</dt>
                                        <dd class="st">{{Adatos.f2}}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-4 separador">
                                    <dl>
                                        <dt class="st">SANCION:</dt>
                                        <dd class="st">{{Adatos.sancion}}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-2 separador">
                                    <dl>
                                        <dt class="st">DIAS DE SANCION:</dt>
                                        <dd class="st">{{Adatos.dias}}</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <dl>
                                        <dt class="st">DETALLE:</dt>
                                        <dd class="st">{{Adatos.observacion}}</dd>
                                    </dl>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
    data() {
        return {
             /**
             * VARIABLES PARAMETRICAS
             */
            //destinos
            dest1: [],
            dest2: [],
            dest3: [],
            dest4: [],
             /**
             * VARIABLES DE RECEPCION
             */   
            // DATOS DESTINOS
            Adestinos1:[],
            Adestinos2:[],
            Adestinos3:[],
            Adestinos4:[],
            //LISTA DEMERITOS
            Ademeritos: [],
            /**
             * VARIABLES PARA VER FALTA
             */
            dataPer: [],
            Adatos: []   
        }
    },
    mounted() {
        this.Destino1();
    },
    methods: {
        /**
         * FUNCIONES PARA LOS SELECTS
         */
        //DESTINOS
        Destino1(){
            let me = this;
            axios
            .get('/destino1Combo')
            .then(function (response) {
                me.Adestinos1 = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            });
        },
        Destino2(){
            try {
                let me = this;
                me.dest2 = '';
                me.dest3 = '';
                me.dest4 = '';
                axios
                .post("/destino2Combo", {
                    dest1: me.dest1.id
                })
                .then(function (response) {
                    me.Adestinos2 = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            } catch (error) {
                this.Adestinos2 = [];
                this.Adestinos3 = [];
                this.Adestinos4 = [];
            } 
        },
        Destino3(){
            try {
                let me = this;
                me.dest3 = '';
                axios
                .post("/destino3Combo", {
                    dest2: me.dest2.id
                })
                .then(function (response) {
                    me.Adestinos3 = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            } catch (error) {
                this.Adestinos3 = [];
            }
        },
        //LISTA DE FALTAS
        ListaFaltas(){
            let me = this;
            axios
            .post("/listaDemeritosValidar", {
                dest1: me.dest1.id,
                dest2: me.dest2.id,
                dest3: me.dest3.id
            })
            .then(function (response) {
                
                me.Ademeritos =  response.data       
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        //FUNCION PARA VALIDAR
        Validacion(id){
            swal.fire({
                title: '¿Desea validar la Falta?', // TITULO 
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
                    .post("/validarFalta", {
                        id: id,
                    })
                    .then(function (response) {
                        swal.fire(
                            "Aceptado", //TITULO
                            "Se valido la falta correctamente.", //TEXTO DE MENSAJE
                            "success" // TIPO DE MODAL (success, warnning, error, info)
                        );
                    me.ListaFaltas();

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })

                }else{
                console.log('no empezamos');
                }
            })

            
        },
        /*
        * FUNCION PARA VER LAS FALTAS
        */
        DatosPersonales(percodigo){
            let me = this;
            axios
            .post("/datosPersonalesDem", {
                percodigo: percodigo
            })
            .then(function (response) {
                
                me.dataPer = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        VerDatosModal(falta, percodigo){
            this.DatosPersonales(percodigo)
            this.VerDatos(falta);
            $('#VerFalta').modal('show');
        },
        VerDatos(falta){
            // alert(falta)
            let me = this;
            axios
            .post("/datosFalta", {
                per_codigo: me.per_codigo,
                id: falta
            })
            .then(function (response) {
                
                me.Adatos = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        CerrarModal(){
            //faltas y sanciones
            this.falta1= [];
            this.falta2= [];
            this.sancion= [];
            //documento
            this.doc= [];
            this.ndoc= '';
            this.fecha= '';
            this.sancionador= [];
            this.dias= 0;
            this.grado=[];
            this.observacion= '';
            this.cargo='';
        }
    },
};
</script>

<style>
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    width:auto;
    padding:0 10px;
    border-bottom:none;
}

.separador {
    border-left: 1px #000 solid;
    padding-left: 15px;
}
</style>