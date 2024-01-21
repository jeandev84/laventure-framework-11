<?php

use Laventure\Component\Http\Message\Response\JsonResponse;
use PHPUnitTest\App\Entity\User;

require '../../vendor/autoload.php';

$users = [
    new User('user1@site.ru', md5('user1@site.ru')),
    new User('user2@site.ru', md5('user2@site.ru')),
    new User('user3@site.ru', md5('user3@site.ru')),
    new User('user4@site.ru', md5('user4@site.ru')),
    new User('user5@site.ru', md5('user5@site.ru')),
    new User('user6@site.ru', md5('user6@site.ru')),
];

$response = new JsonResponse($users);


$response->send();

print_r($_SERVER);
print_r($_GET);
print_r(getallheaders());

echo $response;