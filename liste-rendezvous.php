<?php
include 'models/database.php';
include 'models/appointments.php';
include 'controllers/controllerListe-rendezvous.php'
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text" rel="stylesheet"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="script.js"></script>
        <title>Lamanue Hospital - liste rendez vous</title>
    </head>
    <body>
        <div class="background_opacity">
            <h1 class="text-center"><strong>Liste des rendez-vous</strong></h1>
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <a class="btn btn-outline-danger listePatientsBtn" href="index.php" name="retourMenu">RETOUR MENU</a>
                    <a class="btn btn-outline-danger listePatientsBtn" href="ajout-rendezvous.php" name="nouveauRdv">NOUVEAU RDV</a>
                </div>
                <?php if ($isDelete){?>
                <p role="alert" class="center-align mt-5">Le rendez vous à bien été  supprimé.</p>
               <?php } ?>
            </div>
            <form method="POST">
                <table class="table table-stripped mt-5 patientsListTable text-center">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date du RDV</th>
                            <th>Heure</th>
                            <th>Infos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listAppointments as $appointments) { ?>
                            <tr>
                                <td><?= $appointments->lastname ?></td>
                                <td><?= $appointments->firstname ?></td>
                                <td><?= $appointments->date ?></td>
                                <td><?= $appointments->hour ?></td>
                                <td><a href="rendezvous.php?idAppointments=<?= $appointments->id ?>" class="btn btn-outline-danger">+ d'infos</a></td>
                                <td><a href="liste-rendezvous.php?eraseButton=<?= $appointments->id ?>" class="btn btn-outline-danger">SUPPRIMER</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>  
    </body>
</html>