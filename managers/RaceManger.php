<?php
    require_once 'database.php';

class RaceManger
{
    public static function GetRace() {
        global $conn;

        $stmt = $conn->prepare('SELECT * FROM race');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function GetSpecificRace($pId) {
        global $conn;

        $stmt = $conn->prepare('SELECT * FROM race WHERE raceId = ?');
        $stmt->bindValue(1, $pId);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    public static function AddRace($pSeason, $pRound, $pTrack, $pDate, $pTime) {
        global $conn;

        $stmt = $conn->prepare('INSERT INTO race(raceSeason, raceRound, raceTrack, raceDate, raceTime) VALUES(?,?,?,?,?)');
        $stmt->bindValue(1, $pSeason);
        $stmt->bindValue(2, $pRound);
        $stmt->bindValue(3, $pTrack);
        $stmt->bindValue(4, $pDate);
        $stmt->bindValue(5, $pTime);
        $stmt->execute();
    }

    public static function UpdateRace($pId, $pSeason, $pRound, $pTrack, $pDate, $pTime) {
        global $conn;

        $stmt = $conn->prepare('UPDATE race SET raceSeason = ?, raceRound = ?, raceTrack = ?, raceDate = ?, raceTime = ? WHERE raceId = ?');
        $stmt->bindValue(1, $pSeason);
        $stmt->bindValue(2, $pRound);
        $stmt->bindValue(3, $pTrack);
        $stmt->bindValue(4, $pDate);
        $stmt->bindValue(5, $pTime);
        $stmt->bindValue(6, $pId);
        $stmt->execute();
    }

    public static function DeleteRace($pId) {
        global $conn;

        $stmt = $conn->prepare('DELETE FROM race WHERE raceId = ?');
        $stmt->bindValue(1, $pId);
        $stmt->execute();
    }
}