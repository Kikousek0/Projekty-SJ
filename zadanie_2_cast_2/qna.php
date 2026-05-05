<?php
namespace YourNamespace;
require_once('db/Database.php');

class QnA extends \Database {
    public function getQuestionsAndAnswers() {
        try {
            $sql = "SELECT * FROM qna";
            $query = $this->connection->query($sql);
            return $query->fetchAll();
        } catch (\PDOException $e) {
            echo "Chyba dopytu: " . $e->getMessage();
            return [];
        }
    }
}

$qna_logic = new QnA();
$questions = $qna_logic->getQuestionsAndAnswers();
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja stránka - Q&A</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/accordion.css">
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
            <h1>Q&A</h1>
        </div>
    </section>

    <?php
    include_once "functions.php";
    pridajPozdrav();
    ?>

    <section class="container">
        <div class="row">
            <div class="col-100 text-center">
                <p><strong><em>Tu nájdete odpovede na vaše otázky.</em></strong></p>
            </div>
        </div>
    </section>

    <section class="container">
        <?php if(!empty($questions)): ?>
            <div class="accordion-container">
                <?php foreach($questions as $item): ?>
                    <div class="accordion">
                        <div class="question">
                            <?php echo htmlspecialchars($item['otazka']); ?>
                        </div>
                        <div class="answer">
                            <?php echo htmlspecialchars($item['odpoved']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">Momentálne nie sú k dispozícii žiadne otázky.</p>
        <?php endif; ?>
    </section>

</main>

<script src="js/accordion.js"></script>
<script src="js/menu.js"></script>

<?php
include_once "parts/footer.php";
?>
</body>
</html>