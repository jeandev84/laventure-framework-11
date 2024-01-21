<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Services;

use PHPUnitTest\App\Entity\User;

/**
 * MailerService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Factory
 */
class MailerService
{
      public function sendMail(User $user): string
      {
          return "Sending message to email (". $user->getEmail() . ")";
      }
}