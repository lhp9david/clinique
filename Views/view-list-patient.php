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
      <table class="table table-striped">
        <thead>
          <tr>

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
            <tr>
              <td><?= $patient['patient_lastname'] ?></td>
              <td><?= $patient['patient_firstname'] ?></td>
              <td><?= date('d/m/Y', strtotime($patient['patient_birthdate'])) ?></td>
              <td><?= $patient['patient_secu'] ?></td>
              <td><?= $patient['patient_mail'] ?></td>
              <td><?= $patient['patient_phone'] ?></td>
              <td><?= $patient['patient_adress'] ?></td>
              <td>
                <button type="button" id="btnAddApptmt" class="btn btn-success rounded-5"><a href="./controller-secretary.php?id=<?= $patient['patient_id'] ?>"><img src="https://img.icons8.com/material-rounded/20/FFFFFF/person-calendar.png" alt="Prendre RDV"></a></button>
                <button type="button" id="btnEdit" class="btn btn-info rounded-5" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $patient['patient_id'] ?>"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/edit.png" /></button>
                <button type="button" id="btnDelete" class="btn btn-danger rounded-5" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $patient['patient_id'] ?>"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/delete-forever.png"></button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
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
                  <input type="text" name="patient_birthdate" id="patient_birthdate" class="form-control" placeholder="Date de naissance" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= date('d/m/Y', strtotime($patient['patient_birthdate'])) ?>'>
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
                  <label for="patient_photo" class="btn border" onmouseover="this.style.background='#e9e3f1';" onmouseout="this.style.background='none';">Choisissez une photo :</label>
                  <input type="txt" class="form-control" value="<?= $patient['patient_photo'] ? $patient['patient_photo'] : 'Aucune photo sélectionnée' ?>">
                  <input type="file" name="patient_photo" id="patient_photo" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" style=display:none>
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

</body>

</html>