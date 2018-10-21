<?php
/** @noinspection SuspiciousAssignmentsInspection */
declare(strict_types=1);

use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Exception\ExceptionWithArguments;
use Xtuple\Util\Exception\ExceptionWithMessage;
use Xtuple\Util\Type\String\Message\Argument\Collection\Map\ArrayMapArgument;
use Xtuple\Util\Type\String\Message\Message\MessageStruct;
use Xtuple\Util\Type\String\Message\Type\Number\Integer\IntegerArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;

/** @noinspection PhpUnhandledExceptionInspection - verified map types */
$e = new ExceptionWithMessage(
  new MessageStruct('HTTP error {code}: {message}', new ArrayMapArgument([
    new IntegerArgument('code', 404),
    new StringArgument('message', 'Page not found'),
  ]))
);

/** @noinspection PhpUnhandledExceptionInspection - verified map types */
$e = new ExceptionWithArguments( // <1>
  'HTTP error {code}: {message}',
  new ArrayMapArgument([
    new IntegerArgument('code', 404),
    new StringArgument('message', 'Page not found'),
  ])
);

$e = new Exception('HTTP error {code}: {message}', [ // <2>
  'code' => 404, // <3>
  'message' => 'Page not found',
]);
