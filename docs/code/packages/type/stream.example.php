<?php
declare(strict_types=1);

use Xtuple\Util\Generics\Type\Exception\TypeThrowable;
use Xtuple\Util\Type\Stream\Exception\Throwable as StreamThrowable;
use Xtuple\Util\Type\Stream\StreamStruct;
use Xtuple\Util\Type\Stream\String\StringStreamStruct;
use Xtuple\Util\Type\Stream\String\StringStreamWithContent;
use Xtuple\Util\Type\Stream\TemporaryStream;

try {
  $stream = new StreamStruct(tmpfile());
}
catch (TypeThrowable $e) {
  // tmpfile() may return false, StreamStruct would throw an exception
}
try {
  fwrite($stream->resource(), 'Temporary');
}
catch (StreamThrowable $e) {
  // Stream::resource() is allowed to throw an exception,
  // as Stream implementations may try to create a resource only when called.
}

try {
  // Using TemporaryStream class, to avoid manual check for types.
  $temporary = new TemporaryStream();
  fwrite($temporary->resource(), 'Another temporary');
}
catch (StreamThrowable $e) {
  // Working with resources is unsafe, exceptions may happen often.
}

// If a Stream is expected to contain string data,
// we can wrap it up into a narrower type
$string = new StringStreamStruct($temporary);
try {
  // StringStream::content() method is unsafe,
  // as it tries to read from the provided resource
  $content = $string->content();
}
catch (StreamThrowable $e) {
}
// __toString() method in PHP must not throw exceptions
// StringStream::__toString() returns an empty string,
// if an error occurred reading content.
$content = (string) $string;

try {
  // Using StringStreamWithContent to write content into a Stream
  $string = new StringStreamWithContent($stream, $content);
}
catch (StreamThrowable $e) {
  // Handling an exception, if write operation failed
}
