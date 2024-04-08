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
                    PUBLICACIONES
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
                                    <div v-if="$auth.can('insert-pub')" class="col-md-4">                                            
                                        <button class="btn btn-sm btn-success btn-block" @click="NuevaRepresentacion()">
                                            <i class="fa fa-plus-circle"></i> &nbsp;
                                            Nueva Publicación 
                                        </button>
                                        
                                    </div>
                                    <div v-if="$auth.can('report-pub')" class="col-md-4">  
                                        <button type="button" @click="ReportePublicacion(datos.codigo)" class="btn btn-sm btn-secondary btn-block">
                                         <i class="far fa-file-pdf"></i>&nbsp;Reporte Personal
                                        </button>
                                    </div>
                                    <div class="col-md-4">  
                                        <router-link type="button" class="btn-danger btn-sm btn position-reverse btn-block" :to="'/personalpublicaciones'" >
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
                            <template v-if="publicacion.length > 0">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%" class="text-center">OPCIONES</th>
                                            <th style="width: 20%" class="text-center">PUBLICACION</th>
                                            <th style="width: 10%" class="text-center">NRO.DOC</th>
                                            <th style="width: 10%" class="text-center">DOCUMENTO</th>
                                            <th style="width: 10%" class="text-center">FECHA</th> 
                                            <th style="width: 30%" class="text-center">DESCRIPCION</th>                               
                                            <th style="width: 20%" class="text-center">OBSERVACION</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="s in publicacion " :key="s.id">
                                           <td class="text-center">
                                                <!--<button type="button" class="btn btn-success btn-sm" @click="verDatos(p.codigo)">
                                                    <i class="far fa-eye"></i>
                                                </button>-->
                                                <button v-if="$auth.can('edit-pub')" type="button" class="btn btn-warning btn-sm" @click="AbrirEditarPublicacion(s.codigo)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button v-if="$auth.can('delete-pub')"  type="button" class="btn btn-danger btn-sm" @click="EliminarPublicacion(s.codigo)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                
                                                
                                            </td>
                                            <td class="text-center">{{s.publicacion}}</td>
                                            <td class="text-center">{{s.nrodoc}}</td>
                                            <td class="text-center">{{s.documento}}</td>
                                            <td class="text-center">{{s.fecha | moment('DD/MM/YYYY')}}</td>  
                                            <td class="text-justify">{{s.descripcion}}</td>                                       
                                            <td class="text-justify">{{s.observacion}}</td>                                                                            
                                                                                                             
                                                                                      
                                        </tr>
                                    </tbody>
                                    
                                </table> 

                                    <nav>
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
                                </nav> 


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

        <div class="modal fade" id="DatosPersonales">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{datos.grado}} {{datos.complemento}} {{datos.nombre}} {{datos.paterno}} {{datos.materno}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- llenado de informacion de Datos -->
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">CARNET MILITAR</dt>
                                        <dd class="st">{{ datos.cm }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">CARNET DE IDENTIDAD</dt>
                                        <dd class="st">{{ datos.ci }} {{ datos.expedido }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">CARNET DE SEGURO</dt>
                                        <dd class="st">{{ datos.seguro }}</dd>
                                    </dl>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">ESTADO CIVIL</dt>
                                        <dd class="st">{{ datos.estadoCivil }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">FECHA DE NACIMIENTO</dt>
                                        <dd class="st">{{ datos.fechaNacimiento}}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">GENERO</dt>
                                        <dd class="st">{{ datos.genero }}</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">DIRECCION</dt>
                                        <dd class="st">{{ datos.per_domicilio }}</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">LIBRETA MILITAR</dt>
                                        <dd class="st">{{ datos.servMil }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-4">
                                    <dl>
                                        <dt class="st">RELIGION</dt>
                                        <dd class="st">{{ datos.religion}}</dd>
                                    </dl>
                                </div>
                            </div>

                        </div>
                        <!-- Foto del Personal -->
                        <div  class="col-md-10">

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" data-backdrop="static" id="NuevaRepresentacion">
           <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REGISTRAR NUEVA PUBLICACION</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>{{datos.grado}} {{datos.complemento}} {{datos.nombre}} {{datos.paterno}} {{datos.materno}}</h5>
                
                <div class="row">
                    <div class="col-12">
                        <label for="">PUBLICACIONES:</label>
                        <v-select                            
                            label="descripcion"                            
                            :options="representacioncombo"                            
                            v-model="representacionC"
                            :class="{ 'is-invalid' : $v.representacionC.$error, 'is-valid':!$v.representacionC.$invalid }"
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
                        <div class="invalid-feedback">
                        <span v-if="!$v.representacionC.required">Este campo es Requerido</span>
                        </div>
                    </div>
                  </div>  
                 <div class="row">   
                     <div class="col-4">
                        <label for="">DOCUMENTO:</label>
                        <br>
                        <select name="documento" id="doc" class="form-control" :class="{ 'is-invalid' : $v.documento.$error, 'is-valid':!$v.documento.$invalid }" v-model="documento" style="text-transform:uppercase">
                            <option value="MEMORANDUM" selected>RESOLUCION</option>
                            <option value="MEMORANDUM" >MEMORANDUM</option>
                            <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                            <option value="ORDEN DEL DIA">CERTIFICADO</option>
                        </select>
                        <div class="invalid-feedback">
                        <span v-if="!$v.documento.required">Este campo es Requerido</span>
                        </div>
                        <!--<input class="form-control" style="text-transform:uppercase;" type="select" v-model="documento">-->
                    </div>
                    <div class="col-4">
                        <label for="">NRO DOCUMENTO:</label>
                        <input class="form-control" :class="{ 'is-invalid' : $v.nrodoc.$error, 'is-valid':!$v.nrodoc.$invalid }" type="number" min=0 step=1 v-model="nrodoc">
                        <!--<input class="form-control" type="text" style="text-transform:uppercase;" v-model="nrodoc">-->
                        <!--<textarea name="textarea" rows="5" cols="30" v-model="direccion"></textarea>-->
                        <div class="invalid-feedback">
                        <span v-if="!$v.nrodoc.required">Este campo es Requerido</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <!--<label for="">FECHA:</label>
                        <input class="form-control" :class="{ 'is-invalid' : $v.fecha.$error, 'is-valid':!$v.fecha.$invalid }" type="date" v-model="fecha">
                        <div class="invalid-feedback">
                        <span v-if="!$v.fecha.required">Este campo es Requerido</span>
                        </div>-->
                        <label for="">FECHA:</label>
                        <date-picker class="dat" value-type="date" format="DD/MM/YYYY"
                                        v-model="fecha"
                                        :disabled-date="fechaactual"  
                                        :class="{ 'is-invalid' : $v.fecha.$error, 'is-valid':!$v.fecha.$invalid }"                                    
                                    ></date-picker>
                        <div class="invalid-feedback">
                        <span v-if="!$v.fecha.required">Este campo es Requerido</span>
                        </div>
                    </div>
                 </div>      
                
                <div class="row">
                    
                    <div class="col-12">
                        <label for="">DESCRIPCION:</label>
                        <input class="form-control" :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }" type="text" style="text-transform:uppercase;" v-model="descripcion">
                        <div class="invalid-feedback">
                        <span v-if="!$v.descripcion.required">Este campo es Requerido</span>
                        </div>
                        <!--<textarea name="textarea" rows="5" cols="30" v-model="observacion"></textarea>-->
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-12">
                        <label for="">OBSERVACION:</label>
                        <input class="form-control" type="text" style="text-transform:uppercase;" v-model="observacion">
                        
                        <!--<textarea name="textarea" rows="5" cols="30" v-model="observacion"></textarea>-->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="RegistrarPublicacion()">Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>

        
        <!-- /.modal-dialog -->
      </div>


        <div class="modal fade"  data-backdrop="static" id="EditarSituacionMilitar">
           <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR PUBLICACION</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>{{datos.grado}} {{datos.complemento}} {{datos.nombre}} {{datos.paterno}} {{datos.materno}}</h5>
                <div class="row">
                    <div class="col-12">
                        <label for="">PUBLICACIONES:</label>
                        <v-select                            
                            label="descripcion"                            
                            :options="representacioncombo"                            
                            v-model="representacionC"
                           
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
                <div class="row">
                    <div class="col-4">
                        <label for="">DOCUMENTO:</label>
                        <select name="documentoA" id="docA" class="form-control" v-model="documentoA" style="text-transform:uppercase">
                            <option value="MEMORANDUM" selected>RESOLUCION</option>
                            <option value="MEMORANDUM" >MEMORANDUM</option>
                            <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                            <option value="ORDEN DEL DIA">CERTIFICADO</option>
                        </select>
                        
                        <!--<input class="form-control" style="text-transform:uppercase;" type="text" v-model="documentoA">-->
                    </div>
                    <div class="col-4">
                        <label for="">NRO DOCUMENTO:</label>
                        <input class="form-control" type="text" style="text-transform:uppercase;" v-model="nrodocA">
                        
                    </div>
                    <div class="col-4">
                        <label for="">FECHA:</label>
                        <input class="form-control" type="date" v-model="fechaA">
                        
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-12">
                        <label for="">DESCRIPCION:</label>
                        <input class="form-control" type="text" style="text-transform:uppercase;" v-model="descripcionA" @keypress="alphanumeric">
                                           
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-12">
                        <label for="">OBSERVACION:</label>
                        <input class="form-control" type="text" style="text-transform:uppercase;" v-model="observacionA" @keypress="alphanumeric">
                       
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="EditarPublicacion()">Editar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
    data() {
        const today = new Date();
        return {
            personal: [], //Lista del Personal Buscado
            datos: [], //Datos Personales
            representacion: [],
            publicacion:[],
            percod: this.$route.params.codigo, 
            documento:"",
            fecha: new Date(today.getTime()),
            descripcion:"",
            nrodoc: "",
            observacion: "",
            arrayDatosPersonal : [],
            representacioncombo:[],
            representacionC:[], 
            
            /*VALORES PARA EDITAR LA REPRESENTACION*/
            idrepre:"",
            descripcionA:"",
            documentoA:"",
            nrodocA: "",
            fechaA: "",
            observacionA: "",
            
            /*VALORES PARA EDITAR COMBOS */
            idsituacionper: "",
            idrepC: "",
           

             /**
            * Variables paginacion
            */
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
            representacionC : { required },
            documento : { required },
            nrodoc : { required },
            fecha : { required },
            descripcion: { required },
            
    },
    mounted() {
        this.listarPublicacion();
        this.listarDatosPersonalSituacion();
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
        },
    }, 
    methods: {
        
        cambiarPagina(page){
                let me = this;
                me.pagination.current_page = page;
                me.listarPublicacion(page);
            },

        listarPublicacion(page){
            let me = this;
            console.log(me.percod);
            axios
            .post("/listarPublicacion", {
                percodigo: me.percod,
                page: page
            })
            .then(function (response) {
                
                if (response.data.code == "200") {
                    me.publicacion = response.data.datos.data;
                    me.pagination = response.data.pagination;
                } else {
                    me.publicacion = [];
                }

                
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
        listarPublicacionesCombo(){
            let me = this;
            axios
            .get('/listarPublicacionesCombo')
            .then(function (response) {
                
                me.representacioncombo = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            });

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