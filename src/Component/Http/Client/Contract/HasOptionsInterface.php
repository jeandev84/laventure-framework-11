<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Contract;

use Laventure\Component\Http\Client\DTO\HttpClientOptions;

/**
 * HasOptionsInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Contract
*/
interface HasOptionsInterface
{
    /**
     * @param array $options
     * @return $this
    */
    public function withOptions(array $options): static;




    /**
     * @param array $queries
     *
     * @return $this
    */
    public function query(array $queries): static;






    /**
     * @param array $headers
     *
     * @return $this
    */
    public function headers(array $headers): static;





    //    /**
    //     * @return $this
    //    */
    //    public function cookies(array $cookies): static;
}
