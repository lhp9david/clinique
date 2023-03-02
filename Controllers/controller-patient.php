<?php

// session_start();

require_once '../config/env.php';
require_once '../helpers/Database.php';
require_once '../models/patient.php';



$obj_patient = new Patient();

$errors_patient = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newPatient']) ) {
   

    if (isset($_POST['patient_lastname'])) {

        if (empty($_POST['patient_lastname'])) {

            $errors_patient['patient_lastname'] = "Le nom du patient est obligatoire";

        }
        else if (!preg_match('/^[a-zA-ZéèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -]+$/', $_POST['patient_lastname'])) {

            $errors_patient['patient_lastname'] = "Le nom du patient doit contenir uniquement des lettres";

        }

        if (empty($_POST['patient_firstname'])) {

            $errors_patient['patient_firstname'] = "Le prénom du patient est obligatoire";

        }
        else if (!preg_match('/^[a-zA-ZéèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -]+$/', $_POST['patient_firstname'])) {

            $errors_patient['patient_firstname'] = "Le prénom du patient doit contenir uniquement des lettres";

        }
    }

    if (isset($_POST['patient_phone'])) {

        if (empty($_POST['patient_phone'])) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient est obligatoire";

        }
        else if (strlen($_POST['patient_phone']) != 10) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient doit contenir 10 caractères";

        }
        else if (!preg_match('/^[0-9]{10}$/', $_POST['patient_phone'])) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient doit contenir uniquement des chiffres";

        }
        else if ($obj_patient->checkPhone($_POST['patient_phone']) === true) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient est déjà utilisé";

        }
    }

    if (isset($_POST['patient_secu'])) {

        if (empty($_POST['patient_secu'])) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient est obligatoire";

        }
        else if (strlen($_POST['patient_secu']) != 15) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient doit contenir 15 caractères";

        }
        else if (!preg_match('/^[0-9]{15}$/', $_POST['patient_secu'])) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient doit contenir uniquement des chiffres";

        }
        else if ($obj_patient->checkSecu($_POST['patient_secu']) === true) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient est déjà utilisé";

        }
    }

    if (isset($_POST['patient_mail'])) {

        if (empty($_POST['patient_mail'])) {

            $errors_patient['patient_mail'] = "L'adresse mail du patient est obligatoire";

        }
        else if (!filter_var($_POST['patient_mail'], FILTER_VALIDATE_EMAIL)) {

            $errors['patient_mail'] = "L'adresse mail du patient est incorrecte";

        }
        else if ($obj_patient->checkMail($_POST['patient_mail']) === true) {

            $errors_patient['patient_mail'] = "L'adresse mail du patient est déjà utilisée";

        }
    }

    if (isset($_POST['patient_adress'])) {

        if (empty($_POST['patient_adress'])) {

            $errors_patient['patient_adress'] = "L'adresse du patient est obligatoire";

        }
        else if (!preg_match('/^[a-zA-Z0-9éèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -]+$/', $_POST['patient_adress'])) {

            $errors_patient['patient_adress'] = "L'adresse du patient doit contenir uniquement des lettres et des chiffres";

        }
    }

        // **********************************************************
        

    if (!isset($_FILES["patient_photo"])) {
        $errors['patient_adress'] = "Aucune photo n'a été sélectionnée.";
    }
    
    $filepath = $_FILES['patient_photo']['tmp_name'];
    $fileSize = filesize($filepath);
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    $filetype = finfo_file($fileinfo, $filepath);
    
    if ($fileSize === 0) {
        $errors_patient['patient_photo'] = "Ce ficher est vide.";
    }
    
    if ($fileSize > 3145728) { // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
        $errors_patient['patient_photo'] = "Ce ficher est trop volumineux.";
    }
    
    $allowedTypes = [
        'image/png' => 'png',
        'image/jpeg' => 'jpg'
    ];
    
    if (!in_array($filetype, array_keys($allowedTypes))) {
        $errors_patient['patient_photo'] = "Type d'image non autorisé.";
    }
    
    $filename = basename($filepath); // I'm using the original name here, but you can also change the name of the file here
    $extension = $allowedTypes[$filetype];
    $targetDirectory = __DIR__ . "/../uploads"; // __DIR__ is the directory of the current PHP file
    
    $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;
    
    if (!copy($filepath, $newFilepath)) { // Copy the file, returns false if failed
        $errors_patient['patient_photo'] = "La copie de l'image a échouée.";
    }
    unlink($filepath); // Delete the temp file

    if (empty($errors_patient)) {

    $patient_lastname = $_POST['patient_lastname'];
    $patient_firstname = $_POST['patient_firstname'];
    $patient_secu = $_POST['patient_secu'];
    $patient_mail = $_POST['patient_mail'];
    $patient_phone = $_POST['patient_phone'];
    $patient_adress = $_POST['patient_adress'];
    $patient_photo = $filename . "." . $extension;

    $obj_patient->addNewPatient($patient_lastname, $patient_firstname, $patient_secu, $patient_mail, $patient_phone, $patient_adress, $patient_photo);

    }
}






?>
