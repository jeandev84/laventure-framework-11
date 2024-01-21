<?php

declare(strict_types=1);

namespace Laventure\Component\Dotenv;

use Laventure\Component\Dotenv\Exception\DotenvException;
use Laventure\Component\Dotenv\Exception\WrongProcessException;

/**
 * Dotenv
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Dotenv
 */
class Dotenv implements DotenvInterface
{
    /**
     * @var string
    */
    protected string $basePath;



    /**
     * @param string $basePath
    */
    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }



    /**
     * @inheritDoc
     */
    public function load(string $file = ''): void
    {
        $this->loadFromArray(
            $this->process($file ?: '.env')
        );
    }





    /**
     * @inheritDoc
     */
    public function export(string $file = ''): bool
    {
        $file = $this->prepareToExport(
            $this->loadPath($file ?: '.env.local')
        );

        foreach ($_ENV as $name => $value) {
            file_put_contents($file, "$name=$value". PHP_EOL, FILE_APPEND);
        }

        return empty(file($file));
    }





    /**
     * @param array $data
     *
     * @return void
     */
    public function loadFromArray(array $data): void
    {
        foreach ($data as $env) {
            if (stripos($env, '#') !== false) {
                continue;
            }
            $this->put($env);
        }
    }




    /**
     * @param string $env
     *
     * @return bool
     */
    public function put(string $env): bool
    {
        preg_match('#^(?=[A-Z])(.*)=(.*)$#', $env, $matches);

        if (!empty($matches)) {
            putenv($env);
            [$key, $value] = $this->envAsArray($matches[0]);
            $_SERVER[$key] = $_ENV[$key] = $value;
            return true;
        }
        return false;
    }







    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        if (!empty($_ENV)) {
            foreach (array_keys($_ENV) as $name) {
                unset($_SERVER[$name], $_ENV[$name]);
            }
        }
    }





    /**
     * @param string $env
     *
     * @return array
     */
    private function envAsArray(string $env): array
    {
        $parameters = str_replace(' ', '', trim($env));

        return explode("=", $parameters, 2);
    }




    /**
     * @param string $file
     * @return string
     */
    private function loadPath(string $file): string
    {
        $file = trim($file, DIRECTORY_SEPARATOR);

        return $this->basePath . DIRECTORY_SEPARATOR . $file;
    }





    /**
     * @param string $file
     * @return array
     */
    private function process(string $file): array
    {
        if (!$path = realpath($this->loadPath($file))) {
            throw new DotenvException("file $file does not exist.");
        }

        $data = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (empty($data)) {
            throw new DotenvException("empty contents for '$file'");
        }

        return $data;
    }






    /**
     * @param string $file
     * @return string
    */
    private function prepareToExport(string $file): string
    {
        $dir  = dirname($file);

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        if (!touch($file) || empty($_ENV)) {
            throw new WrongProcessException();
        }

        if (file_exists($file)) {
            file_put_contents($file, "");
        }

        return $file;
    }
}
