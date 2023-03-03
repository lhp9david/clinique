<html>

<?php include('../includes/head.php'); ?>

<body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Liste des rendez-vous</h1>
                </div>
            </div>
            <div class="row">

                <form action="" method="GET">
                    <select name="doctor" id="doctor" class="form-select" aria-label="Default select example">

                        <?php displayDoctors() ?> <!-- Affiche la liste des médecins -->

                    </select>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Date du rendez-vous</th>
                                    <th scope="col">Heure du rendez-vous</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Numéro de Sécu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php Appointments::displayAllAppointments(); ?> <!-- Affiche la liste des rendez-vous -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </main>
    <?php Appointments::displayAppointmentsModals(); ?> <!-- Affiche les modals de modification de rendez-vous -->
    <?php include('../includes/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>