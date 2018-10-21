<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\String\Message\Argument\Collection\Map\ArrayMapArgument;
use Xtuple\Util\Type\String\Message\Type\Select\SelectMessageStruct;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

/** @noinspection PhpUnhandledExceptionInspection - verified types */
$select = new SelectMessageStruct(
  'other',
  new StringMessage('Their gender is {gender}'),
  new ArrayMapArgument([
    new StringArgument('m', 'male'),
    new StringArgument('f', 'female'),
  ]),
  new ArrayMapArgument([
    new StringArgument('gender', 'unknown'),
  ])
);
// Note: 'other' option is not provided, so default message is used.
(string) $select === 'Their gender is unknown';
