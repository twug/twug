<?php

/**
 * Twug
 * Copyright (c) Dan Phillimore (asmblah)
 * https://github.com/twug/twug
 *
 * Released under the MIT license
 * https://github.com/twug/twug/raw/master/MIT-LICENSE.txt
 */

use Twug\Twug;

// Load Composer's autoloader
require_once __DIR__ . '/../../vendor/autoload.php';

// FIXME: Implement all of these shimmed features
require_once __DIR__ . '/shims.php';

return new Twug();
