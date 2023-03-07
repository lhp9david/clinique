<html>

<?php include('../includes/head.php'); ?>


<body>
  <header>
    <nav class="navbar fixed-top">
      <div class="container-fluid">
      <a class="navbar-brand" href="#">
          <img src="https://img.icons8.com/color/38/null/hospital-2.png"/>
          <span class="text-muted fw-bold">
            Liste des médecins
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
              <?php foreach ($doctorList as $doctor) { ?>
                <li><a class="dropdown-item" href="controller-doctor.php?doctor_select=<?= $doctor['doctor_id'] ?>"><?= $doctor['doctor_lastname'] ?></a></li>
              <?php } ?>
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

            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Numéro de téléphone</th>
            <th scope="col">Numéro d'urgence</th>
            <th scope="col">Mail</th>
            <th scope="col">Spécialité</th>
            <th scope="col">Adresse</th>
            <th scope="col"></th>

          </tr>
        </thead>
        <tbody>
          <?php displayDoctorList() ?>

        </tbody>
      </table>
    </div>

  </div>
  <?php include('../includes/footer.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>