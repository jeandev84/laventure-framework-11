<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Cookie;

use Laventure\Component\Http\Storage\Cookie\DTO\CookieParamsInterface;

/**
 * Cookie
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Cookie
*/
class Cookie implements CookieInterface
{


    /**
     * @var CookieParamsInterface
    */
    protected CookieParamsInterface $params;


    /**
     * @inheritDoc
    */
    public function __construct(CookieParamsInterface $dto)
    {
         setcookie(
            $dto->getName(),
            $dto->getValue(),
            $dto->getExpires(),
            $dto->getPath(),
            $dto->getDomain(),
            $dto->getSecure(),
            $dto->getHttpOnly()
        );

        $this->params = $dto;
    }




    /**
     * @inheritDoc
    */
    public function getParams(): CookieParamsInterface
    {
        return $this->params;
    }
}
