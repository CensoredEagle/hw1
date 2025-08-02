<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$url = 'https://gamerpower.com/api/giveaways';
$response = @file_get_contents($url);

if ($response === FALSE) {
    http_response_code(500);
    echo json_encode(['error' => 'Impossibile recuperare i dati dall\'API di GamerPower']);
    exit;
}

echo $response;