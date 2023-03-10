<html>

<?php include('../includes/head.php'); ?>

<body>
  <header>
    <nav class="navbar fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="../Controllers/controller-secretary.php">
          <img src="https://img.icons8.com/color/38/null/hospital-2.png" />
          <span class="text-muted fw-bold">
            Liste des patients
          </span>
        </a>
        <!-- fake toats message error / success -->
        <div class="<?= $errors_patients['show'] ?? '' ?> rounded-5 m-0 p-2">
          <?= $errors_patient['patient_search'] ?? '' ?>
        </div>

        <div class="dropstart">
          <button class="btn btn-primary dropdown-toggle rounded-5" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-search"></i>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
              <div class="dropdown-item search">
                <!-- recherche par n de secu -->
                <form class="d-flex" role="search" action="../Controllers/controller-list-patient.php" method="get">
                  <input class="form-control me-2" placeholder="n° de sécurité sociale" type="text" id="SSNumber" name="SSNumber" required minlength="15" maxlength="15" size="16">
                  <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div>
              <div class="dropdown-item search">
                <!-- recherche par date de naissance -->
                <form class="d-flex" role="search" action="../Controllers/controller-list-patient.php" method="get">
                  <input class="form-control me-2" placeholder="date de naissance" type="date" id="DDNumber" name="Bdate" class="text-center" value="<?= date('Y-m-d') ?>">
                  <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div>
              <div class="dropdown-item search">
                <button class="btn btn-outline-success rounded-5" type="button" onclick="window.location.href='./controller-list-patient.php'">Liste complète</button>
              </div>
            </li>
          </ul>
          <a href="controller-secretary.php"><button type="button" class="btn btn-secondary rounded-5"><img src="https://img.icons8.com/ios-filled/24/FFFFFF/u-turn-to-left.png" /></button></a>
        </div>


      </div>
    </nav>
  </header>

  <div class="container">

    <div class="row patient">
      <table class="table">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Num Sécu</th>
            <th scope="col">Mail</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Adresse</th>
            <th scope="col"></th>

          </tr>
        </thead>

        <tbody>
          <!-- fetch all clients -->
          <?php
          foreach ($patients as $patient) { ?>
            <tr class="patient_row" data-id="<?= $patient['patient_id'] ?>">
              <td>
                <a href="controller-info-patient.php?patient=<?= $patient['patient_id'] ?>">
                  <button type="button" class="btn btn-primary rounded-5">
                    <img src="https://img.icons8.com/ios-filled/20/FFFFFF/information.png" />
                  </button>
                </a>
              </td>
              <td><?= strtoupper($patient['patient_lastname']) ?></td>
              <td><?= ucfirst($patient['patient_firstname']) ?></td>
              <td><?= date('d/m/Y', strtotime($patient['patient_birthdate'])) ?></td>
              <td><?= $patient['patient_secu'] ?></td>
              <td><?= $patient['patient_mail'] ?></td>
              <td><?= $patient['patient_phone'] ?></td>
              <td><?= $patient['patient_adress'] ?></td>
              <td>
                <button type="button" id="btnConsultation" class="btn btn-outline-dark rounded-5"><img src="https://img.icons8.com/ios-glyphs/20/000000/expand-arrow--v1.png" /></button>
                <button type="button" id="btnAddApptmt" class="btn btn-success rounded-5"><a href="./controller-secretary.php?id=<?= $patient['patient_id'] ?>"><img src="https://img.icons8.com/material-rounded/20/FFFFFF/person-calendar.png" alt="Prendre RDV"></a></button>
                <button type="button" id="btnEdit" class="btn btn-info rounded-5" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $patient['patient_id'] ?>"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/edit.png" /></button>
                <button type="button" id="btnDelete" class="btn btn-danger rounded-5" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $patient['patient_id'] ?>"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/delete-forever.png"></button>

              </td>
            </tr>
            <tr class="consultation<?= $patient['patient_id'] ?> appointment-bg" hidden>
              <td colspan="9">

                <table class="table" style="background-color : rgba(255, 255, 255, 0.4);">
                  <thead>
                    <tr>
                      <th scope="col">Date du rendez-vous</th>
                      <th scope="col">Heure du rendez-vous</th>
                      <th scope="col">Description</th>
                      <th scope="col">Nom du médecin</th>
                      <th scope="col">Prénom du médecin</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $appointments = $obj_appointment->DisplayAppointmentListByPatient($patient['patient_id']);
                    if (empty($appointments)) { ?>
                      <tr>
                        <td colspan="5" class="text-center">Aucun rendez-vous</td>
                      </tr>
                      <?php } else {
                      foreach ($appointments as $appointment) { ?>
                        <tr>
                          <td><?= date('d/m/Y', strtotime($appointment['appointment_date'])) ?></td>
                          <td><?= date('H:i', strtotime($appointment['appointment_hour'])) ?></td>
                          <td><?= $appointment['appointment_description'] ?></td>
                          <?php $doctor = $obj_doctor->getDoctorById($appointment['doctor_id']); ?>
                          <td><?= $doctor['doctor_lastname'] ?></td>
                          <td><?= $doctor['doctor_firstname'] ?></td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>


              </td>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="7">
              <div class="text-center fw-bold">
                <!-- PAGINATION -->

              </div>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>

    <?php
    foreach ($patients as $patient) { ?>
      <!-- modal Edit -->
      <div class="modal" tabindex="-1" id="modalEdit<?= $patient['patient_id'] ?>" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modifier les information d'un patient</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../Controllers/controller-list-patient.php" method="POST" id="formEdit<?= $patient['patient_id'] ?>" enctype="multipart/form-data">
                <div class="input-group">
                  <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_name'] ?? '<i class="bi bi-person-fill"></i>' ?></div>
                  <input type="text" name="patient_lastname" id="patient_lastname" class="form-control" placeholder="Nom" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_lastname'] ?>'>
                  <input type="text" name="patient_firstname" id="patient_firstname" class="form-control" placeholder="Prénom" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_firstname'] ?>'>
                </div>
                <div class="input-group">
                  <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_birthdate'] ?? '<i class="bi bi-calendar"></i>' ?></div>
                  <input type="date" name="patient_birthdate" id="patient_birthdate" class="form-control" placeholder="Date de naissance" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_birthdate'] ?>'>
                </div>
                <div class="input-group">
                  <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_phone'] ?? '<i class="bi bi-telephone-fill"></i>' ?></div>
                  <input type="phone" name="patient_phone" id="patient_phone" class="form-control" placeholder="Téléphone" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_phone'] ?>'>
                </div>
                <div class="input-group">
                  <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_secu'] ?? '<i class="bi bi-file-earmark-medical-fill"></i>' ?></div>
                  <input type="text" name="patient_secu" id="patient_secu" class="form-control" placeholder="Numéro de sécurité social" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_secu'] ?>'>
                </div>
                <div class="input-group">
                  <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_mail'] ?? '<i class="bi bi-envelope-fill"></i>' ?></div>
                  <input type="mail" name="patient_mail" id="patient_mail" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_mail'] ?>'>
                </div>
                <div class="input-group">
                  <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_adress'] ?? '<i class="bi bi-geo-alt-fill"></i>' ?></div>
                  <input type="text" name="patient_adress" id="patient_adress" class="form-control" placeholder="Adresse" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_adress'] ?>'>
                </div>
                <input type="hidden" name="patient_id" value='<?= $patient['patient_id'] ?>'>
                <input type="hidden" name="patient_mail" value='<?= $patient['patient_mail'] ?>'>
                <div class="input-group">
                  <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_upload'] ?? '<i class="bi bi-image-fill"></i>' ?></div>
                  <input type="file" name="patient_photo" id="patient_photo" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                </div>
                <div class="<?= $errors_patient['show'] ?? '' ?> rounded-5 mt-2 p-2">
                  <?= $errors_patient['message'] ?? '' ?>
                  <?= $errors_patient['message_upload'] ?? '' ?>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-outline-primary" onclick="document.forms['formEdit<?= $patient['patient_id'] ?>'].submit();">Modifier</button>
            </div>
          </div>
        </div>
      </div>

      <!-- modal delete -->
      <div class="modal" tabindex="-1" id="modalDelete<?= $patient['patient_id'] ?>" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center">
              <h6> Voulez-vous supprimer cet élément définitivement?</h6>
              <div class="text-center">
                <p class="text-center"><strong><?= $patient['patient_lastname'] . ' ' . $patient['patient_firstname'] ?></strong></p>
                <form action="../Controllers/controller-list-patient.php" method="get">
                  <button type="submit" class="btn btn-primary" name='delete' value='<?= $patient['patient_id'] ?>'>Oui</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">non</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php
    include '../includes/footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../assets/js/view-list-patient.js"></script>

</body>

</html>