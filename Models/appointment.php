<?php
// créer une class Doctor avec les attributs : doctor_id, doctor_lastname, doctor_firstname, doctor_phone, doctor_phone_emergency, doctor_mail, doctor_adress, doctor_photo, doctor_password, specialty_id
class Appointment
{

    private object $_pdo;

    // méthode magique pour get les attributs
    public function __get($attribut)
    {
        return $this->$attribut;
    }

    // méthode magique pour set les attributs
    public function __set($attribut, $value)
    {
        $this->$attribut = $value;
    }

    // créer un constructeur pour instancier la connexion
    public function __construct()
    {
        $this->_pdo = Database::connect();
    }

    /**
     * methode pour afficher la liste des rendez-vous
     *
     * @return array
     */

    public function DisplayAppointmentList(): array
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_appointments');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * methode pour afficher la liste des rendez-vous
     *
     * @return array
     */

    public function DisplayAppointmentListByPatient($appointment_patient): array
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_appointment WHERE appointment_patient = :appointment_patient');
        $query->execute([
            ':appointment_patient' => $appointment_patient,
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * methode pour consulter les informations d'un rendez-vous
     *
     * @return array
     */

    public function ConsultAppointmentInfo($appointment_id): array
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_appointments WHERE appointment_id = :appointment_id');
        $query->execute([
            ':appointment_id' => $appointment_id,
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * methode pour modifier les informations d'un rendez-vous
     *
     * @return array
     */

    public function ModifyAppointment($appointment_id, $appointment_date, $appointment_hour, $appointment_description): void
    {
        $query = $this->_pdo->prepare('UPDATE cl_appointments SET appointment_date = :appointment_date, appointment_hour = :appointment_hour, appointment_description = :appointment_description WHERE appointment_id = :appointment_id');
        $query->execute([
            ':appointment_id' => $appointment_id,
            ':appointment_date' => $appointment_date,
            ':appointment_hour' => $appointment_hour,
            ':appointment_description' => $appointment_description
        ]);
    }

    /**
     * methode pour supprimez les informations d'un rendez-vous
     *
     * @return array
     */

    public function DeleteAppointment($appointment_id): void
    {
        // On vérifie si le rendez-vous existe
        $query = $this->_pdo->prepare('SELECT * FROM cl_appointments WHERE appointment_id = :appointment_id');
        $query->execute([
            ':appointment_id' => $appointment_id,
        ]);
        $appointment = $query->fetch(PDO::FETCH_ASSOC);
        if ($appointment) { // Si le rendez-vous existe, on le supprime
            $query = $this->_pdo->prepare('DELETE FROM cl_appointments WHERE appointment_id = :appointment_id');
            $query->execute([
                ':appointment_id' => $appointment_id,
            ]);
        }
    }

    public function createAppointment($appointment_date, $appointment_hour, $patient_id, $doctor_id, $appointment_description): void
    {
        $query = $this->_pdo->prepare('INSERT INTO cl_appointments (appointment_date, appointment_hour, appointment_description, patient_id, doctor_id) VALUES (:appointment_date, :appointment_hour, :appointment_description, :patient_id, :doctor_id)');
        $query->execute([
            ':appointment_date' => $appointment_date,
            ':appointment_hour' => $appointment_hour,
            ':appointment_description' => $appointment_description,
            ':patient_id' => $patient_id,
            ':doctor_id' => $doctor_id
        ]);
    }
    public function GetAppointmentListByDoctor($doctor_id): array
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_appointments WHERE doctor_id = :doctor_id');
        $query->execute([
            ':doctor_id' => $doctor_id,
        ]);
        $appointmentList = $query->fetchAll(PDO::FETCH_ASSOC);
        return $appointmentList;
    }

}
