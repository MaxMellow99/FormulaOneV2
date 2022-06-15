<?php
    require_once 'database.php';

class StandingManager
{
    public static function GetStanding() {
        global $conn;

        $stmt = $conn->prepare('SELECT standingId, driverFirstname, driverLastname, standingPosition, standingPoints, standingWins FROM standing LEFT JOIN driver ON driver.driverId = standing.driverId ORDER BY standingPosition ASC');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function GetSpecificStanding($pId) {
        global $conn;

        $stmt = $conn->prepare('SELECT standingId, driverFirstname, driverLastname, standingPosition, standingPoints, standingWins FROM standing LEFT JOIN driver ON driver.driverId = standing.driverId WHERE standingId = ?');
        $stmt->bindValue(1, $pId);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    public static function AddStanding($pDriverId, $pStandingPosition, $pStandingPoints, $pStandingWins) {
        global $conn;

        $stmt = $conn->prepare('INSERT INTO standing(driverId, standingPosition, standingPoints, standingWins) VALUES(?,?,?,?)');
        $stmt->bindValue(1, $pDriverId);
        $stmt->bindValue(2, $pStandingPosition);
        $stmt->bindValue(3, $pStandingPoints);
        $stmt->bindValue(4, $pStandingWins);
        $stmt->execute();
    }

    public static function UpdateStanding($pId, $pDriverId, $pStandingPosition, $pStandingPoints, $pStandingWins) {
        global $conn;

        $stmt = $conn->prepare('UPDATE standing SET driverId = ?, standingPosition = ?, standingPoints = ?, standingWins = ? WHERE standingId = ?');
        $stmt->bindValue(1, $pDriverId);
        $stmt->bindValue(2, $pStandingPosition);
        $stmt->bindValue(3, $pStandingPoints);
        $stmt->bindValue(4, $pStandingWins);
        $stmt->bindValue(5, $pId);
        $stmt->execute();
    }

    public static function DeleteStanding($pId) {
        global $conn;

        $stmt = $conn->prepare('DELETE FROM standing WHERE standingId = ?');
        $stmt->bindValue(1, $pId);
        $stmt->execute();
    }
}