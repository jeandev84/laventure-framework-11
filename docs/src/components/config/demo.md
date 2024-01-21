### Config 

````php 
require '../vendor/autoload.php';
$config = new Config(require __DIR__.'/config.php');

dump($config);

dump($config->get('doctrine.connection.driver'));

$config = new Config($_ENV);
$config->get('DB_NAME');
```