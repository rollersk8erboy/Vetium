<?php
require_once '../../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

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
require_once '../../controllers/UrianalisisController.php';

$urianalisis = $urianalisis_controller->show($_GET['item_id']);
$item = $item_controller->show($urianalisis['fk_item_id']);
$study = $study_controller->show($item['fk_study_id']);
$case = $case_controller->show($item['fk_case_id']);
$clinic = $clinic_controller->show($case['fk_clinic_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);

require_once '../../templates/head.php';
?>

<body>
    <?php
    require_once '../../templates/banner.php';

    if (!empty($urianalisis['fecha'])) {
        echo "<div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>FECHA DE OBTENCIÓN DE MUESTRA</b><br>" . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($urianalisis['fecha']))  . "</span>";
        echo "</div>";
        echo "<hr>";
    }

    if (isset($urianalisis['metodo_de_obtencion'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>MÉTODO DE OBTENCIÓN</b><br>" . nl2br(htmlspecialchars($urianalisis['metodo_de_obtencion'])) . "</span>";
        echo "</div>";
    }
    ?>
    <hr>
    <table class="w3-table w3-tiny">
        <thead>
            <tr>
                <th>EXAMEN FÍSICO</th>
                <th class="w3-right-align">RESULTADO</th>
                <th class="w3-right-align">UNIDAD</th>
            </tr>
        </thead>
        <?php
        if (isset($urianalisis['apariencia'])) {
            echo "<tr>";
            echo "<td>APARIENCIA</td>";
            echo "<td class='w3-right-align'>{$urianalisis['apariencia']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['color'])) {
            echo "<tr>";
            echo "<td>COLOR</td>";
            echo "<td class='w3-right-align'>{$urianalisis['color']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['densidad'])) {
            echo "<tr>";
            echo "<td>DENSIDAD</td>";
            echo "<td class='w3-right-align'>{$urianalisis['densidad']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        ?>
        <tr>
            <th>EXAMEN QUÍMICO</th>
        </tr>
        <?php
        if (isset($urianalisis['ph'])) {
            echo "<tr>";
            echo "<td>pH</td>";
            echo "<td class='w3-right-align'>{$urianalisis['ph']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['proteinas'])) {
            echo "<tr>";
            echo "<td>PROTEÍNAS</td>";
            echo "<td class='w3-right-align'>{$urianalisis['proteinas']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['glucosa'])) {
            echo "<tr>";
            echo "<td>GLUCOSA</td>";
            echo "<td class='w3-right-align'>{$urianalisis['glucosa']}</td>";
            echo "<td class='w3-right-align'>g/L</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['cetonas'])) {
            echo "<tr>";
            echo "<td>CETONAS</td>";
            echo "<td class='w3-right-align'>{$urianalisis['cetonas']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['bilirrubina'])) {
            echo "<tr>";
            echo "<td>BILIRRUBINA</td>";
            echo "<td class='w3-right-align'>{$urianalisis['bilirrubina']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['hemoglobina'])) {
            echo "<tr>";
            echo "<td>HEMOGLOBINA / SANGRE</td>";
            echo "<td class='w3-right-align'>{$urianalisis['hemoglobina']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        ?>
        <tr>
            <th>EXAMEN MICROSCÓPICO</th>
        </tr>
        <?php
        if (isset($urianalisis['eritrocitos'])) {
            echo "<tr>";
            echo "<td>ERITROCITOS</td>";
            echo "<td class='w3-right-align'>{$urianalisis['eritrocitos']}</td>";
            echo "<td class='w3-right-align'>/CAMPO (400X)</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['leucocitos'])) {
            echo "<tr>";
            echo "<td>LEUCOCITOS</td>";
            echo "<td class='w3-right-align'>{$urianalisis['leucocitos']}</td>";
            echo "<td class='w3-right-align'>/CAMPO (400X)</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['celulas_epiteliales_transitorias'])) {
            echo "<tr>";
            echo "<td>CÉLULAS EPITELIALES TRANSITORIAS</td>";
            echo "<td class='w3-right-align'>{$urianalisis['celulas_epiteliales_transitorias']}</td>";
            echo "<td class='w3-right-align'>/CAMPO (400X)</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['celulas_epiteliales_escamosas'])) {
            echo "<tr>";
            echo "<td>CÉLULAS EPITELIALES ESCAMOSAS</td>";
            echo "<td class='w3-right-align'>{$urianalisis['celulas_epiteliales_escamosas']}</td>";
            echo "<td class='w3-right-align'>/CAMPO (400X)</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['cilindros'])) {
            echo "<tr>";
            echo "<td>CILINDROS</td>";
            echo "<td class='w3-right-align'>{$urianalisis['cilindros']}</td>";
            echo "<td class='w3-right-align'>/CAMPO (400X)</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['tipo'])) {
            echo "<tr>";
            echo "<td>TIPO</td>";
            echo "<td class='w3-right-align'>{$urianalisis['tipo']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['cristales'])) {
            echo "<tr>";
            echo "<td>CRISTALES</td>";
            echo "<td class='w3-right-align'>{$urianalisis['cristales']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['bacterias'])) {
            echo "<tr>";
            echo "<td>BACTERIAS</td>";
            echo "<td class='w3-right-align'>{$urianalisis['bacterias']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['lipidos'])) {
            echo "<tr>";
            echo "<td>LÍPIDOS</td>";
            echo "<td class='w3-right-align'>{$urianalisis['lipidos']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        if (isset($urianalisis['otros'])) {
            echo "<tr>";
            echo "<td>OTROS</td>";
            echo "<td class='w3-right-align'>{$urianalisis['otros']}</td>";
            echo "<td class='w3-right-align'>-</td>";
            echo  "</tr>";
        }
        ?>
    </table>
    <hr>
    <?php
    if (isset($urianalisis['interpretaciones'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>INTERPRETACIÓN</b><br>" . nl2br(htmlspecialchars($urianalisis['interpretaciones'])) . "</span><br>";
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