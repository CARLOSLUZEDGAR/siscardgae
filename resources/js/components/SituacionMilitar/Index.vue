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
                    SITUACION MILITAR
                </h1>&nbsp;
                
             </div>        
            
            
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Modals & Alerts</li>
            </ol>
            
          </div>
            -->
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
                        
                        <img :src="'/img/personal/'+datos.foto" width="100%" height="100%" class="rounded float-letft img-fluid">
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
                                    <div v-if="$auth.can('insert-sitmil')" class="col-md-4">                                            
                                        <button class="btn btn-primary btn-sm btn-block" @click="NuevaSituacion()">
                                            <i class="fa fa-plus-circle"></i> &nbsp;
                                            Nueva Situación 
                                        </button>
                                        
                                    </div>
                                    <div class="col-md-4">  
                                        <button v-if="$auth.can('report-sitmil')" type="button" @click="ReporteSituacion(datos.codigo)" class="btn btn-sm btn-secondary btn-block">
                                         <i class="far fa-file-pdf"></i>&nbsp;Reporte Personal
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                         <router-link type="button" class="btn-danger btn-sm btn position-reverse btn-block" :to="'/personal'" >
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
                    <!-- card 3 Muestra Datos de Situacion Militar -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <template v-if="situacion.length > 0">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%" class="text-center">OPCIONES</th>
                                            <th style="width: 10%" class="text-center">SITUACION</th>
                                            <th style="width: 15%" class="text-center">SUBSITUACION</th>
                                            <th style="width: 15%" class="text-center">DETALLE SITUACION</th>
                                            <th style="width: 10%" class="text-center">DOCUMENTO</th>
                                            <th style="width:  5%" class="text-center">NRO.DOCUMENTO</th>
                                            <th style="width: 10%" class="text-center">FECHA</th>
                                            <th style="width: 25%" class="text-center">OBSERVACION</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="s in situacion " :key="s.id">
                                            
                                            <td class="text-center">
                                                <!--<button type="button" class="btn btn-success btn-sm" @click="verDatos(p.codigo)">
                                                    <i class="far fa-eye"></i>
                                                </button>-->
                                                <button v-if="$auth.can('edit-sitmil')" type="button" class="btn btn-warning btn-sm" @click="AbrirEditarSituacion(s.codigo)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <template v-if="s.estado != 1">
                                                    <button v-if="$auth.can('delete-sitmil')"  type="button" class="btn btn-danger btn-sm" @click="EliminarSituacionMilitar(s.codigo)">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </template>
                                                
                                            </td>
                                            <td class="text-center">{{s.nombsit}}</td>
                                            <td class="text-center">{{s.nombsub}}</td>
                                            <td class="text-center">{{s.nombdet}}</td>
                                            <td class="text-center">{{s.documento}}</td>
                                            <td class="text-center">{{s.nrodoc}}</td>
                                            <td class="text-center">{{s.fechdoc | moment('DD/MM/YYYY')}}</td>
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
        <div class="modal fade" id="NuevaSituacion">
           <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REGISTRAR NUEVA SITUACION MILITAR</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>{{datos.grado}} {{datos.complemento}} {{datos.nombre}} {{datos.paterno}} {{datos.materno}}</h5>
                <div class="row">
                    <div class="col-4">
                        <label for="">SITUACION:</label>
                        <v-select                            
                            label="nombre"                            
                            :options="situacioncombo"                            
                            v-model="situacionC"
                            @input="listarSubsituacionesCombo"
                            :class="{ 'is-invalid' : $v.situacionC.$error, 'is-valid':!$v.situacionC.$invalid }"
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
                        <span v-if="!$v.situacionC.required">Este campo es Requerido</span>
                        </div>
                    </div>
                     <div class="col-4">
                        <label for="">SUBSITUACION:</label>
                        <v-select
                            
                            label="nombre"                            
                            :options="subsituacioncombo"                            
                            v-model="subsituacionC"
                            @input="listarDetalleSituacionesCombo"
                            :class="{ 'is-invalid' : $v.subsituacionC.$error, 'is-valid':!$v.subsituacionC.$invalid }"
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
                        <span v-if="!$v.subsituacionC.required">Este campo es Requerido</span>
                        </div>
                    </div>
                     <div class="col-4">
                        <label for="">DETALLE SITUACION:</label>
                        <v-select
                            
                            label="nombre"                            
                            :options="detsituacioncombo"                            
                            v-model="detallesituacionC"
                            :class="{ 'is-invalid' : $v.detallesituacionC.$error, 'is-valid':!$v.detallesituacionC.$invalid }"
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
                        <span v-if="!$v.detallesituacionC.required">Este campo es Requerido</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">DOCUMENTO:</label>
                        <br>
                        <select name="documento" id="doc" class="form-control" :class="{ 'is-invalid' : $v.documento.$error, 'is-valid':!$v.documento.$invalid }" v-model="documento" style="text-transform:uppercase">
                            <option value="MEMORANDUM" selected>MEMORANDUM</option>
                            <option value="ORDEN GENERAL DE DESTINOS">ORDEN DE DESTINOS</option>
                            <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                        </select>
                        <div class="invalid-feedback">
                        <span v-if="!$v.documento.required">Este campo es Requerido</span>
                        </div>
                        <!--<input class="form-control" style="text-transform:uppercase;" type="select" v-model="documento">-->
                    </div>
                     <div class="col-4">
                        <!--<label for="">FECHA DOCUMENTO:</label>
                        <input class="form-control" :class="{ 'is-invalid' : $v.fechadoc.$error, 'is-valid':!$v.fechadoc.$invalid }" type="date" v-model="fechadoc">
                        <div class="invalid-feedback">
                        <span v-if="!$v.fechadoc.required">Este campo es Requerido</span>
                        </div>-->
                        <label for="">FECHA DOCUMENTO:</label>
                        <date-picker class="dat" value-type="date" format="DD/MM/YYYY"
                                        v-model="fechadoc"
                                        :disabled-date="fechaactual"  
                                        :class="{ 'is-invalid' : $v.fechadoc.$error, 'is-valid':!$v.fechadoc.$invalid }"                                    
                                    ></date-picker>
                        <div class="invalid-feedback">
                        <span v-if="!$v.fechadoc.required">Este campo es Requerido</span>
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
                    <div class="col-4">
                        <label for="">NRO DOCUMENTO:</label>
                        <input class="form-control" :class="{ 'is-invalid' : $v.nrodoc.$error, 'is-valid':!$v.nrodoc.$invalid }" type="number" min=0 step=1 v-model="nrodoc">
                        <div class="invalid-feedback">
                        <span v-if="!$v.nrodoc.required">Este campo es Requerido</span>
                        </div>
                        <!--<textarea name="textarea" rows="5" cols="30" v-model="direccion"></textarea>-->
                    </div>
                    <div class="col-8">
                        <label for="">OBSERVACION:</label>
                        <input class="form-control" type="text" style="text-transform:uppercase;" v-model="observacion" @keypress="alphanumeric"> 
                        <!--<textarea name="textarea" rows="5" cols="30" v-model="observacion"></textarea>-->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="RegistrarSituacion()">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>

        
        <!-- /.modal-dialog -->
      </div>
        <div class="modal fade" id="EditarSituacionMilitar">
           <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR SITUACION MILITAR</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>{{datos.grado}} {{datos.complemento}} {{datos.nombre}} {{datos.paterno}} {{datos.materno}}</h5>
                <div class="row">
                    <div class="col-4">
                        <label for="">SITUACION:</label>
                        <v-select                            
                            label="nombre"                            
                            :options="situacioncombo"                            
                            v-model="situacionC"
                            @input="listarSubsituacionesCombo"
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
                     <div class="col-4">
                        <label for="">SUBSITUACION:</label>
                        <v-select
                            
                            label="nombre"                            
                            :options="subsituacioncombo"                            
                            v-model="subsituacionC"
                            @input="listarDetalleSituacionesCombo"
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
                     <div class="col-4">
                        <label for="">DETALLE SITUACION:</label>
                        <v-select
                            
                            label="nombre"                            
                            :options="detsituacioncombo"                            
                            v-model="detallesituacionC"
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
                            <option value="MEMORANDUM" selected>MEMORANDUM</option>
                            <option value="ORDEN GENERAL DE DESTINOS">ORDEN DE DESTINOS</option>
                            <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                        </select>
                        <!--<input class="form-control" style="text-transform:uppercase;" type="text" v-model="documentoA">-->
                    </div>
                     <div class="col-4">
                        <label for="">FECHA DOCUMENTO:</label>
                        <input class="form-control" type="date" v-model="fechadocA">
                    </div>
                     <div class="col-4">
                        <label for="">FECHA:</label>
                        <input class="form-control" type="date" v-model="fechaA">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">NRO DOCUMENTO:</label>
                        <input class="form-control" type="text" style="text-transform:uppercase;" v-model="nrodocA">
                        
                    </div>
                    <div class="col-8">
                        <label for="">OBSERVACION:</label>
                        <input class="form-control" type="text" style="text-transform:uppercase;" v-model="observacionA" @keypress="alphanumeric">
                       
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="EditarSituacionMilitar()">Editar</button>
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
            situacion: [],
            percod: this.$route.params.codigo, 
            per_codigo: this.$route.params.codigo,
            situacioncombo:[],
            subsituacioncombo:[],
            detsituacioncombo:[],   
            situacionC:[], 
            subsituacionC:[], 
            detallesituacionC:[],
            documento:"",
            fechadoc: new Date(today.getTime()),
            fecha: new Date(today.getTime()),
            nrodoc: "",
            observacion: "",
            arrayDatosPersonal : [],
            /*VALORES PARA EDITAR LA SITUACION*/
            
            situacioncomboA:[],
            subsituacioncomboA:[],
            detsituacioncomboA:[],   
            situacionCA:[], 
            subsituacionCA:[], 
            detallesituacionCA:[],
            documentoA:"",
            fechadocA: "",
            fechaA: "",
            nrodocA: "",
            observacionA: "",
            
            /*VALORES PARA EDITAR COMBOS */
            idsituacionper: "",
            idsitC: "",
            idsubsitC:"",
            iddetsitC:"",

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
            situacionC : { required },
            subsituacionC : { required },
            detallesituacionC : { required },
            documento : { required },
            fechadoc : { required },
            fecha : { required },
            nrodoc : { required }
    },

    mounted() {
        this.listarSituacion();
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
                me.listarSituacion(page);
            },

        listarSituacion(page){
            let me = this;
            console.log(me.percod);
            axios
            .post("/listarSituacion", {
                percodigo: me.percod,
                page: page
            })
            .then(function (response) {
                
                if (response.data.code == "200") {
                    me.situacion = response.data.datos.data;
                    me.pagination = response.data.pagination;
                } else {
                    me.situacion = [];
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
        listarSituacionesCombo(){
            let me = this;
            axios
            .get('/listarSituacionesCombo')
            .then(function (response) {
                
                me.situacioncombo = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            });

        },

        listarSubsituacionesCombo(){
            try {
                let me = this;
                me.subsituacionC=[];
                me.detallesituacionC=[];
                axios
                .post("/listarSubsituacionesCombo", {
                    id: me.situacionC.id
                })
                .then(function (response) {
                    
                me.subsituacioncombo=response.data; 
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            } catch (error) {
                this.subsituacioncombo=[];
                this.detsituacioncombo=[];
            }
            
        },
        listarDetalleSituacionesCombo(){
            try {
                let me = this;
                me.detallesituacionC=[];
                axios
                .post("/listarDetalleSituacionesCombo", {
                    id: me.subsituacionC.id
                })
                .then(function (response) {
                    
                me.detsituacioncombo=response.data; 
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            } catch (error) {
                this.detsituacioncombo=[];
            }
            
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

        NuevaSituacion(){
            this.listarSituacionesCombo();
            $('#NuevaSituacion').modal('show');
            $(".modal-header").css("background-color", "#007bff"); 
            $(".modal-header").css("color", "white" ); 
        },

        
        RegistrarSituacion(){
                        this.$v.$reset();
            if(!this.$v.$invalid){
            swal.fire({
                title: '¿Desea guardar la nueva situacion militar?', // TITULO 
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
                    .post("/registrarSituacion", {
                        percodigo: me.percod,
                        situacion: me.situacionC.id,
                        subsituacion: me.subsituacionC.id,
                        detsituacion: me.detallesituacionC.id,
                        documento: me.documento.toUpperCase(),
                        fechadoc: me.fechadoc,
                        fecha: me.fecha,
                        nrodoc: me.nrodoc,
                        observacion: me.observacion.toUpperCase()
                    })
                    .then(function (response) {
                        
                        me.listarSituacion();
                        me.listarDatosPersonalSituacion();
                        $('#NuevaSituacion').modal('hide');
                        swal.fire(
                            "Aceptado", //TITULO
                            "Se añadio correctamente la nueva Situacion Militar.", //TEXTO DE MENSAJE
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
                        "No se realizo el registro de la nueva Situación Militar.", //TEXTO DE MENSAJE
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
        
        
        AbrirEditarSituacion(s){
            let me = this;
            me.idsituacionper = s;
            axios
            .post("/listarSituacionModificar", {
                sitpercod: s
            })
            .then(function (response) {
                
                
                me.situacionC = response.data.nombsit;
                me.idsitC = response.data.sit_cod;
                me.idsubsitC = response.data.subsit_cod;
                me.iddetsitC = response.data.detsit_cod;
                me.subsituacionC = response.data.nombsub;
                me.detallesituacionC = response.data.nombdet;
                me.documentoA = response.data.documento;
                me.fechadocA = response.data.fechdoc;
                me.fechaA = response.data.fecha;
                me.nrodocA = response.data.nrodoc;
                me.observacionA = response.data.observacion
                me.listarSituacionesCombo();
                $('#EditarSituacionMilitar').modal('show')
                $(".modal-header").css("background-color", "#007bff"); 
                $(".modal-header").css("color", "white" );
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })    
           
            },

        
        EditarSituacionMilitar(){
            swal.fire({
                title: '¿Desea realizar la modificación de la Situación Militar ?', // TITULO 
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
                    if (me.situacionC.id) {
                        var sit = me.situacionC.id;
                    } else {
                        var sit =  me.idsitC;
                    }
                    if (me.subsituacionC.id) {
                        var subsit = me.subsituacionC.id;
                    } else {
                        var subsit =  me.idsubsitC;
                    }
                    if (me.detallesituacionC.id) {
                        var detsit = me.detallesituacionC.id;
                    } else {
                        var detsit =  me.iddetsitC;
                    }
                    
                    axios
                    .post("/EditarSituacionMilitar", {
                        idsit: me.idsituacionper,
                        situacion: sit,
                        subsituacion: subsit,
                        detsituacion: detsit,
                        documento: me.documentoA.toUpperCase(),
                        fechadoc: me.fechadocA,
                        fecha: me.fechaA,
                        nrodoc: me.nrodocA,
                        observacion: me.observacionA.toUpperCase()
                    })
                    .then(function (response) {
                        
                        $('#EditarSituacionMilitar').modal('hide');
                        swal.fire(
                            "Aceptado", //TITULO
                            "Se modificó correctamente la Situacion Militar.", //TEXTO DE MENSAJE
                            "success" // TIPO DE MODAL (success, warnning, error, info)
                        )
                        me.listarSituacion();
                        me.listarDatosPersonalSituacion();
                        
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })   
                        }else{
                            swal.fire(
                            "Anulado", //TITULO
                            "No se realizo la actualización de la Situacion Militar.", //TEXTO DE MENSAJE
                            "info" // TIPO DE MODAL (success, warnning, error, info)
                            );
                        }
                    })
            
        },

        EliminarSituacionMilitar(codigo){
            swal.fire({
                title: '¿Desea realizar la eliminación de la Situación Militar ?', // TITULO 
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
                    .post("/EliminarSituacionMilitar", {
                        idsit: codigo
                        
                    })
                    .then(function (response) {
                        
                       
                        swal.fire(
                            "Aceptado", //TITULO
                            "Se eliminó correctamente la Situacion Militar.", //TEXTO DE MENSAJE
                            "success" // TIPO DE MODAL (success, warnning, error, info)
                        )
                        me.listarSituacion();
                        me.listarDatosPersonalSituacion();
                        
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })   
                        }else{
                            swal.fire(
                            "Anulado", //TITULO
                            "No se realizo la eliminación de la Situacion Militar.", //TEXTO DE MENSAJE
                            "info" // TIPO DE MODAL (success, warnning, error, info)
                            );
                        }
                    })
            
        },
        
        ReporteSituacion(codigo){
            window.open('http://sipefab.fab.bo/SituacionesPdf?per_codigo='+codigo);
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
            console.log($event.keyCode); //keyCodes value
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && (keyCode < 48 || keyCode > 57) && keyCode !== 45 && keyCode !== 32) { // 46 is dot
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