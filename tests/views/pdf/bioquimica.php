<?php
require_once '../../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isCssFloatEnabled', true);
$options->set('isJavascriptEnabled', false);
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);

ob_start();
?>

<!DOCTYPE html>
<html>

<?php
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/ClinicController.php';
require_once '../../../controllers/BreedController.php';
require_once '../../../controllers/SpecieController.php';
require_once '../../../controllers/StudyController.php';
require_once '../../../controllers/CaseController.php';
require_once '../../../controllers/ItemController.php';
require_once '../../controllers/ReferenciaController.php';
require_once '../../controllers/BioquimicaController.php';

$bioquimica = $bioquimica_controller->show(isset($_GET['item_id']) ? $_GET['item_id'] : NULL);
$item = $item_controller->show($bioquimica['fk_item_id']);
$study = $study_controller->show($item['fk_study_id']);
$case = $case_controller->show($item['fk_case_id']);
$clinic = $clinic_controller->show($case['fk_clinic_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$referencias = $referencia_controller->show($bioquimica['fk_referencia_id']);

if (isset($referencias)) {
    $bioquimica['glucosa_calculada'] = $referencia_controller->round($bioquimica['glucosa_calculada'], $referencias['glucosa']);
    $bioquimica['urea'] = $referencia_controller->round($bioquimica['urea'], $referencias['urea']);
    $bioquimica['creatinina_calculada'] = $referencia_controller->round($bioquimica['creatinina_calculada'], $referencias['creatinina']);
    $bioquimica['colesterol'] = $referencia_controller->round($bioquimica['colesterol'], $referencias['colesterol']);
    $bioquimica['trigliceridos'] = $referencia_controller->round($bioquimica['trigliceridos'], $referencias['trigliceridos']);
    $bioquimica['bilirrubina_total_calculada'] = $referencia_controller->round($bioquimica['bilirrubina_total_calculada'], $referencias['bilirrubina_total']);
    $bioquimica['bilirrubina_conjugada'] = $referencia_controller->round($bioquimica['bilirrubina_conjugada'], $referencias['bilirrubina_conjugada']);
    $bioquimica['bilirrubina_no_conjugada_calculada'] = $referencia_controller->round($bioquimica['bilirrubina_no_conjugada_calculada'], $referencias['bilirrubina_no_conjugada']);
    $bioquimica['alanina_aminotransferasa'] = $referencia_controller->round($bioquimica['alanina_aminotransferasa'], $referencias['alanina_aminotransferasa']);
    $bioquimica['aspartato_aminotransferasa'] = $referencia_controller->round($bioquimica['aspartato_aminotransferasa'], $referencias['aspartato_aminotransferasa']);
    $bioquimica['fosfatasa_alcalina'] = $referencia_controller->round($bioquimica['fosfatasa_alcalina'], $referencias['fosfatasa_alcalina']);
    $bioquimica['amilasa'] = $referencia_controller->round($bioquimica['amilasa'], $referencias['amilasa']);
    $bioquimica['lipasa'] = $referencia_controller->round($bioquimica['lipasa'], $referencias['lipasa']);
    $bioquimica['creatinacinasa'] = $referencia_controller->round($bioquimica['creatinacinasa'], $referencias['creatinacinasa']);
    $bioquimica['glutamato_deshidrogenasa'] = $referencia_controller->round($bioquimica['glutamato_deshidrogenasa'], $referencias['glutamato_deshidrogenasa']);
    $bioquimica['gamaglutamil_transferasa'] = $referencia_controller->round($bioquimica['gamaglutamil_transferasa'], $referencias['gamaglutamil_transferasa']);
    $bioquimica['proteinas_totales'] = $referencia_controller->round($bioquimica['proteinas_totales'], $referencias['proteinas_totales']);
    $bioquimica['albumina'] = $referencia_controller->round($bioquimica['albumina'], $referencias['albumina']);
    $bioquimica['globulinas_calculadas'] = $referencia_controller->round($bioquimica['globulinas_calculadas'], $referencias['globulinas']);
    $bioquimica['relacion_ag_calculada'] = $referencia_controller->round($bioquimica['relacion_ag_calculada'], $referencias['relacion_ag']);
    $bioquimica['calcio_calculado'] = $referencia_controller->round($bioquimica['calcio_calculado'], $referencias['calcio']);
    $bioquimica['fosforo_calculada'] = $referencia_controller->round($bioquimica['fosforo_calculada'], $referencias['fosforo']);
    $bioquimica['potasio'] = $referencia_controller->round($bioquimica['potasio'], $referencias['potasio']);
    $bioquimica['sodio'] = $referencia_controller->round($bioquimica['sodio'], $referencias['sodio']);
    $bioquimica['relacion_nak_calculada'] = $referencia_controller->round($bioquimica['relacion_nak_calculada'], $referencias['relacion_nak']);
    $bioquimica['cloro'] = $referencia_controller->round($bioquimica['cloro'], $referencias['cloro']);
    $bioquimica['bicarbonato'] = $referencia_controller->round($bioquimica['bicarbonato'], $referencias['bicarbonato']);
    $bioquimica['brecha_anionica_calculada'] = $referencia_controller->round($bioquimica['brecha_anionica_calculada'], $referencias['brecha_anionica']);
    $bioquimica['diferencia_de_iones_fuertes_calculada'] = $referencia_controller->round($bioquimica['diferencia_de_iones_fuertes_calculada'], $referencias['diferencia_de_iones_fuertes']);
    $bioquimica['osmolalidad_calculada'] = $referencia_controller->round($bioquimica['osmolalidad_calculada'], $referencias['osmolalidad']);
    $bioquimica['amonio'] = $referencia_controller->round($bioquimica['amonio'], $referencias['amonio']);
}

require_once '../../templates/head.php';
?>

<body>
    <?php require_once '../../templates/banner.php';

    if (!empty($bioquimica['fecha'])) {
        echo "<div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>FECHA DE OBTENCIÓN DE MUESTRA</b><br>" . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($bioquimica['fecha']))  . "</span>";
        echo "</div>";
        echo "<hr>";
    }

    ?>
    <table class="w3-table w3-tiny">
        <thead>
            <tr>
                <th>ANALITO</th>
                <th class="w3-right-align">RESULTADO</th>
                <th class="w3-right-align">UNIDAD</th>
                <th class="w3-right-align">VALORES DE REFERENCIA</th>
            </tr>
        </thead>
        <?php
        if (isset($bioquimica['glucosa_calculada']) && isset($referencias['glucosa'])) {
            echo "<tr>";
            echo "<td>GLUCOSA</td>";
            echo "<td class='w3-right-align'>{$bioquimica['glucosa_calculada']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['glucosa']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['urea']) && isset($referencias['urea'])) {
            echo "<tr>";
            echo "<td>UREA</td>";
            echo "<td class='w3-right-align'>{$bioquimica['urea']}</td>";
            echo "<td class='w3-right-align'>μmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['urea']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['creatinina_calculada']) && isset($referencias['creatinina'])) {
            echo "<tr>";
            echo "<td>CREATININA</td>";
            echo "<td class='w3-right-align'>{$bioquimica['creatinina_calculada']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['creatinina']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['colesterol']) && isset($referencias['colesterol'])) {
            echo "<tr>";
            echo "<td>COLESTEROL</td>";
            echo "<td class='w3-right-align'>{$bioquimica['colesterol']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['colesterol']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['trigliceridos']) && isset($referencias['trigliceridos'])) {
            echo "<tr>";
            echo "<td>TRIGLICÉRIDOS</td>";
            echo "<td class='w3-right-align'>{$bioquimica['trigliceridos']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['trigliceridos']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['bilirrubina_total_calculada']) && isset($referencias['bilirrubina_total']) && isset($bioquimica['bilirrubina_conjugada']) && isset($referencias['bilirrubina_conjugada'])) {
            if ($bioquimica['bilirrubina_total_calculada'] > $bioquimica['bilirrubina_conjugada']) {
                echo "<tr>";
                echo "<td>BILIRRUBINA TOTAL</td>";
                echo "<td class='w3-right-align'>{$bioquimica['bilirrubina_total_calculada']}</td>";
                echo "<td class='w3-right-align'>μmol/L</td>";
                echo "<td class='w3-right-align'>" . htmlentities($referencias['bilirrubina_total']) . "</td>";
                echo  "</tr>";
            } else {
                echo "<tr>";
                echo "<td>BILIRRUBINA TOTAL</td>";
                echo "<td class='w3-right-align'>{$bioquimica['bilirrubina_conjugada']}</td>";
                echo "<td class='w3-right-align'>μmol/L</td>";
                echo "<td class='w3-right-align'>" . htmlentities($referencias['bilirrubina_total']) . "</td>";
                echo  "</tr>";
            }
        }
        if (isset($bioquimica['bilirrubina_total_calculada']) && isset($referencias['bilirrubina_total']) && isset($bioquimica['bilirrubina_conjugada']) && isset($referencias['bilirrubina_conjugada'])) {
            if ($bioquimica['bilirrubina_total_calculada'] > $bioquimica['bilirrubina_conjugada']) {
                echo "<tr>";
                echo "<td>BILIRRUBINA CONJUGADA</td>";
                echo "<td class='w3-right-align'>{$bioquimica['bilirrubina_conjugada']}</td>";
                echo "<td class='w3-right-align'>μmol/L</td>";
                echo "<td class='w3-right-align'>" . htmlentities($referencias['bilirrubina_conjugada']) . "</td>";
                echo  "</tr>";
            } else {
                echo "<tr>";
                echo "<td>BILIRRUBINA CONJUGADA</td>";
                echo "<td class='w3-right-align'>{$bioquimica['bilirrubina_total_calculada']}</td>";
                echo "<td class='w3-right-align'>μmol/L</td>";
                echo "<td class='w3-right-align'>" . htmlentities($referencias['bilirrubina_conjugada']) . "</td>";
                echo  "</tr>";
            }
        }
        if (isset($bioquimica['bilirrubina_no_conjugada_calculada']) && isset($referencias['bilirrubina_no_conjugada'])) {
            echo "<tr>";
            echo "<td>BILIRRUBINA NO CONJUGADA</td>";
            echo "<td class='w3-right-align'>{$bioquimica['bilirrubina_no_conjugada_calculada']}</td>";
            echo "<td class='w3-right-align'>μmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['bilirrubina_no_conjugada']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['alanina_aminotransferasa']) && isset($referencias['alanina_aminotransferasa'])) {
            echo "<tr>";
            echo "<td>ALANINA AMINOTRANSFERASA (ALT)</td>";
            echo "<td class='w3-right-align'>{$bioquimica['alanina_aminotransferasa']}</td>";
            echo "<td class='w3-right-align'>U/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['alanina_aminotransferasa']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['aspartato_aminotransferasa']) && isset($referencias['aspartato_aminotransferasa'])) {
            echo "<tr>";
            echo "<td>ASPARTATO AMINOTRANSFERASA (AST)</td>";
            echo "<td class='w3-right-align'>{$bioquimica['aspartato_aminotransferasa']}</td>";
            echo "<td class='w3-right-align'>U/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['aspartato_aminotransferasa']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['fosfatasa_alcalina']) && isset($referencias['fosfatasa_alcalina'])) {
            echo "<tr>";
            echo "<td>FOSFATASA ALCALINA (FA)</td>";
            echo "<td class='w3-right-align'>{$bioquimica['fosfatasa_alcalina']}</td>";
            echo "<td class='w3-right-align'>U/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['fosfatasa_alcalina']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['amilasa']) && isset($referencias['amilasa'])) {
            echo "<tr>";
            echo "<td>AMILASA</td>";
            echo "<td class='w3-right-align'>{$bioquimica['amilasa']}</td>";
            echo "<td class='w3-right-align'>U/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['amilasa']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['lipasa']) && isset($referencias['lipasa'])) {
            echo "<tr>";
            echo "<td>LIPASA</td>";
            echo "<td class='w3-right-align'>{$bioquimica['lipasa']}</td>";
            echo "<td class='w3-right-align'>U/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['lipasa']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['creatinacinasa']) && isset($referencias['creatinacinasa'])) {
            echo "<tr>";
            echo "<td>CREATINACINASA (CK)</td>";
            echo "<td class='w3-right-align'>{$bioquimica['creatinacinasa']}</td>";
            echo "<td class='w3-right-align'>U/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['creatinacinasa']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['glutamato_deshidrogenasa']) && isset($referencias['glutamato_deshidrogenasa'])) {
            echo "<tr>";
            echo "<td>GLUTAMATO DESHIDROGENASA (GLDH)</td>";
            echo "<td class='w3-right-align'>{$bioquimica['glutamato_deshidrogenasa']}</td>";
            echo "<td class='w3-right-align'>U/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['glutamato_deshidrogenasa']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['gamaglutamil_transferasa']) && isset($referencias['gamaglutamil_transferasa'])) {
            echo "<tr>";
            echo "<td>GAMAGLUTAMIL TRANSFERASA (GGT)</td>";
            echo "<td class='w3-right-align'>{$bioquimica['gamaglutamil_transferasa']}</td>";
            echo "<td class='w3-right-align'>U/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['gamaglutamil_transferasa']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['proteinas_totales']) && isset($referencias['proteinas_totales'])) {
            echo "<tr>";
            echo "<td>PROTEINAS TOTALES</td>";
            echo "<td class='w3-right-align'>{$bioquimica['proteinas_totales']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['proteinas_totales']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['albumina']) && isset($referencias['albumina'])) {
            echo "<tr>";
            echo "<td>ALBÚMINA</td>";
            echo "<td class='w3-right-align'>{$bioquimica['albumina']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['albumina']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['globulinas_calculadas']) && isset($referencias['globulinas'])) {
            echo "<tr>";
            echo "<td>GLOBULINAS</td>";
            echo "<td class='w3-right-align'>{$bioquimica['globulinas_calculadas']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['globulinas']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['relacion_ag_calculada']) && isset($referencias['relacion_ag'])) {
            echo "<tr>";
            echo "<td>RELACIÓN A/G</td>";
            echo "<td class='w3-right-align'>{$bioquimica['relacion_ag_calculada']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['relacion_ag']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['calcio_calculado']) && isset($referencias['calcio'])) {
            echo "<tr>";
            echo "<td>CALCIO</td>";
            echo "<td class='w3-right-align'>{$bioquimica['calcio_calculado']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['calcio']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['fosforo_calculada']) && isset($referencias['fosforo'])) {
            echo "<tr>";
            echo "<td>FOSFORO</td>";
            echo "<td class='w3-right-align'>{$bioquimica['fosforo_calculada']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['fosforo']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['potasio']) && isset($referencias['potasio'])) {
            echo "<tr>";
            echo "<td>POTASIO</td>";
            echo "<td class='w3-right-align'>{$bioquimica['potasio']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['potasio']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['sodio']) && isset($referencias['sodio'])) {
            echo "<tr>";
            echo "<td>SODIO</td>";
            echo "<td class='w3-right-align'>{$bioquimica['sodio']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['sodio']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['relacion_nak_calculada']) && isset($referencias['relacion_nak'])) {
            echo "<tr>";
            echo "<td>RELACIÓN Na/K</td>";
            echo "<td class='w3-right-align'>{$bioquimica['relacion_nak_calculada']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['relacion_nak']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['cloro']) && isset($referencias['cloro'])) {
            echo "<tr>";
            echo "<td>CLORO</td>";
            echo "<td class='w3-right-align'>{$bioquimica['cloro']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['cloro']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['bicarbonato']) && isset($referencias['bicarbonato'])) {
            echo "<tr>";
            echo "<td>BICARBONATO</td>";
            echo "<td class='w3-right-align'>{$bioquimica['bicarbonato']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['bicarbonato']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['brecha_anionica_calculada']) && isset($referencias['brecha_anionica'])) {
            echo "<tr>";
            echo "<td>ANION GAP</td>";
            echo "<td class='w3-right-align'>{$bioquimica['brecha_anionica_calculada']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['brecha_anionica']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['diferencia_de_iones_fuertes_calculada']) && isset($referencias['diferencia_de_iones_fuertes'])) {
            echo "<tr>";
            echo "<td>DIFERENCIA DE IONES FUERTES</td>";
            echo "<td class='w3-right-align'>{$bioquimica['diferencia_de_iones_fuertes_calculada']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['diferencia_de_iones_fuertes']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['osmolalidad_calculada']) && isset($referencias['osmolalidad'])) {
            echo "<tr>";
            echo "<td>OSMOLALIDAD</td>";
            echo "<td class='w3-right-align'>{$bioquimica['osmolalidad_calculada']}</td>";
            echo "<td class='w3-right-align'>mOsml/Kg</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['osmolalidad']) . "</td>";
            echo  "</tr>";
        }
        if (isset($bioquimica['amonio']) && isset($referencias['amonio'])) {
            echo "<tr>";
            echo "<td>AMONIO</td>";
            echo "<td class='w3-right-align'>{$bioquimica['amonio']}</td>";
            echo "<td class='w3-right-align'>μmol/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['amonio']) . "</td>";
            echo  "</tr>";
        }
        ?>
    </table>
    <hr>
    <?php
    if (isset($bioquimica['observaciones'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>OBSERVACIONES</b><br>" . nl2br(htmlspecialchars($bioquimica['observaciones'])) . "</span><br>";
        echo "</div>";
    }
    if (isset($bioquimica['interpretaciones'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>INTERPRETACIÓN</b><br>"  . nl2br(htmlspecialchars($bioquimica['interpretaciones'])) .  "</span><br>";
        echo "</div>";
    }
    require_once '../../templates/footer.php';
    ?>
</body>

</html>

<?php
$dompdf->loadHtml(ob_get_clean());
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($case['case_number'] . ' - ' . $study['study'], array('Attachment' => 0));
?>