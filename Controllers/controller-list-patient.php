<?php

session_start();

require_once '../config/env.php';
require_once '../helpers/Database.php';
require_once '../models/patient.php';

// Check if the user is logged in
// if (!isset($_SESSION['user'])) {
//     header('Location: controller-login.php');
// }

$obj_patient = new Patient();

$obj_patient->DisplayPatientList();


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['delete'])) {
        $obj_patient->DeletePatient($_GET['delete']);
        header('Location: controller-list-patient.php');
    }
}

$errors_patient = [];

if (($_SERVER['REQUEST_METHOD'] === 'GET') && (isset($_GET['SSNumber']))) {
    $patients = $obj_patient->SearchPatientListBySSNumber($_GET['SSNumber']);
    if (empty($patients)) {
        $errors_patient['patient_secu'] = "Le numéro de sécurité sociale n'existe pas";
    }
} else {
    $patients = $obj_patient->DisplayPatientList();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['patient_lastname'])) {

        if (empty($_POST['patient_lastname'])) {

            $errors_patient['patient_lastname'] = "Le nom du patient est obligatoire";
        } else if (!preg_match('/^[a-zA-ZéèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -]+$/', $_POST['patient_lastname'])) {

            $errors_patient['patient_lastname'] = "Le nom du patient doit contenir uniquement des lettres";
        }

        if (empty($_POST['patient_firstname'])) {

            $errors_patient['patient_firstname'] = "Le prénom du patient est obligatoire";
        } else if (!preg_match('/^[a-zA-ZéèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -]+$/', $_POST['patient_firstname'])) {

            $errors_patient['patient_firstname'] = "Le prénom du patient doit contenir uniquement des lettres";
        }
    }

    if (isset($_POST['patient_phone'])) {

        if (empty($_POST['patient_phone'])) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient est obligatoire";
        } else if (strlen($_POST['patient_phone']) != 10) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient doit contenir 10 caractères";
        } else if (!preg_match('/^[0-9]{10}$/', $_POST['patient_phone'])) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient doit contenir uniquement des chiffres";
        }
    }

    if (isset($_POST['patient_secu'])) {

        if (empty($_POST['patient_secu'])) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient est obligatoire";
        } else if (strlen($_POST['patient_secu']) != 15) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient doit contenir 15 caractères";
        } else if (!preg_match('/^[0-9]{15}$/', $_POST['patient_secu'])) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient doit contenir uniquement des chiffres";
        }
    }

    if (isset($_POST['patient_mail'])) {

        if (empty($_POST['patient_mail'])) {

            $errors_patient['patient_mail'] = "L'adresse mail du patient est obligatoire";
        } else if (!filter_var($_POST['patient_mail'], FILTER_VALIDATE_EMAIL)) {

            $errors_patient['patient_mail'] = "L'adresse mail du patient est incorrecte";
        }

        if (isset($_POST['patient_adress'])) {

            if (empty($_POST['patient_adress'])) {

                $errors_patient['patient_adress'] = "L'adresse du patient est obligatoire";
            } else if (!preg_match('/^[a-zA-Z0-9éèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -,]+$/', $_POST['patient_adress'])) {

                $errors_patient['patient_adress'] = "L'adresse du patient doit contenir uniquement des lettres et des chiffres";
            }
        }

        // **********************************************************


        if (!isset($_FILES["patient_photo"]) || $_FILES["patient_photo"]["error"] != 0) {
            die("There is no file to upload.");
        }
        
        $filepath = $_FILES['patient_photo']['tmp_name'];
        $fileSize = filesize($filepath);
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);
        
        if ($fileSize === 0) {
            die("The file is empty.");
        }
        
        if ($fileSize > 3145728) { // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
            die("The file is too large");
        }
        
        $allowedTypes = [
           'image/png' => 'png',
           'image/jpeg' => 'jpg'
        ];
        
        if (!in_array($filetype, array_keys($allowedTypes))) {
            die("File not allowed.");
        }
        
        $filename = basename($filepath); // I'm using the original name here, but you can also change the name of the file here
        $extension = $allowedTypes[$filetype];
        $targetDirectory = __DIR__ . "/../uploads"; // __DIR__ is the directory of the current PHP file
        
        $newFilepath = $targetDirectory . "/" . $_FILES['patient_photo']['name'];
        
        if (!copy($filepath, $newFilepath)) { // Copy the file, returns false if failed
            die("Can't move file.");
        }
        unlink($filepath); // Delete the temp file
        
        echo "File uploaded successfully :)";

        if (empty($errors_patient)) {

            $patient_id = $_POST['patient_id'];
            $patient_lastname = $_POST['patient_lastname'];
            $patient_firstname = $_POST['patient_firstname'];
            $patient_birthdate = $_POST['patient_birthdate'];
            $patient_secu = $_POST['patient_secu'];
            $patient_mail = $_POST['patient_mail'];
            $patient_phone = $_POST['patient_phone'];
            $patient_adress = $_POST['patient_adress'];
            if (isset($_FILES["patient_photo"]) && $_FILES["patient_photo"]['error'] = 0) {
                $patient_photo = $_FILES["patient_photo"]['error'];
                // recupèrer l'ancienne photo du patient et la supprimer du dossier uploads
                if ($obj_patient->GetPhotoName($patient_photo) != ' ') {
                    unlink(__DIR__ . "/../uploads/" . $obj_patient->GetPhotoName($patient_photo));
                }
            } else {
                $patient_photo = ' ';
            }

            $obj_patient->ModifyPatientInfo($patient_id, $patient_lastname, $patient_firstname, $patient_birthdate, $patient_secu, $patient_mail, $patient_phone, $patient_adress, $patient_photo);

            echo 'Le patient a bien été modifié';
        }
    }
}

require '../views/view-list-patient.php';
