<?php
require_once '../helpers/Database.php';
require_once '../Models/appointment.php';
require_once '../config/env.php';
require_once '../Models/doctor.php';
require_once '../Models/patient.php';

session_start();

class NewAppointment
{
    public static function verifyPost()
    {
        if (!empty($_POST['date']) && !empty($_POST['hour']) && !empty($_POST['patient']) && !empty($_POST['doctor']) && !empty($_POST['description'])) {
            $date = $_POST['date'];
            $hour = $_POST['hour'];
            $patientId = $_POST['patient'];
            $doctorId = $_POST['doctor'];
            $description = $_POST['description'];
            $newAppointment = new NewAppointment();
            $newAppointment::createAppointment($date, $hour, $patientId, $doctorId, $description);
        } else {
            echo 'Veuillez remplir tous les champs';
        }
    }
    public static function createAppointment($date, $hour, $patientId, $doctorId, $description)
    {
        $appointment = new Appointment();
        $appointment->createAppointment($date, $hour, $patientId, $doctorId, $description);
    }
}
// Utilisation de la fonction verifyPost() pour vérifier si le formulaire a été soumis
if (isset($_POST['newAppointmentSubmit'])) {
    NewAppointment::verifyPost();
}

function getDoctors() // Retourne la liste des médecins
{
    $doctors = new Doctor;
    $doctors = $doctors->getDoctors();
    return $doctors;
}

function displayDoctors() // Affiche la liste des médecins dans un select
{
    $doctors = getDoctors();
    echo '<option selected disabled>Choisir un médecin</option>';
    foreach ($doctors as $doctor) {
        echo '<option value="' . $doctor['doctor_id'] . '">' . $doctor['doctor_lastname'] . ' ' . $doctor['doctor_firstname'] . '</option>';
    }
}

function getPatients() // Retourne la liste des patients
{
    $patients = new Patient;
    $patients = $patients->DisplayPatientList();
    return $patients;
}

function displayPatients() // Affiche la liste des patients dans un select
{
    $patients = getPatients();
    echo '<option selected disabled>Choisir un patient</option>';
    foreach ($patients as $patient) {
        echo '<option value="' . $patient['patient_id'] . '">' . $patient['patient_lastname'] . ' ' . $patient['patient_firstname'] . '</option>';
    }
}


include '../views/view-secretary.php';
