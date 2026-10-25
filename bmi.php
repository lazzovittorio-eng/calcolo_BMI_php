
<?php
$errore = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $peso = $_POST["peso"];
    $altezza = $_POST["altezza"];

    if ($nome == "" || $peso == "" || $altezza == "") {
        $errore = "Compila tutti i campi.";
    } elseif (!is_numeric($peso) || !is_numeric($altezza)) {
        $errore = "Peso e altezza devono essere numeri.";
    } elseif ($peso < 20 || $peso > 300) {
        $errore = "Il peso deve essere tra 20 e 300 kg.";
    } elseif ($altezza < 100 || $altezza > 250) {
        $errore = "L'altezza deve essere tra 100 e 250 cm.";
    } else {
        $altezza_m = $altezza / 100;
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
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Calcolatore BMI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<?php if ($_SERVER["REQUEST_METHOD"] != "POST" || $errore != "") { ?>

    <h1>Calcolatore BMI</h1>

    <?php if ($errore != "") {
        echo "<p style='color:red;'>$errore</p>";
    } ?>

    <div class="card">
        <form action="bmi.php" method="POST">
            <label>Nome</label>
            <input type="text" name="nome" required>

            <label>Peso (kg)</label>
            <input type="number" name="peso" step="0.1" required>

            <label>Altezza (cm)</label>
            <input type="number" name="altezza" required>

            <button type="submit" class="btn">Calcola</button>
        </form>
    </div>

<?php } else { ?>

    <h1>Il tuo BMI</h1>

    <div class="result-card <?php echo $classe; ?>">
        <div class="user-name"><?php echo htmlspecialchars($nome); ?></div>
        <div class="user-details">
            Peso <?php echo $peso; ?> kg · Altezza <?php echo $altezza; ?> cm
        </div>
        <div class="bmi-value"><?php echo $bmi_totale; ?></div>
        <div class="bmi-status"><?php echo $stato; ?></div>
    </div>

    <a href="bmi.php" class="back-link">Calcola di nuovo</a>

<?php } ?>

</div>

</body>
</html>
```