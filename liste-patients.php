<?php
include ('models/database.php');
include ('models/patients.php');
include ('models/appointments.php');
include ('controllers/controllerList-patients.php')
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text" rel="stylesheet"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Lamanue Hospital - liste patients</title>
    </head>
    <body>
        <div class="background_opacity">
            <h1 class="text-center"><strong>Liste des patients</strong></h1>
            <div class="row">      
                <div class="col-md-12 text-center mt-5">
                    <a class="btn btn-outline-danger listePatientsBtn" href="index.php" name="retourMenu">RETROUR MENU</a>
                    <a class="btn btn-outline-danger listePatientsBtn" href="ajout-patients.php" name="nouveauPatient" >NOUVEAU PATIENT</a>
                    <a class="btn btn-outline-danger listePatientsBtn" href="liste-patients.php?page=1" name="listePatients" >RETOUR LISTE</a>
                </div>
            </div>              
            <form method="GET" class="mt-3 text-center">
                <input type="search" class="form-control" name="search" placeholder="Rechercher un patient" />
                <input type="submit" class="btn btn-outline-danger mt-2" value="Rechercher" />
            </form>
            <form method="GET" >
                <?php if ($deletePatientAndAppointment) { ?>
                    <h1 class="text-center" role='alert'><?= 'Patient supprimé' ?></h1>
                <?php } ?>
                <table class="table table-stripped mt-5 patientsListTable text-center">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Infos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($patientList as $patient) { ?>
                            <tr>
                                <td><?= $patient->lastname ?></td>
                                <td><?= $patient->firstname ?></td>
                                <td><a href="profil-patients.php?idPatient=<?= $patient->id ?>" class="btn btn-outline-danger">+ d'infos</a></td>
                                <td><a href="?eraseButton=<?= $patient->id ?>" class="btn btn-outline-danger">effacer patient</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
        
            <nav aria-label="...">
                <ul class="pagination pagination-sm  ">
                    <?php
                    for ($i = 1; $i <= $page; $i++) :
                        isset($_GET['page']) ? $_GET['page'] : $_GET['page'] = 1;
                        if ($_GET['page'] != $i) :
                            ?>
                            <li class="page-item"><a class="page-link text-danger" href="liste-patients.php?page=<?= $i ?>"><?= $i ?></a></li>
                            <?php
                        else :
                            ?>
                            <li class="page-item disabled page-link text-dark"> <?= $i ?></li>
                            <?php
                            endif;
                        endfor;
                        ?>
                </ul>
            </nav>
    </body>
</html>