### Template

```php 
require '../vendor/autoload.php';

$request = ServerRequest::fromGlobals();

$data  = new Parameter($request->getParsedBody());
$files = new Parameter($request->getUploadedFiles());


$template = new Template(__DIR__.'/../views/welcome.phtml', [
    'data'    => $data,
    'files'   => $files,
    'request' => $request
]);

$compressor = new \Laventure\Component\Templating\Template\Compressor\TemplateCompressor();
$template = $compressor->compress($template);


echo $template;


$loader  = new TemplateLoader(realpath(__DIR__.'/../views'));
$cache   = new TemplateCache(__DIR__.'/../storage/cache/views');
$factory = new TemplateFactory();
$engine  = new TemplateEngine($loader, $cache, $factory);

$renderer = new Renderer($engine);

$content = $renderer->render('index.html', [
    'title' => 'Вход',
    'users' => [
        new User('demo1@test.com', md5(123)),
        new User('demo2@test.com', md5(123)),
        new User('demo3@test.com', md5(123)),
    ]
]);

echo $content;


dump($engine->getCompilers());
```