<?php
require_once("../fragments_pages/header.php");
require_once("../fragments_pages/navbar.php");

require_once("../dbconnect.php");

$sql = "SELECT `titre_evennement`, `date_evennement`, `description_event`, `image_event` FROM `evennements` ";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$evennements = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<main class="main">

<!-- Page Title -->
<div class="page-title" data-aos="fade">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1>Evenements</h1>
          <p class="mb-0">La gestion des événements permet d'organiser, promouvoir et superviser des événements, qu'ils soient physiques ou en ligne. Elle inclut la planification, la billetterie, la communication et la gestion des participants.</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
      <li><a href="../index.php">Accueil</a></li>
        <li class="current">Evenements</li>
      </ol>
    </div>
  </nav>
</div><!-- End Page Title -->

<!-- Events Section -->
<section id="events" class="events section">

  <div class="container" data-aos="fade-up">

    <div class="row">

    <?php
    $count = 0; // Compteur pour suivre le nombre de cours affichés
    foreach ($evennements as $evennement): ?>
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card">
          <div class="card-img">
            <img src="<?= $evennement['image_event'] ?>" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title"><a href=""><?= $evennement['titre_evennement'] ?></a></h5>
            <p class="fst-italic text-center"><?= $evennement['date_evennement'] ?></p>
            <p class="card-text"><?= $evennement['description_event'] ?></p>
          </div>
        </div>
      </div>
      <?php endforeach;?>
      </div>
     
    </div>
   

  </div>

</section><!-- /Events Section -->

</main>

  <?php
require_once("../fragments_pages/footer.php");
?>