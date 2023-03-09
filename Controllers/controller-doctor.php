<?php
require_once('../Models/doctor.php');
require_once('../config/env.php');
require_once('../helpers/Database.php');

session_start();

if (!isset($_SESSION['secretary_id'])) { // Si l'utilisateur n'est une secrétaire, on le redirige vers la page de connexion
  header('location: controller-login.php');
  exit;
}

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

    $doc = new Doctor();
    $doc = $doc->getDoctorById($_GET['doctor_id']);
    $doctor_id = $doc['doctor_id'];

    // vérification que le "formulaire" est valide
    $errors = [];
    $wrong = '<i class="bi bi-x-circle-fill text-danger"></i>';
    $missing = '<i class="bi bi-exclamation-circle-fill text-danger"></i>';

    if (isset($_GET['doctor_lastname'])) {
      if (empty($_GET['doctor_lastname'])) {
        $errors['show-missing'] = 'alert alert-danger';
        $errors['name'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_GET['doctor_lastname'])) {
        $errors['show-wrong'] = 'alert alert-danger';
        $errors['name'] = $wrong;
        $errors['message'] = 'Format incorrect';
      } else {
        $doctor_lastname = $_GET['doctor_lastname'];
      }
    }

    if (isset($_GET['doctor_firstname'])) {
      if (empty($_GET['doctor_firstname'])) {
        $errors['show-missing'] = 'alert alert-danger';
        $errors['name'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_GET['doctor_firstname'])) {
        $errors['show-wrong'] = 'alert alert-danger';
        $errors['name'] = $wrong;
        $errors['wrong'] = 'Format incorrect';
      } else {
        $doctor_firstname = $_GET['doctor_firstname'];
      }
    }

    if (isset($_GET['doctor_mail'])) {

      if (empty($_GET['doctor_mail'])) {
        $errors['show-missing'] = 'alert alert-danger';
        $errors['mail'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $_GET['doctor_mail'])) {
        $errors['show-wrong'] = 'alert alert-danger';
        $errors['mail'] = $wrong;
        $errors['wrong'] = 'Format incorrect';
      } else {
        $doctor_mail = $_GET['doctor_mail'];
      }
    }

    if (isset($_GET['doctor_phone'])) {
      if (empty($_GET['doctor_phone'])) {
        $errors['show-missing'] = 'alert alert-danger';
        $errors['phone'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else if (!preg_match('/^0[1-9]([-. ]?[0-9]{2}){4}$/', $_GET['doctor_phone'])) {
        $errors['show-wrong'] = 'alert alert-danger';
        $errors['phone'] = $wrong;
        $errors['wrong'] = 'Format incorrect';
      } else {
        $doctor_phone = $_GET['doctor_phone'];
      }
    }

    if (isset($_GET['doctor_phone_emergency'])) {
      if (empty($_GET['doctor_phone_emergency'])) {
        $errors['show-missing'] = 'alert alert-danger';
        $errors['phone_emergency'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else if (!preg_match('/^0[1-9]([-. ]?[0-9]{2}){4}$/', $_GET['doctor_phone_emergency'])) {
        $errors['show-wrong'] = 'alert alert-danger';
        $errors['phone_emergency'] = $missing;
        $errors['wrong'] = 'Format incorrect';
      } else {
        $doctor_phone_emergency = $_GET['doctor_phone_emergency'];
      }
    }

    if (isset($_GET['doctor_adress'])) {
      if (empty($_GET['doctor_adress'])) {
        $errors['show'] = 'alert alert-danger';
        $errors['adress'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else {
        $doctor_adress = $_GET['doctor_adress'];
      }
    }

    if (isset($_GET['specialty_id'])) {
      if (empty($_GET['specialty_id'])) {
        $errors['show'] = 'alert alert-danger';
        $errors['specialty'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else {
        $specialty_id = $_GET['specialty_id'];
      }
    }

    if (isset($_GET['doctor_photo'])) {
      if (empty($_GET['doctor_photo'])) {
        $doctor_photo = $doc['doctor_photo'];
      } else {
        $doctor_photo = $_GET['doctor_photo'];
      }
    }

    if (isset($_FILES['doctor_photo']) && $_FILES['doctor_photo']['error'] == 0) {
      if ($_FILES['doctor_photo']['size'] <= 1000000) {
        $infosfichier = pathinfo($_FILES['doctor_photo']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'png');
        if (in_array($extension_upload, $extensions_autorisees)) {
          move_uploaded_file($_FILES['doctor_photo']['tmp_name'], '../Uploads/' . basename($_FILES['doctor_photo']['name']));
        }
      }
    }

    if (empty($errors)) {
      $errors['show'] = 'alert alert-success';
      $errors['message'] = 'Modification réussie';
      $doc = new Doctor();
      $doc->updateDoctor($doctor_id, $doctor_lastname, $doctor_firstname, $doctor_phone, $doctor_phone_emergency, $doctor_mail, $doctor_adress, $doctor_photo, $specialty_id);
    } else {
      $errors['show'] = 'alert alert-danger';
      $errors['message'] = 'Echec de la modification : ';
    }
     
    }
  
  // Supression du docteur
  if (isset($_GET['delete'])) {
    $doc = new Doctor();
    $doc = $doc->getDoctorById($_GET['delete']);
    if ($doc == null) {
      header('Location:controller-doctor.php');
    } else {
      $doc = new Doctor();
      $doc->deleteDoctor($_GET['delete']);
      header('Location:controller-doctor.php');
    }
  }
}





include('../Views/view-doctor.php');
