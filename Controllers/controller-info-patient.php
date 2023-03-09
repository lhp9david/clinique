<?php

require_once('../Models/patient.php');
require_once('../config/env.php');
require_once('../helpers/Database.php');

session_start();

// initialisation méthode GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {

  // Update des informations
  if (isset($_GET['patient'])) {

    $patient = new patient();
    $patient = $patient->ConsultPatientInfo($_GET['patient']);
    
    // création des variables d'info
    $patient_id = $patient['patient_id'];
    $patient_lastname = $patient['patient_lastname'];
    $patient_firstname = $patient['patient_firstname'];
    $patient_birthdate = date('d/m/Y', strtotime($patient['patient_birthdate']));
    $patient_secu = $patient['patient_secu'];
    $patient_mail = $patient['patient_mail'];
    $patient_phone = $patient['patient_phone'];
    $patient_adress = $patient['patient_adress'];
    $patient_photo = $patient['patient_photo'];

  }
}


include('../Views/view-info-patient.php');