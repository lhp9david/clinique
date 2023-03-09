<?php

require('../Models/doctor.php');
require('../helpers/Database.php');
require('../config/env.php');

session_start();


// Gère la déconnexion
if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    var_dump($_SESSION);
    session_destroy();
    header("location: controller-login.php");
    exit;
}




    


// Si l'utilisateur est déjà connecté et est un docteur, rediriger vers la page d'accueil
if (isset($_SESSION["doctor_id"])) {
    header("location: controller-doctor-appointments.php?doctor=" . $_SESSION["doctor_id"]);
    exit;
} elseif (isset($_SESSION["secretary_id"])) { // Sinon si l'utilisateur est déjà connecté et est une secrétaire, rediriger vers la page d'accueil
    header("location: controller-secretary.php");
    exit;
}


if(isset($_GET['logout'])){

    session_destroy();
    header('Location: ../index.php');
}

// Initialiser les variables d'erreur
$wrong = '<i class="bi bi-x-circle-fill text-danger"></i>';
$missing = '<i class="bi bi-exclamation-circle-fill text-danger"></i>';
// verifier le captcha

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Créer un tableau vide d'erreurs
    $errorsArray = [];
    
    // Vérifier si les champs sont vides
    if (empty(trim($_POST["login"])) || empty(trim($_POST["password"]))) {
        $errorsArray['error'] = $missing;
    } else {
        // Assigner les données du formulaire à des variables
        $login = trim($_POST["login"]);
        $password = trim($_POST["password"]);
    }

    // Vérifier si le captcha est vide
    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
      }
      if(!$captcha){
        header('Location: ../index.php');
        exit;
      }

      // verifier la key 
      $secretKey = "6Le8Y-gkAAAAAPtwRPyXPTZ5KgxgQpf_BKzskY6O";
      $ip = $_SERVER['REMOTE_ADDR'];
      // post request to server
      $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
      $response = file_get_contents($url);
      $responseKeys = json_decode($response,true);
      // should return JSON with success as true
      if($responseKeys["success"]) {
      } 

    // Vérifier si le tableau d'erreurs est vide
    if (empty($errorsArray)) {

        // Créer un objet doctor
        $doctor = new Doctor();
        $doctor->doctor_mail = $login;
        $doctor->doctor_password = $password;
        // Appeler la méthode login de l'objet doctor
        $doctor->login();

        // Créer un objet secretary
        $secretary = new Secretary();
        $secretary->secretary_login = $login;
        $secretary->secretary_password = $password;
        // Appeler la méthode login de l'objet secretary
        $secretary->login();

        // Vérifier si la méthode login a retourné un résultat
        if ($doctor->login()) {
            // Assigner les données de la méthode login à des variables
            $id = $doctor->doctor_id;
            $lastname = $doctor->doctor_lastname;
            $firstname = $doctor->doctor_firstname;
            $phone = $doctor->doctor_phone;
            $phone_emergency = $doctor->doctor_phone_emergency;
            $mail = $doctor->doctor_mail;
            $adress = $doctor->doctor_adress;
            $photo = $doctor->doctor_photo;
            $specialty_id = $doctor->specialty_id;
            // Créer une session
            session_start();
            // Assigner les variables à des variables de session
            $_SESSION["doctor_id"] = $id;
            $_SESSION["doctor_lastname"] = $lastname;
            $_SESSION["doctor_firstname"] = $firstname;
            $_SESSION["doctor_phone"] = $phone;
            $_SESSION["doctor_phone_emergency"] = $phone_emergency;
            $_SESSION["doctor_mail"] = $mail;
            $_SESSION["doctor_adress"] = $adress;
            $_SESSION["doctor_photo"] = $photo;
            $_SESSION["doctor_specialty_id"] = $specialty_id;


            // Rediriger vers la page d'accueil
            header("location: controller-doctor-appointments.php?doctor=$id");
            echo "Bonjour $firstname $lastname.";
        } else if ($secretary->login()) {
            // Assigner les données de la méthode login à des variables
            $id = $secretary->secretary_id;
            $login = $secretary->secretary_login;
            // Créer une session
            session_start();
            // Assigner les variables à des variables de session
            $_SESSION["secretary_id"] = $id;
            $_SESSION["secretary_login"] = $login;
            // Rediriger vers la page d'accueil

            header("location: controller-secretary.php");
        } else {
            // Assigner une erreur à la variable wrong
            $errorsArray['error'] = $wrong;
        }
    }
}






















include('../Views/view-login.php');
