<html>

<?php include('../includes/head.php'); ?>


<body>
    <header>
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../Controllers/controller-secretary.php">
                    <img src="https://img.icons8.com/color/38/null/hospital-2.png" />
                    <span class="text-muted fw-bold">
                        Informations de <?= $doctor_lastname?> <?= $doctor_firstname ?> 
                    </span>
                </a>
                <div>
                    <a href="controller-doctor.php"><button type="button" class="btn btn-secondary rounded-5"><img src="https://img.icons8.com/ios-filled/24/FFFFFF/u-turn-to-left.png" /></button></a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="row doctor justify-content-center">
            <div class="col-4 card text-center">
                <div class="card-body">
                    <!-- doctor-photo en rounded circle-->
                    <div class="row mb-2">
                        <div class="col-4">
                            <img src="../Uploads/<?php
                            if ($doctor_photo == '') {
                                echo 'default_doctor_photo.png';
                            } else {
                                echo $doctor_photo;
                            } ?>" alt="profil picture" class="rounded-circle border border-5 border-light img-fluid" />
                        </div>
                        <div class="col p-3 text-start">
                            <h5 class="card-title pt-2"><?= $doctor_lastname?> <?= $doctor_firstname ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $doctor_specialty?></h6>
                        </div>
                    </div>

                    <div class="text-start">
                        <!-- adresse mail -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-envelope-fill"></i></div>
                            <input type="mail" name="mail" id="mail" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $doctor_mail?>" disabled>
                        </div>
                        <!-- phone -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-telephone-fill"></i></div>
                            <input type="phone" name="patient_phone" id="phone" class="form-control" placeholder="T??l??phone" minlength="10" maxlength="10" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $doctor_phone?>" disabled>
                        </div>
                        <!-- phone emergency -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-headset"></i></div>
                            <input type="phone" name="patient_phone" id="phone" class="form-control" placeholder="T??l??phone" minlength="10" maxlength="10" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $doctor_phone_emergency?>" disabled>
                        </div>
                        <!-- adress -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-geo-alt-fill"></i></div>
                            <input type="text" name="patient_adress" id="adress" class="form-control" placeholder="Adresse" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $doctor_adress?>" disabled>
                        </div>

                    </div>

                    <a href="controller-doctor-appointments.php?doctor=<?= $doctor_id ?>" class="btn btn-outline-primary mt-3 rounded-5">Liste des consultations</a>
                </div>
            </div>
        </div>

    </div>
    <?php include('../includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>