<?php
function pridajPozdrav() {
    $hour = date("H");
    if ($hour < 12) {
        echo "<h3>Dobré ráno</h3>";
    } else if ($hour >= 12 && $hour < 18) {
        echo "<h3>Dobrý deň</h3>";
    } else {
        echo "<h3>Dobrý večer</h3>";
    }
}
function generateSlides($dir) {
    $files = glob($dir . '/*.jpg');
    $json = file_get_contents("data/datas.json");
    $data = json_decode($json, true);
    $text = $data["text_banner"];

    foreach ($files as $file) {
        echo '<div class="slide fade">';
        echo '<img src="' . $file . '">';
        echo '<div class="slide-text">';

        echo ($text[basename($file)]);
        echo '</div>';
        echo '</div>';
    }
}
function insertQnA() {
    $json = file_get_contents("data/datas.json");
    $data = json_decode($json, true);
    $otazky = $data["otazky"];
    $odpovede = $data["odpovede"];
    echo '<section class="container">';
        for ($i = 0; $i < count($otazky); $i++) {
            echo '<div class="accordion">';
                echo '<div class="question">';
                    echo $otazky[$i];
                    echo '</div>';
                    echo '<div class="answer">';
                    echo $odpovede[$i];
                    echo '</div>';
                    echo '</div>';
        }
        echo '</section>';
}
function opisDom() {
    $json = file_get_contents("data/datas.json");
    $data = json_decode($json, true);
    $domy = $data["domy"];
    echo '<section class="container row">';
    foreach ($domy as $dom) {
        echo '
        <div class="dom-box">
            <img src="' . $dom["obrazok"] . '" class="dom-img">

            <div class="dom-overlay">
                <p>Číslo domu: ' . $dom["číslo_domu"] . '</p>
                <p>Farba strechy: ' . $dom["strecha"] . '</p>
                <p>Má garáž? ' . $dom["garáž"] . '</p>
            </div>
        </div>';
    }
    echo '</section>';
}
?>