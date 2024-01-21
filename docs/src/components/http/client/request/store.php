<?php

use Laventure\Component\Http\Message\Response\JsonResponse;
use PHPUnitTest\App\Entity\User;

require '../../vendor/autoload.php';

$response = new \Laventure\Component\Http\Message\Response\Response(201);


$response->send();

print_r($_SERVER);
print_r($_POST);
print_r(getallheaders());

$user = new User('user1@site.ru', md5('user1@site.ru'));



#echo $response;

echo "POSTED";