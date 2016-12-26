COMMANDLINE TOOL
================

Basic usage
-----------

Use the *convert* action to transform all templates within a directory into JavaScript.

```
./vendor/bin/zwig convert PATH
```


Twig extensions
---------------

Zwig can also be used in combination with custom Twig extensions,
as long as they will be passed as fully qualified class names via the *extension* option.

```
./vendor/bin/zwig convert [-e|--extension] CLASSNAME
```

For example:
```
./vendor/bin/zwig convert -e '\AppBundle\TwigExtension' src/AppBundle/Views
```

In addition, the functionality has to be added in JavaScript.
For more information read the [extension documentation](extensions.md).


Config files
------------

Instead of passing all options within the command line, it is possible to use a configuration file.

```
./vendor/bin/zwig convert config.json
```

The file must contain the attributes *root* and *files*.
Additionally there can be a list of *extensions*.

```json
{
  "root": "src/AppBundle/Views",
  "files": [
    "src/AppBundle/Views/article-view.twig",
    "src/AppBundle/Views/article-edit.twig"
  ],
  "extensions": [
    "\\AppBundle\\FormatExtension",
    "\\AppBundle\\TranslateExtension"
  ]
}
```