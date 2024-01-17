# phpunit10-xml-file-loading-issue

Loading XML files with PHPUnit 10 would fail if they contain specific entity definitions.

`<!ENTITY $name "$value">`

| $name | $value   |           |
|-------|----------|-----------|
| amp   | `&#38;`  | ❌ invalid |
| amp   | `&amp;`  | ❌ invalid |
| apos  | `&#39;`  | ⭕️ valid  |
| apos  | `&apos;` | ❌ invalid |
| gt    | `&#62;`  | ⭕️ valid  |
| gt    | `&gt;`   | ❌ invalid |
| lt    | `&#60;`  | ❌ invalid |
| lt    | `&lt;`   | ❌ invalid |
| quot  | `&#34;`  | ⭕️ valid  |
| quot  | `&quot;` | ❌ invalid |

Please switch the branches and install PHPUnit to see the differences.

The libxml version is 2.9.14.

```shell
$ php --info | grep 'libxml'
libxml Version => 2.9.14
libxml
libxml2 Version => 2.9.14
```

## PHPUnit 9

```text
$ ./vendor/bin/phpunit -c ./phpunit.xml 
PHPUnit 9.6.15 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.14
Configuration: ./phpunit.xml

...                                                                 3 / 3 (100%)

Time: 00:00.005, Memory: 6.00 MB

OK (3 tests, 3 assertions)
```

## PHPUnit 10

### Expected

Same as the result of PHPUnit 9.

### Actual

```text
$ ./vendor/bin/phpunit -c ./phpunit.xml 
PHPUnit 10.5.7 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.14
Configuration: /<SOME_PATH>/phpunit10-xml-file-loading-issue/phpunit.xml

..E                                                                 3 / 3 (100%)

Time: 00:00.006, Memory: 8.00 MB

There was 1 error:

1) unit\XmlFileTest::testLoad with data set #2 ('/<SOME_PATH>/phpunit10-x...id.xml')
PHPUnit\Util\Xml\XmlException: Could not load "/<SOME_PATH>/phpunit10-xml-file-loading-issue/tests/unit/../files/invalid.xml":

xmlAddEntity: invalid redeclaration of predefined entity
xmlAddEntity: invalid redeclaration of predefined entity

/<SOME_PATH>/phpunit10-xml-file-loading-issue/tests/unit/XmlFileTest.php:15

ERRORS!
Tests: 3, Assertions: 2, Errors: 1.
```
