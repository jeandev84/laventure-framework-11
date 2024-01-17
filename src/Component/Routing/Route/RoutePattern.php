<?php
declare(strict_types=1);

namespace Laventure\Component\Routing\Route;

/**
 * RoutePattern
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route
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
     * @var string
    */
    protected string $pattern;




    /**
     * @param string $name
     *
     * @param string $regex
    */
    public function __construct(string $name, string $regex)
    {
        $this->name  = $name;
        $this->regex = $this->normalizeRegex($regex);
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
    public function getPatterns(): array
    {
        return [
            "#{{$this->name}}#",
            "#{{$this->name}}.?#"
        ];
    }




    /**
     * @return string[]
    */
    public function getReplaces(): array
    {
        return [
            "(?P<$this->name>$this->regex)",
            "?(?P<$this->name>$this->regex)?"
        ];
    }




    /**
     * @param string $path
     *
     * @return string
    */
    public function replace(string $path): string
    {
        return preg_replace($this->getPatterns(), $this->getReplaces(), $path);
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