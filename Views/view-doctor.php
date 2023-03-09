<html>

<?php include('../includes/head.php'); ?>


<body>
  <header>
    <nav class="navbar fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="../Controllers/controller-secretary.php">
          <img src="https://img.icons8.com/color/38/null/hospital-2.png" />
          <span class="text-muted fw-bold">
            Liste des médecins
          </span>
        </a>
        <!-- fake toats message error / success -->
        <div class="<?= $errors['show'] ?? '' ?> rounded-5 m-0 p-2">
          <?= $errors['message'] ?? '' ?>
          <?= $errors['missing'] ?? '' ?>
          <?= $errors['wrong'] ?? '' ?>
        </div>

        <div>
          <!-- button select -->
          <div class="dropstart">
            <button class="btn btn-primary dropdown-toggle rounded-5" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-search"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <!-- Filtrage par nom -->
              <?php foreach ($doctorList as $doctor) { ?>
                <li><a class="dropdown-item" href="controller-doctor.php?doctor_select=<?= $doctor['doctor_id'] ?>">Dr. <?= $doctor['doctor_lastname'] ?></a></li>
              <?php } ?>
              <li><a href="controller-doctor.php" class="dropdown-item"><button type="button" class="btn btn-outline-success rounded-5">Liste complète</button> </a></li>
            </ul>

            <!-- button return -->
            <a href="controller-secretary.php"><button type="button" class="btn btn-secondary rounded-5"><img src="https://img.icons8.com/ios-filled/24/FFFFFF/u-turn-to-left.png" /></button></a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="container">
    <div class="row doctor">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Numéro de téléphone</th>
            <th scope="col">Mail</th>
            <th scope="col">Spécialité</th>
            <th scope="col"></th>
          </tr>
        </thead>

        <tbody>

          <?php
          if (isset($_GET['doctor_select'])) {
            // filtrage par nom
            $doc = new Doctor();
            $doctorList = $doc->getDoctorById($_GET['doctor_select']);
          } else {
            $doc = new Doctor();
            $doctorList = $doc->displayDoctorList();
          }
          foreach ($doctorList as $doctor) { ?>

            <tr>
              <td>
                <a href="controller-info-doctor.php?doctor=<?= $doctor['doctor_id'] ?>">
                  <button type="button" class="btn btn-primary rounded-5">
                    <img src="https://img.icons8.com/ios-filled/20/FFFFFF/information.png" />
                  </button>
                </a>
              </td>
              <td><?= strtoupper($doctor['doctor_lastname']) ?></td>
              <td><?= ucfirst($doctor['doctor_firstname']) ?></td>
              <td><?= $doctor['doctor_phone'] ?></td>

              <td><?= $doctor['doctor_mail'] ?></td>
              <td><?= $doc->getSpecialtyName($doctor['specialty_id']) ?></td>

              <td>
                <button type="button" class="btn btn-info rounded-5" data-bs-toggle="modal" data-bs-target="#modal<?= $doctor['doctor_id'] ?>"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/edit.png" /></button>
                <button type="button" class="btn btn-danger rounded-5" data-bs-toggle="modal" data-bs-target="#modal<?= $doctor['doctor_id'] . $doctor['doctor_lastname'] ?>"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/delete-forever.png" /></button>
              </td>

            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="modal<?= $doctor['doctor_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier les informations</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="" method="get">
                    <div class="modal-body">
                      <input type="hidden" name="doctor_id" value="<?= $doctor['doctor_id'] ?>">
                      <div class="input-group">
                        <div class="input-group-text" id="btnGroupAddon"><?= $errors['name'] ?? '<i class="bi bi-person-fill"></i>' ?></div>
                        <input type="text" name="doctor_lastname" id="name" class="form-control" placeholder="Nom" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $doctor['doctor_lastname'] ?>">
                        <input type="text" name="doctor_firstname" id="firstname" class="form-control" placeholder="Prénom" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $doctor['doctor_firstname'] ?>">
                      </div>
                      <div class="input-group">
                        <div class="input-group-text" id="btnGroupAddon"><?= $errors['phone'] ?? '<i class="bi bi-telephone-fill"></i>' ?></div>
                        <input type="phone" name="doctor_phone" id="phone" class="form-control" placeholder="Téléphone" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $doctor['doctor_phone'] ?>">
                      </div>
                      <div class="input-group">
                        <div class="input-group-text" id="btnGroupAddon"><?= $errors['phone_emergency'] ?? '<i class="bi bi-telephone-inbound-fill"></i>' ?></div>
                        <input type="phone" name="doctor_phone_emergency" id="emergency_phone" class="form-control" placeholder="Téléphone d\'urgence" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $doctor['doctor_phone_emergency'] ?>">
                      </div>
                      <div class="input-group">
                        <div class="input-group-text" id="btnGroupAddon"><?= $errors['mail'] ?? '<i class="bi bi-envelope-fill"></i>' ?></div>
                        <input type="mail" name="doctor_mail" id="mail" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $doctor['doctor_mail'] ?>">
                      </div>
                      <div class="input-group">
                        <div class="input-group-text" id="btnGroupAddon"><?= $errors['adress'] ?? '<i class="bi bi-geo-alt-fill"></i>' ?></div>
                        <input type="text" name="doctor_adress" id="adress" class="form-control" placeholder="Adresse" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $doctor['doctor_adress'] ?>">
                      </div>
                      <div class="input-group">
                        <div class="input-group-text" id="btnGroupAddon"><?= $errors['specialty'] ?? '<i class="bi bi-activity"></i>' ?></div>
                        <select name="specialty_id" id="specialty">
                          <option value="" disabled>Specialité</option>
                          <option value="1" <?= ($doctor['specialty_id'] == 1 ? 'selected' : '') ?>>Ophtalmologue</option>
                          <option value="2" <?= ($doctor['specialty_id'] == 2 ? 'selected' : '') ?>>Dermatologue</option>
                          <option value="3" <?= ($doctor['specialty_id'] == 3 ? 'selected' : '') ?>>Gynécologue</option>
                          <option value="4" <?= ($doctor['specialty_id'] == 4 ? 'selected' : '') ?>>Généraliste</option>
                        </select>
                        <img src="../Uploads/<?= $doctor['doctor_photo'] ?>" alt="" class="w-25">
                        <div class="input-group">
                          <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-image-fill"></i></div>
                          <label for="doctor_photo" class="btn border" onmouseover="this.style.background='#e9e3f1';" onmouseout="this.style.background='none';">Choisissez une photo :</label>
                          <input type="txt" class="form-control">
                          <input type="file" name="doctor_photo" id="doctor_photo" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" style=display:none>
                        </div>
                      </div>
                      <div class="<?= $errors['show-wrong'] ?? '' ?> rounded-5 mt-2 p-2">
                        <?= $errors['wrong'] ?? '' ?>
                      </div>
                      <div class="<?= $errors['show-missing'] ?? '' ?> rounded-5 mt-2 p-2">
                        <?= $errors['missing'] ?? '' ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-outline-primary">Modifier</button>
                      </div>


                  </form>
                </div>
              </div>
            </div>
    </div>
  </div>

  <!-- Modal Delete -->
  <div class="modal fade" id="modal<?= $doctor['doctor_id'] ?><?= $doctor['doctor_lastname'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h6> Voulez-vous supprimer cet élément définitivement?</h6>
          <div class="text-center">
            <button type="button" class="btn btn-primary"><a href="controller-doctor.php?delete=<?= $doctor['doctor_id'] ?>"><span class="text-white">oui</span></a></button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">non</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
          }

?>

</tbody>
</table>
</div>

</div>
<?php include('../includes/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>