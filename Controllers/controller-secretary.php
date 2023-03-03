<?php
$errors = [];
    // Initialisation du tableau d'erreurs
 
    $errors_patient = [];
require_once '../helpers/Database.php';
require_once '../Models/appointment.php';
require_once '../config/env.php';
require_once '../Models/doctor.php';
require_once '../Models/patient.php';

session_start();


class NewAppointment
{

    public static function verifyPost()
    {
        $errors_appointment = [];

        // Vérification de la date
        if (!empty($_POST['date'])) {
            $date = $_POST['date'];
            // Vérification du format de la date
            if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
                $errors_appointment[] = "Le format de la date n'est pas valide.";
            }
        } else {
            $errors_appointment['date'] = "La date est manquante.";
        }

        // Vérification de l'heure
        if (!empty($_POST['hour'])) {
            $hour = $_POST['hour'];
            // Vérification du format de l'heure
            if (!preg_match("/^\d{2}:\d{2}$/", $hour)) {
                $errors_appointment[] = "Le format de l'heure n'est pas valide.";
            }
        } else {
            $errors_appointment['hour'] = "L'heure est manquante.";
        }

        // Vérification de l'identifiant du patient
        if (!empty($_POST['patient'])) {
            $patientId = $_POST['patient'];
        } else {
            $errors_appointment['patient'] = "L'identifiant du patient est manquant.";
        }

        // Vérification de l'identifiant du médecin
        if (!empty($_POST['doctor'])) {
            $doctorId = $_POST['doctor'];
        } else {
            $errors_appointment['doctor'] = "L'identifiant du médecin est manquant.";
        }

        // Vérification de la description
        if (!empty($_POST['description'])) {
            $description = $_POST['description'];
        } else {
            $errors_appointment['description'] = "La description est manquante.";
        }


        // Si le tableau d'erreurs est vide, créer le rendez-vous
        if (empty($errors_appointment)) {
            $newAppointment = new NewAppointment();
            $newAppointment::createAppointment($date, $hour, $patientId, $doctorId, $description);
        }
        return $errors_appointment;
    }
    public static function createAppointment($date, $hour, $patientId, $doctorId, $description)
    {
        $appointment = new Appointment();
        $appointment->createAppointment($date, $hour, $patientId, $doctorId, $description);
    }
}
// Utilisation de la fonction verifyPost() pour vérifier si le formulaire a été soumis
if (isset($_POST['newAppointmentSubmit'])) {
    $errors_appointment = NewAppointment::verifyPost();

}

function getDoctors() // Retourne la liste des médecins
{
    $doctors = new Doctor;
    $doctors = $doctors->getDoctors();
    return $doctors;
}

function displayDoctors() // Affiche la liste des médecins dans un select
{
    $doctors = getDoctors();
    echo '<option selected disabled>Choisir un médecin</option>';
    foreach ($doctors as $doctor) {
        echo '<option value="' . $doctor['doctor_id'] . '">' . $doctor['doctor_lastname'] . ' ' . $doctor['doctor_firstname'] . '</option>';
    }
}

function getPatients() // Retourne la liste des patients
{
    $patients = new Patient;
    $patients = $patients->DisplayPatientList();
    return $patients;
}

function displayPatients() // Affiche la liste des patients dans un select
{
    $patients = getPatients();
    echo '<option selected disabled>Choisir un patient</option>';
    foreach ($patients as $patient) {
        echo '<option value="' . $patient['patient_id'] . '">' . $patient['patient_lastname'] . ' ' . $patient['patient_firstname'] . '</option>';
    }
}


