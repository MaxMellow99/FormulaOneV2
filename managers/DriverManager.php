<?php
    require_once 'database.php';

class DriverManager
{
    public static function GetDriver() {
        global $conn;

        $stmt = $conn->prepare('SELECT * FROM driver');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function GetSpecificDriver($pId) {
        global $conn;

        $stmt = $conn->prepare('SELECT * FROM driver WHERE driverId = ?');
        $stmt->bindValue(1, $pId);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    public static function AddDriver($pFirstname, $pLastname, $pNumber, $pCode, $pBirthdate, $pNationality) {
        global $conn;

        $stmt = $conn->prepare('INSERT INTO driver(driverFirstname, driverLastname, driverNumber, driverCode, driverBirthdate, driverNationality) VALUES(?,?,?,?,?,?)');
        $stmt->bindValue(1, $pFirstname);
        $stmt->bindValue(2, $pLastname);
        $stmt->bindValue(3, $pNumber);
        $stmt->bindValue(4, $pCode);
        $stmt->bindValue(5, $pBirthdate);
        $stmt->bindValue(6, $pNationality);
        $stmt->execute();
    }

    public static function UpdateDriver($pId, $pFirstname, $pLastname, $pNumber, $pCode, $pBirthdate, $pNationality) {
        global $conn;

        $stmt = $conn->prepare('UPDATE driver SET driverFirstname = ?, driverLastname = ?, driverNumber = ?, driverCode = ?, driverBirthdate = ?, driverNationality = ? WHERE driverId = ?');
        $stmt->bindValue(1, $pFirstname);
        $stmt->bindValue(2, $pLastname);
        $stmt->bindValue(3, $pNumber);
        $stmt->bindValue(4, $pCode);
        $stmt->bindValue(5, $pBirthdate);
        $stmt->bindValue(6, $pNationality);
        $stmt->bindValue(7, $pId);
        $stmt->execute();
    }

    public static function DeleteDriver($pId) {
        global $conn;

        $stmt = $conn->prepare('DELETE FROM driver WHERE driverId = ?');
        $stmt->bindValue(1, $pId);
        $stmt->execute();
    }
}