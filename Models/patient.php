<?php

class Patient
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
     * methode pour créer un patient
     *
     * @return void
     */
    public function addNewPatient($patient_lastname, $patient_firstname, $patient_secu, $patient_mail, $patient_phone, $patient_adress, $patient_photo): void
    {
        $query = $this->_pdo->prepare('INSERT INTO cl_patients (patient_lastname, patient_firstname, patient_secu, patient_mail, patient_phone, patient_adress, patient_photo) VALUE (:patient_lastname, :patient_firstname, :patient_secu, :patient_mail, :patient_photo, :patient_adress, :patient_photo)');
        $query->execute([
            ':patient_lastname' => $patient_lastname,
            ':patient_firstname' => $patient_firstname,
            ':patient_secu' => $patient_secu,
            ':patient_mail' => $patient_mail,
            ':patient_phone' => $patient_phone,
            ':patient_adress' => $patient_adress,
            ':patient_photo' => $patient_photo,
        ]);
    }

    /**
     * methode pour chercher un patient
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
     * @return array
     */
    public function ModifyPatientInfo($patient_id, $patient_lastname, $patient_firstname, $patient_secu, $patient_mail, $patient_adress, $patient_photo): void
    {
        $query = $this->_pdo->prepare('UPDATE cl_patients SET patient_lastname = :patient_lastname, patient_firstname = :patient_firstname, patient_secu = :patient_secu, patient_mail = :patient_mail, patient_adress = :patient_adress, patient_photo = :patient_photo WHERE patient_id = :patient_id');
        $query->execute([
            ':patient_id' => $patient_id,
            ':patient_lastname' => $this->$patient_lastname,
            ':patient_firstname' => $this->$patient_firstname,
            ':patient_secu' => $this->$patient_secu,
            ':patient_mail' => $this->$patient_mail,
            ':patient_adress' => $this->$patient_adress,
            ':patient_photo' => $this->$patient_photo,
        ]);
    }

    /**
     * methode pour supprimer un patient
     *
     * @return array
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
}
