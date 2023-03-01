<?php 

session_start();

require_once '../config/env.php';
require_once '../helpers/Database.php';
require_once '../models/secretary.php';


$obj_secretary = new Secretary();

if (isset($_POST['patient_name'])) {

    $patient_name = $_POST['patient_name'];
    $patient_lastname = $_POST['patient_lastname'];
    $patient_firstname = $_POST['patient_firstname'];
    $patient_secu = $_POST['patient_secu'];
    $patient_mail = $_POST['patient_mail'];
    $patient_adress = $_POST['patient_adress'];
    $patient_photo = $_POST['patient_photo'];

    $obj_secretary->addNewPatient($patient_name, $patient_lastname, $patient_firstname, $patient_secu, $patient_mail, $patient_adress, $patient_photo);

}





include '../views/secretary.php';