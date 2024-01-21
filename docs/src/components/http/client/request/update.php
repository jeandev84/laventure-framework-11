<?php

use Laventure\Component\Http\Message\Response\JsonResponse;
use PHPUnitTest\App\Entity\User;

require '../../vendor/autoload.php';

$response = new \Laventure\Component\Http\Message\Response\Response(201);


#$response->send();

print_r($_SERVER);
print_r(getallheaders());

/*
#parse_str(file_get_contents('php://input', 'r+'), $data);
#print_r($data);
*/

$body = file_get_contents('php://input', 'r+');

$data = json_decode($body, true);
print_r($data);

$user = new User($data['email'] ?? '', $data['password'] ?? '');

print_r($user);

#echo $response;
