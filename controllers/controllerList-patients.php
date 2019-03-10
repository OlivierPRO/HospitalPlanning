<?php

$patients = new patients();


/**
 * EXERCICE 13 pagination
 */
$page = $patients->paging();
if (!empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $page) {
    $_GET['page'] = intval($_GET['page']);
    //intval = retourne une valeur numerique, evite l'injection dans l'url
    $patients->id = (($_GET['page'] - 1) * 5);
    $patientList = $patients->getPatientsForPaging();
} else {
    $patientList = $patients->getPatientList();
}
    

$deletePatientAndAppointment = FALSE;

if (!empty($_GET['eraseButton'])) {
    $patients->id = htmlspecialchars($_GET['eraseButton']);
    $patients->deleteAppointmentAndPatientInListPatient();
    header('location:liste-patients.php');
    $deletePatientAndAppointment = TRUE;
}
/**
 * EXERCICE 12 
 * searchBar
 */
if (!empty($_GET['search'])) {
    $patientList = $patients->searchPatient(htmlspecialchars($_GET['search']));
}



  
  



