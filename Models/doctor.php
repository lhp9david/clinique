<?php

class Doctor
{

    private object $_pdo;
    private int $doctor_id;
    private string $doctor_lastname;
    private string $doctor_firstname;
    private string $doctor_phone;
    private string $doctor_phone_emergency;
    private string $doctor_mail;
    private string $doctor_adress;
    private string $doctor_photo;
    private string $doctor_password;
    private int $specialty_id;

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
        $query = $this->_pdo->prepare('SELECT * FROM cl_doctors INNER JOIN cl_specialties ON cl_doctors.specialty_id = cl_specialties.specialty_id');
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

/**
 * methode pour vérifier si le mail existe déjà
 * 
 * @param string $doctor_mail mail du docteur
 * @return mixed array|false
 * 
 */
     
    public static function checkMail(string $doctor_mail) : mixed
    {
        $pdo = Database::connect();
        $query = "SELECT * FROM `cl_doctors` WHERE `doctor_mail` = :doctor_mail";
        $result = $pdo->prepare($query);
        $result->bindValue(':doctor_mail', $doctor_mail, PDO::PARAM_STR);
        if ($result->execute()) {
            if ($result->rowCount() > 0) {
                return $result->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }


    // méthode pour récupérer les docteurs
    public function getDoctors()
    {
        $query = "SELECT * FROM `cl_doctors` INNER JOIN cl_specialties ON cl_doctors.specialty_id = cl_specialties.specialty_id" ;
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
        $query = $this->_pdo->prepare('UPDATE cl_doctors SET doctor_lastname = :doctor_lastname, doctor_firstname = :doctor_firstname, doctor_phone = :doctor_phone, doctor_phone_emergency = :doctor_phone_emergency, doctor_mail = :doctor_mail, doctor_adress = :doctor_adress, doctor_photo = :doctor_photo, specialty_id = :specialty_id WHERE doctor_id = ' . $doctor_id . '');
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

     // méthode pour afficher un docteur (id)
     public function getDoctorInfoById($doctor_id)
     {
         $query = $this->_pdo->prepare('SELECT * FROM cl_doctors WHERE doctor_id = :doctor_id');
         $query->execute([
             ':doctor_id' => $doctor_id,
         ]);
         return $query->fetch(PDO::FETCH_ASSOC);
     }

    // afficher tous les noms des docteurs
    public function getDoctorLastname()
    {
        $query = $this->_pdo->prepare('SELECT doctor_lastname FROM cl_doctors');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



    public function checkIfDoctorHasAppointment($doctor_id, $appointment_date, $appointment_hour)
    {
        $query = $this->_pdo->prepare('SELECT * FROM cl_appointments WHERE doctor_id = :doctor_id AND appointment_date = :appointment_date AND appointment_hour = :appointment_hour');
        $query->execute([
            ':doctor_id' => $doctor_id,
            ':appointment_date' => $appointment_date,
            ':appointment_hour' => $appointment_hour
        ]);
        $doctor = $query->fetch(PDO::FETCH_ASSOC);
        return $doctor;
    }

    // methode afficher les spécialités
    public function getSpecialtyName($specialty_id)
    {
        switch ($specialty_id) {
            case 1:
                return 'Ophtalmologue';
                break;
            case 2:
                return 'Dermatologue';
                break;
            case 3:
                return 'Gynécologue';
                break;
            case 4:
                return 'Généraliste';
                break;
            default:
                return 'Spécialité inconnue';
                break;
        }
        
    }
        
    public function getSpecialtyNameByDoctorId($doctor_id)
    {
        $query = $this->_pdo->prepare('SELECT specialty_id FROM cl_doctors WHERE doctor_id = :doctor_id');
        $query->execute([
            ':doctor_id' => $doctor_id,
        ]);
        $specialty_id = $query->fetch(PDO::FETCH_ASSOC);
        return $this->getSpecialtyName($specialty_id['specialty_id']);
    }
}

