<h1>Difference Calculator<img align="center" src="https://img.icons8.com/nolan/64/compare.png" alt='Logo of the project'></h1>
  <h3>
    Command line app and PHP package installable with Composer to search for differences between two files
  </h3>
</div>

[![Actions Status](https://github.com/StanislavKls/php-project-lvl2/workflows/My-check/badge.svg)](https://github.com/StanislavKls/php-project-lvl2/actions)

<a href="https://codeclimate.com/github/StanislavKls/php-project-lvl2/maintainability"><img src="https://api.codeclimate.com/v1/badges/de4ea06f12a665b9fdf0/maintainability" /></a>

## Composer
```
composer require stanislavk/gendiff
```
## Uses
```
<?php

use function Differ\Differ\genDiff;

$diff = genDiff($pathToFile1, $pathToFile2, $format = 'stylish');
print_r($diff);
```

## Formats
```
'stylish' (default), 'plain' and 'json'.
```
### file1.json:
```
{
  "host": "hexlet.io",
  "timeout": 50,
  "proxy": "123.234.53.22",
  "follow": false
}
```

### file2.json:
```
{
  "timeout": 20,
  "verbose": true,
  "host": "hexlet.io"
}
```
## Result
```
{
  - follow: false
    host: hexlet.io
  - proxy: 123.234.53.22
  - timeout: 50
  + timeout: 20
  + verbose: true
}
```

## There is also a binary to run on the command line

Compare plane json files
[![asciicast](https://asciinema.org/a/chJpoVRgcLtPfidxIqA9hrmkT.svg)](https://asciinema.org/a/chJpoVRgcLtPfidxIqA9hrmkT)

Compare nested json files
[![asciicast](https://asciinema.org/a/s9azSAbm4iaPmFVt6Dnt5z9OW.svg)](https://asciinema.org/a/s9azSAbm4iaPmFVt6Dnt5z9OW)

