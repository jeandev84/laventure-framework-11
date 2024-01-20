### Response


```php 
require 'vendor/autoload.php';

$request = ServerRequest::fromGlobals();

$response = new Response(200);
$response->withProtocolVersion($request->getProtocolVersion());
$response->getBody()->write('<h1>Salut les amis</h1>');
$response->getBody()->write('<p>J'ajoute un nouveau contenu</p>');
$response->setContent('<small>encore un contenu moins important</small>');
echo $response;
```