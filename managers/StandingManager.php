<?php

require_once "./database.php";


class standingmanager{

    public static function getStanding(){
        global $conn;

        $stmt = $conn->prepare("SELECT 
        standing.standingPosition,
        standing.driverId,
        driver.driverFirstname,
        driver.driverLastname,
        driver.driverPicture,
        standing.standingId,
        standing.standingPoints,
        standing.standingWins
        FROM standing
        LEFT JOIN driver
        ON standing.driverId = driver.driverId;");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}