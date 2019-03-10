<?php

$patients = new patients();
$getPatients = $patients->getPatientList();

$newAppointments = new appointments();

$Success = false;

$regexDate = '/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/';
$regexHour = '/([01]?[0-9]|2[0-3]):[0-5][0-9]/';

$formError = array();

if (isset($_POST['date'])) {
    if (!preg_match($regexDate, $_POST['date'])) {
        $formError['date'] = 'la date doit etre de type 01/01/2019';
    }
    if (empty($_POST['date'])) {
        $formError['date'] = 'merci de renseigner la date';
    }
}

if (isset($_POST['Hour'])) {
    if (!preg_match($regexHour, $_POST['hour'])) {
        $formError['hour'] = 'l\'heure doit etre de type 12h50';
    }
    if (empty($_POST['hour'])) {
        $formError['hour'] = 'l\'heure est obligatoire';
    }

    if (isset($_POST['idPatients']) && $_POST['idPatients']=!0 ){
        if (is_nan($appointments->idPatients)) {
            $formError['idPatients'] = 'selectionnez un patient';
        }
    }
}

if (count($formError) == 0 && isset($_POST['addButton'])) {
    $newAppointments->dateHour = $_POST['date'] .' '. $_POST['hour'];
    $newAppointments->idPatients = $_POST['idPatients'];
    $Success=$newAppointments->addAppointment();
}
