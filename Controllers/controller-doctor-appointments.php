<?php
require_once('../Models/doctor.php');
require_once('../config/env.php');
require_once('../helpers/Database.php');
require_once('../Models/patient.php');
require_once('../Models/appointment.php');


class Appointments
{
    public static function GetAppointmentList(): array // Récupère la liste des rendez-vous
    {
        $appointment = new Appointment();
        return $appointment->DisplayAppointmentList(); // Fais appel au model Appointment.php pour récupérer la liste des rendez-vous
    }

    public static function displayAllAppointments() // Affiche la liste des rendez-vous
    {
        if (isset($_GET['doctor'])) { // Si le médecin est passé en paramètre, on affiche les rendez-vous du médecin
            $appointmentList = new Appointment();
            $appointmentList = $appointmentList->GetAppointmentListByDoctor($_GET['doctor']);
        } else { // Si le médecin n'est pas passé en paramètre, on affiche tous les rendez-vous
            $appointmentList = new Appointment();
            $appointmentList = $appointmentList->DisplayAppointmentList();
        }
        foreach ($appointmentList as $appointment) {
            $patient = new Patient(); // Création d'un objet patient
            $patient = $patient->ConsultPatientInfo($appointment['patient_id']); // Récupère les informations du patient par rapport à son id
            $appointment['appointment_date'] = date('d/m/Y', strtotime($appointment['appointment_date'])); // Formate la date au format français
            echo '<tr>';
            echo '<td>' . $patient['patient_firstname'] . '</td>';
            echo '<td>' . $patient['patient_lastname'] . '</td>';
            echo '<td>' . $appointment['appointment_date'] . ' </td>';
            echo '<td>' . $appointment['appointment_hour'] . '</td>';
            echo '<td>' . $patient['patient_phone'] . '</td>';
            echo '<td>' . $patient['patient_secu'] . '</td>';
            echo '<td><button type="button" class="btn btn-info rounded-5" data-bs-toggle="modal" data-bs-target="#modifyAppointment' . $appointment['appointment_id'] . '" class="btn btn-primary"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/edit.png" /></button>';
            echo '<button type="button" id="btnDelete" class="btn btn-danger rounded-5" data-bs-toggle="modal" data-bs-target="#modalDelete' . $appointment['appointment_id'] . '"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/delete-forever.png"></button><td>';
            echo '</tr>';

            // Modal de suppression

            echo ' <div class="modal fade" id="modalDelete' . $appointment['appointment_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body text-center">
                  <h6> Voulez-vous supprimer cet élément définitivement?</h6>
                  <!-- bouton delete -->
                  <div class="text-center">
                    <button type="button" class="btn btn-primary"><a href="controller-doctor.php?delete=' . $appointment['appointment_id'] . '"><span class="text-white">oui</span></a></button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">non</button>
                  </div>
                </div>
              </div>
            </div>
          </div>';
            // CODE à utiliser demain à Mathis PAS TOUCHER
            //   if (isset($_GET['doctor'])) {
            //     echo '
            //     <a href="controller-doctor-appointments.php?deleteAppointment=' . $appointment['appointment_id'] . '&doctor=' . $_GET['doctor'] . '><button type=" button" class="btn btn-danger rounded-5"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/delete-forever.png" /></button></a></td>';
            //     } else {
            //     echo '
            //     <td><button type="button" class="btn btn-info rounded-5" data-bs-toggle="modal" data-bs-target="#modifyAppointment' . $appointment['appointment_id'] . '" class="btn btn-primary"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/edit.png" /></button>
            //         <a href="controller-doctor-appointments.php?deleteAppointment=' . $appointment['appointment_id'] . '"><button type="button" class="btn btn-danger rounded-5"><img src="https://img.icons8.com/ios-filled/20/FFFFFF/delete-forever.png" /></button></a>
            //     </td>';
        }
    }

    public static function displayAppointmentsModals() // Affiche les modals de modification des rendez-vous
    {
        $appointmentList = self::GetAppointmentList(); // Récupère la liste des rendez-vous
        foreach ($appointmentList as $appointment) { // Pour chaque rendez-vous
            $patient = new Patient(); // Création d'un objet patient
            $patient = $patient->ConsultPatientInfo($appointment['patient_id']); // Récupère les informations du patient par rapport à son id
            $doctor = new Doctor(); // Création d'un objet doctor
            $doctor = $doctor->getDoctorById($appointment['doctor_id']); // Récupère les informations du docteur par rapport à son id
var_dump($doctor);
            echo '<div class="modal fade" id="modifyAppointment' . $appointment['appointment_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier la consultation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <div class="input-group">
                                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-person-rolodex"></i></div>
                                <input type="text" name="doctor_lastname" id="name" class="form-control" placeholder="Nom" aria-label="Input group example" disabled aria-describedby="btnGroupAddon" value="' . $patient['patient_lastname'] . '">
                                <input type="text" name="doctor_firstname" id="firstname" class="form-control" placeholder="Prénom" aria-label="Input group example" disabled aria-describedby="btnGroupAddon" value="' . $patient['patient_firstname'] . '">
                            </div>
                            <div class="input-group">
                                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-heart-pulse"></i></div>
                                <input type="text" name="doctor_lastname" id="name" class="form-control" placeholder="Nom" aria-label="Input group example" disabled aria-describedby="btnGroupAddon" value="' . $doctor[0]['doctor_lastname'] . '">
                                <input type="text" name="doctor_firstname" id="firstname" class="form-control" placeholder="Prénom" aria-label="Input group example" disabled aria-describedby="btnGroupAddon" value="' . $doctor[0]['doctor_firstname'] . '">
                            </div>
       
                            <div class="input-group">
                                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-calendar-event-fill"></i></div>
                                <input type="date" name="date" id="date" value="' . $appointment['appointment_date'] . '" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                            <div class="input-group">
                                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-clock-fill"></i></div>
                                <input type="time" name="hour" id="hour" class="form-control" value="' . $appointment['appointment_hour'] . '" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                            <div class="input-group">
                                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-chat-square-dots-fill"></i></div>
                                <input type="textarea" name="description" id="description" class="form-control" value="' . $appointment['appointment_description'] . '" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                            <input type="hidden" name="id" value="' . $appointment['appointment_id'] . '">
       
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" name="ModifyAppointment" class="btn btn-outline-primary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>';
        }
    }
    public function ModifyAppointment($id, $date, $hour, $description) // Méthode pour modifier un rendez-vous
    {
        $appointment = new Appointment();
        $appointment->ModifyAppointment($id, $date, $hour, $description);
    }

    public function DeleteAppointment($id) // Méthode pour supprimer un rendez-vous
    {
        $appointment = new Appointment();
        $appointment->DeleteAppointment($id);
    }

    public function GetAppointmentListByDoctor($doctor_id) // Méthode pour récupérer la liste des rendez-vous d'un docteur
    {
        $appointment = new Appointment();
        $appointmentList = $appointment->GetAppointmentListByDoctor($doctor_id);
        return $appointmentList;
    }
}


if (isset($_POST['ModifyAppointment'])) { // Si le bouton "Modifier un rdv" est cliqué, on modifie le rendez-vous - IL FAUDRA AJOUTER LA VERIFICATION DES DONNEES
    $appointment = new Appointments();
    $appointment->ModifyAppointment($_POST['id'], $_POST['date'], $_POST['hour'], $_POST['description']);
}

if (isset($_GET['deleteAppointment'])) { // Si l'id du rendez-vous est passé en paramètre, on supprime le rendez-vous

    // On vérifie que le rendez-vous existe
    $appointment = new Appointment();
    $appointment = $appointment->ConsultAppointmentInfo($_GET['deleteAppointment']);
    if ($appointment == null) { // Si le rendez-vous n'existe pas, on affiche une erreur
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Une erreur est survenue';
        echo '</div>';
    } else { // Si le rendez-vous existe, on le supprime
        $appointment = new Appointments();
        $appointment->DeleteAppointment($_GET['deleteAppointment']);
        echo '<div class="alert alert-success" role="alert">';
        echo 'Le rendez-vous a bien été supprimé';
        echo '</div>';
    }
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

    foreach ($doctors as $doctor) {
        if (isset($_GET['doctor']) && $_GET['doctor'] == $doctor['doctor_id']) {
            echo '<li><a href="controller-doctor-appointments.php?doctor=' . $doctor['doctor_id'] . '" class="dropdown-item" value="' . $doctor['doctor_id'] . '">Dr. ' . $doctor['doctor_lastname'] . ' ' . $doctor['doctor_firstname'] . '</a></li>';
        } else {
            echo '<li><a href="controller-doctor-appointments.php?doctor=' . $doctor['doctor_id'] . '" class="dropdown-item" value="' . $doctor['doctor_id'] . '">Dr. ' . $doctor['doctor_lastname'] . ' ' . $doctor['doctor_firstname'] . '</a></li>';
        }
    }
}



include('../Views/view-doctor-appointments.php');
