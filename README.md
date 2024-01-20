# Laventure framework

## About 
```
Some description about laventure framework ...
```

### Analyse code via ```PHP Stan```
- https://phpstan.org/user-guide/getting-started
```bash
$ composer require --dev phpstan/phpstan
$ vendor/bin/phpstan analyse src tests
```



### PHP Code Style Fixer via ```PHP CodeSniffer```
- https://github.com/squizlabs/PHP_CodeSniffer
```bash
mkdir -p tools/php-cs-fixer
composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer
tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
tools/php-cs-fixer/vendor/bin/php-cs-fixer fix tests
```


### Testing via ```phpunit```
- https://phpunit.de/
```bash
./vendor/bin/phpunit tests
```