// CONTROLLER POUR LES NOUVEAUX DOCTEURS



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitNewDoctor'])) {
   
    if (isset($_POST['doctor_lastname'])) {
        if (empty($_POST['doctor_lastname'])) {
            $errors['lastname'] = 'champ obligatoire';
        } else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['doctor_lastname'])) {
            $errors['lastname'] = 'Veuillez respecter le format';
        }
    }

    if (isset($_POST['doctor_firstname'])) {
        if (empty($_POST['doctor_firstname'])) {
            $errors['firstname'] = 'champ obligatoire';
        } else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['doctor_firstname'])) {
            $errors['firstname'] = 'Veuillez respecter le format';
        }
    }

    if (isset($_POST['doctor_mail'])) {

        if (empty($_POST['doctor_mail'])) {
            $errors['mail'] = 'champ obligatoire';
        } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $_POST['doctor_mail'])) {
            $errors['mail'] = 'Veuillez respecter le format';
        }
    }

    if (isset($_POST['doctor_phone'])) {
        if (empty($_POST['doctor_phone'])) {
            $errors['phone'] = 'champ obligatoire';
        } else if (!preg_match('/^0[1-9]([-. ]?[0-9]{2}){4}$/', $_POST['doctor_phone'])) {
            $errors['phone'] = 'Veuillez respecter le format';
        }
    }

    if (isset($_POST['doctor_phone_emergency'])) {
        if (empty($_POST['doctor_phone_emergency'])) {
            $errors['phone_emergency'] = 'champ obligatoire';
        } else if (!preg_match('/^0[1-9]([-. ]?[0-9]{2}){4}$/', $_POST['doctor_phone_emergency'])) {
            $errors['phone_emergency'] = 'Veuillez respecter le format';
        }
    }
    if (isset($_POST['doctor_adress'])) {
        if (empty($_POST['doctor_adress'])) {
            $errors['adress'] = 'champ obligatoire';
        }
    }

    if (isset($_POST['doctor_password'])) {
        if (empty($_POST['doctor_password'])) {
            $errors['password'] = 'champ obligatoire';
        } else if (!preg_match('/^.{8,}$/', $_POST['doctor_password'])) {
            $errors['password'] = '8 caractères minimum';
        } else {
            $password = $_POST['doctor_password'];
        }
    }

    if (isset($_POST['confirmPass'])) {

        if (empty($_POST['confirmPass'])) {
            $errors['confirmPass'] = 'champ obligatoire';
        } else if (!preg_match('/^.{8,}$/', $_POST['confirmPass'])) {
            $errors['password'] = 'Veuillez respecter le format';
        }
    }

    if (isset($_POST['specialty_id'])) {
        if (empty($_POST['specialty_id'])) {
            $errors['specialty'] = 'champ obligatoire';
        }
    }

    if (empty($errors)) {
        $obj_doc = new Doctor();

        $obj_doc->doctor_lastname = $_POST['doctor_lastname'];
        $obj_doc->doctor_firstname = $_POST['doctor_firstname'];
        $obj_doc->doctor_phone = $_POST['doctor_phone'];
        $obj_doc->doctor_phone_emergency = $_POST['doctor_phone_emergency'];
        $obj_doc->doctor_mail = $_POST['doctor_mail'];
        $obj_doc->doctor_adress = $_POST['doctor_adress'];
        $obj_doc->doctor_photo = $_POST['doctor_photo'];
        $obj_doc->doctor_password = password_hash($_POST['doctor_password'], PASSWORD_DEFAULT);
        $obj_doc->specialty_id = $_POST['specialty_id'];
        $obj_doc->CreateDoctor();
    }
}

// *************************************************************************************
// CONTROLLER POUR LES NOUVEAUX PATIENTS

