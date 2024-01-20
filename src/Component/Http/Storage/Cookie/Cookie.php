<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Cookie;

use Laventure\Component\Http\Storage\Cookie\DTO\CookieParamsInterface;

/**
 * @inheritdoc
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
