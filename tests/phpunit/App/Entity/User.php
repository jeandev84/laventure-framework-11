<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Entity;

/**
 * User
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity
*/
class User
{

      public ?int $id = null;
      public ?string $email = null;
      public ?string $password = null;


      public function __construct(string $email = 'john@doe.com', string $password = '')
      {
          $this->email = $email;
          $this->password = $password;
      }


      /**
       * @return int|null
      */
      public function getId(): ?int
      {
          return $this->id;
      }



      /**
       * @return string|null
      */
      public function getEmail(): ?string
      {
         return $this->email;
      }


      /**
       * @param string|null $email
       * @return User
      */
      public function setEmail(?string $email): static
      {
          $this->email = $email;

          return $this;
      }


    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
}