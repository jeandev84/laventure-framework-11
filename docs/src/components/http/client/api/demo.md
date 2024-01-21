### HTTP Client 


1. Request GET
```php 
use Laventure\Component\Http\Client\HttpClient;
use Laventure\Component\Http\Client\Request\CurlRequest;
use Laventure\Component\Http\Storage\Cookie\Cookie;

require 'vendor/autoload.php';
/*
$client = HttpClient::create();

$response = $client->request('GET', 'http://localhost:8000', [
    'headers' => [

    ],
    'body' => [], // [], ''
    'json' => []
]);
dd($client);
*/

try {

    $request = new CurlRequest('GET', 'http://localhost:8080/api/index.php', [
        'headers' => [
            'X-Framework' => 'Laventure'
        ],
        'query' => [
            'token'    => md5('laventure-framework'),
            'redirect' => false
        ],
        'body' => [], // [], ''
        'json' => []
    ]);


    $response = $request->send();
    echo $response;
    echo PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}


try {

    $client = HttpClient::create();
    $response = $client->request('GET', 'http://localhost:8080/api/index.php', [
        'headers' => [
            'X-Framework' => 'Laventure'
        ],
        'query' => [
            'token'    => md5('laventure-framework'),
            'redirect' => false
        ],
        'body' => [], // [], ''
        'json' => []
    ]);

    echo $response;
    echo PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}


try {

    $client = HttpClient::create();
    $response = $client->get('http://localhost:8080/api/index.php', [
        'headers' => [
            'X-Framework' => 'Laventure'
        ],
        'query' => [
            'token'    => md5('laventure-framework'),
            'redirect' => false
        ],
        'body' => [], // [], ''
        'json' => []
    ]);

    echo $response;
    echo PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}
```



2. Request POST 
```php
<?php

use Laventure\Component\Http\Client\HttpClient;
use Laventure\Component\Http\Client\Request\CurlRequest;
use Laventure\Component\Http\Storage\Cookie\Cookie;

require 'vendor/autoload.php';

try {

    $client = HttpClient::create();
    $response = $client->post('http://localhost:8080/api/store.php', [
        'headers' => [
            'X-Framework' => 'Laventure'
        ],
        'body' => [
            'login'    => 'admin',
            'password' => '1234'
        ], // [], ''
        'json' => []
    ]);

    echo $response;
    echo PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}



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



<?php

use Laventure\Component\Http\Client\HttpClient;
use Laventure\Component\Http\Client\Request\CurlRequest;
use Laventure\Component\Http\Message\Request\Utils\Params\QueryParams;
use Laventure\Component\Http\Storage\Cookie\Cookie;

require 'vendor/autoload.php';

try {

    $client = HttpClient::create();
    $response = $client->post('http://localhost:8080/api/store.php', [
        'headers' => [
            'X-Framework' => 'Laventure'
        ],
        /*
        'body' => json_encode([
            'login'    => 'admin',
            'password' => '1234'
        ]), // [], ''
        'body' => (string)(new QueryParams([
            'login'    => 'admin',
            'password' => '1234'
        ])),
        */
        'json' => []
    ]);

    echo $response;
    echo PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}

```


3. Update 
```php 
<?php

use Laventure\Component\Http\Client\HttpClient;
use Laventure\Component\Http\Client\Request\CurlRequest;
use Laventure\Component\Http\Message\Request\Utils\Params\QueryParams;
use Laventure\Component\Http\Storage\Cookie\Cookie;

require 'vendor/autoload.php';

try {

    $client = HttpClient::create();
    $response = $client->put('http://localhost:8080/api/update.php', [
        'headers' => [
            'X-Framework' => 'Laventure',
            'Content-Type' => 'application/json; charset=UTF-8;'
        ],
        'body' => [], // [], ''
        'json' => json_encode([
            'email'    => 'admin@admin.com',
            'password' => '1234'
        ])
    ]);

    echo $response;
    echo PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}


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

```



4. Delete 
```php 

<?php

use Laventure\Component\Http\Client\HttpClient;
use Laventure\Component\Http\Client\Request\CurlRequest;
use Laventure\Component\Http\Message\Request\Utils\Params\QueryParams;
use Laventure\Component\Http\Storage\Cookie\Cookie;

require 'vendor/autoload.php';

try {

    $client = HttpClient::create();
    $response = $client->delete('http://localhost:8080/api/delete.php?id=3&token='. uniqid(), [
        'headers' => [
            'X-Framework' => 'Laventure',
            'Content-Type' => 'application/json; charset=UTF-8;'
        ],
        'body' => [], // [], ''
        'json' => json_encode([
            'email'    => 'admin@admin.com',
            'password' => '1234'
        ])
    ]);

    echo $response;
    echo PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}


<?php

use Laventure\Component\Http\Message\Response\JsonResponse;
use PHPUnitTest\App\Entity\User;

require '../../vendor/autoload.php';


print_r($_SERVER);
print_r($_GET);
print_r(getallheaders());

echo file_get_contents('php://input');
```


