<?php
/** @noinspection PhpExpressionResultUnusedInspection */
/** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

use Xtuple\Util\Cache\Cache\Memory\MemoryCache;
use Xtuple\Util\Cache\Key\KeyStruct;
use Xtuple\Util\Cache\Record\RecordStruct;
use Xtuple\Util\Type\DateTime\DateTimeString;

$cache = new MemoryCache('example');

// This record has no expiration date.
$cache->insert(new RecordStruct(new KeyStruct(['user', 1]), 'John Doe'));

// Cache::find() returns null is record is not found.
if ($record = $cache->find(new KeyStruct(['user', 1]))) {
  $record->key()->fields() === ['user', 1];
  $record->value() === 'John Doe';
  $record->expiresAt() === null;
}

// This record expires in 1 hour
$cache->insert(new RecordStruct(
  new KeyStruct(['user', 1, 'name']), 'John Doe', new DateTimeString('+1 hour')
));

// Note: key ['user', 1, 'name'] would override key ['user', 1] in MemoryCache
$cache->find(new KeyStruct(['user', 1])) === null;
$cache->find(new KeyStruct(['user', 1, 'name']))->value() === 'John Doe';

// Records can be removed
$cache->delete(new KeyStruct(['user', 1, 'name']));
$cache->find(new KeyStruct(['user', 1, 'name'])) === null;

// Cache can be cleared completely
$cache->clear();
$cache->isEmpty() === true;
