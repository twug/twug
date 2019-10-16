# Twug

Twig PHP (https://twig.symfony.com/) compiled to JavaScript with [Uniter](http://asmblah.github.io/uniter/).

> Note 1: This is an **experimental** release. Expect things to be broken (see [Issues](#Issues) below),
performance to be sub-optimal and the compiled JS bundle size to be rather large for now.

> Note 2: This is primarily a demonstration of how [Uniter](http://asmblah.github.io/uniter/) is able to handle
complex projects like Twig. If you want to use Uniter to build the rest of your
client-side logic, you can skip using Twug.js and just require Twig.php with Composer
as part of your build.

## How to use it in the browser

Install it with NPM:
```shell
npm install twug
```

Require it and render some Twig:
```javascript
let twug = require('twug').default;

twug.renderString('Hello there {{ name }}!', {name: 'Fred'}).then((renderedHtml) => {
    document.body.insertAdjacentHTML('beforeEnd', renderedHtml);
}, (error) => {
    document.body.insertAdjacentHTML('beforeEnd', 'Twug error: ' + error);
});
```

## How to use it from Node.js

Install it with NPM:
```shell
npm install twug
```

Require it and render some Twig:
```javascript
let twug = require('twug').default;

twug.renderString('Hello there {{ name }}!', {name: 'Fred'}).then((renderedText) => {
    console.log(renderedText);
}, (error) => {
    console.log('Twug error: ' + error);
});
````

## Why

- Get all the features of "real" PHP Twig
- Demonstrate how a PHP project built with Uniter can be "invisibly" published to the NPM ecosystem
- Have fun!

## Benchmarks vs. alternatives

TODO (feel free to [send a PR](https://github.com/twug/twug/pulls) if you're interested)

## Building it locally

Clone the repository
```shell
git clone https://github.com/twug/twug
```

Install PHP dependencies with Composer
```shell
composer install
```

Install JS dependencies with NPM
```shell
npm install
```

Start a development build (note this will be in watch mode)
```shell
build:dev:watch
```

## Issues
- An old Twig release (1.x) is being used
- The deprecated string loader is being used
- The escape filter is currently broken due to missing `preg_replace_callback(...)`
  support in Uniter
- A whole bunch of notices are currently printed due to some missing/shimmed PHP functions
  and constants.

## Caveats
- Some features of PHP are not yet implemented by Uniter: there are stubs for these
  in `php/src/shims.php`. These will all need to be removed and implemented properly
  in Uniter before a stable version of this package could be tagged.

## See also
- Uniter (https://github.com/asmblah/uniter)
- PHPify (part of Uniter) (https://github.com/uniter/phpify)

## Alternatives
- Twig.js (https://github.com/twigjs/twig.js)
