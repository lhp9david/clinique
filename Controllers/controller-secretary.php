<?php
session_start();


// Initialisation du tableau d'erreurs
$errors = [];
$errors_patient = [];
$success = [];

// require
require_once '../helpers/Database.php';
require_once '../Models/appointment.php';
require_once '../config/env.php';
require_once '../Models/doctor.php';
require_once '../Models/patient.php';



class NewAppointment
{

    public static function verifyPost()
    {
        $errors_appointment = [];
        // Initialiser les variables d'erreur
        $wrong = '<i class="bi bi-x-circle-fill text-danger"></i>';
        $missing = '<i class="bi bi-exclamation-circle-fill text-danger"></i>';

        // Vérification de la date
        if (!empty($_POST['date'])) {
            $date = $_POST['date'];
            // Vérification du format de la date
            if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
                $errors_appointment['date'] = $wrong;
            }
        } else {
            $errors_appointment['date'] = $missing;
        }

        // Vérification de l'heure
        if (!empty($_POST['hour'])) {
            $hour = $_POST['hour'];
            // Vérification du format de l'heure
            if (!preg_match("/^\d{2}:\d{2}$/", $hour)) {
                $errors_appointment['hour'] = $wrong;
            }
        } else {
            $errors_appointment['hour'] = $missing;
        }

        // Vérification de l'identifiant du patient
        if (!empty($_POST['patient'])) {
            $patientId = $_POST['patient'];
        } else {
            $errors_appointment['patient'] = $missing;
        }

        // Vérification de l'identifiant du médecin
        if (!empty($_POST['doctor'])) {
            $doctorId = $_POST['doctor'];
        } else {
            $errors_appointment['doctor'] = $missing;
        }

        // Vérification de la description
        if (!empty($_POST['description'])) {
            $description = $_POST['description'];
        } else {
            $errors_appointment['description'] = $missing;
        }


        // Si le tableau d'erreurs est vide, on vérifie que le patient et le médecin existent, et que le patient n'a pas déjà un rendez-vous à cette date et à cette heure
        if (empty($errors_appointment)) {
            // Vérification de l'existence du patient
            $patient = new Patient();
            $patient = $patient->ConsultPatientInfo($patientId);
            if (empty($patient)) {
                $errors_appointment['patient'] = $missing;
            } else {
                // On vérifie si le patient n'a pas déjà un rendez-vous à cette date et à cette heure
                $patient = new Patient();
                $patient = $patient->checkIfPatientHasAppointment($patientId, $date, $hour);
                if (!empty($patient)) {
                    $errors_appointment['show'] = "alert alert-danger";
                    $errors_appointment['error'] = "Le patient a déjà un rendez-vous à cette date et à cette heure.";
                }
            } // On vérifie si le médecin n'a pas déjà un rendez-vous à cette date et à cette heure
            $doctor = new Doctor();
            $doctor = $doctor->checkIfDoctorHasAppointment($doctorId, $date, $hour);
            if (!empty($doctor)) {
                $errors_appointment['error'] = "Le médecin a déjà un rendez-vous à cette date et à cette heure.";
            } else if (empty($errors_appointment)) {
                // Si le tableau d'erreurs est vide, on crée le rendez-vous
                NewAppointment::createAppointment($date, $hour, $patientId, $doctorId, $description);
            }
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
    if (empty($errors_appointment)) {
        $success['appointment'] = "Nouvelle consultation créée avec succès";
        $success['show'] = "alert alert-success";
    }
}

function getDoctors() // Retourne la liste des médecins
{
    $doctors = new Doctor;
    $doctors = $doctors->getDoctors();
    return $doctors;
}

function displayDoctors() // Affiche la liste des médecins dans un select, avec la valeur sélectionnée si le formulaire a été soumis
{
    $doctors = getDoctors();
    echo '<option selected disabled>Choisir un médecin</option>';
    foreach ($doctors as $doctor) {
        echo '<option ' . (isset($_POST['doctor']) && $_POST['doctor'] == $doctor['doctor_id'] ? 'selected' : '') . ' value="' . $doctor['doctor_id'] . '">' . $doctor['doctor_lastname'] . ' ' . $doctor['doctor_firstname'] . '</option>';
    }
}

function getPatients() // Retourne la liste des patients
{
    $patients = new Patient;
    $patients = $patients->DisplayPatientList();
    return $patients;
}

function displayPatients() // Affiche la liste des patients dans un select, avec la valeur sélectionnée si le formulaire a été soumis
{
    $patients = getPatients();
    echo '<option selected disabled>Choisir un patient</option>';
    foreach ($patients as $patient) {
        echo '<option ' . (isset($_POST['patient']) && $_POST['patient'] == $patient['patient_id'] ? 'selected' : '') . ' value="' . $patient['patient_id'] . '">' . $patient['patient_lastname'] . ' ' . $patient['patient_firstname'] . '</option>';
    }
}


// CONTROLLER POUR LES NOUVEAUX DOCTEURS
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitNewDoctor'])) {
    // Initialiser les variables d'erreur
    $wrong = '<i class="bi bi-x-circle-fill text-danger"></i>';
    $missing = '<i class="bi bi-exclamation-circle-fill text-danger"></i>';

