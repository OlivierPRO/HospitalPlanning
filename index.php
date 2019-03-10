<?php ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Lamanue Hospital</title>
    </head>
    <body>
        <div class="container">

            <div class="row">                
                <img src="assets/img/index.png" class="imgIndex" />
                <div class="indexBtngroup">
                    <a class="btn btn-outline-danger offset-md-2 pb-5 mt-2 indexBtn background_opacity_button" href="ajout-patients.php" name="enregistrerPatient" >ENREGISTRER PATIENT</a>
                    <a class="btn btn-outline-danger offset-md-2 pb-5 mt-2 indexBtn background_opacity_button" href="ajout-rendezvous.php" name="prendreRdv" >PRENDRE RDV</a>                               
                    <a class="btn btn-outline-danger offset-md-2 pb-5 mt-2 indexBtn background_opacity_button" href="liste-patients.php?page=1" name="listePatient" >LISTE PATIENTS</a>                   
                    <a class="btn btn-outline-danger offset-md-2 pb-5 mt-2 indexBtn background_opacity_button" href="liste-rendezvous.php" name="listeRdv" >LISTE RDV</a>
                </div>
            </div>     

        </div>
        <script type="text/javascript" src="assets/js/script.js"></script>
    </body>
</html>