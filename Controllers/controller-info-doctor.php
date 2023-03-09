<?php
require_once('../Models/doctor.php');
require_once('../config/env.php');
require_once('../helpers/Database.php');

session_start();

// initialisation méthode GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {

  // Update des informations
  if (isset($_GET['doctor'])) {

    $doc = new Doctor();
    $doctor = $doc->getDoctorById($_GET['doctor']);
    
    // création des variables d'info
    $doctor_lastname = $doctor[0]['doctor_lastname'];
    $doctor_firstname = $doctor[0]['doctor_firstname'];
    $doctor_specialty =  $doc->getSpecialtyName($doctor[0]['specialty_id']);
    $doctor_mail = $doctor[0]['doctor_mail'];
    $doctor_phone = $doctor[0]['doctor_phone'];
    $doctor_phone_emergency = $doctor[0]['doctor_phone_emergency'];
    $doctor_adress = $doctor[0]['doctor_adress'];
    $doctor_photo = $doctor[0]['doctor_photo'];

  }
}

  




include('../Views/view-info-doctor.php');