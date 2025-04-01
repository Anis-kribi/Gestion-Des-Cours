<?php
require_once("../fragments_pages/header.php");
require_once("../fragments_pages/navbar.php");

require_once("../dbconnect.php");

// SQL query to fetch formateurs data along with course titles
$sql = "SELECT f.nom_formateur, f.image_formateur, f.id_cours, f.presentation, c.titre_cours
        FROM formateurs f
        JOIN cours c ON f.id_cours = c.id_cours";  

$stmt = $pdo->prepare($sql);
$stmt->execute();
$formateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Debug: Output fetched data to see if everything is correct
// var_dump($formateurs); // Uncomment this line to check if 'titre_cours' is coming through
?>

<main class="main">

  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-10">
            <h1>Formateurs</h1>
            <p class="mb-0">Chez gestion des cours, nos formateurs sont au cœur de notre programme éducatif...</p>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="../index.php">Accueil</a></li>
          <li class="current">Formateurs</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Page Title -->

  <!-- Trainers Section -->
  <section id="trainers" class="section trainers">
    <div class="container">
      <div class="row gy-5">

        <?php foreach ($formateurs as $formateur): ?>
          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
              <img src="<?= htmlspecialchars($formateur['image_formateur']) ?>" class="img-fluid" alt="">
              <div class="social">
                <a href="#"><i class="bi bi-twitter-x"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info text-center">
              <h4><?= htmlspecialchars($formateur['nom_formateur']) ?></h4>
              <!-- Display the course title (titre_cours) here -->
              <span><?= htmlspecialchars($formateur['titre_cours']) ?: 'Domaine non spécifié' ?></span>
              <p><?= htmlspecialchars($formateur['presentation']) ?: 'Présentation non disponible' ?></p>
            </div>
          </div><!-- End Team Member -->
        <?php endforeach; ?>

      </div><!-- End Row -->
    </div><!-- End Container -->
  </section><!-- End Trainers Section -->

</main>

<?php
require_once("../fragments_pages/footer.php");
?>
