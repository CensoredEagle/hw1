<?php
include "db.php";
header('Content-Type: application/json');
$anno_corrente = date('Y');
$comando = "SELECT DISTINCT id, immagine, titolo, descrizione, prezzo FROM gioco WHERE anno = $anno_corrente ORDER BY id DESC";
$risultato = $conn->query($comando);
$am = [];
while($rc = mysqli_fetch_assoc($risultato)) {
    $am[] = $rc;
}
echo json_encode($am);