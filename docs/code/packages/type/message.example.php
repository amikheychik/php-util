<?php
/** @noinspection SuspiciousAssignmentsInspection */
/** @noinspection PhpExpressionResultUnusedInspection */
declare(strict_types=1);

use Xtuple\Util\Type\String\Message\Argument\ArgumentFromString;
use Xtuple\Util\Type\String\Message\Argument\ArgumentStruct;
use Xtuple\Util\Type\String\Message\Argument\ArgumentWithTokens;
use Xtuple\Util\Type\String\Message\Argument\Collection\Map\ArrayMapArgument;
use Xtuple\Util\Type\String\Message\Message\MessageStruct;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;
use Xtuple\Util\Type\String\Message\Type\Number\Integer\IntegerArgument;
use Xtuple\Util\Type\String\Message\Type\String\StringArgument;

// Basic declaration of a message. Parameters are wrapped in `{}`, but curly brackets are not used in argument name.
/** @noinspection PhpUnhandledExceptionInspection - verified types */
$message = new MessageStruct('Query {query} failed: {message}', new ArrayMapArgument([
  new StringArgument('query', 'http://httpbin.org/status/404'),
  new StringArgument('message', 'Page not found'),
]));
(string) $message === 'Query http://httpbin.org/status/404 failed: Page not found';
$message->template() === 'Query {query} failed: {message}';
$message->arguments()->get('message')->__toString() === 'Page not found';
$message->arguments()->get('{message}') === null;

// MessageWithTokens can be used as a shortcut, if parameters do not need localization
$message = new MessageWithTokens('API request failed: ({code}) {message}', [
  'code' => 1024,
  'message' => 'Access denied',
]);
// Note: in en_US.UTF-8 locale number 1024 should be localized as 1,024 by default, but is treated as a string here.
(string) $message === 'API request failed: (1024) Access denied';
// But the message template remains, so it can be translated.
$message->template() === 'API request failed: ({code}) {message}';

// Every Argument by default is just a Message with a key (name). And can have nested localizable arguments.
$argument = new ArgumentStruct('error', new MessageWithTokens('({code}) {message}', [
  'code' => 1024,
  'message' => 'Access denied',
]));
/** @noinspection PhpUnhandledExceptionInspection - verified types */
$message = new MessageStruct('API request failed: {error}', new ArrayMapArgument([
  $argument,
]));
$message->template() === 'API request failed: {error}';
$message->arguments()->get('error')->template() === '({code}) {message}';

// ArgumentFromString is a shortcut for ArgumentStruct, to unpack MessageStruct parameters
/** @noinspection PhpUnhandledExceptionInspection - verified types */
$argument = new ArgumentFromString('error', '({code}) {message}', new ArrayMapArgument([
  new IntegerArgument('code', 1024),
  new StringArgument('message', 'Access denied'),
]));

// ArgumentWithTokens is a shortcut for ArgumentStruct, to use MessageWithTokens.
// Note: all arguments are casted to string
$argument = new ArgumentWithTokens('error', '({code}) {message}', [
  'code' => 1024,
  'message' => 'Access denied',
]);
