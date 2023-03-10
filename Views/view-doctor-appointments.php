<html>

<?php include('../includes/head.php'); ?>











<body>



    <header>
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../Controllers/controller-secretary.php">
                    <img src="https://img.icons8.com/color/38/null/hospital-2.png" />
                    <span class="text-muted fw-bold">
                        <?= $_SESSION['doctor_lastname'] ?? 'Liste des consultations' ?></p>
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
                <?php if (empty($appointmentList)) {
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
                                    <th scope="col">Spécialité</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Affichage des RDV de la page -->

                                <?php
                                foreach ($appointmentsArray as $appointment) : ?>
                                    <?php echo '<tr>';
                                    echo '<td>' . strtoupper($appointment['patient_lastname']) . '</td>';
                                    echo '<td>' . ucfirst($appointment['patient_firstname']) . '</td>';
                                    echo '<td>' . $appointment['appointment_date'] . ' </td>';
                                    echo '<td>' . $appointment['appointment_hour'] . '</td>';
                                    echo '<td>' . $appointment['patient_phone'] . '</td>';
                                    echo '<td>' . $appointment['doctor_specialty'] . '</td>';
                                    if (isset($_SESSION['secretary_id'])) {
                                        echo '<td><button type="button" class="btn btn-info rounded-5" data-bs-toggle="modal" data-bs-target="#modifyAppointment' . $appointment['appointment_id'] . '" class="btn btn-primary"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/edit.png" /></button>';
                                        echo '<button type="button" id="btnDelete" class="btn btn-danger rounded-5" data-bs-toggle="modal" data-bs-target="#modalDelete' . $appointment['appointment_id'] . '"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/delete-forever.png"></button><td>';
                                    }
                                    echo '</tr>';


                                    // Modal de suppression

                                    echo ' <div class="modal fade" id="modalDelete' . $appointment['appointment_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body text-center">
                  <h6> Voulez-vous supprimer cet élément définitivement?</h6>
                  <!-- bouton delete -->
                  <div class="text-center">
                    <button type="button" class="btn btn-primary"><a href="controller-doctor-appointments.php?deleteAppointment=' . $appointment['appointment_id'] . '"><span class="text-white">oui</span></a></button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">non</button>
                  </div>
                </div>
              </div>
            </div>
          </div>'; ?>
                                <?php endforeach;

                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="text-center fw-bold">
                                            <?php for ($i = 1; $i <= $nbPage; $i++) : ?>
                                                <a href="controller-doctor-appointments.php?page=<?= $i ?>" class="text-primary"><?= $i ?></a>
                                            <?php endfor; ?>
                                        </div>
                                    </td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                <?php } ?>

                <!-- Pagination -->


                <!-- Pour chaque page, on affiche un lien vers la page -->



            </div>

        </div>




    </main>


    <?php Appointments::displayAppointmentsModals(); ?> <!-- Affiche les modals de modification de rendez-vous -->
    <?php include('../includes/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>