<?php

declare(strict_types=1);

namespace Laventure\Component\Dotenv\Exception;

/**
 * WrongProcessException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Dotenv\Exception
 */
class WrongProcessException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Something went wrong during loading environments.");
    }
}