$obj_patient = new Patient();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newPatient'])) {


    if (isset($_POST['patient_lastname'])) {

        if (empty($_POST['patient_lastname'])) {

            $errors_patient['patient_lastname'] = "Le nom du patient est obligatoire";
        } else if (!preg_match('/^[a-zA-ZéèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -]+$/', $_POST['patient_lastname'])) {

            $errors_patient['patient_lastname'] = "Le nom du patient doit contenir uniquement des lettres";
        }

        if (empty($_POST['patient_firstname'])) {

            $errors_patient['patient_firstname'] = "Le prénom du patient est obligatoire";
        } else if (!preg_match('/^[a-zA-ZéèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -]+$/', $_POST['patient_firstname'])) {

            $errors_patient['patient_firstname'] = "Le prénom du patient doit contenir uniquement des lettres";
        }
    }

    if (isset($_POST['patient_phone'])) {

        if (empty($_POST['patient_phone'])) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient est obligatoire";
        } else if (strlen($_POST['patient_phone']) != 10) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient doit contenir 10 caractères";
        } else if (!preg_match('/^[0-9]{10}$/', $_POST['patient_phone'])) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient doit contenir uniquement des chiffres";
        } else if ($obj_patient->checkPhone($_POST['patient_phone']) === true) {

            $errors_patient['patient_phone'] = "Le numéro de téléphone du patient est déjà utilisé";
        }
    }

    if (isset($_POST['patient_secu'])) {

        if (empty($_POST['patient_secu'])) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient est obligatoire";
        } else if (strlen($_POST['patient_secu']) != 15) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient doit contenir 15 caractères";
        } else if (!preg_match('/^[0-9]{15}$/', $_POST['patient_secu'])) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient doit contenir uniquement des chiffres";
        } else if ($obj_patient->checkSecu($_POST['patient_secu']) === true) {

            $errors_patient['patient_secu'] = "Le numéro de sécurité sociale du patient est déjà utilisé";
        }
    }

    if (isset($_POST['patient_mail'])) {

        if (empty($_POST['patient_mail'])) {

            $errors_patient['patient_mail'] = "L'adresse mail du patient est obligatoire";
        } else if (!filter_var($_POST['patient_mail'], FILTER_VALIDATE_EMAIL)) {

            $errors_patient['patient_mail'] = "L'adresse mail du patient est incorrecte";
        } else if ($obj_patient->checkMail($_POST['patient_mail']) === true) {

            $errors_patient['patient_mail'] = "L'adresse mail du patient est déjà utilisée";
        }
    }

    if (isset($_POST['patient_adress'])) {

        if (empty($_POST['patient_adress'])) {

            $errors_patient['patient_adress'] = "L'adresse du patient est obligatoire";
        } else if (!preg_match('/^[a-zA-Z0-9éèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -]+$/', $_POST['patient_adress'])) {

            $errors_patient['patient_adress'] = "L'adresse du patient doit contenir uniquement des lettres et des chiffres";
        }
    }

    // **********************************************************


    if ($_FILES["patient_photo"]['error'] = 0) {

        $filepath = $_FILES['patient_photo']['tmp_name'];
        $fileSize = filesize($filepath);
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);

        if ($fileSize === 0) {
            $errors_patient['patient_adress'] = "Ce ficher est vide.";
        }

        if ($fileSize > 3145728) { // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
            $errors_patient['patient_adress'] = "Ce ficher est trop volumineux.";
        }

        $allowedTypes = [
            'image/png' => 'png',
            'image/jpeg' => 'jpg'
        ];

        if (!in_array($filetype, array_keys($allowedTypes))) {
            $errors_patient['patient_adress'] = "Type d'image non autorisé.";
        }

        $filename = basename($filepath); // I'm using the original name here, but you can also change the name of the file here
        $extension = $allowedTypes[$filetype];
        $targetDirectory = __DIR__ . "/../uploads"; // __DIR__ is the directory of the current PHP file

        $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;

        if (!copy($filepath, $newFilepath)) { // Copy the file, returns false if failed
            $errors_patient['patient_adress'] = "La copie de l'image a échouée.";
        }
        unlink($filepath); // Delete the temp file
    }

    echo json_encode($errors_patient);

    if (empty($errors_patient)) {
        if (empty($errors_patient)) {

            $patient_lastname = $_POST['patient_lastname'];
            $patient_firstname = $_POST['patient_firstname'];
            $patient_birthdate = $_POST['patient_birthdate'];
            $patient_secu = $_POST['patient_secu'];
            $patient_mail = $_POST['patient_mail'];
            $patient_phone = $_POST['patient_phone'];
            $patient_adress = $_POST['patient_adress'];
            if (isset($_FILES["patient_photo"]) && $_FILES["patient_photo"]['error'] = 0) {
                $patient_photo = $filename . "." . $extension;
                // recupèrer l'ancienne photo du patient et la supprimer du dossier uploads
                if ($obj_patient->GetPhotoName($patient_photo) != ' ') {
                    unlink(__DIR__ . "/../uploads/" . $obj_patient->GetPhotoName($patient_photo));
                }
            } else {
                $patient_photo = ' ';
            }

            $obj_patient->addNewPatient($patient_lastname, $patient_firstname, $patient_birthdate, $patient_secu, $patient_mail, $patient_phone, $patient_adress, $patient_photo);

            echo 'Le patient a bien été ajouté !';
        }
    }
}



include '../views/view-secretary.php';
