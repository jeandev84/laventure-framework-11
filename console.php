<?php


use Laventure\Component\Filesystem\Locator\FileLocator;

require 'vendor/autoload.php';

$locator = new FileLocator(__DIR__.'/config');

#dd($locator->locate('app.php'));
#dump(get_included_files());

dump(get_declared_classes());