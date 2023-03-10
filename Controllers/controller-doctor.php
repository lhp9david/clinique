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

// méthode POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {


  // Update des informations
  if (isset($_POST['doctor_id'])) {

    $doc = new Doctor();
    $doc = $doc->getDoctorById($_POST['doctor_id']);
    $doctor_id = $doc['doctor_id'];

    // vérification que le "formulaire" est valide
    $errors = [];
    $wrong = '<i class="bi bi-x-circle-fill text-danger"></i>';
    $missing = '<i class="bi bi-exclamation-circle-fill text-danger"></i>';

    if (isset($_POST['doctor_lastname'])) {
      if (empty($_POST['doctor_lastname'])) {
        $errors['show-missing'] = 'alert alert-danger';
        $errors['name'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['doctor_lastname'])) {
        $errors['show-wrong'] = 'alert alert-danger';
        $errors['name'] = $wrong;
        $errors['message'] = 'Format incorrect';
      } else {
        $doctor_lastname = $_POST['doctor_lastname'];
      }
    }

    if (isset($_POST['doctor_firstname'])) {
      if (empty($_POST['doctor_firstname'])) {
        $errors['show-missing'] = 'alert alert-danger';
        $errors['name'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['doctor_firstname'])) {
        $errors['show-wrong'] = 'alert alert-danger';
        $errors['name'] = $wrong;
        $errors['wrong'] = 'Format incorrect';
      } else {
        $doctor_firstname = $_POST['doctor_firstname'];
      }
    }

    if (isset($_POST['doctor_mail'])) {

      if (empty($_POST['doctor_mail'])) {
        $errors['show-missing'] = 'alert alert-danger';
        $errors['mail'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $_POST['doctor_mail'])) {
        $errors['show-wrong'] = 'alert alert-danger';
        $errors['mail'] = $wrong;
        $errors['wrong'] = 'Format incorrect';
      } else {
        $doctor_mail = $_POST['doctor_mail'];
      }
    }

    if (isset($_POST['doctor_phone'])) {
      if (empty($_POST['doctor_phone'])) {
        $errors['show-missing'] = 'alert alert-danger';
        $errors['phone'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else if (!preg_match('/^0[1-9]([-. ]?[0-9]{2}){4}$/', $_POST['doctor_phone'])) {
        $errors['show-wrong'] = 'alert alert-danger';
        $errors['phone'] = $wrong;
        $errors['wrong'] = 'Format incorrect';
      } else {
        $doctor_phone = $_POST['doctor_phone'];
      }
    }

    if (isset($_POST['doctor_phone_emergency'])) {
      if (empty($_POST['doctor_phone_emergency'])) {
        $errors['show-missing'] = 'alert alert-danger';
        $errors['phone_emergency'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else if (!preg_match('/^0[1-9]([-. ]?[0-9]{2}){4}$/', $_POST['doctor_phone_emergency'])) {
        $errors['show-wrong'] = 'alert alert-danger';
        $errors['phone_emergency'] = $missing;
        $errors['wrong'] = 'Format incorrect';
      } else {
        $doctor_phone_emergency = $_POST['doctor_phone_emergency'];
      }
    }

    if (isset($_POST['doctor_adress'])) {
      if (empty($_POST['doctor_adress'])) {
        $errors['show'] = 'alert alert-danger';
        $errors['adress'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else {
        $doctor_adress = $_POST['doctor_adress'];
      }
    }

    if (isset($_POST['specialty_id'])) {
      if (empty($_POST['specialty_id'])) {
        $errors['show'] = 'alert alert-danger';
        $errors['specialty'] = $missing;
        $errors['missing'] = "Champs obligatoire";
      } else {
        $specialty_id = $_POST['specialty_id'];
      }
    }

    
    if (isset($_FILES['doctor_photo'])) {
      $doctor_photo = $_FILES['doctor_photo']['name'];

      if ($_FILES['doctor_photo']['size'] <= 1000000) {
       
        $infosfichier = pathinfo($_FILES['doctor_photo']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'png');
        if (in_array($extension_upload, $extensions_autorisees)) {
          
          move_uploaded_file($_FILES['doctor_photo']['tmp_name'], '../Uploads/' . basename($_FILES['doctor_photo']['name']));
          if ($doc['doctor_photo']) {
            $doctor_photo_path = '../Uploads/' . $doc['doctor_photo'];
            if (file_exists($doctor_photo_path)) {
              unlink($doctor_photo_path);
            }
          }
        }
      }
    } else {
      $doctor_photo = $doc['doctor_photo'];
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

// Pagination
$DoctorList = new Doctor();
$DoctorList = $DoctorList->GetDoctors(); // On récupère la liste des rendez-vous pour vérifier si elle est vide ou non, et afficher dans la vue un message d'erreur si elle l'est

$max = 2; // Nombre de rendez-vous par page
$nbDoctors = count($DoctorList); // Nombre total de rendez-vous
$nbPage = ceil($nbDoctors / $max); // Nombre de pages

// Pour chaque page, on ajoute les deux rendez-vous dans un tableau correspondant à la page
for ($i = 1; $i <= $nbPage; $i++) {
    $DoctorList[$i] = array_slice($DoctorList, ($i - 1) * $max, $max);
}

$page = 1; // Page par défaut
foreach ($DoctorList as $doctorPage) { // Pour chaque page de rendez-vous
    $page++;
}
function getDoctorsofpage($page, $DoctorList) // Retourne la liste des rendez-vous d'une page
{
    return $DoctorList[$page];
}


if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) { // Si la page est passée en paramètre et qu'elle est comprise entre 1 et le nombre de pages
    $page = $_GET['page']; // On récupère la pages
    $doctorsOfThisPage = getDoctorsofpage($page, $DoctorList); // On récupère la liste des rendez-vous de la page
    $doctorsArray = getDoctorInfos($doctorsOfThisPage); // On récupère les informations des rendez-vous de la page
} else { // Sinon
    $page = 1; // On affiche la page 1
    $doctorsOfThisPage = getDoctorsofpage($page, $DoctorList); // On récupère la liste des rendez-vous de la page
    $doctorsArray = getDoctorInfos($doctorsOfThisPage); // On récupère les informations des rendez-vous de la page
}

function getDoctorInfos($doctorsOfThisPage)
{
    $doctorsArray = array(); // Création d'un tableau pour stocker les rendez-vous

    foreach ($doctorsOfThisPage as $doctor) { // Pour chaque rendez-vous

        $doc = new Doctor(); // Création d'un objet patient
        $doc = $doc->getDoctorById($doctor['doctor_id']); // On récupère les informations du patient correspondant au rendez-vous

        $doctorSpecialty = new Doctor(); // Création d'un objet doctor
        $doctorSpecialty = $doctorSpecialty->getSpecialtyNameByDoctorId($doctor['doctor_id']); // Récupère la spécialité du médecin par rapport à son id        
        // On ajoute les informations du rendez-vous dans le tableau
        $doctorsArray[] = array(
            'doctor_id' => $doctor['doctor_id'],
            'doctor_lastname' => $doctor['doctor_lastname'],
            'doctor_firstname' => $doctor['doctor_firstname'],
            'doctor_phone' => $doctor['doctor_phone'],
            'doctor_phone_emergency' => $doctor['doctor_phone_emergency'],
            'doctor_mail' => $doctor['doctor_mail'],
            'doctor_adress' => $doctor['doctor_adress'],
            'doctor_photo' => $doctor['doctor_photo'],
            'specialty_id' => $doctor['specialty_id'],
            'specialty_name' => $doctorSpecialty,
          
            
        );
    }
    return $doctorsArray;
}







include('../Views/view-doctor.php');
