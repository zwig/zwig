README
======

[![Build Status](https://img.shields.io/travis/zwig/zwig.svg)](https://travis-ci.org/zwig/zwig)
[![Code Quality](https://img.shields.io/codeclimate/github/zwig/zwig.svg)](https://codeclimate.com/github/zwig/zwig)
[![Latest Version](https://img.shields.io/packagist/v/zwig/zwig.svg)](https://packagist.org/packages/zwig/zwig)
[![Software License](https://img.shields.io/packagist/l/zwig/zwig.svg)](LICENSE)

What is Zwig?
-------------

Zwig is a toolkit that uses Twig to convert [Twig templates][1] into JavaScript,
so that they can be used for client-side rendering within any modern browser.

Zwig has the following goals:
 * compatible with Twig as far as possible
 * fast and secure client-side rendering
 * easy integration into both PHP and JS environments

Please note that this project is in a very early state and therefore not mature enough for production.
The current status is listed within the [documentation][3].



Getting started
---------------

Install Zwig via [Composer][2]:
```
composer require zwig/zwig
```

Convert templates:
```
./vendor/bin/zwig convert path/to/your/templates
```

Start using them:
```html
<!DOCTYPE html>
<html>
    <body>
        <script src="vendor/zwig/zwig/dist/zwig.min.js"></script>
        <script src="vendor/zwig/zwig/examples/hello.js"></script>
        <script>
            document.write(Zwig.render('hello.twig', {
                name: 'GitHub'
            });
        </script>
    </body>
</html>
```

Check the directory ```vendor/zwig/zwig/examples``` for more examples.


[1]: http://twig.sensiolabs.org/
[2]: https://getcomposer.org/
[3]: doc/status.md
