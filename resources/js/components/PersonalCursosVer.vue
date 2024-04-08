<template>
    <main>
        <section class="content-header">
            <h1><i class="far fa-bookmark"></i> Listado de Cursos del Personal</h1>
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
                                        <img :src="'../img/personal/'+datos.foto" width="100%" height="60%">
                                    </div>
                                    <div class="col-md-10 d-flex align-items-center">
                                        <div style="" class="col-md-12 d-flex flex-column bd-highlight mb-3">
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">GRADOS Y NOMBRES</dt>
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
                                            <div class="row p-2 bd-highlight">
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">CARNET DE IDENTIDAD</dt>
                                                        <dd class="st">{{ datos.ci }} {{ datos.expedido }}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-6">
                                                    <dl>
                                                        <dt class="st">SITUACION MILITAR ACTUAL</dt>
                                                        <dd class="st">{{ datos.nombsit }} - {{datos.nombsub}} - {{datos.nombdet}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="row p-2 bd-highlight justify-content-center">
                                                <div v-if="$auth.can('create-percur')" class="col-md-4">
                                                    <button type="button" class="btn btn-sm btn-primary btn-block" style="margin-right: 5px;" title="Registrar Curso" @click="abrirCrear(per_codigo)">
                                                        <i class="fas fa-plus" aria-hidden="true"></i> Nuevo Curso
                                                    </button>
                                                </div>
                                                <div v-if="$auth.can('report-pdfpercur')" class="col-md-4">
                                                    <button class="btn btn-sm btn-secondary btn-block" @click.prevent="gendocpersonalcurso(per_codigo)">
                                                        <i class="far fa-file-alt" aria-hidden="true"></i> Generar PDF
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <router-link type="button" class="btn btn-sm btn-danger btn-block position-reverse" :to="'/PersonalCursos/'">
                                                        <i class="fas fa-reply"></i> Volver Atrás
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="table-wrapper-scroll-y my-customscrollbar" style="font-size:13px;">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:100px; text-align:center">Acciones</th>
                                                <th style="width:100px; text-align:center">Descripción</th>
                                                <th style="width:100px; text-align:center">Fecha Inicio</th>
                                                <th style="width:100px; text-align:center">Fecha Fin</th>
                                                <th style="width:100px; text-align:center">Tipo Doc.</th>
                                                <th style="width:100px; text-align:center">Nro. Doc.</th>
                                                <th style="width:100px; text-align:center">Fecha Otorgado</th>
                                                <th style="width:100px; text-align:center">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(pc, index) in personal_cursos" :key="index">
                                                <td  style="width:100px; text-align:center">
                                                    <template v-if="pc.estado == '1'">
                                                        <button v-if="$auth.can('edit-percur')" type="button" class="btn btn-warning btn-sm" title="Modificar Curso"
                                                            @click="abrirEditar(pc)">
                                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                                        </button>
                                                        <button v-if="$auth.can('delete-percur')" class="btn btn-flat btn-danger btn-sm" @click.prevent="CambiarEstado(1, pc.idPerCur)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </template>
                                                    <template v-else>
                                                        <button v-if="$auth.can('delete-percur')" class="btn btn-flat btn-secondary btn-sm" @click.prevent="CambiarEstado(2, pc.idPerCur)">
                                                            <i class="far fa-times-circle"></i>
                                                        </button>
                                                    </template>
                                                </td>
                                                <td v-text="pc.descripcion"></td>
                                                <td v-text="since(pc.fec_inicio)"></td>
                                                <td v-text="since(pc.fec_final)"></td>
                                                <td v-text="pc.documento"></td>
                                                <td v-text="pc.nro_doc"></td>
                                                <td v-text="since(pc.fecha_otorgacion)"></td>
                                                <td style="width:100px; text-align:center">
                                                    <div v-if="pc.estado">
                                                        <span class="badge badge-success">Actual</span>
                                                    </div>
                                                    <div v-else>
                                                        <span class="badge badge-danger">Anterior</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                        </div>
                    </div>
                </div>
            </div>

             <!-- Modal Registro -->
            <div class="modal fade" id="RegistrarPersonalCursos" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Curso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form role="form" >
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="cur_cod">Curso</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="cur_cod" v-on:change="changeItem1(rowId, $event)"
                                                :class="{ 'is-invalid' : $v.cur_cod.$error, 'is-valid':!$v.cur_cod.$invalid }">
                                                <option v-for="curso in cursos" :key="curso.id" :value="curso.id" v-text="curso.nombrecurso"></option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.cur_cod.required">Debe seleccionar un curso</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="tipcur_cod">Tipo Curso</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="tipcur_cod" v-on:change="changeItem2(rowId, $event)" :disabled="estado"
                                                :class="{ 'is-invalid' : $v.tipcur_cod.$error, 'is-valid':!$v.tipcur_cod.$invalid }">
                                                <option v-for="tipo_cursos in listarTipoCursos" :key="tipo_cursos.id" :value="tipo_cursos.id" v-text="tipo_cursos.nombretipocurso"></option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.tipcur_cod.required">Debe seleccionar un tipo curso</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="desglocurso">Desglose Curso</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="desglo_cod" :disabled="estado1"
                                                :class="{ 'is-invalid' : $v.desglo_cod.$error, 'is-valid':!$v.desglo_cod.$invalid }">
                                                <option v-for="desglo_cursos in listarDesgloCursos" :key="desglo_cursos.id" :value="desglo_cursos.id" v-text="desglo_cursos.nombredesglocurso"></option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.desglo_cod.required">Debe seleccionar un desglose curso</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="emi_cod">Emisor</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="emi_cod" v-on:change="changeItem3(rowId, $event)"
                                                :class="{ 'is-invalid' : $v.emi_cod.$error, 'is-valid':!$v.emi_cod.$invalid }">
                                                <option v-for="emisor in emisores" :key="emisor.id" :value="emisor.id" v-text="emisor.nombreemisor"></option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.emi_cod.required">Debe seleccionar un emisor</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="tipemi_cod">Tipo Emisor</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="tipemi_cod" :disabled="estado2" :class="{ 'is-invalid' : $v.tipemi_cod.$error, 'is-valid':!$v.tipemi_cod.$invalid }">
                                                <option v-for="tipo_emisores in listarTipoEmisores" :key="tipo_emisores.id" :value="tipo_emisores.id" v-text="tipo_emisores.nombretipoemisor"></option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.emi_cod.required">Debe seleccionar un tipo emisor</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="descripcion">Descripción</label>
                                        <div class="col-md-9 col-form-control">
                                            <input type="text" class="form-control" v-model="descripcion"
                                            onkeypress="return letynum(event)" onpaste="return false"
                                            :class="{ 'is-invalid' : $v.descripcion.$error, 'is-valid':!$v.descripcion.$invalid }"
                                            placeholder="Introduzca una descripción del curso">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.descripcion.required">Debe introducir una descripcion del curso</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="fec_inicio">Fecha Inicio</label>
                                        <div class="col-md-9 col-form-control">
                                            <date-picker style="width: 100%; max-width:100;" value-type="date" format="DD/MM/YYYY"
                                                v-model="fec_inicio" :disabled-date="fechaactual"
                                                :class="{ 'is-invalid' : $v.fec_inicio.$error, 'is-valid':!$v.fec_inicio.$invalid }">
                                            </date-picker>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.fec_inicio.required">Debe introducir una fecha</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="fec_final">Fecha Fin</label>
                                        <div class="col-md-9 col-form-control">
                                            <date-picker style="width: 100%; max-width:100;" value-type="date" format="DD/MM/YYYY"
                                                v-model="fec_final" :disabled-date="fechaactual"
                                                :class="{ 'is-invalid' : $v.fec_final.$error, 'is-valid':!$v.fec_final.$invalid }">
                                            </date-picker>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.fec_final.required">Debe introducir una fecha</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="lugar">Lugar</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="lugar"
                                            onkeypress="return sololetras(event)" onpaste="return false"
                                            placeholder="La Paz, Santa Cruz, etc..."
                                            :class="{ 'is-invalid' : $v.lugar.$error, 'is-valid':!$v.lugar.$invalid }">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.lugar.required">Debe introducir una fecha</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="documento">Tipo de Documento</label>
                                        <div class="col-md-9">
                                            <v-select :options="opti" v-model="documento" :class="{ 'is-invalid' : $v.documento.$error, 'is-valid':!$v.documento.$invalid }">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                </template>
                                                <em v-else>
                                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.documento.required">Debe introducir una fecha</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="fecha_otorgacion">Fecha Otorgación</label>
                                        <div class="col-md-9 col-form-control">
                                            <date-picker style="width: 100%; max-width:100;" value-type="date" format="DD/MM/YYYY"
                                                v-model="fecha_otorgacion" :disabled-date="fechaactual"
                                                :class="{ 'is-invalid' : $v.fecha_otorgacion.$error, 'is-valid':!$v.fecha_otorgacion.$invalid }">
                                            </date-picker>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.fecha_otorgacion.required">Debe introducir una fecha</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="nro_doc">Nro. Documento</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="nro_doc" onkeypress="return solonumeros(event)"
                                            onpaste="return false" maxlength="8" min="000/0000" placeholder="00/00"
                                            :class="{ 'is-invalid' : $v.nro_doc.$error, 'is-valid':!$v.nro_doc.$invalid }">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.nro_doc.required">Debe introducir una fecha</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Periodo</label>
                                        <div class="col-md-9">
                                            <v-select :options="perioptn" v-model="periodo" :class="{ 'is-invalid' : $v.periodo.$error, 'is-valid':!$v.periodo.$invalid }">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                </template>
                                                <em v-else>
                                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.periodo.required">Debe introducir un periodo</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Antigüedad</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" @keypress="onlyNumber" v-model="antiguedad" onpaste="return false"
                                            maxlength="3" min="000/000" placeholder="0" :class="{ 'is-invalid' : $v.antiguedad.$error, 'is-valid':!$v.antiguedad.$invalid }">
                                            <div class="invalid-feedback">
                                                <span v-if="!$v.antiguedad.required">Debe introducir la antigüedad</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="costo">Costo</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="costo" @keypress="onlyNumber" onpaste="return false" maxlength="4" min="000/000" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="observacion">Observación</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="observacion" onkeypress="return letynum(event)">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" v-model="per_codigo">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click.prevent="RegistrarPersonalCursos()">Registrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Registro Cursos del Personal</h5>
                                        <button class="close" @click="abrirModal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError" :key="index" v-text="item"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" @click="abrirModal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Editar -->
            <div class="modal fade" id="EditarPersonalCursos" data-backdrop="static">
                <div class="modal-dialog modal-lg" data-backdrop="static">
                    <div class="modal-content" data-backdrop="static">
                        <div class="modal-header">
                            <h4 class="modal-title">Modificar Curso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form role="form" >
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="cur_codA">Curso</label>
                                        <div class="col-md-9">
                                            <v-select label="nombrecurso" :options="cursos" v-model="cur_codA" @input="changeTypeCourse">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{
                                                    search}}</em>.
                                                </template>
                                                <em v-else>Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="tipcur_codA">Tipo Curso</label>
                                        <div class="col-md-9">
                                            <v-select label="nombretipocurso" :options="listarTipoCursos" v-model="tipcur_codA" @input="changeDesgloCourse">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{
                                                    search}}</em>.
                                                </template>
                                                <em v-else>Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="desglo_codA">Desglose Curso</label>
                                        <div class="col-md-9">
                                            <v-select label="nombredesglocurso" :options="listarDesgloCursos" v-model="desglo_codA">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{
                                                    search}}</em>.
                                                </template>
                                                <em v-else>Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="emi_codA">Emisor</label>
                                        <div class="col-md-9">
                                            <v-select label="nombreemisor" :options="emisores" v-model="emi_codA" @input="changeTypeEmisor">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{
                                                    search}}</em>.
                                                </template>
                                                <em v-else>Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="tipemi_codA">Tipo Emisor</label>
                                        <div class="col-md-9">
                                            <v-select label="nombretipoemisor" :options="listarTipoEmisores" v-model="tipemi_codA">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{
                                                    search}}</em>.
                                                </template>
                                                <em v-else>Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="descripcionA">Descripción</label>
                                        <div class="col-md-9 col-form-control">
                                            <input type="text" class="form-control" v-model="descripcionA" onkeypress="return letynum(event)" onpaste="return false" placeholder="Introduzca una descripción del curso">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="fec_inicioA">Fecha Inicio</label>
                                        <div class="col-md-9 col-form-control">
                                            <input type="date" format='DD-MM-YYYY' class="form-control" v-model="fec_inicioA" onkeydown="return false" min="1920-01-01" max="2022-12-31">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="fec_finalA">Fecha Fin</label>
                                        <div class="col-md-9 col-form-control">
                                            <input type="date" format='DD-MM-YYYY' class="form-control" v-model="fec_finalA" onkeydown="return false" min="1920-01-01" max="2022-12-31">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="lugarA">Lugar</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="lugarA" onkeypress="return sololetras(event)" onpaste="return false" maxlength="8" min="000/0000" placeholder="La Paz, Santa Cruz, etc...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="documentoA">Tipo de Documento</label>
                                        <div class="col-md-9">
                                            <v-select :options="opti" v-model="documentoA">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                </template>
                                                <em v-else>
                                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="fecha_otorgacionA">Fecha Otorgación</label>
                                        <div class="col-md-9 col-form-control">
                                            <input type="date" format='DD-MM-YYYY' class="form-control" v-model="fecha_otorgacionA" onkeydown="return false" min="1920-01-01" max="2021-12-31">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="nro_docA">Nro. Documento</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="nro_docA" onkeypress="return solonumeros(event)" onpaste="return false" maxlength="8" min="000/0000" placeholder="00/00">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Periodo</label>
                                        <div class="col-md-9">
                                            <v-select :options="perioptn" v-model="periodoA">
                                                <template v-slot:no-options="{ search, searching }">
                                                <template v-if="searching">
                                                    Lo sentimos, no hay opciones de coincidencia.<em>{{search}}</em>.
                                                </template>
                                                <em v-else>
                                                    Lo sentimos, no hay opciones de coincidencia.</em>
                                                </template>
                                            </v-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Antigüedad</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" @keypress="onlyNumber" v-model="antiguedadA" onpaste="return false">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="costoA">Costo</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="costoA" onkeypress="return solonum(event)" onpaste="return false" maxlength="8" min="000/0000" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="observacionA">Observación</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control content" v-model="observacionA" onkeypress="return letynum(event)">
                                        </div>
                                    </div>
                                </div>
                                <input type="text" hidden v-model="per_codigo">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click.prevent="EditarPersonalCursos()">Actualizar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modificar Cursos del Personal</h5>
                                        <button class="close" @click="abrirModal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError" :key="index" v-text="item"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" @click="abrirModal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>

