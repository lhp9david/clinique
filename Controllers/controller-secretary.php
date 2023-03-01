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
        if (isset($_POST['newAppointmentSubmit'])) {
            $social = $_POST['social'];
            $date = $_POST['date'];
            $hour = $_POST['hour'];
            $patientId = $_POST['patientId'];
            $doctorId = $_POST['doctorId'];
            $description = $_POST['description'];
            $appointment = new newAppointment();
            $appointment->createAppointment($date, $hour, $patientId, $doctorId, $description);
        }
    }
    public static function createAppointment($date, $hour, $patientId, $doctorId, $description)
    {
    }
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
    foreach ($doctors as $doctor) {
        echo '<option value="' . $doctor['doctor_id'] . '">' . $doctor['doctor_lastname'] . ' ' . $doctor['doctor_firstname'] . '</option>';
    }
}

function getPatients() // Retourne la liste des patients
{
    $patients = new Patients;
    $patients = $patients->DisplayPatientList();
    return $patients;
}

function displayPatients() // Affiche la liste des patients dans un select
{
    $patients = getPatients();
    foreach ($patients as $patient) {
        echo '<option value="' . $patient['patient_id'] . '">' . $patient['patient_lastname'] . ' ' . $patient['patient_firstname'] . '</option>';
    }
}


include '../views/view-secretary.php';
