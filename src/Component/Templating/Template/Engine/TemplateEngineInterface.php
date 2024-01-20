<?php
declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Engine;


use Laventure\Component\Templating\Template\Cache\TemplateCacheInterface;
use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * TemplateEngineInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Engine
 */
interface TemplateEngineInterface
{


       /**
        * Set resource path
        *
        * @param string $path
        * @return mixed
       */
       public function resource(string $path): mixed;





       /**
        * Returns resource base path
        *
        * @return string
       */
       public function getResource(): string;





       /**
        * Cache compiled template or not
        *
        * @return TemplateCacheInterface
       */
       public function getCache(): TemplateCacheInterface;






       /**
        * @param TemplateInterface $template
        *
        * @return string
       */
       public function compile(TemplateInterface $template): string;
}