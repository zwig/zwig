STATUS
======

Here is a overview about the currently implemented features.
See the [Twig documentation](http://twig.sensiolabs.org/documentation) for more information.


Tags
----

| Tag                   | Status        | Comment                                                                         |
|-----------------------|---------------|---------------------------------------------------------------------------------|
| autoescape            | partial       | Needs better test cases. Only the HTML strategy is implemented yet.             |
| block                 | missing       |                                                                                 |
| do                    | missing       |                                                                                 |
| embed                 | missing       |                                                                                 |
| extends               | missing       |                                                                                 |
| filter                | missing       |                                                                                 |
| flush                 | no support    | This tag will not be implemented.                                               |
| for                   | partial       | Tests need some improvement. Filtering through if missing.                      |
| from                  | missing       |                                                                                 |
| if                    | partial       | Tests need some improvement.                                                    |
| import                | missing       |                                                                                 |
| include               | complete      |                                                                                 |
| macro                 | missing       |                                                                                 |
| sandbox               | missing       |                                                                                 |
| set                   | partial       | Tests need some improvement.                                                    |
| spaceless             | missing       |                                                                                 |
| use                   | missing       |                                                                                 |
| verbatim              | missing       |                                                                                 |



Filters
-------

| Filter                | Status        | Comment                                                                         |
|-----------------------|---------------|---------------------------------------------------------------------------------|
| abs                   | complete      |                                                                                 |
| batch                 | missing       |                                                                                 |
| capitalize            | working       |                                                                                 |
| convert_encoding      | missing       |         - phpenv config-add php.ini

  # Install PHP dependencies
  - composer install

  # Download PhantomJS 2 for Ubuntu Precise Pangolin.
  # Because there is only PhantomJS 1.9.* pre-installed.
  - wget https://s3.amazonaws.com/travis-phantomjs/phantomjs-2.0.0-ubuntu-12.04.tar.bz2
  - tar -xf phantomjs-2.0.0-ubuntu-12.04.tar.bz2

  # CodeCeption has to use our own PhantomJS binary.
  - sed -i 's/phantomjs/.\/phantomjs/g' codeception.yml                                                                          |
| date                  | missing       |                                                                                 |
| date_modify           | missing       |                                                                                 |
| default               | missing       |                                                                                 |
| escape                | partial       | Needs better test cases. Only the HTML strategy is implemented yet.             |
| first                 | missing       |                                                                                 |
| format                | missing       |                                                                                 |
| join                  | complete      |                                                                                 |
| json_encode           | missing       |                                                                                 |
| keys                  | missing       |                                                                                 |
| last                  | missing       |                                                                                 |
| length                | missing       |                                                                                 |
| lower                 | complete      |                                                                                 |
| merge                 | missing       |                                                                                 |
| nl2br                 | partial       | Tests need some improvement.                                                    |
| number_format         | missing       |                                                                                 |
| raw                   | partial       | Tests need some improvement.                                                    |
| replace               | missing       |                                                                                 |
| reverse               | missing       |                                                                                 |
| round                 | missing       |                                                                                 |
| slice                 | missing       |                                                                                 |
| sort                  | missing       |                                                                                 |
| split                 | complete      |                                                                                 |
| striptags             | missing       |                                                                                 |
| title                 | complete      |                                                                                 |
| trim                  | complete      |                                                                                 |
| upper                 | missing       |                                                                                 |
| url_encode            | missing       |                                                                                 |
| custom                | missing       |                                                                                 |
| custom escaping       | missing       |                                                                                 |



Functions
---------

| Function              | Status        | Comment                                                                         |
|-----------------------|---------------|---------------------------------------------------------------------------------|
| attribute             | missing       |                                                                                 |
| block                 | missing       |                                                                                 |
| constant              | missing       |                                                                                 |
| cycle                 | missing       |                                                                                 |
| date                  | missing       |                                                                                 |
| dump                  | missing       |                                                                                 |
| include               | missing       |                                                                                 |
| max                   | missing       |                                                                                 |
| min                   | missing       |                                                                                 |
| parent                | missing       |                                                                                 |
| random                | missing       |                                                                                 |
| range                 | missing       |                                                                                 |
| source                | no support    | This tag will not be implemented.                                               |
| template_from_string  | no support    | This tag will not be implemented.                                               |
| custom                | missing       |                                                                                 |



Operators
---------

| Operator              | Status        | Comment                                                                         |
|-----------------------|---------------|---------------------------------------------------------------------------------|
| in                    | complete      |                                                                                 |
| is                    | complete      |                                                                                 |
| Math                  | complete      |                                                                                 |
| Logic                 | partial       | Tests need some improvement. b-and, b-xor, b-or and not have yet to be added.   |
| Comparisons           | complete      |                                                                                 |
| Others                | complete      |                                                                                 |



Tests
-----

| Test                  | Status        | Comment                                                                         |
|-----------------------|---------------|---------------------------------------------------------------------------------|
| constant              | no support    | This tag will not be implemented.                                               |
| defined               | partial       | Tests need some improvement.                                                    |
| divisibleby           | missing       |                                                                                 |
| empty                 | missing       |                                                                                 |
| even                  | missing       |                                                                                 |
| iterable              | missing       |                                                                                 |
| null                  | missing       |                                                                                 |
| odd                   | partial       | Tests need some improvement.                                                    |
| sameas                | missing       |                                                                                 |
| custom                | missing       |                                                                                 |
