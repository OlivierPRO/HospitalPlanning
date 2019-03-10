<?php

class appointments extends database {

    public $id = 0;
    public $dateHour = '2019-05-05 00:00:00';
    public $idPatients = 0;

    // on crée une methode magique __construct()
    public function __construct() {
        // On appelle le __construct() du parent via "parent::""
        parent::__construct();
    }

    /**
     * EXERCICE 5
     * @return type
     */
    public function addAppointment() {
        $query = 'INSERT INTO appointments (`dateHour`,`idPatients`) VALUES (:dateHour, :idPatients)';
        $addApointment = $this->dataBase->prepare($query);
        $addApointment->bindValue('dateHour', $this->dateHour, PDO::PARAM_STR);
        $addApointment->bindValue('idPatients', $this->idPatients, PDO::PARAM_STR);
        return $addApointment->execute();
    }

    /**
     * EXERCICE 6
     * @return type
     */
    public function getAppointmentsList() {
        $result = array();
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") 
                 AS `date`, DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,
                        `appointments`.`id`,
                        `patients`.`lastname`,
                        `patients`.`firstname`
                    FROM `appointments`
                    LEFT JOIN `patients`
                    ON `appointments`.`idPatients` = `patients`.`id`
                    ORDER BY `patients`.`lastname`';
        $queryResult = $this->dataBase->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchall(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * EXERCICE 7
     * @return type
     */
    public function getAppointmentsById() {
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`,
                  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,
                        `appointments`.`id`,
                        `patients`.`lastname`,
                        `patients`.`firstname`
                    FROM `appointments`
                    LEFT JOIN `patients`
                    ON `appointments`.`idPatients` = `patients`.`id`
                   WHERE `appointments`.`id`=:idPatients';
        $queryResult = $this->dataBase->prepare($query);
        $queryResult->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $resultList = $queryResult->fetch(PDO::FETCH_OBJ);
            if (is_object($resultList)) {
                $this->date = $resultList->date;
                $this->hour = $resultList->hour;
                $this->id = $resultList->id;
                $this->lastname = $resultList->lastname;
                $this->firstname = $resultList->firstname;
            }
            return $resultList;
        }
    }

    /**
     * EXERCICE 8
     * @return type
     */
    public function updateAppointment() {

        $query = 'UPDATE `patients` '
                . 'INNER JOIN `appointments` '
                . 'ON `patients`.`id`= `appointments`.`idPatients` '
                . 'SET  `appointments`.`dateHour`=:dateHour '
                . 'WHERE `appointments`.`id`=:idPatients';
        $updateAppointment = $this->dataBase->prepare($query);
        $updateAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $updateAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $updateAppointment->execute();
    }

    public function deleteAppointment() {
        $query = 'DELETE FROM `appointments` WHERE `id` = :id';
        $deleteAppointment = $this->dataBase->prepare($query);
        $deleteAppointment->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteAppointment->execute();
    }

    public function showAppointmentInProfilPatient() {
        $query = 'SELECT id, DATE_FORMAT(appointments.dateHour, "%d/%m/%Y") AS date,
                  DATE_FORMAT(appointments.dateHour, "%H:%i") AS hour,
                  idPatients FROM appointments 
                  WHERE appointments.idPatients = :idPatient';
        $queryResult = $this->dataBase->prepare($query);
        $queryResult->bindValue(':idPatient', $this->idPatients, PDO::PARAM_INT);
        $queryResult->execute();
        if (is_object($queryResult)) {
            $isObject = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $isObject;
    }

}
