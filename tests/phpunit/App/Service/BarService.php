<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Service;

use PHPUnitTest\App\Entity\User;

/**
 * BarService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service
*/
class BarService
{

    protected FooService $fooService;
    protected MailerService $mailerService;
    protected string $siteUrl;


    public function __construct(
        FooService $fooService,
        MailerService $mailerService,
        string $siteUrl
    )
    {
        $this->fooService = $fooService;
        $this->mailerService = $mailerService;
        $this->siteUrl       = $siteUrl;
    }



    public function getMessage(): string
    {
        return join([
           $this->fooService->foo(),
           $this->mailerService->sendMail(new User())
        ]);
    }
}