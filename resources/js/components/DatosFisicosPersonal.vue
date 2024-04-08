<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">            
                <h1>
                <i class="far fa-bookmark"></i>
                Datos Fisicos Personal
                <!-- <small>Personal</small> -->
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Datos Fisicos</li>
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
                                <div class="form-group row">
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
                                                        <dt class="st">SITUACIÓN MILITAR ACTUAL</dt>
                                                        <dd class="st">{{ datos.nombsit }} - {{datos.nombsub}} - {{datos.nombdet}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <!-- FILA 3 -->
                                            <div class="row p-2 bd-highlight justify-content-center">
                                                <!-- <div v-if="$auth.can('view-insertdatfam')" class="col-md-4">
                                                    <button type="button" class="btn btn-sm btn-primary btn-block" style="margin-right: 5px;" title="Registrar Curso"  @click.stop="()=>{isHidden = false; datfamreg = 1; datfamreg2 = 0}">
                                                        <i class="fas fa-plus" aria-hidden="true"></i> Añadir Nuevo Familiar
                                                    </button>
                                                </div> -->
                                                <div class="col-md-4">
                                                    <button class="btn btn-sm btn-secondary btn-block" @click="generarReporte(per_codigo)">
                                                        <i class="far fa-file-alt" aria-hidden="true"></i> Generar PDF
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <router-link type="button" class="btn btn-sm btn-danger btn-block position-reverse" :to="'/DatosFisicos/'">
                                                        <i class="fas fa-reply"></i> Volver Atrás
                                                    </router-link>
                                                </div>
                                            </div>



                                        </div>
                                        
                                    </div>
                                </div>
                                <!--DATOS FISICOS-->
                                <div class="form-group border justify-content-center">
                                    <h6 v-if="datfisreg == 1" role="alert" class="alert alert-primary"><i class="fas fa-folder-plus"></i>&nbsp;<span >Registrar Datos Fisicos</span></h6>
                                    <h6 v-if="datfisreg == 2" role="alert" class="alert alert-primary"><i class="fas fa-edit"></i> &nbsp;<span >Actualizar Datos Fisicos</span></h6>
                                    <div class="row">
                                        <div class="col-md-2"><!--piel***********************-->
                                            <div class="form-group">
                                                <label>Color de la Piel</label>
                                                <select class="form-control border border-primary" v-model="datfis_piel">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="ALBINO">ALBINO</option>
                                                    <option value="BLANCA">BLANCA</option>
                                                    <option value="MORENO">MORENA</option>
                                                    <option value="TRIGUEÑA">TRIGUEÑA</option>                                        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2"><!--grupo sanguineo-->
                                            <div class="form-group">
                                                <label>Grupo Sanguineo</label>
                                                <select class="form-control border border-primary" v-model="datfis_gs">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="ORH+">ORH (+)</option>
                                                    <option value="ORH-">ORH (-)</option>
                                                    <option value="A+">A (+)</option>
                                                    <option value="A-">A (-)</option>
                                                    <option value="B+">B (+)</option>
                                                    <option value="B-">B (-)</option>
                                                    <option value="AB+">AB (+)</option>
                                                    <option value="AB-">AB (-)</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-md-2"><!--ojos-->
                                            <div class="form-group">
                                                <label>Color de Ojos</label>
                                                <select class="form-control border border-primary" v-model="datfis_ojos">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="AZULES">AZULES</option>
                                                    <option value="CLAROS">CLAROS</option>
                                                    <option value="CASTAÑO">CASTAÑO</option>
                                                    <option value="CAFES">CAFES</option>
                                                    <option value="OSCURO">OSCUROS</option>
                                                    <option value="PARDOS">PARDOS</option>
                                                    <option value="NEGROS">NEGROS</option>
                                                    <option value="VERDES">VERDES</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2"><!--cabello-->
                                            <div class="form-group">
                                                <label>Color de los Cabellos</label>
                                                <select class="form-control border border-primary" v-model="datfis_cabello">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="CASTAÑOS">CASTAÑO</option>
                                                    <option value="NEGROS">NEGROS</option>
                                                    <option value="PELIROJOS">PELIROJOS</option>
                                                    <option value="RUBIOS">RUBIOS</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-2"><!--boca-->
                                            <div class="form-group">
                                                <label>Boca</label>
                                                <select class="form-control border border-primary" v-model="datfis_boca">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="GRANDE">GRANDE</option>
                                                    <option value="MEDIANA">MEDIANA</option>
                                                    <option value="PEQUEÑA">PEQUEÑA</option>
                                                </select>
                                                    
                                            </div>
                                        </div>
                                        <div class="col-md-2"><!--labios-->
                                            <div class="form-group">
                                                <label>Labios</label>
                                                <select class="form-control border border-primary" v-model="datfis_labios">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="DELGADOS">DELGADOS</option>
                                                    <option value="GRUESOS">GRUESOS</option>
                                                    <option value="MEDIANOS">MEDIANOS</option>
                                                    <option value="NORMAL">NORMAL</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-md-2"><!--nariz-->
                                            <div class="form-group">
                                                <label>Nariz</label>
                                                <select class="form-control border border-primary" v-model="datfis_nariz">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="GRANDE">GRANDE</option>
                                                    <option value="MEDIANA">MEDIANA</option>
                                                    <option value="PEQUEÑA">PEQUEÑA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2"><!--estatura-->
                                            <div class="form-group">
                                                <label>Estatura</label>
                                                <select class="form-control border border-primary" v-model="datfis_estatura">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="1.40">1,40 Mts.</option>
                                                    <option value="1.41">1,41 Mts.</option>
                                                    <option value="1.42">1,42 Mts.</option>
                                                    <option value="1.43">1,43 Mts.</option>
                                                    <option value="1.44">1,44 Mts.</option>
                                                    <option value="1.45">1,45 Mts.</option>
                                                    <option value="1.46">1,46 Mts.</option>
                                                    <option value="1.47">1,47 Mts.</option>
                                                    <option value="1.48">1,48 Mts.</option>
                                                    <option value="1.49">1,49 Mts.</option>
                                                    <option value="1.50">1,50 Mts.</option>
                                                    <option value="1.51">1,51 Mts.</option>
                                                    <option value="1.52">1,52 Mts.</option>
                                                    <option value="1.53">1,53 Mts.</option>
                                                    <option value="1.54">1,54 Mts.</option>
                                                    <option value="1.55">1,55 Mts.</option>
                                                    <option value="1.56">1,56 Mts.</option>
                                                    <option value="1.57">1,57 Mts.</option>
                                                    <option value="1.58">1,58 Mts.</option>
                                                    <option value="1.59">1,59 Mts.</option>
                                                    <option value="1.60">1,60 Mts.</option>
                                                    <option value="1.61">1,61 Mts.</option>
                                                    <option value="1.62">1,62 Mts.</option>
                                                    <option value="1.63">1,63 Mts.</option>
                                                    <option value="1.64">1,64 Mts.</option>
                                                    <option value="1.65">1,65 Mts.</option>
                                                    <option value="1.66">1,66 Mts.</option>
                                                    <option value="1.67">1,67 Mts.</option>
                                                    <option value="1.68">1,68 Mts.</option>
                                                    <option value="1.69">1,69 Mts.</option>
                                                    <option value="1.70">1,70 Mts.</option>
                                                    <option value="1.71">1,71 Mts.</option>
                                                    <option value="1.72">1,72 Mts.</option>
                                                    <option value="1.73">1,73 Mts.</option>
                                                    <option value="1.74">1,74 Mts.</option>
                                                    <option value="1.75">1,75 Mts.</option>
                                                    <option value="1.76">1,76 Mts.</option>
                                                    <option value="1.77">1,77 Mts.</option>
                                                    <option value="1.78">1,78 Mts.</option>
                                                    <option value="1.79">1,79 Mts.</option>
                                                    <option value="1.80">1,80 Mts.</option>
                                                    <option value="1.81">1,81 Mts.</option>
                                                    <option value="1.82">1,82 Mts.</option>
                                                    <option value="1.83">1,83 Mts.</option>
                                                    <option value="1.84">1,84 Mts.</option>
                                                    <option value="1.85">1,85 Mts.</option>
                                                    <option value="1.86">1,86 Mts.</option>
                                                    <option value="1.87">1,87 Mts.</option>
                                                    <option value="1.88">1,88 Mts.</option>
                                                    <option value="1.89">1,89 Mts.</option>
                                                    <option value="1.90">1,90 Mts.</option>
                                                    <option value="1.91">1,91 Mts.</option>
                                                    <option value="1.92">1,92 Mts.</option>
                                                    <option value="1.93">1,93 Mts.</option>
                                                    <option value="1.94">1,94 Mts.</option>
                                                    <option value="1.95">1,95 Mts.</option>
                                                    <option value="1.96">1,96 Mts.</option>
                                                    <option value="1.97">1,97 Mts.</option>
                                                    <option value="1.98">1,98 Mts.</option>
                                                    <option value="1.99">1,99 Mts.</option>
                                                    <option value="2.00">2,00 Mts.</option>
                                                    <option value="2.01">2,01 Mts.</option>
                                                    <option value="2.02">2,02 Mts.</option>
                                                    <option value="2.03">2,03 Mts.</option>
                                                    <option value="2.04">2,04 Mts.</option>
                                                    <option value="2.05">2,05 Mts.</option>
                                                    <option value="2.06">2,06 Mts.</option>
                                                    <option value="2.07">2,07 Mts.</option>
                                                    <option value="2.08">2,08 Mts.</option>
                                                    <option value="2.09">2,09 Mts.</option>
                                                    <option value="2.10">2,10 Mts.</option>
                                                    <option value="2.11">2,11 Mts.</option>
                                                    <option value="2.12">2,12 Mts.</option>
                                                    <option value="2.13">2,13 Mts.</option>
                                                    <option value="2.14">2,14 Mts.</option>
                                                    <option value="2.15">2,15 Mts.</option>
                                                    <option value="2.16">2,16 Mts.</option>
                                                    <option value="2.17">2,17 Mts.</option>
                                                    <option value="2.18">2,18 Mts.</option>
                                                    <option value="2.19">2,19 Mts.</option>
                                                    <option value="2.20">2,20 Mts.</option>
                                                </select>
                                                    
                                            </div>
                                        </div>


                                        <div class="col-md-2"><!--peso-->
                                            <div class="form-group">
                                                <label>Peso (Kg.)</label>
                                                <input type="number" class="form-control border border-primary" v-model="datfis_peso" maxLength="5" min="40" step=".01" max="120" oninput="maxlengthNumber(this);" >
                                                

                                            </div>
                                        </div> 
                                        <div class="col-md-2"><!--contextura-->
                                            <div class="form-group">
                                                <label>Contextura Fisica</label>
                                                <select class="form-control border border-primary" v-model="datfis_contextura">
                                                    <option value="0" disabled>SELECCIONE</option>
                                                    <option value="CORPULENTO">CORPULENTO</option>
                                                    <option value="DELGADO">DELGADO</option>
                                                    <option value="MEDIANO">MEDIANO</option>
                                                    <option value="ROBUSTO">ROBUSTO</option>
                                                </select>                                        
                                            </div>
                                        </div>
                                        <div class="col-md-4"><!--enfermedad-->
                                            <div class="form-group">
                                                <label>Enfermedad</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfis_enfermedad" placeholder="Ingrese enfermedad" maxlength="200" style="text-transform:uppercase;" >
                                            </div>
                                        </div>
                                        <div class="col-md-4"><!--alergias-->
                                            <div class="form-group">
                                                <label>Alergias</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfis_alergias" placeholder="Ingrese alergias" maxlength="150" style="text-transform:uppercase;" >
                                            </div>
                                        </div>


                                        
                                        <div class="col-md-4"><!--señasPart-->
                                            <div class="form-group">
                                                <label>Señas Particulares</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfis_senaspart" value="NINGUNO" placeholder=" ingrese señas particulares" maxlength="200" style="text-transform:uppercase;" >
                                            </div>
                                        </div>
                                        <div class="col-md-4"><!--obs-->
                                            <div class="form-group">
                                                <label>Observaciones</label>
                                                <input type="text" class="form-control border border-primary" v-model="datfis_observacion" placeholder="ingrese observaciones" maxlength="300" style="text-transform:uppercase;" >
                                            </div>
                                        </div>
                                                                        
                                        <div class="col-md-12"><!--btn-->
                                            <div class="form-group">
                                                <div style="text-align: center;">
                                                    <button type="submit" v-if="datfisreg==1 && $auth.can('insert-datfis')" @click="registrarDatos_fisicos_personal()" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp; Registrar Datos Físicos</button>
                                                    <button type="submit" v-if="datfisreg==2 && $auth.can('edit-datfis')" @click="actualizarDatos_fisicos_personal()" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp; Actualizar Datos Físicos</button>
                                                    <router-link class="btn btn-danger btn-sm" :to="'/DatosFisicos'" ><i class="far fa-window-close"></i>&nbsp; Cancelar</router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--FIN DATOS FISICOS-->
                                
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
export default {
    data() {
        return {
            //RECIBIMOS LA VARIABLE EN ESTE CASO (d)
            per_codigo: this.$route.params.e,   /// PUES ACA LLAMAS ELMPARAMETRO d

            //DATOS FISICOS
            datfis_id : 0, 
            datfis_percodigo : 0, 
            datfis_piel : 0,
            datfis_gs : 0,
            datfis_ojos : 0,
            datfis_cabello : 0,
            datfis_boca : 0,
            datfis_labios : 0,
            datfis_nariz : 0,
            datfis_senaspart : '',
            datfis_estatura : 0,
            datfis_peso : 0,
            datfis_enfermedad : '',
            datfis_alergias : '',
            datfis_contextura : 0,
            datfis_estado : '',
            datfis_observacion : '',
            datfis_sys_user:'',
            datfisreg : 1,
            //FIN DATOS FISICOS
            arrayDatosFisicos :[],
            datos: [],
            // DESDE ACA LA TABLE
            // DESDE ACA LA TABLE
        
            escalafon_id : 0,
            subescalafon_id : 0,
            grado_id : 0,
            documento :'',
            fecha_doc :'',
            fecha : '',
            observaciones : '',
            cm : '',
            sy_suser : '',
            nro_doc : '',
            //edit
            escalafonPersonal_id_edit : 0,
            escalafon_id_edit : 0,
            subescalafon_id_edit : 0,
            grado_id_edit : 0,
            documento_edit :'',
            fecha_doc_edit :'',
            fecha_edit : '',
            observaciones_edit : '',
            cm_edit : '',
            sy_suser_edit : '',
            nro_doc_edit : '',
            // HASTA ACA LA TABLE
            rowId : 0,
            arrayDatosPersonal :[],    

            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
            criterio : 'per_nombre',
            buscar : ''

        }
    },
    mounted() {
        
        this.listarDatosFisicos(this.per_codigo);
        this.datosPersonal(this.per_codigo);
        this.listarDatosPersonalSituacion();
    },
    methods: {
        listarDatosFisicos(per_codigo){
            let me = this;
            axios
            .post("/listarDatosFisicos", {
                per_codigo : per_codigo,
            })
            .then(function (response) {
                
            var respuesta = response.data;
                //me.datos_fisicos = response.data.data;

            me.arrayDatosFisicos = respuesta.datos_fisicos;
                if (me.arrayDatosFisicos[0]['per_codigo'] > 0) {
                    me.datfisreg = 2;
                }else{me.datfisreg = 1;}
                me.datfis_id = me.arrayDatosFisicos[0]['id'];
                me.datfis_percodigo = me.arrayDatosFisicos[0]['per_codigo'];
                me.datfis_piel = me.arrayDatosFisicos[0]['piel'];
                me.datfis_gs = me.arrayDatosFisicos[0]['gs'];
                me.datfis_ojos = me.arrayDatosFisicos[0]['ojos'];
                me.datfis_cabello = me.arrayDatosFisicos[0]['cabello'];
                me.datfis_boca = me.arrayDatosFisicos[0]['boca'];
                me.datfis_labios = me.arrayDatosFisicos[0]['labios'];
                me.datfis_nariz = me.arrayDatosFisicos[0]['nariz'];
                me.datfis_senaspart = me.arrayDatosFisicos[0]['senaspart'];
                me.datfis_estatura = me.arrayDatosFisicos[0]['estatura'];
                me.datfis_peso = me.arrayDatosFisicos[0]['peso'];
                me.datfis_enfermedad = me.arrayDatosFisicos[0]['enfermedad'];
                me.datfis_alergias = me.arrayDatosFisicos[0]['alergias'];
                me.datfis_contextura = me.arrayDatosFisicos[0]['contexturas'];
                me.datfis_estado = me.arrayDatosFisicos[0]['estado'];
                me.datfis_observacion = me.arrayDatosFisicos[0]['observacion'];

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        datosPersonal(per_codigo){
           // alert(per_codigo);
            let me = this;
            axios.post("/datosPersonal", {
            per_codigo : per_codigo,
          }).then(function (response) {
            me.arrayDatosPersonal = response.data.personal_datos;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
        },

        actualizarDatos_fisicos_personal(){
                // if(this.validarDatos_fisicos_personal()){
                //     return;
                // }

                const swalWithBootstrapButtons = Swal.mixin
                (
                    {
                    customClass:
                    {
                        confirmButton: 'btn btn-success \n',
                        cancelButton: 'btn btn-danger \n'
                    },
                        buttonsStyling: false
                    }
                )

                swalWithBootstrapButtons.fire
                (
                    {
                    title: 'Se actualizarán estos valores',
                    text: "¿Está seguro de actualizarlos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar ',
                    cancelButtonText: 'Cancelar ',
                    reverseButtons: true
                    }
                ).then((result) =>
                {
                    if (result.value)
                    {
                            let me =this;

                            if(me.datfis_enfermedad!==null){
                                me.datfis_enfermedad=me.datfis_enfermedad.toUpperCase();
                            }
                            if(me.datfis_alergias!==null){
                                me.datfis_alergias=me.datfis_alergias.toUpperCase();
                            }
                            if(me.datfis_senaspart!==null){
                                me.datfis_senaspart=me.datfis_senaspart.toUpperCase();
                            }
                            if(me.datfis_observacion!==null){
                                me.datfis_observacion=me.datfis_observacion.toUpperCase();
                            }

                            axios.put('/datos_fisicos_personal/actualizar',{
                                
                                'datfis_percodigo' :    this.per_codigo,
                                'datfis_piel' :         this.datfis_piel,
                                'datfis_gs' :           this.datfis_gs,
                                'datfis_ojos' :         this.datfis_ojos,
                                'datfis_cabello' :      this.datfis_cabello,
                                'datfis_boca' :         this.datfis_boca,
                                'datfis_labios' :       this.datfis_labios,
                                'datfis_nariz' :        this.datfis_nariz,
                                'datfis_senaspart' :    this.datfis_senaspart, 
                                'datfis_estatura' :     this.datfis_estatura,
                                'datfis_peso' :         this.datfis_peso,
                                'datfis_enfermedad' : this.datfis_enfermedad,
                                'datfis_alergias' : this.datfis_alergias,
                                'datfis_contextura' : this.datfis_contextura,
                                'datfis_observacion' :this.datfis_observacion,
                                'estado' : '1',
                                'datfis_sys_user' : 'UPDATE21',

                                'datfis_id' : this.datfis_id

                 }).then(function (response)
                {
                    //1= primera pagina
                    //''=valor de busqueda vacio
                    //nick = parametro del valor del criterio como valor predeterminado
                   // me.listarUsuario(1,'','nick');
                    //esta funcion swal nos permite mostrar la notificacion

                  
                    swalWithBootstrapButtons.fire(
                            'Actualizado',
                            'El registro ha sido actualizado con éxito.',
                            'success'
                    )
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                })
                .then(function () {
                // always executed
                });
                }
                else if
                (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                )
                    {
                    }
                })
        },

        registrarDatos_fisicos_personal (){

            // if(this.validarDatos_fisicos_personal()){
            //     return;
            // }

            const swalWithBootstrapButtons = Swal.mixin
            (
                {
                customClass:
                {
                    confirmButton: 'btn btn-success \n',
                    cancelButton: 'btn btn-danger \n'
                },
                    buttonsStyling: false
                }
            )

            swalWithBootstrapButtons.fire
            (
                {
                title: 'Se actualizarán estos valores',
                text: "¿Está seguro de actualizarlos?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar ',
                cancelButtonText: 'Cancelar ',
                reverseButtons: true
                }
            ).then((result) =>
                {
                if (result.value)
                {
                    let me =this;

                    if(me.datfis_enfermedad!==null){
                        me.datfis_enfermedad=me.datfis_enfermedad.toUpperCase();
                    }
                    if(me.datfis_alergias!==null){
                        me.datfis_alergias=me.datfis_alergias.toUpperCase();
                    }
                    if(me.datfis_senaspart!==null){
                        me.datfis_senaspart=me.datfis_senaspart.toUpperCase();
                    }
                    if(me.datfis_observacion!==null){
                        me.datfis_observacion=me.datfis_observacion.toUpperCase();
                    }

                        
                    axios.post('/datos_fisicos_personal/registrar',{

                        
                        'datfis_percodigo' :    this.per_codigo,
                        'datfis_piel' :         this.datfis_piel,
                        'datfis_gs' :           this.datfis_gs,
                        'datfis_ojos' :         this.datfis_ojos,
                        'datfis_cabello' :      this.datfis_cabello,
                        'datfis_boca' :         this.datfis_boca,
                        'datfis_labios' :       this.datfis_labios,
                        'datfis_nariz' :        this.datfis_nariz,
                        'datfis_senaspart' :    this.datfis_senaspart, 
                        'datfis_estatura' :     this.datfis_estatura,
                        'datfis_peso' :         this.datfis_peso,
                        'datfis_enfermedad' : this.datfis_enfermedad,
                        'datfis_alergias' : this.datfis_alergias,
                        'datfis_contextura' : this.datfis_contextura,
                        'datfis_observacion' :this.datfis_observacion,
                        'estado' : '1',
                        'datfis_sys_user' : 'SIAT' 
                    }).then(function (response)
                    {
                        swalWithBootstrapButtons.fire(
                            'Registrado',
                            'Los datos fisicos han sido registrados',
                            'success'
                        )
                        me.datfisreg = 2;
                    })
                .catch(function (error) {
                console.log(error);
                })
                .then(function () {
                });
            }
            else if
            (
                result.dismiss === Swal.DismissReason.cancel
            )
                {
                }
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
        
        generarReporte($per_codigo){
            window.open('http://sipefab.fab.bo/reporte/generareportdatfispersonal?STXWTQ2HH3835NR='+ $per_codigo, '_blank');
        }

    },
}
</script>

<style>    