<?php

class Patient
{

    private object $_pdo;

    // créer un constructeur pour instancier la connexion
    public function __construct()
    {
        $this->_pdo = Database::connect();
    }

    /**
     * methode pour créer un patient
     *
     * @return void
     */
    public function addNewPatient($patient_lastname, $patient_firstname, $patient_birthdate, $patient_secu, $patient_mail, $patient_phone, $patient_adress, $patient_photo): void
    {
        $query = $this->_pdo->prepare('INSERT INTO cl_patients (patient_lastname, patient_firstname, patient_birthdate, patient_secu, patient_mail, patient_phone, patient_adress, patient_photo) VALUE (:patient_lastname, :patient_firstname, :patient_birthdate, :patient_secu, :patient_mail, :patient_phone, :patient_adress, :patient_photo)');
        $query->execute([
            ':patient_lastname' => $patient_lastname,
            ':patient_firstname' => $patient_firstname,
            ':patient_birthdate' => $patient_birthdate,
            ':patient_secu' => $patient_secu,
            ':patient_mail' => $patient_mail,
            ':patient_phone' => $patient_phone,
            ':patient_adress' => $patient_adress,
            ':patient_photo' => $patient_photo,
        ]);
    }

    /**
     * methode pour chercher un patient par son numéro de sécurité sociale
     *
     * @return array
     */
    public function SearchPatientListBySSNumber($SSNumber): array
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_patients WHERE patient_secu = :patient_secu');
        $query->execute([
            ':patient_secu' => $SSNumber,
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * methode pour chercher un patient par sa date de naissance
     *
     * @return array
     */
    public function SearchPatientListByBdate($Bdate): array
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_patients WHERE patient_birthdate = :patient_birthdate');
        $query->execute([
            ':patient_birthdate' => $Bdate,
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * methode pour afficher la liste des patients
     *
     * @return array
     */
    public function DisplayPatientList(): array
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_patients');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * methode pour consulter les informations d'un patient
     *
     * @return array
     */

    public function ConsultPatientInfo($patient_id): array
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_patients WHERE patient_id = :patient_id');
        $query->execute([
            ':patient_id' => $patient_id,
        ]);
        $patient = $query->fetch(PDO::FETCH_ASSOC);
        return $patient;
    }

    /**
     * methode pour modifier les informations d'un patient
     *
     * @return void
     */
    public function ModifyPatientInfo($patient_id, $patient_lastname, $patient_firstname, $patient_birthdate, $patient_secu, $patient_mail, $patient_phone, $patient_adress, $patient_photo): void
    {
        $query = $this->_pdo->prepare('UPDATE cl_patients SET patient_id = :patient_id, patient_lastname = :patient_lastname, patient_firstname = :patient_firstname, patient_birthdate = :patient_birthdate, patient_secu = :patient_secu, patient_mail = :patient_mail, patient_phone = :patient_phone, patient_adress = :patient_adress, patient_photo = :patient_photo WHERE patient_id = :patient_id');
        $query->execute([
            ':patient_id' => $patient_id,
            ':patient_lastname' => $patient_lastname,
            ':patient_firstname' => $patient_firstname,
            ':patient_birthdate' => $patient_birthdate,
            ':patient_secu' => $patient_secu,
            ':patient_mail' => $patient_mail,
            ':patient_phone' => $patient_phone,
            ':patient_adress' => $patient_adress,
            ':patient_photo' => $patient_photo,
        ]);
    }

    /**
     * methode pour supprimer un patient
     *
     * @return void
     */
    public function DeletePatient($patient_id): void
    {
        $query = $this->_pdo->prepare('DELETE FROM cl_patients WHERE patient_id = :patient_id');
        $query->execute([
            ':patient_id' => $patient_id,
        ]);
    }

    /**
     * methode pour vérifier les doublon de numéros de SS
     *
     * @return bool
     */

    public function checkSecu($SSNumber): bool
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_patients WHERE patient_secu = :patient_secu');
        $query->execute([
            ':patient_secu' => $SSNumber,
        ]);
        return $query->fetch(PDO::FETCH_COLUMN);
    }

    /**
     * methode pour vérifier les doublon de numéros de SS
     *   
     * @return bool
     */

    public function checkMail($patient_mail): bool
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_patients WHERE patient_mail = :patient_mail');
        $query->execute([
            ':patient_mail' => $patient_mail,
        ]);
        return $query->fetch(PDO::FETCH_COLUMN);
    }

    /**
     * methode pour vérifier les doublon de numéros de téléphone
     *
     * @return bool
     */

    public function checkPhone($patient_phone): bool
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_patients WHERE patient_phone = :patient_phone');
        $query->execute([
            ':patient_phone' => $patient_phone,
        ]);
        return $query->fetch(PDO::FETCH_COLUMN);
    }

    /**
     * methode pour récuperer une photo
     *
     * @return array
     */

    public function GetPhotoName(int $patient_id): array
    {
        $query = $this->_pdo->prepare('SELECT patient_photo FROM cl_patients WHERE patient_id = :patient_id');
        $query->execute([
            ':patient_id' => $patient_id,
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * methode pour vérifier si un patient a déjà un rendez-vous
     *
     * @return array
     */

    public function checkIfPatientHasAppointment($patient_id, $appointment_date, $appointment_hour) 
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_appointments WHERE patient_id = :patient_id AND appointment_date = :appointment_date AND appointment_hour = :appointment_hour');
        $query->execute([
            ':patient_id' => $patient_id,
            ':appointment_date' => $appointment_date,
            ':appointment_hour' => $appointment_hour
        ]);
        $patient = $query->fetch(PDO::FETCH_ASSOC);
        return $patient;
    }
}
