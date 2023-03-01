<?php
include('../includes/head.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Clinique</title>
</head>

<body>

    <div class="container text-center mt-3">
        <h2>Mr Truc</h2>
        <p>Vous êtes connecté en tant que secrétaire</p>
        <div class="row">
            <div class="col-4 border">
                <div class="row">

                    <h3 class="row">Patients</h3>
                    <div class="row d-flex justify-content-center">
                        <button type="button" class="btn btn-primary col-10 m-1" data-bs-toggle="modal" data-bs-target="#patientModal">Créer un nouveau patient</button>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary col-10 m-1">Consulter la liste des patients</button>
                    </div>

                </div>
            </div>

            <div class="col-4 border">
                <div class="raw">

                    <h3 class="row">Médecins</h3>
                    <div class="row d-flex justify-content-center">
                        <button type="button" class="btn btn-primary col-10 m-1" data-bs-toggle="modal" data-bs-target="#doctorModal">Créer un nouveau médecin</button>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary col-10 m-1">Consulter la liste des médecins</button>
                    </div>

                </div>
            </div>

            <div class="col-4 border">
                <div class="raw">

                    <h3 class="row">Consultations</h3>
                    <div class="row d-flex justify-content-center">
                        <button type="button" class="btn btn-primary col-10 m-1" data-bs-toggle="modal" data-bs-target="#appointmentModal">Nouvelle consultation</button>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary col-10 m-1">Consulter la liste des consultations</button>
                    </div>

                </div>
            </div>

            <div class="row mt-3 text-center">
                <a href="index.php?action=logout"><button type="button" class="btn btn-dark">Déconnexion</button></a>
            </div>

        </div>
    </div>
    </div>

    <!-- Modal Ajout Medecin -->
<div class="modal fade" id="doctorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un nouveau medecin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="../Controllers/controller-doctor.php" method="POST">
        <div>
            <label for="name">Nom</label><span><?=$errors['lastname'] ?? '' ?></span>
            <input type="text" name="doctor_lastname" id="name" required>
        </div>
        <div>
            <label for="firstname">Prénom</label>
            <input type="text" name="doctor_firstname" id="firstname" required>
        </div>
        <div>
            <label for="phone">Numéro de téléphone</label>
            <input type="phone" name="doctor_phone" id="phone" required>
        </div>
        <div>
            <label for="emergencyPhone">Numéro de téléphone d'urgence</label>
            <input type="phone" name="doctor_phone_emergency" id="emergencyPhone" required>
        </div>
        <div>
            <label for="mail">Adresse mail</label>
            <input type="mail" name="doctor_mail" id="mail" required>
        </div>
        <div>
            <label for="adress">Adresse</label>
            <input type="text" name="doctor_adress" id="adress" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="doctor_password" id="password" required>
        </div>
        <div>
            <label for="confirmPass">Confirmer le mot de passe</label>
            <input type="password" name="confirmPass" id="confirmPass" required>
        </div>
        <div>
            <select name="specialty_id" id="specialty" required>
                <option value="">Specialité</option>
                <option value="1">Ophtalmologue</option>
                <option value="2">Dermatologue</option>
                <option value="3">Gynécologue</option>
                <option value="4">Généraliste</option>
            </select>
        </div>
        <div>
            <!-- upload photo -->
            <label for="photo">Photo</label>
            <input type="file" name="doctor_photo" id="photo" >
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary">Ajouter</button>
      </div>
    </div>
  </div>
</div>

    <!-- Modal Ajout patient -->
    <div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un nouveau patient</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname">
        </div>
        <div>
            <label for="phone">Numéro de téléphone</label>
            <input type="phone" name="phone" id="phone">
        </div>
        <div>
            <label for="social">Numéro de sécurité social</label>
            <input type="text" name="social" id="social">
        </div>
        <div>
            <label for="mail">Adresse mail</label>
            <input type="mail" name="mail" id="mail">
        </div>
        <div>
            <label for="firstname">Adresse</label>
            <input type="text" name="firstname" id="firstname">
        </div>

        <div>
            <!-- upload photo -->
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" >
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary">Ajouter</button>
      </div>
    </div>
  </div>
</div>

    <!-- Modal Ajout consultation -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une nouvelle consultation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">

        <div>
            <label for="social">Numéro de sécurité social</label>
            <input type="text" name="social" id="social">
        </div>
        <div>
            <label for="date">Date</label>
            <input type="date" name="date" id="date">
        </div>
        <div>
            <label for="hour">Heure</label>
            <input type="time" name="hour" id="hour">
        </div>

 
        <div>
            <input type="submit">
        </div>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary">Ajouter</button>
      </div>
    </div>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>