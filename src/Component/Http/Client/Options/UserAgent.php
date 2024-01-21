<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Options;

/**
 * UserAgent
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Options
 */
class UserAgent
{
    public function __construct(
        public string $name,
        public array $headers = [],
        public string $cookieFile = ''
    ) {
    }
}
