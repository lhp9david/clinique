<?php

session_start();

require_once '../config/env.php';
require_once '../helpers/Database.php';
require_once '../models/patient.php';
require_once '../models/appointment.php';
require_once '../models/doctor.php';

if (isset($_SESSION['user'])) {
    if (isset($_SESSION['user']['role'])) {
        if ($_SESSION['user']['role'] == 'secretary') {



        }
        else if ($_SESSION['user']['role'] == 'doctor') {

            
            
        }
    }
}