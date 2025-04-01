<?php
require_once("../fragments_pages/header.php");
require_once("../fragments_pages/navbar.php");
require_once '../dbconnect.php';
require_once '../config.php';

if (isset($_GET['id'])) {
    $idCours = $_GET['id'];

    $sql = "SELECT 
    c.id_cours,
    cat.nom_categorie,
    c.titre_cours,
    f.prix_cours,
    c.image_cours,
    c.description_cours,
    fr.nom_formateur AS formateur,
    fr.image_formateur,
    f.places_disponibles
FROM cours c
JOIN categories cat ON c.id_categorie = cat.id_categorie
JOIN formation f ON f.id_cours = c.id_cours
JOIN formateurs fr ON f.id_formateur = fr.id_formateur
WHERE c.id_cours = :cours";


    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cours', $idCours, PDO::PARAM_INT);
    $stmt->execute();

    $cours = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cours) {
        $le_cour = $cours;  
    } else {
        echo "Cours non trouvé";
        exit;
    }
} else {
    echo "Cours non trouvé";
    exit;
}
?>

<main class="main">

  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Détails du Cours</h1>
            <p class="mb-0">Découvrez tous les détails du cours, y compris la description, le formateur, et les informations pratiques.</p>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
        <li><a href="../index.php">Accueil</a></li>
          <li><a href="cours.php">cours</a></li>
          <li class="current">Détails du Cours</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Page Title -->

  <!-- Courses Course Details Section -->
  <section id="courses-course-details" class="courses-course-details section">

    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-8">
          <img src="<?= htmlspecialchars($le_cour['image_cours']) ?>" class="img-fluid" alt="Image du cours">
          <h3><?= htmlspecialchars($le_cour['titre_cours']) ?></h3>
          <p><?= nl2br(htmlspecialchars($le_cour['description_cours'])) ?></p>
        </div>
        <div class="col-lg-4">

          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Formateur</h5>
            <p><a href="#"><?= htmlspecialchars($le_cour['formateur']) ?></a></p>
          </div>

          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Frais du Cours</h5>
            <p><?= number_format((float)$le_cour['prix_cours'], 2) ?> €</p>
          </div>

          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Places Disponibles</h5>
            <p><?= intval($le_cour['places_disponibles']) ?></p>
          </div>

          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Horaire</h5>
            <p>17h00 - 19h00</p>
          </div>

        </div>
      </div>

    </div>

  </section><!-- /Courses Course Details Section -->

  <!-- Tabs Section -->
  <section id="tabs" class="tabs section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row">
        <div class="col-lg-3">
          <ul class="nav nav-tabs flex-column">
            <li class="nav-item">
              <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Description du Cours</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Informations Supplémentaires</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Avis des Participants</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Objectifs du Cours</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tab-5">FAQ</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-9 mt-4 mt-lg-0">
          <div class="tab-content">
            <div class="tab-pane active show" id="tab-1">
              <div class="row">
                <div class="col-lg-8 details order-2 order-lg-1">
                  <h3>Le Cours en Détail</h3>
                  <p class="fst-italic">Découvrez tout ce que vous devez savoir sur ce cours.</p>
                  <p>Ce cours vous apprendra les compétences nécessaires pour exceller dans votre domaine. Vous serez guidé par un formateur expérimenté et bénéficierez de conseils pratiques et d'exercices.</p>
                </div>
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  <img src="assets/img/tabs/tab-1.png" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <!-- Ajoutez ici les autres contenus de l'onglet -->
          </div>
        </div>
      </div>

    </div>

  </section><!-- /Tabs Section -->

</main>

<?php 
require_once("../fragments_pages/footer.php");
?>
