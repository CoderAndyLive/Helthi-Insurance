<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jahrgang = htmlspecialchars($_POST['jahrgang']);
    $groesse = htmlspecialchars($_POST['groesse']);
    $gewicht = htmlspecialchars($_POST['gewicht']);
    $ahv_nummer = htmlspecialchars($_POST['ahv_nummer']);
    $sportarten = isset($_POST['sportarten']) ? $_POST['sportarten'] : [];
    $newsletter = htmlspecialchars($_POST['newsletter']);
    
    $errors = [];
    
    if (empty($jahrgang) || !is_numeric($jahrgang)) {
        $errors[] = "Jahrgang ist erforderlich und muss eine Zahl sein.";
    }
    
    if (empty($groesse) || !is_numeric($groesse)) {
        $errors[] = "Grösse ist erforderlich und muss eine Zahl sein.";
    }
    
    if (empty($gewicht) || !is_numeric($gewicht)) {
        $errors[] = "Gewicht ist erforderlich und muss eine Zahl sein.";
    }
    
    if (empty($ahv_nummer)) {
        $errors[] = "AHV-Nummer ist erforderlich.";
    }
    
    if (count($sportarten) < 3 || count($sportarten) > 5) {
        $errors[] = "Bitte wählen Sie mindestens 3 und höchstens 5 Sportarten.";
    }
    
    echo "<!DOCTYPE html>";
    echo "<html lang='de'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Helthi - Ergebnis</title>";
    echo "<link href='https://fonts.googleapis.com/css2?family=Righteous&family=Lato:wght@700&display=swap' rel='stylesheet'>";
    echo "<link rel='stylesheet' href='style.css'>";
    echo "</head>";
    echo "<body>";
    echo "<header id='headersection'>";
    echo "<div class='headercontent'>";
    echo "<h1 class='headertext'>Helthi</h1>";
    echo "</div>";
    echo "</header>";
    echo "<div class='introsection'>";
    echo "<div class='introtext'>";
    echo "<h2 class='introheader' style='margin-top: 50px; text-align: center;'>Ergebnis</h2>";
    echo "</div>";
    echo "<div class='container'>";
    
    if (empty($errors)) {
        $bmi = $gewicht / (($groesse / 100) ** 2);
        $current_year = date("Y");
        $age = $current_year - $jahrgang;
        
        echo "<div class='thankyou-container'>";
        echo "<div class='customerdata-container'>";
        echo "<p>Ihr BMI beträgt: <span class='bmi'>" . number_format($bmi, 2) . "</span></p>";
        echo "<p>Ihr Alter ist: <span class='age'>$age Jahre</span></p>";
        echo "<p>Ihre AHV-Nummer: <span class='ahv'>$ahv_nummer</span></p>";
        echo "<p>Gewählte Sportarten: <span class='sports'>" . implode(", ", $sportarten) . "</span></p>";
        echo "<p>Newsletter: <span class='newsletter'>$newsletter</span></p>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='errorsection'>";
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo "</div>";
    }
    
    echo "</div>";
    echo "<footer class='helthi-footer'>";
    echo "<div class='footertext'>Helthi</div>";
    echo "</footer>";
    echo "</body>";
    echo "</html>";
}
?>
