<?php
require_once('../Models/doctor.php');
require_once('../config/env.php');
require_once('../helpers/Database.php');


// affichage des docteurs en table
$doc = new Doctor();
$doctorList = $doc->displayDoctorList();

// affichage de tous les nom des docteurs dans le dropdown
$doc = new Doctor();
$doctorListName = $doc->getDoctorLastName();


// méthode GET 
if ($_SERVER["REQUEST_METHOD"] == "GET") {


    // Update des informations
    if (isset($_GET['doctor_id'])) {

        // on vérifie que le docteur existe
        $doc = new Doctor();
        $doc = $doc->getDoctorById($_GET['doctor_id']);

        if ($doc == null) {
            // on redirige vers la page d'accueil
            // header('Location:controller-doctor.php');
            echo 'nope';
        } else {
            $doc = new Doctor();
            $doc->updateDoctor($_GET['doctor_id'], $_GET['doctor_lastname'], $_GET['doctor_firstname'], $_GET['doctor_phone'], $_GET['doctor_phone_emergency'], $_GET['doctor_mail'], $_GET['doctor_adress'], $_GET['doctor_photo'], $_GET['specialty_id']);
            header('Location:controller-doctor.php');
        }
    }

    // Supression du docteur
    if (isset($_GET['delete'])) {

        // On vérifie que le docteur existe
        $doc = new Doctor();
        $doc = $doc->getDoctorById($_GET['delete']);
        if ($doc == null) {
            // On redirige vers la page d'accueil 
            header('Location:controller-doctor.php');
        } else {
            $doc = new Doctor();
            $doc->deleteDoctor($_GET['delete']);
            // On redirige vers la page d'accueil 
            header('Location:controller-doctor.php');
        }
    }

    // Afficher le docteur selon id
    // if (isset($_GET['doctor_select'])) {

    //     // On vérifie que le docteur existe
    //     $doc = new Doctor();
    //     $doc = $doc->getDoctorById($_GET['doctor_select']);
    //     if ($doc == null) {
    //         // On redirige vers la page d'accueil 
    //         echo "nope";
    //     } else {
    //         echo "okay";
    //         $doc = new Doctor();
    //         $doctor_select = $doc->getDoctorById($_GET['doctor_select']);
    //     }
    // } else {
    // }
}

function displayDoctorList()
{
    if (isset($_GET['doctor_select'])) {
        $doc = new Doctor();
        $doctorList = $doc->getDoctorById($_GET['doctor_select']);
        $return = '<button class="btn btn-secondary rounded-5"><a href="controller-doctor.php"><img src="https://img.icons8.com/ios-filled/24/FFFFFF/u-turn-to-left.png" /></a></button>';
    } else {
        $doc = new Doctor();
        $doctorList = $doc->displayDoctorList();
        $return= '';
    }
    foreach ($doctorList as $doctor) {
        echo '
        <tr>
        <td>' . $doctor['doctor_lastname'] . '</td>
        <td>' . $doctor['doctor_firstname'] . '</td>
        <td>' . $doctor['doctor_phone'] . '</td>
        <td>' . $doctor['doctor_phone_emergency'] . '</td>
        <td>' . $doctor['doctor_mail'] . '</td>
        <td>' . $doctor['specialty_id'] . '</td>
        <td>' . $doctor['doctor_adress'] . '</td>
        <td> <button type="button" class="btn btn-info rounded-5" data-bs-toggle="modal" data-bs-target="#modal' . $doctor['doctor_id'] . '"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/edit.png" /></button>
        <button type="button" class="btn btn-danger rounded-5" data-bs-toggle="modal" data-bs-target="#modal' . $doctor['doctor_id'] . $doctor['doctor_lastname'] . '"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/delete-forever.png" /></button>
        '. $return .'</td>
        </tr>';

        echo '
        <div class="modal fade" id="modal'. $doctor['doctor_id'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier les informations</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- formulaire de modification -->
              <form action="" method="get">
                <div class="modal-body">
                  <input type="hidden" name="doctor_id" value="'. $doctor['doctor_id'] .'">
                  <div class="input-group">
                    <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-person-fill"></i></div>
                    <input type="text" name="doctor_lastname" id="name" class="form-control" placeholder="Nom" aria-label="Input group example" aria-describedby="btnGroupAddon" value="'. $doctor['doctor_lastname'] .'">
                    <input type="text" name="doctor_firstname" id="firstname" class="form-control" placeholder="Prénom" aria-label="Input group example" aria-describedby="btnGroupAddon" value="'. $doctor['doctor_firstname'] .'">
                  </div>
                  <div class="input-group">
                    <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-telephone-fill"></i></div>
                    <input type="phone" name="doctor_phone" id="phone" class="form-control" placeholder="Téléphone" aria-label="Input group example" aria-describedby="btnGroupAddon" value="'. $doctor['doctor_phone'] .'">
                  </div>
                  <div class="input-group">
                    <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-telephone-inbound-fill"></i></div>
                    <input type="phone" name="doctor_phone_emergency" id="emergency_phone" class="form-control" placeholder="Téléphone d\'urgence" aria-label="Input group example" aria-describedby="btnGroupAddon" value="'. $doctor['doctor_phone_emergency'] .'">
                  </div>
                  <div class="input-group">
                    <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-envelope-fill"></i></div>
                    <input type="mail" name="doctor_mail" id="mail" class="form-control" placeholder="Adresse mail" aria-label="Input group example" aria-describedby="btnGroupAddon" value="'. $doctor['doctor_mail'] .'">
                  </div>
                  <div class="input-group">
                    <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-geo-alt-fill"></i></div>
                    <input type="text" name="doctor_adress" id="adress" class="form-control" placeholder="Adresse" aria-label="Input group example" aria-describedby="btnGroupAddon" value="'. $doctor['doctor_adress'] .'">
                  </div>
                  <div class="input-group">
                    <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-activity"></i></div>
                    <select name="specialty_id" id="specialty">
                      <option value="" disabled selected>Specialité</option>
                      <option value="1">Ophtalmologue</option>
                      <option value="2">Dermatologue</option>
                      <option value="3">Gynécologue</option>
                      <option value="4">Généraliste</option>
                    </select>
                    <div class="input-group">
                      <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-image-fill"></i></div>
                      <input type="file" name="doctor_photo" id="photo" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-outline-primary">Sauvegarder</button>
                  </div>
              </form>

            </div>
          </div>
        </div>
  </div>

  <div class="modal fade" id="modal'. $doctor['doctor_id'] .''. $doctor['doctor_lastname'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h6> Voulez-vous supprimer cet élément définitivement?</h6>
          <!-- bouton delete -->
          <div class="text-center">
            <button type="button" class="btn btn-primary"><a href="controller-doctor.php?delete='. $doctor['doctor_id'] .'">oui</a> </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">non</button>
          </div>
        </div>
      </div>
    </div>
  </div>';
       
    }
}











include('../Views/view-doctor.php');
