<?php

require('../Models/doctor.php');
require('../Models/secretary.php');
require('../helpers/Database.php');
require('../config/env.php');


session_start();


// Gère la déconnexion
if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    session_unset();
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
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];

        // verifier la key 
        $secretKey = "6Le8Y-gkAAAAAPtwRPyXPTZ5KgxgQpf_BKzskY6O";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
        // should return JSON with success as true
        if (!$responseKeys["success"]) {
            $errorsArray['captcha'] = 'vous êtes un robot';
        }
    }
    if (!$captcha) {
        $errorsArray['captcha'] = 'veuillez cocher la case';
    }

    echo 'capcha passée';

    var_dump(Secretary::checkLogin(trim($_POST["login"])));
    if (!Secretary::checkLogin(trim($_POST["login"]))) {
        $errorsArray['error'] =  $wrong;
    }
    else if (!Doctor::checkMail(trim($_POST["login"]))) {
        $errorsArray['error'] =  $wrong;
    }

    // Vérifier si le tableau d'erreurs est vide
    if (empty($errorsArray)) {
        // Vérifier si l'utilisateur est un docteur
        if (Doctor::checkMail(trim($_POST["login"])) !== false) {
            $doctor = Doctor::checkMail(trim($_POST["login"]));
            var_dump($doctor);
            // Vérifier si le mot de passe est correct
            if (password_verify(trim($_POST["password"]), $doctor["doctor_password"])) {

                // Créer une session pour le docteur
                $_SESSION["doctor_id"] = $doctor["doctor_id"];
                $_SESSION["doctor_lastname"] = $doctor["doctor_lastname"];
                $_SESSION["doctor_firstname"] = $doctor["doctor_firstname"];
                $_SESSION["doctor_mail"] = $doctor["doctor_mail"];
                $_SESSION["doctor_phone"] = $doctor["doctor_phone"];
                $_SESSION["doctor_phone_emergency"] = $doctor["doctor_phone_emergency"];
                $_SESSION["speciality_id"] = $doctor["speciality_id"];
                $_SESSION["doctor_adress"] = $doctor["doctor_adress"];
                $_SESSION["doctor_photo"] = $doctor["doctor_photo"];
                $_SESSION["doctor_password"] = $doctor["doctor_password"];

                // Rediriger vers la page d'accueil
                header("location: controller-doctor-appointments.php?doctor=" . $doctor_id);
                exit;
            } else {
                $errorsArray['error'] = $wrong;
            }
        } else if (Secretary::checkMail(trim($_POST["login"]))) {
            // Vérifier si le mot de passe est correct
            if (Secretary::checkPassword(trim($_POST["password"]))) {
                // Récupérer l'ID de la secrétaire
                $secretary_id = Secretary::getSecretaryId(trim($_POST["login"]));

                // Créer une session pour la secrétaire
                $_SESSION["secretary_id"] = $secretary_id;

                // Rediriger vers la page d'accueil
                header("location: controller-secretary.php");
                exit;
            } else {
                $errorsArray['error'] = $wrong;
            }
        }
    }

 




}






















include('../Views/view-login.php');
