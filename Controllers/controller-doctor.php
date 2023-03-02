<?php
require_once('../Models/doctor.php');
require_once('../config/env.php');
require_once('../helpers/Database.php');









$doc = new Doctor();
$doctorList = $doc->displayDoctorList();




include('../Views/view-doctor.php');
