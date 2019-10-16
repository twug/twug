/**
 * Twug
 * Copyright (c) Dan Phillimore (asmblah)
 * https://github.com/twug/twug
 *
 * Released under the MIT license
 * https://github.com/twug/twug/raw/master/MIT-LICENSE.txt
 */

import Twug from './js/src/Twug';

// TODO: Offer one place to install these plugins so we don't get mixed up between sync and async
// Install basic-level PCRE preg_* function support
require('phpruntime/psync').install(require('phpruntime/src/plugin/pcre/basicSupport'));
// Install eval(...) support
require('phpruntime/psync').install(require('phpruntime/src/plugin/eval'));
// Install XDebug DBGp support
// require('phpruntime/async').install(require('phpruntime/src/plugin/debugger'));
// require('phpruntime/async').install(require('phpruntime/src/plugin/debugger/dbgproxy'));

const twugModule = require('./php/src/twug.php')();

// Hook stdout and stderr up to the DOM
// TODO: Move this to phpify
twugModule.getStdout().on('data', function (data) {
    if (!console) {
        return;
    }

    console.info(data);
});
twugModule.getStderr().on('data', function (data) {
    if (!console) {
        return;
    }

    console.warn(data);
});

export default new Twug(twugModule.execute());
