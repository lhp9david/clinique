<html>
<?php include "../includes/head.php";
?>

<body>
    <header>
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../Controllers/controller-secretary.php">
                    <img src="https://img.icons8.com/color/38/null/hospital-2.png" />
                    <span class="text-muted fw-bold h5">
                        Bonjour <?= $_SESSION["secretary_login"] ?>
                        <span class="text-muted h6">vous êtes connecté(e) en tant que secrétaire</span>
                    </span>
                </a>

                <!-- fake toats message error / success -->
                <div class="<?= $success['show'] ?? '' ?> rounded-5 m-0 p-2">
                    <?= $success['patient'] ?? '' ?>
                    <?= $success['doctor'] ?? '' ?>
                    <?= $success['appointment'] ?? '' ?>
                </div>
                <a href="controller-login.php?action=logout"><button type="button" class="btn btn-danger rounded-5"><img src="https://img.icons8.com/external-solid-style-bomsymbols-/30/FFFFFF/external-design-web-design-device-solid-style-set-2-solid-style-bomsymbols--13.png" /></button></a>
            </div>
        </nav>
    </header>

    <div class="container text-center mt-5 mb-5">
        <div class="row secretary">
            <div class="col m-1">
                <div class="card container-fluid">
                    <div class="card-body">
                        <h3 class="card-title mb-4"><img src="https://img.icons8.com/color/38/null/triangular-bandage.png" />Patients</h3>
                        <button type="button" class="btn btn-outline-primary rounded-5 m-1" data-bs-toggle="modal" data-bs-target="#patientModal">Créer un nouveau patient</button>
                        <a href="controller-list-patient.php"><button type="button" class="btn btn-outline-secondary rounded-5 m-1">Consulter la liste des patients</button></a>
                    </div>
                </div>
            </div>
            <div class="col m-1">
                <div class="card container-fluid">
                    <div class="card-body ">
                        <h3 class="card-title mb-4"><img src="https://img.icons8.com/color/38/null/medical-doctor.png" /> Médecins</h3>
                        <button type="button" class="btn btn-outline-primary rounded-5 m-1" data-bs-toggle="modal" data-bs-target="#doctorModal">Créer un nouveau médecin</button>
                        <a href="controller-doctor.php"><button type="button" class="btn btn-outline-secondary rounded-5 m-1">Consulter la liste des médecins</button></a>
                    </div>
                </div>
            </div>
            <div class="col m-1">
                <div class="card container-fluid">
                    <div class="card-body">
                        <h3 class="card-title mb-4"><img src="https://img.icons8.com/color/38/null/treatment-plan.png" />Consultations</h3>

                        <button type="button" class="btn btn-outline-primary rounded-5 m-1" data-bs-toggle="modal" data-bs-target="#appointmentModal">Créer une consultation</button>

                        <a href="controller-doctor-appointments.php"><button type="button" class="btn btn-outline-secondary rounded-5 m-1">Consulter la liste des consultations</button></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Ajout patient -->
    <div class="modal fade <?= !empty($errors_patient) ? 'openModal' : '' ?>" id="patientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un nouveau patient</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_name'] ?? '<i class="bi bi-person-fill"></i>' ?></div>
                            <input type="text" name="patient_lastname" id="name" class="form-control" placeholder="Nom" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $_POST['patient_lastname'] ?? '' ?>">
                            <input type="text" name="patient_firstname" id="firstname" class="form-control" placeholder="Prénom" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $_POST['patient_firstname'] ?? '' ?>">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_birthdate'] ?? '<i class="bi bi-calendar"></i>' ?></div>
                            <input type="date" name="patient_birthdate" id="patient_birthdate" class="form-control" placeholder="Date de naissance" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $_POST['patient_birthdate'] ?? '' ?>">
                        </div>

                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_secu'] ?? '<i class="bi bi-file-earmark-medical-fill"></i>' ?></div>
                            <input type="text" name="patient_secu" id="social" class="form-control" placeholder="Numéro de sécurité social" minlength="15" maxlength="15" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $_POST['patient_secu'] ?? '' ?>">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_mail'] ?? '<i class="bi bi-envelope-fill"></i>' ?></div>
                            <input type="mail" name="patient_mail" id="mail" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $_POST['patient_mail'] ?? '' ?>">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_phone'] ?? '<i class="bi bi-telephone-fill"></i>' ?></div>
                            <input type="phone" name="patient_phone" id="phone" class="form-control" placeholder="Téléphone" minlength="10" maxlength="10" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $_POST['patient_phone'] ?? '' ?>">
                        </div>
                        <div class="input-group">

                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_patient['patient_adress'] ?? '<i class="bi bi-geo-alt-fill"></i>' ?></div>
                            <input type="text" name="patient_adress" id="adress" class="form-control" placeholder="Adresse" aria-label="Input group example" aria-describedby="btnGroupAddon" value="<?= $_POST['patient_adress'] ?? '' ?>">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-image-fill"></i></div>
                            <label for="doctor_photo" class="btn border" onmouseover="this.style.background='#e9e3f1';" onmouseout="this.style.background='none';">Choisissez une photo :</label>
                            <input type="txt" class="form-control">
                            <input type="file" name="doctor_photo" id="doctor_photo" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" style=display:none>
                        </div>
                        <div class="<?= $errors_patient['show'] ?? '' ?> rounded-5 mt-2 p-2">
                            <?= $errors_patient['message'] ?? '' ?>
                            <?= $errors_patient['missing'] ?? '' ?>
                        </div>
                        <div class="<?= $errors_patient['show-missing'] ?? '' ?> rounded-5 mt-2 p-2">
                            <?= $errors_patient['missing'] ?? '' ?>
                        </div>
                        <div class="<?= $errors_patient['show-mail'] ?? '' ?> rounded-5 mt-2 p-2">
                            <?= $errors_patient['message_mail'] ?? '' ?>
                        </div>
                        <div class="<?= $errors_patient['show-phone'] ?? '' ?> rounded-5 mt-2 p-2">
                            <?= $errors_patient['message_phone'] ?? '' ?>
                        </div>
                        <div class="<?= $errors_patient['show-secu'] ?? '' ?> rounded-5 mt-2 p-2">
                            <?= $errors_patient['message_secu'] ?? '' ?>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" id="add" name="newPatient" class="btn btn-outline-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ajout Medecin -->
    <div class="modal fade <?= !empty($errors) ? 'openModal' : '' ?>" id="doctorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un nouveau medecin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors['name'] ?? '<i class="bi bi-person-fill"></i>' ?></div>
                            <input type="text" name="doctor_lastname" id="name" class="form-control" placeholder="Nom" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            <input type="text" name="doctor_firstname" id="firstname" class="form-control" placeholder="Prénom" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors['phone'] ?? '<i class="bi bi-telephone-fill"></i>' ?></div>
                            <input type="phone" name="doctor_phone" id="phone" class="form-control" placeholder="Téléphone" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors['phone_emergency'] ?? '<i class="bi bi-telephone-inbound-fill"></i>' ?></div>
                            <input type="phone" name="doctor_phone_emergency" id="emergency_phone" class="form-control" placeholder="Téléphone d'urgence" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors['mail'] ?? '<i class="bi bi-envelope-fill"></i>' ?></div>
                            <input type="mail" name="doctor_mail" id="mail" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors['adress'] ?? '<i class="bi bi-geo-alt-fill"></i>' ?></div>
                            <input type="text" name="doctor_adress" id="adress" class="form-control" placeholder="Adresse" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors['password'] ?? '<i class="bi bi-shield-lock"></i>' ?></div>
                            <input type="password" name="doctor_password" id="password" class="form-control" placeholder="Mot de passe" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors['confirmPass'] ?? '<i class="bi bi-shield-lock-fill"></i>' ?></div>
                            <input type="password" name="confirmPass" id="confirmed_password" class="form-control" placeholder="Mot de passe" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors['specialty'] ?? '<i class="bi bi-activity"></i>' ?></div>
                            <select name="specialty_id" id="specialty">
                                <option value="" disabled selected>Specialité</option>
                                <option value="1">Ophtalmologue</option>
                                <option value="2">Dermatologue</option>
                                <option value="3">Gynécologue</option>
                                <option value="4">Généraliste</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-image-fill"></i></div>
                            <label for="doctor_photo" class="btn border" onmouseover="this.style.background='#e9e3f1';" onmouseout="this.style.background='none';">Choisissez une photo :</label>
                            <input type="txt" class="form-control">
                            <input type="file" name="doctor_photo" id="doctor_photo" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon" style=display:none>
                        </div>
                            <div class="<?= $errors['show'] ?? '' ?> rounded-5 mt-2 p-2">
                                <?= $errors['message'] ?? '' ?>
                                <?= $errors['missing'] ?? '' ?>
                            </div>
                            <div class="<?= $errors['show-missing'] ?? '' ?> rounded-5 mt-2 p-2">
                                <?= $errors['missing'] ?? '' ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button name="submitNewDoctor" id="add" type="submit" class="btn btn-outline-primary">Ajouter</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Ajout consultation -->
    <div class="modal fade <?= !empty($errors_appointment) || isset($_GET['id']) ? 'openModal' : '' ?>" id="appointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer une nouvelle consultation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="controller-secretary.php" method="POST">
                    <div class="modal-body">
                        <!-- select patient (check BDD) -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_appointment['patient'] ?? '<i class="bi bi-person-rolodex"></i>' ?></div>
                            <select name="patient" id="patient">
                                <?php displayPatients() ?>
                            </select>
                        </div>
                        <!-- select doctor (check BDD) -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_appointment['doctor'] ?? '<i class="bi bi-heart-pulse"></i>' ?></div>
                            <select name="doctor" id="doctor">
                                <?php displayDoctors() ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_appointment['date'] ?? '<i class="bi bi-calendar-event-fill"></i>' ?></div>
                            <input value='<?= $_POST['date'] ?? '' ?>' type="date" name="date" id="date" class="form-control" placeholder="Numéro de sécurité social" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_appointment['hour'] ?? '<i class="bi bi-clock-fill"></i>' ?></div>
                            <input value='<?= $_POST['hour'] ?? '' ?>' type="time" name="hour" id="hour" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><?= $errors_appointment['description'] ?? '<i class="bi bi-chat-square-dots-fill"></i>' ?></div>
                            <input value='<?= $_POST['description'] ?? '' ?>' type="textarea" name="description" id="description" class="form-control" placeholder="Description" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="<?= $errors_appointment['show'] ?? '' ?> rounded-5 mt-2 p-2">
                            <?= $errors_appointment['message'] ?? '' ?>
                            <?= $errors_appointment['missing'] ?? '' ?>
                        </div>
                        <div class="<?= $errors_appointment['show-missing'] ?? '' ?> rounded-5 mt-2 p-2">
                            <?= $errors_appointment['missing'] ?? '' ?>
                        </div>
                        <div class="<?= $errors_appointment['show-error'] ?? '' ?> rounded-5 mt-2 p-2">
                            <?= $errors_appointment['error'] ?? '' ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" id="add" name="newAppointmentSubmit" class="btn btn-outline-primary">Ajouter</button>
                    </div>
                </form>

            </div>
        </div>
    </div>




    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        // creation de l'objet openModal, nous ciblons la classe openModal
        let openModal = new bootstrap.Modal(document.querySelector('.openModal'), {
            keyboard: false
        });
        // nous l'ouvrons avec la methode show()
        openModal.show();
    </script>
</body>

</html>