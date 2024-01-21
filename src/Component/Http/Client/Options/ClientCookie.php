<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * ClientCookie
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Options
 */
class ClientCookie
{
    protected array $params = [];


    /**
     * @param string $cookieFile
     */
    public function __construct(public string $cookieFile)
    {
    }



    /**
     * @param array $params
     * @return $this
    */
    public function withParams(array $params): static
    {
        foreach ($params as $name => $value) {
            $this->params[] = "$name=$value";
        }

        return $this;
    }




    /**
     * @return string
    */
    public function toStringParams(): string
    {
        if (empty($this->params)) {
            return '';
        }

        return join(', ', $this->params);
    }
}