import moment from 'moment';

//Validación Vuelidate
import { required } from "vuelidate/lib/validators";

export default {
    data: function() {
        const today = new Date();
        return {
            per_codigo: this.$route.params.id,
            datos: [],
            personal_cursos:[],
            modalShow: false,
            mostrarModal:{
                display: 'block',
                background: '#0000006b',
            },
            ocultarModal:{
                display: 'none',
            },
            error: 0,
            mensajeError: [],

            //crear un nuevo registro
            cursos:[],
            cur_cod: "",
            rowId:0,
            tipcur_cod:"",
            estado: true,
            desglo_cod:"",
            estado1: true,
            emisores:[],
            emi_cod:"",
            tipemi_cod:"",
            estado2: true,
            descripcion: "",
            fec_inicio: "",
            fec_final: "",
            lugar: "",
            documento:"",
            perioptn: [
                {
                value: 'PRIMER SEMESTRE',
                label: 'PRIMER SEMESTRE'
                }, {
                value: 'SEGUNDO SEMESTRE',
                label: 'SEGUNDO SEMESTRE'
                }, {
                value: 'ANUAL',
                label: 'ANUAL'
                }
            ],
            periodo: '',
            antiguedad: '',
            opti: [
                {
                value: 'CERTIFICADO',
                label: 'CERTIFICADO'
                }, {
                value: 'DIPLOMA',
                label: 'DIPLOMA'
                }, {
                value: 'ORDEN DEL DIA',
                label: 'ORDEN DEL DIA'
                }, {
                value: 'MEMORANDUM',
                label: 'MEMORANDUM'
                }, {
                value: 'OTROS',
                label: 'OTROS'
                }
            ],
            fecha_otorgacion:"",
            nro_doc: "",
            costo: "",
            observacion: "",

            //combos anidados
            listarTipoCursos: [],
            listarDesgloCursos: [],
            listarTipoEmisores:[],

            //Editar los cursos del personal
            cur_codA:"",
            tipcur_codA:"",
            desglo_codA:"",
            emi_codA:"",
            tipemi_codA:"",
            descripcionA:"",
            fec_inicioA:"",
            fec_finalA:"",
            lugarA:"",
            documentoA:"",
            fecha_otorgacionA:"",
            nro_docA:"",
            periodoA:"",
            antiguedadA:"",
            costoA:"",
            observacionA:"",
            idPerCur:"",

            idcourse:"",
            idtypcourse:"",
            iddesgcourse:"",
            idemisor:"",
            idtypemisor:"",

            pagination: {
                'total'         :   0,
                'current_page'  :   0,
                'per_page'      :   0,
                'last_page'     :   0,
                'from'          :   0,
                'to'            :   0,
            },
            offset  : 3
        }
    },
    validations:{
        cur_cod: { required },
        tipcur_cod: { required },
        desglo_cod: { required },
        emi_cod: { required },
        tipemi_cod: { required },
        descripcion: { required },
        fec_inicio: { required },
        fec_final: { required },
        lugar: { required },
        documento: { required },
        fecha_otorgacion: { required },
        nro_doc: { required },
        perioptn: { required },
        periodo: { required },
        antiguedad: { required }
    },
    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },
        pagesNumber: function(){
            if(!this.pagination.to){
                return [];
            }
            var from = this.pagination.current_page - this.offset;
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
        }
    },
    mounted() {
        this.listarPersonalCursos(this.page);
        this.datospersonales();
        this.listarDatosPersonalSituacion();
    },
    methods: {
        since: function (d){
            return moment(d).format('DD-MM-YY');
        },
        abrirModal(){
            this.modalShow = !this.modalShow;
        },
        onlyNumber ($event) { //SOLO NUMEROS
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 48 || keyCode > 57)) {
                $event.preventDefault();
            }
        },
        alphanumeric ($event) { //NUMEROS Y LETRAS
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && (keyCode < 48 || keyCode > 57)  && keyCode !== 209 && keyCode !== 241 && keyCode !== 32 && keyCode !== 45) {
                $event.preventDefault();
            }
        },
        onlyletters ($event) { //SOLO letras
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) &&  keyCode !== 209 && keyCode !== 241 && keyCode !== 32) {
                $event.preventDefault();
            }
        },
        numDoc ($event) { //SOLO NUMEROS y "/"
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 48 || keyCode > 57) && keyCode !== 47) {
                $event.preventDefault();
            }
        },
        cambiarPagina(page){
            let me = this;
            me.pagination.current_page = page;
            me.listarPersonalCursos(page);
        },
        fechaactual(date){
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return  date > new Date(today.getTime());
        },
        datospersonales(){
            let me = this;
            axios
            .post("/datosPersoCursos", {
                per_codigo: me.per_codigo
            })
            .then(function (response) {
                me.datos = response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
        },
        listarDatosPersonalSituacion(){
            let me = this;
            axios.post("/listarDatosPersonalSituacion", {
                percodigo: me.per_codigo
            })
            .then(function (response) {
                me.datos=response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
        },
        listarPersonalCursos(page){
            let me = this;
            axios.post("/listadoCursos",{
                id: this.per_codigo,
                page: page
            }).then(function(response){
                var respuesta = response.data;
                console.log(respuesta);
                me.personal_cursos = respuesta.personal_cursos.data;
                me.pagination = respuesta.pagination;
            }).catch(function(error){
                console.log(error);
            })
        },
        listarCursos(){
            let me = this;
            axios.get('/listarCursos')
            .then(function(response)
            {
                var respuesta = response.data
                me.cursos = respuesta.cursos;
            })
            .catch(function(error)
            {
                console.log(error);
            })
        },
        listarEmisores(){
            let me = this;
            axios.get('/listarEmisores')
            .then(function(response){
                var respuesta = response.data
                me.emisores = respuesta.emi_cod;
            })
            .catch(function(error)
            {
                console.log(error);
            })
        },
        changeItem1: function changeItem1(rowId, event) {
            this.estado = false;
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.cambiarTipoCurso(event.target.value);
        },
        changeItem2: function changeItem2(rowId, event) {
            this.estado1 = false;
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.cambiarDesgloCurso(event.target.value);
        },
        changeItem3: function changeItem3(rowId, event) {
            this.estado2 = false;
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
            this.cambiarTipoEmisor(event.target.value);
        },
        cambiarTipoCurso(curso){
            let me = this;
            me.buscarCurso = curso;
            me.listarTipoCursos = [];
            var url='/tipo_cursos/selectbuscarTipoCursos?id=' + curso;
            me.selected = url;
            axios.get(url).then(function (response){
                var respuesta = response.data;
                me.listarTipoCursos = respuesta.tipo_cursos;
            })
            .catch(function (error) {
                me.selected = error;
                console.log(error);
            })
            .then(function () {
            });
        },
        cambiarDesgloCurso(tipocurso){
            let me = this;
            me.buscarTipoCurso = tipocurso;
            me.listarDesgloCursos = [];
            var url='/desglo_cursos/selectbuscarDesgloCursos?id=' + tipocurso;
            me.selected = url;
            axios.get(url).then(function (response){
                var respuesta = response.data;
                me.listarDesgloCursos = respuesta.desglo_cursos;
            })
            .catch(function (error) {
                me.selected = error;
                console.log(error);
            })
            .then(function () {
            });
        },
        cambiarTipoEmisor(emisor){
            let me = this;
            me.buscarEmisor = emisor;
            me.listarTipoEmisores = [];
            var url='/tipo_emisor/selectbuscarTipoEmisor?id=' + emisor;
            me.selected = url;
            axios.get(url).then(function (response){
                var respuesta = response.data;
                me.listarTipoEmisores = respuesta.tipo_emisores;
            })
            .catch(function (error) {
                me.selected = error;
                console.log(error);
            })
            .then(function () {
            });
        },
        changeTypeCourse(){
            try {
                let me = this;
                axios.post("/tip_curso/searchTipoCursos",{
                    id: me.cur_codA
                }).then(function (response){
                    me.listarTipoCursos = response.data;
                }).catch(function (error) {
                    console.log(error);
                })
            }catch (error){
            }
        },
        changeDesgloCourse(){
            try {
                let me = this;
                axios.post("/desg_curso/searchDesgloCursos",{
                    id: me.tipcur_codA
                }).then(function (response){
                    me.listarDesgloCursos = response.data;
                }).catch(function (error) {
                    console.log(error);
                })
            }catch (error){
            }
        },
        changeTypeEmisor(){
            try {
                let me = this;
                axios.post("/tip_emisores/searchTypeEmisor",{
                    id: me.emi_codA
                }).then(function (response){
                    me.listarTipoEmisores = response.data;
                }).catch(function (error) {
                    console.log(error);
                })
            }catch (error){
            }
        },
        abrirCrear(pc){
            $('#RegistrarPersonalCursos').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarCursos();
            this.listarEmisores();
        },
        RegistrarPersonalCursos: function(){
            let me = this;
            if(!this.$v.$invalid){
                axios.post("/nuevPerCur", {
                    'per_codigo'        :   this.per_codigo,
                    'cur_cod'           :   this.cur_cod,
                    'tipcur_cod'        :   this.tipcur_cod,
                    'desglo_cod'        :   this.desglo_cod,
                    'emi_cod'           :   this.emi_cod,
                    'tipemi_cod'        :   this.tipemi_cod,
                    'descripcion'       :   this.descripcion,
                    'fec_inicio'        :   this.fec_inicio,
                    'fec_final'         :   this.fec_final,
                    'lugar'             :   this.lugar,
                    'documento'         :   this.documento.value,
                    'fecha_otorgacion'  :   this.fecha_otorgacion,
                    'nro_doc'           :   this.nro_doc,
                    'periodo'           :   this.periodo.value,
                    'antiguedad'        :   this.antiguedad,
                    'costo'             :   this.costo,
                    'observacion'       :   this.observacion
                })
                .then(function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se registró el nuevo Curso',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    $('#RegistrarPersonalCursos').modal('hide');
                })
                .catch(error => {
                    console.log(error);
                })
                me.listarPersonalCursos();
            }
            else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Todos los campos deben ser llenados',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        },
        abrirEditar(pc){
            // console.log(pc)
            this.per_codigo         =   pc.per_codigo;
            this.idcourse       =   pc.idcourse;
            this.cur_codA           =   pc.nombrecurso;
            this.idtypcourse    =   pc.idtypcourse;
            this.tipcur_codA        =   pc.tipocurso;
            this.iddesgcourse   =   pc.iddesgcourse;
            this.desglo_codA        =   pc.desglocurso;
            this.idemisor       =   pc.idemisor;
            this.emi_codA           =   pc.nombreemisor;
            this.idtypemisor    =   pc.idtypemisor;
            this.tipemi_codA        =   pc.tipoemisor;
            this.descripcionA       =   pc.descripcion;
            this.fec_inicioA        =   pc.fec_inicio;
            this.fec_finalA         =   pc.fec_final;
            this.lugarA             =   pc.lugar;
            this.documentoA         =   pc.documento;
            this.fecha_otorgacionA  =   pc.fecha_otorgacion;
            this.nro_docA           =   pc.nro_doc;
            this.periodoA           =   pc.periodo;
            this.antiguedadA        =   pc.antiguedad;
            this.costoA             =   pc.costo;
            this.observacionA       =   pc.observacion;
            this.idPersonalCursos   =   pc.idPerCur;
            $('#EditarPersonalCursos').modal('show');
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white" );
            this.listarCursos();
            this.listarEmisores();
        },
        EditarPersonalCursos(){
            let me = this
            var url = '/modificarPerCur';
            if (me.cur_codA.id) {
                var cur_codA = me.cur_codA.id;
            }
            else {
                var cur_codA =  me.idcourse;
            }
            if (me.tipcur_codA.id) {
                var tipcur_codA = me.tipcur_codA.id;
            }
            else {
                var tipcur_codA =  me.idtypcourse;
            }
            if (me.desglo_codA.id) {
                var desglo_codA = me.desglo_codA.id;
            }
            else {
                var desglo_codA =  me.iddesgcourse;
            }
            if (me.emi_codA.id) {
                var emi_codA = me.emi_codA.id;
            }
            else {
                var emi_codA =  me.idemisor;
            }
            if (me.tipemi_codA.id) {
                var tipemi_codA = me.tipemi_codA.id;
            }
            else {
                var tipemi_codA =  me.idtypemisor;
            }
            axios.post(url,{
                'per_codigo'       :   this.per_codigo,
                'cur_cod'          :   cur_codA,
                'tipcur_cod'       :   tipcur_codA,
                'desglo_cod'       :   desglo_codA,
                'emi_cod'          :   emi_codA,
                'tipemi_cod'       :   tipemi_codA,
                'descripcion'      :   this.descripcionA,
                'fec_inicio'       :   this.fec_inicioA,
                'fec_final'        :   this.fec_finalA,
                'lugar'            :   this.lugarA,
                'documento'        :   this.documentoA,
                'fecha_otorgacion' :   this.fecha_otorgacionA,
                'nro_doc'          :   this.nro_docA,
                'periodo'          :   this.periodoA.value,
                'antiguedad'       :   this.antiguedadA,
                'costo'            :   this.costoA,
                'observacion'      :   this.observacionA,
                'id'               :   this.idPersonalCursos,
            }).then(function (response){

                Swal.fire({
                    icon: 'success',
                    title: 'Se actualizó el Curso',
                    showConfirmButton: false,
                    timer: 2500
                }),
                $('#EditarPersonalCursos').modal('hide');
                me.listarPersonalCursos();
            }).catch(function (error){
                console.log(error);
            })
        },
        CambiarEstado(op, idPerCur){
            Swal.fire({
                title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' el curso?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: ((op == 1) ? 'Si, desactivar' : 'Si, activar')
            }).then((result) => {
                if (result.value) {
                    this.fullscreenLoading = true;
                    var url ='/percursos/cambiarEstado'
                    axios.post(url, {
                        'pc'    :   idPerCur,
                        'estado':   (op == 1) ? '0' : '1'
                    }).then(response => {
                        Swal.fire({
                            icon    :   'success',
                            title   :   'Se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el curso',
                            showConfirmButton   : false,
                            timer   :   1500
                        })
                        this.listarPersonalCursos();
                    }).catch(function (error) {
                        console.log(error);
                    })
                }else{
                    Swal.fire({
                        icon    :   'info',
                        title   :   'No se ' + ((op == 1) ? 'desactivó' : 'activó') + ' el curso'
                    });
                }
            })
        },
        gendocpersonalcurso($per_codigo){
            window.open('http://sipefab.fab.bo/reporte/gendocpersonalcurso?id='+ $per_codigo, '_blank');
        }
    }
}
</script>

<style>
</style>
