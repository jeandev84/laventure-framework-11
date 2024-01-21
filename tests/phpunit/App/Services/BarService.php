<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Services;

use PHPUnitTest\App\Entity\User;

/**
 * BarService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Factory
*/
class BarService
{

    protected FooService $fooService;
    protected MailerService $mailerService;
    protected string $baseUrl;


    public function __construct(
        FooService $fooService,
        MailerService $mailerService,
        string $baseUrl
    )
    {
        $this->fooService = $fooService;
        $this->mailerService = $mailerService;
        $this->baseUrl       = $baseUrl;
    }



    public function getMessage(): string
    {
        return join([
           $this->fooService->foo(),
           $this->mailerService->sendMail(new User())
        ]);
    }
}