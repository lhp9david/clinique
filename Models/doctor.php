<?php

class Doctor
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
     * methode pour créer un nouveau médecin
     *
     * @return array
     */

    public function AddNewDoctor($doctor_id, $doctor_lastname, $doctor_firstname, $doctor_speciality, $doctor_mail, $doctor_adress, $doctor_photo): void
    {
        $query = $this->_pdo->prepare('INSERT INTO cl_doctor (doctor_id, doctor_lastname, doctor_firstname, doctor_speciality, doctor_mail, doctor_adress, doctor_photo) VALUE (:doctor_id, :doctor_lastname, :doctor_firstname, :doctor_speciality, :doctor_mail, :doctor_adress, :doctor_photo)');
        $query->execute([
            ':doctor_id' => $doctor_id,
            ':doctor_lastname' => $this->$doctor_lastname,
            ':doctor_firstname' => $this->$doctor_firstname,
            ':doctor_speciality' => $this->$doctor_speciality,
            ':doctor_mail' => $this->$doctor_mail,
            ':doctor_adress' => $this->$doctor_adress,
            ':doctor_photo' => $this->$doctor_photo,
        ]);
    }

    /**
     * methode pour se connecter
     *
     * @return array
     */

     //???

}
