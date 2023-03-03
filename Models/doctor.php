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
     * methode pour créer un nouveau docteur
     * 
     */

    public function CreateDoctor()
    {



        $query = $this->_pdo->prepare('INSERT INTO cl_doctors (doctor_lastname, doctor_firstname, doctor_phone, doctor_phone_emergency, doctor_mail, doctor_adress, doctor_photo, doctor_password, specialty_id) VALUES (:doctor_lastname, :doctor_firstname, :doctor_phone, :doctor_phone_emergency, :doctor_mail, :doctor_adress, :doctor_photo, :doctor_password, :specialty_id)');
        $query->execute([
            ':doctor_lastname' => $this->doctor_lastname,
            ':doctor_firstname' => $this->doctor_firstname,
            ':doctor_phone' => $this->doctor_phone,
            ':doctor_phone_emergency' => $this->doctor_phone_emergency,
            ':doctor_mail' => $this->doctor_mail,
            ':doctor_adress' => $this->doctor_adress,
            ':doctor_photo' => $this->doctor_photo,
            ':doctor_password' => $this->doctor_password,
            ':specialty_id' => $this->specialty_id,
        ]);


    }

    /**
     * methode pour afficher la liste des docteurs
     * 
     * @return array
     */

    public function displayDoctorList(): array
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_doctors');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // méthode pour se connecter
    public function login()
    {
        // requête pour vérifier si le mail et le mot de passe correspondent
        $query = "SELECT * FROM `cl_doctors` WHERE `doctor_mail` = :doctor_mail AND `doctor_password` = :doctor_password";
        // préparer la requête
        $result = $this->_pdo->prepare($query);
        // assigner les valeurs aux marqueurs nominatifs
        $result->bindValue(':doctor_mail', $this->doctor_mail, PDO::PARAM_STR);
        $result->bindValue(':doctor_password', $this->doctor_password, PDO::PARAM_STR);
        // exécuter la requête
        $result->execute();
        // vérifier si la requête a retourné un résultat
        if ($result->rowCount() > 0) {
            // assigner les données de la requête à des variables
            $data = $result->fetch(PDO::FETCH_OBJ);
            // assigner les données de la requête aux attributs de l'objet
            $this->doctor_id = $data->doctor_id;
            $this->doctor_lastname = $data->doctor_lastname;
            $this->doctor_firstname = $data->doctor_firstname;
            $this->doctor_phone = $data->doctor_phone;
            $this->doctor_phone_emergency = $data->doctor_phone_emergency;
            $this->doctor_mail = $data->doctor_mail;
            $this->doctor_adress = $data->doctor_adress;
            $this->doctor_photo = $data->doctor_photo;
            $this->doctor_password = $data->doctor_password;
            $this->specialty_id = $data->specialty_id;
            // retourner true
            return true;
        } else {
            // retourner false
            return false;
        }
    }

    // méthode pour récupérer les docteurs
    public function getDoctors()
    {
        $query = "SELECT * FROM `cl_doctors`";
        $result = $this->_pdo->prepare($query);
        $result->execute();
        $doctors = $result->fetchAll(PDO::FETCH_ASSOC);
        return $doctors;
    }

    // méthode pour supprimer un docteur
    public function deleteDoctor($doctor_id)
    {
        $query = $this->_pdo->prepare('DELETE FROM cl_doctors WHERE doctor_id = :doctor_id');
        $query->execute([
            ':doctor_id' => $doctor_id,
        ]);
    }

    // méthode pour modifier les informations d'un docteur
    public function updateDoctor($doctor_id, $doctor_lastname, $doctor_firstname, $doctor_phone, $doctor_phone_emergency, $doctor_mail, $doctor_adress, $doctor_photo, $specialty_id)
    {
        $query = $this->_pdo->prepare('UPDATE cl_doctors SET doctor_lastname = :doctor_lastname, doctor_firstname = :doctor_firstname, doctor_phone = :doctor_phone, doctor_phone_emergency = :doctor_phone_emergency, doctor_mail = :doctor_mail, doctor_adress = :doctor_adress, doctor_photo = :doctor_photo, specialty_id = :specialty_id WHERE doctor_id = '.$doctor_id.'');
        $query->execute([
            ':doctor_lastname' => $doctor_lastname,
            ':doctor_firstname' => $doctor_firstname,
            ':doctor_phone' => $doctor_phone,
            ':doctor_phone_emergency' => $doctor_phone_emergency,
            ':doctor_mail' => $doctor_mail,
            ':doctor_adress' => $doctor_adress,
            ':doctor_photo' => $doctor_photo,
            ':specialty_id' => $specialty_id
        ]);
    }

    // méthode pour afficher un docteur (id)
    public function getDoctorById($doctor_id)
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_doctors WHERE doctor_id = :doctor_id');
        $query->execute([
            ':doctor_id' => $doctor_id,
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // afficher tous les noms des docteurs
    public function getDoctorLastname()
    {
        $query = $this->_pdo->prepare('SELECT doctor_lastname FROM cl_doctors');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

// créer une class Secretary
class Secretary
{
    private int $secretary_id;
    private string $secretary_login;
    private string $secretary_password;

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

    // méthode pour se connecter
    public function login()
    {
        // requête pour vérifier si le login et le mot de passe correspondent
        $query = "SELECT * FROM `cl_secretary` WHERE `secretary_login` = :secretary_login AND `secretary_password` = :secretary_password";
        $result = $this->_pdo->prepare($query);
        // assigner les valeurs aux marqueurs nominatifs
        $result->bindValue(':secretary_login', $this->secretary_login, PDO::PARAM_STR);
        $result->bindValue(':secretary_password', $this->secretary_password, PDO::PARAM_STR);
        // exécuter la requête
        $result->execute();
        // vérifier si la requête a retourné un résultat
        if ($result->rowCount() > 0) {
            // assigner les données de la requête à des variables
            $data = $result->fetch(PDO::FETCH_OBJ);
            // assigner les données de la requête aux attributs de l'objet
            $this->secretary_id = $data->secretary_id;
            $this->secretary_login = $data->secretary_login;
            $this->secretary_password = $data->secretary_password;
            // retourner true
            return true;
        } else {
            // retourner false
            return false;
        }
    }







}
