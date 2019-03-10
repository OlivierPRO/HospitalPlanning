<?php

/* On crée une class patients qui hérite de la classe database via extends
 * La classe patients va nous permettre d'accéder à la table patients
 */

class patients extends database {

    // Création d'attributs qui correspondent à chacun des champs de la table patients
    // et on les initialise par rapport à leurs types.
    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $birthdate = '01/01/2000';
    public $phone = 0231443656;
    public $mail = '';
    public $patientsPerPage = 5;

    // on crée une methode magique __construct()
    public function __construct() {
        // On appelle le __construct() du parent via "parent::""
        parent::__construct();
    }

    /**
     * EXERCICE1
     * On crée une methode qui insert un patient dans la table patient
     * @return type EXECUTE
     */
    public function addPatient() {
        // Insertion des données du patient à l'aide d'une requête préparée avec un INSERT INTO et le nom des champs de la table
        // Insertion des valeurs des variables via les marqueurs nominatifs, ex :lastname).
        $query = 'INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
        $addPatient = $this->dataBase->prepare($query);
        // on attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $addPatient->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $addPatient->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $date = DateTime::createFromFormat('d/m/Y', $this->birthdate);
        $dateUs = $date->format('Y-m-d');
        $addPatient->bindValue(':birthdate', $dateUs, PDO::PARAM_STR);
        $addPatient->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $addPatient->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        // on utilise la méthode execute() via un return
        return $addPatient->execute();
    }

    /**
     * EXERCICE2
     * On créé une méthode qui affiche la liste des patients
     * @return array
     */
    public function getPatientList() {
        $result = array();
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM `patients` ORDER BY `lastname` ASC';
        $queryResult = $this->dataBase->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * EXERCICE3
     * On créé une méthode qui affiche le profil d'un patient
     * @return type
     */
    public function getProfilId() {
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM `patients` WHERE `id` = :idPatient';
        $findProfil = $this->dataBase->prepare($query);
        $findProfil->bindValue(':idPatient', $this->id, PDO::PARAM_INT);
        if ($findProfil->execute()) {
            $profil = $findProfil->fetch(PDO::FETCH_OBJ);
            if (is_object($profil)) {
                $this->lastname = $profil->lastname;
                $this->firstname = $profil->firstname;
                $this->birthdate = $profil->birthdate;
                $this->phone = $profil->phone;
                $this->mail = $profil->mail;
            }
        }
    }

    /**
     * EXERCICE4
     * On créé une méthode qui met à jour le profil du patient
     * @return type
     */
    public function updateProfil() {
        // MAJ des données du patient à l'aide d'une requête préparée avec un UPDATE et le nom des champs de la table
        // Insertion des valeurs des variables via les marqueurs nominatifs.
        $query = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :idPatient';
        $updatePatient = $this->dataBase->prepare($query);
        // on attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $updatePatient->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $updatePatient->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $date = DateTime::createFromFormat('d/m/Y', $this->birthdate);
        $dateUs = $date->format('Y-m-d');
        $updatePatient->bindValue(':birthdate', $dateUs, PDO::PARAM_STR);
        $updatePatient->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $updatePatient->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $updatePatient->bindValue(':idPatient', $this->id, PDO::PARAM_INT);
        // on utilise la méthode execute() via un return
        return $updatePatient->execute();
    }

    /**
     * EXERCICE 11
     * supprimer le RDV et le patient
     */
        public function deleteAppointmentAndPatientInListPatient() {
        $this->dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $this->dataBase->beginTransaction();
            $deleteAppointment = 'DELETE FROM `appointments` WHERE `idPatients` = :idPatients';
            $deleteThisAppointment = $this->dataBase->prepare($deleteAppointment);
            $deleteThisAppointment->bindValue(':idPatients', $this->id, PDO::PARAM_INT);
            $deleteThisAppointment->execute();
            $deletePatient = 'DELETE FROM `patients` WHERE `id` = :id';
            $deleteThisPatient = $this->dataBase->prepare($deletePatient);
            $deleteThisPatient->bindValue(':id', $this->id, PDO::PARAM_INT);
            $deleteThisPatient->execute();
            $this->dataBase->commit();
        } catch (Exception $errorMessage) {
            $this->dataBase->rollback();
            echo 'Erreur : ' . $errorMessage->getMessage();
// On affiche le message d'erreur avec le getMessage
        }
    }
    

    /**
     * EXERCICE 12
     * @param type $search
     * @return type
     */
    public function searchPatient($search) {
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail`'
                . 'FROM `patients` '
                . 'WHERE `lastname` '
                . 'LIKE :search '
                . 'ORDER BY `lastname`';
        $result = $this->dataBase->prepare($query);
        $result->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $result->execute();
        $resultList = $result->fetchAll(PDO::FETCH_OBJ);
        return $resultList;
    }

    /**
     * EXERCICE 13
     * PAGINATION
     * on selectionne le nombre de patients par page
     */
    public function paging() {
        $query = 'SELECT COUNT(`id`) FROM `patients`';
        $total = $this->dataBase->query($query)->fetchColumn();
        $result = ceil($total / $this->patientsPerPage);
        return $result;
    }

    /**
     * EXERCICE 13
     * PAGINATION
     * on recupere et affiche les patients de la methode paging
     */
    public function getPatientsForPaging() {
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail` '
                . 'FROM `patients`'
                . 'ORDER BY `id` asc LIMIT :page, ' . $this->patientsPerPage;
        $queryResult = $this->dataBase->prepare($query);
        $queryResult->bindValue(':page', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        if (is_object($result)) {
            $this->id = $result->id;
        }
        return $result;
    }

}
