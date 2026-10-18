<?php
$nome = $_POST['nome'];
$peso = $_POST['peso'];
$altezza_cm = $_POST['altezza'];

$altezza_m = $altezza_cm / 100;
$bmi = $peso / ($altezza_m * $altezza_m);

$bmi_totale = number_format($bmi, 2);

if ($bmi < 18.5) {
    $stato = "SOTTOPESO";
    $classe = "sottopeso";
} elseif ($bmi < 25) {
    $stato = "NORMOPESO";
    $classe = "normopeso";
} elseif ($bmi < 30) {
    $stato = "SOVRAPPESO";
    $classe = "sovrappeso";
} else {
    $stato = "OBESITÀ";
    $classe = "obesita";
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Risultato BMI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Il tuo BMI</h1>

        <div class="result-card <?php echo $classe; ?>">
            <div class="user-name"><?php echo $nome; ?></div>
            <div class="user-details">
                Peso <?php echo $peso; ?> kg · Altezza <?php echo $altezza_cm; ?> cm
            </div>
            
            <div class="bmi-value"><?php echo $bmi_totale; ?></div>
            <div class="bmi-status"><?php echo $stato; ?></div>
        </div>

        <a href="form.html" class="back-link">Calcola di nuovo</a>
    </div>

</body>
</html>