<?php
require_once('../Models/doctor.php');
require_once('../config/env.php');
require_once('../helpers/Database.php');
require_once('../Models/patient.php');
require_once('../Models/appointment.php');

class Appointments
{
    public static function GetAppointmentList(): array
    {
        $appointment = new Appointment();
        return $appointment->DisplayAppointmentList();
    }

    public static function displayAllAppointments()
    {
        $appointmentList = self::GetAppointmentList();
        foreach ($appointmentList as $appointment) {
            $patient = new Patient();
            $patient = $patient->ConsultPatientInfo($appointment['patient_id']);
            echo '<tr>';
            echo '<td>' . $patient[0]['patient_firstname'] . '</td>';
            echo '<td>' . $patient[0]['patient_lastname'] . '</td>';
            echo '<td> ' .$appointment['appointment_date'] . ' </td>';
            echo '<td>' . $appointment['appointment_hour'] . '</td>';
            echo '<td>' . $patient[0]['patient_phone'] . '</td>';
            echo '<td>' . $patient[0]['patient_secu'] . '</td>';
            echo '</tr>';
        }
    }
}



include('../Views/view-doctor-appointments.php');
