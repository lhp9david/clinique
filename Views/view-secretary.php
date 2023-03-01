<?php include "../includes/head.php"; ?>

<body>
    <header>
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <h5 class="navbar-brand" href="#">Bonjour Mr Truc,
                    <span class="h6 text-muted">vous êtes connecté en tant que secrétaire</span>
                </h5>
                <a href="index.php?action=logout"><button type="button" class="btn btn-danger rounded-5"><img src="https://img.icons8.com/external-solid-style-bomsymbols-/30/FFFFFF/external-design-web-design-device-solid-style-set-2-solid-style-bomsymbols--13.png" /></button></a>
            </div>
        </nav>
    </header>
    <div class="container text-center">
        <div class="row secretary">
            <div class="col m-1">
                <div class="card container-fluid">
                    <div class="card-body">
                        <h3 class="card-title mb-4"><img src="https://img.icons8.com/color/38/null/triangular-bandage.png" />Patients</h3>
                        <button type="button" class="btn btn-outline-primary rounded-5 m-1" data-bs-toggle="modal" data-bs-target="#patientModal">Créer un nouveau patient</button>
                        <button type="button" class="btn btn-outline-secondary rounded-5 m-1">Consulter la liste des patients</button>
                    </div>
                </div>
            </div>
            <div class="col m-1">
                <div class="card container-fluid">
                    <div class="card-body ">
                        <h3 class="card-title mb-4"><img src="https://img.icons8.com/color/38/null/medical-doctor.png" /> Médecins</h3>
                        <button type="button" class="btn btn-outline-primary rounded-5 m-1" data-bs-toggle="modal" data-bs-target="#doctorModal">Créer un nouveau médecin</button>
                        <button type="button" class="btn btn-outline-secondary rounded-5 m-1">Consulter la liste des médecins</button>
                    </div>
                </div>
            </div>
            <div class="col m-1">
                <div class="card container-fluid">
                    <div class="card-body">
                        <h3 class="card-title mb-4"><img src="https://img.icons8.com/color/38/null/treatment-plan.png" />Consultations</h3>

                        <button type="button" class="btn btn-outline-primary rounded-5 m-1" data-bs-toggle="modal" data-bs-target="#appointmentModal">Créer une consultation</button>

                        <button type="button" class="btn btn-outline-secondary rounded-5 m-1">Consulter la liste des consultations</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Ajout patient -->
    <div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un nouveau patient</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-person-fill"></i></div>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nom" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Prénom" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-telephone-fill"></i></i></div>
                            <input type="phone" name="phone" id="phone" class="form-control" placeholder="Téléphone" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-file-earmark-medical-fill"></i></div>
                            <input type="text" name="social" id="social" class="form-control" placeholder="Numéro de sécurité social" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-envelope-fill"></i></div>
                            <input type="mail" name="mail" id="mail" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-geo-alt-fill"></i></div>
                            <input type="text" name="adress" id="adress" class="form-control" placeholder="Adresse" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-image-fill"></i></div>
                            <input type="file" name="photo" id="photo" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-outline-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ajout Medecin -->
    <div class="modal fade" id="doctorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un nouveau medecin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-person-fill"></i></div>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nom" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Prénom" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-telephone-fill"></i></div>
                            <input type="phone" name="phone" id="phone" class="form-control" placeholder="Téléphone" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-telephone-inbound-fill"></i></div>
                            <input type="phone" name="emergency_phone" id="emergency_phone" class="form-control" placeholder="Téléphone d'urgence" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-envelope-fill"></i></div>
                            <input type="mail" name="mail" id="mail" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-geo-alt-fill"></i></div>
                            <input type="text" name="adress" id="adress" class="form-control" placeholder="Adresse" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-shield-lock"></i></div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-shield-lock-fill"></i></div>
                            <input type="password" name="confirmed_password" id="confirmed_password" class="form-control" placeholder="Mot de passe" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-activity"></i></div>
                            <select name="speciality" id="speciality">
                                <option value="" disabled selected>Specialité</option>
                                <option value="1">Ophtalmologue</option>
                                <option value="2">Dermatologue</option>
                                <option value="3">Gynécologue</option>
                                <option value="4">Généraliste</option>
                            </select>
                            <div class="input-group">
                                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-image-fill"></i></div>
                                <input type="file" name="photo" id="photo" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-outline-primary">Ajouter</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Ajout consultation -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer une nouvelle consultation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <!-- select patient (check BDD) -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-person-rolodex"></i></div>
                            <select name="patient" id="patient">
                                <?php displayPatients() ?>
                            </select>
                        </div>
                        <!-- select doctor (check BDD) -->
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-heart-pulse"></i></div>
                            <select name="doctor" id="doctor">
                                <?php displayDoctors() ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-calendar-event-fill"></i></div>
                            <input type="date" name="date" id="date" class="form-control" placeholder="Numéro de sécurité social" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-clock-fill"></i></div>
                            <input type="time" name="hour" id="hour" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="input-group">
                            <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-chat-square-dots-fill"></i></div>
                            <input type="textarea" name="description" id="description" class="form-control" placeholder="Description" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" name="newAppointmentSubmit" class="btn btn-outline-primary">Ajouter</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

</body>

</html>