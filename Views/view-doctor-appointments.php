<html>

<?php include('../includes/head.php'); ?>

<body>
    <header>
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">
                    <img src="https://img.icons8.com/color/38/null/hospital-2.png" />
                    <span class="text-muted fw-bold">
                        Liste des consultations
                    </span>
                </a>
                <div>
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

                        <!-- button return -->
                        <a href="controller-secretary.php"><button type="button" class="btn btn-secondary rounded-5"><img src="https://img.icons8.com/ios-filled/24/FFFFFF/u-turn-to-left.png" /></button></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row appointments">

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

            </div>

    </main>
    <?php Appointments::displayAppointmentsModals(); ?> <!-- Affiche les modals de modification de rendez-vous -->
    <?php include('../includes/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>