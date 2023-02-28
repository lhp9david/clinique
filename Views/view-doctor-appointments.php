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

                                <th scope="col"><a href="controller-doctor-appointments.php?sort=ASC"><i class="bi bi-sort-up"></i></a></th>
                                <th scope="col"><a href="controller-doctor-appointments.php?sort=DESC"><i class="bi bi-sort-down"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Skurt</td>
                                <td>Gérard</td>
                                <td>2021-10-10</td>
                                <td>10:00</td>
                                <td>0606060606</td>
                                <td>123456789123456</td>

                            </tr>
                            <tr>
                                <td>Poulop</td>
                                <td>Thierry</td>
                                <td>2021-10-10</td>
                                <td>10:00</td>
                                <td>0606060606</td>
                                <td>123456789123456</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>

</html>