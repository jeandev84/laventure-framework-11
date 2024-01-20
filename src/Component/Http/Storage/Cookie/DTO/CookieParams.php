<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Cookie\DTO;

/**
 * CookieParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Storage\Cookie\DTO
*/
class CookieParams implements CookieParamsInterface
{


    /**
     * @var string
    */
    protected string $name;


    /**
     * @var string
    */
    protected string $value;


    /**
     * @var int
    */
    protected int $expires = 3600;



    /**
     * @var string
    */
    protected string $path = '';



    /**
     * @var string
    */
    protected string $domain = '';



    /**
     * @var bool
    */
    protected bool $secure = false;



    /**
     * @var bool
    */
    protected bool $httpOnly = false;





    /**
     * @param string $name
     * @return $this
    */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }




    /**
     * @param string $value
     * @return $this
     */
    public function value(string $value): static
    {
        $this->value = $value;

        return $this;
    }





    /**
     * @param int $times
     *
     * @return mixed
    */
    public function expireAfter(int $times): static
    {
        $this->expires = $times;

        return $this;
    }





    /**
     * @param string $path
     *
     * @return $this
     */
    public function path(string $path): static
    {
        $this->path = $path;

        return $this;
    }




    /**
     * @param string $domain
     *
     * @return $this
    */
    public function domain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }





    /**
     * @param bool $secure
     * @return $this
    */
    public function secure(bool $secure): static
    {
        $this->secure = $secure;

        return $this;
    }




    /**
     * @param bool $httpOnly
     *
     * @return $this
    */
    public function httpOnly(bool $httpOnly): static
    {
        $this->httpOnly = $httpOnly;

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        // TODO: Implement getName() method.
    }





    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        // TODO: Implement getValue() method.
    }

    /**
     * @inheritDoc
     */
    public function getExpires(): int
    {
        // TODO: Implement getExpires() method.
    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        // TODO: Implement getPath() method.
    }

    /**
     * @inheritDoc
     */
    public function getDomain(): string
    {
        // TODO: Implement getDomain() method.
    }

    /**
     * @inheritDoc
     */
    public function getSecure(): bool
    {
        // TODO: Implement getSecure() method.
    }

    /**
     * @inheritDoc
     */
    public function getHttpOnly(): bool
    {
        // TODO: Implement getHttpOnly() method.
    }
}