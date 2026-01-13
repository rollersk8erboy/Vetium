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
require_once '../../controllers/HemogramaController.php';

$hemograma = $hemograma_controller->show($_GET['item_id']);
$item = $item_controller->show($hemograma['fk_item_id']);
$study = $study_controller->show($item['fk_study_id']);
$case = $case_controller->show($item['fk_case_id']);
$clinic = $clinic_controller->show($case['fk_clinic_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$referencias = $referencia_controller->show($hemograma['fk_referencia_id']);

if (isset($referencias)) {
    $hemograma['hematocrito'] = $referencia_controller->round($hemograma['hematocrito'], $referencias['hematocrito']);
    $hemograma['eritrocitos_calculados'] = $referencia_controller->round($hemograma['eritrocitos_calculados'], $referencias['eritrocitos']);
    $hemograma['hemoglobina'] = $referencia_controller->round($hemograma['hemoglobina'], $referencias['hemoglobina']);
    $hemograma['vgm_calculada'] = $referencia_controller->round($hemograma['vgm_calculada'], $referencias['vgm']);
    $hemograma['cgmh_calculada'] = $referencia_controller->round($hemograma['cgmh_calculada'], $referencias['cgmh']);
    $hemograma['reticulocitos_calculados'] = $referencia_controller->round($hemograma['reticulocitos_calculados'], $referencias['reticulocitos']);
    $hemograma['plaquetas_calculadas'] = $referencia_controller->round($hemograma['plaquetas_calculadas'], $referencias['plaquetas']);
    $hemograma['solidos_totales'] = $referencia_controller->round($hemograma['solidos_totales'], $referencias['solidos_totales']);
    $hemograma['fibrinogeno_calculado'] = $referencia_controller->round($hemograma['fibrinogeno_calculado'], $referencias['fibrinogeno']);
    $hemograma['relacion_ptfib_calculada'] = $referencia_controller->round($hemograma['relacion_ptfib_calculada'], $referencias['relacion_ptfib']);
    $hemograma['leucocitos_calculados'] = $referencia_controller->round($hemograma['leucocitos_calculados'], $referencias['leucocitos']);
    $hemograma['neutrofilos_calculados'] = $referencia_controller->round($hemograma['neutrofilos_calculados'], $referencias['neutrofilos']);
    $hemograma['bandas_calculadas'] = $referencia_controller->round($hemograma['bandas_calculadas'], $referencias['bandas']);
    $hemograma['metamielocitos_calculados'] = $referencia_controller->round($hemograma['metamielocitos_calculados'], $referencias['metamielocitos']);
    $hemograma['mielocitos_calculados'] = $referencia_controller->round($hemograma['mielocitos_calculados'], $referencias['mielocitos']);
    $hemograma['linfocitos_calculados'] = $referencia_controller->round($hemograma['linfocitos_calculados'], $referencias['linfocitos']);
    $hemograma['monocitos_calculados'] = $referencia_controller->round($hemograma['monocitos_calculados'], $referencias['monocitos']);
    $hemograma['eosinofilos_calculados'] = $referencia_controller->round($hemograma['eosinofilos_calculados'], $referencias['eosinofilos']);
    $hemograma['basofilos_calculados'] = $referencia_controller->round($hemograma['basofilos_calculados'], $referencias['basofilos']);
}


require_once '../../templates/head.php';
?>

<body>
    <?php require_once '../../templates/banner.php';
    if (!empty($hemograma['fecha'])) {
        echo "<div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>FECHA DE OBTENCIÓN DE MUESTRA</b><br>" . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($hemograma['fecha']))  . "</span>";
        echo "</div>";
        echo "<hr>";
    }
    ?>
    <table class="w3-table w3-tiny">
        <thead>
            <tr>
                <th>ANALITO</th>
                <th class="w3-right-align">RESULTADO</th>
                <th class='w3-right-align'>UNIDAD</th>
                <th class="w3-right-align">VALORES DE REFERENCIA</th>
            </tr>
        </thead>
        <?php
        if (isset($hemograma['hematocrito']) && isset($referencias['hematocrito'])) {
            echo "<tr>";
            echo "<td>HEMATOCRITO</td>";
            echo "<td class='w3-right-align'>{$hemograma['hematocrito']}</td>";
            echo "<td class='w3-right-align'>L/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['hematocrito']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['eritrocitos']) && isset($referencias['eritrocitos'])) {
            echo "<tr>";
            echo "<td>ERITROCITOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['eritrocitos_calculados']}</td>";
            echo "<td class='w3-right-align'>x10<sup>12</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['eritrocitos']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['hemoglobina']) && isset($referencias['hemoglobina'])) {
            echo "<tr>";
            echo "<td>HEMOGLOBINA</td>";
            echo "<td class='w3-right-align'>{$hemograma['hemoglobina']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['hemoglobina']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['vgm_calculada']) && isset($referencias['vgm'])) {
            echo "<tr>";
            echo "<td>VGM</td>";
            echo "<td class='w3-right-align'>{$hemograma['vgm_calculada']}</td>";
            echo "<td class='w3-right-align'>fL</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['vgm']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['cgmh_calculada']) && isset($referencias['cgmh'])) {
            echo "<tr>";
            echo "<td>CGMH</td>";
            echo "<td class='w3-right-align'>{$hemograma['cgmh_calculada']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['cgmh']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['reticulocitos_calculados']) && isset($referencias['reticulocitos'])) {
            echo "<tr>";
            echo "<td>RETICULOCITOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['reticulocitos_calculados']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['reticulocitos']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['plaquetas_calculadas']) && isset($referencias['plaquetas'])) {
            echo "<tr>";
            echo "<td>PLAQUETAS</td>";
            echo "<td class='w3-right-align'>{$hemograma['plaquetas_calculadas']}</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['plaquetas']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['solidos_totales']) && isset($referencias['solidos_totales'])) {
            echo "<tr>";
            echo "<td>SÓLIDOS TOTALES</td>";
            echo "<td class='w3-right-align'>{$hemograma['solidos_totales']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['solidos_totales']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['fibrinogeno_calculado']) && isset($referencias['fibrinogeno'])) {
            echo "<tr>";
            echo "<td>FIBRINÓGENO</td>";
            echo "<td class='w3-right-align'>{$hemograma['fibrinogeno_calculado']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['fibrinogeno']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['relacion_ptfib_calculada']) && isset($referencias['relacion_ptfib'])) {
            echo "<tr>";
            echo "<td>RELACIÓN PT/FIB</td>";
            echo "<td class='w3-right-align'>{$hemograma['relacion_ptfib_calculada']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['relacion_ptfib']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['leucocitos_calculados']) && isset($referencias['leucocitos'])) {
            echo "<tr>";
            echo "<td>LEUCOCITOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['leucocitos_calculados']}</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['leucocitos']) . "</td>";
            echo  "</tr>";
        }
        ?>
        <thead>
            <tr>
                <th colspan="4">DIFERENCIAL</th>
            </tr>
        </thead>
        <?php
        if (isset($hemograma['neutrofilos_calculados']) && isset($referencias['neutrofilos'])) {
            echo "<tr>";
            echo "<td>NEUTRÓFILOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['neutrofilos_calculados']}</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['neutrofilos']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['bandas_calculadas']) && isset($referencias['bandas'])) {
            echo "<tr>";
            echo "<td>BANDAS</td>";
            echo "<td class='w3-right-align'>{$hemograma['bandas_calculadas']}</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['bandas']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['metamielocitos_calculados']) && isset($referencias['metamielocitos'])) {
            echo "<tr>";
            echo "<td>METAMIELOCITOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['metamielocitos_calculados']}</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['metamielocitos']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['mielocitos_calculados']) && isset($referencias['mielocitos'])) {
            echo "<tr>";
            echo "<td>MIELOCITOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['mielocitos_calculados']}</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['mielocitos']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['linfocitos_calculados']) && isset($referencias['linfocitos'])) {
            echo "<tr>";
            echo "<td>LINFOCITOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['linfocitos_calculados']}</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['linfocitos']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['monocitos_calculados']) && isset($referencias['monocitos'])) {
            echo "<tr>";
            echo "<td>MONOCITOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['monocitos_calculados']}</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['monocitos']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['eosinofilos_calculados']) && isset($referencias['eosinofilos'])) {
            echo "<tr>";
            echo "<td>EOSINÓFILOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['eosinofilos_calculados']}</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['eosinofilos']) . "</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['basofilos_calculados']) && isset($referencias['basofilos'])) {
            echo "<tr>";
            echo "<td>BASÓFILOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['basofilos_calculados']}</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['basofilos']) . "</td>";
            echo  "</tr>";
        }
        ?>
        <thead>
            <tr>
                <th>MORFOLOGÍA DE ERITROCITOS</th>
            </tr>
        </thead>
        <?php
        if (isset($hemograma['anisocitosis'])) {
            echo "<tr>";
            echo "<td>ANISOCITOSIS</td>";
            echo "<td class='w3-right-align'>{$hemograma['anisocitosis']}</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['policromasia'])) {
            echo "<tr>";
            echo "<td>POLICROMASIA</td>";
            echo "<td class='w3-right-align'>{$hemograma['policromasia']}</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['aglutinacion'])) {
            echo "<tr>";
            echo "<td>AGLUTINACIÓN</td>";
            echo "<td class='w3-right-align'>{$hemograma['aglutinacion']}</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['poiquilocitos'])) {
            echo "<tr>";
            echo "<td>POIQUILOCITOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['poiquilocitos']}</td>";
            echo  "</tr>";
        }
        ?>
        <thead>
            <tr>
                <th>MORFOLOGÍA DE LEUCOCITOS</th>
            </tr>
        </thead>
        <?php
        if (isset($hemograma['neutrofilos_toxicos'])) {
            echo "<tr>";
            echo "<td>NEUTRÓFILOS TÓXICOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['neutrofilos_toxicos']}</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['linfocitos_reactivos'])) {
            echo "<tr>";
            echo "<td>LINFOCITOS REACTIVOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['linfocitos_reactivos']}</td>";
            echo  "</tr>";
        }
        ?>
        <thead>
            <tr>
                <th>OTROS HALLAZGOS</th>
            </tr>
        </thead>
        <?php
        if (isset($hemograma['otros_hallazgos'])) {
            echo "<tr>";
            echo "<td>HALLAZGOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['otros_hallazgos']}</td>";
            echo  "</tr>";
        }
        if (isset($hemograma['eritrocitos_nucleados'])) {
            echo "<tr>";
            echo "<td>ERITROCITOS NUCLEADOS</td>";
            echo "<td class='w3-right-align'>{$hemograma['eritrocitos_nucleados']}</td>";
            echo  "</tr>";
        }
        ?>
    </table>
    <hr>
    <?php
    if (isset($hemograma['observaciones'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>OBSERVACIONES</b><br>" . nl2br(htmlspecialchars($hemograma['observaciones'])) . "</span><br>";
        echo "</div>";
    }
    if (isset($hemograma['interpretaciones'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>INTERPRETACIÓN</b><br>"  . nl2br(htmlspecialchars($hemograma['interpretaciones'])) .  "</span><br>";
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