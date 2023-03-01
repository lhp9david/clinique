<?php
require_once('../Models/doctor.php');
require_once('../config/env.php');
require_once('../helpers/Database.php');



$errors = [];


if($_SERVER["REQUEST_METHOD"] == "POST"){
   
        
        if (isset($_POST['doctor_lastname'])) {
            if (empty($_POST['doctor_lastname'])) {
                $errors['lastname'] = 'champ obligatoire';
            }
            else if(!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['doctor_lastname'])) {
                $errors['lastname'] = 'Veuillez respecter le format';
            } 
        }
    
    
    
        if (isset($_POST['doctor_firstname'])) {
            if (empty($_POST['doctor_firstname'])) {
                $errors['firstname'] = 'champ obligatoire';
            }
            else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['doctor_firstname'])) {
                $errors['firstname'] = 'Veuillez respecter le format';
            }
        }
    
    
        if (isset($_POST['doctor_mail'])) {
    
            if (empty($_POST['doctor_mail'])) {
                $errors['mail'] = 'champ obligatoire';
            }
            else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $_POST['doctor_mail'])) {
                $errors['mail'] = 'Veuillez respecter le format';
            }
        }
    
    
        if(isset($_POST['doctor_phone'])) {
            if (empty($_POST['doctor_phone'])) {
                $errors['phone'] = 'champ obligatoire';
            }
            else if (!preg_match('/^0[1-9]([-. ]?[0-9]{2}){4}$/', $_POST['doctor_phone'])) {
                $errors['phone'] = 'Veuillez respecter le format';
            }
        }

        if(isset($_POST['doctor_phone_emergency'])) {
            if (empty($_POST['doctor_phone_emergency'])) {
                $errors['phone_emergency'] = 'champ obligatoire';
            }
            else if (!preg_match('/^0[1-9]([-. ]?[0-9]{2}){4}$/', $_POST['doctor_phone_emergency'])) {
                $errors['phone_emergency'] = 'Veuillez respecter le format';
            }
        }
        if(isset($_POST['doctor_adress'])) {
            if (empty($_POST['doctor_adress'])) {
                $errors['adress'] = 'champ obligatoire';
            }
          
        }
        
        if (isset($_POST['doctor_password'])) {
            if (empty($_POST['doctor_password'])) {
                $errors['password'] = 'champ obligatoire';
            }
            else if (!preg_match('/^.{8,}$/', $_POST['doctor_password'])) {
                $errors['password'] = '8 caractères minimum';
            }  else {
               $password = $_POST['doctor_password'] ;
            }
        }
    
        if (isset($_POST['confirmPass'])) {

            if (empty($_POST['confirmPass'])) {
                $errors['confirmPass'] = 'champ obligatoire';
            }
            else if (!preg_match('/^.{8,}$/', $_POST['confirmPass'])) {
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



$doc = new Doctor();
$doctorList = $doc->displayDoctorList();
var_dump($errors);




include('../Views/view-doctor.php');