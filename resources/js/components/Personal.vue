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
                   SITUACION MILITAR DEL PERSONAL
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

                      <!-- card 1 Reporte por fechas -->
                    <div v-if="$auth.can('report-rangfechsitmil')" class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="far fa-file-pdf"></i>
                        REPORTES
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row  d-flex justify-content-left">
                            <div class="col-md-8 ">
                                    
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
                    
                    <div class="col-4">
                        <label for="">FECHA INICIO:</label>
                        <input class="form-control" type="date" v-model="fechaini">
                    </div>
                    <div class="col-4">
                        <label for="">FECHA FIN:</label>
                        <input class="form-control" type="date" v-model="fechafin">
                    </div>
                    <div class="col-md-4">  
                        <label for="">.</label>
                       
                        <button type="button" @click="ReporteSituacion()" :disabled="validarfechas" class="btn btn-secondary btn-block">
                        <i class="far fa-file-pdf"></i>&nbsp;Reporte Grupal
                        </button>
                    </div>
                </div>

                            </div>
                        </div>
                        


                    </div>
                    <!-- /.card -->
                    </div>

                    <!-- card 1 Busqueda Personal -->
                    <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-search"></i>
                        BUSCAR PERSONAL
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row  d-flex justify-content-left">
                            <div class="col-md-8 ">
                                    <div class="input-group">
                                            <select class="form-control col-md-4" v-model="criterio">
                                                <option value="p.per_nombre">Nombre</option>
                                                <option value="p.per_paterno">Ap. Paterno</option>
                                                <option value="p.per_materno">Ap. Materno</option>
                                                <option value="p.per_cm">Carnet Militar</option>
                                                <option value="p.per_ci">C. de Identidad</option>                                              
                                                
                                            </select>
                                            <input type="text" class="form-control" placeholder="Ingrese dato requerido" style="text-transform:uppercase;" v-model="buscar" @keyup="BuscarPersona()">
                                            <!-- <button class="btn btn-primary" type="subnmit" @click="listarPersonal(buscar,criterio,1)">
                                                <i class="fas fa-search"></i>&nbsp; Buscar
                                            </button> -->
                                    </div>

                                </div>
                        </div>
                        


                    </div>
                    <!-- /.card -->
                    </div>
                    <!-- card 2 Muestra Datos Personales -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Grado</th>
                                            <th class="text-center">Ap. Paterno</th>
                                            <th class="text-center">Ap. Materno</th>
                                            <th class="text-center">Nombres</th>
                                            <th class="text-center">C. Identidad</th>
                                            <th class="text-center">C. Militar</th>
                                            <th class="text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="p in listaPersonal">
                                            
                                            <td>{{p.grado}} {{p.complemento}}</td>
                                            <td> {{p.paterno}} </td>
                                            <td> {{p.materno}}</td>
                                            <td> {{p.nombre}} </td>
                                            <td class="text-center">{{p.ci}}</td>
                                            <td class="text-center">{{p.cm}}</td>
                                            <td class="text-center">
                                                <!--<button type="button" class="btn btn-success btn-sm" @click="verDatos(p.codigo)">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm" @click="AbrirEditar(p)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-info btn-sm" @click="listarSituacion(p.codigo)">
                                                    <i class="fas fa-search"></i>
                                                </button>-->
                                                <button type="button" class="btn btn-success btn-sm" @click="VerSituacionMilitar(p.per_codigo)">
                                                                           
                                                    <i class="fas fa-eye"></i>
                                                 </button>   
                                            </td>
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
        <div class="modal fade" id="NuevoPersonal">
           <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REGISTRAR NUEVO PERSONAL</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label for="">NOMBRE:</label>
                        <input class="form-control" type="text" v-model="nombre">
                    </div>
                     <div class="col-4">
                        <label for="">PATERNO:</label>
                        <input class="form-control" type="text" v-model="paterno">
                    </div>
                     <div class="col-4">
                        <label for="">MATERNO:</label>
                        <input class="form-control" type="text" v-model="materno">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">CI:</label>
                        <input class="form-control" type="text" v-model="ci">
                    </div>
                     <div class="col-4">
                        <label for="">CM:</label>
                        <input class="form-control" type="text" v-model="cm">
                    </div>
                     <div class="col-4">
                        <label for="">RELIGION:</label>
                        <input class="form-control" type="text" v-model="religion">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">DIRECCION:</label>
                        <textarea name="textarea" rows="5" cols="30" v-model="direccion"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" @click="RegistrarPersonal()">REGISTRAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>

        
        <!-- /.modal-dialog -->
      </div>


        <div class="modal fade" id="EditarPersonal">
           <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR PERSONAL</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label for="">NOMBRE:</label>
                        <input class="form-control" type="text" v-model="nombreA">
                    </div>
                     <div class="col-4">
                        <label for="">PATERNO:</label>
                        <input class="form-control" type="text" v-model="paternoA">
                    </div>
                     <div class="col-4">
                        <label for="">MATERNO:</label>
                        <input class="form-control" type="text" v-model="maternoA">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">CI:</label>
                        <input class="form-control" type="text" v-model="ciA">
                    </div>
                     <div class="col-4">
                        <label for="">CM:</label>
                        <input class="form-control" type="text" v-model="cmA">
                    </div>
                     <div class="col-4">
                        <label for="">RELIGION:</label>
                        <input class="form-control" type="text" v-model="religionA">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">DIRECCION:</label>
                        <textarea name="textarea" rows="5" cols="30" v-model="direccionA"></textarea>
                    </div>
                </div>
                <input type="text" hidden v-model="percodigo">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" @click="EditarPersonal()">MODIFICAR</button>
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
export default {
    data() {
        return {
            personal: [], //Lista del Personal Buscado
            listaPersonal: [],
            criterio: "p.per_cm",
            buscar:"",
            setTiemoutBuscador: '',
            datos: [], //Datos Personales
            situacion: [],
            situacioncombo:[],
            subsituacioncombo:[],
            detsituacioncombo:[],   
            situacionC:[], 
            subsituacionC:[], 
            detallesituacionC:[],

            /*VALORES PARA GUARDAR PERSONAL*/
            nombre: "",
            paterno: "",
            materno: "",
            ci: "",
            cm: "",
            religion: "",
            direccion: "",

              /*VALORES PARA EDITAR PERSONAL*/
            nombreA: "",
            paternoA: "",
            maternoA: "",
            ciA: "",
            cmA: "",
            religionA: "",
            direccionA: "",
            percodigo:"",
            fechaini:"",
            fechafin:"",
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
    mounted() {
        this.listarSituacionesCombo()
        this.ListarPersonal(1);
    },
    computed:{
        validarfechas(){
            if(this.fechafin>=this.fechaini && this.fechafin!="" && this.fechaini!="" && this.situacionC!="" && this.subsituacionC!="" && this.detallesituacionC!="")
            {
               
                return false;
            }
            else
            {
                
                return true;
            }
        },

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
                me.ListarPersonal(page);
            },
       

        ListarPersonal(page){
            let me = this;
            axios
            .post("/listadorPersonal", {
                page: page,
                buscar: me.buscar.toUpperCase(),
                criterio: me.criterio,
            })
            .then(function (response) {
                me.listaPersonal = response.data.personal.data;
                me.pagination =response.data.pagination
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        BuscarPersona(){
            clearTimeout(this.setTiemoutBuscador);
            this.setTiemoutBuscador = setTimeout(() => {
                this.ListarPersonal(1)
            }, 360)
        },
        VerSituacionMilitar(dato){
            this.$router.push({
            name: "SituacionMilitarIndex",
            //ENVIO DE DATOS POR URL
            params:{
            codigo: dato
            }
            });
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
       
        ReporteSituacion(){
            var iddet=this.detallesituacionC.id;
            var nombdet = this.detallesituacionC.nombre
            var fini = this.fechaini
            var ffin= this.fechafin
            window.open('http://sipefab.fab.bo/SituacionesFechaPdf?detcodigo='+iddet+'&detnomb='+nombdet+'&fechainicio='+fini+'&fechafin='+ffin, '_blank');
        },
        

        
    },
};
</script>

<style>
</style>