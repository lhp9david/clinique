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
    $doctor = $doc->getDoctorInfoById($_GET['doctor']);
    
    // création des variables d'info
    $doctor_id = $doctor['doctor_id'];
    $doctor_lastname = $doctor['doctor_lastname'];
    $doctor_firstname = $doctor['doctor_firstname'];
    $doctor_specialty =  $doc->getSpecialtyName($doctor['specialty_id']);
    $doctor_mail = $doctor['doctor_mail'];
    $doctor_phone = $doctor['doctor_phone'];
    $doctor_phone_emergency = $doctor['doctor_phone_emergency'];
    $doctor_adress = $doctor['doctor_adress'];
    $doctor_photo = $doctor['doctor_photo'];

  }
}

  




include('../Views/view-info-doctor.php');