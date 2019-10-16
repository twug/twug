/**
 * Twug
 * Copyright (c) Dan Phillimore (asmblah)
 * https://github.com/twug/twug
 *
 * Released under the MIT license
 * https://github.com/twug/twug/raw/master/MIT-LICENSE.txt
 */

'use strict';

const HappyPack = require('happypack');
const happyThreadPool = HappyPack.ThreadPool({ size: 10 });

module.exports = {
    context: __dirname,
    entry: './index',
    resolve: {
        // Ignore NPM dependencies installed outside of node_modules (eg. in /vendor)
        // TODO: Decide whether we need to include sub-node_modules here?
        // modules: [__dirname + '/node_modules'],

        // Treat packages symlinked into node_modules as though they were installed properly
        symlinks: false
    },
    module: {
        rules: [
            {
                test: /\.php$/,
                use: 'happypack/loader?id=phpify'
            },
            {
                test: /\.php/,
                use: 'happypack/loader?id=source-map-extraction',
                enforce: 'post'
            },
            {
                test: /\.js$/,
                exclude: /\bnode_modules\b/,
                use: {
                    loader: 'happypack/loader?id=babel'
                }
            }
        ]
    },
    output: {
        path: __dirname + '/dist/',
        filename: 'twug.js',
        libraryTarget: 'umd'
    },
    plugins: [
        new HappyPack({
            id: 'phpify',
            threadPool: happyThreadPool,
            loaders: [
                'transform-loader?phpify'
            ]
        }),
        new HappyPack({
            id: 'source-map-extraction',
            threadPool: happyThreadPool,
            loaders: [
                'source-map-loader'
            ]
        }),
        new HappyPack({
            id: 'babel',
            threadPool: happyThreadPool,
            loaders: [
                'babel-loader?presets=env&plugins=transform-runtime'
            ]
        })
    ]
};