    if (isset($_POST['doctor_lastname'])) {
        if (empty($_POST['doctor_lastname'])) {
            $errors['name'] = $missing;
        } else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['doctor_lastname'])) {
            $errors['name'] = $wrong;
            $errors['show'] = 'alert alert-danger';
            $errors['message'] = 'Format incorrect';
        }
    }

    if (isset($_POST['doctor_firstname'])) {
        if (empty($_POST['doctor_firstname'])) {
            $errors['name'] = $missing;
        } else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['doctor_firstname'])) {
            $errors['name'] = $wrong;
            $errors['show'] = 'alert alert-danger';
            $errors['message'] = 'Format incorrect';
        }
    }

    if (isset($_POST['doctor_mail'])) {

        if (empty($_POST['doctor_mail'])) {
            $errors['mail'] = $missing;
        } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $_POST['doctor_mail'])) {
            $errors['mail'] = $wrong;
            $errors['show'] = 'alert alert-danger';
            $errors['message'] = 'Format incorrect';
        }
    }

    if (isset($_POST['doctor_phone'])) {
        if (empty($_POST['doctor_phone'])) {
            $errors['phone'] = $missing;
        } else if (!preg_match('/^0[1-9]([-. ]?[0-9]{2}){4}$/', $_POST['doctor_phone'])) {
            $errors['phone'] = $wrong;
            $errors['show'] = 'alert alert-danger';
            $errors['message'] = 'Format incorrect';
        }
    }

    if (isset($_POST['doctor_phone_emergency'])) {
        if (empty($_POST['doctor_phone_emergency'])) {
            $errors['phone_emergency'] = $missing;
        } else if (!preg_match('/^0[1-9]([-. ]?[0-9]{2}){4}$/', $_POST['doctor_phone_emergency'])) {
            $errors['phone_emergency'] = $wrong;
            $errors['show'] = 'alert alert-danger';
            $errors['message'] = 'Format incorrect';
        }
    }
    if (isset($_POST['doctor_adress'])) {
        if (empty($_POST['doctor_adress'])) {
            $errors['adress'] = $missing;
        }
    }

    if (isset($_POST['doctor_password'])) {
        if (empty($_POST['doctor_password'])) {
            $errors['password'] = $missing;
        } else if (!preg_match('/^.{8,}$/', $_POST['doctor_password'])) {
            $errors['password'] = $wrong;
            $errors['show'] = 'alert alert-danger';
            $errors['message'] = 'le mot de passe doit faire 8 caractères minimum';
        } else {
            $password = $_POST['doctor_password'];
        }
    }

    if (isset($_POST['confirmPass'])) {

        if (empty($_POST['confirmPass'])) {
            $errors['confirmPass'] = $missing;
        } else if (!preg_match('/^.{8,}$/', $_POST['confirmPass'])) {
            $errors['confirmPass'] = $wrong;
            $errors['show'] = 'alert alert-danger';
            $errors['message'] = 'Le mot de passe n\'est pas identique';
        }
    }

    if (isset($_POST['specialty_id'])) {
        if (empty($_POST['specialty_id'])) {
            $errors['specialty'] = $missing;
        }
    }

    if (isset($_POST['doctor_photo'])) {
        if (empty($_POST['doctor_photo'])) {
            $errors['photo'] = $missing;
        }
    }
    if (isset($_FILES['doctor_photo']) && $_FILES['doctor_photo']['error'] == 0) {
        if ($_FILES['doctor_photo']['size'] <= 1000000) {
            $infosfichier = pathinfo($_FILES['doctor_photo']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'png');
            if (in_array($extension_upload, $extensions_autorisees)) {
                move_uploaded_file($_FILES['doctor_photo']['tmp_name'], '../Uploads/' . basename($_FILES['doctor_photo']['name']));
            }
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
        $obj_doc->doctor_photo = $_FILES['doctor_photo']['name'];
        $obj_doc->doctor_password = password_hash($_POST['doctor_password'], PASSWORD_DEFAULT);
        $obj_doc->specialty_id = $_POST['specialty_id'];
        $obj_doc->CreateDoctor();

        $success['show'] = "alert alert-success";
        $success['doctor'] = 'Nouveau docteur crée avec succès';
    }
}

