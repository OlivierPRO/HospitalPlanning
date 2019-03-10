<?php
include ('models/database.php');
include ('models/patients.php');
include ('models/appointments.php');
include ('controllers/controllerRendezvous.php')
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text" rel="stylesheet"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Lamanue Hospital - infos rendez vous</title>
    </head>
    <body>
        <div class="background_opacity">
            <h1 class="text-center"><strong>infos rendez-vous</strong></h1>
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <a class="btn btn-outline-danger listePatientsBtn" href="index.php" name="retourMenu">RETOUR MENU</a>
                    <a class="btn btn-outline-danger listePatientsBtn" href="ajout-rendezvous.php" name="nouveauRdv">NOUVEAU RDV</a>
                    <a class="btn btn-outline-danger listePatientsBtn" href="liste-rendezvous.php" name="nouveauRdv">RETOUR LISTE RDV</a>
                </div>
            </div>
            <form method="POST">
                <table class="table table-stripped mt-5 patientsListTable text-center">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date RDV</th>
                            <th>Heure</th>                     
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $appointmentIsFind->lastname ?></td>
                            <td><?= $appointmentIsFind->firstname ?></td>
                            <td><?= $appointmentIsFind->date ?></td>
                            <td><?= $appointmentIsFind->hour ?></td>
                            <td><input class="btn btn-outline-danger" name="modifyButton" type="submit" value="MODIFIER"/></td>
                        </tr>
                    </tbody>
                </table>
            </form> 
            <?php if ($addSuccess) { ?>
                <h2><?= 'Modifications enregistrées' ?></h2>
            <?php } ?>
            <p role="alert"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
            <p role="alert"><?= isset($formError['hour']) ? $formError['hour'] : '' ?></p>
            <p role="alert"><?= isset($formError['add']) ? $formError['add'] : '' ?></p>
            <?php if (isset($_POST['modifyButton'])) { ?>
                <p class="text-center" role="alert">modifier le rendez-vous de votre patient :</p>
                <div class="container">
                    <form id="updateAppointment" action="" method="POST" >


                        <div class="row">
                            <div class="mt-2">
                                <label for="date">Date</label>
                                <input id="date" name="date" type="date" value="<?= $appointmentIsFind->date ?>" class="validate" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2">
                                <label for="hour">Heure</label>
                                <input id="hour" name="hour" type="time" value="<?= $appointmentIsFind->hour ?>" class="validate" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2">
                                <input class="btn btn-outline-danger mt-2" name="updateButton" type="submit" value="ENREGISTRER"/>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
    </body>
</html>