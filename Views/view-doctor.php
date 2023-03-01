<?php include('../includes/head.php');     
?>
<body>
<div class="container">
    <h1 class="text-center mb-5">Liste des medecins</h1>
<table class="table">
  <thead>
    <tr>
      
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Numéro de téléphone</th>
      <th scope="col">Numéro d'urgence</th>
      <th scope="col">Mail</th>
      <th scope="col">Spécialité</th>
      <th scope="col">Adresse</th>

    </tr>
  </thead>
  <tbody>
<?php foreach ($doctorList as $doctor) {?>
    <tr>
   
      <td><?=$doctor['doctor_lastname']?></td>
      <td><?=$doctor['doctor_firstname']?></td>
      <td><?=$doctor['doctor_phone']?></td>
      <td><?=$doctor['doctor_phone_emergency']?></td>
      <td><?=$doctor['doctor_mail']?></td>
      <td><?=$doctor['specialty_id']?></td>
      <td><?=$doctor['doctor_adress']?></td>

    </tr>
<?php } ?>

  </tbody>
</table>
</div>
</body>
</html>