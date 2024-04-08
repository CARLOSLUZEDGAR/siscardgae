<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              Reportes Profesion del Personal
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Reportes</li>
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
                    Reportes
                  </h3>
              </div>
              <div class="card-body">
                <div class="row  d-flex justify-content-center"> <!-- Para centrear se pone estos codigos -->
                  <div class="col-md-12">
                    <div class="form-group row">
                      <div class="col-md-3 ">
                          <dt class="st">Reporte</dt>
                          <select class="form-control" name="tipo_reporte" v-model="tipo_reporte" @change="onChangeSelect($event)" @click="reset()">
                              <option disabled value="">SELECCIONE</option>
                              <option v-for="(option, index) in options" :key="index" :value="option.value">
                                  {{ option.content }}
                              </option>
                          </select>
                      </div>
                      <div class="col-md-3">
                        <dt class="st">Promoción</dt>
                          <input type="number" v-model="promocion" :disabled="promociones" class="form-control" placeholder="INSERTAR 5 PRIMEROS DIGITOS DEL CM" style="text-transform:uppercase">                                         
                      </div>
                      <div class="col-md-3">
                          <dt class="st">Grado</dt>
                          <select class="form-control" v-model="grado" :disabled="grad" @click="selectEspeGrado()" >
                            <option value="0" disabled>SELECCIONE</option>
                            <option v-for="grados in arrayGrados" :key="grados.id" :value="grados.id"  v-text="grados.nombre"></option>
                          </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-4">
                          <dt class="st">Grado Academico</dt>
                          <select class="form-control" v-model="gradoAcademico" :disabled="gradAcademic" v-on:change="changeItem1(rowId, $event)">
                              <option value="0">SELECCIONE</option>
                              <option v-for="lt in arrayCarreras" :key="lt.id" :value="lt.id"  v-text="lt.descripcion"></option>
                          </select>
                      </div>
                      <div class="col-md-5 ">
                          <dt class="st">Carrera</dt>
                          <select class="form-control" v-model="carrera" :disabled="carrer">
                            <option value="0">SELECCIONE</option>
                            <option v-for="lt in arrayNiv" :key="lt.id" :value="lt.id"  v-text="lt.descripcion"></option>                                            
                          </select>
                      </div>
                    </div>
                    <div class="form-group row">
                        <!-- <div class="col-md-3 ">
                            <dt class="st">Desde la fecha </dt>
                            <date-picker class="dat" value-type="date" format="DD/MM/YYYY"  v-model="fecha_inicio" :disabled-date="fechaactual"></date-picker>
                        </div>
                        <div class="col-md-3 ">
                            <dt class="st">Hasta la fecha </dt>
                            <date-picker class="dat" value-type="date" format="DD/MM/YYYY"  v-model="fecha_fin" :disabled-date="fechaactual"></date-picker>
                        </div> -->
                        <div class="form-group col-md-3">
                            <dt class="st">&nbsp; </dt>
                            <button class="btn btn-primary btn-block" type="subnmit" :disabled="validarcampo" @click="listarTipoReporte()">
                                <i class="fa fa-search"></i>&nbsp; Mostrar
                            </button>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- fin card 1 Busqueda Personal -->

            <!-- card 2 Muestra listado Destinos 1 -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title align-middle"> 
                  <i class="fas fa-list"></i>
                  Listado&nbsp;
                </h3>
              </div>
              <div class="card-body">
                <template v-if="arrayFechas.length > 0">
                  <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable">
                    <table class="table table-bordered table-striped table-sm" style="font-size: 14px;">
                      <thead>
                        <tr>
                          <th>Carnet Militar</th>
                          <th>Grados</th>
                          <th>Apellidos y Nombres</th>
                          <th>Grado Academico</th>
                          <th>Carrera Universitaria</th>
                          <th>Lugar de Estudio</th>
                          <th>Fecha de Egreso</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr v-for="d in arrayFechas" :key="d.id_denuncias">
                            <td v-text="d.percm"></td>
                            <td v-text="d.grado+' '+d.estudios"></td>
                            <td v-text="d.ppaterno+' '+d.pmaterno+' '+d.pnombre"></td>
                            <td v-text="d.descripcion_carrera"></td>
                            <td v-text="d.niv_especialidad"></td>
                            <td v-text="d.lugar_estudio"></td>
                            <td v-text="since(d.fecha_egreso)"></td>
                          </tr>
                      </tbody>
                        
                    </table>
                  </div>
                  <br>
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

                  <template v-if="tipo_reporte !== 'emi'">
                    <button type="button" @click="ReportePerProfPdf(fecha_inicio,fecha_fin,tipo_reporte,grado,promocion,gradoAcademico,carrera)" class="btn btn-danger">
                      <i class="fa fa-file"></i>&nbsp;Generar Reporte
                    </button>
                  </template>
                  <template v-if="tipo_reporte == 'emi'">
                    <button type="button" @click="ReportePerProfEmiPdf(tipo_reporte,gradoAcademico,carrera,emi)" class="btn btn-danger">
                        <i class="fas fa-file"></i>&nbsp;GENERAR
                    </button>
                  </template>


                </template>
                <template v-else>
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Nota:</h5>
                        Realice una búsqueda.
                    </div>
                </template>
              </div>
            
              


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
import moment from 'moment';
import { required, between, minLength, maxLength, alpha, numeric, email} from "vuelidate/lib/validators";
  

    export default {
        data() {
          return {

            gradoAcademico : 0,
            carrera : 0,
            promocion : '',
            grado : '',
            emi : 'ESCUELA MILITAR DE INGENIERIA',

            arrayGrados : [],

            gradAcademic : true,
            carrer : true,
            promociones : true,
            grad : true,
            emin : true,

            options: [
              { content: 'GENERAL', value: 'general' },
              { content: 'PROMOCIÓN', value: 'promocion' },
              { content: 'GRADO', value: 'grado' },
              { content: 'GRADO ACADEMICO', value: 'gradoAcademico' },
              { content: 'CARRERAS UNIVERSITARIAS', value: 'carrera' },
              { content: 'EGRESADOS EMI', value: 'emi' },
            ],




            submitStatus: null,
            arrayCarreras : [],
            arrayNiv : [],

            
            // Valores para guardar
            descripcion : "",
            clasificacion : "",
            observacion : "",
            id : "",

            fecha_inicio : '',
            fecha_fin : '',
            tipo_reporte : '',
            promocion : '',
            lugar_trabajo : '',
            tipo_identificacion: '',
            tipo_denuncia: '',
            rowId:0,




            

            

            arrayFechas: [],

            pagination : {
                'total' : 0,         
                'current_page' : 0, 
                'per_page' : 0, 
                'last_page' : 0, 
                'from' : 0, 
                'to' : 0, 
            },
            offset : 3, 
            buscar: "",
            criterio: 'descripcion',

          }
        },

        validations: {
            descripcion : { required},
            clasificacion : { required},
          forGroup: {
            nested: { required }
          },
          validationGroup: ['descripcion', 'clasificacion']
        },

        computed:{
          isActived: function(){
              return this.pagination.current_page;
          },
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
          validarcampo(){
            if(this.tipo_reporte!="")
            {
                return false;
            }
            else
            {
                return true;
            }
            },
        },   

        methods: {
          onChangeSelect(e) {
            if (e.target.value == 'general') {
              this.promociones = true;
              this.grad = true;
              this.gradAcademic = true;
              this.carrer = true;
            };
            if (e.target.value == 'promocion') {
              this.promociones = false;
              this.grad = true;
              this.gradAcademic = true;
              this.carrer = true;
            };
            if (e.target.value == 'grado') {
              this.promociones = true;
              this.grad = false;
              this.gradAcademic = true;
              this.carrer = true;
            };
            if (e.target.value == 'gradoAcademico') {
              this.promociones = true;
              this.grad = true;
              this.gradAcademic = false;
              this.carrer = true;
            };
            if (e.target.value == 'carrera') {
              this.promociones = true;
              this.grad = true;
              this.gradAcademic = false;
              this.carrer = false;
            };
            if (e.target.value == 'emi') {
              this.promociones = true;
              this.grad = true;
              this.gradAcademic = false;
              this.carrer = false;
            };
          },

          since: function (d){
            return moment(d).format('DD-MM-YYYY');
          },

          fechaactual(date){
            const today = new Date();
            console.log(today);
            today.setHours(0,0,0,0);
            return date > new Date(today.getTime());
          },

          changeItem1: function changeItem1(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.ListTipoDenunciaBuscar(event.target.value);
          },

          ListTipoDenunciaBuscar(depa)
          {
              let me =this;
              me.arrayNiv=[];
              var url='/selectbuscarNivelProfesionals?id=' + depa;
              me.selected = url;
              axios.post(url).then(function (response) {
                  //console.log(response);
                  me.arrayNiv = response.data;
                  
              })
              .catch(function (error) {
              me.selected =error;
              console.log(error);
              })
              .then(function () {
              }); 

          },

          listarCarrera(page,buscar, criterio){
            let me = this;
            var url = '/listarCarreras?page=' + page + '&buscar=' + buscar.toUpperCase() + '&criterio=' + criterio;
            axios
            .get(url)
            .then(function (response) {
                //console.log(response.data);
                var respuesta= response.data;
                me.arrayCarreras = respuesta.carrera.data;
                me.pagination = respuesta.pagination;
            })
            .catch(function (error) {
            console.log(error);
            });
          },

          selectEspeGrado(){
            let me =this;
            var url='/gradoEspecialidad';
            axios.get(url).then(function (response) {

                var respuesta = response.data;
                me.arrayGrados = respuesta.grados; 
              
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
          },

          cambiarPagina(page,buscar,criterio){
            let me = this;
            me.pagination.current_page = page;
            me.listarTipoReporte(page);
          },

          listarTipoReporte(page){
            let me = this;
            axios
            .post("/reporteProfesiones", {
                fecha_inicio: me.fecha_inicio,
                fecha_fin: me.fecha_fin,
                tipo_reporte: me.tipo_reporte,
                grado : me.grado,
                promocion : me.promocion,
                carrera: me.carrera,
                gradoAcademico: me.gradoAcademico,
                emi : me.emi,
                page: page
            })
            .then(function (response) {
                console.log(response);
                if (response.data.code == "200") {
                    me.arrayFechas = response.data.datos.data;
                    me.pagination = response.data.pagination;
                } else {
                    me.Reporte = [];
                }
                
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
          },


          ReportePerProfPdf(fecha_inicio,fecha_fin,tipo_reporte,grado,promocion,gradoAcademico,carrera,emi){
              window.open('http://sipefab.fab.bo/ReportePerProfPdf?fecha_inicio='+fecha_inicio+
                            '&'+'fecha_fin='+fecha_fin+
                            '&'+'tipo_reporte='+tipo_reporte+
                            '&'+'grado='+grado+
                            '&'+'promocion='+promocion+
                            '&'+'gradoAcademico='+gradoAcademico+
                            '&'+'carrera='+carrera+
                            '&'+'emi='+emi);
            },

          ReportePerProfEmiPdf(tipo_reporte,gradoAcademico,carrera,emi){
            window.open('http://sipefab.fab.bo/ReportePerProfEmiPdf?tipo_reporte='+tipo_reporte+
                            '&'+'gradoAcademico='+gradoAcademico+
                            '&'+'carrera='+carrera+
                            '&'+'emi='+emi);
          },


          reset(){
            let me = this;
            me.promocion = '';
            me.grado = 0;
            me.gradoAcademico = 0;
            me.carrera = 0;
            me.emi = 0;
        },

        

          







          GenerarPdfDestinos1(){
            window.open('http://sipefab.fab.bo/generarPdfDestinos1');
          },

          submit() {
            console.log('submit!')
            this.$v.$touch()
            if (this.$v.$invalid) {
              this.submitStatus = 'ERROR'
            } else {
              // do your submit logic here
              this.submitStatus = 'PENDING'
              setTimeout(() => {
                this.submitStatus = 'OK'
              }, 500)
            }
          }


        },

        mounted() {
          this.listarTipoReporte();
          this.listarCarrera(1, this.buscar, this.criterio); //Esto nos sirve para listar al principio la lista destinos
          this.ListTipoDenunciaBuscar(this.tipo_identificacion);
        },
    }
</script>

<style lang="scss" scoped>
  .tablesf {
   
    overflow-x: auto;
    white-space: nowrap;
  }
</style>