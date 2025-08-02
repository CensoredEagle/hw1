<?php
include "db.php";
header('Content-Type: application/json');

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 0;
$comando = "SELECT DISTINCT id, immagine, titolo, descrizione, prezzo FROM gioco WHERE anno <= " . date('Y') . " ORDER BY RAND()";
if ($limit > 0) {
    $comando .= " LIMIT $limit";
}
$risultato = $conn->query($comando);
$am = [];
while($rc = mysqli_fetch_assoc($risultato)) {
    $am[] = $rc;
}
echo json_encode($am);