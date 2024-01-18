<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Group\DTO;

/**
 * RouteGroupAttributesInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Group\DTO
*/
interface RouteGroupAttributesInterface
{
    /**
     * Returns group path
     *
     * @return string
    */
    public function getPath(): string;



    /**
     * Returns group namespace
     *
     * @return string
    */
    public function getNamespace(): string;




    /**
     * Returns group name
     *
     * @return string
    */
    public function getName(): string;






    /**
     * Returns group middlewares
     *
     * @return array
    */
    public function getMiddlewares(): array;
}
