<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Controllers\mc_table_2;


//use App\Pdf;

class ordenGeneralAscensoController extends mc_table_2
// class ordenGeneralAscensoController extends Controller

{
    public function createPDF(Request $request)
    {

        $conn = pg_pconnect('host=192.168.3.81 port=5432 dbname=sipefab_prod user=postgres password=4$Ku8&_d@B/9in*0w%');
        // $conn = pg_pconnect("host=127.0.0.1 port=5433 dbname=sipefabFinal user=postgres password=lu12ed29");

        $cmdtefab = $request->cmdtefab;
        $cmdteffaa = $request->cmdteffaa;
        $mindef = $request->mindef;
        $presidente = $request->presidente;
        $gestion_actual = $request->gestion;
        $cargoCmdteFAB = $request->cargoCmdteFAB;
        $cargoCmdteFFAA = $request->cargoCmdteFFAA;
        //CONSULTAS 1RA PARTE
        //OFICIALES
        $escalafon_oficiales = pg_query($conn,"SELECT escalafones.nombre
                                    FROM escalafones 
                                    INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                    INNER JOIN vista_grado_anterior_oficiales ON personal_escalafones.per_codigo = vista_grado_anterior_oficiales.antof_percodigo 
                                    INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_oficiales.antof_percodigo = personal_ascenso_promociones.per_codigo
                                    WHERE  personal_escalafones.estado =1 
                                    AND(personal_escalafones.subesc_cod=1 OR personal_escalafones.subesc_cod=2 OR personal_escalafones.subesc_cod=3)
                                    AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                    GROUP BY escalafones.id,escalafones.nombre
                                    ORDER BY  escalafones.id");
        $al_grado_oficiales = pg_query($conn,"SELECT grados.nombre,
                                        grados.id as graid
                                    FROM grados 
                                        INNER JOIN personal_escalafones ON personal_escalafones.gra_cod = grados.id 
                                        INNER JOIN vista_grado_anterior_oficiales ON personal_escalafones.per_codigo = vista_grado_anterior_oficiales.antof_percodigo 
                                        INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_oficiales.antof_percodigo = personal_ascenso_promociones.per_codigo
                                        INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                        INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                    WHERE  personal_escalafones.estado =1 
                                        AND(personal_escalafones.subesc_cod=1 OR personal_escalafones.subesc_cod=2 OR personal_escalafones.subesc_cod=3)
                                        AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                    GROUP BY grados.id,grados.nombre
                                    ORDER BY  grados.id");
        $instancia_oficiales = pg_query($conn,"SELECT  
                                                    instancia_ascensos.id as instid,instancia_ascensos.instancia, 
                                                    grados.nombre as nomgra,
                                                    grados.id as graid
                                                FROM escalafones 
                                                INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                                INNER JOIN vista_grado_anterior_oficiales ON personal_escalafones.per_codigo = vista_grado_anterior_oficiales.antof_percodigo 
                                                INNER JOIN grados ON personal_escalafones.gra_cod = grados.id 
                                                INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_oficiales.antof_percodigo = personal_ascenso_promociones.per_codigo
                                                INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                                INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                                WHERE  personal_escalafones.estado =1 
                                                AND(personal_escalafones.subesc_cod=1 OR personal_escalafones.subesc_cod=2 OR personal_escalafones.subesc_cod=3)
                                                AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                GROUP BY  personal_escalafones.esca_cod,
                                                        personal_escalafones.subesc_cod,
                                                        instancia_ascensos.id,
                                                        personal_escalafones.gra_cod, instancia_ascensos.instancia, nomgra,
                                                    graid
                                                ORDER BY  personal_escalafones.esca_cod,
                                                        personal_escalafones.subesc_cod,
                                                        personal_escalafones.gra_cod, instancia_ascensos.id");

        $personal_ascensos_oficiales = pg_query($conn,"SELECT subescalafones.nombre, 
                                                escalafones.nombre,
                                                instancia_ascensos.id as instid, 
                                                grados.nombre as nomgra,
                                                grados.id as graid,
                                                vista_grado_anterior_oficiales.antof_grado,
                                                vista_grado_anterior_oficiales.antof_estudio,
                                                vista_grado_anterior_oficiales.antof_paterno, 
                                                vista_grado_anterior_oficiales.antof_materno,
                                                vista_grado_anterior_oficiales.antof_nombre,
                                                personal_ascenso_promociones.antigfin, 
                                                personal_ascenso_promociones.observacion, 
                                                personal_ascenso_promociones.fechasc
                                            FROM escalafones 
                                            INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                            INNER JOIN vista_grado_anterior_oficiales ON personal_escalafones.per_codigo = vista_grado_anterior_oficiales.antof_percodigo 
                                            INNER JOIN grados ON personal_escalafones.gra_cod = grados.id 
                                            INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_oficiales.antof_percodigo = personal_ascenso_promociones.per_codigo
                                            INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                            INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                            WHERE  personal_escalafones.estado =1 
                                            AND(personal_escalafones.subesc_cod=1 OR personal_escalafones.subesc_cod=2 OR personal_escalafones.subesc_cod=3)
                                            AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                            ORDER BY  personal_escalafones.esca_cod,
                                                    personal_escalafones.subesc_cod,
                                                    personal_escalafones.gra_cod,
                                                    personal_ascenso_promociones.antiguedad");
        //FIN OFICIALES
        //SOFS SGTOS TECNICOS
        $escalafon_softec = pg_query($conn,"SELECT escalafones.nombre
                                                FROM escalafones 
                                                INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                                INNER JOIN vista_grado_anterior_softec ON personal_escalafones.per_codigo = vista_grado_anterior_softec.antsoftec_percodigo 
                                                INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_softec.antsoftec_percodigo = personal_ascenso_promociones.per_codigo
                                                WHERE  personal_escalafones.estado =1 
                                                AND(personal_escalafones.subesc_cod=4 OR personal_escalafones.subesc_cod=5 OR personal_escalafones.subesc_cod=6)
                                                AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                GROUP BY escalafones.id,escalafones.nombre
                                                ORDER BY  escalafones.id");
        $al_grado_softec = pg_query($conn,"SELECT grados.nombre,
                                                    grados.id as graid
                                                FROM grados 
                                                    INNER JOIN personal_escalafones ON personal_escalafones.gra_cod = grados.id 
                                                    INNER JOIN vista_grado_anterior_softec ON personal_escalafones.per_codigo = vista_grado_anterior_softec.antsoftec_percodigo 
                                                    INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_softec.antsoftec_percodigo = personal_ascenso_promociones.per_codigo
                                                    INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                                    INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                                WHERE  personal_escalafones.estado =1 
                                                    AND(personal_escalafones.subesc_cod=4 OR personal_escalafones.subesc_cod=5 OR personal_escalafones.subesc_cod=6)
                                                    AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                GROUP BY grados.id,grados.nombre
                                                ORDER BY  grados.id");
        
        $instancia_softec = pg_query($conn,"SELECT  
                                                    instancia_ascensos.id as instid,instancia_ascensos.instancia, 
                                                    grados.nombre as nomgra,
                                                    grados.id as graid
                                                FROM escalafones 
                                                INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                                INNER JOIN vista_grado_anterior_softec ON personal_escalafones.per_codigo = vista_grado_anterior_softec.antsoftec_percodigo 
                                                INNER JOIN grados ON personal_escalafones.gra_cod = grados.id 
                                                INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_softec.antsoftec_percodigo = personal_ascenso_promociones.per_codigo
                                                INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                                INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                                WHERE  personal_escalafones.estado =1 
                                                AND (personal_escalafones.subesc_cod=4 OR personal_escalafones.subesc_cod=5 OR personal_escalafones.subesc_cod=6)
                                                AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                GROUP BY  personal_escalafones.esca_cod,
                                                        personal_escalafones.subesc_cod,
                                                        instancia_ascensos.id,
                                                        personal_escalafones.gra_cod, instancia_ascensos.instancia, nomgra,
                                                    graid
                                                ORDER BY  personal_escalafones.esca_cod,
                                                        personal_escalafones.subesc_cod,
                                                        personal_escalafones.gra_cod, instancia_ascensos.id");

        $personal_ascensos_softec = pg_query($conn,"SELECT subescalafones.nombre, 
                                                            escalafones.nombre, 
                                                            instancia_ascensos.id as instid, 
                                                            grados.nombre as nomgra,
                                                            grados.id as graid,
                                                            vista_grado_anterior_softec.antsoftec_grado,
                                                            vista_grado_anterior_softec.antsoftec_estudio,
                                                            vista_grado_anterior_softec.antsoftec_paterno, 
                                                            vista_grado_anterior_softec.antsoftec_materno,
                                                            vista_grado_anterior_softec.antsoftec_nombre,
                                                            personal_ascenso_promociones.antigfin, 
                                                            personal_ascenso_promociones.observacion, 
                                                            personal_ascenso_promociones.fechasc
                                                        FROM escalafones 
                                                        INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                                        INNER JOIN vista_grado_anterior_softec ON personal_escalafones.per_codigo = vista_grado_anterior_softec.antsoftec_percodigo 
                                                        INNER JOIN grados ON personal_escalafones.gra_cod = grados.id 
                                                        INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_softec.antsoftec_percodigo = personal_ascenso_promociones.per_codigo
                                                        INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                                        INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                                        WHERE  personal_escalafones.estado =1 
                                                        AND (personal_escalafones.subesc_cod=4 OR personal_escalafones.subesc_cod=5 OR personal_escalafones.subesc_cod=6)
                                                        AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                        ORDER BY  personal_escalafones.esca_cod,
                                                                personal_escalafones.subesc_cod,
                                                                personal_escalafones.gra_cod,
                                                                personal_ascenso_promociones.antiguedad");
        //FIN SOFS SGTOS TECNICOS
        //SOF SGTOS MUSICOS
        $escalafon_sofmus = pg_query($conn,"SELECT escalafones.nombre
                                                FROM escalafones 
                                                INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                                INNER JOIN vista_grado_anterior_sofmus ON personal_escalafones.per_codigo = vista_grado_anterior_sofmus.antsofmus_percodigo 
                                                INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_sofmus.antsofmus_percodigo = personal_ascenso_promociones.per_codigo
                                                WHERE  personal_escalafones.estado =1 
                                                AND personal_escalafones.subesc_cod=21
                                                AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                GROUP BY escalafones.id,escalafones.nombre
                                                ORDER BY  escalafones.id");
        $al_grado_sofmus = pg_query($conn,"SELECT grados.nombre,
                                                    grados.id as graid
                                                FROM grados 
                                                    INNER JOIN personal_escalafones ON personal_escalafones.gra_cod = grados.id 
                                                    INNER JOIN vista_grado_anterior_sofmus ON personal_escalafones.per_codigo = vista_grado_anterior_sofmus.antsofmus_percodigo 
                                                    INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_sofmus.antsofmus_percodigo = personal_ascenso_promociones.per_codigo
                                                    INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                                    INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                                WHERE  personal_escalafones.estado =1 
                                                    AND personal_escalafones.subesc_cod=21
                                                    AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                GROUP BY grados.id,grados.nombre
                                                ORDER BY  grados.id");

        $instancia_sofmus = pg_query($conn,"SELECT  
                                        instancia_ascensos.id as instid,instancia_ascensos.instancia, 
                                        grados.nombre as nomgra,
                                        grados.id as graid
                                        FROM escalafones 
                                        INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                        INNER JOIN vista_grado_anterior_sofmus ON personal_escalafones.per_codigo = vista_grado_anterior_sofmus.antsofmus_percodigo 
                                        INNER JOIN grados ON personal_escalafones.gra_cod = grados.id 
                                        INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_sofmus.antsofmus_percodigo = personal_ascenso_promociones.per_codigo
                                        INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                        INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                        WHERE  personal_escalafones.estado =1 
                                        AND personal_escalafones.subesc_cod=21
                                        AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                        GROUP BY  personal_escalafones.esca_cod,
                                            personal_escalafones.subesc_cod,
                                            instancia_ascensos.id,
                                            personal_escalafones.gra_cod, instancia_ascensos.instancia, nomgra,
                                        graid
                                        ORDER BY  personal_escalafones.esca_cod,
                                            personal_escalafones.subesc_cod,
                                            personal_escalafones.gra_cod, instancia_ascensos.id");

        $personal_ascensos_sofmus = pg_query($conn,"SELECT subescalafones.nombre, 
                                                            escalafones.nombre, 
                                                            instancia_ascensos.id as instid,  
                                                            grados.nombre as nomgra,
                                                            grados.id as graid,
                                                            REPLACE(vista_grado_anterior_sofmus.antsofmus_grado,'..','.') as antsofmus_grado,
                                                            vista_grado_anterior_sofmus.antsofmus_estudio,
                                                            vista_grado_anterior_sofmus.antsofmus_paterno, 
                                                            vista_grado_anterior_sofmus.antsofmus_materno,
                                                            vista_grado_anterior_sofmus.antsofmus_nombre,
                                                            personal_ascenso_promociones.antigfin, 
                                                            personal_ascenso_promociones.observacion, 
                                                            personal_ascenso_promociones.fechasc
                                                        FROM escalafones 
                                                        INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                                        INNER JOIN vista_grado_anterior_sofmus ON personal_escalafones.per_codigo = vista_grado_anterior_sofmus.antsofmus_percodigo 
                                                        INNER JOIN personals ON personals.per_codigo = vista_grado_anterior_sofmus.antsofmus_percodigo
                                                        INNER JOIN grados ON personal_escalafones.gra_cod = grados.id 
                                                        INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_sofmus.antsofmus_percodigo = personal_ascenso_promociones.per_codigo
                                                        INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                                        INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                                        WHERE  personal_escalafones.estado =1 
                                                        AND personal_escalafones.subesc_cod=21
                                                        AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                        ORDER BY  personal_escalafones.esca_cod,
                                                                personal_escalafones.subesc_cod,
                                                                personal_escalafones.gra_cod,
                                                                SUBSTRING(personals.per_cm,1,3),
                                                                personal_ascenso_promociones.antiguedad");
        //FIN SOFS SGTOS MUSICOS
        //OF SOFS SGTOS DE SERVICIO
        $escalafon_serv = pg_query($conn,"SELECT escalafones.nombre
                                                FROM escalafones 
                                                INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                                INNER JOIN vista_grado_anterior_serv ON personal_escalafones.per_codigo = vista_grado_anterior_serv.antserv_percodigo 
                                                INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_serv.antserv_percodigo = personal_ascenso_promociones.per_codigo
                                                WHERE  personal_escalafones.estado =1 
                                                AND (personal_escalafones.subesc_cod=7 OR personal_escalafones.subesc_cod=8)
                                                AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                GROUP BY escalafones.id,escalafones.nombre
                                                ORDER BY  escalafones.id");
        $al_grado_serv = pg_query($conn,"SELECT grados.nombre,
                                                    grados.id as graid
                                                FROM grados 
                                                    INNER JOIN personal_escalafones ON personal_escalafones.gra_cod = grados.id 
                                                    INNER JOIN vista_grado_anterior_serv ON personal_escalafones.per_codigo = vista_grado_anterior_serv.antserv_percodigo 
                                                    INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_serv.antserv_percodigo = personal_ascenso_promociones.per_codigo
                                                    INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                                    INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                                WHERE  personal_escalafones.estado =1 
                                                    AND (personal_escalafones.subesc_cod=7 OR personal_escalafones.subesc_cod=8)
                                                    AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                GROUP BY grados.id,grados.nombre
                                                ORDER BY  grados.id");

        $instancia_serv = pg_query($conn,"SELECT  
                                    instancia_ascensos.id as instid,instancia_ascensos.instancia, 
                                    grados.nombre as nomgra,
                                    grados.id as graid
                                    FROM escalafones 
                                    INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                    INNER JOIN vista_grado_anterior_serv ON personal_escalafones.per_codigo = vista_grado_anterior_serv.antserv_percodigo 
                                    INNER JOIN grados ON personal_escalafones.gra_cod = grados.id 
                                    INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_serv.antserv_percodigo = personal_ascenso_promociones.per_codigo
                                    INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                    INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                    WHERE  personal_escalafones.estado =1 
                                    AND (personal_escalafones.subesc_cod=7 OR personal_escalafones.subesc_cod=8)
                                    AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                    GROUP BY  personal_escalafones.esca_cod,
                                        personal_escalafones.subesc_cod,
                                        instancia_ascensos.id,
                                        personal_escalafones.gra_cod, instancia_ascensos.instancia, nomgra,
                                    graid
                                    ORDER BY  personal_escalafones.esca_cod,
                                        personal_escalafones.subesc_cod,
                                        personal_escalafones.gra_cod, instancia_ascensos.id");

        $personal_ascensos_serv = pg_query($conn,"SELECT subescalafones.nombre, 
                                                            escalafones.nombre, 
                                                            instancia_ascensos.id as instid, 
                                                            grados.nombre as nomgra,
                                                            grados.id as graid,
                                                            REPLACE(vista_grado_anterior_serv.antserv_grado,'...','.') as antserv_grado,
                                                            vista_grado_anterior_serv.antserv_estudio,
                                                            vista_grado_anterior_serv.antserv_paterno, 
                                                            vista_grado_anterior_serv.antserv_materno,
                                                            vista_grado_anterior_serv.antserv_nombre,
                                                            personal_ascenso_promociones.antigfin, 
                                                            personal_ascenso_promociones.observacion, 
                                                            personal_ascenso_promociones.fechasc
                                                        FROM escalafones 
                                                        INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                                        INNER JOIN vista_grado_anterior_serv ON personal_escalafones.per_codigo = vista_grado_anterior_serv.antserv_percodigo 
                                                        INNER JOIN grados ON personal_escalafones.gra_cod = grados.id 
                                                        INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_serv.antserv_percodigo = personal_ascenso_promociones.per_codigo
                                                        INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                                        INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                                        WHERE  personal_escalafones.estado =1 
                                                        AND (personal_escalafones.subesc_cod=7 OR personal_escalafones.subesc_cod=8)
                                                        AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                        ORDER BY  personal_escalafones.esca_cod,
                                                                personal_escalafones.subesc_cod,
                                                                personal_escalafones.gra_cod,
                                                                personal_ascenso_promociones.antiguedad");
        //FIN OF SOFS SGTOS DE SERVICIO
        //CIVIL
        $escalafon_civ = pg_query($conn,"SELECT escalafones.nombre
                                                FROM escalafones 
                                                INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                                INNER JOIN vista_grado_anterior_civ ON personal_escalafones.per_codigo = vista_grado_anterior_civ.antciv_percodigo 
                                                INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_civ.antciv_percodigo = personal_ascenso_promociones.per_codigo
                                                WHERE  personal_escalafones.estado =1 
                                                AND (personal_escalafones.subesc_cod=9 OR personal_escalafones.subesc_cod=10 OR personal_escalafones.subesc_cod=11 OR personal_escalafones.subesc_cod=12)
                                                AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                GROUP BY escalafones.id,escalafones.nombre
                                                ORDER BY  escalafones.id");

        

        $al_grado_civ = pg_query($conn,"SELECT grados.nombre,
                                                    grados.id as graid
                                                FROM grados 
                                                    INNER JOIN personal_escalafones ON personal_escalafones.gra_cod = grados.id 
                                                    INNER JOIN vista_grado_anterior_civ ON personal_escalafones.per_codigo = vista_grado_anterior_civ.antciv_percodigo 
                                                    INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_civ.antciv_percodigo = personal_ascenso_promociones.per_codigo
                                                    INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                                    INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                                WHERE  personal_escalafones.estado =1 
                                                    AND (personal_escalafones.subesc_cod=9 OR personal_escalafones.subesc_cod=10 OR personal_escalafones.subesc_cod=11 OR personal_escalafones.subesc_cod=12)
                                                    AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                GROUP BY grados.id,grados.nombre
                                                ORDER BY  grados.id");

        $instancia_civ = pg_query($conn,"SELECT  
                                instancia_ascensos.id as instid,instancia_ascensos.instancia, 
                                grados.nombre as nomgra,
                                grados.id as graid
                                FROM escalafones 
                                INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                INNER JOIN vista_grado_anterior_civ ON personal_escalafones.per_codigo = vista_grado_anterior_civ.antciv_percodigo 
                                INNER JOIN grados ON personal_escalafones.gra_cod = grados.id 
                                INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_civ.antciv_percodigo = personal_ascenso_promociones.per_codigo
                                INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                WHERE  personal_escalafones.estado =1 
                                AND (personal_escalafones.subesc_cod=9 OR personal_escalafones.subesc_cod=10 OR personal_escalafones.subesc_cod=11 OR personal_escalafones.subesc_cod=12)
                                AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                GROUP BY  personal_escalafones.esca_cod,
                                    personal_escalafones.subesc_cod,
                                    instancia_ascensos.id,
                                    personal_escalafones.gra_cod, instancia_ascensos.instancia, nomgra,
                                graid
                                ORDER BY  personal_escalafones.esca_cod,
                                    personal_escalafones.subesc_cod,
                                    personal_escalafones.gra_cod, instancia_ascensos.id");

        $personal_ascensos_civ = pg_query($conn,"SELECT subescalafones.nombre, 
                                                            escalafones.nombre, 
                                                            instancia_ascensos.id as instid,  
                                                            grados.nombre as nomgra,
                                                            grados.id as graid,
                                                            REPLACE(vista_grado_anterior_civ.antciv_grado,'...','.') as antciv_grado,
                                                            vista_grado_anterior_civ.antciv_estudio,
                                                            vista_grado_anterior_civ.antciv_paterno, 
                                                            vista_grado_anterior_civ.antciv_materno,
                                                            vista_grado_anterior_civ.antciv_nombre,
                                                            personal_ascenso_promociones.antigfin, 
                                                            personal_ascenso_promociones.observacion, 
                                                            personal_ascenso_promociones.fechasc
                                                        FROM escalafones 
                                                        INNER JOIN personal_escalafones ON escalafones.id = personal_escalafones.esca_cod 
                                                        INNER JOIN vista_grado_anterior_civ ON personal_escalafones.per_codigo = vista_grado_anterior_civ.antciv_percodigo 
                                                        INNER JOIN grados ON personal_escalafones.gra_cod = grados.id 
                                                        INNER JOIN personal_ascenso_promociones ON vista_grado_anterior_civ.antciv_percodigo = personal_ascenso_promociones.per_codigo
                                                        INNER JOIN instancia_ascensos ON personal_ascenso_promociones.instasc_cod = instancia_ascensos.id 
                                                        INNER JOIN subescalafones ON personal_escalafones.subesc_cod = subescalafones.id
                                                        WHERE  personal_escalafones.estado =1 
                                                        AND (personal_escalafones.subesc_cod=9 OR personal_escalafones.subesc_cod=10 OR personal_escalafones.subesc_cod=11 OR personal_escalafones.subesc_cod=12)
                                                        AND personal_ascenso_promociones.fechasc between '2022/12/30' and '2023/12/31'
                                                        ORDER BY  personal_escalafones.esca_cod,
                                                                personal_escalafones.subesc_cod,
                                                                personal_escalafones.gra_cod,
                                                                personal_ascenso_promociones.antiguedad");
        //FIN CIVIL

        $pdf = new ordenGeneralAscensoController ('P','mm','Letter');
        $title = 'ORDEN DE ASCENSOS';
        $pdf->SetTitle($title);
        $pdf->SetX(20);
        $pdf->AliasNbPages();
        $fecha = date("dHi-M-Y");
        $alias = '{nb}';
        $at = intval($alias) - 1;
        $pdf->Ln(5);

        global $p;
        global $orden;
        $orden = 'ascenso';
        global $pagina;
        global $ges_act;
        $ges_act = $gestion_actual;

        for ( $p=0; $p<=4; $p++) { 
            //INCIO PARTE 1
            if($p == 0){
                $pdf->StartPageGroup();
                $pdf->AddPage();
                $pdf->SetY(20);
                $pdf->SetX(30);
                $pdf->Cell(166,239,'',1,0,'L');
                $pdf->SetY(21);
                $pdf->SetX(31);
                $pdf->Cell(164,237,'',1,0,'L');
                $pdf->SetFont('Arial','B',12);
                $pdf->SetY(30);
                $pdf->SetX(35);
                $pdf->Cell(86,5,utf8_decode('FUERZA AÉREA BOLIVIANA'),0,0,'C');
                $pdf->SetY(35);
                $pdf->SetX(35);
                $pdf->Cell(86,5,utf8_decode('DEPARTAMENTO I - PERSONAL EMGFAB.'),0,0,'C');
                $pdf->SetFont('Arial','BU',12);
                $pdf->SetY(40);
                $pdf->SetX(35);
                $pdf->Cell(86,5,utf8_decode('BOLIVIA'),0,0,'C');
                $pdf->Image('./img/gallineta_sinfondo.png',40,50,146,80);
                $pdf->SetFont('Arial','B',30);
                $pdf->SetY(140);
                $pdf->SetX(30);
                $pdf->Cell(166,15,utf8_decode('ORDEN GENERAL'),0,0,'C');
                $pdf->SetY(155);
                $pdf->SetX(30);
                $pdf->Cell(166,15,utf8_decode('DE ASCENSOS'),0,0,'C');
                $pdf->SetFont('Arial','B',20);
                $pdf->SetY(190);
                $pdf->SetX(30);
                // $gestion_abreviada = date("y");
                $gestion_abreviada = substr($gestion_actual, 2, 2);
                $pdf->Cell(166,15,utf8_decode('Nº 01/'.$gestion_abreviada),0,0,'C');
                $pdf->SetY(230);
                $pdf->SetX(30);
                $orden_gestion = $gestion_actual + 1;
                $pdf->Cell(166,15,utf8_decode('PARA LA GESTIÓN '.$orden_gestion),0,0,'C');
                $pdf->Ln();
            }
            elseif($p == 1){
                $pdf->StartPageGroup();
                $pdf->AddPage();
                $pdf->SetX(20);
                $pdf->Bookmark(utf8_decode('PRIMERA PARTE'),false);
                $pdf->Bookmark(utf8_decode('ASCENSOS'),false);
                // $pdf->AddPage();
                $pdf->SetFont('Arial','B',11);
                $pdf->SetX(20);
                $pdf->MultiCell(176,5,utf8_decode('ASCENSOS EN LA CATEGORÍA DE OFICIALES SUPERIORES Y OFICIALES SUBALTERNOS.'),0);
                $pdf->Ln(2);
                $pdf->SetFont('Arial','',11);
                $pdf->SetX(20);
                $pdf->MultiCell(176,5,utf8_decode('En cumplimiento al Art.65°. - Inciso ñ) de la Ley Orgánica de las FF.AA. de la Nación (LOFA. 1405), previa autorización del Señor Comandante en Jefe de las FF.AA., en conformidad del Señor Ministro de Defensa Nacional y la Aprobación del Señor Presidente Constitucional del Estado Plurinacional.'),0);
                while($escaof = pg_fetch_array($escalafon_oficiales)){
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetX(20);
                    $pdf->Bookmark(utf8_decode('ESCALAFÓN DE '.$escaof['nombre']),false,1);
                    $pdf->Cell(176,7,utf8_decode('ESCALAFÓN DE '.$escaof['nombre']),0,0,'L');
                    $pdf->Ln();
                    pg_result_seek($al_grado_oficiales, 0);
                    while($algraof = pg_fetch_array($al_grado_oficiales)){
                        $pdf->SetFont('Arial','B',11);
                        $pdf->SetX(25);
                        $pdf->Bookmark(utf8_decode('AL GRADO DE '.$algraof['nombre']),false,2);
                        $pdf->Cell(176,7,utf8_decode('AL GRADO DE '.$algraof['nombre']),0,0,'L');
                        $pdf->Ln();
                        pg_result_seek($instancia_oficiales, 0);
                        while($inst = pg_fetch_array($instancia_oficiales)){
                            if($inst['graid'] == $algraof['graid']){
                                $pdf->SetFont('Arial','B',10);
                                $pdf->SetX(30);
                                if($inst['instid'] != 1){
                                $pdf->Cell(176,7,utf8_decode($inst['instancia']),0,0,'L');
                                $pdf->Ln();
                                }
                                pg_result_seek($personal_ascensos_oficiales, 0);
                                while($ascof = pg_fetch_array($personal_ascensos_oficiales)){
                                    if($ascof['instid'] == $inst['instid'] && $ascof['graid'] == $algraof['graid']){
                                        if($ascof['graid'] != 9){
                                            $pdf->SetFont('Arial','',10);
                                            $pdf->SetX(30);
                                            $pdf->Cell(120,7,utf8_decode($ascof['antof_grado'].$ascof['antof_estudio'].' '.$ascof['antof_nombre'].' '.$ascof['antof_paterno'].' '.$ascof['antof_materno']),0,0,'L');
                                            $pdf->SetX(150);
                                            $pdf->Cell(30,7,utf8_decode($ascof['antigfin']),0,0,'R');
                                            $pdf->Ln();
                                        }else{
                                            $pdf->SetFont('Arial','',10);
                                            $pdf->SetX(30);
                                            $pdf->Cell(120,7,utf8_decode('CDTE. IV. '.$ascof['antof_nombre'].' '.$ascof['antof_paterno'].' '.$ascof['antof_materno']),0,0,'L');
                                            $pdf->SetX(150);
                                            $pdf->Cell(30,7,utf8_decode($ascof['antigfin']),0,0,'R');
                                            $pdf->Ln();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',11);
                $pdf->SetX(20);
                $pdf->MultiCell(176,5,utf8_decode('ASCENSOS EN LA CATEGORÍA DE SUBOFICIALES Y SARGENTOS TECNICOS.'),0);
                $pdf->Ln(2);
                $pdf->SetFont('Arial','',11);
                $pdf->SetX(20);
                $pdf->MultiCell(176,5,utf8_decode('En cumplimiento al Art.65°. - Inciso ñ) de la Ley Orgánica de las FF.AA. de la Nación (LOFA. 1405), previa autorización del Señor Comandante en Jefe de las FF.AA., en conformidad del Señor Ministro de Defensa Nacional y la Aprobación del Señor Presidente Constitucional del Estado Plurinacional.'),0);
                while($escasoftec = pg_fetch_array($escalafon_softec)){
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetX(20);
                    $pdf->Bookmark(utf8_decode('ESCALAFÓN DE '.$escasoftec['nombre']),false,1);
                    $pdf->Cell(176,7,utf8_decode('ESCALAFÓN DE '.$escasoftec['nombre']),0,0,'L');
                    $pdf->Ln();
                    pg_result_seek($al_grado_softec, 0);
                    while($algrasoftec = pg_fetch_array($al_grado_softec)){
                        $pdf->SetFont('Arial','B',11);
                        $pdf->SetX(25);
                        $pdf->Bookmark(utf8_decode('AL GRADO DE '.$algrasoftec['nombre']),false,2);
                        $pdf->Cell(176,7,utf8_decode('AL GRADO DE '.$algrasoftec['nombre']),0,0,'L');
                        $pdf->Ln();
                        pg_result_seek($instancia_softec, 0);
                        while($inst_tec = pg_fetch_array($instancia_softec)){
                            if($inst_tec['graid'] == $algrasoftec['graid']){
                                $pdf->SetFont('Arial','B',10);
                                $pdf->SetX(30);
                                if($inst_tec['instid'] != 1){
                                $pdf->Cell(176,7,utf8_decode($inst_tec['instancia']),0,0,'L');
                                $pdf->Ln();
                                }
                                pg_result_seek($personal_ascensos_softec, 0);
                                while($ascsoftec = pg_fetch_array($personal_ascensos_softec)){
                                    if($ascsoftec['instid'] == $inst_tec['instid'] && $ascsoftec['graid'] == $algrasoftec['graid']){
                                        if($ascsoftec['graid'] != 17){
                                            $pdf->SetFont('Arial','',10);
                                            $pdf->SetX(30);
                                            $pdf->Cell(120,7,utf8_decode($ascsoftec['antsoftec_grado'].$ascsoftec['antsoftec_estudio'].' '.$ascsoftec['antsoftec_nombre'].' '.$ascsoftec['antsoftec_paterno'].' '.$ascsoftec['antsoftec_materno']),0,0,'L');
                                            $pdf->SetX(150);
                                            $pdf->Cell(30,7,utf8_decode($ascsoftec['antigfin']),0,0,'R');
                                            $pdf->Ln();
                                        }else{
                                            $pdf->SetFont('Arial','',10);
                                            $pdf->SetX(30);
                                            $pdf->Cell(120,7,utf8_decode('ALM. III. '.$ascsoftec['antsoftec_nombre'].' '.$ascsoftec['antsoftec_paterno'].' '.$ascsoftec['antsoftec_materno']),0,0,'L');
                                            $pdf->SetX(150);
                                            $pdf->Cell(30,7,utf8_decode($ascsoftec['antigfin']),0,0,'R');
                                            $pdf->Ln();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $pdf->AddPage();
                $pdf->SetFont('Arial','B',11);
                $pdf->SetX(20);
                $pdf->MultiCell(176,5,utf8_decode('ASCENSOS EN LA CATEGORÍA DE SUBOFICIALES Y SARGENTOS DE MUSICA.'),0);
                $pdf->Ln(2);
                $pdf->SetFont('Arial','',11);
                $pdf->SetX(20);
                $pdf->MultiCell(176,5,utf8_decode('En cumplimiento al Art.65°. - Inciso ñ) de la Ley Orgánica de las FF.AA. de la Nación (LOFA. 1405), previa autorización del Señor Comandante en Jefe de las FF.AA., en conformidad del Señor Ministro de Defensa Nacional y la Aprobación del Señor Presidente Constitucional del Estado Plurinacional.'),0);
                while($escasofmus = pg_fetch_array($escalafon_sofmus)){
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetX(20);
                    $pdf->Bookmark(utf8_decode('ESCALAFÓN DE '.$escasofmus['nombre']),false,1);
                    $pdf->Cell(176,7,utf8_decode('ESCALAFÓN DE '.$escasofmus['nombre']),0,0,'L');
                    $pdf->Ln();
                    pg_result_seek($al_grado_sofmus, 0);
                    while($algrasofmus = pg_fetch_array($al_grado_sofmus)){
                        $pdf->SetFont('Arial','B',11);
                        $pdf->SetX(25);
                        $pdf->Bookmark(utf8_decode('AL GRADO DE '.$algrasofmus['nombre']),false,2);
                        $pdf->Cell(176,7,utf8_decode('AL GRADO DE '.$algrasofmus['nombre']),0,0,'L');
                        $pdf->Ln();
                        pg_result_seek($instancia_sofmus, 0);
                        while($inst_mus = pg_fetch_array($instancia_sofmus)){
                            if($inst_mus['graid'] == $algrasofmus['graid']){
                                $pdf->SetFont('Arial','B',10);
                                $pdf->SetX(30);
                                if($inst_mus['instid'] != 1){
                                $pdf->Cell(176,7,utf8_decode($inst_mus['instancia']),0,0,'L');
                                $pdf->Ln();
                                }
                                pg_result_seek($personal_ascensos_sofmus, 0);
                                while($ascsofmus = pg_fetch_array($personal_ascensos_sofmus)){
                                    if($ascsofmus['instid'] == $inst_mus['instid'] && $ascsofmus['graid'] == $algrasofmus['graid']){
                                        if($ascsofmus['graid'] != 172){
                                            $pdf->SetFont('Arial','',10);
                                            $pdf->SetX(30);
                                            $pdf->Cell(120,7,utf8_decode($ascsofmus['antsofmus_grado'].$ascsofmus['antsofmus_estudio'].' '.$ascsofmus['antsofmus_nombre'].' '.$ascsofmus['antsofmus_paterno'].' '.$ascsofmus['antsofmus_materno']),0,0,'L');
                                            $pdf->SetX(150);
                                            $pdf->Cell(30,7,utf8_decode($ascsofmus['antigfin']),0,0,'R');
                                            $pdf->Ln();
                                        }else{
                                            $pdf->SetFont('Arial','',10);
                                            $pdf->SetX(30);
                                            $pdf->Cell(120,7,utf8_decode('ALM. III. '.$ascsofmus['antsofmus_nombre'].' '.$ascsofmus['antsofmus_paterno'].' '.$ascsofmus['antsofmus_materno']),0,0,'L');
                                            $pdf->SetX(150);
                                            $pdf->Cell(30,7,utf8_decode($ascsofmus['antigfin']),0,0,'R');
                                            $pdf->Ln();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $pdf->AddPage();
                $pdf->SetFont('Arial','B',11);
                $pdf->SetX(20);
                $pdf->MultiCell(176,5,utf8_decode('ASCENSOS PARA SEÑORES OFICIALES, SUBOFICIALES Y SARGENTOS DE SERVICIOS.'),0);
                $pdf->Ln(2);
                $pdf->SetFont('Arial','',11);
                $pdf->SetX(20);
                $pdf->MultiCell(176,5,utf8_decode('En cumplimiento al Art.65°. - Inciso ñ) de la Ley Orgánica de las FF.AA. de la Nación (LOFA. 1405), previa autorización del Señor Comandante en Jefe de las FF.AA., en conformidad del Señor Ministro de Defensa Nacional y la Aprobación del Señor Presidente Constitucional del Estado Plurinacional.'),0);
                while($escaserv = pg_fetch_array($escalafon_serv)){
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetX(20);
                    $pdf->Bookmark(utf8_decode('ESCALAFÓN DE '.$escaserv['nombre']),false,1);
                    $pdf->Cell(176,7,utf8_decode('ESCALAFÓN DE '.$escaserv['nombre']),0,0,'L');
                    $pdf->Ln();
                    pg_result_seek($al_grado_serv, 0);
                    while($algraserv = pg_fetch_array($al_grado_serv)){
                        $pdf->SetFont('Arial','B',11);
                        $pdf->SetX(25);
                        $pdf->Bookmark(utf8_decode('AL GRADO DE '.$algraserv['nombre']),false,2);
                        $pdf->Cell(176,7,utf8_decode('AL GRADO DE '.$algraserv['nombre']),0,0,'L');
                        $pdf->Ln();
                        pg_result_seek($instancia_serv, 0);
                        while($inst_serv = pg_fetch_array($instancia_serv)){
                            if($inst_serv['graid'] == $algraserv['graid']){
                                $pdf->SetFont('Arial','B',10);
                                $pdf->SetX(30);
                                if($inst_serv['instid'] != 1){
                                $pdf->Cell(176,7,utf8_decode($inst_serv['instancia']),0,0,'L');
                                $pdf->Ln();
                                }
                                pg_result_seek($personal_ascensos_serv, 0);
                                while($ascserv = pg_fetch_array($personal_ascensos_serv)){
                                    if($ascserv['instid'] == $inst_serv['instid'] && $ascserv['graid'] == $algraserv['graid']){
                                        if($ascserv['graid'] != 172){
                                            $pdf->SetFont('Arial','',10);
                                            $pdf->SetX(30);
                                            $pdf->Cell(120,7,utf8_decode($ascserv['antserv_grado'].$ascserv['antserv_estudio'].' '.$ascserv['antserv_nombre'].' '.$ascserv['antserv_paterno'].' '.$ascserv['antserv_materno']),0,0,'L');
                                            $pdf->SetX(150);
                                            $pdf->Cell(30,7,utf8_decode($ascserv['antigfin']),0,0,'R');
                                            $pdf->Ln();
                                        }else{
                                            $pdf->SetFont('Arial','',10);
                                            $pdf->SetX(30);
                                            $pdf->Cell(120,7,utf8_decode('Sr. '.$ascserv['antserv_nombre'].' '.$ascserv['antserv_paterno'].' '.$ascserv['antserv_materno']),0,0,'L');
                                            $pdf->SetX(150);
                                            $pdf->Cell(30,7,utf8_decode($ascserv['antigfin']),0,0,'R');
                                            $pdf->Ln();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $pdf->AddPage();
                $pdf->SetFont('Arial','B',11);
                $pdf->SetX(20);
                $pdf->MultiCell(176,5,utf8_decode('ASCENSOS PARA EL PERSONAL CIVIL.'),0);
                $pdf->Ln(2);
                $pdf->SetFont('Arial','',11);
                $pdf->SetX(20);
                $pdf->MultiCell(176,5,utf8_decode('En cumplimiento al Art.65°. - Inciso ñ) de la Ley Orgánica de las FF.AA. de la Nación (LOFA. 1405), previa autorización del Señor Comandante en Jefe de las FF.AA., en conformidad del Señor Ministro de Defensa Nacional y la Aprobación del Señor Presidente Constitucional del Estado Plurinacional.'),0);
                while($escaciv = pg_fetch_array($escalafon_civ)){
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetX(20);
                    $pdf->Bookmark(utf8_decode('ESCALAFÓN DE '.$escaciv['nombre']),false,1);
                    $pdf->Cell(176,7,utf8_decode('ESCALAFÓN DE '.$escaciv['nombre']),0,0,'L');
                    $pdf->Ln();
                    pg_result_seek($al_grado_civ, 0);
                    while($algraciv = pg_fetch_array($al_grado_civ)){
                        $pdf->SetFont('Arial','B',11);
                        $pdf->SetX(25);
                        $pdf->Bookmark(utf8_decode('AL GRADO DE '.$algraciv['nombre']),false,2);
                        $pdf->Cell(176,7,utf8_decode('AL GRADO DE '.$algraciv['nombre']),0,0,'L');
                        $pdf->Ln();
                        pg_result_seek($instancia_civ, 0);
                        while($inst_civ = pg_fetch_array($instancia_civ)){
                            if($inst_civ['graid'] == $algraciv['graid']){
                                $pdf->SetFont('Arial','B',10);
                                $pdf->SetX(30);
                                if($inst_civ['instid'] != 1){
                                $pdf->Cell(176,7,utf8_decode($inst_civ['instancia']),0,0,'L');
                                $pdf->Ln();
                                }
                                pg_result_seek($personal_ascensos_civ, 0);
                                while($ascciv = pg_fetch_array($personal_ascensos_civ)){
                                    if($ascciv['instid'] == $inst_civ['instid'] && $ascciv['graid'] == $algraciv['graid']){
                                        if($ascciv['graid'] != 172){
                                            $pdf->SetFont('Arial','',10);
                                            $pdf->SetX(30);
                                            $pdf->Cell(120,7,utf8_decode($ascciv['antciv_grado'].$ascciv['antciv_estudio'].' '.$ascciv['antciv_nombre'].' '.$ascciv['antciv_paterno'].' '.$ascciv['antciv_materno']),0,0,'L');
                                            $pdf->SetX(150);
                                            $pdf->Cell(30,7,utf8_decode($ascciv['antigfin']),0,0,'R');
                                            $pdf->Ln();
                                        }else{
                                            $pdf->SetFont('Arial','',10);
                                            $pdf->SetX(30);
                                            $pdf->Cell(120,7,utf8_decode('Sr. '.$ascciv['antciv_nombre'].' '.$ascciv['antciv_paterno'].' '.$ascciv['antciv_materno']),0,0,'L');
                                            $pdf->SetX(150);
                                            $pdf->Cell(30,7,utf8_decode($ascciv['antigfin']),0,0,'R');
                                            $pdf->Ln();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }//FIN PARTE 1
            //INICIO PARTE 2
            elseif($p == 2){
                // $pdf->StartPageGroup();
                $pdf->AddPage();
                $pdf->SetX(20);
                $pdf->Bookmark(utf8_decode('SEGUNDA PARTE'),false);
                $pdf->Bookmark(utf8_decode('CAMBIO DE ESCALAFON'),false);
                // while($ent = pg_fetch_array($entidad)){
                //     $pdf->SetFont('Arial','B',10);
                //     $pdf->SetX(20);
                //     if($ent['ogd'] == 1){
                //     $pdf->Bookmark(utf8_decode($ent['descripcion']),false,1);
                //     $pdf->Cell(176,7,utf8_decode($ent['descripcion']),0,0,'L');
                //     $pdf->Ln();
                //     }else{
                //         $pdf->Ln(0);
                //     }
                //     pg_result_seek($gran_unidad, 0);
                //     while($gu = pg_fetch_array($gran_unidad)){
                //         if($gu['d1cod'] == $ent['iddestn1']){
                //             $pdf->SetFont('Arial','B',9);
                //             $pdf->SetX(22,5);
                //             if($gu['ogd'] == 1){
                //             $pdf->Bookmark(utf8_decode($gu['descripcion']),false,2);
                //             $pdf->Cell(176,7,utf8_decode($gu['descripcion']),0,0,'L');
                //             $pdf->Ln();
                //             }else{
                //                 $pdf->Ln(0);
                //             }
                //             pg_result_seek($reparticion, 0);
                //             while($rep = pg_fetch_assoc($reparticion)){
                //                 if($rep['d2cod'] == $gu['iddestn2']){
                //                     $pdf->SetFont('Arial','B',9);
                //                     $pdf->SetX(25);
                //                     if($rep['ogd'] == 1){
                //                     $pdf->Bookmark(utf8_decode($rep['descripcion']),false,3);
                //                     $pdf->Cell(176,7,utf8_decode($rep['descripcion']),0,0,'L');
                //                     $pdf->Ln();
                //                     }else{
                //                         $pdf->Ln(0);
                //                     }
                //                     pg_result_seek($subreparticion, 0);
                //                     while($subrep = pg_fetch_assoc($subreparticion)){
                //                         if($subrep['d3cod'] == $rep['iddestn3']){
                //                             $pdf->SetFont('Arial','B',9);
                //                             $pdf->SetX(27,5);
                //                             if($subrep['ogd'] == 1){
                //                             $pdf->Cell(176,7,utf8_decode($subrep['descripcion']),0,0,'L');
                //                             $pdf->Ln();
                //                             }else{
                //                                 $pdf->Ln(0);
                //                             }
                //                             // while($pd1 = pg_fetch_assoc($personalDestinos1)){
                //                             //     if($pd1['d4_cod'] == $subrep['iddestn4']){
                //                             //         $pdf->SetFont('Arial','',9);
                //                             //         $pdf->SetX(27,5);
                //                             //         $pdf->Cell(100,7,utf8_decode($pd1['grado'].$pd1['complemento'].' '.$pd1['per_nombre'].' '.$pd1['per_paterno'].' '.$pd1['per_materno']),0,0,'L');
                //                             //         $pdf->SetX(127,5);
                //                             //         $pdf->Cell(40,7,utf8_decode($pd1['descripcion']),0,0,'L');
                //                             //         // pg_result_seek($personalDestinos2, 0);
                //                             //         // while($pd2 = pg_fetch_assoc($personalDestinos2)){
                //                             //         //     if($pd2['idpersonal_destinos'] == $pd1['idpersonal_destinos']){
                //                             //         //         $pdf->SetFont('Arial','',9);
                //                             //         //         $pdf->SetX(165);
                //                             //         //         if($pd2['idcargo'] != '369'){
                //                             //         //         $pdf->Cell(36,7,utf8_decode($pd2['descripcion']),0,0,'L');
                //                             //         //         }
                //                             //         //     }
                //                             //         // }
                //                             //         $pdf->Ln(); 
                //                             //     }
                //                             // }
                //                             $pdf->SetFont('Arial','',9);
                //                             $pdf->SetWidths(Array(100,43,43));
                //                             $pdf->SetAligns(Array('L','L'));
                //                             $pdf->SetLineHeight(7); 
                //                             pg_result_seek($personalDestinos1, 0);
                //                             while($pd1 = pg_fetch_assoc($personalDestinos1)){
                //                                 if($pd1['d4_cod'] == $subrep['iddestn4']){
                //                                     pg_result_seek($personalDestinos2, 0);
                //                                     while($pd2 = pg_fetch_assoc($personalDestinos2)){
                //                                         if($pd2['idpersonal_destinos'] == $pd1['idpersonal_destinos']){
                //                                             $pdf->SetFont('Arial','',9);
                //                                             $pdf->SetX(165);
                //                                             if($pd2['idcargo'] != '369'){
                //                                             // $pdf->Cell(36,7,utf8_decode($pd2['descripcion']),0,0,'L');
                //                                                 $sdo_cargo = utf8_decode($pd2['descripcion']);
                //                                             }else{
                //                                                 $sdo_cargo = utf8_decode('');
                //                                             }

                //                                         }
                //                                     }
                //                                     $pdf->Row(Array(  
                //                                         utf8_decode($pd1['grado'].$pd1['complemento'].' '.$pd1['per_nombre'].' '.$pd1['per_paterno'].' '.$pd1['per_materno']),
                //                                         utf8_decode($pd1['descripcion']),
                //                                         utf8_decode($sdo_cargo) 
                //                                     ));
                //                                 }
                //                             }
                //                         }
                //                     }
                //                 }
                //             }
                //         }
                //     }
                // }
                $pdf->Ln();
            }//FIN PARTE 2
            //INICIO PARTE 3
            elseif($p == 3){
                // $pdf->StartPageGroup();
                $pdf->AddPage();
                // $pdf->Bookmark(utf8_decode('TERCERA PARTE'),false);
                // $pdf->AddPage();
                $pdf->Ln(30);
                $pdf->SetFont('Arial','',12);
                $pdf->SetX(20);
                $pdf->Cell(125,5,utf8_decode($cmdtefab),0,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial','B',12);
                $pdf->SetX(20);
                // $pdf->Bookmark(utf8_decode('FIRMAS'),false,2);
                if($cargoCmdteFAB == 1){
                    $pdf->Cell(125,5,utf8_decode('COMANDANTE GENERAL DE LA FUERZA AÉREA'),0,0,'C');
                }else{
                    $pdf->Cell(125,5,utf8_decode('COMANDANTE GENERAL ACC. DE LA FUERZA AÉREA'),0,0,'C');
                }
                $pdf->Ln(10);
                $pdf->SetFont('Arial','',12);
                $pdf->SetX(70);
                $pdf->Cell(125,5,utf8_decode('AUTORIZADO:'),0,0,'C');
                $pdf->Ln(30);
                $pdf->SetFont('Arial','',12);
                $pdf->SetX(70);
                $pdf->Cell(125,5,utf8_decode($cmdteffaa),0,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial','B',12);
                $pdf->SetX(70);
                if($cargoCmdteFFAA == 1){
                    $pdf->Cell(125,5,utf8_decode('COMANDANTE EN JEFE DE LAS FF.AA. DEL ESTADO'),0,0,'C');
                }else{
                    $pdf->Cell(125,5,utf8_decode('COMANDANTE EN JEFE ACC. DE LAS FF.AA. DEL ESTADO'),0,0,'C');
                }
                $pdf->Ln(10);
                $pdf->SetFont('Arial','',12);
                $pdf->SetX(20);
                $pdf->Cell(90,5,utf8_decode('ES CONFORME:'),0,0,'C');
                $pdf->Ln(30);
                $pdf->SetFont('Arial','',12);
                $pdf->SetX(20);
                $pdf->Cell(90,5,utf8_decode($mindef),0,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial','B',12);
                $pdf->SetX(20);
                $pdf->Cell(90,5,utf8_decode('MINISTRO DE DEFENSA'),0,0,'C');
                $pdf->Ln(10);
                $pdf->SetFont('Arial','',12);
                $pdf->SetX(90);
                $pdf->Cell(100,5,utf8_decode('APROBADO:'),0,0,'C');
                $pdf->Ln(30);
                $pdf->SetFont('Arial','',12);
                $pdf->SetX(90);
                $pdf->Cell(100,5,utf8_decode($presidente),0,0,'C');
                $pdf->Ln();
                $pdf->SetFont('Arial','B',12);
                $pdf->SetX(90);
                $pagina = $pdf->PageNo() - 1;
                $pdf->MultiCell(100,5,utf8_decode('PRESIDENTE DEL ESTADO PLURINACIONAL DE BOLIVIA Y CAPITÁN GENERAL DE LAS FUERZAS ARMADAS'),0,'C');
            }//FIN PARTE 3
            //INCIO INDICE
            elseif($p == 4){
                // $pdf->StartPageGroup();
                $pdf->StartPageGroup();
                $pdf->AddPage();
                $pdf->CreateIndex();
                
                //FIN FIRMAS
            }//FIN INDICE
        }//FIN FOR
        
        $pdf->SetX(20);
        ob_clean();
        $pdf->SetX(20);
        $pdf->Output();
        $pdf->SetX(20);
        exit;
    }
}