// *************************************************************************************
// CONTROLLER POUR LES NOUVEAUX PATIENTS

$obj_patient = new Patient();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newPatient'])) {

    // Initialiser les variables d'erreur
    $wrong = '<i class="bi bi-x-circle-fill text-danger"></i>';
    $missing = '<i class="bi bi-exclamation-circle-fill text-danger"></i>';

    if (isset($_POST['patient_lastname'])) {

        if (empty($_POST['patient_lastname'])) {

            $errors_patient['patient_name'] = $missing;
        } else if (!preg_match('/^[a-zA-ZéèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -]+$/', $_POST['patient_lastname'])) {

            $errors_patient['patient_name'] = $wrong;
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient['message'] = "Format incorrect";
        }

        if (empty($_POST['patient_firstname'])) {

            $errors_patient['patient_name'] = $missing;
        } else if (!preg_match('/^[a-zA-ZéèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -]+$/', $_POST['patient_firstname'])) {

            $errors_patient['patient_name'] = $wrong; 
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient['message']= "Format incorrect";
        }
    }

    if (isset ($_POST['patient_birthdate'])) {
            
            if (empty($_POST['patient_birthdate'])) {
    
                $errors_patient['patient_birthdate'] = $missing;
            } else if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $_POST['patient_birthdate'])) {
    
                $errors_patient['patient_birthdate'] = $wrong;
                $errors_patient['show'] = 'alert alert-danger';
                $errors_patient['message'] = "Format incorrect";
            }
    }

    if (isset($_POST['patient_phone'])) {

        if (empty($_POST['patient_phone'])) {

            $errors_patient['patient_phone'] = $missing;
        } else if (strlen($_POST['patient_phone']) != 10) {

            $errors_patient['patient_phone'] = $wrong;
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient ['message'] = "Format incorrect";
        } else if (!preg_match('/^[0-9]{10}$/', $_POST['patient_phone'])) {

            $errors_patient['patient_phone'] = $wrong;
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient['message'] = "Format incorrect";
        } else if ($obj_patient->checkPhone($_POST['patient_phone']) === true) {

            $errors_patient['patient_phone'] = $wrong;
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient['message_phone'] = "Le numéro de téléphone du patient est déjà utilisé";
        }
    }

    if (isset($_POST['patient_secu'])) {

        if (empty($_POST['patient_secu'])) {

            $errors_patient['patient_secu'] = $missing;
        } else if (strlen($_POST['patient_secu']) != 15) {

            $errors_patient['patient_secu'] = $wrong;
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient['message'] = "Format incorrect";
        } else if (!preg_match('/^[0-9]{15}$/', $_POST['patient_secu'])) {

            $errors_patient['patient_secu'] = $wrong;
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient['message'] = "Format incorrect";
        } else if ($obj_patient->checkSecu($_POST['patient_secu']) === true) {

            $errors_patient['patient_secu'] = $wrong;
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient['message_secu'] = "Le numéro de sécurité sociale du patient est déjà utilisé";
        }
    }

    if (isset($_POST['patient_mail'])) {

        if (empty($_POST['patient_mail'])) {

            $errors_patient['patient_mail'] = $missing;
        } else if (!filter_var($_POST['patient_mail'], FILTER_VALIDATE_EMAIL)) {

            $errors_patient['patient_mail'] = $wrong;
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient['message'] = "Format incorrect";
        } else if ($obj_patient->checkMail($_POST['patient_mail']) === true) {

            $errors_patient['patient_mail'] = $wrong;
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient['message_mail'] = "L'adresse mail du patient est déjà utilisée";
        }
    }

    if (isset($_POST['patient_adress'])) {

        if (empty($_POST['patient_adress'])) {

            $errors_patient['patient_adress'] = $missing;
        } else if (!preg_match('/^[a-zA-Z0-9éèàêâùïüëöçÉÈÀÊÂÛÏÜËÖÇ -,]+$/', $_POST['patient_adress'])) {

            $errors_patient['patient_adress'] = $wrong;
            $errors_patient['show'] = 'alert alert-danger';
            $errors_patient['message'] = "Format incorrect";
        }
    }


  

    // **********************************************************
    // UPLOAD DE LA PHOTO DU PATIENT

    if ($_FILES["patient_photo"]["error"] == 0) {
        $filepath = $_FILES['patient_photo']['tmp_name'];
        $fileSize = filesize($filepath);
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);

        if ($fileSize === 0) {
            $errors_patient['patient_upload'] = "La photo est vide.";
        }

        if ($fileSize > 3145728) { // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
            $errors_patient['patient_upload'] = "La photo est trop volumineuse";
        }

        $allowedTypes = [
            'image/png' => 'png',
            'image/jpeg' => 'jpg'
        ];

        if (!in_array($filetype, array_keys($allowedTypes))) {
            $errors_patient['patient_upload'] = "Extension non valide.";
        }

        $filename = basename($filepath); // I'm using the original name here, but you can also change the name of the file here
        $extension = $allowedTypes[$filetype];
        $targetDirectory = __DIR__ . "/../uploads"; // __DIR__ is the directory of the current PHP file

        $newFilepath = $targetDirectory . "/" . $_FILES['patient_photo']['name'];

        if (!copy($filepath, $newFilepath)) { // Copy the file, returns false if failed
            $errors_patient['patient_upload'] = "La photo n'a pas pu être sauvegardée.";
        }
        unlink($filepath); // Delete the temp file


        echo "Upload réussi :)";
    }

    if (empty($errors_patient)) {

        $patient_lastname = $_POST['patient_lastname'];
        $patient_firstname = $_POST['patient_firstname'];
        $patient_birthdate = $_POST['patient_birthdate'];
        $patient_secu = $_POST['patient_secu'];
        $patient_mail = $_POST['patient_mail'];
        $patient_phone = $_POST['patient_phone'];
        $patient_adress = $_POST['patient_adress'];
        if ($_FILES['patient_photo']['error'] == 0) {
            $patient_photo = $_FILES['patient_photo']['name'];
        }
        else {
            $patient_photo = '';
        }

        $obj_patient->addNewPatient($patient_lastname, $patient_firstname, $patient_birthdate, $patient_secu, $patient_mail, $patient_phone, $patient_adress, $patient_photo);

        $success['show'] = "alert alert-success";
        $success['patient'] = 'Nouveau patient crée avec succès';
    }



}

include '../Views/view-secretary.php';
