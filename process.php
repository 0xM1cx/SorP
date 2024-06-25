<?php
require 'models.php';
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['picked']) && isset($_POST['loser'])) {
    $winnerId = $_POST['picked'];
    $loserId = $_POST['loser'];

    // $peeps = $db->getPeeps();
    // if (count($peeps) != 2) {
    //     die('Error: Unable to fetch images.');
    // }

    // $peep1 = $peeps[0];
    // $peep2 = $peeps[1];

    // if ($winnerId == $peep1['id']) {
    //     $winner = $peep1;
    //     $loser = $peep2;
    // } elseif ($winnerId == $peep2['id']) {
    //     $winner = $peep2;
    //     $loser = $peep1;
    // } else {
    //     echo $peep1['id'] . " " . $peep2['id'] . " " . $winnerId;
    //     die('Error: Invalid image ID.');
    // }


    // Elo rating calculation
    $K = 32;
    $winnerRating = $db->getRating($winnerId);
    $loserRating = $db->getRating($loserId);


    $expectedWinner = 1 / (1 + pow(10, ($loserRating - $winnerRating) / 400));
    $expectedLoser = 1 / (1 + pow(10, ($winnerRating - $loserRating) / 400));

    $newWinnerRating = $winnerRating + $K * (1 - $expectedWinner);
    $newLoserRating = $loserRating + $K * (0 - $expectedLoser);

    $db->updateRating($winnerId, round($newWinnerRating));
    $db->updateRating($loserId, round($newLoserRating));

    header('Location: index.php');
    exit();
}
