<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Utils\Info;

use Laventure\Component\Http\Message\Request\Utils\Encoder\UrlEncoder;

/**
 * UrlInfo
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Utils\Info
*/
class UrlInfo
{
    /**
     * @var string
    */
    protected string $targetPath;




    /**
     * @param string $targetPath
    */
    public function __construct(string $targetPath)
    {
        $this->targetPath = UrlEncoder::decode($targetPath);
    }



    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->get(PHP_URL_SCHEME, '');
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->get(PHP_URL_USER, '');
    }


    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->get(PHP_URL_PASS, '');
    }


    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->get(PHP_URL_HOST, '');
    }


    /**
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->get(PHP_URL_PORT, 0);
    }


    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->get(PHP_URL_PATH, '');
    }


    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->get(PHP_URL_QUERY, '');
    }


    /**
     * @return string
     */
    public function getFragment(): string
    {
        return $this->get(PHP_URL_FRAGMENT, '');
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return (array)parse_url($this->targetPath);
    }




    /**
     * @param int $key
     * @param null $default
     * @return array|false|int|string|null
    */
    protected function get(int $key = 0, $default = null): mixed
    {
        $value = parse_url($this->targetPath, $key);

        return ($value ?: $default);
    }
}
