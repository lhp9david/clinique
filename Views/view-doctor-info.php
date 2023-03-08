<html>

<?php include('../includes/head.php'); ?>


<body>
    <header>
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../Controllers/controller-secretary.php">
                    <img src="https://img.icons8.com/color/38/null/hospital-2.png" />
                    <span class="text-muted fw-bold">
                        Informations de
                        <!-- echo court nom du médecin -->
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
                    <img src="https://img.icons8.com/color/48/null/woman-profile-skin-type-1.png" alt="profil picture" class="rounded-circle border border-5 border-light"/>
                    <h5 class="card-title">NOM Prénom</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Spécialité</h6>
                    <div class="text-start">
                        <!-- adresse mail -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-envelope-fill"></i></div>
                            <input type="mail" name="mail" id="mail" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon" value="" disabled>
                        </div>
                        <!-- phone -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-telephone-fill"></i></div>
                            <input type="phone" name="patient_phone" id="phone" class="form-control" placeholder="Téléphone" minlength="10" maxlength="10" aria-label="Input group example" aria-describedby="btnGroupAddon" value="" disabled>
                        </div>
                        <!-- phone emergency -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-telephone-fill"></i></div>
                            <input type="phone" name="patient_phone" id="phone" class="form-control" placeholder="Téléphone" minlength="10" maxlength="10" aria-label="Input group example" aria-describedby="btnGroupAddon" value=""disabled>
                        </div>
                        <!-- adress -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-geo-alt-fill"></i></div>
                            <input type="text" name="patient_adress" id="adress" class="form-control" placeholder="Adresse" aria-label="Input group example" aria-describedby="btnGroupAddon" value=""disabled>
                        </div>
                        
                    </div>

                    <a href="#" class="btn btn-outline-primary mt-3 rounded-5">Liste des consultations</a>
                </div>
            </div>
        </div>

    </div>
    <?php include('../includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>