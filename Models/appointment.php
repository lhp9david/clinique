<?php
// créer une class Doctor avec les attributs : doctor_id, doctor_lastname, doctor_firstname, doctor_phone, doctor_phone_emergency, doctor_mail, doctor_adress, doctor_photo, doctor_password, specialty_id
class Appointement
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
        $query = $this->_pdo->prepare('SELECT * FROM cl_appointment');
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
        $query = $this->_pdo->prepare('SELECT * FROM cl_appointment WHERE appointment_id = :appointment_id');
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

    public function ModifyAppointmentInfo($appointment_id, $appointment_date, $appointment_hour, $appointment_reason, $appointment_status, $appointment_patient, $appointment_doctor): void
    {
        $query = $this->_pdo->prepare('UPDATE cl_appointment SET appointment_date = :appointment_date, appointment_hour = :appointment_hour, appointment_reason = :appointment_reason, appointment_status = :appointment_status, appointment_patient = :appointment_patient, appointment_doctor = :appointment_doctor WHERE appointment_id = :appointment_id');
        $query->execute([
            ':appointment_id' => $appointment_id,
            ':appointment_date' => $this->$appointment_date,
            ':appointment_hour' => $this->$appointment_hour,
            ':appointment_reason' => $this->$appointment_reason,
            ':appointment_status' => $this->$appointment_status,
            ':appointment_patient' => $this->$appointment_patient,
            ':appointment_doctor' => $this->$appointment_doctor,
        ]);
    }

    /**
     * methode pour supprimez les informations d'un rendez-vous
     *
     * @return array
     */

    public function DeleteAppointment($appointment_id): void
    {
        $query = $this->_pdo->prepare('DELETE FROM cl_appointment WHERE appointment_id = :appointment_id');
        $query->execute([
            ':appointment_id' => $appointment_id,
        ]);
    }
}
