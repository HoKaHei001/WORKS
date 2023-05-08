<?php

require_once __DIR__ . '../../../models/User.php';

$json = file_get_contents("php://input");
$data = json_decode($json, true);

// $data = [
//     'email' => 'hoge@hoge.com',
// ];

$exists = User::existsEmail($data['email']);

$response = [
    'exists' => $exists,
];

echo json_encode($response);
