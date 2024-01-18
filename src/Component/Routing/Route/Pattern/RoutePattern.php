<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Pattern;

/**
 * RoutePattern
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Pattern
 */
class RoutePattern
{
    /**
     * @var string
    */
    protected string $name;


    /**
     * @var string
    */
    protected string $regex;





    /**
     * @param string $name
     *
     * @param string $regex
    */
    public function __construct(string $name, string $regex)
    {
        $this->name      = $name;
        $this->regex     = $this->normalizeRegex($regex);
    }




    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return string
    */
    public function getRegex(): string
    {
        return $this->regex;
    }




    /**
     * @return string[]
    */
    public function toArray(): array
    {
        return [
            "#{{$this->name}}#"   => "(?P<$this->name>$this->regex)",
            "#{{$this->name}.?}#" => "?(?P<$this->name>$this->regex)?"
        ];
    }




    /**
     * @return string[]
    */
    public function getPlaceholders(): array
    {
        return array_keys($this->toArray());
    }




    /**
     * @return string[]
    */
    public function getReplaces(): array
    {
        return array_values($this->toArray());
    }




    /**
     * @param string $path
     *
     * @return string
    */
    public function replace(string $path): string
    {
        return preg_replace($this->getPlaceholders(), $this->getReplaces(), $path);
    }




    /**
     * Replace placeholders by values
     *
     * @param string $path
     * @param array $values
     * @return string
    */
    public function replaceValues(string $path, array $values): string
    {
        return preg_replace($this->getPlaceholders(), $values, $path);
    }




    /**
     * @param string $regex
     * @return string
    */
    private function normalizeRegex(string $regex): string
    {
        return str_replace('(', '(?:', $regex);
    }
}
