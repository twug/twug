# Twug

Twig PHP (https://twig.symfony.com/) compiled to JavaScript with [Uniter](http://asmblah.github.io/uniter/).

> Note 1: This is an experimental release. Expect things to be broken,
performance to be sub-optimal and the compiled JS bundle size to be rather large for now.

> Note 2: This is primarily a demonstration of how [Uniter](http://asmblah.github.io/uniter/) is able to handle
complex projects like Twig. If you want to use Uniter to build the rest of your
client-side logic, you can skip using Twug.js and just require Twig.php with Composer
as part of your build.

## How to use it

Install it with NPM:
```shell
npm install twug
```

Import it and render some Twig:
```javascript
import twug from 'twug';

twug.renderString('Hello there {{ name }}!', {name: 'Fred'}).then((renderedHtml) => {
    document.body.insertAdjacentHTML('beforeEnd', renderedHtml);
}, (error) => {
    document.body.insertAdjacentHTML('beforeEnd', 'Twug error: ' + error);
});
```

## Why

- Get all the features of "real" PHP Twig
- Demonstrate how a PHP project built with Uniter can be "invisibly" published to the NPM ecosystem
- Have fun!

## Benchmarks vs. alternatives

TODO (feel free to [send a PR](https://github.com/twug/twug/pulls) if you're interested)

## Issues
- An old Twig release (1.x) is being used
- The deprecated string loader is being used
- The escape filter is currently broken due to missing `preg_replace_callback(...)`
  support in Uniter

## Caveats
- Some features of PHP are not yet implemented by Uniter: there are stubs for these
  in `php/src/shims.php`. These will all need to be removed and implemented properly
  in Uniter before a stable version of this package could be tagged.

## See also
- Uniter (https://github.com/asmblah/uniter)
- PHPify (part of Uniter) (https://github.com/uniter/phpify)

## Alternatives
- Twig.js (https://github.com/twigjs/twig.js)
