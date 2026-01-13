<h2><b>VETIUM</b> GESTOR VETERINARIO</h2>
<div class="w3-row w3-tiny">
    <div class="w3-col s6">
        <div class="w3-bar-item">
            <span class="w3-large"><?php echo '<span class="w3-large">' . trim(preg_replace('/\[[^\]]*\]/', '', $study['study'])) . '</span><br>'; ?></span>
            <span>Caso : <b><?php echo $case['case_number'] ?></b></span><br>
            <span>Clínica : <b><?php echo $clinic['clinic'] ?></b></span><br>
            <span>Veterinario : <b><?php echo $clinic['vet'] ?></b></span><br>
            <span>Dirección : <b><?php echo $clinic['address'] ?></b></span><br>
        </div>
    </div>
    <div class="w3-col s6 w3-right-align">
        <div class="w3-bar-item">
            <span class="w3-large"><?php echo $specie['specie'] ?></span><br>
            <span>Nombre : <b><?php echo $case['pet'] ?></b></span><br>
            <span>Raza : <b><?php echo $breed['breed'] ?></b></span><br>
            <span>Edad : <b><?php echo $case['age'] ?></b></span><br>
            <span>Sexo : <b><?php echo $case['sex'] ?></b></span><br>
        </div>
    </div>
</div>
<hr>

<?php
if (!empty($case['anamnesis'])) {
    echo "<div class='w3-panel w3-leftbar w3-tiny'>";
    echo "<span><b>ANAMNESIS</b><br>" . nl2br(htmlspecialchars($case['anamnesis'])) . "</span>";
    echo "</div>";
}
if (!empty($case['treatment'])) {
    echo "<div class='w3-panel w3-leftbar w3-tiny'>";
    echo "<span><b>TRATAMIENTO</b><br>" . nl2br(htmlspecialchars($case['treatment'])) . "</span>";
    echo "</div>";
}

if (!empty($case['treatment']) || !empty($case['anamnesis'])) {
    echo "<hr>";
}

?>