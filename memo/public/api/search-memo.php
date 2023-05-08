<?php

require_once __DIR__ . '/../../models/Memo.php';

// echo file_get_contents('https://google.com');

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$query = $data['query'];

$memos = Memo::search($query);

$response = [];

// var_dump($memos);
foreach ($memos as $memo) {
    $response[] = [
        'id' => $memo->getId(),
        'body' => $memo->getBody(),
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
