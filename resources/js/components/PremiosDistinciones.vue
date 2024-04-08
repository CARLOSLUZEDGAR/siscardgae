<template>
    <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              PREMIOS DISTINCIONES

            </h1>
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
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                  <i class="fas fa-bookmark"></i>
                  DATOS PERSONALES
                  </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <img v-bind:src="'../img/personal/'+arrayDatosPersonal.per_foto" class="rounded float-left img-fluid" width="150" height="150">
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
                                    <div class="col-md-2">
                                        
                                    </div>
                                </div>
                                <!-- FILA 2 -->
                                <div class="row p-2 bd-highlight">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt class="st">CARNET DE IDENTIDAD</dt>
                                            <dd class="st">{{arrayDatosPersonal.per_ci}}</dd>
                                        </dl>
                                    </div>
                                <!--    <div class="col-md-6">
                                        <dl>
                                            <dt class="st">SITUACION MILITAR ACTUAL</dt>
                                            <dd class="st">{{arrayDatosPersonal.per_ci}}</dd>
                                        </dl>
                                    </div>-->

                                </div>
                                <!-- FILA 3 -->
                                <div class="row p-2 bd-highlight justify-content-center">
                                    <div class="col-md-4">                                            
                                        <button v-if="$auth.can('insert-newpremdist')" class="btn btn-info" @click="NuevaDistincion(arrayDatosPersonal)">
                                            <i class="fa fa-plus-circle"></i> &nbsp;
                                            NUEVO REGISTRO
                                        </button>
                                        
                                    </div>
                                    <div class="col-md-4">  
                                        <button v-if="$auth.can('report-reppremdist')" @click="ReporteDistincion(arrayDatosPersonal.per_codigo)" class=" btn btn-secondary">
                                        <i class="far fa-file-pdf"></i>&nbsp;REPORTE
                                        </button>
                                    </div>
                                    <div class="col-md-4">  
                                        <router-link class="btn btn-danger" data-dismiss="modal" to="/premios" >
                                            <i class="fas fa-reply"></i> &nbsp;
                                            VOLVER ATRAS
                                        </router-link>
                                    </div>

                                    
                                    
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                  <i class="fas fa-bookmark"></i>
                  Listar
                  </h3>
                </div>
              <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 16px;">
                    <template v-if="arrayPersonalPremios.length"> 
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th><center>Opciones</center></th>
                                    <th><center>Institucion</center></th>
                                    <th><center>Distincion</center></th>
                                    <th><center>Categoria</center></th>
                                    <th><center>Nro. Documento</center></th>
                                    <th><center>Documento</center></th>
                                    <th><center>Descripcion</center></th>
                                    <th><center>Fecha</center></th>
                                    <th><center>Pais</center></th> 
                                    <th><center>Estado</center></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="personalPremios in arrayPersonalPremios">
                                    
                                    <td style="width:100px; text-align:center">
                                        <button v-if="$auth.can('edit-premdist')" type="button" class="btn btn-warning btn-sm" @click="EditarDistincion(personalPremios)">
                                            <i class="fas fa-edit"></i>
                                        </button> &nbsp;
                                        <template v-if="personalPremios.estado">
                                            <button v-if="$auth.can('delete-premdist')" type="button" class="btn btn-danger btn-sm" @click="DesactivarDistincion(personalPremios.id)">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button v-if="$auth.can('delete-premdist')" type="button" class="btn btn-info btn-sm" @click="ActivarDistincion(personalPremios.id)">
                                                <i class="far fa-check-square"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="personalPremios.descripcion1" ></td>
                                    <td v-text="personalPremios.descripcion2"></td> 
                                    <td v-text="personalPremios.descripcion3"></td> 
                                    <td v-text="personalPremios.nro_doc"></td> 
                                    <td v-text="personalPremios.tipo_doc"></td> 
                                    <td v-text="personalPremios.descripcion"></td> 
                                    <td >{{personalPremios.fecha_distincion | moment("D/MM/YYYY")}}</td>
                                    <td v-text="personalPremios.pais"></td>
                                    <td>
                                        <div v-if="personalPremios.estado">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                    </td>                          
                                </tr>
                                
                            </tbody>
                        </table>
                    </template>
                    <template v-else>
                        <div class="callout callout-info">
                            <h5><i class="fas fa-exclamation-triangle x-lg-2"></i> No se encontraron resultados...</h5>
                        </div>
                    </template>
                </div>
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

            <!--Inicio del modal REGISTRAR PREMIO -->
            <div class="modal fade" id="RegistrarPremio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">REGISTRO DE NUEVA DISTINCION</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <div class="col-md-12">
                                            
                                            <label class=" form-control-label" for="text-input">{{gra_abreviatura}} {{estu_abreviatura}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-md-12">
                                            
                                            <label class=" form-control-label" for="text-input">{{per_nombre}} </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-md-12">
                                            
                                            <label class=" form-control-label" for="text-input">{{per_paterno}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-md-12">
                                            
                                            <label class=" form-control-label" for="text-input">{{per_materno}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class="form-control-label" for="text-input">NRO. DOC.</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">    
                                        <div class="col-md-12">
                                            <input type="number" v-model="nro_doc" min="1" class="form-control" placeholder="12/21" :class="{ 'is-invalid' : $v.nro_doc.$error, 'is-valid':!$v.nro_doc.$invalid }">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.nro_doc.required">Este campo es Requerido</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class="form-control-label" for="text-input">TIPO DOC.</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">
                                            <select v-model="tipo_doc" class=" form-control" :class="{ 'is-invalid' : $v.tipo_doc.$error, 'is-valid':!$v.tipo_doc.$invalid }">
                                                <option disabled value="">SELECCIONE</option>
                                                <option value="MEMORANDUM">MEMORANDUM</option>
                                                <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>    
                                                <option value="DIPLOMA">DIPLOMA</option>
                                                <option value="RESOLUCION">RESOLUCION</option>
                                                <option value="CERTIFICADO">CERTIFICADO</option>
                                                <option value="OTROS">OTROS</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.tipo_doc.required">Este campo es Requerido</span>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class="form-control-label" for="text-input">FECHA</label>
                                        </div>
                                    </div>
                                <!--    <div class="form-group col-md-4">    
                                        <div class="col-md-12">
                                            <input type="date" v-model="fecha_distincion" class="form-control" :class="{ 'is-invalid' : $v.fecha_distincion.$error, 'is-valid':!$v.fecha_distincion.$invalid }">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.fecha_distincion.required">Este campo es Requerido</span>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="form-group col-md-4">    
                                        <div class="col-md-12">
                                            <date-picker class="dat" value-type="date" format="DD/MM/YYYY"  v-model="fecha_distincion" :disabled-date="fechaactual" :class="{ 'is-invalid' : $v.fecha_distincion.$error, 'is-valid':!$v.fecha_distincion.$invalid }"></date-picker>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.fecha_distincion.required">Este campo es Requerido</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class="form-control-label" for="text-input">PAIS</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">
                                            <select class="form-control" v-model="pais" :class="{ 'is-invalid' : $v.pais.$error, 'is-valid':!$v.pais.$invalid }">
                                                
                                                <!-- Select para estado civil -->
                                                <option v-for="pais in arrayPais" :key="pais.id" :value="pais.id">
                                                    {{pais.nombre}}
                                                </option>                                              
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.pais.required">Este campo es Requerido</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class=" form-control-label" for="text-input">INSTITUCION</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">
                                            <select class="form-control" v-model="distincion1" v-on:change="changeItem1(rowId, $event)" :class="{ 'is-invalid' : $v.distincion1.$error, 'is-valid':!$v.distincion1.$invalid }">
                                                <option value="0" disabled>SELECCIONE</option>
                                                <option v-for="institucion in arrayInstitucion" :key="institucion.id" :value="institucion.id"  v-text="institucion.descripcion"></option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.distincion1.required">Este campo es Requerido</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class=" form-control-label" for="text-input">TIPO</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">
                                            <select class="form-control" v-model="distincion2" v-on:change="changeItem2(rowId, $event)" :class="{ 'is-invalid' : $v.distincion2.$error, 'is-valid':!$v.distincion2.$invalid }">
                                                <option value="" disabled>SELECCIONE</option>
                                                <option v-for="distincion2 in arrayDistincion2" :key="distincion2.id" :value="distincion2.id"  v-text="distincion2.descripcion"></option>                        
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.distincion2.required">Este campo es Requerido</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class=" form-control-label" for="text-input">DISTINCION</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="col-md-12">
                                            <select class="form-control" v-model="distincion3" :class="{ 'is-invalid' : $v.distincion3.$error, 'is-valid':!$v.distincion3.$invalid }">
                                                <option value="" disabled>SELECCIONE</option>
                                                <option v-for="distincion3 in arrayDistincion3" :key="distincion3.id" :value="distincion3.id"  v-text="distincion3.descripcion"></option>
                                            
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.distincion3.required">Este campo es Requerido</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class=" form-control-label" for="text-input">DESCRIPCION</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="col-md-12">
                                            <textarea v-model="descripcion" :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }"
                                            class="form-control" style="text-transform:uppercase;"></textarea>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.descripcion.required">Este campo es Requerido</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                            <button type="button" class="btn btn-primary" @click="RegistrarDistincion()">REGISTRAR</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

            <!--Inicio del modal ACTUALIZAR PREMIO -->
            <div class="modal fade" id="ActualizarPremio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ACTUALIZAR DATOS DE DISTINCION</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                
                                <div class="form-group row">
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class="form-control-label" for="text-input">NRO. DOC.</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">    
                                        <div class="col-md-12">
                                            <input type="text" v-model="nro_docA" class="form-control" placeholder="12/21">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class="form-control-label" for="text-input">TIPO DOC.</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">
                                            <select v-model="tipo_docA" class=" form-control">
                                                <option disabled value="">SELECCIONE</option>
                                                <option value="MEMORANDUM">MEMORANDUM</option> 
                                                <option value="ORDEN DEL DIA">ORDEN DEL DIA</option>
                                                <option value="DIPLOMA">DIPLOMA</option>
                                                <option value="RESOLUCION">RESOLUCION</option>
                                                <option value="CERTIFICADO">CERTIFICADO</option>
                                                <option value="OTROS">OTROS</option>
                                            </select>
                                        </div>
                                    </div>  
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class="form-control-label" for="text-input">FECHA</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">    
                                        <div class="col-md-12">
                                            <input type="date" v-model="fecha_distincionA" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class="form-control-label" for="text-input">PAIS</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">
                                            <select class="form-control" v-model="paisA">
                                                
                                                <!-- Select para estado civil -->
                                                <option v-for="pais in arrayPais" :key="pais.id" :value="pais.id">
                                                    {{pais.nombre}}
                                                </option>                                              
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class=" form-control-label" for="text-input">INSTITUCION</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">
                                            <select class="form-control" v-model="distincion1A" v-on:change="changeItem1(rowId, $event)">
                                                <option value="0" disabled>SELECCIONE</option>
                                                <option v-for="institucion in arrayInstitucion" :value="institucion.id"  v-text="institucion.descripcion"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class=" form-control-label" for="text-input">TIPO</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">
                                            <select class="form-control" v-model="distincion2A" v-on:change="changeItem2(rowId, $event)">
                                                <option value="" disabled>SELECCIONE</option>
                                                <option v-for="distincion2 in arrayDistincion2" :value="distincion2.id"  v-text="distincion2.descripcion"></option>                        
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class=" form-control-label" for="text-input">DISTINCION</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="col-md-12">
                                            <select class="form-control" v-model="distincion3A">
                                                <option value="" disabled>SELECCIONE</option>
                                                <option v-for="distincion3 in arrayDistincion3" :value="distincion3.id"  v-text="distincion3.descripcion"></option>
                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-2">
                                        <div class="col-md-12">
                                            <label class=" form-control-label" for="text-input">DESCRIPCION</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <div class="col-md-12">
                                            <textarea v-model="descripcionA" class="form-control" style="text-transform:uppercase;"></textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                            <button type="button" class="btn btn-primary" @click="ActualizarDistincion()">ACTUALIZAR</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

    </section>
    <!-- /.content -->

  </div>
</template>

<script>
//import { required, minLength, between } from 'vuelidate/lib/validators'
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
    data() {
        const today = new Date();
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.d,
            arrayPersonalPremios : [],
            arrayInstitucion : [],
            arrayDistincion2 : [],
            arrayDistincion3 : [],
            arrayDatosPersonal : [],
            arrayPais : [],  //select Pais
            rowId : 0,
            

            ano_actual : '',
            per_cmi : '',
            per_cmil : '',

            // variables para registrar nueva distincion
            gra_abreviatura:'',
            estu_abreviatura:'',
            per_nombre:'',
            per_paterno:'',
            per_materno:'',

            // VARIABLES PARA REGISTRAR DISTINCION
            nro_doc:'',
            tipo_doc:'',
            fecha_distincion: new Date(today.getTime()),
            pais:'',
            distincion1:'',
            distincion2:'',
            distincion3:'',
            descripcion:'',

            // VARIABLES PARA ACTUALIZAR DATOS DE DISTINCION
            nro_docA:'',
            tipo_docA:'',
            fecha_distincionA:'',
            paisA:'',
            distincion1A:'',
            distincion2A:'',
            distincion3A:'',
            descripcionA:'',
            id_distincion:'',

  


            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page'    : 0,
                'last_page'    : 0,
                'from'     : 0,
                'to'    : 0,
            },
            offset : 3,
        }
    },

    computed:{
        isActived : function(){
            return this.pagination.current_page;
        },
        //calcula los elementos de la paginacion
        pagesNumber : function (){
            if (!this.pagination.to) {
                return[];
            }

            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from =1;
            }

            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

    validations:{
        nro_doc : { required },
        tipo_doc : { required },
        fecha_distincion : { required },
        pais : { required },
        distincion1 : { required },
        distincion2 : { required },
        distincion3 : { required },
        descripcion : { required },   
    },

    mounted() {
        //this.ver();
        this.listarPersonalPremios(1);
        this.datosPersonal(this.per_codigo);
    },
    methods: {

        listarPersonalPremios(page){
            let me = this;
            var url = '/listarPersonalPremios';
            axios.post(url, {
            per_codigo : me.per_codigo,
            page: page
          })
          .then(function (response) {
            
            var respuesta = response.data;
            me.arrayPersonalPremios = respuesta.premio.data;
            me.pagination= respuesta.pagination;
        //   me.arrayPersonalDestinos2 = response.data.cargo2.data
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
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        selectPais(){
            let me=this;
            var url= '/listarPaises';
            axios
            .get(url)
            .then(function (response) {
                
                me.arrayPais = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
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

        NuevaDistincion(arrayDatosPersonal){
            this.gra_abreviatura = arrayDatosPersonal.gra_abreviatura,
            this.estu_abreviatura = arrayDatosPersonal.estu_abreviatura,
            this.per_nombre = arrayDatosPersonal.per_nombre,
            this.per_paterno = arrayDatosPersonal.per_paterno,
            this.per_materno = arrayDatosPersonal.per_materno,
            this.per_codigo = arrayDatosPersonal.per_codigo,
            this.selectPais();
            this.selectDistincion1()
            this.selectDistincion2(this.distincion1)
            this.selectDistincion3(this.distincion2)
            $('#RegistrarPremio').modal('show')
            $(".modal-header").css("background-color", "#007bff")
            $(".modal-header").css("color", "white" )
        },

        fechaactual(date){
            const today = new Date();
            console.log(today);
            today.setHours(0,0,0,0);
            return date > new Date(today.getTime());
        },

        changeItem1: function changeItem1(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectDistincion2(event.target.value);
        },

        changeItem2: function changeItem2(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.selectDistincion3(event.target.value);
        },

        RegistrarDistincion(){
            this.$v.$reset();
            if(!this.$v.$invalid){
                swal.fire({
                    title: 'Esta seguro de registrar Nueva Distincion', // TITULO 
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
                        //CODIGO HA SER VALIDADO
                        let me = this;
                        axios
                        .post("/registrarDistincion", {
                        //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                            per_codigo : me.per_codigo,
                            nro_doc : me.nro_doc,
                            tipo_doc : me.tipo_doc,
                            descripcion : me.descripcion.toUpperCase(),
                            fecha_distincion : me.fecha_distincion,
                            pais : me.pais,
                            id_distincion1 : me.distincion1,
                            id_distincion2 : me.distincion2,
                            id_distincion3 : me.distincion3,
                            estado : '1'
                        })
                        .then(function (response) {
                            //Respuesta de la peticion
                            
                            $('#RegistrarPremio').modal('hide');
                            
                            swal.fire(
                            'Registrado',
                            'El registro se realizó con éxito',
                            'success'
                            )
                            me.cerrarModal();
                            me.listarPersonalPremios();
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
        },

        cerrarModal(){
            this.nro_doc = '',
            this.tipo_doc = '',
            this.descripcion = '',
            this.fecha_distincion = '',
            this.pais = '',
            this.distincion1 = '',
            this.distincion2 = '',
            this.distincion3 = ''
        },

        EditarDistincion(personalPremios){
            this.id_distincion = personalPremios.id,
            this.nro_docA = personalPremios.nro_doc,
            this.tipo_docA = personalPremios.tipo_doc,
            this.fecha_distincionA = personalPremios.fecha_distincion,
            this.paisA = personalPremios.id_pais,
            this.distincion1A = personalPremios.dist1_id,
            this.distincion2A = personalPremios.dist2_id,
            this.distincion3A = personalPremios.dist3_id,
            this.descripcionA = personalPremios.descripcion,
            $('#ActualizarPremio').modal('show'),
            $(".modal-header").css("background-color", "#007bff"),
            $(".modal-header").css("color", "white" ),
            this.selectPais(),
            this.selectDistincion1(),
            this.selectDistincion2(this.distincion1A),
            this.selectDistincion3(this.distincion2A)

        },

        ActualizarDistincion(){
            
            swal.fire({
                title: 'Esta seguro de modificar esta Distincion?', // TITULO 
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
                    //CODIGO HA SER VALIDADO
                    let me = this;
                    axios
                    .put("/actualizarDistincion", {
                //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                    id_dist : me.id_distincion,
                    nro_doc : me.nro_docA,
                    tipo_doc : me.tipo_docA,
                    fecha_distincion : me.fecha_distincionA,
                    pais : me.paisA,
                    dist1 : me.distincion1A,
                    dist2 : me.distincion2A,
                    dist3 : me.distincion3A,
                    descripcion : me.descripcionA.toUpperCase(),
                })
                .then(function (response) {
                    //Respuesta de la peticion
                    
                    $('#ActualizarPremio').modal('hide');
                    swal.fire(
                        'Actualizado',
                        'El registro se actualizó con éxito',
                        'success'
                        )
                    me.listarPersonalPremios();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    });
                }else{
                    console.log('no empezamos');
                }
            })  

        },

        DesactivarDistincion(id){ //DOS_2
            swal.fire({
                title: '¿Está seguro de Desactivar distinción ?', // TITULO 
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
                //SI SE DA CLIC A ACEPTAR

                let me = this;
                axios
                .put("/desactivarDistincion", { //Se pone put para el envio de datos
                    'id':id
                })
                .then(function (response) {
                    
                    me.datos = response.data;
                    me.listarPersonalPremios();

                    swal.fire(
                        "Aceptado", //TITULO
                        "Se ha desactivado la distincion.", //TEXTO DE MENSAJE
                        "success" // TIPO DE MODAL (success, warnning, error, info)
                    );

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

        ActivarDistincion(id){ //DOS_2
            swal.fire({
                title: '¿Está seguro de Activar distinción ?', // TITULO 
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
                //SI SE DA CLIC A ACEPTAR
                let me = this;
                axios
                .put("/activarDistincion", { //Se pone put para el envio de datos
                    'id':id
                })
                .then(function (response) {
                    
                    me.datos = response.data;
                    me.listarPersonalPremios();

                    swal.fire(
                        "Aceptado", //TITULO
                        "Se ha Activado la distincion.", //TEXTO DE MENSAJE
                        "success" // TIPO DE MODAL (success, warnning, error, info)
                    );

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

        ReporteDistincion(per_codigo){
            window.open('http://sipefab.fab.bo/DistincionesPdf?per_codigo='+per_codigo);
        //    window.open('http://sipefab.fab.bo/DistincionesPdf?per_codigo='+per_codigo);
        },

        Cerrar(){
            this.$v.$reset()
        },

        cambiarPagina(page){
            let me = this;
            me.pagination.current_page = page;
            //envia la peticion para visualizar la data de sus pagina
            me.listarPersonalPremios(page);
        },
    },
}
</script>
<style>
.dat{
    width: 100%;
}
</style>