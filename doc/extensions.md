TWIG EXTENSIONS
===============

In order to use Twig extensions, you have to:
 * Load the extension while converting templates
 * Implement the additional functionality in JavaScript
 

Load extensions
---------------

Extensions have to be passed as fully qualified class names via the *extension* option.

```
./vendor/bin/zwig convert [-e|--extension] CLASSNAME PATH
```

For example:
```
./vendor/bin/zwig convert -e '\AppBundle\TwigExtension' src/AppBundle/Views
```


Implement functionality
-----------------------

Add new filter functions right after including the Zwig JavaScript library.

```html
<script src="vendor/zwig/zwig/dist/zwig.min.js"></script>
<script>
Zwig.Filters.reverse = function (context, value) {
    return value.split('').reverse().join('');
};
</script>
```

Environment variables are accessible through the *get* and *set* methods of the *context* object.