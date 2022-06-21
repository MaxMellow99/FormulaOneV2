<?php
require_once "database.php";

class GambleManager
{
    public static function GetGamble() {
        global $conn;

        $stmt = $conn->prepare('SELECT gambleId, gamblePosition, gamblePoints, userInfoUsername, raceTrack, driverFirstname, driverLastname, driverCode FROM gamble LEFT JOIN userinfo ON userinfo.userInfoId = gamble.userInfoId LEFT JOIN driver ON driver.driverId = gamble.driverId LEFT JOIN race ON race.raceId = gamble.raceId ORDER BY driverLastname ASC');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function GetGambleDriver() {
        global $conn;

        $stmt = $conn->prepare('SELECT driverId, driverLastname FROM driver ORDER BY driverLastname');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function GetGambleRace() {
        global $conn;

        $stmt = $conn->prepare('SELECT raceId, raceTrack FROM race');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function GetGambleResult() {
        global $conn;

        $stmt = $conn->prepare('SELECT resultId, resultPosition, driverLastname FROM result JOIN driver on driver.driverId = result.driverId ORDER BY driverLastname');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function SortGamble($pPosition, $pDriver) {
        global $conn;

        $stmt = $conn->prepare("
            INSERT INTO sortingtable(sortPosition, driverId) VALUES(?, ?);
            SELECT sortPosition, driverLastname FROM sortingtable JOIN driver ON driver.driverId = sortingtable.driverId ORDER BY driverLastname ASC;
        ");
        $stmt->bindValue(1, $pPosition);
        $stmt->bindValue(2, $pDriver);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function CalculateGamble($pPosition, $pRace, $pDriver, $pUser) {
        global $conn;
        $pointsPerDriver = 0;

        foreach(self::SortGamble($pPosition, $pDriver) as $driverResult) {
            var_dump($driverResult);
            if($driverResult->sortPosition == $pPosition) {
                $pointsPerDriver = 10;
            } else {
                $differencePerDriver = abs($driverResult->resultPosition - $pPosition);
                $pointsPerDriver = 8 - $differencePerDriver;
            }

        }

        $stmt = $conn->prepare('INSERT INTO gamble(gamblePosition, gamblePoints, raceId, driverId, userInfoId) VALUES (?, ?, ?, ?, ?)');
        $stmt->bindValue(1, $pPosition);
        $stmt->bindValue(2, $pointsPerDriver);
        $stmt->bindValue(3, $pRace);
        $stmt->bindValue(4, $pDriver);
        $stmt->bindValue(5, $pUser);
        $stmt->execute();
    }

}
