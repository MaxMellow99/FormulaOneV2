<?php
    require_once 'database.php';

class ResultManager
{
    public static function GetResult() {
        global $conn;

        $stmt = $conn->prepare('SELECT resultId, resultPosition, driverFirstname, driverLastname, raceRound, raceTrack, resultPoints FROM result LEFT JOIN driver ON driver.driverId = result.driverId LEFT JOIN race ON race.raceId = result.raceId ORDER BY resultPosition ASC');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function GetSpecificRace($pId) {
        global $conn;

        $stmt = $conn->prepare('SELECT resultId, resultPosition, driverFirstname, driverLastname, raceRound, raceTrack, resultPoints FROM result LEFT JOIN driver ON driver.driverId = result.driverId LEFT JOIN race ON race.raceId = result.raceId WHERE resultId = ?');
        $stmt->bindValue(1, $pId);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    public static function AddResult($pPosition, $pDriver, $pRace, $pPoints) {
        global $conn;

        $stmt = $conn->prepare('INSERT INTO result(resultPosition, driverId, raceId, resultPoints) VALUES(?,?,?,?)');
        $stmt->bindValue(1, $pPosition);
        $stmt->bindValue(2, $pDriver);
        $stmt->bindValue(3, $pRace);
        $stmt->bindValue(4, $pPoints);
        $stmt->execute();
    }

    public static function UpdateResult($pId, $pPosition, $pDriver, $pRace, $pPoints) {
        global $conn;

        $stmt = $conn->prepare('UPDATE result SET resultPosition = ?, driverId = ?, raceId = ?, resultPoints = ? WHERE resultId = ?');
        $stmt->bindValue(1, $pPosition);
        $stmt->bindValue(2, $pDriver);
        $stmt->bindValue(3, $pRace);
        $stmt->bindValue(4, $pPoints);
        $stmt->bindValue(5, $pId);
        $stmt->execute();
    }

    public static function DeleteResult($pId) {
        global $conn;

        $stmt = $conn->prepare('DELETE FROM result WHERE resultId = ?');
        $stmt->bindValue(1, $pId);
        $stmt->execute();
    }
}