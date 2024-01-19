<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Service;

use PHPUnitTest\App\Entity\User;

/**
 * MailerService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service
 */
class MailerService
{
      public function sendMail(User $user): string
      {
          return "Sending message to email (". $user->getEmail() . ")";
      }
}