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
require_once '../../controllers/LiquidosController.php';
require_once '../../controllers/ReferenciaController.php';

$liquidos = $liquidos_controller->show($_GET['item_id']);
$item = $item_controller->show($liquidos['fk_item_id']);
$study = $study_controller->show($item['fk_study_id']);
$case = $case_controller->show($item['fk_case_id']);
$clinic = $clinic_controller->show($case['fk_clinic_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);

if (isset($liquidos['conteo_celular'])) {
    $liquidos['conteo_celular'] = $referencia_controller->getSuperscript($liquidos['conteo_celular']);
}

require_once '../../templates/head.php';
?>

<body>
    <?php require_once '../../templates/banner.php';

    if (!empty($liquidos['fecha'])) {
        echo "<div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>FECHA DE OBTENCIÓN DE MUESTRA</b><br>" . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($liquidos['fecha']))  . "</span>";
        echo "</div>";
        echo "<hr>";
    }

    if (isset($liquidos['tipo_de_liquido'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>TIPO DE LÍQUIDO</b><br>" . nl2br(htmlspecialchars($liquidos['tipo_de_liquido'])) . "</span>";
        echo "</div>";
    }
    ?>
    <hr>
    <table class="w3-table w3-tiny">
        <thead>
            <tr>
                <th>EXAMEN FÍSICO-QUÍMICO</th>
                <th class="w3-right-align">RESULTADO</th>
                <th class="w3-right-align">UNIDAD</th>
            </tr>
        </thead>
        <?php
        if (isset($liquidos['apariencia'])) {
            echo "<tr>";
            echo "<td>APARIENCIA</td>";
            echo "<td class='w3-right-align'>{$liquidos['apariencia']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['color'])) {
            echo "<tr>";
            echo "<td>COLOR</td>";
            echo "<td class='w3-right-align'>{$liquidos['color']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['hematocrito'])) {
            echo "<tr>";
            echo "<td>HEMATOCRITO</td>";
            echo "<td class='w3-right-align'>{$liquidos['hematocrito']}</td>";
            echo "<td class='w3-right-align'>L/L</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['creatinina'])) {
            echo "<tr>";
            echo "<td>CREATININA</td>";
            echo "<td class='w3-right-align'>{$liquidos['creatinina']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['colesterol'])) {
            echo "<tr>";
            echo "<td>COLESTEROL</td>";
            echo "<td class='w3-right-align'>{$liquidos['colesterol']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['trigliceridos'])) {
            echo "<tr>";
            echo "<td>TRIGLICERIDOS</td>";
            echo "<td class='w3-right-align'>{$liquidos['trigliceridos']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['bilirrubina'])) {
            echo "<tr>";
            echo "<td>BILIRRUBINA</td>";
            echo "<td class='w3-right-align'>{$liquidos['bilirrubina']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['conteo_celular'])) {
            echo "<tr>";
            echo "<td>CONTEO CELULAR</td>";
            echo "<td class='w3-right-align'>" . $liquidos['conteo_celular'] . "</td>";
            echo "<td class='w3-right-align'>x10<sup>9</sup>/L</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['viscocidad'])) {
            echo "<tr>";
            echo "<td>VISCOCIDAD</td>";
            echo "<td class='w3-right-align'>{$liquidos['viscocidad']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['prueba_de_mucina'])) {
            echo "<tr>";
            echo "<td>PRUEBA DE MUCINA</td>";
            echo "<td class='w3-right-align'>{$liquidos['prueba_de_mucina']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['prueba_de_pandy'])) {
            echo "<tr>";
            echo "<td>PRUEBA DE PANDY</td>";
            echo "<td class='w3-right-align'>{$liquidos['prueba_de_pandy']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['proteinas'])) {
            echo "<tr>";
            echo "<td>PROTEINAS</td>";
            echo "<td class='w3-right-align'>{$liquidos['proteinas']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['albumina'])) {
            echo "<tr>";
            echo "<td>ALBÚMINA</td>";
            echo "<td class='w3-right-align'>{$liquidos['albumina']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['globulinas'])) {
            echo "<tr>";
            echo "<td>GLOBULINAS</td>";
            echo "<td class='w3-right-align'>{$liquidos['globulinas']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo  "</tr>";
        }
        if (isset($liquidos['relacion_ag'])) {
            echo "<tr>";
            echo "<td>RELACIÓN A/G</td>";
            echo "<td class='w3-right-align'>{$liquidos['relacion_ag']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        ?>
    </table>
    <hr>
    <?php
    if (isset($liquidos['descripcion_microscopica'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>DESCRIPCÍON MICROSCÓPICA</b><br>" . $liquidos['descripcion_microscopica'] . "</span><br>";
        echo "</div>";
    }
    if (isset($liquidos['interpretaciones'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>INTERPRETACIONES</b><br>" . $liquidos['interpretaciones'] . "</span><br>";
        echo "</div>";
    }
    if (isset($liquidos['diagnostico'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>DIAGNÓSTICO</b><br>" . $liquidos['diagnostico'] . "</span><br>";
        echo "</div>";
    }
    if (isset($liquidos['comentario'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>COMENTARIO</b><br>" . $liquidos['comentario'] . "</span><br>";
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