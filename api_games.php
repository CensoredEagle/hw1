<?php
include "db.php";
header('Content-Type: application/json');

$type = $_GET['type'] ?? '';
$year = date('Y');
$games = [];

switch ($type) {
    case 'novita':
        $query = "SELECT DISTINCT id, immagine, titolo, descrizione, prezzo FROM gioco WHERE anno = $year ORDER BY id DESC LIMIT 4";
        break;
    case 'venduti':
        $query = "SELECT DISTINCT id, immagine, titolo, descrizione, prezzo FROM gioco WHERE anno <= $year ORDER BY RAND() LIMIT 4";
        break;
    case 'prossime':
        $query = "SELECT DISTINCT id, immagine, titolo, descrizione, prezzo FROM gioco WHERE anno > $year LIMIT 6";
        break;
    default:
        echo json_encode([]);
        exit;
}
$result = $conn->query($query);
while ($row = mysqli_fetch_assoc($result)) {
    $games[] = $row;
}
echo json_encode($games);