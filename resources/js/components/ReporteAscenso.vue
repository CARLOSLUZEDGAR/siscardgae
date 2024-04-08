<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">    
                    <div class="row">
                        <h1>
                            <i class="fas fa-file-pdf"></i>
                            REPORTE DE OGA
                        </h1>&nbsp;
                        
                    </div>        
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orden General de Ascensos</li>
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
                                        <button type="button" class="btn btn-secondary btn-sm btn-block" @click="oga(cmdteFAB,cmdteFFAA,minDEF,presidente,gestion,cargoCmdteFAB,cargoCmdteFFAA)">
                                            <i class="far fa-file-alt" aria-hidden="true">  Generar OGA</i>
                                        </button>
                                    </div> 
                                    <!-- <div class="col-md-4">
                                        <button type="button" class="btn btn-danger btn-sm btn-block" @click="Atras()">
                                            <i class="fas fa-reply" aria-hidden="true">  Atras</i>
                                        </button>
                                    </div>  -->
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
    import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
    export default {
        data() {
            return {  
                gestion: '', 
                cmdteFAB : '',
                cmdteFFAA : '',
                minDEF : '',
                presidente : '',
                cargoCmdteFAB : '',
                cargoCmdteFFAA : '',    
            }
        },
        validations:{
            cmdteFAB : { required },
            cmdteFFAA : { required },
            minDEF : { required },
            presidente : { required },
            gestion : { required },
            cargoCmdteFAB : { required },
            cargoCmdteFFAA : { required },
        },
        mounted() {
    
        },
        computed:{
            
            
        
        },
    
        methods: {
            // oga(gestion){
            //     window.open('http://127.0.0.1:8000/generarAscensoReporte?gestion='+gestion);
            //     // window.open('http://sipefab.fab.bo/generarAscensoReporte?gestion='+gestion);
            // },

            oga(cmdteFAB,cmdteFFAA,minDEF,presidente,gestion,cargoCmdteFAB,cargoCmdteFFAA){
                this.$v.$reset()
                if(!this.$v.$invalid){
                    window.open('http://sipefab.fab.bo/generarAscensoReporte?cmdtefab='+cmdteFAB+'&cmdteffaa='+cmdteFFAA+'&mindef='+minDEF+'&presidente='+presidente+'&gestion='+gestion+'&cargoCmdteFAB='+cargoCmdteFAB+'&cargoCmdteFFAA='+cargoCmdteFFAA);
                    // window.open('http://127.0.0.1:8000/generarAscensoReporte?cmdtefab='+cmdteFAB+'&cmdteffaa='+cmdteFFAA+'&mindef='+minDEF+'&presidente='+presidente+'&gestion='+gestion+'&cargoCmdteFAB='+cargoCmdteFAB+'&cargoCmdteFFAA='+cargoCmdteFFAA);
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
    };
</script>

<style>


</style>