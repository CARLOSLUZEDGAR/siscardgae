<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              FIRMAS ORDEN GENERAL DE DESTINOS
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Firmas</li>
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
                <h3 class="card-title">
                  <i class="fas fa-globe-americas"></i>
                  <strong>FIRMAS</strong>
                </h3>
              </div>
              <div class="card-body">
                    <div class="row  d-flex justify-content-center">   
                        <div class="col-md-6 row">
                            <div class="form-group col-md-3">
                                <label> Gestión</label>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control" v-model="gestion" :class="{ 'is-invalid' : $v.gestion.$error, 'is-valid':!$v.gestion.$invalid }"> 
                                <div class="invalid-feedback">
                                    <span v-if="!$v.gestion.required">Este campo es Requerido</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- @click="selectEspeGrado()" -->
                    <div class="form-group row">
                        <div class="col-md-12 d-flex align-items-center">
                            <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                              <div class="row p-2 bd-highlight">
                                <div class="col-md-6">
                                  <dl>
                                    <label class="form-control-label col-md-12" for="text-input">DATOS CMDTE. GRAL. FAB.:</label>
                                    <input type="text" v-model="cmdteFAB" class="form-control col-md-12" :class="{ 'is-invalid' : $v.cmdteFAB.$error, 'is-valid':!$v.cmdteFAB.$invalid }" placeholder="GRADO, NOMBRE COMPLETO CMDTE">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.cmdteFAB.required">Este campo es Requerido</span>
                                    </div>
                                    <select v-model="cargoCmdteFAB" class="form-control col-md-12" :class="{ 'is-invalid' : $v.cargoCmdteFAB.$error, 'is-valid':!$v.cargoCmdteFAB.$invalid }">
                                      <option value="" disabled>SELECCIONE CARGO</option>
                                      <option value="1">COMANDANTE GENERAL DE LA FUERZA AÉREA</option>
                                      <option value="2">COMANDANTE GENERAL ACC. DE LA FUERZA AÉREA</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.cargoCmdteFAB.required">Este campo es Requerido</span>
                                    </div>
                                  </dl>
                                </div>
                                <div class="col-md-6">
                                  <dl>
                                    <label class="form-control-label col-md-12" for="text-input">DATOS CMDTE. JEFE. FF.AA.:</label>
                                    <input type="text" v-model="cmdteFFAA" class="form-control col-md-12" :class="{ 'is-invalid' : $v.cmdteFFAA.$error, 'is-valid':!$v.cmdteFFAA.$invalid }"  placeholder="GRADO, NOMBRE COMPLETO CMDTE">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.cmdteFFAA.required">Este campo es Requerido</span>
                                    </div>
                                    <select v-model="cargoCmdteFFAA" class="form-control col-md-12" :class="{ 'is-invalid' : $v.cargoCmdteFFAA.$error, 'is-valid':!$v.cargoCmdteFFAA.$invalid }">
                                      <option value="" disabled>SELECCIONE CARGO</option>
                                      <option value="1">COMANDANTE EN JEFE DE LAS FF.AA. DEL ESTADO</option>
                                      <option value="2">COMANDANTE EN JEFE ACC. DE LAS FF.AA. DEL ESTADO</option>
                                    </select>
                                     <div class="invalid-feedback">
                                        <span v-if="!$v.cargoCmdteFFAA.required">Este campo es Requerido</span>
                                    </div>
                                  </dl>
                                </div>
                              </div>
                              <div class="row p-2 bd-highlight">
                                <div class="col-md-6">
                                  <dl>
                                    <label class="form-control-label col-md-12" for="text-input">MINISTRO DE DEFENSA:</label>
                                    <input type="text" v-model="minDEF" class="form-control col-md-12" :class="{ 'is-invalid' : $v.minDEF.$error, 'is-valid':!$v.minDEF.$invalid }" placeholder="NOMBRE COMPLETO MINISTRO DEFENSA">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.minDEF.required">Este campo es Requerido</span>
                                    </div>
                                  </dl>
                                </div>
                                <div class="col-md-6">
                                  <dl>
                                    <label class="form-control-label col-md-12" for="text-input">PRESIDENTE:</label>
                                    <input type="text" v-model="presidente" class="form-control col-md-12" :class="{ 'is-invalid' : $v.presidente.$error, 'is-valid':!$v.presidente.$invalid }" placeholder="NOMBRE COMPLETO PRESIDENTE">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.presidente.required">Este campo es Requerido</span>
                                    </div>
                                  </dl>
                                </div>
                              </div>
                            </div>
                        </div>        
                    </div>

                <div class="row p-2 bd-highlight justify-content-center">
                    
                        <div class="col-md-4">
                        <button type="button" class="btn btn-secondary btn-sm btn-block" @click="ordenDestinos(cmdteFAB,cmdteFFAA,minDEF,presidente,cargoCmdteFAB,cargoCmdteFFAA,gestion)">
                            <i class="far fa-file-alt" aria-hidden="true">  Generar OGD</i>
                        </button>
                        </div> 
                   
                    <div class="col-md-4">
                    <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras()">
                        <i class="fas fa-reply" aria-hidden="true">  Atras</i>
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
            cmdteFAB : '',
            cmdteFFAA : '',
            minDEF : '',
            presidente : '',
            cargoCmdteFAB : '',
            cargoCmdteFFAA : '',
            gestion : ''
        }
    },

    validations:{
        cmdteFAB : { required },
        cmdteFFAA : { required },
        minDEF : { required },
        presidente : { required },
        cargoCmdteFAB : { required },
        cargoCmdteFFAA : { required },
        gestion : { required}
    },

    mounted() {
        //this.ver();
        // this.listarPerPromo(this.page,this.promocion,this.especialidad,this.subespecialidad);
        // this.datosPersonal(this.per_codigo);
    },
    computed:{
            // isActived: function(){
            //     return this.pagination.current_page;
            // },

            // //Calcuar los elementos de la paginacion
            // pagesNumber: function() {
            //     if(!this.pagination.to){
            //         return [];
            //     }

            //     var from = this.pagination.current_page - this.offset;
            //     if(from < 1){
            //         from = 1;
            //     }

            //     var to = from + (this.offset *2);
            //     if( to >= this.pagination.last_page){
            //         to = this.pagination.last_page;
            //     }

            //     var pagesArray = [];
            //     while( from <= to){
            //         pagesArray.push(from);
            //         from ++;
            //     }
            //     return pagesArray;
            // }
        },
    methods: {
        ver(){
            //console.log(this.per_codigo);
            //console.log(this.personal_destinos)
        },

        Atras(){
            this.$router.push({
                name: "ListarPersonalDestinos",
                //ENVIO DE DATOS
                // params:{
                //     d: datos
                // }   
            });
            this.reset()
        },

        reset(){
            let me = this;
            me.cmdteFAB = '';
            me.cmdteFFAA = '';
            me.minDEF = '';
            me.presidente = '';
            me.cargoCmdteFAB = '';
            me.cargoCmdteFFAA = '';
            me.gestion = '';
            // me.entidad = 0;
            // me.gran_unidad = 0;
            // me.reparticion = 0;
        },

        ordenDestinos(cmdteFAB,cmdteFFAA,minDEF,presidente,cargoCmdteFAB,cargoCmdteFFAA,gestion){
          this.$v.$reset()
          if(!this.$v.$invalid){
          // window.open('http://192.168.3.77/ordenDestinos');
          // window.open('http://127.0.0.1/ordenDestinos');
          window.open('http://sipefab.fab.bo/ordenDestinos?cmdtefab='+cmdteFAB+'&cmdteffaa='+cmdteFFAA+'&mindef='+minDEF+'&presidente='+presidente+'&cargoCmdteFAB='+cargoCmdteFAB+'&cargoCmdteFFAA='+cargoCmdteFFAA+'&gestion='+gestion);
          // window.open('http://127.0.0.1:8000/ordenDestinos?cmdtefab='+cmdteFAB+'&cmdteffaa='+cmdteFFAA+'&mindef='+minDEF+'&presidente='+presidente+'&cargoCmdteFAB='+cargoCmdteFAB+'&cargoCmdteFFAA='+cargoCmdteFFAA);
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
    },
}
</script>
