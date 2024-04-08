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
                    PERSONAL
                    </h1>
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
                                        <input type="text" class="form-control" placeholder="Ingrese dato requerido" style="text-transform:uppercase;" v-model="buscar" @keyup.enter="listarPersonal(1,buscar,criterio)">
                                        <button class="btn btn-primary" type="subnmit" @click="listarPersonal(1,buscar,criterio)">
                                            <i class="fas fa-search"></i>&nbsp; BUSCAR
                                        </button>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="input-group">
                                    <button class="btn btn-primary" type="subnmit" @click="ModalRepoortePromo()">
                                        <i class="far fa-file-pdf"></i>&nbsp; REPORTE POR PROMOCIÓN
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                    </div>
                    <!-- card 2 Muestra Datos Personales -->
                    <div class="card card-primary card-outline">
                        <div class="card-body table-wrapper-scroll-y my-custom-scrollbar" style="font-size: 13px;">
                            <template v-if="personal.length > 0">
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
                                        <tr v-for="p in personal">
                                            <td>{{p.grado}} {{p.complemento}}</td>
                                            <td> {{p.paterno}} </td>
                                            <td> {{p.materno}}</td>
                                            <td> {{p.nombre}} </td>
                                            <td class="text-center">{{p.ci}} {{p.expedido}}</td>
                                            <td class="text-center">{{p.cm}}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm" @click="RegistroFalta(p.codigo)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                </table> 
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
    </section>
    <!-- /.content -->

    <!-- Modal Nuevo Usuario -->
        <div class="modal fade" id="ReporteProm">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">REPORTE DE FALTAS DISCIPLINARIAS POR PROMOCIÓN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">5 PRIMEROS DIGITOS DEL CARNET MILITAR:</label>
                            <input type="text" @keypress="onlyNumber" :class="{ 'is-invalid' : $v.cm.$error, 'is-valid':!$v.cm.$invalid }"  v-model="cm" class="form-control" style="text-transform:uppercase;" >
                            <div class="invalid-feedback">
                                <span v-if="!$v.cm.required">Este campo es Requerido</span>                                    
                                <span v-if="!$v.cm.maxLength">Este campo permite solo 5 caracteres.</span>
                                <span v-if="!$v.cm.minLength">Este campo permite solo 5 caracteres.</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="">FECHA INICIO:</label>
                            <input class="form-control" type="date" :class="{ 'is-invalid' : $v.fechaini.$error, 'is-valid':!$v.fechaini.$invalid }" v-model="fechaini">
                            <div class="invalid-feedback">
                                    <span v-if="!$v.fechaini.required">Este campo es Requerido</span>
                                </div>
                        </div>
                        <div class="col-6">
                            <label for="">FECHA FIN:</label>
                            <input class="form-control" type="date" :class="{ 'is-invalid' : $v.fechafin.$error, 'is-valid':!$v.fechafin.$invalid }" v-model="fechafin">
                            <div class="invalid-feedback">
                                    <span v-if="!$v.fechafin.required">Este campo es Requerido</span>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="ReportePromocion()">Generar Reporte</button>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
  </div>
</template>

<script>
import { required, maxLength,minLength, between } from 'vuelidate/lib/validators'
export default {
    data() {
        return {
            personal: [], //Lista del Personal Buscado
            buscar: "",
            criterio: "p.per_cm",
            datos: [], //Datos Personales
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
            code: "",
            /**
             * variables para reporte
             */
            cm: '',
            fechaini: '',
            fechafin: ''
        }
    },
    validations: {
        cm: {required, maxLength: maxLength(5), minLength: minLength(5)},
        fechaini: {required},
        fechafin: {required},
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
    mounted() {
        
    },
    methods: {
        cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listarPersonal(page,buscar,criterio);
        },
        listarPersonal(page,buscar,criterio){
            let me = this;
            axios
            .post("/listarPersonal", {
                buscar: buscar.toUpperCase(),
                criterio: criterio,
                page: page
            })
            .then(function (response) {
                
                if (response.data.code == "200") {
                    me.personal = response.data.datos.data;
                    me.pagination = response.data.pagination;
                } else {
                    me.personal = [];
                }
                
                
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        /**
         * Rederigir para registrar Nueva Falta
         */
        RegistroFalta(per_codigo){
            this.$router.push({
                name: "ListaFaltas",
            //ENVIO DE DATOS POR URL
                params:{
                    codigo: per_codigo,
                    c: 1,
                    u: 0,
                    e: 0,
                    fu: 0
                }
            });
        },

        ModalRepoortePromo(){
            $('#ReporteProm').modal('show');
        },
        ReportePromocion(){

            
            
            this.$v.$reset()
            if (!this.$v.$invalid) {
                var cm = this.cm
                var fi = this.fechaini
                var ff= this.fechafin
                if (this.fechaini <= this.fechafin) {
                    window.open('http://sipefab.fab.bo/reporteDemProm?cm='+cm+'&fechainicio='+fi+'&fechafin='+ff, '_blank');
                    // window.open('http://sipefabv1.test/reporteDemProm?cm='+cm+'&fechainicio='+fi+'&fechafin='+ff, '_blank');
                } else {
                    this.$v.$touch();
                    Swal.fire({
                        icon: 'warning',
                        title: 'La fecha inicial debe ser menor que la fecha final.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
                

            } else {
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
            }


            

        },
        onlyNumber ($event) { //SOLO NUMEROS
            //console.log($event.keyCode); //keyCodes value
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 48 || keyCode > 57)) { // 46 is dot
                $event.preventDefault();
            }
        },
        
    }
};
</script>

<style>
</style>

