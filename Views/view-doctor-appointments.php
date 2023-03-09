<html>

<?php include('../includes/head.php'); ?>



<body>
    <header>
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../Controllers/controller-secretary.php">
                    <img src="https://img.icons8.com/color/38/null/hospital-2.png" />
                    <span class="text-muted fw-bold">
                    <?=$_SESSION['doctor_lastname'] ?? 'Liste des consultations'?></p>
                    </span>
                </a>
                <div>
                    <?php if (!isset($_SESSION['secretary_id'])) { ?>
                        <a href="controller-login.php?action=logout"><button type="button" class="btn btn-danger rounded-5"><img src="https://img.icons8.com/external-solid-style-bomsymbols-/30/FFFFFF/external-design-web-design-device-solid-style-set-2-solid-style-bomsymbols--13.png" /></button></a>
                    <?php } ?>
                    <?php if (isset($_SESSION['secretary_id'])) { ?>

                        <!-- button select -->
                        <div class="dropstart">
                            <button class="btn btn-primary dropdown-toggle rounded-5" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-search"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!-- Filtrage par nom -->
                                <form action="" method="GET">
                                    <?php displayDoctors() ?> <!-- Affiche la liste des médecins -->
                                </form>
                                <li><a href="controller-doctor-appointments.php" class="dropdown-item"><button type="button" class="btn btn-outline-success rounded-5">Liste complète</button> </a></li>
                            </ul>
                        <?php } ?>
                        <!-- button return, si c'est un médecin, le bouton n'apparait pas -->
                        <?php if (isset($_SESSION['secretary_id'])) {
                            echo '<a href="controller-secretary.php"><button type="button" class="btn btn-secondary rounded-5"><img src="https://img.icons8.com/ios-filled/24/FFFFFF/u-turn-to-left.png" /></button></a>';
                        } ?>
                        </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row appointments">
                <?php if (empty($AppointmentList)) {
                    echo 
                    '
                        <div class="alert alert-primary rounded-5 text-center" role="alert">
                        <i class="bi bi-info-circle-fill"></i> Vous n\'avez aucun rendez-vous
                        </div>
                    ';
                } else { ?>
                    <div class="col-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Date du rendez-vous</th>
                                    <th scope="col">Heure du rendez-vous</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Numéro de Sécu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php Appointments::displayAllAppointments(); ?> <!-- Affiche la liste des rendez-vous -->
                            </tbody>
                        </table>
                    </div>
                <?php } ?>

            </div>


            <nav>
                    <ul class="pagination">
                        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="../Controllers/controller-doctor-appoitments.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                          <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="../Controllers/controller-doctor-appointments.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="../Controllers/controller-doctor-appointments.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>


    </main>
    <?php Appointments::displayAppointmentsModals(); ?> <!-- Affiche les modals de modification de rendez-vous -->
    <?php include('../includes/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>