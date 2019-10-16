<?php

/**
 * Twug
 * Copyright (c) Dan Phillimore (asmblah)
 * https://github.com/twug/twug
 *
 * Released under the MIT license
 * https://github.com/twug/twug/raw/master/MIT-LICENSE.txt
 */

namespace Twug;

use Twig_Environment;
use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;
use Twig_Loader_String;

/**
 * Class Twug
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class Twug
{
    /**
     * Renders a Twig string, optionally given a context
     *
     * @param string $twig
     * @param array $context
     * @return string
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function renderString($twig, array $context = [])
    {
        $twigEnvironment = new Twig_Environment(new Twig_Loader_String());

        return $twigEnvironment->render($twig, $context);
    }
}
