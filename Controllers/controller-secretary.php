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





include '../views/secretary.php';