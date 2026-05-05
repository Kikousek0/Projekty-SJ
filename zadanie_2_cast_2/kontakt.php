<?php

namespace YourNamespace;

require_once('db/Database.php');
include_once "functions.php";

class Kontakt extends \Database {

    public function ulozitSpravu($meno, $email, $sprava) {
        try {
            $sql = "INSERT INTO kontakt_formular (meno, email, sprava) VALUES (:meno, :email, :sprava)";
            $statement = $this->connection->prepare($sql);

            $status = $statement->execute([
                    ':meno' => $meno,
                    ':email' => $email,
                    ':sprava' => $sprava
            ]);

            return $status;
        } catch (\PDOException $e) {
            return false;
        }
    }
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['odoslat_form'])) {
    $meno = $_POST['meno'] ?? '';
    $email = $_POST['email'] ?? '';
    $sprava = $_POST['sprava'] ?? '';

    if (!empty($meno) && !empty($email) && !empty($sprava)) {
        $kontakt_objekt = new Kontakt();
        if ($kontakt_objekt->ulozitSpravu($meno, $email, $sprava)) {
            $success_message = "Vaša správa bola úspešne uložená do databázy.";
        } else {
            $error_message = "Chyba pri ukladaní správy do databázy.";
        }
    } else {
        $error_message = "Prosím, vyplňte všetky povinné polia.";
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt - Moja stránka</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php
$header_path = "parts/header.php";
if(!@include($header_path)){
    echo "Failed to load $header_path";
}
?>

<main>
    <section class="banner">
        <div class="container text-white">
            <h1>Kontakt</h1>
        </div>
    </section>

    <?php pridajPozdrav(); ?>

    <section class="container">
        <div class="row">
            <div class="col-50">
                <h3>Máte otázky?</h3>
                <p>Incididunt mollit quis eiusmod tempor voluptate duis eu enim amet excepteur cupidatat magna velit.</p>
                <p>Velit id ad laborum velit commodo.</p>
            </div>

            <div class="col-50 text-right">
                <h3>Napíšte nám</h3>

                <?php if($success_message): ?>
                    <p style="color: green; font-weight: bold;"><?php echo $success_message; ?></p>
                <?php endif; ?>
                <?php if($error_message): ?>
                    <p style="color: red; font-weight: bold;"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <form id="contact" action="kontakt.php" method="POST">
                    <input type="text" name="meno" placeholder="Vaše meno" required><br>
                    <input type="email" name="email" placeholder="Váš email" required><br>
                    <textarea name="sprava" placeholder="Vaša správa" id="sprava" required></textarea><br>

                    <input type="checkbox" name="suhlas" id="suhlas" required>
                    <label for="suhlas"> Súhlasím so spracovaním osobných údajov.</label><br>

                    <input type="submit" name="odoslat_form" value="Odoslať">
                </form>
            </div>
        </div>
    </section>
</main>

<?php
include_once "parts/footer.php";
?>
<script src="js/menu.js"></script>
</body>
</html>