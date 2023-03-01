<?php

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
                        <button type="button" class="btn btn-primary col-10 m-1">Créer un nouveau patient</button>
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
                        <button type="button" class="btn btn-primary col-10 m-1">Créer un nouveau médecin</button>
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
                        <button type="button" class="btn btn-primary col-10 m-1">Nouvelle consultation</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>