<?php
// créer une class Doctor 
class Doctor
{
    private $doctor_id;
    private $doctor_lastname;
    private $doctor_firstname;
    private $doctor_phone;
    private $doctor_phone_emergency;
    private $doctor_mail;
    private $doctor_adress;
    private $doctor_photo;
    private $doctor_password;
    private $specialty_id;

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

}