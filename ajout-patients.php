<?php
include 'models/database.php';
include 'models/patients.php';
include 'controllers/controllerAjout-patients.php'
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Lamanue Hospital - ajouter un patient</title>
    </head>
    <body>
        <div class="container">
            <div class="card-panel">
                <form id="addPatient" action="ajout-patients.php" method="POST">
                    <div class="row">
                        <div class="input-field col s12 center-align">
                            <h1>Ajout patient</h1>
                            <a href="index.php" class="waves-effect waves-light btn"><i class="material-icons left">home</i>RETOUR</a>
                            <?php if ($addSuccess) { ?>
                                <h2><?= 'Bravo, nous allons prelever vos organes ! ' ?></h2>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l8 offset-l2">
                            <input id="lastname" name="lastname" type="text" class="validate" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>"/>
                            <label for="lastname">NOM <span class="error"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l8 offset-l2">
                            <input id="firstname" name="firstname" type="text" class="validate" />
                            <label for="firstname">Prénom <span class="error"><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l8 offset-l2">
                            <input id="birthdate" name="birthdate" type="text" class="validate" />
                            <label for="birthdate">Date de naissance (ex: 23/05/2000). <span class="error"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l8 offset-l2">
                            <input id="phone" name="phone" type="tel" class="validate" />
                            <label for="phone">Numéro de téléphone (ex: 0602030405). <span class="error"><?= isset($formError['phone']) ? $formError['phone'] : '' ?></span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 l8 offset-l2">
                            <input id="mail" name="mail" type="email" class="validate" />
                            <label for="mail">Adresse Mail (ex: mail@mail.fr). <span class="error"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></span></label>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 center-align">
                            <input name="addButton" type="submit" value="ENREGISTRER LE PATIENT"/>
                            <p class="error"><?= isset($formError['add']) ? $formError['add'] : '' ?></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>