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
                            <?php Appointments::displayAllAppointments(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>

</html>