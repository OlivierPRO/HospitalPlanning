<?php
include 'models/database.php';
include 'models/patients.php';
include 'models/appointments.php';
include 'controllers/controllerProfil-patients.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text" rel="stylesheet"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Lamanue Hospital - Profil patients</title>
    </head>
    <body>
        <div class="background_opacity">
            <h1 class="text-center"><strong>Profil patient</strong></h1>
            <div class="col-md-12 text-center mt-5">
                <a class="btn btn-outline-danger listePatientsBtn" href="index.php" name="retourMenu">RETOUR MENU</a>
                <a class="btn btn-outline-danger listePatientsBtn" href="liste-patients.php?page=1" name="retourListe">RETOUR LISTE</a>
                <a class="btn btn-outline-danger listePatientsBtn" href="ajout-patients.php" name="nouveauPatient" >NOUVEAU PATIENT</a>
            </div>
            <form method="POST">
                <table class="table table-stripped mt-5 patientsListTable text-center">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Téléphone</th>
                            <th>Adresse mail</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Nom"><?= $patients->lastname ?></td>
                            <td data-label="Prénom"><?= $patients->firstname ?></td>
                            <td data-label="Date de naissance"><?= $patients->birthdate ?></td>
                            <td data-label="Téléphone"><?= $patients->phone ?></td>
                            <td data-label="Adresse mail"><?= $patients->mail ?></td>
                            <td><input class="btn btn-outline-danger" name="modifyButton" type="submit" value="MODIFIER"/></td>
                        </tr>
                    </tbody>
                </table>
            </form>  
            <p class="alert"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></p>
            <p class="alert"><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></p>
            <p class="alert"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></p>
            <p class="alert"><?= isset($formError['phone']) ? $formError['phone'] : '' ?></p>
            <p class="alert"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
            <p class="alert"><?= isset($formError['add']) ? $formError['add'] : '' ?></p>
            <?php if (isset($_POST['modifyButton'])) { ?>
                <p class="text-center" role="alert">modifier le Profil de votre patient :</p>
                <div class="container">
                    <form id="addPatient" action="" method="POST" >
                        <div class="row">
                            <div class="mt-5">
                                <label for="lastname">Nom</label>
                                <input id="lastname" name="lastname" type="text" value="<?= $patients->lastname ?>" class="validate" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2">
                                <label for="firstname">Prénom</label>
                                <input id="firstname" name="firstname" type="text" value="<?= $patients->firstname ?>" class="validate" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2">
                                <label for="birthdate">Date de naissance.</label>
                                <input id="birthdate" name="birthdate" type="text" value="<?= $patients->birthdate ?>" class="validate" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2">
                                <label for="phone">Numéro de téléphone</label>
                                <input id="phone" name="phone" type="tel" value="<?= $patients->phone ?>" class="validate" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2">
                                <label for="mail">Adresse Mail</label>
                                <input id="mail" name="mail" type="email" value="<?= $patients->mail ?>" class="validate" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="">
                                <input class="btn btn-outline-danger mt-2" name="updateButton" type="submit" value="ENREGISTRER"/>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
            <div class="row">
                <h2 class="offset-md-3">Liste des rendez-vous du patient</h2>
            </div>
            <div class="row offset-md-3 mt-4">
                <?php
                if ($showAppointmentsList) :
                    foreach ($showAppointmentsList as $rdvPatient) :
                        if ($rdvPatient->idPatients === $patients->id):
                            ?>
                            <p>Rendez vous le : <?= $rdvPatient->date ?></p>
                            <p>à : <?= $rdvPatient->hour ?></p>
                            <?php
                        endif;
                    endforeach;
                else:
                    ?>
                    <p>Aucun Rendez-vous pour ce patient.</p>
                <?php endif; ?>  
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" ></script>
    </body>
</html>

