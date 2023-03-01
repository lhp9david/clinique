<?php include('../includes/head.php'); ?>

<body>
  <header>
    <nav class="navbar fixed-top">
      <div class="container-fluid">
        <h3 class="navbar-brand" href="#">Liste des patients</h3>
        <a href="controller-secretary.php"><button type="button" class="btn btn-secondary rounded-5"><img src="https://img.icons8.com/ios-filled/30/FFFFFF/u-turn-to-left.png"/></button></a>
      </div>
    </nav>
  </header>
  <div class="container">
    <div class="row patient">
      <table class="table">
        <thead>
          <tr>

            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Num Sécu</th>
            <th scope="col">Tel</th>
            <th scope="col">Mail</th>
            <th scope="col">Adresse</th>
            <th scope="col"></th>

          </tr>
        </thead>
        <tbody>
          <!-- fetch all clients -->
          <?php ?>
          <tr>

            <td>Otto</td>
            <td>Mark</td>
            <td>20/11/1989</td>
            <td>1760764568795</td>
            <td>06.01.02.03.04</td>
            <td>mark@mail.fr</td>
            <td>17 rue de Labas</td>
            <td>
              <button type="button" class="btn btn-info rounded-5"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/edit.png"/></button>
              <button type="button" class="btn btn-danger rounded-5"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/delete-forever.png"/></button>
            </td>

          </tr>
         
        </tbody>
      </table>
    </div>

  </div>
</body>

</html>