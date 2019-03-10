<?php

// On instancie un nouvel objet $appointments avec comme classe appointments
$appointments = new appointments();

// On appel la methode getAppointmentsList dans l'objet $listAppointments

$isDelete = FALSE;

if (!empty($_GET['eraseButton'])) {
    $appointments->id = htmlspecialchars($_GET['eraseButton']);
    if ($appointments->deleteAppointment()) {
        $isDelete = TRUE;
    }
}
$listAppointments = $appointments->getAppointmentsList();
