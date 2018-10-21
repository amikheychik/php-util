<?php
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\String\Message\Argument\Collection\Map\ArrayMapArgument;
use Xtuple\Util\Type\String\Message\Type\Number\Integer\IntegerMessage;
use Xtuple\Util\Type\String\Message\Type\Plural\PluralMessageFromStrings;
use Xtuple\Util\Type\String\Message\Type\Plural\PluralMessageStruct;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

/** @noinspection PhpUnhandledExceptionInspection - verified types */
$plural = new PluralMessageStruct(
  new IntegerMessage(4321),
  new StringMessage('{count} users are {status}'),
  new StringMessage('One user is {status}'),
  null,
  new ArrayMapArgument([
    new StringArgument('status', 'online'),
  ])
);
// Note: using NumberMessage for $count allows to localize count too.
(string) $plural === '4,321 users are online';

// PluralMessageFromStrings can be used, when messages are simple strings
$plural = new PluralMessageFromStrings(0, '{count} items', 'One item', [
  '=0' => 'No items',
]);
// Note: '=0' plural is used when count equals 0
(string) $plural === 'No items';

$plural = new PluralMessageFromStrings($count = 2, '{count} items', 'One item', [
  '=0' => 'No items',
], null, $offset = 1);
// Note: $count is 2, but since $offset is 1, the result is shown for $count == 1.
(string) $plural === 'One item';
