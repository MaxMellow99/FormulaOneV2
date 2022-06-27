<?php
session_start();

require_once "database.php";
require_once "managers/GambleManager.php";

$gambles = GambleManager::GetGamble($_SESSION['user']);

class finalObjGamble
{
    // Empty class
}

$points = 0;
foreach ($gambles as $gamble) {
    $points += $gamble->gamblePoints;
}

$finalGambleObj = new finalObjGamble();
$finalGambleObj->userInfoUsername = $gambles[0]->userInfoUsername;
$finalGambleObj->raceTrack = $gambles[0]->raceTrack;
$finalGambleObj->Points = $points;


GambleManager::InsertFinalGamble($finalGambleObj->userInfoUsername, $finalGambleObj->raceTrack, $finalGambleObj->Points);

header("location: gebruikers.php");