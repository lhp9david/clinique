<html>

<?php include('../includes/head.php'); ?>

<body>
  <header>
    <nav class="navbar fixed-top">
      <div class="container-fluid">
        <h3 class="navbar-brand" href="#">Liste des patients</h3>
        <a href="controller-secretary.php"><button type="button" class="btn btn-secondary rounded-5"><img src="https://img.icons8.com/ios-filled/24/FFFFFF/u-turn-to-left.png" /></button></a>
      </div>
    </nav>
  </header>
  <div class="container">
    <form action="../Controllers/controller-list-patient.php" method="get" style="margin-top : 80px">
      <label for="SSNumber">Rechercher un patient par numéro de sécurité sociale :</label>
      <input type="text" id="SSNumber" name="SSNumber" required minlength="15" maxlength="15" size="15">
      <input type="submit" value="Rechercher">
    </form>

    <form action="../Controllers/controller-list-patient.php" method="get" style="margin-top : 80px">
      <label for="DDNumber">Rechercher un patient par date de naissance :</label>
      <input type="date" id="DDNumber" name="Bdate" class="text-center" value="<?= date('Y-m-d') ?>">
      <input type="submit" value="Rechercher">
    </form>

    <span> <?= $errors_patient['patient_search'] ?? '' ?> </span> 
    <button onclick="window.location.href='./controller-list-patient.php'">Afficher tous les patients</button>


    <div class="row patient">
      <table class="table">
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
              <td><?= $patient['patient_birthdate'] ?></td>
              <td><?= $patient['patient_secu'] ?></td>
              <td><?= $patient['patient_mail'] ?></td>
              <td><?= $patient['patient_phone'] ?></td>
              <td><?= $patient['patient_adress'] ?></td>
              <td>
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
    <div class="modal" tabindex="-1" id="modalEdit<?= $patient['patient_id'] ?>" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifier les information d'un patient</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../Controllers/controller-list-patient.php" method="POST" id="formEdit">
              <div class="input-group">
                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-person-fill"></i></div>
                <input type="text" name="patient_lastname" id="patient_lastname" class="form-control" placeholder="Nom" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_lastname'] ?>'>
                <input type="text" name="patient_firstname" id="patient_firstname" class="form-control" placeholder="Prénom" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_firstname'] ?>'>
              </div>
              <div class="input-group">
                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-calendar"></i></i></div>
                <input type="text" name="patient_birthdate" id="patient_birthdate" class="form-control" placeholder="Date de naissance" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_birthdate'] ?>'>
              </div>
              <div class="input-group">
                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-telephone-fill"></i></i></div>
                <input type="phone" name="patient_phone" id="patient_phone" class="form-control" placeholder="Téléphone" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_phone'] ?>'>
              </div>
              <div class="input-group">
                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-file-earmark-medical-fill"></i></div>
                <input type="text" name="patient_secu" id="patient_secu" class="form-control" placeholder="Numéro de sécurité social" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_secu'] ?>'>
              </div>
              <div class="input-group">
                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-envelope-fill"></i></div>
                <input type="mail" name="patient_mail" id="patient_mail" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_mail'] ?>'>
              </div>
              <div class="input-group">
                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-geo-alt-fill"></i></div>
                <input type="text" name="patient_adress" id="patient_adress" class="form-control" placeholder="Adresse" aria-label="Input group example" aria-describedby="btnGroupAddon" value='<?= $patient['patient_adress'] ?>'>
              </div>
              <input type="hidden" name="patient_id" value='<?= $patient['patient_id'] ?>'>
              <input type="hidden" name="patient_photo" value='<?= $patient['patient_mail'] ?>'>
              <div class="input-group">
                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-image-fill"></i></div>
                <input type="file" name="patient_photo" id="patient_photo" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" onclick="document.forms['formEdit'].submit();">Modifier</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" tabindex="-1" id="modalDelete<?= $patient['patient_id'] ?>" aria-labelledby="modalDeleteLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Suppression</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Etes-vous sur de vouloir supprimer ce patient :</p>
            <p class="text-center"><strong><?= $patient['patient_lastname'] . ' ' . $patient['patient_firstname'] ?></strong></p>
          </div>
          <div class="modal-footer">
            <form action="../Controllers/controller-list-patient.php" method="get">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-danger" name='delete' value='<?= $patient['patient_id'] ?>'>Oui, je suis sûr</button>
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