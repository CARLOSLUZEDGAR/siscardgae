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
                    PREMIOS Y DISTINCIONES
                </h1>&nbsp;
                  
             </div>        
            
            
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
                    <!-- card 1 Busqueda Personal -->
                    <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-search"></i>
                            Seleccionar el tipo de Reporte
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row  d-flex justify-content-center">
                            <div class="col-md-12 row">
                                <div class="form-group col-md-3">
                                    <dt class="st">DESDE <span style="color:red" v-if="!fecha_inicio"> Requerido (*)</span></dt>    
                                    <input type="date" name="fecha_inicio" v-model="fecha_inicio" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <dt class="st">HASTA <span style="color:red" v-if="!fecha_fin"> Requerido (*)</span></dt>
                                    <input type="date" name="fecha_fin" v-model="fecha_fin" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <dt class="st">TIPO DE REPORTE <span style="color:red" v-if="!tipo_reporte"> Requerido (*)</span></dt>
                                    <select class="form-control" name="tipo_reporte" v-model="tipo_reporte" @change="onChangeSelect($event)">
                                        <option disabled value="">SELECCIONE</option>
                                        <option v-for="(option, index) in options" :key="index" :value="option.value">
                                            {{ option.content }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <dt class="st">PROMOCION</dt>
                                    <input type="number" v-model="promocion" :disabled="promociones" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 row">
                                <div class="form-group col-md-3">
                                    <dt class="st">INSTITUCION</dt>
                                    <select class="form-control" v-model="institucion" :disabled="instituciones" v-on:change="changeItem1(rowId, $event)">
                                        <option disabled value="">SELECCIONE</option>
                                        <option v-for="institucion in arrayInstitucion" :key="institucion.id" :value="institucion.id"  v-text="institucion.descripcion"></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <dt class="st">DISTINCION</dt>
                                    <select class="form-control" v-model="distincion" :disabled="distinciones" v-on:change="changeItem2(rowId, $event)">
                                        <option value="" disabled>SELECCIONE</option>
                                        <option v-for="distincion2 in arrayDistincion2" :key="distincion2.id" :value="distincion2.id"  v-text="distincion2.descripcion"></option>                        
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <dt class="st">TIPO DISTINCION</dt>
                                    <select class="form-control" v-model="tipo_distincion" :disabled="tipo_distinciones">
                                        <option value="" disabled>SELECCIONE</option>
                                        <option v-for="distincion3 in arrayDistincion3" :key="distincion3.id" :value="distincion3.id"  v-text="distincion3.descripcion"></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <dt class="st">BUSCAR</dt>
                                    <button class="btn btn-primary" type="subnmit" :disabled="validarfechas" @click="listarPersonal(fecha_inicio,fecha_fin,tipo_reporte,promocion,institucion,distincion,tipo_distincion)">
                                        <i class="fas fa-search"></i>&nbsp; BUSCAR
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                    </div>
                    <!-- card 2 Muestra Datos Personales -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <template v-if="arrayReporteGral.length > 0">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th><center>GRADO Y NOMBRES</center></th>
                                            <th><center>TIPO DISTINCION</center></th>
                                            <th><center>DISTINCION</center></th>
                                            <th><center>NRO. DOC</center></th>
                                            <th><center>TIPO DOC.</center></th>
                                            <th><center>DESCRIPCION</center></th>
                                            <th><center>FECHA</center></th>
                                            <th><center>ESTADO</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="reporteGeneral in arrayReporteGral" :key="reporteGeneral.id">
                                            <td v-text="reporteGeneral.grado+' '+reporteGeneral.estudio+' '+reporteGeneral.nombre+' '+reporteGeneral.paterno+' '+reporteGeneral.materno" ></td>
                                            <td v-text="reporteGeneral.descripcion2"></td> 
                                            <td v-text="reporteGeneral.descripcion3"></td> 
                                            <td v-text="reporteGeneral.nro_doc"></td> 
                                            <td v-text="reporteGeneral.tipo_doc"></td> 
                                            <td v-text="reporteGeneral.descripcion"></td> 
                                            <td >{{reporteGeneral.fecha_distincion | moment("D/MM/YYYY")}}</td>
                                            <td>
                                                <div v-if="reporteGeneral.estado">
                                                    <span class="badge badge-success">Activo</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger">Desactivado</span>
                                                </div>
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
                                
                                <button type="button" @click="ReporteGeneral(fecha_inicio,fecha_fin,tipo_reporte,promocion,institucion,distincion,tipo_distincion)" class="btn btn-secondary">
                                    <i class="fas fa-file-pdf"></i>&nbsp;GENERAR REPORTE
                                </button>
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
        return {
            arrayReporteGral: [], //Lista del Personal Buscado

            // variable para generar reportes
            fecha_inicio: '',
            fecha_fin: '',
            tipo_reporte:'',
            promocion : '',
            institucion : '',
            distincion : '',
            tipo_distincion : '',
            arrayInstitucion : [],
            arrayDistincion2 : [],
            arrayDistincion3 : [],
            rowId : 0,


        //    datfam_profesion : 0,
            options: [
                { content: 'EN GENERAL', value: 'general' },
                { content: 'POR PROMOCION', value: 'promocion' },
                { content: 'POR INSTITUCION', value: 'institucion' },
                { content: 'POR DISTINCION', value: 'distincion' },
                { content: 'POR TIPO DE DISTINCION', value: 'tipo_distincion' },
                { content: 'POR PROMOCION E INSTITUCION', value: 'promo_institucion' },
                { content: 'POR PROMOCION Y DISTINCION', value: 'promo_distincion' },
                { content: 'POR PROMOCION Y TIPO DE DISTINCION', value: 'promo_tipo_distincion' }
            ],
            inputDisabled: true,
            key:'',
            promociones : true,
            instituciones : true,
            distinciones : true,
            tipo_distinciones : true,

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
        this.selectDistincion1();
        this.selectDistincion2(this.distincion1);
        this.selectDistincion3(this.distincion2);     
    },
    computed:{
        validarfechas(){
            if(this.fecha_fin>=this.fecha_inicio && this.fecha_fin!="" && this.fecha_inicio!="" && this.tipo_reporte!="")
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
        }
    },
  
    methods: {
    
        onChangeSelect(e) {
            if (e.target.value == 'general') {
                this.promociones = true;
                this.instituciones = true;
                this.distinciones = true;
                this.tipo_distinciones = true;
            };
            
            if (e.target.value == 'promocion') {
                this.promociones = false;
                this.instituciones = true;
                this.distinciones = true;
                this.tipo_distinciones = true;

            };
            if (e.target.value == 'institucion') {
                this.instituciones = false;
                this.promociones = true;
                this.distinciones = true;
                this.tipo_distinciones = true;
            };
            if (e.target.value == 'distincion') {
                this.promociones = true;
                this.instituciones = false;
                this.distinciones = false;
                this.tipo_distinciones = true;
            };
            if (e.target.value == 'tipo_distincion') {
                this.promociones = true;
                this.instituciones = false;
                this.distinciones = false;
                this.tipo_distinciones = false;
            };
            if (e.target.value == 'promo_institucion') {
                this.promociones = false;
                this.instituciones = false;
                this.distinciones = true;
                this.tipo_distinciones = true;
            };
            if (e.target.value == 'promo_distincion') {
                this.promociones = false;
                this.instituciones = false;
                this.distinciones = false;
                this.tipo_distinciones = true;
            };
            if (e.target.value == 'promo_tipo_distincion') {
                this.promociones = false;
                this.instituciones = false;
                this.distinciones = false;
                this.tipo_distinciones = false;
            };
              
        },

    /*    listarPersonal(page){
            this.$v.$reset(); 
            if(!this.$v.$invalid){
                swal.fire({
                    title: 'Verificó muy bien el tipo de reporte a generar...?', // TITULO 
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
                        .post("/listarTipoReportePremios", {
                        //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                            fecha_inicio: me.fecha_inicio,
                            fecha_fin: me.fecha_fin,
                            tipo_reporte: me.tipo_reporte,
                            promocion: me.promocion,
                            institucion: me.institucion,
                            distincion: me.distincion,
                            tipo_distincion: me.tipo_distincion,
                            page: page
                        })
                        .then(function (response) {
                            
                            if (response.data.code == "200") {
                                me.arrayReporteGral = response.data.datos.data;
                                me.pagination = response.data.pagination;
                            } else {
                                me.Reporte = [];
                            }
                            
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
        },*/

        listarPersonal(page){
            let me = this;
            axios
            .post("/listarTipoReportePremios", {
            //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                fecha_inicio: me.fecha_inicio,
                fecha_fin: me.fecha_fin,
                tipo_reporte: me.tipo_reporte,
                promocion: me.promocion,
                institucion: me.institucion,
                distincion: me.distincion,
                tipo_distincion: me.tipo_distincion,
                page: page
            })
            .then(function (response) {
                
                if (response.data.code == "200") {
                    me.arrayReporteGral = response.data.datos.data;
                    me.pagination = response.data.pagination;
                } else {
                    me.Reporte = [];
                }
                
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
        },

        cambiarPagina(page){
                let me = this;
                me.pagination.current_page = page;
                me.listarPersonal(page);
        },

        selectDistincion1(){
            let me =this;
            var url='/institucion';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayInstitucion = respuesta.institucion; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },

        selectDistincion2(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arrayDestincion2=[];
          //  me.prov_codigo=0;
            var url='/distincion2?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDistincion2 = respuesta.distincion2; 
                
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

        selectDistincion3(depa)
        {
            let me =this;
            me.buscarD= depa;
            me.arrayDistincion3=[];
          //  me.prov_codigo=0;
            var url='/distincion3?buscar=' + depa;
            me.selected = url;
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayDistincion3 = respuesta.distincion3; 
                
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

        changeItem1: function changeItem1(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectDistincion2(event.target.value);
        },

        changeItem2: function changeItem2(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectDistincion3(event.target.value);
        },

        ReporteGeneral(fecha_inicio,fecha_fin,tipo_reporte,promocion,institucion,distincion,tipo_distincion){
            window.open('http://sipefab.fab.bo/ReporteGralPremios?fecha_inicio='+fecha_inicio+'&'+
            'fecha_fin='+fecha_fin+'&'+
            'tipo_reporte='+tipo_reporte+'&'+
            'promocion='+promocion+'&'+
            'institucion='+institucion+'&'+
            'distincion='+distincion+'&'+
            'tipo_distincion='+tipo_distincion
            );
        },

    },
};
</script>

<style>
</style>