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


```