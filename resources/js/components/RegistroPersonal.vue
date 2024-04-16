<template>
    <div>
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">            
              <h1>
                <i class="far fa-bookmark"></i>
                Registrar Personal
                <!-- <small>Personal</small> -->
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <!-- <li class="breadcrumb-item active">Datos del Personal</li> -->
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
                  <div class="row">
                    <div class="col-sm-8">
                      <h3 class="card-title">
                        <!-- <i class="fas fa-search"></i> -->
                        <!-- Buscar Personal -->
                      </h3>  
                    </div>                  
                    <div class="col-sm-4" v-if="$auth.can('insert-per')">
                      <!-- <router-link to='/DatosPersonal' @click.native="$router.go()">
                        <button type="button" class="btn btn-primary btn-sm float-right">
                          <i class="fas fa-plus"></i> ATRAS
                        </button>
                      </router-link>  -->
                      <button class="btn btn-danger btn-sm float-right" type="submit" @click="Atras()">
                        <i class="fas fa-arrow-left"></i>&nbsp; ATRAS
                      </button>
                    </div>
                  </div>  
                </div>
                <div class="card-body">
                    <form @submit.prevent="handleSubmit">
                        <!-- Paso 1 -->
                        <div class="step" v-if="currentStep === 1">
                            <h3><i class="far fa-bookmark"></i>&nbsp;Paso 1: INFORMACIÓN PERSONAL</h3>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Categoria</label>
                                    <select class="form-control" v-model="per_categoria" @click="listarLicencia(per_entidad,per_categoria)" :class="{ 'is-invalid' : $v.per_categoria.$error, 'is-valid':!$v.per_categoria.$invalid }">
                                        <option value="" disabled>SELECCIONE</option>
                                        <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id"  v-text="categoria.categoria"></option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_categoria.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Nacionalidad</label>
                                    <select class="form-control" v-model="per_nacionalidad" @click="listarEntidad(per_nacionalidad)" :class="{ 'is-invalid' : $v.per_nacionalidad.$error, 'is-valid':!$v.per_nacionalidad.$invalid }">
                                        <option value="" disabled>SELECCIONE</option>
                                        <option v-for="nacionalidad in arrayNacionalidad" :key="nacionalidad.id" :value="nacionalidad.id"  v-text="nacionalidad.pais"></option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_nacionalidad.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <!-- <div class="col-md-1">
                                    <button type="button" class="btn btn btn-success" style="border-radius: 50%;" @click="NuevaNacionalidad()">+</button>
                                </div> -->
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Entidad</label>
                                    <select class="form-control" v-model="per_entidad" @click="listarLicencia(per_entidad,per_categoria),listarGrado(per_entidad)" :class="{ 'is-invalid' : $v.per_entidad.$error, 'is-valid':!$v.per_entidad.$invalid }">
                                        <option value="" disabled>SELECCIONE</option>
                                        <option v-for="entidad in arrayEntidad" :key="entidad.id" :value="entidad.id"  v-text="entidad.entidad"></option>                        
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_entidad.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <!-- <div class="col-md-1">
                                    <button type="button" class="btn btn btn-success" style="border-radius: 50%;" @click="NuevaEntidad()">+</button>
                                </div> -->
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Grado</label>
                                    <select class="form-control" v-model="per_grado" :class="{ 'is-invalid' : $v.per_grado.$error, 'is-valid':!$v.per_grado.$invalid }">
                                        <option value="" disabled>SELECCIONE</option>
                                        <option v-for="grado in arrayGrado" :key="grado.id" :value="grado.id" v-text="grado.nombre"></option>                        
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_grado.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Carnet de Identidad (Identificación Personal)</label>
                                    <input type="text" v-model="per_ci" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_ci.$error, 'is-valid':!$v.per_ci.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_ci.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Carnet Militar (Identificación Institucional)</label>
                                    <input type="text" v-model="per_cm" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_cm.$error, 'is-valid':!$v.per_cm.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_cm.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Nombres</label>
                                    <input type="text" v-model.trim="per_nombre" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_nombre.$error, 'is-valid':!$v.per_nombre.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_nombre.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Ap. Paterno</label>
                                    <input type="text" v-model.trim="per_appaterno" class="form-control" style="text-transform:uppercase;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Ap. Materno</label>
                                    <input type="text" v-model.trim="per_apmaterno" class="form-control" style="text-transform:uppercase;">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Fecha Nacimiento</label>
                                    <input type="date" v-model="per_fechnac" class="form-control" :class="{ 'is-invalid' : $v.per_fechnac.$error, 'is-valid':!$v.per_fechnac.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_fechnac.required">Este campo es Requerido</span>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Sexo</label>
                                    <select class="form-control" v-model="per_sexo" :class="{ 'is-invalid' : $v.per_sexo.$error, 'is-valid':!$v.per_sexo.$invalid }">
                                        <option value="" disabled>SELECCIONE</option>
                                        <option value="MASCULINO">MASCULINO</option>
                                        <option value="FEMENINO">FEMENINO</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_sexo.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Celular </label>
                                    <input type="text" v-model.number="per_celular" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_celular.$error, 'is-valid':!$v.per_celular.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_celular.required">Este campo es Requerido</span>
                                    </div>
                                </div>                            
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">E-mail </label>
                                    <input type="text" v-model.trim="per_email" class="form-control" :class="{ 'is-invalid' : $v.per_email.$error, 'is-valid':!$v.per_email.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_email.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Titulo de la Licencia</label>
                                    <select class="form-control" v-model="per_titlic" @click="listarHabilitacion(per_titlic)" :class="{ 'is-invalid' : $v.per_titlic.$error, 'is-valid':!$v.per_titlic.$invalid }">
                                        <option value="" disabled>SELECCIONE</option>
                                        <option v-for="licencia in arrayLicencia" :key="licencia.id" :value="licencia.id"  v-text="licencia.licencia"></option>                        
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_titlic.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Habilitación</label>
                                    <select class="form-control" v-model="per_habilitacion" :class="{ 'is-invalid' : $v.per_habilitacion.$error, 'is-valid':!$v.per_habilitacion.$invalid }">
                                        <option value="" disabled>SELECCIONE</option>
                                        <option v-for="habilitacion in arrayHabilitacion" :key="habilitacion.id" :value="habilitacion.id"  v-text="habilitacion.habilitacion"></option>                        
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_habilitacion.required">Este campo es Requerido</span>
                                    </div>
                                </div>  
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Competencia Linguistica</label>
                                    <select class="form-control" v-model="per_comlinguistica" :class="{ 'is-invalid' : $v.per_comlinguistica.$error, 'is-valid':!$v.per_comlinguistica.$invalid }">
                                        <option value="" disabled>SELECCIONE</option>
                                        <option v-for="linguistica in arrayCompetenciaLinguistica" :key="linguistica.id" :value="linguistica.id"  v-text="linguistica.nivel"></option>                        
                                    </select>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_comlinguistica.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-control-label" for="text-input">Dirección</label>
                                    <input type="text" v-model.trim="per_direccion" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_direccion.$error, 'is-valid':!$v.per_direccion.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_direccion.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label" for="text-input">Observación</label>
                                    <input type="text" v-model.trim="per_observaciones" class="form-control" style="text-transform:uppercase;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <div class="row">
                                        <template v-if="v == 0">
                                            <img :src="'/img/avatar.jpg'" width="150px" height="150px" style="border: 1.5px solid black; text-align: center">
                                        </template>
                                        <template v-else>
                                            <img :src="imagen" width="150px" height="150px" style="border: 1.5px solid black; text-align: center">
                                        </template> 
                                    </div>                       
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Fotografia</label>
                                    <!-- <input type="file" class="form-control" @change="obtenerImagen" accept="image/*" :class="{ 'is-invalid' : $v.per.foto.$error, 'is-valid':!$v.per.foto.$invalid }"> -->
                                    <input type="file" class="form-control" @change="obtenerImagen" accept="image/*">
                                    <!-- <div class="invalid-feedback">
                                        <div v-if="!$v.per_foto.required">Ingrese valor porfavor.</div>
                                    </div> -->
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Fecha de Emisión</label>
                                    <input type="date" v-model="per_fechaemision" class="form-control" :class="{ 'is-invalid' : $v.per_fechaemision.$error, 'is-valid':!$v.per_fechaemision.$invalid }" disabled>
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_fechaemision.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Fecha de Expiración (Certificado Medico)</label>
                                    <input type="date" v-model="per_fechaexpiracion" class="form-control" :class="{ 'is-invalid' : $v.per_fechaexpiracion.$error, 'is-valid':!$v.per_fechaexpiracion.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_fechaexpiracion.required">Este campo es Requerido</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button type="button" class="btn btn-danger" @click="nextStep"><i class="fas fa-forward"></i>&nbsp; SIGUIENTE</button>
                            </div>
                        </div>
                        <!-- Paso 2 -->
                        <div class="step" v-if="currentStep === 2">
                            <h3><i class="far fa-folder"></i>&nbsp;Paso 2: DOCUMENTACIÓN PERSONAL</h3>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-12" style="background-color: aquamarine;">
                                    <label class="form-control-label" for="text-input">LOS DOCUMENTOS DEBEN ESTAR EN FORMATO PDF.</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="form-control-label" for="text-input">GRADO Y NOMBRE: {{per_grado}} {{per_nombre}} {{per_appaterno}} {{per_apmaterno}}</label>
                                </div>
                            </div>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="myTable" style="font-size: 12pt;">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">DOCUMENTO</th>
                                            <th class="text-center">ARCHIVO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="form-control-label" for="text-input">1</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CARNET DE IDENTIDAD</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerCi" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_ci.$error, 'is-valid':!$v.doc_ci.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_ci.required">Por favor, carga un archivo.</span>
                                                </div>  
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="form-control-label" for="text-input">2</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CERTIFICADO DE NACIMIENTO</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerNacimiento" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_nacimiento.$error, 'is-valid':!$v.doc_nacimiento.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_nacimiento.required">Por favor, carga un archivo.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="form-control-label" for="text-input">3</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CERTIFICADO DE EGRESO</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerEgreso" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_egreso.$error, 'is-valid':!$v.doc_egreso.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_egreso.required">Por favor, carga un archivo.</span>
                                                </div>
                                             </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="form-control-label" for="text-input">4</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CERTIFICADO DE ESPECIALIZACIÓN</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerEspecializacion" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_especializacion.$error, 'is-valid':!$v.doc_especializacion.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_especializacion.required">Por favor, carga un archivo.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="form-control-label" for="text-input">5</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CERTIFICADO MEDICO</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerMedico" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_medico.$error, 'is-valid':!$v.doc_medico.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_medico.required">Por favor, carga un archivo.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="form-control-label" for="text-input">6</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">TITULO EDUCATIVO</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerTitulo" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_titulo.$error, 'is-valid':!$v.doc_titulo.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_titulo.required">Por favor, carga un archivo.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="form-control-label" for="text-input">7</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">LIBRETA MILITAR</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerLibreta" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_libreta.$error, 'is-valid':!$v.doc_libreta.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_libreta.required">Por favor, carga un archivo.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="form-control-label" for="text-input">8</label>
                                            </td>
                                            <td>
                                                <label class="form-control-label" for="text-input">CERTIFICADO DE APROBACIÓN DE EXAMEN</label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="obtenerAprobacion" accept=".pdf" v-bind:class="{ 'is-invalid': $v.doc_aprobacion.$error, 'is-valid':!$v.doc_aprobacion.$invalid }">
                                                <div class="invalid-feedback">
                                                  <span v-if="!$v.doc_aprobacion.required">Por favor, carga un archivo.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group row">
                                <button type="button" class="btn btn-primary" @click="previousStep"><i class="fas fa-backward"></i>&nbsp; ANTERIOR</button>
                                &nbsp;
                                <!-- <button type="button" class="btn btn-danger" @click="nextStep"><i class="fas fa-forward"></i>&nbsp; SIGUIENTE</button> -->
                                <button type="button" class="btn btn-danger" @click="CrearPersonal()"><i class="fas fa-forward"></i>&nbsp; GUARDAR</button>
                            </div>
                        </div>

                    <!-- Paso 3 -->
                    <div class="step" v-if="currentStep === 3">
                        <h3>Paso 3: Confirmación</h3>
                        <p>Por favor, confirma la información:</p>
                        <p>Nombre: {{ per_nombre }}</p>
                        <p>Email: {{ per_nombre }}</p>
                        <p>Teléfono: {{ per_nombre }}</p>
                        <p>Dirección: {{ per_nombre }}</p>
                        <button type="button" @click="previousStep">Anterior</button>
                        <button type="submit">Enviar</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- ./row -->
        </div>
        <!-- /.container-fluid -->
        <!-- Modal Nuevo Personal -->
        <div class="modal fade" id="ModalNewPersonal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title-registro"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="CrearPersonal()">Generar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Modal Renovar Personal -->
        <div class="modal fade" id="ModalRenewPersonal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title-registro"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <div class="col-md-4">
                      <div class="row">
                          <template v-if="vA == 0">
                              <img :src="'/img/personal/'+imagenA" width="150px" height="150px" style="border: 1.5px solid black;">
                          </template>
                          <template v-else>
                              <img :src="imagenA" width="150px" height="150px" style="border: 1.5px solid black;">
                          </template> 
                      </div>                       
                  </div>
                  <div class="col-md-8">
                    <label class="form-control-label" for="text-input">Fotografia</label>
                      <input type="file" class="form-control" @change="obtenerImagenA" accept="imageA/*">
                      <!-- <input type="file" class="form-control" @change="obtenerImagen" accept="image/*" :class="hasError('foto') ? 'is-invalid' : ''"> -->
                      <!-- <div v-if="hasError('foto')" class="invalid-feedback">
                          <div class="error" v-if="!$v.per_fotoA.required">Ingrese valor porfavor.</div>
                      </div> -->
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                      <label class="form-control-label" for="text-input">Categoria</label>
                      <select class="form-control" v-model="per_categoriaA" @click="listarLicencia(per_entidadA,per_categoriaA)" :class="{ 'is-invalid' : $v.per_categoriaA.$error, 'is-valid':!$v.per_categoriaA.$invalid }">
                          <option value="" disabled>SELECCIONE</option>
                          <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id"  v-text="categoria.categoria"></option>
                      </select>
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_categoriaA.required">Este campo es Requerido</span>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <label class="form-control-label" for="text-input">Nacionalidad</label>
                      <select class="form-control" v-model="per_nacionalidadA" @click="listarEntidad(per_nacionalidadA)" :class="{ 'is-invalid' : $v.per_nacionalidadA.$error, 'is-valid':!$v.per_nacionalidadA.$invalid }" disabled>
                          <option value="" disabled>SELECCIONE</option>
                          <option v-for="nacionalidad in arrayNacionalidad" :key="nacionalidad.id" :value="nacionalidad.id"  v-text="nacionalidad.pais"></option>
                      </select>
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_nacionalidadA.required">Este campo es Requerido</span>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="form-control-label" for="text-input">Entidad</label>
                    <select class="form-control" v-model="per_entidadA" @click="listarGrado(per_entidadA),listarLicencia(per_entidadA,per_categoriaA)" :class="{ 'is-invalid' : $v.per_entidadA.$error, 'is-valid':!$v.per_entidadA.$invalid }">
                        <option value="" disabled>SELECCIONE</option>
                        <option v-for="entidad in arrayEntidad" :key="entidad.id" :value="entidad.id"  v-text="entidad.entidad"></option>                        
                    </select>
                    <div class="invalid-feedback">
                        <span v-if="!$v.per_entidadA.required">Este campo es Requerido</span>
                    </div>
                  </div>
                  <!-- <div class="col-md-1">
                    <button type="button" class="btn btn btn-success" style="border-radius: 50%;" @click="NuevaEntidad()">+</button>
                  </div> -->
                  <div class="col-md-6">
                    <label class="form-control-label" for="text-input">Grado</label>
                      <select class="form-control" v-model="per_gradoA" :class="{ 'is-invalid' : $v.per_gradoA.$error, 'is-valid':!$v.per_gradoA.$invalid }">
                          <option value="" disabled>SELECCIONE</option>
                          <option v-for="grado in arrayGrado" :key="grado.id" :value="grado.id"  v-text="grado.nombre"></option>                        
                      </select>
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_gradoA.required">Este campo es Requerido</span>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                      <label class="form-control-label" for="text-input">Carnet de Identidad (Identificación Personal)</label>
                      <input type="text" v-model="per_ciA" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_ciA.$error, 'is-valid':!$v.per_ciA.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_ciA.required">Este campo es Requerido</span>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <label class="form-control-label" for="text-input">Carnet Militar (Identificación Institucional)</label>
                      <input type="text" v-model="per_cmA" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_cmA.$error, 'is-valid':!$v.per_cmA.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_cmA.required">Este campo es Requerido</span>
                      </div>
                  </div>                             
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                      <label class="form-control-label" for="text-input">Nombres</label>
                      <input type="text" v-model="per_nombreA" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_nombreA.$error, 'is-valid':!$v.per_nombreA.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_nombreA.required">Este campo es Requerido</span>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <label class="form-control-label" for="text-input">Ap. Paterno</label>
                      <!-- <input type="text" v-model="per_appaternoA" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_appaternoA.$error, 'is-valid':!$v.per_appaternoA.$invalid }"> -->
                      <input type="text" v-model="per_appaternoA" class="form-control" style="text-transform:uppercase;">
                      <!-- <div class="invalid-feedback">
                          <span v-if="!$v.per_appaternoA.required">Este campo es Requerido</span>
                      </div> -->
                  </div>                               
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="form-control-label" for="text-input">Ap. Materno</label>
                    <!-- <input type="text" v-model="per_apmaternoA" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_apmaternoA.$error, 'is-valid':!$v.per_apmaternoA.$invalid }"> -->
                    <input type="text" v-model="per_apmaternoA" class="form-control" style="text-transform:uppercase;">
                    <!-- <div class="invalid-feedback">
                        <span v-if="!$v.per_apmaternoA.required">Este campo es Requerido</span>
                    </div> -->
                  </div> 
                  <div class="col-md-6">
                    <label class="form-control-label" for="text-input">Fecha Nacimiento</label>
                    <input type="date" v-model="per_fechnacA" class="form-control" :class="{ 'is-invalid' : $v.per_fechnacA.$error, 'is-valid':!$v.per_fechnacA.$invalid }" disabled>
                    <div class="invalid-feedback">
                        <span v-if="!$v.per_fechnacA.required">Este campo es Requerido</span>
                    </div>
                  </div>
                  </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="form-control-label" for="text-input">Sexo</label>
                    <select class="form-control" v-model="per_sexoA" :class="{ 'is-invalid' : $v.per_sexoA.$error, 'is-valid':!$v.per_sexoA.$invalid }">
                        <option value="" disabled>SELECCIONE</option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMENINO">FEMENINO</option>
                    </select>
                    <div class="invalid-feedback">
                        <span v-if="!$v.per_sexoA.required">Este campo es Requerido</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                      <label class="form-control-label" for="text-input">Celular </label>
                      <input type="text" v-model="per_celularA" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_celularA.$error, 'is-valid':!$v.per_celularA.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_celularA.required">Este campo es Requerido</span>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                      <label class="form-control-label" for="text-input">E-mail </label>
                      <input type="text" v-model="per_emailA" class="form-control" :class="{ 'is-invalid' : $v.per_emailA.$error, 'is-valid':!$v.per_emailA.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_emailA.required">Este campo es Requerido</span>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-control-label" for="text-input">Titulo de la Licencia</label>
                      <select class="form-control" v-model="per_titlicA" @click="listarHabilitacion(per_titlicA)" :class="{ 'is-invalid' : $v.per_titlicA.$error, 'is-valid':!$v.per_titlicA.$invalid }">
                          <option value="" disabled>SELECCIONE</option>
                          <option v-for="licencia in arrayLicencia" :key="licencia.id" :value="licencia.id"  v-text="licencia.licencia"></option>                        
                      </select>
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_titlicA.required">Este campo es Requerido</span>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="form-control-label" for="text-input">Habilitación</label>
                      <select class="form-control" v-model="per_habilitacionA" :class="{ 'is-invalid' : $v.per_habilitacionA.$error, 'is-valid':!$v.per_habilitacionA.$invalid }">
                          <option value="" disabled>SELECCIONE</option>
                          <option v-for="habilitacion in arrayHabilitacion" :key="habilitacion.id" :value="habilitacion.id"  v-text="habilitacion.habilitacion"></option>                        
                      </select>
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_habilitacionA.required">Este campo es Requerido</span>
                      </div>
                  </div>  
                  <div class="col-md-6">
                    <label class="form-control-label" for="text-input">Competencia Linguistica</label>
                      <select class="form-control" v-model="per_comlinguisticaA" :class="{ 'is-invalid' : $v.per_comlinguisticaA.$error, 'is-valid':!$v.per_comlinguisticaA.$invalid }">
                          <option value="" disabled>SELECCIONE</option>
                          <option v-for="linguistica in arrayCompetenciaLinguistica" :key="linguistica.id" :value="linguistica.id"  v-text="linguistica.nivel"></option>                        
                      </select>
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_comlinguisticaA.required">Este campo es Requerido</span>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Dirección</label>
                      <input type="text" v-model="per_direccionA" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_direccionA.$error, 'is-valid':!$v.per_direccionA.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.per_direccionA.required">Este campo es Requerido</span>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label" for="text-input">Observación</label>
                        <textarea name="textarea" class="form-control" rows="3" v-model="per_observacionesA" style="text-transform:uppercase"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="form-control-label" for="text-input">Fecha de Emisión</label>
                    <input type="date" v-model="per_fechaemisionA" class="form-control" :class="{ 'is-invalid' : $v.per_fechaemisionA.$error, 'is-valid':!$v.per_fechaemisionA.$invalid }" disabled>
                    <div class="invalid-feedback">
                        <span v-if="!$v.per_fechaemisionA.required">Este campo es Requerido</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-control-label" for="text-input">Fecha de Expiración (Certificado Medico)</label>
                    <input type="date" v-model="per_fechaexpiracionA" class="form-control" :class="{ 'is-invalid' : $v.per_fechaexpiracionA.$error, 'is-valid':!$v.per_fechaexpiracionA.$invalid }">
                    <div class="invalid-feedback">
                        <span v-if="!$v.per_fechaexpiracionA.required">Este campo es Requerido</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="RenovarPersonal()">Generar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Modal Nuevo Nacionalidad -->
        <div class="modal fade" id="ModalNewNacionalidad">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title-aumentar"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Pais</label>
                      <input type="text" v-model="na_pais" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.na_pais.$error, 'is-valid':!$v.na_pais.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.na_pais.required">Este campo es Requerido</span>
                      </div>
                  </div>
                  <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Abreviatura</label>
                      <input type="text" v-model="na_abreviatura" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.na_abreviatura.$error, 'is-valid':!$v.na_abreviatura.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.na_abreviatura.required">Este campo es Requerido</span>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Nacionalidad</label>
                      <input type="text" v-model="na_nacionalidad" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.na_nacionalidad.$error, 'is-valid':!$v.na_nacionalidad.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.na_nacionalidad.required">Este campo es Requerido</span>
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="CrearNacionalidad()">Registrar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Modal Nuevo Entidad -->
        <div class="modal fade" id="ModalNewEntidad">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title-aumentar"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Pais</label>
                      <select class="form-control" v-model="en_pais" v-on:change="changeItem1(rowId, $event)" :class="{ 'is-invalid' : $v.en_pais.$error, 'is-valid':!$v.en_pais.$invalid }" disabled>
                          <option value="" disabled>SELECCIONE</option>
                          <option v-for="nacionalidad in arrayNacionalidad" :key="nacionalidad.id" :value="nacionalidad.id"  v-text="nacionalidad.pais"></option>
                      </select>
                      <div class="invalid-feedback">
                          <span v-if="!$v.en_pais.required">Este campo es Requerido</span>
                      </div>
                  </div>
                  <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Entidad</label>
                      <input type="text" v-model="en_entidad" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.en_entidad.$error, 'is-valid':!$v.en_entidad.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.en_entidad.required">Este campo es Requerido</span>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <label class="form-control-label" for="text-input">Sigla</label>
                      <input type="text" v-model="en_sigla" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.en_sigla.$error, 'is-valid':!$v.en_sigla.$invalid }">
                      <div class="invalid-feedback">
                          <span v-if="!$v.en_sigla.required">Este campo es Requerido</span>
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="CrearEntidad()">Registrar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
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
  import { required, between, minLength, maxLength, alpha, numeric, email, helpers} from "vuelidate/lib/validators";
  export default {
    data() {
      return {
        // INICIO VARIABLES DGAE
        
        currentStep: 1,
        per_foto : '',
        per_categoria : '',
        per_entidad : '',
        per_grado : '',
        per_ci : '',
        per_cm : '',
        per_nombre : '',
        per_appaterno : '',
        per_apmaterno : '',
        per_nacionalidad : '',
        per_sexo : '',
        per_celular : '',
        per_email : '',
        per_fechnac : '',
        per_direccion : '',
        per_titlic : '',
        per_habilitacion : '',
        per_comlinguistica : '',
        per_observaciones : '',
        // fechaemision : new Date(),
        per_fechaemision : new Intl.DateTimeFormat("az", {
          year: "numeric",
          day: "2-digit",
          month: "2-digit"
        }).format(new Date()),
        per_fechaexpiracion : '',

        doc_ci : '',
        doc_nacimiento : '',
        doc_egreso : '',
        doc_especializacion : '',
        doc_medico : '',
        doc_titulo : '',
        doc_libreta : '',
        doc_aprobacion : '',
  
        // per_fechaemision : new Date(),
        // per_fechaexpiracion : new Date(),
        per_id : '',
        per_fotoA : '',
        per_categoriaA : '',
        per_entidadA : '',
        per_gradoA : '',
        per_ciA : '',
        per_cmA : '',
        per_nombreA : '',
        per_appaternoA : '',
        per_apmaternoA : '',
        per_nacionalidadA : '',
        per_sexoA : '',
        per_celularA : '',
        per_emailA : '',
        per_fechnacA : '',
        per_direccionA : '',
        per_titlicA : '',
        per_habilitacionA : '',
        per_comlinguisticaA : '',
        per_observacionesA : '',
        per_fechaemisionA : new Intl.DateTimeFormat("az", {
    year: "numeric",
    day: "2-digit",
    month: "2-digit"
  }).format(new Date()),
        per_fechaexpiracionA : '',
        arrayCategoria : [],
        arrayEntidad : [],
        arrayGrado : [],
        arrayNacionalidad : [],
        arrayLicencia : [],
        arrayHabilitacion : [],
        arrayCompetenciaLinguistica : [],
        arraySexo : ['MASCULINO','FEMENINO'],
        arrayDatPer : [],
        arrayNacionalidadA : [],
        v : 0,
        vA : 0,
        vCI : 0,
  
        na_pais : '',
        na_abreviatura : '',
        na_nacionalidad : '',
        vNN : 0,
        en_pais : '',
        en_entidad : '',
        en_sigla : '',
        vNE : 0,
  
        // FIN VARIABLES DGAE
        arrayPersonal : [],
        arrayDatosFisicos: [],
        datos_fisicos : [],
        listaPersonal: [],
        criterio: "p.per_cm",
        buscar:"",
        setTiemoutBuscador: '',
        isHidden: true,
        datfis2 : 1,
  
          
        pagination: {
              'total'         :   0,
              'current_page'  :   0,
              'per_page'      :   0,
              'last_page'     :   0,
              'from'          :   0,
              'to'            :   0,
          },
      offset : 3,
      }
    },
  
    validations: {
            per_foto: { required },
            per_categoria: {required },
            per_nacionalidad: { required },
            per_entidad: { required },
            per_grado: { required },
            per_ci: { required },
            per_cm : { required },
            per_nombre : { required },
            per_sexo : { required },
            per_celular : { required },
            per_email : { required },
            per_fechnac : { required },
            per_direccion : { required },
            per_titlic : { required },
            per_habilitacion : { required },
            per_comlinguistica : { required },
            per_fechaemision: { required },
            per_fechaexpiracion: { required },

            doc_ci : { required },
            doc_nacimiento : { required },
            doc_titulo : { required },
            doc_aprobacion : { required },
            doc_egreso : { required },
            doc_especializacion : { required },
            doc_libreta : { required },
            doc_medico : { required },
  
            per_fotoA: { required },
            per_categoriaA : { required },
            per_nacionalidadA: { required },
            per_entidadA: { required },
            per_gradoA: { required },
            per_ciA: { required },
            per_cmA: { required },
            per_nombreA: { required },
            per_sexoA: { required },
            per_celularA: { required },
            per_emailA: { required },
            per_fechnacA: { required },
            per_direccionA: { required },
            per_titlicA: { required },
            per_habilitacionA: { required },
            per_comlinguisticaA: { required },
            per_habilitacionA : { required },
            per_comlinguisticaA : { required },
            per_fechaemisionA: { required },
            per_fechaexpiracionA: { required },
            per_observaciones : { required },
            observacion: { required },
  
            nombreA: { required },
            observacionA: { required },
  
            na_pais: { required },
            na_abreviatura: { required },
            na_nacionalidad: { required },
  
            en_pais: { required },
            en_entidad: { required },
            en_sigla: { required },
  
            validationGroupReg: [
            'per_foto',
            'per_categoria',
            'per_nacionalidad',
            'per_entidad',
            'per_grado',
            'per_ci',
            'per_cm',
            'per_nombre',
            'per_sexo',
            'per_celular',
            'per_email',
            'per_fechnac',
            'per_direccion',
            'per_titlic',
            'per_habilitacion',
            'per_comlinguistica',
            'per_fechaemision',
            'per_fechaexpiracion'],

            // validationGroupRenew: [
            // 'per_f
            // 'per_categoriotoA',aA',
            // 'per_nacionalidadA',
            // 'per_entidadA',
            // 'per_gradoA',
            // 'per_ciA',
            // 'per_cmA',
            // 'per_nombreA',
            // 'per_sexoA',
            // 'per_celularA',
            // 'per_emailA',
            // 'per_fechnacA',
            // 'per_direccionA',
            // 'per_titlicA',
            // 'per_habilitacionA',
            // 'per_comlinguisticaA',
            // 'per_fechaemisionA',
            // 'per_fechaexpiracionA'],
  
            validationGroupNewNacionalidad: [
            'na_pais',
            'na_abreviatura',
            'na_nacionalidad'],
  
            validationGroupNewEntidad: [
            'en_pais',
            'en_entidad',
            'en_sigla'],
            
            validationGroupDocument:[
            'doc_ci',
            'doc_nacimiento',
            'doc_titulo',
            'doc_aprobacion',
            'doc_egreso',
            'doc_especializacion',
            'doc_libreta',
            'doc_medico']
          },
  
   computed: {
          isActived   : function(){
              return this.pagination.current_page;
          },
          //creando funcion para calcular los elementos de la paginacion
          pagesNumber : function(){
              //si la pagina llega hasta la ultima pagina esta me va retornar un arrary vacio
              if(!this.pagination.to){
                  return [];
              }
  
              var from =  this.pagination.current_page - this.offset;
              if(from < 1){
                  from = 1;
              }
  
              var to = from + (this.offset * 2);
              if(to >= this.pagination.last_page){
                  to = this.pagination.last_page;
              }
  
              var pagesArray = [];
              while(from <= to){
                  pagesArray.push(from);
                  from++;
              }
              return pagesArray;
          },
          imagen(){
              return this.per_foto;
          },
          imagenA(){
              return this.per_fotoA;
          }
      },
    mounted() {
        this.NuevoPersonal();
      this.ListarPersonal(1);
    },
    methods: {

    //   obtenerCi(event) {
    //   this.doc_ci = event.target.files[0];
    // },

        Atras(){ //DGAE
            this.$router.push({
                name: "DatosPersonal",  
            });
        },

        nextStep() { //DGAE
          if (this.currentStep < 3) {
            // if(this.currentStep == 1){
            //     if(!this.$v.validationGroupReg.$invalid){
            //       this.currentStep++;
            //     }else{
            //         this.$v.validationGroupReg.$touch();
            //         Swal.fire({
            //             icon: 'warning',
            //             title: 'Ingrese todos los datos requeridos',
            //             showConfirmButton: false,
            //             timer: 2000
            //         })   
            //     }
            // }
            this.currentStep++;

            // if(this.currentStep == 2){
            //     if(!this.$v.validationGroupReg.$invalid){
            //       this.currentStep++;
            //     }else{
            //         this.$v.validationGroupReg.$touch();
            //         Swal.fire({
            //             icon: 'warning',
            //             title: 'Ingrese todos los datos requeridos',
            //             showConfirmButton: false,
            //             timer: 2000
            //         })   
            //     }
            // }
            // else{

            // }
            // this.currentStep++;
          }
        },

        previousStep() { //DGAE
          if (this.currentStep > 1) {
            this.currentStep--;
          }
        },
        handleSubmit() {
          // Aquí puedes manejar el envío del formulario
        //   console.log('Formulario enviado:', this.formData);
          // Realiza cualquier otra acción, como enviar los datos a un servidor
        },


        handleFileChange(event) {
      const file = event.target.files[0];
      if (!file) {
        this.selectedFile = null;
        this.errorMessage = 'No se seleccionó ningún archivo.';
        return;
      }
    },

    obtenerCi(e){
      try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.doc_ci = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.vCI = 1;
          } catch (error) {
              
          }
    },

    obtenerNacimiento(e){
      try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.doc_nacimiento = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.vNAC = 1;
          } catch (error) {
              
          }
    },

    obtenerEgreso(e){
      try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.doc_egreso = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.vNAC = 1;
          } catch (error) {
              
          }
    },

    obtenerEspecializacion(e){
      try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.doc_especializacion = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.vNAC = 1;
          } catch (error) {
              
          }
    },

    obtenerMedico(e){
      try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.doc_medico = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.vNAC = 1;
          } catch (error) {
              
          }
    },

    obtenerTitulo(e){
      try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.doc_titulo = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.vNAC = 1;
          } catch (error) {
              
          }
    },

    obtenerLibreta(e){
      try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.doc_libreta = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.vNAC = 1;
          } catch (error) {
              
          }
    },
    
    obtenerAprobacion(e){
      try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.doc_aprobacion = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.vNAC = 1;
          } catch (error) {
              
          }
    },
      obtenerImagen(e){
          try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.per_foto = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.v = 1;
          } catch (error) {
              
          }
      },

      obtenerImagenA(e){
          try {
              var fileReader = new FileReader();
  
              fileReader.onload = (e) => {
                  this.per_fotoA = e.target.result;
              }
              fileReader.readAsDataURL(e.target.files[0])
              this.vA = 1;
          } catch (error) {
              
          }
      },
  
      NuevoPersonal(){ //DGAE
        this.$v.validationGroupReg.$reset(),
        this.per_foto = '',
        this.per_categoria = '',
        this.per_nacionalidad = '',
        this.per_entidad = '',
        this.per_grado = '',
        this.per_ci = '',
        this.per_cm = '',
        this.per_nombre = '',
        this.per_appaterno = '',
        this.per_apmaterno = '',
        this.per_sexo = '',
        this.per_celular = '',
        this.per_email = '',
        this.per_fechnac = '',
        this.per_titlic = '',
        this.per_direccion = '',
        this.per_habilitacion = '',
        this.per_comlinguistica = '',
        this.per_observaciones = '',
        this.per_fechaexpiracion = '',
        this.v = 0,
        // $('#ModalNewPersonal').modal('show');
        // $(".modal-header").css("background-color", "#007bff");
        // $(".modal-header").css("color", "white" );
        // $(".modal-title-registro").text("Registro Personal");
        this.listarCategoria();
        this.listarNacionalidad();
        this.listarEntidad(this.per_nacionalidad);
        this.listarGrado(this.per_entidad);
        this.listarLicencia(this.per_entidad,this.per_categoria);
        this.listarHabilitacion(this.per_titlic);
        this.listarCompetenciaLinguistica()
      },
  
      EditarPersonal(personal){ //DGAE
        // this.$v.validationGroupRenew.$reset(),
        // this.per_id = personal.id,
        // this.per_fotoA = personal.per_foto,
        // this.per_categoriaA = personal.id_categoria,
        // this.per_nacionalidadA = personal.id_nacionalidad,
        // this.per_entidadA = personal.id_entidad,
        // this.per_gradoA = personal.id_grado,
        // this.per_ciA = personal.per_ci,
        // this.per_cmA = personal.per_cm,
        // this.per_nombreA = personal.per_nombre,
        // this.per_appaternoA = personal.per_paterno,
        // this.per_apmaternoA = personal.per_materno,
        // this.per_sexoA = personal.per_sexo,
        // this.per_celularA = personal.per_celular,
        // this.per_emailA = personal.per_mail,
        // this.per_fechnacA = personal.per_fecha_nacimiento,
        // this.per_direccionA = personal.per_direccion,
        // this.per_titlicA = personal.id_licencia,
        // this.per_habilitacionA = personal.id_habilitacion,
        // this.per_comlinguisticaA = personal.id_complinguistica,
        // this.per_observacionesA = personal.observacion,
        // // this.per_fechaemisionA = '',
        // this.per_fechaexpiracionA = '',
        // this.vA = 0,
        // $('#ModalRenewPersonal').modal('show');
        // $(".modal-header").css("background-color", "#007bff");
        // $(".modal-header").css("color", "white" );
        // $(".modal-title-registro").text("Renovación Personal");
        // this.listarCategoria();
        // this.listarNacionalidad();
        // this.listarEntidad(this.per_nacionalidadA);
        // this.listarGrado(this.per_entidadA);
        // this.listarLicencia(this.per_entidadA,this.per_categoriaA);
        // this.listarHabilitacion(this.per_titlicA);
        // this.listarCompetenciaLinguistica()
      },
  
      NuevaNacionalidad(){ //DGAE
        this.$v.validationGroupNewNacionalidad.$reset(),
        this.na_pais = '',
        this.na_abreviatura = '',
        this.na_nacionalidad = '',
        this.vNN = 0,
        $('#ModalNewNacionalidad').modal('show');
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title-aumentar").text("Nueva Nacionalidad");
        this.listarNacionalidad();
      },
  
      NuevaEntidad(){ //DGAE
        this.$v.validationGroupNewEntidad.$reset(),
        this.en_pais = this.per_nacionalidad,
        this.en_entidad = '',
        this.en_sigla = '',
        this.vNE = 0,
        $('#ModalNewEntidad').modal('show');
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title-aumentar").text("Nueva Entidad");
        this.listarNacionalidad();
        this.listarEntidad(this.per_nacionalidad);
      },
  
      CrearPersonal(){ //DGAE
        if(!this.$v.validationGroupDocument.$invalid){
          swal.fire({
              title: '¿Desea registrar?', // TITULO 
              icon: 'question', //ICONO (success, warnning, error, info, question)
              showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
              confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
              cancelButtonColor: '#868077', // COLOR DEL BOTON CANCELAR
              confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
              cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
              buttonsStyling: true,
              reverseButtons: true
              }).then((result) => {
              if (result.value) {
                  let me = this;
                  axios
                  .post("/crearPersonal", {
                    foto : me.per_foto,
                    categoria : me.per_categoria,
                    nacionalidad: me.per_nacionalidad,
                    entidad : me.per_entidad,
                    grado : me.per_grado,
                    ci : me.per_ci,
                    cm : me. per_cm,
                    nombre : me.per_nombre,
                    ap_paterno : me.per_appaterno,
                    ap_materno : me.per_apmaterno,
                    sexo : me.per_sexo,
                    celular : me.per_celular,
                    email : me.per_email,
                    fech_nac : me.per_fechnac,
                    direccion : me.per_direccion,
                    tit_licencia : me.per_titlic,
                    habilitacion : me.per_habilitacion,
                    linguistica : me.per_comlinguistica,
                    observacion : me.per_observaciones,
                    fech_emision : me.per_fechaemision,
                    fech_expiracion : me.per_fechaexpiracion
                  })
                  .then(function (response) {
                      
                      console.log(response);
                      swal.fire({
                          title: 'Se realizo el registro correctamente', //TITULO
                          // response.data.mensaje, //TEXTO DE MENSAJE
                          // response.data.tipo, // TIPO DE MODAL (success, warnning, error, info)
                          // response.personal
                      });
                      if (!response.data.code) {
                          // $('#NuevoUsuario').modal('hide');
                          // $('#ModalNewPersonal').modal('hide');
                          // me.nick = '';
                          // me.password = '';
                          me.arrayDatPer = response.data.personal;
                          me.GenerarCarnet(me.arrayDatPer.id_personal);
                          me.Atras();
                          me.ListarPersonal(1);
                          this.$v.$reset();
                      } 
                  })
                  .catch(function (error) {
                      // handle error
                      console.log(error);
                  })
              }else{
                    swal.fire(
                      "Informacion", //TITULO
                      "Solicitud cancelada.", //TEXTO DE MENSAJE
                      "info" // TIPO DE MODAL (success, warnning, error, info)
                  );
              }
          })
        }else{
            this.$v.validationGroupDocument.$touch();
            Swal.fire({
                icon: 'warning',
                title: 'Ingrese todos los datos requeridos',
                showConfirmButton: false,
                timer: 2000
            })
            
        }
      },
  
      RenovarPersonal(){ //DGAE
        if(!this.$v.validationGroupRenew.$invalid){
          swal.fire({
              title: '¿Desea Renovar?', // TITULO 
              icon: 'question', //ICONO (success, warnning, error, info, question)
              showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
              confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
              cancelButtonColor: '#868077', // COLOR DEL BOTON CANCELAR
              confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
              cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
              buttonsStyling: true,
              reverseButtons: true
              }).then((result) => {
              if (result.value) {
                  let me = this;
                  axios
                  .post("/renovarPersonal", {
                    id_personal : me.per_id,
                    foto : me.per_fotoA,
                    categoria : me.per_categoriaA,
                    nacionalidad: me.per_nacionalidadA,
                    entidad : me.per_entidadA,
                    grado : me.per_gradoA,
                    ci : me.per_ciA,
                    cm : me.per_cmA,
                    nombre : me.per_nombreA,
                    ap_paterno : me.per_appaternoA,
                    ap_materno : me.per_apmaternoA,
                    sexo : me.per_sexoA,
                    celular : me.per_celularA,
                    email : me.per_emailA,
                    fech_nac : me.per_fechnacA,
                    direccion : me.per_direccionA,
                    tit_licencia : me.per_titlicA,
                    habilitacion : me.per_habilitacionA,
                    linguistica : me.per_comlinguisticaA,
                    observacion : me.per_observacionesA,
                    fech_emision : me.per_fechaemisionA,
                    fech_expiracion : me.per_fechaexpiracionA
                  })
                  .then(function (response) {
                      
                      console.log(response);
                      swal.fire({
                          title: 'Se realizo el renovación correctamente', //TITULO
                          // response.data.mensaje, //TEXTO DE MENSAJE
                          // response.data.tipo, // TIPO DE MODAL (success, warnning, error, info)
                          // response.personal_foto
                      });
                      if (!response.data.code) {
                          // $('#NuevoUsuario').modal('hide');
                          $('#ModalRenewPersonal').modal('hide');
                          // me.nick = '';
                          // me.password = '';
                          me.arrayDatPer = response.data.personal;
                          me.GenerarCarnet(me.arrayDatPer.id_personal);
                          me.ListarPersonal(1);
                          this.$v.$reset();
                      } 
                  })
                  .catch(function (error) {
                      // handle error
                      console.log(error);
                  })
              }else{
                    swal.fire(
                      "Informacion", //TITULO
                      "Solicitud cancelada.", //TEXTO DE MENSAJE
                      "info" // TIPO DE MODAL (success, warnning, error, info)
                  );
              }
          })
        }else{
            this.$v.validationGroupRenew.$touch();
            Swal.fire({
                icon: 'warning',
                title: 'Ingrese todos los datos requeridos',
                showConfirmButton: false,
                timer: 2000
            })
            
        }
      },
  
      CrearNacionalidad(){ //DGAE
        if(!this.$v.validationGroupNewNacionalidad.$invalid){
          swal.fire({
              title: '¿Desea registrar?', // TITULO 
              icon: 'question', //ICONO (success, warnning, error, info, question)
              showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
              confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
              cancelButtonColor: '#868077', // COLOR DEL BOTON CANCELAR
              confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
              cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
              buttonsStyling: true,
              reverseButtons: true
              }).then((result) => {
              if (result.value) {
                  let me = this;
                  axios
                  .post("/crearNacionalidad", {
                    pais : me.na_pais,
                    nacionalidad: me.na_nacionalidad,
                    abreviatura : me.na_abreviatura,
                  })
                  .then(function (response) {
                      
                      console.log(response);
                      swal.fire({
                          title: 'Se realizo el registro correctamente', //TITULO
                          // response.data.mensaje, //TEXTO DE MENSAJE
                          // response.data.tipo, // TIPO DE MODAL (success, warnning, error, info)
                          // response.personal
                      });
                      // this.listarNacionalidad();
                      if (!response.data.code) {
                          // $('#NuevoUsuario').modal('hide');
                          $('#ModalNewNacionalidad').modal('hide');
                          me.listarNacionalidad();
                          // me.nick = '';
                          // me.password = '';
                          this.$v.$reset();
                      } 
                  })
                  .catch(function (error) {
                      // handle error
                      console.log(error);
                  })
              }else{
                    swal.fire(
                      "Informacion", //TITULO
                      "Solicitud cancelada.", //TEXTO DE MENSAJE
                      "info" // TIPO DE MODAL (success, warnning, error, info)
                  );
              }
          })
        }else{
            this.$v.validationGroupNewNacionalidad.$touch();
            Swal.fire({
                icon: 'warning',
                title: 'Ingrese todos los datos requeridos',
                showConfirmButton: false,
                timer: 2000
            })
            
        }
      },
  
      CrearEntidad(){ //DGAE
        if(!this.$v.validationGroupNewEntidad.$invalid){
          swal.fire({
              title: '¿Desea registrar?', // TITULO 
              icon: 'question', //ICONO (success, warnning, error, info, question)
              showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
              confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
              cancelButtonColor: '#868077', // COLOR DEL BOTON CANCELAR
              confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
              cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
              buttonsStyling: true,
              reverseButtons: true
              }).then((result) => {
              if (result.value) {
                  let me = this;
                  axios
                  .post("/crearEntidad", {
                    pais : me.en_pais,
                    entidad: me.en_entidad,
                    sigla : me.en_sigla,
                  })
                  .then(function (response) {
                      
                      console.log(response);
                      swal.fire({
                          title: 'Se realizo el registro correctamente', //TITULO
                          // response.data.mensaje, //TEXTO DE MENSAJE
                          // response.data.tipo, // TIPO DE MODAL (success, warnning, error, info)
                          // response.personal
                      });
                      // this.listarNacionalidad();
                      if (!response.data.code) {
                          // $('#NuevoUsuario').modal('hide');
                          $('#ModalNewEntidad').modal('hide');
                          me.listarEntidad(me.per_nacionalidad);
                          // me.nick = '';
                          // me.password = '';
                          this.$v.$reset();
                      } 
                  })
                  .catch(function (error) {
                      // handle error
                      console.log(error);
                  })
              }else{
                    swal.fire(
                      "Informacion", //TITULO
                      "Solicitud cancelada.", //TEXTO DE MENSAJE
                      "info" // TIPO DE MODAL (success, warnning, error, info)
                  );
              }
          })
        }else{
            this.$v.validationGroupNewEntidad.$touch();
            Swal.fire({
                icon: 'warning',
                title: 'Ingrese todos los datos requeridos',
                showConfirmButton: false,
                timer: 2000
            })
            
        }
      },
  
      ListarPersonal(page){
              let me = this;
              axios
              .post("/listarPersonal", {
                  page: page,
                  buscar: me.buscar.toUpperCase(),
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
  
          listarCategoria(){ //DGAE
              let me = this;
              axios
            .post("/listarCategoria", {
            })
            .then(function (response) {
             me.arrayCategoria = response.data.categorias
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
          },
  
          listarNacionalidad(){ //DGAE
              let me = this;
              axios
            .post("/listarNacionalidad", {
            })
            .then(function (response) {
             me.arrayNacionalidad = response.data.nacionalidades
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
          },
  
          // selectNacionalidad(nacionalidad){ //DGAE
          //     let me = this;
          //     axios
          //   .post("/selectNacionalidad", {
          //     id_nacionalidadA : nacionalidad,
          //   })
          //   .then(function (response) {
          //    me.arrayNacionalidadA = response.data.nacionalidades
          //   })
          //   .catch(function (error) {
          //     // handle error
          //     console.log(error);
          //   })
          // },
  
          listarEntidad(nacionalidad){ //DGAE
              let me = this;
              axios
            .post("/listarEntidad", {
              id_nacionalidad : nacionalidad,
            })
            .then(function (response) {
             me.arrayEntidad = response.data.entidades
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
          },
  
          listarGrado(entidad){ //DGAE
              let me = this;
              axios
            .post("/listarGrado", {
              id_entidad : entidad,
            })
            .then(function (response) {
             me.arrayGrado = response.data.grados
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
          },
  
          listarLicencia(entidad,categoria){ //DGAE
              let me = this;
              axios
            .post("/listarLicencia", {
              id_entidad : entidad,
              id_categoria : categoria
            })
            .then(function (response) {
             me.arrayLicencia = response.data.licencias
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
          },
  
          listarHabilitacion(licencia){ //DGAE
              let me = this;
              axios
            .post("/listarHabilitacion", {
              id_titlicencia : licencia,
            })
            .then(function (response) {
             me.arrayHabilitacion = response.data.habilitaciones
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
          },
  
          listarCompetenciaLinguistica(){ //DGAE
              let me = this;
              axios
            .post("/listarCompetenciaLinguistica", {
            })
            .then(function (response) {
             me.arrayCompetenciaLinguistica = response.data.comp_linguisticas
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
          },
  
          BuscarPersona(){ //DGAE
              clearTimeout(this.setTiemoutBuscador);
              this.setTiemoutBuscador = setTimeout(() => {
                  this.ListarPersonal(1)
              }, 360)
          },
  
  
          GenerarCarnet(id_personal){ //DGAE
              // this.$v.$reset();
              // if(!this.$v.$invalid){
              // window.open('http://sipefab.fab.bo/certificadoDestAscenso?id_p='+id_personal);
              window.open('http://127.0.0.1:8000/carnet?id_p='+id_personal);
              // }else{
              //     this.$v.$touch();
              //     Swal.fire({
              //         icon: 'warning',
              //         title: 'Ingrese todos los datos requeridos',
              //         showConfirmButton: false,
              //         timer: 2000
              //     })
                  
              // }
          },
  
      EnvioDatos(datos){
        this.$router.push({
            name: "Personal_datos",
            //ENVIO DE DATOS
            params:{
                e: datos
            }
            
        });
      } 
    },
  };
  
  </script>
  
  <style>
  /* Agregar estilos para el formulario */
  .step {
      /* display: none; */
    }
    .step.active {
      /* display: block; */
    }
  </style>