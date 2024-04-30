<template>
    <div>
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">            
              <h1>
                <i class="far fa-registered"></i>&nbsp;
                RENOVAR PERSONAL
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
                      <button class="btn btn-danger btn-sm float-right" type="submit" @click="Atras()">
                        <i class="fas fa-arrow-left"></i>&nbsp; ATRAS
                      </button>
                    </div>
                  </div>  
                </div>
                <div class="card-body">
                    <form>
                        <!-- Paso 1 -->
                        <div class="step" v-if="currentStep === 1">
                            <h3><i class="fas fa-inbox"></i>&nbsp;PASO 1: INFORMACIÓN PERSONAL</h3>
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
                                        <span v-else-if="!$v.per_nombre.letrasSpanish">Solo letras</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Ap. Paterno</label>
                                    <input type="text" v-model.trim="per_appaterno" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_appaterno.$error, 'is-valid':!$v.per_appaterno.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_appaterno.required && !$v.per_appaterno.letrasSpanish">Solo letras o Vacio</span>
                                        <span v-else-if="!$v.per_appaterno.letrasSpanish">Solo letras</span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Ap. Materno</label>
                                    <input type="text" v-model.trim="per_apmaterno" class="form-control" style="text-transform:uppercase;" :class="{ 'is-invalid' : $v.per_apmaterno.$error, 'is-valid':!$v.per_apmaterno.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_apmaterno.required && !$v.per_apmaterno.letrasSpanish">Solo letras o Vacio</span>
                                        <span v-else-if="!$v.per_apmaterno.letrasSpanish">Solo letras</span>
                                    </div>
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
                                        <span v-else-if="!$v.per_celular.numeric">Solo digitos</span>
                                        <span v-else-if="!$v.per_celular.length">Debe contener 8 digitos</span>
                                    </div>
                                </div>                            
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">E-mail </label>
                                    <input type="text" v-model.trim="per_email" class="form-control" :class="{ 'is-invalid' : $v.per_email.$error, 'is-valid':!$v.per_email.$invalid }">
                                    <div class="invalid-feedback">
                                        <span v-if="!$v.per_email.required">Este campo es Requerido</span>
                                        <span v-else-if="!$v.per_email.email">Email Incorrecto</span>
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
                                            <img :src="'/img/personal/'+imagen" width="150px" height="150px" style="border: 1.5px solid black; text-align: center">
                                        </template>
                                        <template v-else>
                                            <img :src="imagen" width="150px" height="150px" style="border: 1.5px solid black; text-align: center">
                                        </template> 
                                    </div>                       
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="text-input">Fotografia</label>
                                    <input type="file" class="form-control" @change="obtenerImagen" accept="image/*" v-bind:class="{ 'is-invalid': $v.per_foto.$error, 'is-valid':!$v.per_foto.$invalid }">
                                    <div class="invalid-feedback">
                                        <div v-if="!$v.per_foto.required">Por favor, carga un archivo.</div>
                                    </div>
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
                            <h3><i class="far fa-folder"></i>&nbsp;PASO 2: DOCUMENTACIÓN PERSONAL</h3>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-12" style="background-color:gold;">
                                    <label class="form-control-label" for="text-input">LOS DOCUMENTOS DEBEN ESTAR EN FORMATO PDF <i class="fa fa-file-pdf"></i>.</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="form-control-label" for="text-input">GRADO Y NOMBRE: {{per_grado_abreviatura}} {{per_nombre}} {{per_appaterno}} {{per_apmaterno}}</label>
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
                                            <td class="text-center">
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
                                            <td class="text-center">
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
                                            <td class="text-center">
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
                                            <td class="text-center">
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
                                            <td class="text-center">
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
                                            <td class="text-center">
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
                                            <td class="text-center">
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
                                            <td class="text-center">
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
                                <button type="button" class="btn btn-danger" @click="RenovarPersonal()"><i class="fas fa-address-card"></i>&nbsp; GUARDAR/GENERAR</button>
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
      </section>
      <!-- /.content -->
    </div>
  </template>
  
  <script>
  import { required, between, minLength, maxLength, alpha, numeric, email, helpers, date} from "vuelidate/lib/validators";
  export default {
    data() {
      return {
        // INICIO VARIABLES DGAE
        personal_id : this.$route.params.personalid,

        currentStep: 1,
        per_foto : '',
        per_categoria : '',
        per_entidad : '',
        per_grado : '',
        per_grado_abreviatura : '',
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

        arrayDatosPersonal : [],

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
            per_nombre : { required, letrasSpanish: value => /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ ]+$/.test(value) },
            per_appaterno : { letrasSpanishVacio: value => !value || /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ ]+$/.test(value) },
            per_apmaterno : { letrasSpanishVacio: value => !value || /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ ]+$/.test(value) },  
            per_sexo : { required },
            per_celular : { required, numeric, hasSpecificLength: value => value && value.toString().length === 8 },
            per_email : { required, email},
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
  
            validationGroupReg: [
            'per_foto',
            'per_categoria',
            'per_nacionalidad',
            'per_entidad',
            'per_grado',
            'per_ci',
            'per_cm',
            'per_nombre',
            'per_appaterno',
            'per_apmaterno',
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
      },
    mounted() {
        this.DatosPersonal(this.personal_id)
        // this.EditarPersonal(this.array);
    },
    methods: {

        DatosPersonal(personal_id){ //DGAE
            let me = this;
            axios
            .post("/datosPersonal", {
                personal_id: personal_id,
            })
            .then(function (response) {
                me.arrayDatosPersonal = response.data.personal;
                me.EditarPersonal(me.arrayDatosPersonal);
                // me.obtenerImagen();
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        Atras(){ //DGAE
            this.$router.push({
                name: "DatosPersonal",  
            });
        },

        nextStep() { //DGAE
          if (this.currentStep < 3) {
            if(this.currentStep == 1){
                if(!this.$v.validationGroupReg.$invalid){
                  this.currentStep++;
                }else{
                    this.$v.validationGroupReg.$touch();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Ingrese todos los datos requeridos',
                        showConfirmButton: false,
                        timer: 2000
                    })   
                }
            }
          }
        },

        previousStep() { //DGAE
          if (this.currentStep > 1) {
            this.currentStep--;
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
  
        EditarPersonal(personal){ //DGAE
            this.$v.validationGroupReg.$reset(),
            this.per_foto = personal.per_foto,
            this.per_categoria = personal.id_categoria,
            this.per_nacionalidad = personal.idnacionalidad,
            this.per_entidad = personal.id_entidad,
            this.per_grado = personal.id_grado,
            this.per_grado_abreviatura = personal.abreviatura,
            this.per_ci = personal.per_ci,
            this.per_cm = personal.per_cm,
            this.per_nombre = personal.per_nombre,
            this.per_appaterno = personal.per_paterno,
            this.per_apmaterno = personal.per_materno,
            this.per_sexo = personal.per_sexo,
            this.per_celular = personal.per_celular,
            this.per_email = personal.per_mail,
            this.per_fechnac = personal.per_fecha_nacimiento,
            this.per_titlic = personal.id_licencia,
            this.per_direccion = personal.per_direccion,
            this.per_habilitacion = personal.id_habilitacion,
            this.per_comlinguistica = personal.id_comp_linguistica,
            this.per_observaciones = '',
            this.per_fechaexpiracion = '',
            this.doc_ci = '',
            this.doc_nacimiento = '',
            this.doc_titulo = '',
            this.doc_aprobacion = '',
            this.doc_egreso = '',
            this.doc_especializacion = '',
            this.doc_libreta = '',
            this.doc_medico = '',
            this.v = 0,
            this.listarCategoria();
            this.listarNacionalidad();
            this.listarEntidad(this.per_nacionalidad);
            this.listarGrado(this.per_entidad);
            this.listarLicencia(this.per_entidad,this.per_categoria);
            this.listarHabilitacion(this.per_titlic);
            this.listarCompetenciaLinguistica()
        },
  
        RenovarPersonal(){ //DGAE
            if(!this.$v.validationGroupDocument.$invalid){
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
                        id_personal : me.personal_id,
                        foto : me.per_foto,
                        categoria : me.per_categoria,
                        nacionalidad: me.per_nacionalidad,
                        entidad : me.per_entidad,
                        grado : me.per_grado,
                        ci : me.per_ci,
                        cm : me.per_cm,
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
                            title: 'Se realizo el renovación correctamente', //TITULO
                            // response.data.mensaje, //TEXTO DE MENSAJE
                            // response.data.tipo, // TIPO DE MODAL (success, warnning, error, info)
                            // response.personal_foto
                        });
                        if (!response.data.code) {
                            // $('#NuevoUsuario').modal('hide');
                            // $('#ModalRenewPersonal').modal('hide');
                            // me.nick = '';
                            // me.password = '';
                            me.arrayDatPer = response.data.personal;
                            //   me.GenerarCarnet(me.arrayDatPer.id_personal);
                            me.GenerarCarnet(me.personal_id);
                            me.Atras();
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

    },
  };
  
  </script>
  
  <style>
  </style>