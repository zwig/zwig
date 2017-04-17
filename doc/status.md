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
| convert_encoding      | missing       |                                                                                 |
| date                  | missing       |                                                                                 |
| date_modify           | missing       |                                                                                 |
| default               | missing       |                                                                                 |
| escape                | partial       | Needs better test cases. Only the HTML strategy is implemented yet.             |
| first                 | missing       |                                                                                 |
| format                | missing       |                                                                                 |
| join                  | complete      |                                                                                 |
| json_encode           | partial       | Tests need some improvement. The optional parameter $options is not supported.  |
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
| striptags             | partial       | Doesn't support parameter allowable_tags yet.                                   |
| title                 | complete      |                                                                                 |
| trim                  | complete      |                                                                                 |
| upper                 | complete      |                                                                                 |
| url_encode            | partial       | Tests need some improvement. Please note http://stackoverflow.com/a/6533595     |
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
