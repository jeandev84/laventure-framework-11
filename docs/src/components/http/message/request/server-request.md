### ServerRequest 

```php 
require 'vendor/autoload.php';

$request = ServerRequest::fromGlobals();

$data  = new \Laventure\Component\Http\Utils\Params\Parameter($request->getParsedBody());
$files = new \Laventure\Component\Http\Utils\Params\Parameter($request->getUploadedFiles());

dump($request);
```