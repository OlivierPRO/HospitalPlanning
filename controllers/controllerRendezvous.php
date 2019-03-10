<?php

//creation d'un RDV exercice7
$appointments = new appointments();
$appointments->idPatients = htmlspecialchars($_GET['idAppointments']);
$appointmentIsFind = $appointments->getAppointmentsById();

//exercice8
$patients = new patients();
$patientList = $patients->getPatientList();

$regexDate = '/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/';
$regexHour = '/([01]?[0-9]|2[0-3]):[0-5][0-9]/';

$formError = array();
$addSuccess = FALSE;

if (isset($_POST['date'])) {
    $appointmentIsFind->date = htmlspecialchars($_POST['date']);
    if (!preg_match($regexDate, $appointmentIsFind->date)) {
        $formError['date'] = 'la date doit etre du type 01/01/21019';
    }
}
if (empty($appointmentIsFind->date)) {
    $formError['date'] = 'champs obligatoire';
}

if (isset($_POST['hour'])) {
    $appointmentIsFind->hour = htmlspecialchars($_POST['hour']);
    if (!preg_match($regexHour, $appointmentIsFind->hour)) {
        $formError['hour'] = 'l\'heure doit etre de type 00:00';
    }
}
if (empty($appointmentIsFind->hour)) {
    $formError['hour'] = 'champs obligatoire';
}

if (count($formError) == 0 && isset($_POST['updateButton'])) {
    $patients = new appointments();
    $patients->idPatients = $_GET['idAppointments'];
    $patients->dateHour = $_POST['date'] . ' ' . $_POST['hour'];
    $patients->updateAppointment();
    header('location:listrendezvous.php');
} 

    
