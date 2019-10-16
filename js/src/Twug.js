/**
 * Twug
 * Copyright (c) Dan Phillimore (asmblah)
 * https://github.com/twug/twug
 *
 * Released under the MIT license
 * https://github.com/twug/twug/raw/master/MIT-LICENSE.txt
 */

export default class Twug {
    /**
     * @param {Promise} phpExecutionPromise
     */
    constructor(phpExecutionPromise) {
        /**
         * @type {Promise}
         */
        this.phpExecutionPromise = phpExecutionPromise;
    }

    /**
     * Renders a Twig string, optionally given a context
     *
     * @param {string} twig
     * @param {object} context
     * @return {Promise}
     */
    renderString(twig, context = {}) {
        return new Promise((resolve, reject) => {
            this.phpExecutionPromise.then(function (resultValue) {
                const twug = resultValue.getNative();

                twug.renderString(twig, context).then(function (result) {
                    resolve(result);
                }, function (error) {
                    reject(error);
                });
            }, reject);
        });
    }
};
