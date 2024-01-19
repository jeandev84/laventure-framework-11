<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Service;

/**
 * Config
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service
 */
class Config
{

      /**
       * @param array $env
      */
     public function __construct(protected array $env)
     {
     }


     /**
      * @param $id
      * @param $default
      * @return mixed
     */
     public function get($id, $default = null): mixed
     {
         return $this->env[$id] ?? $default;
     }
}