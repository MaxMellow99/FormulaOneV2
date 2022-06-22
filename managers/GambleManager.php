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
        ");
        $stmt->bindValue(1, $pPosition);
        $stmt->bindValue(2, $pDriver);
        $stmt->execute();

        $stmt2 = $conn->prepare("
        SELECT 
            sortingtable.sortPosition AS gok, 
            (SELECT result.resultPosition FROM result WHERE result.driverId = driver.driverId) as resultaat
        FROM 
            sortingtable
        JOIN 
            driver ON sortingtable.driverId = driver.driverId
        ");
        $stmt2->execute();

        return $stmt2->fetchAll(PDO::FETCH_OBJ);
    }

    public static function CalculateGamble($pPosition, $pRace, $pDriver, $pUser) {
        global $conn;
        $pointsPerDriver = 0;

        $lijst = self::SortGamble($pPosition, $pDriver);

        foreach($lijst as $item) {
            if($item->gok == $item->resultaat) {
                $pointsPerDriver = 10;
            } else {
                $differencePerDriver = abs($item->resultaat - $pPosition);
                $pointsPerDriver = 8 - $differencePerDriver;

                if (str_contains($pointsPerDriver, "-")) {
                    $pointsPerDriver = 0;
                }
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

    public static function ClearSorting() {
        globaL $conn;

        $stmt = $conn->prepare('TRUNCATE TABLE sortingtable');
        $stmt->execute();
    }

}
