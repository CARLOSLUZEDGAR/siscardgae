<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
                <i class="far fa-bookmark"></i>
                Certificado de Destinos Frontera

                </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Reporte Certificado Frontera</li>
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
                        <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <img v-bind:src="'/destinosPersonal/../img/personal/'+arrayDatosPersonal.per_foto" class="rounded float-left img-fluid" width="150" height="150">
                                        </div>
                                        <div class="col-md-10 d-flex align-items-center">
                                            <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                                <!-- FILA 1 -->
                                                <div class="row p-2 bd-highlight">
                                                    <div class="col-md-6">
                                                        <dl>
                                                            <dt class="st">GRADOS Y NOMBRES</dt>
                                                            <dd class="st">{{arrayDatosPersonal.gra_abreviatura}}{{arrayDatosPersonal.estu_abreviatura}} {{arrayDatosPersonal.per_nombre}} {{arrayDatosPersonal.per_paterno}} {{arrayDatosPersonal.per_materno}}</dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <dl>
                                                            <dt class="st">CARNET MILITAR</dt>
                                                            <dd class="st">{{arrayDatosPersonal.per_cm}}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <!-- FILA 2 -->
                                                <div class="row p-2 bd-highlight">
                                                    <div class="col-md-6">
                                                        <dl>
                                                            <dt class="st">CARNET DE IDENTIDAD</dt>
                                                            <dd class="st">{{arrayDatosPersonal.per_ci}} {{arrayDatosPersonal.per_expedido}}</dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <dl>
                                                            <dt class="st">DESTINO ACTUAL</dt>
                                                            <dd class="st">{{arrayDatosPersonal.nomd3}} - {{arrayDatosPersonal.nomd4}}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <!-- FILA 3 -->
                                            </div>
                                        </div>
                                    </div>                                                           
                                </div>
                            <!-- /.card -->
                        </div>

            <div class="card card-primary card-outline">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 d-flex align-items-center">
                        <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                
                            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                              <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th><center>Fecha Destino</center></th>
                                        <th><center>Destino en Frontera</center></th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="destinosFrontera in arrayDestinosFrontera" :key="destinosFrontera.id">
                                        <!-- moment("D/MM/YYYY") cambiar formato de fecha -->
                                        <td ><center>{{destinosFrontera.fechadestino | moment("D/MM/YYYY")}}</center></td>
                                        <td>{{destinosFrontera.desc_dn2}}&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;{{destinosFrontera.desc_dn3}}</td>
                                    </tr>
                                </tbody>
                              </table>
                            </div>

                            <div class="row p-2 bd-highlight">
                              <nav>
                                  <!-- inicio para paginacion -->
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
                                  <!-- fin paginacion -->
                              </nav>
                          </div>
                            <div class="row p-2 bd-highlight">                        
                              <div class="col-md-6">
                                    <label class="form-control-label" for="text-input">Nro. Documento:</label>
                                    <input type="text" v-model="nro_doc" class="form-control" :class="{ 'is-invalid' : $v.nro_doc.$error, 'is-valid':!$v.nro_doc.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.nro_doc.required">Este campo es Requerido</span>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <label class="form-control-label" for="text-input">Rubrica:</label>
                                    <input type="text" v-model="rubrica" class="form-control" :class="{ 'is-invalid' : $v.rubrica.$error, 'is-valid':!$v.rubrica.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.rubrica.required">Este campo es Requerido</span>
                                    </div>
                              </div>
                            </div>
                            <div class="row p-2 bd-highlight">                        
                                <div class="col-md-12">
                                    <label class="form-control-label" for="text-input">Nota:</label>
                                    <textarea name="textarea" class="form-control" rows="3" v-model="notaFront" placeholder="SIN OBSERVACIONES"></textarea>
                                </div>
                            </div>
                            <div class="row p-2 bd-highlight justify-content-center">
                                <div class="col-md-4"> 
                                    <button v-if="$auth.can('report-certdestfront')" type="button" class="btn btn-secondary btn-sm btn-block" @click="CertDestFront(per_codigo,notaFront,nro_doc,rubrica)">
                                        <i class="far fa-file-alt" aria-hidden="true">  Generar Reporte</i>
                                    </button> &nbsp;
                                </div>
                                <div class="col-md-4"> 
                                    <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras(per_codigo)">
                                        <i class="fas fa-reply" aria-hidden="true">  Volver Atras</i>
                                    </button> &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
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
      
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
//import { required, minLength, between } from 'vuelidate/lib/validators'
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.d,
            arrayPersonalDestinos : [],
            arrayPersonalDestinos2 : [],
            arrayDatosPersonal : [],
            arraySitPersonal : [],
            arrayDestinosFrontera : [],
            notaFront : '',
            nro_doc : '',
            rubrica : '',
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
        
            nro_doc : { required },
            rubrica : { required },
    },

    mounted() {
        //this.ver();
        this.listarPersonalDestinos(this.per_codigo);
        this.datosPersonal(this.per_codigo);
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
            }
        },
    methods: {
        ver(){
            //console.log(this.per_codigo);
            //console.log(this.personal_destinos)
        },

        listarPersonalDestinos(per_codigo,page){
            let me = this;
            axios
          .post("/listarPersonalDestinos", {
            per_codigo : per_codigo,
            page:page
            
          })
          .then(function (response) {
            
          //  me.arrayPersonalDestinos = response.data.cargo1.data
          //  me.arrayPersonalDestinos2 = response.data.cargo2
          me.arrayDestinosFrontera = response.data.frontera
           me.pagination = response.data.pagination
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        datosPersonal(per_codigo){
            let me = this;
            axios
          .post("/datosPersonal", {
            per_codigo : per_codigo,
          })
          .then(function (response) {
            
            me.arrayDatosPersonal = response.data.personal_datos
            me.arraySitPersonal = response.data.personal_only_sit
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        cambiarPagina(page){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPersonalDestinos(me.per_codigo,page);
        },

        Atras(datos){
            this.$router.push({
                name: "DestinosPersonal",
                //ENVIO DE DATOS
                params:{
                    d: datos
                }
                
            });
        },

        CertDestFront(per_codigo,notaFront,nro_doc,rubrica){
        this.$v.$reset();
        if(!this.$v.$invalid){
          window.open('http://sipefab.fab.bo/certificadoDestFrontera?per_codigo='+per_codigo+'&notaFront='+notaFront+'&nro_doc='+nro_doc+'&rubrica='+rubrica);
        // window.open('http://127.0.0.1:8000/certificadoDestFrontera?per_codigo='+per_codigo+'&notaFront='+notaFront+'&nro_doc='+nro_doc+'&rubrica='+rubrica);

          }else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
                
            }
        },
    },
}
</script>
