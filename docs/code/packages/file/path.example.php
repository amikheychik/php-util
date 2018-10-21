<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\File\Path\PathString;

// Path class only describes a path, not necessarily an existing file
$path = new PathString('/tmp/path-example');
$path->exists() === false;
$path->isFile() === false;
$path->isDir() === false;
try {
  $path->absolute();
}
catch (\Throwable $e) {
  // Throws an exception as file does not exist
}

// Initialize file
touch('/tmp/path-example');
$path->exists() === true;
$path->isFile() === true;
/** @noinspection PhpUnhandledExceptionInspection - file exists */
$path->absolute() === '/tmp/path-example';
