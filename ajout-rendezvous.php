<?php
include 'models/database.php';
include 'models/patients.php';
include 'models/appointments.php';
include 'controllers/controllerAjout-rendezvous.php'
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text" rel="stylesheet" /> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Lamanue Hospital - Rendez-vous patients</title>
    </head>
    <body>
        <div class="background_opacity">
            <h1 class="text-center"><strong>Ajout rendez-vous</strong></h1>
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <a class="btn btn-outline-danger listePatientsBtn" href="index.php" name="retourMenu" />RETOUR MENU</a>
                    <a class="btn btn-outline-danger listePatientsBtn" href="ajout-patients.php" name="nouveauPatient" >NOUVEAU PATIENT</a>
                    <a class="btn btn-outline-danger listePatientsBtn" href="liste-rendezvous.php" name="listeRDV" >RETOUR LISTE RDV</a>
                </div>
            </div>
            <?php if ($Success) { ?>
                <h2><?= 'Rendez-vous enregistré' ?></h2>
            <?php } ?>
            <form id="addPatient" class="ml-5 mt-5" action="ajout-rendezvous.php" method="POST">
                <table class="table table-stripped mt-5 patientsListTable text-center">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Patient</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label for="date"></label>
                                <input id="date" name="date" type="date"  /> 
                                <p role="alert"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                            </td>
                            <td>
                                <label for="hour"></label>
                                <input id="hour"  name="hour" min="08:00" max="20:00" type="time" class="hour" /> 
                                <p role="alert"><?= isset($formError['hour']) ? $formError['hour'] : '' ?></p>
                            </td>
                            <td>
                                <label for="idPatients"></label>
                                <select id="idPatient" name="idPatients">
                                    <option value="" disabled selected>Choix du patient</option>
                                    <?php foreach ($getPatients AS $patient) { ?>
                                        <option value="<?= $patient->id ?>"><?= $patient->lastname . ' ' . $patient->firstname ?></option>
                                    <?php } ?>
                                </select>
                                <p role="alert"><?= isset($formError['idPatients']) ? $formError['idPatients'] : '' ?></p>
                            </td>
                            <td>
                                <input class="btn btn-outline-danger" name="addButton" type="submit" value="ENREGISTRER LE RDV"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    </body>
</html>